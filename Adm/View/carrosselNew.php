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
    justify-content: center;
    align-items: center;
    min-height: 100vh;
}

form {
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    max-width: 400px;
    width: 100%;
    background-color: white; /* Fundo branco para o formulário */
    margin-top: 20px;
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
    box-sizing: border-box; /* Garante que o padding não cause quebra */
}

input[type="text"]:focus, 
input[type="email"]:focus, 
input[type="password"]:focus, 
select:focus {
    border-color: #335e92;
    outline: none; /* Remove contorno padrão ao focar */
}

input[type="submit"] {
    background-color: #335e92;
    color: white;
    border: none;
    padding: 10px;
    cursor: pointer;
    border-radius: 4px;
    width: 100%;
    font-size: 16px; /* Tamanho de fonte maior para o botão */
    transition: background-color 0.3s ease; /* Transição suave */
}

input[type="submit"]:hover {
    background-color: #294b72;
}
    </style>
</head>
<body>
<form action="../Controller/controller.php" method="post" enctype="multipart/form-data">
        <h2>Adicionar Carrossel</h2>
        <input type="hidden" name="carrossel_new" value="1">
        
        <label>Imagem Grande</label>
        <input type="file" name="img-gd" accept=".jpeg, .jpg, .png, .jfif" required>

        <label>Alt Imagem Grande</label>
        <input type="text" name="altgd" required>

        <label>Imagem Pequena</label>
        <input type="file" name="img-pq" accept=".jpeg, .jpg, .png, .jfif" required>

        <label>Alt Imagem Pequena</label>
        <input type="text" name="altpq" required>

        <label>Status</label>
        <select name="status">
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
