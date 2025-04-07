<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
       body {
    font-family: Arial, sans-serif;
    margin: 20px;
    background-color: #f7f7f7;
    display: flex;
    flex-direction: column;
    align-items: center;
}

form {
    padding: 90px; 
    border-radius: 8px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    max-width: 400px;
    width: 100%;
    background-color: white;
    margin-top: 20px;
}

label {
    font-weight: bold;
    display: block;
    margin-bottom: 5px;
}

input[type="text"],
input[type="file"],
select {
    width: 100%;
    padding: 10px;
    margin-top: 5px;
    margin-bottom: 15px;
    border: 1px solid #ddd;
    border-radius: 4px;
}

input[type="submit"] {
    background-color: #335e92;
    color: white;
    border: none;
    padding: 10px;
    cursor: pointer;
    border-radius: 4px;
    width: 100%;
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
    transition: background-color 0.3s ease;
    margin-bottom: 20px;
}

button.voltar:hover {
    background-color: #f0f0f0;
}

    </style>
</head>
<body>


    <form action="../Controller/controller.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="servico_new" value="1">

        <label for="nome">Nome</label>
        <input type="text" id="nome" name="nome" required>

        <label for="sobre">Sobre</label>
        <input type="text" id="sobre" name="sobre" required>

        <label for="serve">Serve</label>
        <input type="text" id="serve" name="serve" required>

        <label for="preco">Preço</label>
        <input type="text" id="preco" name="preco" required>

        <label for="status">Status</label>
        <select id="status" name="status">
            <option value="1" selected>Ativo</option>
            <option value="0">Inativo</option>
        </select>

        <input type="submit" value="Adicionar">
    </form>

    
</body>
</html>

<?php
if (isset($_REQUEST['msg'])) {
    require_once '../Model/msg.php';
    $cod = $_REQUEST['msg'];
    echo "<script>alert('" . $MSG[$cod] . "')</script>";
}
?>
