<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../assets-amanda/style/styleDetalhes.css">
    <title> Mudar senha </title>
    <style>
        .container-fluid{
            height: 90vh;
            justify-content: center;
            display: flex;
            align-items: center;
            width: 100%;
        }

        .col-12{
            text-align: center;
        }

        .email{
            margin-top: 5%;
            border: none;
            border-bottom: 1px solid #7d7d7d;
            margin-bottom: 5%;
            width: 100%;
        }

        .buttonSenha{
            background-color: transparent;
            border: 1px solid #2e6b73;
            color: #2e6b73;
            padding: 0.9% 15%;
            position: absolute;
            right: 0;
            border-radius: 20px;
        }

        .duvida{
            position: absolute;
            left: 0;
            font-size: 0.8rem;
            color: #2e6b73;
        }
        
        h1{
            margin-bottom: 10%;
            font-size: 1.8rem;
            text-align: left !important;
            border-bottom: 3px solid #2e6b73;
            width: 50%;
        }

        .email-span{
            color: #2e6b73;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
            <?php
                if(isset($_POST["mudar_senhaC"]) && $_POST["mudar_senhaC"] == 1 ){
                    ?>
                    <form action="../Adm/Controller/intController.php" method="post">
                            <input type="hidden" name="int_identifier" value="<?= $_SESSION["int_identifier"];?>">
                            <input type="hidden" class="email" name="emailInt" value="<?= $_POST["emailInt"] ?>" placeholder="Digite seu e-mail">
                            <input type="hidden" name="codigo" value="<?= $_POST["codigo"] ?>">
                            <input type="hidden" name="mudarSenhaConfirm" value="1">
                        
                            <h1>Esqueci a senha</h1>
                            <br><br>

                            <label> Informe sua nova senha </label><br>
                            <input type="password" class="email" name="pass1" required><br><br>

                            <label> Informe novamente a senha </label><br>
                            <input type="password" class="email" name="pass2" required><br><br>
                            <br>
                            <a href="mailto:enlace.servico@gemail.com" class="duvida">Alguma dúvida?</a>
                            <input type="submit" class="buttonSenha" value="Enviar">
                        </form>

                    <?php
                } elseif(isset($_POST["aceitarCodigo"]) && $_POST["aceitarCodigo"] == 1) {
                    ?>
                        <form action="../Adm/Controller/intController.php" method="post">
                            <input type="hidden" name="int_identifier" value="<?= $_SESSION["int_identifier"];?>">
                            <input type="hidden" class="email" name="emailInt" value="<?= $_POST["emailInt"]; ?>" placeholder="Digite seu e-mail">
                            <input type="hidden" name="mudarSenhaCodigo" value="1">
                            <h1>Esqueci a senha</h1>
                            <span class="email-span"><?= $_POST["emailInt"]?></span>
                            <br><br>
                            <label> Informe o codigo que você recebeu pelo email </label><br>
                            <input type="number" class="email" name="codigo" maxlength="6" required><br><br>
                            <a href="mailto:enlace.servico@gemail.com" class="duvida">Alguma dúvida?</a>
                            <input type="submit" value="Enviar" class="buttonSenha">
                        </form>
                    <?php
                } else {
                    ?>
                        <form action="../Adm/Controller/intController.php" method="post">
                            <input type="hidden" name="emailVerify" value="1">
                            <input type="hidden" name="codigoGet" value="1">
                            <h1>Esqueci a senha</h1>
                            <label> Informe um email cadastrado para receber o código de verificação. </label><br>
                            <input type="email" class="email" name="email" required placeholder="Digite seu e-mail"><br><br>
                            <a href="mailto:enlace.servico@gemail.com" class="duvida">Alguma dúvida?</a>
                            <input type="submit" class="buttonSenha" value="Enviar">
                        </form>
                    <?php
                }
                
               
                
                ?>
            </div>
        </div>
    </div>
    
    
    <div class="modal fade" id="avisodoInterprete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Aviso!</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
            <p id="textomodalA">
                
            </p>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-primary" onclick="window.close()" data-dismiss="modal">Confirmar</button>
            </div>
        </div>
        </div>
    </div>
   
  
      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
  </html>

  <?php
  
    if (isset($_REQUEST["msgA"])) {
        echo "<script>
        var textomodalA = document.getElementById('textomodalA')
        textomodalA.innerHTML =  ' Senha Alterada com sucesso! <br> Feche essa janela e faça o login.'
        $('#avisodoInterprete').modal('show');

        </script>";
    }
    
  
  
  ?>