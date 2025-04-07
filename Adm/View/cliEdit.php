<?php
require "../Model/manager.class.php";
$id = $_POST["id"];

$maneger = new Manager();
$dados = $maneger->CliPuxar($id)

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
       body {
    font-family: 'Arial', sans-serif;
    margin: 0;
    padding: 20px;
    background-color: #f7f7f7;
    display: flex;
    flex-direction: column;
    align-items: center;
    min-height: 100vh;
}

form {
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    background-color: white;
    max-width: 400px;
    width: 100%;
    margin-bottom: 20px;
}

h2 {
    text-align: center;
    color: #335e92;
    margin-bottom: 20px;
}

label {
    font-weight: bold;
    display: block;
    margin-bottom: 5px;
}

input[type="text"],
input[type="email"],
input[type="password"],
select {
    width: 100%;
    padding: 10px;
    margin-top: 5px;
    margin-bottom: 15px;
    border: 1px solid #ddd;
    border-radius: 4px;
    box-sizing: border-box;
}

input[type="text"]:focus,
input[type="email"]:focus,
input[type="password"]:focus,
select:focus {
    border-color: #335e92;
    outline: none;
}

input[type="submit"] {
    background-color: #335e92;
    color: white;
    border: none;
    padding: 10px;
    cursor: pointer;
    border-radius: 4px;
    width: 100%;
    font-size: 16px;
    transition: background-color 0.3s ease;
}

input[type="submit"]:hover {
    background-color: #294b72;
}

button.voltar {
    background-color: transparent;
    color: #335e92;
    border: 1px solid #335e92;
    padding: 10px;
    cursor: pointer;
    border-radius: 4px;
    width: 100%;
    font-size: 16px;
    transition: background-color 0.3s ease;
}

button.voltar:hover {
    background-color: #f0f0f0;
}
    </style>
</head>
<body>
    <form action="../Controller/controller.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="cliEdit" value="1">
        <input type="hidden" name="id" value="<?=$dados["id"];?>">
        <input type="hidden" name="foto_perfil_antiga" value="<?=
        $dados["foto_perfil"] != "" ? $dados["foto_perfil"] : "1";
        ?>">
        

        <label> Foto </label><br>
        <?php
        if($dados["foto_perfil"] == ""){
            echo "Usuário sem foto<br>";
        } else {
            ?>
            <img src="../../Assets/Cliente/<?= $dados["foto_perfil"] ?>" alt="Foto cliente" width="150px" height="150px">
            <?php
        }
        
        ?>
        <input type="file" name="foto_perfil" accept=".jpeg,.jpg,.png,.jfif" ><br><br>

        <label> Nome </label><br>
        <input type="text" name="nome" value="<?= $dados["nome"]?>"><br><br>

        <label> Email </label><br>
        <input type="text" name="email" value="<?= $dados["email"]?>"><br><br>

        <label> Telefone </label><br>
        <input type="text" name="telefone" value="<?= $dados["telefone"]?>"><br><br>

        <label> CPF </label><br>
        <input type="text" name="cpf" value="<?= $dados["cpf"]?>"><br><br>

        <label> Data de nascimento </label><br>
        <input type="date" name="nascimento" value="<?= $dados["nascimento"]?>"><br><br>

        <label> Senha(não obrigatorio) </label><br>
        <input type="password" name="senha"><br><br>

        <label for="Senha"> Status </label><br>
        <select name="status" id="status" class="formBasico">
            <option value="1" <?= $dados["status"] == 1 ? "selected":""?>> Ativo </option>
            <option value="0"<?= $dados["status"] == 0 ? "selected":""?>> Inativo </option>
        </select><br><br>

        <input type="submit" value="Editar">
    </form>
</body>
</html>