<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


if(isset($_POST["agendamento"])){
    require "../Model/log.class.php";
    require "../Model/ferramenta.class.php";
    require "../Model/manager.class.php";

    $log = new Log();
    $ferramentas = new Ferramentas(); 
    $manager = new Manager();

    if(!isset($_POST["id_cli"]) || empty($_POST["id_cli"])){
        $log->setTexto("Tentativa de agendamento sem exito por falta de login do cliente\n");
        $log->fileWriter();

        ?>
            <form method="post" name="myForm" id="myForm" action="../../Cliente/clienteLogin.php">
                <input type="hidden" name="msg" value="OA05">
            </form>
            <script>
                document.getElementById("myForm").submit();
            </script>
        <?php
        exit();
    }

    if (!is_array($_POST["interprete"])) {
        $_POST["interprete"] = [$_POST["interprete"]]; 
    }

    if(empty($_POST["quantInt"]) || empty($_POST["horaSer"]) || empty($_POST["cidade"]) || empty($_POST["data"]) || empty($_POST["horaComeca"]) || empty($_POST["interprete"]) || in_array("", $_POST["interprete"])){
        ?>
            <form method="post" name="myForm" id="myForm" action="../../Paginas/agendamentoServicos.php?id=<?= $_POST["idSer"] ?>">
                <input type="hidden" name="msg" value="OA05">
            </form>
            <script>
                document.getElementById("myForm").submit();
            </script>
        <?php
        exit();
    }

    $dados = array();
    $dados["id_cli"] = $_POST["id_cli"];
    $dados["id_ser"] = $_POST["idSer"];
    $dados["preco"] = $_POST["preco"];
    $dados["quantInt"] = $_POST["quantInt"];
    $dados["quantHoras"] = $_POST["horaSer"];
    $dados["horaComeca"] = $_POST["horaComeca"];
    $dados["cidade"] = $_POST["cidade"];
    $dados["data"] = $_POST["data"];

    //id_int
    $interpretes = $_POST['interprete'] ?? [];
    // n sei exatamente pq isso, mas todo lugar q eu vi fala q fazer isso é bom. imagino q ta falando q se n tiver nada deixa vazio, ou algo do genero

    $dados["codVerify"] = $ferramentas->geradorIdentifier();

    $resp = $manager->agendamento($dados, $interpretes);

    if($resp == 1){
        $log->setTexto("Agendamento efetuado com sucesso\n");
        $log->fileWriter();

        ?>
            <form method="post" name="myForm" id="myForm" action="../../paginas/carrinho.php">
                <input type="hidden" name="msg" value="BD50">
                <input type="hidden" name="codVerify" value="<?= $dados["codVerify"] ?>">
            </form>
            <script>
                document.getElementById("myForm").submit();
            </script>
        <?php
        exit();
    } else {
        $log->setTexto("Falha no agendamento\n");
        $log->fileWriter();

        ?>
            <form method="post" name="myForm" id="myForm" action="../../paginas/agendamentoServicos.php">
                <input type="hidden" name="msg" value="OA05">
            </form>
            <script>
                document.getElementById("myForm").submit();
            </script>
        <?php
        exit();
    }
}
    
if(isset($_POST["agendamentoLocal"])){
    require "../Model/log.class.php";
    require "../Model/ferramenta.class.php";
    require "../Model/manager.class.php";

    require "../../vendor/phpmailer/phpmailer/src/Exception.php";
    require "../../vendor/phpmailer/phpmailer/src/PHPMailer.php";
    require "../../vendor/phpmailer/phpmailer/src/SMTP.php";

    $mail = new PHPMailer(true);

    $log = new Log();
    $ferramentas = new Ferramentas(); 
    $manager = new Manager();


    $dados = array();

    $idInterpretes = $manager->getIdInterprete($_POST["codVerify"]);

    $dados["id_cli"] = $_POST["id_cli"];
    $dados["codVerify"] = $_POST["codVerify"];

    $dados["cep"] = preg_replace("/[^0-9]/", "", $_POST["cep"]);
    $dados["rua"] = $_POST["rua"];
    $dados["numero"] = $_POST["numero"];
    $dados["bairro"] = $_POST["bairro"];
    $dados["cidade"] = $_POST["cidade"];
    $dados["estado"] = $_POST["uf"];

    if($_POST["complemento"] != ""){
        $dados["complemento"] = $_POST["complemento"];
    } else {
        $dados["complemento"] = "";
    }

    if($_POST["informacoesAdicionais"] != ""){
        $dados["infor_adicionais"] = $_POST["informacoesAdicionais"];
    } else {
        $dados["infor_adicionais"] = "";
    }
    
    $respVerify = $manager->agendamentoLocalVerify($dados);

    if($respVerify == 0){
        $log->setTexto("Codigo verify não bate com o do banco de dados\n");
        $log->fileWriter();

        ?>
            <form method="post" name="myForm" id="myForm" action="../../paginas/confirmacaoAgendamento.php">
                <input type="hidden" name="msg" value="BD50">
            </form>
            <script>
                document.getElementById("myForm").submit();
            </script>
        <?php
        exit();
    }

    $resp = $manager->agendamentoLocal($dados, $idInterpretes);
    
    if($resp == 1){
        $log->setTexto("Agendamento efetuado com sucesso\n");
        $log->fileWriter();

        $modoPagamento = $_POST["formaPagamento"];
        $codVerify = $_POST["codVerify"];

        $idCli = $_POST["id_cli"];
        $emailCli = $_POST["email_cli"];
        $nomeCli = $_POST["nome_cli"];

        $resp = $manager->agendamentoFinalizar($codVerify, $modoPagamento, $idCli);

        
        if($resp){
            try {
                $mail->isSMTP();
                $mail->Host       = 'smtp.gmail.com';
                $mail->SMTPAuth   = true;
                $mail->Username   = 'enlace.tcc@gmail.com';
                $mail->Password   = 'dzja rsfw eqle xhfz';
                $mail->SMTPSecure = 'tls';
                $mail->Port       = 587;
        
                $mail->setFrom('enlace.tcc@gmail.com', 'Enlace');
                $mail->addAddress($emailCli, $nomeCli); // Use o email do destinatário aqui
        
                $mail->isHTML(true);
                $mail->Subject = 'Confirmação do agendamento';
                $mail->Body    = '
                    Ola, senhor(a) '. $nomeCli .', viemos por esse email avisar que seu agendamento foi <b>CONFIRMADO</b>! <br> Obrigado por confiar em nós! <br><br>
                    
                    Cheque o seu historico para saber sobre o processo e seu agendamento!
        
                ';
                $mail->AltBody = 'Conteúdo em texto simples';
        
                $mail->send();
        
                // Move o código abaixo para cá, após o envio do e-mail
                $log->setTexto("Agendamento efetuado pelo cliente". $idCli ."com sucesso\n");
                $log->fileWriter();
        
                ?>
                    <form method="post" name="myForm" id="myForm" action="../../index.php">            
                        <input type="hidden" name="msgNF">  
                        <input type="hidden" name="codVerify" value="<?= $codVerify?>">              
                    </form>
                    <script>
                        document.getElementById("myForm").submit();
                    </script>
                <?php
                exit();
            
            } catch (Exception $e) {
                echo "Falha ao enviar e-mail: {$mail->ErrorInfo}";
            }

        } else {
            $log->setTexto("Falha na confirmação do agendamento \n");
            $log->fileWriter();

            ?>
                <form method="post" name="myForm" id="myForm" action="../../paginas/agendamentoServicos.php">            
                    <input type="hidden" name="msg" value="BD50">                
                </form>
                <script>
                    document.getElementById("myForm").submit();
                </script>
            <?php
            exit();
        } 
        
        
    } else {
        $log->setTexto("Falha no agendamento\n");
        $log->fileWriter();

        ?>
            <form method="post" name="myForm" id="myForm" action="../../paginas/contAgendamento.php">
                <input type="hidden" name="msg" value="BD00">
            </form>
            <script>
                document.getElementById("myForm").submit();
            </script>
        <?php
        exit();
        
    }
    
}

/*
if(isset($_POST["agendamentoConfirm"])){
    require "../Model/log.class.php";
    require "../Model/ferramenta.class.php";
    require "../Model/manager.class.php";

    require "../../vendor/phpmailer/phpmailer/src/Exception.php";
    require "../../vendor/phpmailer/phpmailer/src/PHPMailer.php";
    require "../../vendor/phpmailer/phpmailer/src/SMTP.php";

    $log = new Log();
    $ferramentas = new Ferramentas(); 
    $manager = new Manager();

    $mail = new PHPMailer(true);

    $codVerify = $_POST["codVerify"];
    $modoPagamento = $_POST["formaPagamento"];
    $idCli = $_POST["id_cli"];
    $emailCli = $_POST["email_cli"];
    $nomeCli = $_POST["nome_cli"];

    $resp = $manager->agendamentoFinalizar($codVerify, $modoPagamento, $idCli);
    

    if($resp){
        try {
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'enlace.tcc@gmail.com';
            $mail->Password   = 'dzja rsfw eqle xhfz';
            $mail->SMTPSecure = 'tls';
            $mail->Port       = 587;
    
            $mail->setFrom('enlace.tcc@gmail.com', 'Enlace');
            $mail->addAddress($emailCli, $nomeCli); // Use o email do destinatário aqui
    
            $mail->isHTML(true);
            $mail->Subject = 'Confirmação do agendamento';
            $mail->Body    = '
                Ola, senhor(a) '. $nomeCli .', viemos por esse email avisar que seu agendamento foi <b>CONFIRMADO</b>! <br> Obrigado por confiar em nós! <br><br>
                
                Cheque o seu historico para saber sobre o processo e seu agendamento!
    
            ';
            $mail->AltBody = 'Conteúdo em texto simples';
    
            $mail->send();
    
            // Move o código abaixo para cá, após o envio do e-mail
            $log->setTexto("Agendamento efetuado pelo cliente". $idCli ."com sucesso\n");
            $log->fileWriter();
    
            ?>
                <form method="post" name="myForm" id="myForm" action="../../paginas/AgendamentoAgradecimento.php">            
                    <input type="hidden" name="msg" value="BD50">                
                </form>
                <script>
                    document.getElementById("myForm").submit();
                </script>
            <?php
            exit();
        
        } catch (Exception $e) {
            echo "Falha ao enviar e-mail: {$mail->ErrorInfo}";
        }

    } else {
        $log->setTexto("Falha na confirmação do agendamento \n");
        $log->fileWriter();

        ?>
            <form method="post" name="myForm" id="myForm" action="../../paginas/agendamentoServicos.php">            
                <input type="hidden" name="msg" value="BD50">                
            </form>
            <script>
                document.getElementById("myForm").submit();
            </script>
        <?php
        exit();
    } 
        
}
    */


if(isset($_POST["avaliacao"])){
    require "../Model/log.class.php";
    require "../Model/ferramenta.class.php";
    require "../Model/manager.class.php";

    $log = new Log();
    $ferramentas = new Ferramentas(); 
    $manager = new Manager();

    $resp[0] = $ferramentas->antiInjection($_POST["estrelas"]);
    $resp[1] = $ferramentas->antiInjection($_POST["comentario"]);
    //eu conti a dentro da $resp tem o antiInjection que eu liguei usando o $ferramentas

    for ($i = 0;$i <= 1; $i++){
        if($resp[$i] == 0){
            $log->setTexto("Tentativa injection na área de serviço\n");
            $log->fileWriter();
            //to comparando para ver se em algum $resp tem injection
            ?>
                <form method="get" name="myForm" id="myForm" action="../../index.php">
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

    $dados["id_cli"] = $_POST["id_cli"];
    $dados["id_ser"] = $_POST["id_ser"];
    $dados["estrelas"] = $_POST["estrelas"];
    $dados["comentario"] = $_POST["comentario"];

    $resp = $manager->avaliacaoNew($dados);

    if($resp){
        $log->setTexto("Avaliação efetuada com sucesso\n");
        $log->fileWriter();

        ?>
            <form method="get" name="myForm" id="myForm" action="../../paginas/servicos.php">
                <input type="hidden" name="msg" value="FR53">
            </form>
            <script>
                document.getElementById("myForm").submit();
            </script>
        <?php
        exit();
    } else {
        $log->setTexto("Avaliação mal sucessedida\n");
        $log->fileWriter();

        ?>
            <form method="get" name="myForm" id="myForm" action="../../paginas/servicos.php">
                <input type="hidden" name="msg" value="FR00">
            </form>
            <script>
                document.getElementById("myForm").submit();
            </script>
        <?php
        exit();
    }
   
}