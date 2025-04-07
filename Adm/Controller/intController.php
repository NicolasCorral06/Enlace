<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


if(isset($_POST["puxar_session"])){
    require "../Model/log.class.php";
    require "../Model/ferramenta.class.php";
    require "../Model/manager.class.php";
    require '../../vendor/autoload.php';

    $log = new Log();
    $ferramentas = new Ferramentas();
    $manager = new Manager();


    $dados = array();
    $$dados["id"] = $_POST["id"];
    
    $dados = $manager->intPuxar($dados);

    $_SESSION["id_int"] = $dados["id"];
    $_SESSION["nome_int"] = $dados["nome"];
    $_SESSION["email_int"] = $dados["email"];
    $_SESSION["status_int"] = $dados["status"];

    ?>
        <form method="get" name="myForm" id="myForm" action="../../Interprete/View/interprete.php"> 
            <input type="hidden" name="" value="">
        </form>

        <script>    
            document.getElementById("myForm").submit();
        </script>
    <?php

}


if(isset($_POST["intLogin"])){
    
    require "../Model/log.class.php";
    $log = new Log();
    if (isset($_SESSION['id_int'])){ 
        session_destroy();
        ?>
            <form method="post" name="myForm" id="myForm" action="../../Interprete/interpreteLogin.php"> 
                <input type="hidden" name="msg" value="OA04">
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
            $log->setTexto("Tentativa injection na área de Interprete\n");
            $log->fileWriter();
            //to comparando para ver se em algum $resp tem injection
            ?>
                <form method="post" name="myForm" id="myForm" action="../../Interprete/interpreteLogin.php">
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
    $dados = $manager->intVerificar($dados);
    //to usando $dados para puxar todas as informações que eu pedi da function

    if($dados['result'] == 0){
        $log->setTexto("Tentativa de acesso sem exito na área de Interprete\n");
        $log->fileWriter();
        ?> 
            <form method="post" name="myForm" id="myForm" action="../../Interprete/interpreteLogin.php">
                <input type="hidden" name="msg" value="FR02">
            </form>
            <script>
                document.getElementById("myForm").submit();
            </script>
        <?php
        exit();
    }

    $_SESSION["id_int"] = $dados["id"];
    $_SESSION["nome_int"] = $dados["nome"];
    $_SESSION["email_int"] = $dados["email"];
    $_SESSION["status_int"] = $dados["status"];

    
    $log->setTexto(" {$dados['email']} logou com exito na área de Interprete \n");
    $log->fileWriter();

    ?>
        <form method="post" name="myForm" id="myForm" action="../../Interprete/View/interprete.php">
            <input type="hidden" name="msg" value="0">
        </form>
        <script>
            document.getElementById("myForm").submit();
        </script>
    <?php
}


if(isset($_POST["interpreteCadastrar"])){
    require "../Model/log.class.php";
    require "../Model/ferramenta.class.php";
    require "../Model/manager.class.php";

    $config = require '../Model/api.php';
    $secret_key = $config['secret_key'];

    $log = new Log();
    $ferramentas = new Ferramentas(); 
    $manager = new Manager();

    if (isset($_SESSION['id_int'])){ 
        session_destroy();
        ?>       
            <form method="post" name="myForm" id="myForm" action="../../Interprete/interpreteCadastro.php"> 
                <input type="hidden" name="msg" value="OA04">
            </form>

            <script>    
                document.getElementById("myForm").submit();
            </script>
        <?php
        exit();
    }

    
    $data = array(
        'secret' => $secret_key,
        'response' => $_POST['h-captcha-response']
    );
    
    $verify = curl_init();
    curl_setopt($verify, CURLOPT_URL, "https://hcaptcha.com/siteverify");
    curl_setopt($verify, CURLOPT_POST, true);
    curl_setopt($verify, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($verify);
    if ($response === false) {
        // erro durante a requisição
        ?>
            <form method="post" name="myForm" id="myForm" action="../../Interprete/interpreteCadastro.php">
                <input type="hidden" name="msg" value="FR30">
            </form>
            <script>
                document.getElementById('myForm').submit();
            </script>
        <?php
        exit();
    }

    $responseData = json_decode($response, true);
    if ($responseData === null) {
        // resposta não é um JSON válido
        ?>
            <form method="post" name="myForm" id="myForm" action="../../Interprete/interpreteCadastro.php">
                <input type="hidden" name="msg" value="FR31">
            </form>
            <script>
                document.getElementById('myForm').submit();
            </script>
        <?php
        exit();
    }

    if (!$responseData['success']) {
        // deu erro fi
        ?>
            <form method="post" name="myForm" id="myForm" action="../../Interprete/interpreteCadastro.php">
                <input type="hidden" name="msg" value="FR29">
            </form>
            <script>
                document.getElementById('myForm').submit();
            </script>
        <?php
        exit();
    }
    
    $dados = array();

    $video = $_FILES["video"];
    $cv = $_FILES["curriculo"];

    $videoExt = $ferramentas->pegaExtensao($video["name"]);
    $cvExt = $ferramentas->pegaExtensao($cv["name"]);
    $allowedC = array("pdf");
    $allowedV = array("mp4");

    //MT curriculo
    if(!in_array($cvExt, $allowedC)){
        $log->setTexto("Extensão errada usada no upload de CV\n");
        $log->fileWriter();
        ?>
            <form method="post" name="myForm" id="myForm" action="../../Interprete/interpreteCadastro.php">
                <input type="hidden" name="msg" value="FR19">
            </form>

            <script>
                document.getElementById('myForm').submit();
            </script>
        <?php
        exit();
    } else {
        //MT = micro time
        $dados["cvMT"] = "cv_" . $ferramentas->geradorMicroTime() . "." . $cvExt;
    }

    //MT video  
    if(!in_array($videoExt, $allowedV)){
        $log->setTexto("Extensão errada usada no upload do video\n");
        $log->fileWriter();
        ?>
            <form method="post" name="myForm" id="myForm" action="../../Interprete/interpreteCadastro.php">
                <input type="hidden" name="msg" value="FR19">
            </form>

            <script>
                document.getElementById('myForm').submit();
            </script>
        <?php
        exit();
    } else {
        //MT = micro time
        $dados["videoMT"] = "video_" . $ferramentas->geradorMicroTime() . "." . $videoExt;
    }

    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $telefone = $_POST["telefone"];
    $cpf = $_POST["cpf"];
    $nasc = $_POST["nasc"];
    $estado = "";
    $cidade = $_POST["cidade"];

    $senha1 = $_POST["senha1"];
    $senha2 = $_POST["senha2"];

    if($senha1 != $senha2){
        ?>
            <form method="post" name="myForm" id="myForm" action="../../Interprete/interpreteCadastro.php">
                <input type="hidden" name="msg" value="FR04">
            </form>

            <script>
                document.getElementById('myForm').submit();
            </script>
        <?php
        exit();
    }

    $resp[0] = $ferramentas->antiInjection($nome);
    $resp[1] = $ferramentas->antiInjection($email);
    $resp[2] = $ferramentas->antiInjection($telefone);
    $resp[3] = $ferramentas->antiInjection($nasc);
    $resp[4] = $ferramentas->antiInjection($senha1);
    $resp[5] = $ferramentas->antiInjection($estado);
    $resp[6] = $ferramentas->antiInjection($cidade);

    for ($i = 0;$i <= 6; $i++){
        if($resp[$i] == 0){
            $log->setTexto("Tentativa injection no cadastro do Interprete\n");
            $log->fileWriter();
            ?>
                <form method="post" name="myForm" id="myForm" action="../../Interprete/interpreteCadastro.php">
                    <input type="hidden" name="msg" value="FR27">
                </form>
                <script>
                    document.getElementById("myForm").submit();
                </script>
            <?php
            exit();
        }
    }

    $senhaCrip = $ferramentas->sha256($senha1);

    $dados["nome"] = $nome;
    $dados["email"] = $email;
    $dados["telefone"] = $telefone;
    $dados["nasc"] = $nasc;
    $dados["cpf"] = $cpf;
    $dados["estado"] = $estado;
    $dados["cidade"] = $cidade;
    $dados["senha"] = $senhaCrip;

    
    $resp = $manager->intVerificarCadastro($dados);

    if($resp == 1){
        $log->setTexto("Conta ja existente\n");
        $log->fileWriter();
            ?>
                <form method="post" name="myForm" id="myForm" action="../../Interprete/interpreteCadastro.php">
                    <input type="hidden" name="msg" value="FR28">
                </form>
                <script>
                    document.getElementById("myForm").submit();
                </script>
            <?php
            exit();
    }

    $res = $manager->intNew_TEMP($dados);
    if($res == true){
        move_uploaded_file($cv["tmp_name"], "../../Assets/Interprete/{$dados['cvMT']}");
        move_uploaded_file($video["tmp_name"], "../../Assets/Interprete/{$dados['videoMT']}");
        $log->setTexto("Interprete temporario {$dados['email']} criado com sucesso\n");
        $log->fileWriter();
            ?>
                <form method="post" name="myForm" id="myForm" action="../../index.php">
                    <input type="hidden" name="msgA" value="OP52">
                </form>
                <script>
                    document.getElementById("myForm").submit();
                </script>
            <?php
            exit();
    } else {
        $log->setTexto("Erro na falha de criação do interprete temporario\n");
        $log->fileWriter();
            ?>
                <form method="post" name="myForm" id="myForm" action="../../Interpete/interpreteCadastro.php">
                    <input type="hidden" name="msg" value="FR28">
                </form>
                <script>
                    document.getElementById("myForm").submit();
                </script>
            <?php
            exit();
    }
            
}

if (isset($_POST["intAprovado"])) {

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

    $id = $_POST["id"];
    $email = $_POST["email"];
    $nome = $_POST["nome"];

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = '';//email da empresa
        $mail->Password   = '';//senha do google
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        $mail->setFrom('', '');//email da empresa e nome
        $mail->addAddress($email, $nome); // Use o email do destinatário aqui

        $mail->isHTML(true);
        $mail->Subject = 'Retorno do seu cadasstro';
        $mail->Body    = '
            Ola, senhor(a) '. $nome .', viemos por esse email avisar que você foi <b>APROVADO(A)</b>! <br> Entre em nosso site e termine de se cadastrar 

        ';
        $mail->AltBody = 'Conteúdo em texto simples';

        $mail->send();

        // Move o código abaixo para cá, após o envio do e-mail
        $resp = $manager->intTEMP_para_int($id);
        if ($resp == true) {
            $log->setTexto("Interprete temporario->interprete foi bem sucedido\n");
            $log->fileWriter();

            ?>
            <form method="post" name="myForm" id="myForm" action="../View/intConfirmacao.php">
                <input type="hidden" name="msg" value="FR52">
            </form>
            <script>
                document.getElementById("myForm").submit();
            </script>
            <?php
            exit();
        }
    } catch (Exception $e) {
        echo "Falha ao enviar e-mail: {$mail->ErrorInfo}";
    }
}

if(isset($_POST["intNegado"])){
   
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

    $id = $_POST["id"];
    $email = $_POST["email"];
    $nome = $_POST["nome"];

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = '';//email da empresa
        $mail->Password   = '';//senha do google
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        $mail->setFrom('', '');//email da empresa e nome
        $mail->addAddress($email, $nome); // Use o email do destinatário aqui

        $mail->isHTML(true);
        $mail->Subject = 'Retorno do seu cadasstro';
        $mail->Body    = '
            Ola, senhor(a) '. $nome .', viemos por esse email avisar que você foi <b>NEGADO(A)</b>! <br> Sentimos muito por essa decição, porem você é mais do que um sim ou um não. Desejamos a você uma boa sorte no seu futuro!  

        ';
        $mail->AltBody = 'Conteúdo em texto simples';

        $mail->send();

        // Move o código abaixo para cá, após o envio do e-mail
        $resp = $manager->int_TEMPDel($id);
        if ($resp == true) {
            $log->setTexto("Interprete temporario negado\n");
            $log->fileWriter();

            ?>
            <form method="post" name="myForm" id="myForm" action="../View/intConfirmacao.php">
                <input type="hidden" name="msg" value="OP50">
            </form>
            <script>
                document.getElementById("myForm").submit();
            </script>
            <?php
            exit();
        }
    } catch (Exception $e) {
        echo "Falha ao enviar e-mail: {$mail->ErrorInfo}";
    }
}


if(isset($_POST["contInt"])){
    require "../Model/log.class.php";
    require "../Model/ferramenta.class.php";
    require "../Model/manager.class.php";
    require '../../vendor/autoload.php';
    $log = new Log();
    $ferramentas = new Ferramentas();
    $manager = new Manager();
    
    $dados = array();
    $dados["id"] = $_POST["id"];

    $ff = $_FILES["ff"];
    $fv = $_FILES["fv"];
    $cr = $_FILES["cr"];
    $ct = $_FILES["ct"];
    $cac = $_FILES["cac"];

    $dados["b1"] = $_POST["b1"];
    $dados["b2"] = $_POST["b2"];
    $dados["b3"] = $_POST["b3"];

    $ffExt = $ferramentas->pegaExtensao($ff["name"]);
    $dados["ffMT"] = "ff_" . $ferramentas->geradorMicroTime() . "." . $ffExt;
    $fvExt = $ferramentas->pegaExtensao($fv["name"]);
    $dados["fvMT"] = "fv_" . $ferramentas->geradorMicroTime() . "." . $fvExt;
    $crExt = $ferramentas->pegaExtensao($cr["name"]);
    $dados["crMT"] = "cr_" . $ferramentas->geradorMicroTime() . "." . $crExt;
    $ctExt = $ferramentas->pegaExtensao($ct["name"]);
    $dados["ctMT"] = "ct_" . $ferramentas->geradorMicroTime() . "." . $ctExt;

    $cacExt = $ferramentas->pegaExtensao($cac["name"]);
    if(!empty($cacExt)){
        $dados["cacMT"] = "cac_" . $ferramentas->geradorMicroTime() . "." . $cacExt;
    } else {
        $dados["cacMT"] = "";
    }
        
    $res = $manager->interprete_documentos_temp($dados);
    if($res == true){
        move_uploaded_file($ff["tmp_name"], "../../Assets/Interprete/dados_pessoais/{$dados['ffMT']}");
        move_uploaded_file($fv["tmp_name"], "../../Assets/Interprete/dados_pessoais/{$dados['fvMT']}");
        move_uploaded_file($cr["tmp_name"], "../../Assets/Interprete/dados_pessoais/{$dados['crMT']}");
        move_uploaded_file($ct["tmp_name"], "../../Assets/Interprete/dados_pessoais/{$dados['ctMT']}");

        if($dados["cacMT"] != ""){
            move_uploaded_file($cac["tmp_name"], "../../Assets/Interprete/dados_pessoais/{$dados['cacMT']}");
        }
            
        
        $log->setTexto("dados pessoais do Interprete temporario {$dados['email']} criado com sucesso\n");
        $log->fileWriter();
            ?>
                <form method="post" name="myForm" id="myForm" action="../../Interprete/View/finCadastro.php">
                    <input type="hidden" name="msg" value="FR52">
                </form>
                <script>
                    document.getElementById("myForm").submit();
                </script>
            <?php
            exit();
    } else {
        $log->setTexto("Erro na falha de criação dos dados pessoais do interprete temporario\n");
        $log->fileWriter();
            ?>
                <form method="post" name="myForm" id="myForm" action="../../Interpete/View/interprete.php">
                    <input type="hidden" name="msg" value="FR28">
                </form>
                <script>
                    document.getElementById("myForm").submit();
                </script>
            <?php
            exit();
    }
}

if(isset($_POST["finInt"])){
    require "../Model/log.class.php";
    require "../Model/ferramenta.class.php";
    require "../Model/manager.class.php";
    require '../../vendor/autoload.php';
    $log = new Log();
    $ferramentas = new Ferramentas();
    $manager = new Manager();
    
    $dados = array();
    $dados["id_int"] = $_POST["id"];

    $fp = $_FILES["fp"];
    $va = $_FILES["va"];

    $dados["tv"] = $_POST["tv"];
    $dados["formacao"] = $_POST["formacao"];
    $dados["te"] = $_POST["te"];
    $dados["genero"] = $_POST["genero"];
    $dados["corRaca"] = $_POST["corRaca"];

    $fpExt = $ferramentas->pegaExtensao($fp["name"]);
    $dados["fpMT"] = "fp_" . $ferramentas->geradorMicroTime() . "." . $fpExt;
    $vaExt = $ferramentas->pegaExtensao($va["name"]);
    $dados["vaMT"] = "video_" . $ferramentas->geradorMicroTime() . "." . $vaExt;
    
    $res = $manager->interprete_perfil_temp($dados);
    if($res == true){
        
        move_uploaded_file($fp["tmp_name"], "../../Assets/Interprete/perfil/{$dados['fpMT']}");
        move_uploaded_file($va["tmp_name"], "../../Assets/Interprete/perfil/{$dados['vaMT']}");
        
        $log->setTexto("Perfil do Interprete temporario {$dados['id_int']} criado com sucesso\n");
        $log->fileWriter();
            ?>
                <form method="post" name="myForm" id="myForm" action="../../Interprete/View/interprete.php">
                    <input type="hidden" name="msg" value="FR501">
                </form>
                <script>
                    document.getElementById("myForm").submit();
                </script>
            <?php
            exit();
    } else {
        $log->setTexto("Erro na falha de criação doo perfil do interprete temporario\n");
        $log->fileWriter();
            ?>
                <form method="post" name="myForm" id="myForm" action="../../Interpete/view/interprete.php">
                    <input type="hidden" name="msg" value="FR28">
                </form>
                <script>
                    document.getElementById("myForm").submit();
                </script>
            <?php
            exit();
    }
}

//INTDP VERIFY
if(isset($_POST["intDPAprovado"])){
    require "../Model/log.class.php";
    require "../Model/ferramenta.class.php";
    require "../Model/manager.class.php";

    $log = new Log();
    $ferramentas = new Ferramentas();
    $manager = new Manager();

    $id = $_POST["id"];
   
    $resp = $manager->intDPTEMP_para_intDP($id);

    if($resp == 10){
        $log->setTexto("Todos os dados do interrpete foram aprovados. ID interprete{". $id ."}\n");
        $log->fileWriter();

        ?>
            <form method="post" name="myForm" id="myForm" action="../View/intConfirmacaoP.php">
                <input type="hidden" name="msg" value="FR52">
            </form>
            <script>
                document.getElementById("myForm").submit();
            </script>
            <?php
            exit();
    }

    if ($resp == true) {
        $log->setTexto("InterpreteDP temporario->interpreteDP foi bem sucedido\n");
        $log->fileWriter();

        ?>
            <form method="post" name="myForm" id="myForm" action="../View/intConfirmacaoDP.php">
                <input type="hidden" name="msg" value="FR52">
            </form>
            <script>
                document.getElementById("myForm").submit();
            </script>
            <?php
            exit();
    }
}

if(isset($_POST["intDPNegado"])){
    require "../Model/log.class.php";
    require "../Model/ferramenta.class.php";
    require "../Model/manager.class.php";

    $log = new Log();
    $ferramentas = new Ferramentas();
    $manager = new Manager();

    $id = $_POST["id"];
   
    $resp = $manager->intDPTEMP_para_intDP($id);

    if ($resp == true) {
        $log->setTexto("InterpreteDP temporario->interpreteDP foi bem sucedido\n");
        $log->fileWriter();

        ?>
            <form method="post" name="myForm" id="myForm" action="../View/intConfirmacaoDP.php">
                <input type="hidden" name="msg" value="FR52">
            </form>
            <script>
                document.getElementById("myForm").submit();
            </script>
            <?php
            exit();
    }
}


//INTP VERIFY
if(isset($_POST["intPAprovado"])){
    require "../Model/log.class.php";
    require "../Model/ferramenta.class.php";
    require "../Model/manager.class.php";

    $log = new Log();
    $ferramentas = new Ferramentas();
    $manager = new Manager();

    $id = $_POST["id"];
   
    $resp = $manager->intPTEMP_para_intP($id);

    if($resp == 10){
        $log->setTexto("Todos os dados do interrpete foram aprovados. ID interprete{". $id ."}\n");
        $log->fileWriter();

        ?>
            <form method="post" name="myForm" id="myForm" action="../View/intConfirmacaoP.php">
                <input type="hidden" name="msg" value="FR52">
            </form>
            <script>
                document.getElementById("myForm").submit();
            </script>
            <?php
            exit();
    }

    if ($resp == true) {
        $log->setTexto("InterpreteP temporario->interpreteP foi bem sucedido\n");
        $log->fileWriter();

        ?>
            <form method="post" name="myForm" id="myForm" action="../View/intConfirmacaoP.php">
                <input type="hidden" name="msg" value="FR52">
            </form>
            <script>
                document.getElementById("myForm").submit();
            </script>
            <?php
            exit();
    }
}

if(isset($_POST["intPNegado"])){
    require "../Model/log.class.php";
    require "../Model/ferramenta.class.php";
    require "../Model/manager.class.php";

    $log = new Log();
    $ferramentas = new Ferramentas();
    $manager = new Manager();

    $id = $_POST["id"];
   
    $resp = $manager->intDPTEMP_para_intDP($id);
    if ($resp == true) {
        $log->setTexto("InterpreteDP temporario->interpreteDP foi bem sucedido\n");
        $log->fileWriter();

        ?>
            <form method="post" name="myForm" id="myForm" action="../View/intConfirmacaoP.php">
                <input type="hidden" name="msg" value="FR52">
            </form>
            <script>
                document.getElementById("myForm").submit();
            </script>
            <?php
            exit();
    }
}

if(isset($_POST["intServicos"])){
    require "../Model/log.class.php";
    require "../Model/ferramenta.class.php";
    require "../Model/manager.class.php";

    $log = new Log();
    $ferramentas = new Ferramentas();
    $manager = new Manager();

    $dados = array();

    if(isset($_POST["atualizarIS"]) && $_POST["atualizarIS"] == true ){
        $dados["id_int"] = $_POST["id"];

        $servicosCOMint = $_POST["servicosCOMint"];

        $res = $manager->intEservicoAtualizar($dados, $servicosCOMint);

        if($res == 1){
            $log->setTexto("Serviços atualizados na tabela do interprete\n");
            $log->fileWriter();
            ?>
                <form method="post" name="myForm" id="myForm" action="../../Interprete/View/interprete.php">
                    <input type="hidden" name="msg" value="BD51">
                </form>
                <script>
                    document.getElementById("myForm").submit();
                </script>
            <?php
            exit();
        } else {
            $log->setTexto("Serviços atualizados na tabela do interprete\n");
            $log->fileWriter();
        }

    }

   
    //dados do interprete
    $dados["id_int"] = $_POST["id"];

    $servicosCOMint = $_POST["servicosCOMint"];
    $id = $_POST["id"];

    $res = $manager->intEservico($dados, $servicosCOMint);

    if($res){
        $log->setTexto("Serviços adicionados na tabela do interprete\n");
        $log->fileWriter();
        ?>
            <form method="post" name="myForm" id="myForm" action="../../Interprete/View/interprete.php">
                <input type="hidden" name="msg" value="BD51">
            </form>
            <script>
                document.getElementById("myForm").submit();
            </script>
        <?php
        exit();
    } else {

    }
}


if(isset($_POST["intPedit"])){
    include "../Model/ferramenta.class.php";
    include "../Model/log.class.php";
    include "../Model/manager.class.php";

    $ferramentas = new Ferramentas();
    $log = new Log();
    $manager = new Manager();

    $dados = array();
    $id = $_POST["id_int"];
    $dados["id"] = $_POST["id"];
    $dados["id_int"] = $_POST["id_int"];
    $dados["texto_apre"] = $_POST["texto_apre"];
    $dados["formacao"] = $_POST["formacao"];
    $dados["tempo_exp"] = $_POST["tempo_exp"];
    $dados["genero"] = $_POST["genero"];
    $dados["corRaca"] = $_POST["corRaca"];
    
    // bagulho chatinho isso, n mexer em nada, por favor
    $fotoPAtualizar = false;
    $videoAtualizar = false;

    $dadosAtuais = $manager->intPpuxar($id);
    $DA_foto = $dadosAtuais['foto_perfil'];
    $DA_video = $dadosAtuais['video_apre'];

    if (isset($_FILES["foto_perfil"]) && $_FILES["foto_perfil"]["error"] == 0) {
        $foto_perfil = $_FILES["foto_perfil"];
        $fotoPerfilExt = $ferramentas->pegaExtensao($foto_perfil["name"]);
        $allowed = array("jpeg", "jpg", "png", "jfif");

        if (!in_array($fotoPerfilExt, $allowed)) {
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

        $dados["fotoPerfilMT"] = "fp_" . $ferramentas->geradorMicroTime() . "." . $fotoPerfilExt;
        $fotoPAtualizar = true;
    }

    if (isset($_FILES["video"]) && $_FILES["video"]["error"] == 0) {
        $video = $_FILES["video"];
        $videoExt = $ferramentas->pegaExtensao($video["name"]);
        
        $dados["videoMT"] = "video_" . $ferramentas->geradorMicroTime() . "." . $videoExt;
        $videoAtualizar = true;
    }

    $res = $manager->intPEdit($dados);

    if ($res == true) {
        if ($fotoPAtualizar) {
            if (isset($dados["fotoPerfilMT"])) {
                move_uploaded_file($foto_perfil["tmp_name"], "../../Assets/interprete/perfil/{$dados['fotoPerfilMT']}");
                unlink("../../Assets/interprete/perfil/$DA_foto");
            }
        }
        
        if ($videoAtualizar) {
            if (isset($dados["videoMT"])) {
                move_uploaded_file($video["tmp_name"], "../../Assets/interprete/perfil/{$dados['videoMT']}");
                unlink("../../Assets/interprete/perfil/$DA_video");
            }
        }

        $log->setTexto("Interprete perfil do ID_INT -" . $id . " foi atualizado\n");
        $log->fileWriter();
        ?>
            <form method="post" name="myForm" id="myForm" action="../../interprete/view/interprete.php">
                <input type="hidden" name="msg" value="BD53">
            </form>

            <script>
                document.getElementById('myForm').submit();
            </script>
        <?php
    } else {
        $log->setTexto("Falha na atualização do INTERPRETE ID_INT -" . $id . "\n");
        $log->fileWriter();
        ?>
            <form method="post" name="myForm" id="myForm" action="../../interprete/view/interprete.php">
                <input type="hidden" name="msg" value="FR00">
            </form>

            <script>
                document.getElementById('myForm').submit();
            </script>
        <?php
    }
}


if(isset($_POST["alterarSenha"])){
    include "../Model/ferramenta.class.php";
    include "../Model/log.class.php";
    include "../Model/manager.class.php";

    $ferramentas = new Ferramentas();
    $log = new Log();
    $manager = new Manager();

    $senha1 = $_POST["senha1"];
    $senha2 = $_POST["senha2"];
    $id = $_POST["id_int"];

  

    if ($senha1 != $senha2) {
        $log->setTexto("As senhas nao coincidem\n");
        $log->fileWriter();
        ?>
            <form method="post" name="myForm" id="myForm" action="../../interprete/view/interprete.php">
                <input type="hidden" name="msg" value="FR00">
            </form>

            <script>
                document.getElementById('myForm').submit();
            </script>
        <?php
        exit();
    }

    $dados = array();
    $dados["id"] = $id;
    $dados["senhaCrip"] = $ferramentas->sha256($senha1);

    $res = $manager->intAlterarSenha($dados);

    if ($res == true) {
        $log->setTexto("Senha do ID_INT -" . $id . " foi alterada\n");
        $log->fileWriter();
        ?>
            <form method="post" name="myForm" id="myForm" action="../../interprete/view/interprete.php">
                <input type="hidden" name="msg" value="BD53">
            </form>

            <script>
                document.getElementById('myForm').submit();
            </script>
        <?php
    } else {
        $log->setTexto("Falha na alteracao da senha do INTERPRETE ID_INT -" . $id . "\n");
        $log->fileWriter();
        ?>
            <form method="post" name="myForm" id="myForm" action="../../interprete/view/interprete.php">
                <input type="hidden" name="msg" value="FR00">
            </form>

            <script>
                document.getElementById('myForm').submit();
            </script>
        <?php
    }


}


if(isset($_POST["intEdit"])){
    include "../Model/ferramenta.class.php";
    include "../Model/log.class.php";
    include "../Model/manager.class.php";

    $ferramentas = new Ferramentas();
    $log = new Log();
    $manager = new Manager();

    $dados = array();
    $id = $_POST["id_int"];
    $dados["id"] = $_POST["id_int"];
    $dados["nome"] = $_POST["nome"];
    $dados["email"] = $_POST["email"];
    $dados["telefone"] = $_POST["telefone"];
    $dados["nascimento"] = $_POST["nascimento"];
    $dados["cidade"] = $_POST["cidade"];
    
    // bagulho chatinho isso, n mexer em nada, por favor
    $videoAtualizar = false;
    $fotoAtualizar = false;

    $dadosAtuais = $manager->intPuxar($dados);
    $fotoAtual = $manager->intPuxarFoto($id);

    $DA_foto = $fotoAtual["foto_perfil"];
    $DA_video = $dadosAtuais['video'];

    if (isset($_FILES["video"]) && $_FILES["video"]["error"] == 0) {
        $video = $_FILES["video"];
        $videoExt = $ferramentas->pegaExtensao($video["name"]);
        
        $dados["videoMT"] = "video_" . $ferramentas->geradorMicroTime() . "." . $videoExt;
        $videoAtualizar = true;
    }

    if (isset($_FILES["foto_int"]) && $_FILES["foto_int"]["error"] == 0) {
        $foto = $_FILES["foto_int"];
        $fotoExt = $ferramentas->pegaExtensao($foto["name"]);
        
        $dados["fotoMT"] = "fp_" . $ferramentas->geradorMicroTime() . "." . $fotoExt;
        $fotoAtualizar = true;
    }

    $res = $manager->intEdit($dados);
   
    if ($res == true) {
    
        if ($videoAtualizar) {
            if (isset($dados["videoMT"])) {
                move_uploaded_file($video["tmp_name"], "../../Assets/interprete/{$dados['videoMT']}");
                unlink("../../Assets/interprete/$DA_video");
            }
        }

        if ($fotoAtualizar) {
            if (isset($dados["fotoMT"])) {
                $updateFoto = $manager->updFotoint($dados);

                if(!$updateFoto){
                    ?>
                        <form method="post" name="myForm" id="myForm" action="../../interprete/view/interprete.php">
                            <input type="hidden" name="msg" value="BD53">
                        </form>

                        <script>
                            document.getElementById('myForm').submit();
                        </script>
                    <?php
                }

                move_uploaded_file($foto["tmp_name"], "../../Assets/interprete/perfil/{$dados['fotoMT']}");
                unlink("../../Assets/interprete/perfil/$DA_foto");
            }
        }


        $log->setTexto("Interprete do ID_INT -" . $id . " foi atualizado\n");
        $log->fileWriter();
        ?>
            <form method="post" name="myForm" id="myForm" action="../../interprete/view/interprete.php">
                <input type="hidden" name="msg" value="BD53">
            </form>

            <script>
                document.getElementById('myForm').submit();
            </script>
        <?php
        
    } else {
        $log->setTexto("Falha na atualização do INTERPRETE ID_INT -" . $id . "\n");
        $log->fileWriter();
        ?>
            <form method="post" name="myForm" id="myForm" action="../../interprete/view/interprete.php">
                <input type="hidden" name="msg" value="FR00">
            </form>

            <script>
                document.getElementById('myForm').submit();
            </script>
        <?php
    }
    
        
}





// MUDANÇA DE SENHA
if(isset($_POST["codigoGet"])){
    require "../../vendor/phpmailer/phpmailer/src/Exception.php";
    require "../../vendor/phpmailer/phpmailer/src/PHPMailer.php";
    require "../../vendor/phpmailer/phpmailer/src/SMTP.php";

    require "../Model/log.class.php";
    require "../Model/ferramenta.class.php";
    require "../Model/manager.class.php";

    $log = new Log();
    $ferramentas = new Ferramentas(); 
    $manager = new Manager();

    $dados = array();
    if(isset($_POST["emailVerify"])){
        $email = $_POST["email"];

        $respVerifyEmail = $manager->verifyEmailInt($email);

        if($respVerifyEmail == 1){
            $dados["int_identifier"] = $ferramentas->geradorIdentifier();

            $dados["emailVerify"] = true;

            $dados["emailInt"] = $_POST["email"];

            $_SESSION["int_identifier"] = $dados["int_identifier"];
        }
    } else {
        $dados["idInt"] = $_POST["idInt"];
        $dados["nomeInt"] = $_POST["nomeInt"];
        $dados["emailInt"] = $_POST["emailInt"];
    }

    $dados["codigo"] = $ferramentas->geradorCodigoRandom();

    $respConfirm = $manager->intConfirmCod($dados);
    if($respConfirm == 1){ // erro
        $log->setTexto("interprete {$dados['emailInt']} ja possui um codigo no seu email\n");
        $log->fileWriter();
        $action = (isset($_POST["int_identifier"]) && !empty($_POST["int_identifier"])) 
        ? "../../Interprete/mudarSenha.php" 
        : "../../Interprete/View/mudarSenha.php";
    
        ?>
            <form method="post" name="myForm" id="myForm" action="<?php echo $action; ?>">
            <input type="hidden" name="msg" value="FR30">
        </form>
        <script>
            document.getElementById("myForm").submit();
        </script>
        <?php

        exit();
    }

    $resp = $manager->IntCdastrarCodigo($dados);

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = '';//email da empresa
        $mail->Password   = '';//senha do google
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        $mail->setFrom('', '');//email da empresa e nome
        $mail->addAddress($dados["emailInt"], (isset($_POST["emailVerify"]) ? "" : $dados["nomeInt"])); 

        $mail->isHTML(true);
        $mail->Subject = 'Envio do codigo';
        $mail->Body    = '
            Ola, senhor(a) '. ((isset($_POST["emailVerify"])) ? "" : $dados["nomeInt"]) .', <br><br>
            
            Aqui está o seu codigo para alteração da sua senha

            <b>
            '. $dados["codigo"] .'
            </b>

        ';
        $mail->AltBody = 'Conteúdo em texto simples';

        $mail->send();
        
        if ($resp == true) {
            $log->setTexto("Codigo de nova senha enviado para interprete {$dados['emailInt']} \n");
            $log->fileWriter();

            if(isset($_POST["emailVerify"])){
                ?>
                    <form method="post" name="myForm" id="myForm" action="../../Interprete/mudarSenha.php">
                        <input type="hidden" name="msg" value="FR52">
                        <input type="hidden" name="emailInt" value="<?= $dados["emailInt"] ?>">
                        <input type="hidden" name="aceitarCodigo" value="1">
                    </form>
                    <script>
                        document.getElementById("myForm").submit();
                    </script>
                <?php
                exit();
            }
            
            ?>
                <form method="post" name="myForm" id="myForm" action="../../Interprete/View/mudarSenha.php">
                    <input type="hidden" name="msg" value="FR52">
                    <input type="hidden" name="aceitarCodigo" value="1">
                    <input type="hidden" name="idInt" value="<?= $dados["idInt"] ?>">

                </form>
                <script>
                    document.getElementById("myForm").submit();
                </script>   
            <?php
            exit();
            
        }

    } catch (Exception $e) {
        $log->setTexto("Erro ao enviar email de confirmação \n");
        $log->fileWriter();

        $action = (isset($_POST["int_identifier"]) && !empty($_POST["int_identifier"])) 
        ? "../../Interprete/mudarSenha.php" 
        : "../../Interprete/View/mudarSenha.php";
    
        ?>
            <form method="post" name="myForm" id="myForm" action="<?php echo $action; ?>">
            <input type="hidden" name="msg" value="FR52">
        </form>
        <script>
            document.getElementById("myForm").submit();
        </script>
        <?php
        exit();
    }

}

if(isset($_POST["mudarSenhaCodigo"])){
    require "../Model/log.class.php";
    require "../Model/ferramenta.class.php";
    require "../Model/manager.class.php";

    $log = new Log();
    $ferramentas = new Ferramentas(); 
    $manager = new Manager();

    $dados = array();
    if(isset($_POST["int_identifier"])){
        $dados["verifier"] = 1;
        $dados["int_identifier"] = $_POST["int_identifier"];
    } else{
        $dados["idInt"] = $_POST["idInt"];
    }
    
    $dados["codigo"] = $_POST["codigo"];
    $dados["emailInt"] = $_POST["emailInt"];
    
    $resp = $manager->intConfirmCod($dados);

    if($resp == 1){
        $log->setTexto("Codigo enviado por Interprete.{$dados['emailInt']} está correto \n");
        $log->fileWriter();

        $action = (isset($_POST["int_identifier"]) && !empty($_POST["int_identifier"])) 
        ? "../../Interprete/mudarSenha.php" 
        : "../../Interprete/View/mudarSenha.php";
    
        ?>
            <form method="post" name="myForm" id="myForm" action="<?php echo $action; ?>">php">
                <input type="hidden" name="msg" value="BD55">
                <input type="hidden" name="emailInt" value="<?= $dados["emailInt"]; ?>">
                <input type="hidden" name="codigo" value="<?= $dados["codigo"] ?>">
                <input type="hidden" name="mudar_senhaC" value="1">
            </form>
            <script>
                document.getElementById("myForm").submit();
            </script>
        <?php
        exit();
    } else {
        $log->setTexto("Codigo enviado por Interprete.{$dados['emailInt']} está incorreto \n");
        $log->fileWriter();

        $action = (isset($_POST["int_identifier"]) && !empty($_POST["int_identifier"])) 
        ? "../../Interprete/mudarSenha.php" 
        : "../../Interprete/View/mudarSenha.php";
    
        ?>
            <form method="post" name="myForm" id="myForm" action="<?php echo $action; ?>">
                <input type="hidden" name="msg" value="BD05">
            </form>
            <script>
                document.getElementById("myForm").submit();
            </script>
        <?php
        exit();
    }
}

if(isset($_POST["mudarSenhaConfirm"])){
    require "../Model/log.class.php";
    require "../Model/ferramenta.class.php";
    require "../Model/manager.class.php";

    $log = new Log();
    $ferramentas = new Ferramentas(); 
    $manager = new Manager();

    $dados = array();
    $pass1 = $_POST["pass1"];
    $pass2 = $_POST["pass2"];
    $dados["codigo"] = $_POST["codigo"];

    if(isset($_POST["int_identifier"])){
        $dados["int_identifier"] = $_POST["int_identifier"];
        $dados["verifier"] = 1;
        $dados["emailInt"] = $_POST["emailInt"];
    } else{
        $dados["idInt"] = $_POST["idInt"];
    }

    if($pass1 != $pass2){
        $log->setTexto("Senhas não são iguais na area de mudança de senha do Interprete\n");
        $log->fileWriter();

        session_destroy();
        $action = (isset($_POST["int_identifier"]) && !empty($_POST["int_identifier"])) 
        ? "../../Interprete/mudarSenha.php" 
        : "../../Interprete/View/mudarSenha.php";
    
        ?>
            <form method="post" name="myForm" id="myForm" action="<?php echo $action; ?>">
                <input type="hidden" name="msg" value="FR27">
                <input type="hidden" name="mudar_senhaC" value="1">
            </form>
            <script>
                document.getElementById("myForm").submit();
            </script>
        <?php
        exit();
    }

    $resp[0] = $ferramentas->antiInjection($pass1);
    $resp[1] = $ferramentas->antiInjection($pass2);


    for ($i = 0;$i <= 1; $i++){
        if($resp[$i] == 0){
            $log->setTexto("Tentativa injection na área de mudança de senha do Interprete\n");
            $log->fileWriter();

            session_destroy();
            ?>
                <form method="post" name="myForm" id="myForm" action="../../Interprete/interpreteLogin.php">
                    <input type="hidden" name="msg" value="FR27">
                </form>
                <script>
                    document.getElementById("myForm").submit();
                </script>
            <?php
            exit();
        }
    }

    $dados["senhaCrip"] = $ferramentas->sha256($pass1);

    $respUpd = $manager->updIntSenha($dados);

    if($respUpd == 1){
        $log->setTexto("Senha alterada com sucesso\n");
        $log->fileWriter();
        $action = (isset($_POST["int_identifier"]) && !empty($_POST["int_identifier"])) 
        ? "../../Interprete/mudarSenha.php" 
        : "../../Interprete/View/mudarSenha.php";
    
        ?>
            <form method="post" name="myForm" id="myForm" action="<?php echo $action; ?>">
                <input type="hidden" name="msgA" value="">
            </form>
            <script>
                document.getElementById("myForm").submit();
            </script>
        <?php
        exit();
    } else{
        $log->setTexto("Falha na alteração de senha\n");
        $log->fileWriter();
        $action = (isset($_POST["int_identifier"]) && !empty($_POST["int_identifier"])) 
        ? "../../Interprete/interpreteLogin.php" 
        : "../../Interprete/View/interprete.php";
    
        ?>
            <form method="post" name="myForm" id="myForm" action="<?php echo $action; ?>">
                <input type="hidden" name="msg" value="BD53">
            </form>
            <script>
                document.getElementById("myForm").submit();
            </script>
        <?php
        exit();
    }
}   



























?>