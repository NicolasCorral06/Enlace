<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


if(isset($_POST["login_adm"])){
    require "../Model/log.class.php";
    $log = new Log();
    if (isset($_SESSION['id_adm'])){ 
        session_destroy();
        ?>
            
            <form method="get" name="myForm" id="myForm" action="../index.php"> 
                <input type="hidden" name="msg" value="OA04">
            </form>

            <script>    
                document.getElementById("myForm").submit();
            </script>
        <?php
    }

    if ($_POST["email"] == "" || $_POST["senha"] == ""){
        $log->setTexto("Tentativa de acesso na área de administrador com campos vazios\n");
        $log->fileWriter();
        ?>
            <form method="get" name="myForm" id="myForm" action="../index.php">
                <input type="hidden" name="msg" value="FR01">
            </form>
            <script>
                document.getElementById("myForm").submit();
            </script>
        <?php
    }
    
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    require "../Model/ferramenta.class.php";

    $ferramentas = new Ferramentas();
    //eu criei uma variavel que ta linkada com a Class Ferramentas
    //n precisa ficar criando muitas variaveis para a mesma classe, so cria uma e fica usando

    $resp[0] = $ferramentas->antiInjection($_POST["email"]);
    $resp[1] = $ferramentas->antiInjection($_POST["senha"]);
    //eu conti a dentro da $resp tem o antiInjection que eu liguei usando o $ferramentas

    for ($i = 0;$i <= 1; $i++){
        if($resp[$i] == 0){
            $log->setTexto("Tentativa injection na área de Administrador\n");
            $log->fileWriter();
            //to comparando para ver se em algum $resp tem injection
            ?>
                <form method="get" name="myForm" id="myForm" action="../index.php">
                    <input type="hidden" name="msg" value="FR27">
                </form>
                <script>
                    document.getElementById("myForm").submit();
                </script>
            <?php
            exit();
        }
    }

    $senhaCrip = $ferramentas->sha256($senha);

    $dados["email"] = $email;
    $dados["senha"] = $senhaCrip;
    
    require "../Model/manager.class.php";
    $manager = new Manager();   
    //mesma coisa q la em cima, linkei uma variavel a classe Manager  
    $dados = $manager->AdmVerificar($dados);
    //to usando $dados para puxar todas as informações que eu pedi da function

    if($dados['result'] == 0){
        $log->setTexto("Tentativa de acesso sem exito na área de Administrador\n");
        $log->fileWriter();
        ?> 
            <form method="get" name="myForm" id="myForm" action="../index.php">
                <input type="hidden" name="msg" value="FR02">
            </form>
            <script>
                document.getElementById("myForm").submit();
            </script>
        <?php
        exit();
    }

    $_SESSION["id_adm"] = $dados["id"];
    $_SESSION["nome_adm"] = $dados["nome"];
    $_SESSION["email_adm"] = $dados["email"];
    $_SESSION["poder_adm"] = $dados["poder"];

    
    $log->setTexto(" {$dados['email']} logou com exito na área de Administrador \n");
    $log->fileWriter();

    ?>
        <form method="post" name="myForm" id="myForm" action="../View/adm.php">
            <input type="hidden" name="msg" value="0">
        </form>
        <script>
            document.getElementById("myForm").submit();
        </script>
    <?php

}

if(isset($_POST["admEdit"])){
    require "../Model/log.class.php";
    require "../Model/ferramenta.class.php";
    require "../Model/manager.class.php";
    $log = new Log();
    $ferramentas = new Ferramentas();
    $manager = new Manager();

    $dados["id"] = $_REQUEST["id"];
    $dados["nome"] = $_REQUEST["nome"];
    $dados["email"] = $_REQUEST["email"];
    $dados["poder"] = $_REQUEST["poder"];
    $dados["status"] = $_REQUEST["status"];

    if($_REQUEST["senha"] != ""){
        $dados["senha"] = $ferramentas->sha256($_REQUEST["senha"]);
    }
    
    $emailConfirm = $manager->AdmConfirEmail($dados);
    
    if($emailConfirm == 1){//erro
        ?>
            <form method="post" name="myForm" id="myForm" action="../view/admNew.php">
                <input type="hidden" name="msg" value="FR06">
            </form>

            <script>
                document.getElementById('myForm').submit();
            </script>
        <?php
        exit();
    }
    
    $res = $manager->AdmEdit($dados);

    if($res == true){// tudo certo
        $log->setTexto("Atualização dos dados do ID - " . $dados["id"] . " dos ADM ocorreram com exito\n");
        $log->fileWriter();

        $_SESSION["id_adm"] = $dados["id"];
        $_SESSION["nome_adm"] = $dados["nome"];
        $_SESSION["email_adm"] = $dados["email"];
        $_SESSION["poder_adm"] = $dados["poder"];
        $_SESSION["status_adm"] = $dados["status"];
        ?>
            <form method="post" name="myForm" id="myForm" action="../View/admList.php">
                <input type="hidden" name="msg" value="BD50">
            </form>

            <script>
                document.getElementById('myForm').submit();
            </script>
        <?php
    }else{// erro de insert
        $log->setTexto("Atualização falha dos dados do ID - " . $dados["id"] . " dos ADM\n");
        $log->fileWriter();
        ?>
            <form method="post" name="myForm" id="myForm" action="../View/admList.php">
                <input type="hidden" name="msg" value="BD02">
            </form>

            <script>
                document.getElementById('myForm').submit();
            </script>
        <?php

    }
}

if(isset($_POST["cliEdit"])){
    require "../Model/log.class.php";
    require "../Model/ferramenta.class.php";
    require "../Model/manager.class.php";
    $log = new Log();
    $ferramentas = new Ferramentas();
    $manager = new Manager();

    if($_POST["foto_perfil_antiga"] != "" && $_POST["foto_perfil_antiga"] != "1"){
        $foto_perfilA = $_POST["foto_perfil_antiga"];
    } else {
        $foto_perfilA = "1";

    }
    $foto_perfil = $_FILES["foto_perfil"];

    $fpExt = $ferramentas->pegaExtensao($foto_perfil["name"]);
    $allowed = array("jpeg", "jpg", "png", "jfif");

    if (isset($_FILES["foto_perfil"]) && $_FILES["foto_perfil"]["error"] == 0) {
        if(!in_array($fpExt, $allowed)){ 
            $log->setTexto("Extensão errada usada no update da foto de perfil\n");
            $log->fileWriter();
            ?>
                <form method="post" name="myForm" id="myForm" action="../View/cliList.php">
                    <input type="hidden" name="msg" value="FR19">
                </form>
    
                <script>
                    document.getElementById('myForm').submit();
                </script>
            <?php
        }

        $dados["foto_perfil"] = "fp_" . $ferramentas->geradorMicroTime() . "." . $fpExt;
        $fpAtualizar = true;
    }
   
    $dados["id"] = $_POST["id"];
    $dados["nome"] = $_POST["nome"];
    $dados["email"] = $_POST["email"];
    $dados["telefone"] = $_POST["telefone"];
    $dados["nascimento"] = $_POST["nascimento"];
    $dados["cpf"] = $_POST["cpf"];
    //$dados["data_insercao"] = $_POST["data_insercao"];
    $dados["status"] = $_POST["status"];

    if($_REQUEST["senha"] != ""){
        $dados["senha"] = $ferramentas->sha256($_REQUEST["senha"]);
    }
    
    $emailConfirm = $manager->cliConfirEmail($dados);
    
    if($emailConfirm == 1){//erro
        ?>
            <form method="post" name="myForm" id="myForm" action="../view/cliList.php">
                <input type="hidden" name="msg" value="FR06">
            </form>

            <script>
                document.getElementById('myForm').submit();
            </script>
        <?php
        exit();
    }
    
    $res = $manager->cliEdit($dados);

    if($res){// tudo certo
        $log->setTexto("Atualização dos dados do ID - " . $dados["id"] . " dos cliente ocorreram com exito\n");
        $log->fileWriter();

        if ($fpAtualizar) {
            if (isset($dados["foto_perfil"])) {
                move_uploaded_file($foto_perfil["tmp_name"], "../../Assets/cliente/{$dados['foto_perfil']}");
                unlink("../../Assets/servicos/$foto_perfilA");
            }
        }

        ?>
            <form method="post" name="myForm" id="myForm" action="../View/cliList.php">
                <input type="hidden" name="msg" value="BD50">
            </form>

            <script>
                document.getElementById('myForm').submit();
            </script>
        <?php
    }else{// erro de insert
        $log->setTexto("Atualização falha dos dados do ID - " . $dados["id"] . " dos cliente\n");
        $log->fileWriter();
        ?>
            <form method="post" name="myForm" id="myForm" action="../View/cliList.php">
                <input type="hidden" name="msg" value="BD02">
            </form>

            <script>
                document.getElementById('myForm').submit();
            </script>
        <?php

    }
}

if(isset($_REQUEST["adm_delete"])){
    require "../Model/log.class.php";
    require "../Model/ferramenta.class.php";
    $log = new Log();
    $ferramentas = new Ferramentas();

    require "../Model/manager.class.php";
    $manager = new Manager();

    $id = $_REQUEST["id"];
    $res = $manager->AdmDel($id);
    if($res == true){ 
        $log->setTexto("Administrador do ID -" . $id . " foi deletado com sucesso\n");
        $log->fileWriter();
        ?>
            <form method="post" name="myForm" id="myForm" action="../view/admList.php">
                <input type="hidden" name="msg" value="BD54">
            </form>
            
            <script>
                document.getElementById('myForm').submit();
            </script>
        <?php

     }else{ 
        $log->setTexto("Falha na exclusão do Administrador do ID -" . $id . " \n");
        $log->fileWriter();
        ?>
        <form method="post" name="myForm" id="myForm" action="../view/admList.php">
            <input type="hidden" name="msg" value="BD04">
        </form>

        <script>
            document.getElementById('myForm').submit();
        </script>
    <?php
     }
    
}

if(isset($_REQUEST["adm_new"])){
    require "../Model/log.class.php";
    require "../Model/ferramenta.class.php";
    $log = new Log();
    $ferramentas = new Ferramentas();

    require "../Model/manager.class.php";
    $manager = new Manager();

    $dados = array();
    $dados["nome"] = $_REQUEST["nome"];
    $dados["email"] = $_REQUEST["email"];
    $dados["poder"] = $_REQUEST["poder"];
    $dados["status"] = $_REQUEST["status"];

    if($_REQUEST["senha1"] != $_REQUEST["senha2"]){
        ?>
            <form method="post" name="myForm" id="myForm" action="../view/admNew.php">
                <input type="hidden" name="msg" value="FR04">
            </form>

            <script>
                document.getElementById('myForm').submit();
            </script>
        <?php
    }   

    $emailConfirm = $manager->AdmConfirEmail($dados);

    if($emailConfirm == 1){//erro
        ?>
            <form method="post" name="myForm" id="myForm" action="../view/admNew.php">
                <input type="hidden" name="msg" value="FR06">
            </form>

            <script>
                document.getElementById('myForm').submit();
            </script>
        <?php
        exit();
    }

    $dados["senha"] = $ferramentas->sha256($_REQUEST["senha1"]);

    $res = $manager->AdmNew($dados);

    if($res == true){
        $log->setTexto("Novo administrador criado - " . $dados["nome"] . "\n");
        $log->fileWriter();
        ?>
            <form method="post" name="myForm" id="myForm" action="../View/admList.php">
                <input type="hidden" name="msg" value="BD50">
            </form>

            <script>
                document.getElementById('myForm').submit();
            </script>
        <?php
    } else {
        $log->setTexto("Falha na criação de um novo administrador\n");
        $log->fileWriter();
        ?>
            <form method="post" name="myForm" id="myForm" action="../View/admList.php">
                <input type="hidden" name="msg" value="BD02">
            </form>

            <script>
                document.getElementById('myForm').submit();
            </script>
        <?php
    }
}

//CARROSSEL
if(isset($_POST["carrossel_new"])){
    include "../Model/ferramenta.class.php";
    include "../Model/log.class.php";
    include "../Model/manager.class.php";
    $ferramentas = new Ferramentas();
    $log = new Log();
    $manager = new Manager();

    $imgpq = $_FILES["img-pq"];
    $imggd = $_FILES["img-gd"];

    $altpq = $_POST["altpq"];
    $altgd = $_POST["altgd"];

    $status = $_POST["status"];

   
    $pqExt = $ferramentas->pegaExtensao($imgpq["name"]);
    $gdExt = $ferramentas->pegaExtensao($imggd["name"]);
    $allowed = array("jpeg", "jpg", "png", "jfif");

    if(!in_array($pqExt, $allowed) || !in_array($gdExt, $allowed)){ 
        $log->setTexto("Extensão errada usada na criação de novas imagens\n");
        $log->fileWriter();
        ?>
            <form method="post" name="myForm" id="myForm" action="../View/carrosselList.php">
                <input type="hidden" name="msg" value="FR19">
            </form>

            <script>
                document.getElementById('myForm').submit();
            </script>
        <?php
    } else {
        $dados = array();
        //MT = micro time
        $dados["imgMTPq"] = "pq_" . $ferramentas->geradorMicroTime() . "." . $pqExt;
        $dados["imgMTGd"] = "gd_" . $ferramentas->geradorMicroTime() . "." . $gdExt;
        $dados["altpq"] = $altpq;
        $dados["altgd"] = $altgd;
        $dados["status"] = $status;
        $res = $manager->CarrosselNew($dados);

        
        if($res == true){
            $log->setTexto("Criação sucedida de novas imagens\n");
            $log->fileWriter();
            move_uploaded_file($imgpq["tmp_name"], "../../Assets/carrossel/{$dados['imgMTPq']}");
            move_uploaded_file($imggd["tmp_name"], "../../Assets/carrossel/{$dados['imgMTGd']}");
            ?>
                <form method="post" name="myForm" id="myForm" action="../View/carrosselList.php">
                    <input type="hidden" name="msg" value="FR51">
                </form>

                <script>
                    document.getElementById('myForm').submit();
                </script>
            <?php
        } else {
            $log->setTexto("Falha na criação de novas imagens\n");
            $log->fileWriter();
            ?>
                <form method="post" name="myForm" id="myForm" action="../View/carrosselList.php">
                    <input type="hidden" name="msg" value="FR30">
                </form>

                <script>
                    document.getElementById('myForm').submit();
                </script>
            <?php
        }
    }
    
}

if(isset($_POST["carrosselEdit"])){
    $status = $_POST["status"];
    $id = $_POST["id"];

    include "../Model/ferramenta.class.php";
    include "../Model/log.class.php";
    include "../Model/manager.class.php";
    $ferramentas = new Ferramentas();
    $log = new Log();
    $manager = new Manager();

    $dados = array();
    $dados["status"] = $status;
    $dados["id"] = $id;
    $dados["altpq"] = $_POST["altpq"];
    $dados["altgd"] = $_POST["altgd"];

    $imgpqAtualizar = false;
    $imggdAtualizar = false;

    $dadosAtuais = $manager->CarrosselPuxar($id);
    $DA_imggd = $dadosAtuais['imggd'];
    $DA_imgpq = $dadosAtuais['imgpq'];

    if (isset($_FILES["imgpq"]) && $_FILES["imgpq"]["error"] == 0) {
        $imgpq = $_FILES["imgpq"];
        $pqExt = $ferramentas->pegaExtensao($imgpq["name"]);
        $allowed = array("jpeg", "jpg", "png", "jfif");

        if (!in_array($pqExt, $allowed)) {
            $log->setTexto("Extensão errada utilizada na atualização das imagens do ID-" . $id ."\n");
            $log->fileWriter();
            ?>
                <form method="post" name="myForm" id="myForm" action="../View/carrosselList.php">
                    <input type="hidden" name="msg" value="FR19">
                </form>

                <script>
                    document.getElementById('myForm').submit();
                </script>
                <?php
            exit;
        }

        $dados["imgMTPq"] = "pq_" . $ferramentas->geradorMicroTime() . "." . $pqExt;
        $imgAtualizarPq = true;
    }

    if (isset($_FILES["imggd"]) && $_FILES["imggd"]["error"] == 0) {
        $imggd = $_FILES["imggd"];
        $gdExt = $ferramentas->pegaExtensao($imggd["name"]);
        $allowed = array("jpeg", "jpg", "png", "jfif");

        if (!in_array($gdExt, $allowed)) {
            $log->setTexto("Extensão errada utilizada na atualização das imagens do ID-" . $id ."n");
            $log->fileWriter();
            ?>
                <form method="post" name="myForm" id="myForm" action="../View/carrosselList.php">
                    <input type="hidden" name="msg" value="FR19">
                </form>

                <script>
                    document.getElementById('myForm').submit();
                </script>
            <?php
            exit;
        }

        $dados["imgMTGd"] = "gd_" . $ferramentas->geradorMicroTime() . "." . $gdExt;
        $imgAtualizarGd = true;
    }

    $res = $manager->CarrosselEdit($dados);

    if ($res == true) {
        if (isset($imgAtualizarPq) && $imgAtualizarPq == true){
            if (isset($dados["imgMTPq"])) {
                move_uploaded_file($imgpq["tmp_name"], "../../Assets/carrossel/{$dados['imgMTPq']}");
                unlink("../../Assets/carrossel/$DA_imgpq");
            }
        }

        if (isset($imgAtualizarGd) && $imgAtualizarGd == true){
            if (isset($dados["imgMTGd"])) {
                move_uploaded_file($imggd["tmp_name"], "../../Assets/carrossel/{$dados['imgMTGd']}");
                unlink("../../Assets/carrossel/$DA_imggd");
            }
        }

        $log->setTexto("Imagenso do ID -" . $id . " foram atualizadas com sucesso\n");
        $log->fileWriter();
        ?>
            <form method="post" name="myForm" id="myForm" action="../View/carrosselList.php">
                <input type="hidden" name="msg" value="FR51">
            </form>

            <script>
                document.getElementById('myForm').submit();
            </script>
        <?php
    } else {
        $log->setTexto("Falha na atualização das imagens do ID -" . $id . "\n");
        $log->fileWriter();
        ?>
            <form method="post" name="myForm" id="myForm" action="../View/carrosselList.php">
                <input type="hidden" name="msg" value="FR30">
            </form>

            <script>
                document.getElementById('myForm').submit();
            </script>
        <?php
    }

}

if(isset($_REQUEST["carrossel_delete"])){
    require "../Model/log.class.php";
    require "../Model/ferramenta.class.php";
    $log = new Log();
    $ferramentas = new Ferramentas();

    require "../Model/manager.class.php";
    $manager = new Manager();

    $id = $_REQUEST["id"];
    $dados = $manager->CarrosselPuxar($id);
    unlink("../../Assets/carrossel/{$dados["imggd"]}");
    unlink("../../Assets/carrossel/{$dados["imgpq"]}");

    $res = $manager->carrosselDel($id);

    if($res == true){ 
        $log->setTexto("Imagens do carrossel do ID -" . $id . " foram deletadas com sucesso\n");
        $log->fileWriter();
        ?>
            <form method="post" name="myForm" id="myForm" action="../view/carrosselList.php">
                <input type="hidden" name="msg" value="BD54">
            </form>
            
            <script>
                document.getElementById('myForm').submit();
            </script>
        <?php

    }else{ 
        $log->setTexto("Falha na exclusão das Imagens do carrossel do ID -" . $id . " \n");
        $log->fileWriter();
        ?>
            <form method="post" name="myForm" id="myForm" action="../view/carrosselList.php">
                <input type="hidden" name="msg" value="BD04">
            </form>

            <script>
                document.getElementById('myForm').submit();
            </script>
            <?php
    }
}


//SERVIÇOS

if(isset($_POST["servico_new"])){
    require "../Model/log.class.php";
    require "../Model/ferramenta.class.php";
    $log = new Log();
    $ferramentas = new Ferramentas();

    require "../Model/manager.class.php";
    $manager = new Manager();

    $dados = array();
    $dados["nome"] = $_POST["nome"];
    $dados["sobre"] = $_POST["sobre"];
    $dados["serve"] = $_POST["serve"];
    $dados["preco"] = $_POST["preco"];
    $dados["status"] = $_POST["status"];

    $res = $manager->servicoNew($dados);

    if($res == true){
        $log->setTexto("Novo serviço criado - " . $dados["nome"] . "\n");
        $log->fileWriter();
        move_uploaded_file($video["tmp_name"], "../../Assets/servicos/{$dados['videoMT']}");
        move_uploaded_file($imgn1["tmp_name"], "../../Assets/servicos/{$dados['imgn1MT']}");
        move_uploaded_file($imgn2["tmp_name"], "../../Assets/servicos/{$dados['imgn2MT']}");
        move_uploaded_file($imgn3["tmp_name"], "../../Assets/servicos/{$dados['imgn3MT']}");
        move_uploaded_file($imgn4["tmp_name"], "../../Assets/servicos/{$dados['imgn4MT']}");
        ?>
            <form method="post" name="myForm" id="myForm" action="../View/servicoList.php">
                <input type="hidden" name="msg" value="BD50">
            </form>

            <script>
                document.getElementById('myForm').submit();
            </script>
        <?php
    } else {
        $log->setTexto("Falha na criação de um novo serviço\n");
        $log->fileWriter();
        ?>
            <form method="post" name="myForm" id="myForm" action="../View/servicoList.php">
                <input type="hidden" name="msg" value="BD02">
            </form>

            <script>
                document.getElementById('myForm').submit();
            </script>
        <?php
    }

}

if(isset($_REQUEST["servico_delete"])){
    require "../Model/log.class.php";
    require "../Model/ferramenta.class.php";
    $log = new Log();
    $ferramentas = new Ferramentas();

    require "../Model/manager.class.php";
    $manager = new Manager();

    $id = $_REQUEST["id"];
    
    $dados = $manager->servicoPuxar($id);
    $res = $manager->servicoDel($id);

    if($res == true){ 
        $log->setTexto("Serviço do ID -" . $id . " foi deletado com sucesso\n");
        $log->fileWriter();

        unlink("../../Assets/servicos/{$dados['imgn1']}");
        unlink("../../Assets/servicos/{$dados['imgn2']}");
        unlink("../../Assets/servicos/{$dados['imgn3']}");
        unlink("../../Assets/servicos/{$dados['imgn4']}");
        unlink("../../Assets/servicos/{$dados['video']}");

        ?>
            <form method="post" name="myForm" id="myForm" action="../view/servicoList.php">
                <input type="hidden" name="msg" value="BD54">
            </form>
            
            <script>
                document.getElementById('myForm').submit();
            </script>
        <?php

     }else{ 
        $log->setTexto("Falha na exclusão do serviço do ID -" . $id . " \n");
        $log->fileWriter();
        ?>
        <form method="post" name="myForm" id="myForm" action="../view/servicoList.php">
            <input type="hidden" name="msg" value="BD04">
        </form>

        <script>
            document.getElementById('myForm').submit();
        </script>
    <?php
     }
    
}



if(isset($_POST["servicoEdit"])){
    $dados = array();
    $id = $_POST["id"];
    $dados["nome"] = $_POST["nome"];
    $dados["sobre"] = $_POST["sobre"];
    $dados["serve"] = $_POST["serve"];
    $dados["preco"] = $_POST["preco"];
    $dados["status"] = $_POST["status"];
    $dados["id"] = $_POST["id"];

    $dados["altI1"] = $_POST["altI1"];
    $dados["altI2"] = $_POST["altI2"];
    $dados["altI3"] = $_POST["altI3"];
    $dados["altI4"] = $_POST["altI4"];

    include "../Model/ferramenta.class.php";
    include "../Model/log.class.php";
    include "../Model/manager.class.php";
    $ferramentas = new Ferramentas();
    $log = new Log();
    $manager = new Manager();

    // bagulho chatinho isso, n mexer em nada, por favor
    $img1Atualizar = false;
    $img2Atualizar = false;
    $img3Atualizar = false;
    $img4Atualizar = false;
    $videoAtualizar = false;

    $dadosAtuais = $manager->servicoPuxar($id);
    $DA_video = $dadosAtuais['video'];
    $DA_imgn1 = $dadosAtuais['imgn1'];
    $DA_imgn2 = $dadosAtuais['imgn2'];
    $DA_imgn3 = $dadosAtuais['imgn3'];
    $DA_imgn4 = $dadosAtuais['imgn4'];

    if (isset($_FILES["imgn1"]) && $_FILES["imgn1"]["error"] == 0) {
        $imgn1 = $_FILES["imgn1"];
        $img1Ext = $ferramentas->pegaExtensao($imgn1["name"]);
        $allowed = array("jpeg", "jpg", "png", "jfif");

        if (!in_array($img1Ext, $allowed)) {
            $log->setTexto("Extensão errada utilizada na atualização das imagens do ID-" . $id ."\n");
            $log->fileWriter();
            ?>
                <form method="post" name="myForm" id="myForm" action="../View/servicoList.php">
                    <input type="hidden" name="msg" value="FR19">
                </form>

                <script>
                    document.getElementById('myForm').submit();
                </script>
                <?php
            exit;
        }

        $dados["imgn1MT"] = "imgn1_" . $ferramentas->geradorMicroTime() . "." . $img1Ext;
        $img1Atualizar = true;
    }

    if (isset($_FILES["imgn2"]) && $_FILES["imgn2"]["error"] == 0) {
        $imgn2 = $_FILES["imgn2"];
        $img2Ext = $ferramentas->pegaExtensao($imgn2["name"]);
        $allowed = array("jpeg", "jpg", "png", "jfif");

        if (!in_array($img2Ext, $allowed)) {
            $log->setTexto("Extensão errada utilizada na atualização das imagens do ID-" . $id ."\n");
            $log->fileWriter();
            ?>
                <form method="post" name="myForm" id="myForm" action="../View/servicoList.php">
                    <input type="hidden" name="msg" value="FR19">
                </form>

                <script>
                    document.getElementById('myForm').submit();
                </script>
                <?php
            exit;
        }

        $dados["imgn2MT"] = "imgn2_" . $ferramentas->geradorMicroTime() . "." . $img2Ext;
        $img2Atualizar = true;
    }

    if (isset($_FILES["imgn3"]) && $_FILES["imgn3"]["error"] == 0) {
        $imgn3 = $_FILES["imgn3"];
        $img3Ext = $ferramentas->pegaExtensao($imgn3["name"]);
        $allowed = array("jpeg", "jpg", "png", "jfif");

        if (!in_array($img3Ext, $allowed)) {
            $log->setTexto("Extensão errada utilizada na atualização das imagens do ID-" . $id ."\n");
            $log->fileWriter();
            ?>
                <form method="post" name="myForm" id="myForm" action="../View/servicoList.php">
                    <input type="hidden" name="msg" value="FR19">
                </form>

                <script>
                    document.getElementById('myForm').submit();
                </script>
                <?php
            exit;
        }

        $dados["imgn3MT"] = "imgn3_" . $ferramentas->geradorMicroTime() . "." . $img3Ext;
        $img3Atualizar = true;
    }

    if (isset($_FILES["imgn4"]) && $_FILES["imgn4"]["error"] == 0) {
        $imgn4 = $_FILES["imgn4"];
        $img4Ext = $ferramentas->pegaExtensao($imgn4["name"]);
        $allowed = array("jpeg", "jpg", "png", "jfif");

        if (!in_array($img4Ext, $allowed)) {
            $log->setTexto("Extensão errada utilizada na atualização das imagens do ID-" . $id ."\n");
            $log->fileWriter();
            ?>
                <form method="post" name="myForm" id="myForm" action="../View/servicoList.php">
                    <input type="hidden" name="msg" value="FR19">
                </form>

                <script>
                    document.getElementById('myForm').submit();
                </script>
                <?php
            exit;
        }

        $dados["imgn4MT"] = "imgn4_" . $ferramentas->geradorMicroTime() . "." . $img4Ext;
        $img4Atualizar = true;
    }

    if (isset($_FILES["video"]) && $_FILES["video"]["error"] == 0) {
        $video = $_FILES["video"];
        $videoExt = $ferramentas->pegaExtensao($video["name"]);
        

        $dados["videoMT"] = "video_" . $ferramentas->geradorMicroTime() . "." . $videoExt;
        $videoAtualizar = true;
    }

    $dados["id"] = $id;
    $res = $manager->servicoEdit($dados);

    
    if ($res == true) {
        if ($img1Atualizar) {
            if (isset($dados["imgn1MT"])) {
                move_uploaded_file($imgn1["tmp_name"], "../../Assets/servicos/{$dados['imgn1MT']}");
                unlink("../../Assets/servicos/$DA_imgn1");
            }
        }
        
        if ($img2Atualizar) {
            if (isset($dados["imgn2MT"])) {
                move_uploaded_file($imgn2["tmp_name"], "../../Assets/servicos/{$dados['imgn2MT']}");
                unlink("../../Assets/servicos/$DA_imgn2");
            }
        }
        
        if ($img3Atualizar) {
            if (isset($dados["imgn3MT"])) {
                move_uploaded_file($imgn3["tmp_name"], "../../Assets/servicos/{$dados['imgn3MT']}");
                unlink("../../Assets/servicos/$DA_imgn3");
            }
        }
        
        if ($img4Atualizar) {
            if (isset($dados["imgn4MT"])) {
                move_uploaded_file($imgn4["tmp_name"], "../../Assets/servicos/{$dados['imgn4MT']}");
                unlink("../../Assets/servicos/$DA_imgn4");
            }
        }
        
        if ($videoAtualizar) {
            if (isset($dados["videoMT"])) {
                move_uploaded_file($video["tmp_name"], "../../Assets/servicos/{$dados['videoMT']}");
                unlink("../../Assets/servicos/$DA_video");
            }
        }

        $log->setTexto("Serviço do ID -" . $id . " foi atualizado\n");
        $log->fileWriter();
        ?>
            <form method="post" name="myForm" id="myForm" action="../View/servicoList.php">
                <input type="hidden" name="msg" value="BD53">
            </form>

            <script>
                document.getElementById('myForm').submit();
            </script>
        <?php
    } else {
        $log->setTexto("Falha na atualização do serviço ID -" . $id . "\n");
        $log->fileWriter();
        ?>
            <form method="post" name="myForm" id="myForm" action="../View/servicoList.php">
                <input type="hidden" name="msg" value="FR00">
            </form>

            <script>
                document.getElementById('myForm').submit();
            </script>
        <?php
    }
}

if(isset($_POST["mudarSenha"])){
    include "../Model/ferramenta.class.php";
    include "../Model/log.class.php";
    include "../Model/manager.class.php";

    $ferramentas = new Ferramentas();
    $log = new Log();
    $manager = new Manager();

    $resp[0] = $ferramentas->antiInjection($_POST["email"]);

    for ($i = 0;$i <= 0; $i++){
        if($resp[$i] == 0){
            $log->setTexto("Tentativa injection na área de Administrador\n");
            $log->fileWriter();
            ?>
                <form method="post" name="myForm" id="myForm" action="../index.php">
                    <input type="hidden" name="msg" value="FR27">
                </form>
                <script>
                    document.getElementById("myForm").submit();
                </script>
            <?php
            exit();
        }
    }

    $email = $_POST["email"];

    $resp = $manager->confirmEmailAdm($email);
    if(!$resp){
        $log->setTexto("Não existe ADM com o email \n");
        $log->fileWriter();
            ?>
                <form method="post" name="myForm" id="myForm" action="../index.php">
                    <input type="hidden" name="msg" value="FR27">
                </form>
                <script>
                    document.getElementById("myForm").submit();
                </script>
            <?php
            exit();
    }

    $resp = $manager->confirmChamadoEmailAdm($email);
    if($resp){
        $log->setTexto("Já existe um chamado para este administrador para mudança de senha\n");
        $log->fileWriter();
        ?>
            <form method="post" name="myForm" id="myForm" action="../index.php">
                <input type="hidden" name="msg" value="OA05">
            </form>
            <script>
                document.getElementById("myForm").submit();
            </script>
        <?php
        exit();

    }


    $resp = $manager->abrirChamadoSenha($email);

    if($resp){
        $log->setTexto("Chamado aberto para o adm\n");
        $log->fileWriter();
        ?>
            <form method="post" name="myForm" id="myForm" action="../index.php">
                <input type="hidden" name="msg" value="OA06">
            </form>
            <script>
                document.getElementById("myForm").submit();
            </script>
        <?php
        exit();
    } else {
        $log->setTexto("Não foi possivel abrir o chamado\n");
        $log->fileWriter();
        ?>
            <form method="post" name="myForm" id="myForm" action="../index.php">
                <input type="hidden" name="msg" value="OA06">
            </form>
            <script>
                document.getElementById("myForm").submit();
            </script>
        <?php
        exit();
    }
}

if(isset($_POST["mudarSenhaChamado"])){

    require "../../vendor/phpmailer/phpmailer/src/Exception.php";
    require "../../vendor/phpmailer/phpmailer/src/PHPMailer.php";
    require "../../vendor/phpmailer/phpmailer/src/SMTP.php";

    require "../Model/log.class.php";
    require "../Model/ferramenta.class.php";
    require "../Model/manager.class.php";
    require '../../vendor/autoload.php';

    $log = new Log();
    $ferramentas = new Ferramentas();
    $manager = new Manager();

    $email = $_POST["emailAdm"];
    $assunto = $_POST["assunto"];
    $id = $_POST["idAdm"];


    $pass1 = $_POST["pass1"];
    $pass2 = $_POST["pass2"];

    $resp[0] = $ferramentas->antiInjection($email);
    $resp[1] = $ferramentas->antiInjection($assunto);

    for ($i = 0;$i <= 1; $i++){
        if($resp[$i] == 0){
            $log->setTexto("Tentativa injection no chamado\n");
            $log->fileWriter();
            ?>
                <form method="get" name="myForm" id="myForm" action="../View/chamadosList.php">
                    <input type="hidden" name="msg" value="FR27">
                </form>
                <script>
                    document.getElementById("myForm").submit();
                </script>
            <?php
            exit();
        }
    }

    if($pass1 != $pass2){
        $log->setTexto("Senhas não são iguais na area de mudança de senha do chamado\n");
        $log->fileWriter();
        ?>
            <form method="get" name="myForm" id="myForm" action="../View/chamadosList.php">
                <input type="hidden" name="msg" value="FR27">
            </form>
            <script>
                document.getElementById("myForm").submit();
            </script>
        <?php
        exit();
    }

    $senhaCrip = $ferramentas->sha256($pass1);

    $resp = $manager->updateSenhaAdm($id,$email, $senhaCrip);

    if(!$resp){
        $log->setTexto("Não foi possivel alterar a senha\n");
        $log->fileWriter();
        ?>
            <form method="get" name="myForm" id="myForm" action="../View/chamadosList.php">
                <input type="hidden" name="msg" value="FR27">
            </form>
            <script>
                document.getElementById("myForm").submit();
            </script>
        <?php
        exit();
    }

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'enlace.tcc@gmail.com';
        $mail->Password   = 'dzja rsfw eqle xhfz';
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        $mail->setFrom('enlace.tcc@gmail.com', 'Enlace');
        $mail->addAddress($email); // Use o email do destinatário aqui

        $mail->isHTML(true);
        $mail->Subject = 'Mudança de senha';
        $mail->Body    = '
            Ola, senhor(a) do email '. $email .', viemos informar que sua senha foi alterada com sucesso!<br><br>
            
            A sua nova senha é <b> '. $pass1 .'</b>

        ';
        $mail->AltBody = 'Conteúdo em texto simples';

        $mail->send();

        $log->setTexto("Chamado do adm efetuado com sucesso\n");
        $log->fileWriter();

        ?>
        <form method="post" name="myForm" id="myForm" action="../View/chamadosList.php">
            <input type="hidden" name="msg" value="FR52">
        </form>
        <script>
            document.getElementById("myForm").submit();
        </script>
        <?php
        exit();
        
    } catch (Exception $e) {
        echo "Falha ao enviar e-mail: {$mail->ErrorInfo}";
    }


}

if(isset($_POST["contato"])){
    require "../Model/log.class.php";
    require "../Model/ferramenta.class.php";
    require "../Model/manager.class.php";

    $log = new Log();
    $ferramentas = new Ferramentas();
    $manager = new Manager();

    $resp[0] = $ferramentas->antiInjection($_POST["nome"]);
    $resp[1] = $ferramentas->antiInjection($_POST["email"]);
    $resp[2] = $ferramentas->antiInjection($_POST["telefone"]);
    $resp[3] = $ferramentas->antiInjection($_POST["assunto"]);
    $resp[4] = $ferramentas->antiInjection($_POST["mensagem"]);

    for ($i = 0;$i <= 4; $i++){
        if($resp[$i] == 0){
            $log->setTexto("Tentativa injection no chamado\n");
            $log->fileWriter();
            ?>
                <form method="post" name="myForm" id="myForm" action="../../index.php">
                    <input type="hidden" name="msg" value="FR27">
                </form>
                <script>
                    document.getElementById("myForm").submit();
                </script>
            <?php
            exit();
        }
    }

    $dados = array();
    $dados["nome"] = $_POST["nome"];
    $dados["email"] = $_POST["email"];
    $dados["telefone"] = $_POST["telefone"];
    $dados["assunto"] = $_POST["assunto"];
    $dados["mensagem"] = $_POST["mensagem"];

    $res = $manager->contatoNew($dados);

    if($res){
        $log->setTexto("Contato enviado com sucesso\n");
        $log->fileWriter();
        ?>
            <form method="post" name="myForm" id="myForm" action="../../paginas/contatos.php">
                <input type="hidden" name="msg" value="FR50">
            </form>
            <script>
                document.getElementById("myForm").submit();
            </script>
        <?php
        exit();
    } else {
        $log->setTexto("Falha no envio do contato\n");
        $log->fileWriter();
        ?>
            <form method="post" name="myForm" id="myForm" action="../../paginas/contatos.php">
                <input type="hidden" name="msg" value="FR00">
            </form>
            <script>
                document.getElementById("myForm").submit();
            </script>
        <?php
        exit();
    }
}

if(isset($_POST["mudarStatusContato"])){
    require "../Model/log.class.php";
    require "../Model/ferramenta.class.php";
    require "../Model/manager.class.php";

    $log = new Log();
    $ferramentas = new Ferramentas();
    $manager = new Manager();

    $id = $_POST["id"];
    $statusChange = $_POST["statusChange"];

    $res = $manager->mudarStatusContato($id, $statusChange);

    if($res){
        $log->setTexto("Status do contato alterado com sucesso\n");
        $log->fileWriter();
        ?>
            <form method="post" name="myForm" id="myForm" action="../View/contatoList.php">
                <input type="hidden" name="msg" value="0">
            </form>
            <script>
                document.getElementById("myForm").submit();
            </script>
        <?php
        exit();
    } else {
        $log->setTexto("Falha na mudança do status do contato\n");
        $log->fileWriter();
        ?>
            <form method="post" name="myForm" id="myForm" action="../View/contatoList.php">
                <input type="hidden" name="msg" value="0">
            </form>
            <script>
                document.getElementById("myForm").submit();
            </script>
        <?php
        exit();
    }
}

if(isset($_REQUEST["avaliDel"])){
    require "../Model/log.class.php";
    require "../Model/ferramenta.class.php";
    require "../Model/manager.class.php";

    $log = new Log();
    $ferramentas = new Ferramentas();
    $manager = new Manager();

    $id = $_REQUEST["id"];

    $resp = $manager->avaliDel($id);

    if($resp || $resp == 1){
        $log->setTexto("Avaliação apagada com sucesso\n");
        $log->fileWriter();
        ?>
            <form method="post" name="myForm" id="myForm" action="../View/avaliacaoList.php">
                <input type="hidden" name="msg" value="BD54">
            </form>
            <script>
                document.getElementById("myForm").submit();
            </script>
        <?php
        exit();
    } else {
        $log->setTexto("Falha na apagação da avaliação\n");
        $log->fileWriter();
        ?>
            <form method="post" name="myForm" id="myForm" action="../View/avaliacaoList.php">
                <input type="hidden" name="msg" value="BD04">
            </form>
            <script>
                document.getElementById("myForm").submit();
            </script>
        <?php
        exit();
    }
}

if(isset($_REQUEST["int_delete"])){
    require "../Model/log.class.php";
    require "../Model/ferramenta.class.php";
    require "../Model/manager.class.php";

    $log = new Log();
    $ferramentas = new Ferramentas();
    $manager = new Manager();

    $id = $_REQUEST["id"];

    $resp = $manager->intDel($id);

    if($resp || $resp == 1){
        $log->setTexto("Avaliação apagada com sucesso\n");
        $log->fileWriter();
        ?>
            <form method="post" name="myForm" id="myForm" action="../View/intList.php">
                <input type="hidden" name="msg" value="BD54">
            </form>
            <script>
                document.getElementById("myForm").submit();
            </script>
        <?php
        exit();
    } else {
        $log->setTexto("Falha na apagação da avaliação\n");
        $log->fileWriter();
        ?>
            <form method="post" name="myForm" id="myForm" action="../View/intList.php">
                <input type="hidden" name="msg" value="BD04">
            </form>
            <script>
                document.getElementById("myForm").submit();
            </script>
        <?php
        exit();
    }
}



























?>