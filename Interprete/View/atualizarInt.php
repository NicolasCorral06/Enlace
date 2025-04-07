<?php
session_start();
require "../../Adm/Model/manager.class.php";
if(!isset($_SESSION["id_int"]) || $_SESSION["id_int"] == ""){
    session_abort();
    ?>
        <form action="../interpreteLogin.php" name="return" id="return" method="post">
            <input type="hidden" name="cod" value="OA02">
        </form>
        <script>
            document.getElementById("return").submit();
        </script>
    <?php
    exit();
}
$maneger = new Manager();
$dados = array();
$dados["id"] = $_SESSION["id_int"];

$dados = $maneger->intPuxar($dados)

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Atualizar documentos </title>
</head>
<body>
<form action="../../Adm/Controller/intController.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="intEdit" value="1">
        <input type="hidden" name="id" value="<?=$dados["id"];?>">
        
        <label> Nome completo </label><br>
        <input type="text" name="nome" value="<?=$dados["nome"];?>"><br><br>

        <label> Email </label><br>
        <input type="text" name="email" value="<?=$dados["email"];?>"><br><br>

        <label> Telefone </label><br>
        <input type="text" name="telefone" value="<?=$dados["telefone"];?>"><br><br>

        <label> Data de nascimento </label><br>
        <input type="date" name="nascimento" value="<?=$dados["nascimento"];?>"><br><br>

        <label> Cidade de trabalho </label><br>
        <select name="cidade" id="cidade">
            <option <?= ($dados["cidade"] == "São Paulo") ? "selected" : "" ?> value="São Paulo"> São Paulo </option>
            <option <?= ($dados["cidade"] == "Guarulhos") ? "selected" : "" ?> value="Guarulhos"> Guarulhos </option>
            <option <?= ($dados["cidade"] == "Campinas") ? "selected" : "" ?> value="Campinas"> Campinas </option>
            <option <?= ($dados["cidade"] == "São Bernardo do Campo") ? "selected" : "" ?> value="São Bernardo do Campo"> São Bernardo do Campo </option>
            <option <?= ($dados["cidade"] == "Santo André") ? "selected" : "" ?> value="Santo André"> Santo André </option>
        </select><br><br>

        <label> Video </label><br>
        <video src='../../Assets/Interprete/<?=$dados["video"];?>' width="400px" controls>
            Não foi possivel reproduzir o video
        </video><br>
        <input type="file" name="video" accept=".mp4"><br><br>


        <input type="submit" value="Editar">
    </form>
</body>
</html>