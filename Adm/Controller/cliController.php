<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


if(isset($_POST["clienteLogar"])){
    require "../Model/log.class.php";
    $log = new Log();
    if (isset($_SESSION['id_cli'])){ 
        session_destroy();
        ?>       
            <form method="post" name="myForm" id="myForm" action="../../Cliente/clienteLogin.php"> 
                <input type="hidden" name="msg" value="OA04">
            </form>

            <script>    
                document.getElementById("myForm").submit();
            </script>
        <?php
    }

    if ($_POST["email"] == "" || $_POST["senha"] == ""){
        $log->setTexto("Tentativa de acesso na área do cliente com campos vazios\n");
        $log->fileWriter();
        ?>
            <form method="post" name="myForm" id="myForm" action="../../Cliente/clienteLogin.php">
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

    $resp[0] = $ferramentas->antiInjection($_POST["email"]);
    $resp[1] = $ferramentas->antiInjection($_POST["senha"]);

    for ($i = 0;$i <= 1; $i++){
        if($resp[$i] == 0){
            $log->setTexto("Tentativa injection na área do Cliente\n");
            $log->fileWriter();
            ?>
                <form method="post" name="myForm" id="myForm" action="../../Cliente/clienteLogin.php">
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
    $dados = $manager->cliVerificar($dados);

    if($dados['result'] == 0){
        $log->setTexto("Tentativa de acesso sem exito na área do Cliente\n");
        $log->fileWriter();
        ?> 
            <form method="post" name="myForm" id="myForm" action="../../Cliente/clienteLogin.php">
                <input type="hidden" name="msg" value="FR02">
            </form>
            <script>
                document.getElementById("myForm").submit();
            </script>
        <?php
        exit();
    }

    $_SESSION["id_cli"] = $dados["id"];
    $_SESSION["nome_cli"] = $dados["nome"];
    $_SESSION["email_cli"] = $dados["email"];
    $_SESSION["telefone_cli"] = $dados["telefone"];
    $_SESSION["nasc_cli"] = $dados["nasc"];
    $_SESSION["cpf_cli"] = $dados["cpf"];
    $_SESSION["status_cli"] = $dados["status"];
    $_SESSION["foto_cli"] = $dados["foto_perfil"];

    $log->setTexto(" {$dados['email']} logou com exito na área do Cliente \n");
    $log->fileWriter();

    ?>
        <form method="post" name="myForm" id="myForm" action="../../Cliente/View/cliente.php">
            <input type="hidden" name="msg" value="0">
        </form>
        <script>
            document.getElementById("myForm").submit();
        </script>
    <?php
}





if(isset($_POST["clienteCadastrar"])){
    require "../Model/log.class.php";
    require "../Model/ferramenta.class.php";
    require "../Model/manager.class.php";

    $config = require '../Model/api.php';
    $secret_key = $config['secret_key'];

    $log = new Log();
    $ferramentas = new Ferramentas(); 
    $manager = new Manager();

    if (isset($_SESSION['id_cli'])){ 
        session_destroy();
        ?>       
            <form method="post" name="myForm" id="myForm" action="../../Cliente/clienteCadastro.php"> 
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
            <form method="post" name="myForm" id="myForm" action="../../Cliente/clienteCadastro.php">
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
            <form method="post" name="myForm" id="myForm" action="../../Cliente/clienteCadastro.php">
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
            <form method="post" name="myForm" id="myForm" action="../../Cliente/clienteCadastro.php">
                <input type="hidden" name="msg" value="FR29">
            </form>
            <script>
                document.getElementById('myForm').submit();
            </script>
        <?php
        exit();
    }

    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $telefone = $_POST["telefone"];
    $cpf = $_POST["cpf"];
    $nasc = $_POST["nasc"];

    $senha1 = $_POST["senha1"];
    $senha2 = $_POST["senha2"];

    if($senha1 != $senha2){
        ?>
            <form method="post" name="myForm" id="myForm" action="../../Cliente/clienteCadastro.php">
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

    for ($i = 0;$i <= 4; $i++){
        if($resp[$i] == 0){
            $log->setTexto("Tentativa injection na área do Cliente\n");
            $log->fileWriter();
            ?>
                <form method="post" name="myForm" id="myForm" action="../../Cliente/clienteCadastro.php">
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
    $dados["senha"] = $senhaCrip;

    $resp = $manager->cliVerificarCadastro($dados);

    if($resp == 1){
        $log->setTexto("Conta ja existente\n");
        $log->fileWriter();
            ?>
                <form method="post" name="myForm" id="myForm" action="../../Cliente/clienteCadastro.php">
                    <input type="hidden" name="msg" value="FR28">
                </form>
                <script>
                    document.getElementById("myForm").submit();
                </script>
            <?php
            exit();
    }

    $res = $manager->cliNew($dados);
    if($res == true){
        $log->setTexto("Cliente {$dados['email']} criado com sucesso\n");
        $log->fileWriter();
            ?>
                <form method="post" name="myForm" id="myForm" action="../../Cliente/clienteLogin.php">
                    <input type="hidden" name="msg" value="FR52">
                </form>
                <script>
                    document.getElementById("myForm").submit();
                </script>
            <?php
            exit();
    } else {
        $log->setTexto("Erro na falha de criação de cliente\n");
        $log->fileWriter();
            ?>
                <form method="post" name="myForm" id="myForm" action="../../Cliente/clienteCadastro.php">
                    <input type="hidden" name="msg" value="FR28">
                </form>
                <script>
                    document.getElementById("myForm").submit();
                </script>
            <?php
            exit();
    }  
}


if(isset($_POST["atualizarCli"])){
    require "../Model/log.class.php";
    require "../Model/ferramenta.class.php";
    require "../Model/manager.class.php";

    $log = new Log();
    $ferramentas = new Ferramentas(); 
    $manager = new Manager();

    $resp[0] = $ferramentas->antiInjection($pass1);
    $resp[1] = $ferramentas->antiInjection($pass2);
    $resp[2] = $ferramentas->antiInjection($pass2);
    $resp[3] = $ferramentas->antiInjection($pass2);


    for ($i = 0;$i <= 3; $i++){
        if($resp[$i] == 0){
            $log->setTexto("Tentativa injection na área de atualizar dados do Cliente\n");
            $log->fileWriter();

            session_destroy();
            ?>
                <form method="post" name="myForm" id="myForm" action="../../Cliente/clienteLogin.php">
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
    $dados["idCli"] = $_POST["idCli"];
    $dados["nomeCli"] = $_POST["nomeCli"];
    $dados["emailCli"] = $_POST["emailCli"];
    $dados["telefoneCli"] = $_POST["telefoneCli"];
    $dados["nascCli"] = $_POST["nascCli"];

    $resp = $manager->cliUpdate($dados);

    if($resp){

        $_SESSION["id_cli"] = $dados["idCli"];
        $_SESSION["nome_cli"] = $dados["nomeCli"];
        $_SESSION["email_cli"] = $dados["emailCli"];
        $_SESSION["telefone_cli"] = $dados["telefoneCli"];
        $_SESSION["nasc_cli"] = $dados["nascCli"];

        $log->setTexto("Cliente {$dados['emailCli']} teve os dados atualizados com sucesso\n");
        $log->fileWriter();
            ?>
                <form method="post" name="myForm" id="myForm" action="../../Cliente/View/cliente.php">
                    <input type="hidden" name="msg" value="BD53">
                </form>
                <script>
                    document.getElementById("myForm").submit();
                </script>
            <?php
            exit();
    } else {
        $log->setTexto("Erro na falha da atualização dos dados do Cliente {$dados["emailCli"]}\n");
        $log->fileWriter();
            ?>
                <form method="post" name="myForm" id="myForm" action="../../Cliente/View/cliente.php">
                    <input type="hidden" name="msg" value="BD03">
                </form>
                <script>
                    document.getElementById("myForm").submit();
                </script>
            <?php
            exit();
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
    $id = $_POST["id_cli"];

  

    if ($senha1 != $senha2) {
        $log->setTexto("As senhas nao coincidem\n");
        $log->fileWriter();
        ?>
            <form method="post" name="myForm" id="myForm" action="../../cliente/view/cliente.php">
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

    $res = $manager->cliAlterarSenha($dados);

    if ($res == true) {
        $log->setTexto("Senha do ID_cli -" . $id . " foi alterada\n");
        $log->fileWriter();
        ?>
            <form method="post" name="myForm" id="myForm" action="../../cliente/view/cliente.php">
                <input type="hidden" name="msg" value="BD53">
            </form>

            <script>
                document.getElementById('myForm').submit();
            </script>
        <?php
    } else {
        $log->setTexto("Falha na alteracao da senha do INTERPRETE ID_cli -" . $id . "\n");
        $log->fileWriter();
        ?>
            <form method="post" name="myForm" id="myForm" action="../../cliente/view/cliente.php">
                <input type="hidden" name="msg" value="FR00">
            </form>

            <script>
                document.getElementById('myForm').submit();
            </script>
        <?php
    }


}


if($_POST["cliEdit"]){
    include "../Model/ferramenta.class.php";
    include "../Model/log.class.php";
    include "../Model/manager.class.php";

    $ferramentas = new Ferramentas();
    $log = new Log();
    $manager = new Manager();

    $dados = array();
    $id = $_POST["id_cli"];
    $dados["id_cli"] = $_POST["id_cli"];
    $dados["nome"] = $_POST["nome"];
    $dados["email"] = $_POST["email"];
    $dados["telefone"] = $_POST["telefone"];
    $dados["nascimento"] = $_POST["nascimento"];
    
    // bagulho chatinho isso, n mexer em nada, por favor
    $fotoAtualizar = false;

    $dadosAtuais = $manager->cliPuxar($id);
    $DA_foto = $dadosAtuais['foto_perfil'];

    if (isset($_FILES["foto_cli"]) && $_FILES["foto_cli"]["error"] == 0) {
        $foto = $_FILES["foto_cli"];
        $fotoExt = $ferramentas->pegaExtensao($foto["name"]);
        
        $dados["fotoMT"] = "fp_" . $ferramentas->geradorMicroTime() . "." . $fotoExt;
        $fotoAtualizar = true;
    }

    $dados["area_cliente"] = true;
    $res = $manager->cliEditCC($dados);



    if ($res == true) {
        
        if ($fotoAtualizar) {
            if (isset($dados["fotoMT"])) {
                move_uploaded_file($foto["tmp_name"], "../../Assets/Cliente/{$dados['fotoMT']}");
                unlink("../../Assets/Cliente/$DA_foto");
            }
        }

        $log->setTexto("CLIENTE do CLIENTE_INT -" . $id . " foi atualizado\n");
        $log->fileWriter();
        ?>
            <form method="post" name="myForm" id="myForm" action="../../cliente/view/cliente.php">
                <input type="hidden" name="msg" value="BD53">
            </form>

            <script>
                document.getElementById('myForm').submit();
            </script>
        <?php
    } else {
        $log->setTexto("Falha na atualização do CLIENTE  CLIENTE.ID  -" . $id . "\n");
        $log->fileWriter();
        ?>
            <form method="post" name="myForm" id="myForm" action="../../cliente/view/cliente.php">
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

        $respVerifyEmail = $manager->verifyEmailCli($email);

        if($respVerifyEmail == 1){
            $dados["cli_identifier"] = $ferramentas->geradorIdentifier();

            $dados["emailVerify"] = true;

            $dados["emailCli"] = $_POST["email"];

            $_SESSION["cli_identifier"] = $dados["cli_identifier"];
        }
    } else {
        $dados["idCli"] = $_POST["idCli"];
        $dados["nomeCli"] = $_POST["nomeCli"];
        $dados["emailCli"] = $_POST["emailCli"];
    }

    $dados["codigo"] = $ferramentas->geradorCodigoRandom();

    $respConfirm = $manager->cliConfirmCod($dados);
    if($respConfirm == 1){ // erro
        $log->setTexto("Cliente {$dados['emailCli']} ja possui um codigo no seu email\n");
        $log->fileWriter();
        $action = (isset($_POST["cli_identifier"]) && !empty($_POST["cli_identifier"])) 
        ? "../../Cliente/mudarsenha.php" 
        : "../../Cliente/View/mudarsenha.php";
    
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

    $resp = $manager->cliCdastrarCodigo($dados);

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
        $mail->addAddress($dados["emailCli"], (isset($_POST["emailVerify"]) ? "" : $dados["nomeCli"])); 

        $mail->isHTML(true);
        $mail->Subject = 'Envio do codigo';
        $mail->Body    = '
            Ola, senhor(a) '. ((isset($_POST["emailVerify"])) ? "" : $dados["nomeCli"]) .', <br><br>
            
            Aqui está o seu codigo para alteração da sua senha

            <b>
            '. $dados["codigo"] .'
            </b>

        ';
        $mail->AltBody = 'Conteúdo em texto simples';

        $mail->send();
        
        if ($resp == true) {
            $log->setTexto("Codigo de nova senha enviado para cliente {$dados['emailCli']} \n");
            $log->fileWriter();

            if(isset($_POST["emailVerify"])){
                ?>
                    <form method="post" name="myForm" id="myForm" action="../../Cliente/mudarsenha.php">
                        <input type="hidden" name="msg" value="FR52">
                        <input type="hidden" name="emailCli" value="<?= $dados["emailCli"] ?>">
                        <input type="hidden" name="aceitarCodigo" value="1">
                    </form>
                    <script>
                        document.getElementById("myForm").submit();
                    </script>
                <?php
                exit();
            }
            
            ?>
                <form method="post" name="myForm" id="myForm" action="../../Cliente/View/mudarsenha.php">
                    <input type="hidden" name="msg" value="FR52">
                    <input type="hidden" name="aceitarCodigo" value="1">
                    <input type="hidden" name="idCli" value="<?= $dados["idCli"] ?>">

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

        $action = (isset($_POST["cli_identifier"]) && !empty($_POST["cli_identifier"])) 
        ? "../../Cliente/mudarsenha.php" 
        : "../../Cliente/View/mudarsenha.php";
    
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
    if(isset($_POST["cli_identifier"])){
        $dados["verifier"] = 1;
        $dados["cli_identifier"] = $_POST["cli_identifier"];
    } else{
        $dados["idCli"] = $_POST["idCli"];
    }
    
    $dados["codigo"] = $_POST["codigo"];
    $dados["emailCli"] = $_POST["emailCli"];
    
    $resp = $manager->cliConfirmCod($dados);

    if($resp == 1){
        $log->setTexto("Codigo enviado por {$dados['emailCli']} cliente está correto \n");
        $log->fileWriter();

        $action = (isset($_POST["cli_identifier"]) && !empty($_POST["cli_identifier"])) 
        ? "../../Cliente/mudarsenha.php" 
        : "../../Cliente/View/mudarsenha.php";
    
        ?>
            <form method="post" name="myForm" id="myForm" action="<?php echo $action; ?>">php">
                <input type="hidden" name="msg" value="BD55">
                <input type="hidden" name="emailCli" value="<?= $dados["emailCli"]; ?>">
                <input type="hidden" name="codigo" value="<?= $dados["codigo"] ?>">
                <input type="hidden" name="mudar_senhaC" value="1">
            </form>
            <script>
                document.getElementById("myForm").submit();
            </script>
        <?php
        exit();
    } else {
        $log->setTexto("Codigo enviado por {$dados['emailCli']} do cliente está incorreto \n");
        $log->fileWriter();

        $action = (isset($_POST["cli_identifier"]) && !empty($_POST["cli_identifier"])) 
        ? "../../Cliente/mudarsenha.php" 
        : "../../Cliente/View/mudarsenha.php";
    
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

    if(isset($_POST["cli_identifier"])){
        $dados["cli_identifier"] = $_POST["cli_identifier"];
        $dados["verifier"] = 1;
        $dados["emailCli"] = $_POST["emailCli"];
    } else{
        $dados["idCli"] = $_POST["idCli"];
    }

    if($pass1 != $pass2){
        $log->setTexto("Senhas não são iguais na area de mudança de senha do cliente\n");
        $log->fileWriter();

        session_destroy();
        $action = (isset($_POST["cli_identifier"]) && !empty($_POST["cli_identifier"])) 
        ? "../../Cliente/mudarsenha.php" 
        : "../../Cliente/View/mudarsenha.php";
    
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
            $log->setTexto("Tentativa injection na área de mudança de senha do Cliente\n");
            $log->fileWriter();

            session_destroy();
            ?>
                <form method="post" name="myForm" id="myForm" action="../../Cliente/clienteLogin.php">
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

    $respUpd = $manager->updCliSenha($dados);

    if($respUpd == 1){
        $log->setTexto("Senha alterada com sucesso\n");
        $log->fileWriter();
        $action = (isset($_POST["cli_identifier"]) && !empty($_POST["cli_identifier"])) 
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
        $action = (isset($_POST["cli_identifier"]) && !empty($_POST["cli_identifier"])) 
        ? "../../Cliente/clienteLogin.php" 
        : "../../Cliente/View/cliente.php";
    
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

if(isset($_POST["mudarFoto"])){
    require "../Model/log.class.php";
    require "../Model/ferramenta.class.php";
    require "../Model/manager.class.php";

    $log = new Log();
    $ferramentas = new Ferramentas(); 
    $manager = new Manager();

    if(isset($_POST["fotoCliAtual"]) && !empty($_POST["fotoCliAtual"])){
        $fotoCliAtual = $_POST["fotoCliAtual"];
        unlink("../../Assets/cliente/$fotoCliAtual");

    }

    $idCli = $_POST["idCli"];
    $fotoPerfil = $_FILES["fotoPerfil"];

    $fotoExt = $ferramentas->pegaExtensao($fotoPerfil["name"]);
    $allowed = array("jpeg", "jpg", "png", "jfif");

    //MT curriculo
    if(!in_array($fotoExt, $allowed)){
        $log->setTexto("Extensão errada usada no upload de FOTO PERFIL CLIENTE\n");
        $log->fileWriter();
        ?>
            <form method="post" name="myForm" id="myForm" action="../../Cliente/View/cliente.php">
                <input type="hidden" name="msg" value="FR19">
            </form>

            <script>
                document.getElementById('myForm').submit();
            </script>
        <?php
        exit();
    } else {
        //MT = micro time
        $fotoPerfilMT = "fp_" . $ferramentas->geradorMicroTime() . "." . $fotoExt;
    }

    $resp = $manager->updCliFoto($fotoPerfilMT, $idCli);

    if($resp){
        $log->setTexto("Foto do cliente.ID: " . $idCli . " alterada com sucesso\n");
        $log->fileWriter();

        move_uploaded_file($fotoPerfil["tmp_name"], "../../Assets/Cliente/{$fotoPerfilMT}");

        $_SESSION["foto_cli"] = $fotoPerfilMT;
    
        ?>
            <form method="post" name="myForm" id="myForm" action="../../Cliente/View/cliente.php">
                <input type="hidden" name="msg" value="BD53">
            </form>
            <script>
                document.getElementById("myForm").submit();
            </script>
        <?php
        exit();
    } else {
        $log->setTexto("Erro ao alterar foto do cliente.ID: " . $idCli . "\n");
        $log->fileWriter();
    
        ?>
            <form method="post" name="myForm" id="myForm" action="../../Cliente/View/cliente.php>">
                <input type="hidden" name="msg" value="BD03">
            </form>
            <script>
                document.getElementById("myForm").submit();
            </script>
        <?php
        exit();
    }
}

?>