<?php
require "../Model/manager.class.php";
$id = $_POST["id"];

$maneger = new Manager();
$dados = $maneger->CarrosselPuxar($id)

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
        <input type="hidden" name="carrosselEdit" value="1">
        <input type="hidden" name="id" value="<?=$dados["id"];?>">
        
        <label> ImgGd: </label>
        <img src='../../Assets/carrossel/<?= $dados["imggd"] ?>' alt='Imagem Grande' style='width:100px;'><br>
        <input type="file" name="imggd" accept=".jpeg,.jpg,.png,.jfif"><br><br>

        <label> Alt Gd </label>
        <input type="text" name="altgd" value="<?= $dados["altgd"]?>"><br><br>

        <label> ImgPq: </label>
        <img src='../../Assets/carrossel/<?= $dados["imgpq"] ?>' alt='Imagem Pequena' style='width:100px;'><br>
        <input type="file" name="imgpq" accept=".jpeg,.jpg,.png,.jfif"><br><br>

        <label> Alt Pq </label>
        <input type="text" name="altpq" value="<?= $dados["altpq"]?>"><br><br>

        <label for="Senha"> Status </label><br>
        <select name="status" id="status" class="formBasico">
            <option value="1" <?php echo $dados["status"] == 1 ? "selected":""?>> Ativo </option>
            <option value="0"<?php echo $dados["status"] == 0 ? "selected":""?>> Inativo </option>
        </select><br><br>

        <input type="submit" value="Editar">
    </form>
</body>
</html>