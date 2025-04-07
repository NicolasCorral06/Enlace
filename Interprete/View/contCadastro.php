<?php
session_start();

if(!isset($_SESSION["id_int"]) || $_SESSION["id_int"] == ""){
    session_abort();
    ?>
        <form action="../paginas/interpreteLogin.php" name="return" id="return" method="post">
            <input type="hidden" name="cod" value="OA02">
        </form>
        <script>
            document.getElementById("return").submit();
        </script>
    <?php
}

$id = $_SESSION["id_int"];

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Formulário Responsivo</title>
  <!-- Link do Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body, html {
      height: 100%;
      margin: 0;
      font-family: Arial, sans-serif;
    }

    .container-fluid {
      height: auto;
      padding: 5%;
      display: flex;
      justify-content: center;
      align-items: center;
      background: linear-gradient(#2e6b73 50%, #2e6b7388 50%);
    }

    .form-container {
      background-color: white;
      width: 90%;
      max-width: 800px;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
      overflow-y: auto; /* Para permitir rolagem se necessário */
    }

    .form-container h1 {
      font-size: 24px;
      margin-bottom: 20px;
      text-align: center;
    }

    .form-container label {
      font-weight: bold;
    }

    .form-container input[type="file"], 
    .form-container input[type="text"] {
      width: 100%;
      padding: 10px;
      margin: 10px 0;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    .form-container button {
      background-color: blue;
      color: white;
      border: none;
      padding: 10px 20px;
      border-radius: 5px;
      cursor: pointer;
      font-size: 16px;
      display: block;
      width: 100%;
    }

    .form-container button:hover {
      background-color: darkblue;
    }
  </style>
</head>
<body>
  <div class="container-fluid">
    <div class="form-container">
      <h1>Formulário</h1>
      <form action="../../Adm/Controller/intController.php" method="POST" enctype="multipart/form-data">
      <input type="hidden" name="contInt" value="1">
      <input type="hidden" name="id" value="<?=$id?>">
        <!-- Linha RG frente e verso -->
        <div class="row">
          <div class="col-md-6">
            <label for="rgFrente">RG Frente</label>
            <input type="file" id="rgFrente" name="ff" accept=".pdf" required>
          </div>
          <div class="col-md-6">
            <label for="rgVerso">RG Verso</label>
            <input type="file" id="rgVerso" name="fv" accept=".pdf" required>
          </div>
        </div>
        <!-- Linha Comprovante de Residência -->
        <div class="row">
          <div class="col-12">
            <label for="comprovanteResidencia">PDF Comprovante de Residência</label>
            <input type="file" id="comprovanteResidencia" name="cr" accept=".pdf" required>
          </div>
        </div>
        <!-- Linha Carteira de Trabalho -->
        <div class="row">
          <div class="col-12">
            <label for="carteiraTrabalho">PDF Carteira de Trabalho</label>
            <input type="file" id="carteiraTrabalho" name="ct" accept=".pdf" required>
          </div>
        </div>
        <!-- Linha Antecedentes Criminais -->
        <div class="row">
          <div class="col-12">
            <label for="antecedentes">PDF Antecedentes Criminais</label>
            <input type="file" id="antecedentes" name="cac" accept=".pdf">
          </div>
        </div>
        <!-- Linha Nome do Banco -->
        <div class="row">
          <div class="col-12">
            <label for="nomeBanco">Nome do Banco</label>
            <input type="text" id="nomeBanco" name="b1" placeholder="Digite o nome do banco" required>
          </div>
        </div>
        <!-- Linha Número da Conta -->
        <div class="row">
          <div class="col-12">
            <label for="numeroConta">Número da Conta</label>
            <input type="text" id="numeroConta" name="b2" placeholder="Digite o número da conta" required>
          </div>
        </div>
        <!-- Linha Número da Agência -->
        <div class="row">
          <div class="col-12">
            <label for="numeroAgencia">Número da Agência</label>
            <input type="text" id="numeroAgencia" name="b3" placeholder="Digite o número da agência" required>
          </div>
        </div>
        <!-- Botão de Enviar -->
        <div class="row">
          <div class="col-12">
            <button type="submit">Enviar</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <!-- Script do Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>