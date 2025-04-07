<?php

session_start();

if (isset($_REQUEST["msg"])) {
    require_once "../Adm/Model/msg.php";
    $cod = $_REQUEST["msg"];
    $msgExibir = $MSG[$cod];
}



if (isset($_SESSION["id_int"])) {
    header("Location: ../interprete/View/interprete.php");
}
?>
<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../assets - amanda2/style/styleCadastro-interprete.css">
    <title>Login Interprete</title>
</head>
<body>

    <!-- ------- VLIBRAS --------- -->
    <div vw class="enabled">
      <div vw-access-button class="active"></div>
      <div vw-plugin-wrapper>
        <div class="vw-plugin-top-wrapper"></div>
      </div>
    </div>
    <script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
    <script>
      new window.VLibras.Widget('https://vlibras.gov.br/app');
    </script>

    <!-- ------- ALTERAR FONTE --------- -->
    <aside class="fixed-button" aria-label="Ajustar tamanho da fonte">
        <button class="buttonConta">
            <i id="toggleTheme" class="bi bi-sun"></i>
        </button>
        <br><br>
        <button onclick="aumentarFonte()" aria-controls="main-content" aria-label="Aumentar tamanho da fonte">A <i class="bi bi-plus"></i></button><br>
        <hr>
        <button onclick="diminuirFonte()" aria-controls="main-content" aria-label="Reduzir tamanho da fonte">A <i class="bi bi-dash"></i></button>
    </aside>



   <!-- ------- CONTEÚDO --------- -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-5 colBoasvindas">
                <h1 class="text-content">Olá, bem vindo!</h1>
                <p class="text-content">Faça login para acessar sua área exclusiva, gerenciar sua agenda de serviços e acompanhar suas oportunidades de trabalho.</p>
                <br>
                <a href="../Paginas/contatos.php" class="text-content">Está tendo algum problema ?</a>
                <br><br><br>
                <a href="interpreteCadastro.php" class="text-content"> Se cadastre </a>
                <br><br><br><br><br>
                <a href="../index.php" class="text-content"> Voltar </a>

                <br>
            </div>
            <div class="col-7 colAcesso">
                <h1 class="text-content">Acessar</h1>
                <br>
                <form action="../adm/controller/intController.php" method="post">
                    <input type="hidden" name="intLogin" value="1">

                    <label for="" class="text-content"> Email </label><br>
                    <input type="email" name="email" class="text-content" required><br><br>

                    <label for="" class="text-content"> Senha </label><br>
                    <input type="password" name="senha" class="text-content"><br><br>

                    <a href="javascript:void(0)" class="text-content" style="color: #2e6b73" onclick="window.open('mudarSenha.php', '_blank', 'width=500,height=400,resizable=yes,scrollbars=yes')"> Esqueci a senha</a>

                    <br><br>

                    <button class="text-content" tupe="submit"> Acessar </button>
                </form>
            </div>
        </div>
    </div>

 
    <script src="../assets - amanda2/js/script-paginas.js"></script>

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
  
  
      <footer>
      </footer>
  
      
  
      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
  </html>
  
  <?php
  
     if (isset($_POST["msg"])) {
      require_once "../adm/Model/msg.php";
      $cod = $_POST["msg"];
      $msgExibir = $MSG[$cod];
      echo "<script>
      var textomodal = document.getElementById('textomodal')
      textomodal.innerHTML = '".$MSG[$cod]."'
      $('#textomodalcelsomito').modal('show');
  
      </script>";
  }
  
  ?>
