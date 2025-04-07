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
  <title>Formulário Atualizado</title>
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

    .form-container input, 
    .form-container textarea,
    .form-container select {
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
        <input type="hidden" name="finInt" value="1">
        <input type="hidden" name="id" value="<?=$id?>">
        <!-- Linha Foto de Perfil -->
        <div class="row">
          <div class="col-12">
            <label for="fotoPerfil">Foto de Perfil</label>
            <input type="file" id="fotoPerfil" name="fp" accept=".jpeg,.jpg,.png,.jfif">
          </div>
        </div>
        <!-- Linha Vídeo -->
        <div class="row">
          <div class="col-12">
            <label for="video">Vídeo</label>
            <input type="file" id="video" name="va" accept=".mp4">
          </div>
        </div>
        <!-- Linha Texto de Apresentação -->
        <div class="row">
          <div class="col-12">
            <label for="textoApresentacao">Texto de Apresentação</label>
            <textarea id="textoApresentacao" name="tv" rows="4" placeholder="Escreva uma breve apresentação"></textarea>
          </div>
        </div>
        <!-- Linha Formações -->
        <div class="row">
          <div class="col-12">
            <label for="formacoes">Formações</label>
            <textarea id="formacoes" name="formacao" rows="3" placeholder="Liste suas formações"></textarea>
          </div>
        </div>
        <!-- Linha Tempo de Experiência -->
        <div class="row">
          <div class="col-12">
            <label for="tempoExperiencia">Tempo de Experiência</label>
            <select id="tempoExperiencia" name="te">
            <option value="m1"> Menos de 1 ano </option>
            <option value="1a2"> 1-2 anos </option>
            <option value="2a3"> 2-3 anos </option>
            <option value="3a4"> 3-4 anos </option>
            <option value="4m"> 4+ anos </option>
            </select>
          </div>
        </div>
        <!-- Linha Gênero -->
        <div class="row">
          <div class="col-12">
            <label for="genero">Gênero</label>
            <select id="genero" name="genero">
              <option value="" disabled selected>Selecione...</option>
              <option value="masculino">Masculino</option>
              <option value="feminino">Feminino</option>
              <option value="nao-binario">Não-binário</option>
              <option value="outro">Outro</option>
              <option value="pnd">Prefiro não dizer</option>
            </select>
          </div>
        </div>
        <!-- Linha Cor/Raça -->
        <div class="row">
          <div class="col-12">
            <label for="corRaca">Cor/Raça</label>
            <select id="corRaca" name="corRaca">
              <option value="" disabled selected>Selecione...</option>
              <option value="branca">Branca</option>
              <option value="preta">Preta</option>
              <option value="parda">Parda</option>
              <option value="amarela">Amarela</option>
              <option value="indigena">Indígena</option>
              <option value="outra">Outra</option>
              <option value="pnd">Prefiro não dizer</option>
            </select>
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
