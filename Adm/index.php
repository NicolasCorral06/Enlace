<?php 
session_start();
if (isset($_SESSION['id_adm'])){ 
    session_destroy();
}

/*
if (isset($_REQUEST["msg"])) {
    require_once "Model/msg.php";
    $cod = $_REQUEST["msg"];
    $msgExibir = $MSG[$cod];
    //echo "<script>alert('" . $msgExibir . "')</script>";
}
*/

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Início </title>
        <link href="https://cdn.jsdelivr.net/gh/eliyantosarage/font-awesome-pro@main/fontawesome-pro-6.5.1-web/css/all.min.css" rel="stylesheet">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

        <link rel="stylesheet" href="../Assets-amanda/style/styleLogin.css">


        <title> Login ADM </title>
    </head>
    <style>
        .col-12{
            width: 100%;
            height: 10vh;
            background-color: #4169e1;
        }

        .footer{
            width: 100%;
            height: 10vh;
            background-color: #4169e1;
            position: absolute;
            bottom: 0px;
        }
    </style>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
            </div>
        </div>
        <br><br><br>
        <div class="row">
            <div class="col-4"></div>
            <div class="col-4" style="justify-content: center; align-items: center; display: flex;">
                <form class="form" action="Controller/controller.php" method="POST">
                <input type="hidden" name="login_adm" value="1">
                    <p class="title">Login</p>
                    <p class="message">Preencha os campos para entrar em seu perfil </p>
                    <label>
                        <input class="input" type="text" name="email" value="celsoincrivel@gmail.com" placeholder="Digite seu email">
                        <span>Email</span>
                    </label> 
                        
                    <label>
                        <input class="input" type="password" name="senha" value="123" autocomplete="off" placeholder="Digite sua senha">
                        <span>Senha</span>
                    </label>
                    <a href="#" data-toggle="modal" data-target="#mudarSenha" class="esqueciSenha-login text-content"> Esqueci a senha </a>   
                    <button class="submit" value="Logar">Entrar</button>
                    <a href="../index.php"> Voltar </a>
                </form>
            </div>
            <div class="col-4"></div>
        </div>
        <div class="row footer">
            <div class="col-12">
            </div>
        </div>
    </div>

    <div class="modal fade" id="textomodalcelsomito" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Aviso!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p id="textomodal">
            
        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Confirmar</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="mudarSenha" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> Chamado de mudança de senha! </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p id="textomodal">
            <form action="Controller/controller.php" method="POST">
                <input type="hidden" name="mudarSenha" value="1">

                <label> Enviar um chamado para solicitação de mudança de senha </label><br>
                <input type="email" name="email" placeholder="Digite seu email" required><br><br>

                <input type="submit" value="Confirmar">
            </form>
        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Confirmar</button>
      </div>
    </div>
  </div>
</div>

    <footer>
    </footer>

    

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>

<?php

   if (isset($_REQUEST["msg"]) ) {
    require_once "Model/msg.php";
    $cod = $_REQUEST["msg"];
    $msgExibir = $MSG[$cod];
    echo "<script>
    var textomodal = document.getElementById('textomodal')
    textomodal.innerHTML = '".$MSG[$cod]."'
    $('#textomodalcelsomito').modal('show');

    </script>";
}

?>