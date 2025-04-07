<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Administração</title>
    <link rel="stylesheet" href="styles.css"> 
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
   

    <form action="../Controller/controller.php" method="post">
        <input type="hidden" name="adm_new" value="1">
        <h2>Adicionar Administrador</h2>

        <label for="nome">Nome</label>
        <input type="text" id="nome" name="nome" required>

        <label for="email">Email</label>
        <input type="email" id="email" name="email" required>

        <label for="senha1">Senha</label>
        <input type="password" id="senha1" name="senha1" required>

        <label for="senha2">Digite novamente a Senha</label>
        <input type="password" id="senha2" name="senha2" required>

        <label> Poder </label><br>
        <select name="poder" id="">
            <option value="1"> 1 - ADM </option>
            <option value="2"> 2 - RH </option>
            <option value="3"> 3 - GESTOR DE CHAMADOS </option>
            <option value="4"> 4 - DESIGNER </option>
            <option value="5"> 5 - ADM VIP </option>
        </select><br><br>

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
