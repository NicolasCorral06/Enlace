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
$id = $_SESSION["id_int"];

$maneger = new Manager();
$dados = $maneger->intPpuxar($id)

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Atualizar perfil </title>
</head>
<body>
<form action="../../Adm/Controller/intController.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="intPedit" value="1">
        <input type="hidden" name="id" value="<?=$dados["id"];?>">
        <input type="hidden" name="id_int" value="<?=$dados["id_int"];?>">
        

        <label> Foto Perfil: </label>
        <img src='../../Assets/interprete/perfil/<?= $dados["foto_perfil"] ?>' style='width:100px;'><br>
        <input type="file" name="foto_perfil" accept=".jpeg,.jpg,.png,.jfif"><br><br>

        <label> Video apresentação: </label>
        <video src='../../Assets/interprete/perfil/<?= $dados["video_apre"] ?>' controls  style='width:200px;' >
            naõ foi possivel carregar o video
        </video><br>
        <input type="file" name="video_apre" accept=".mp4"><br><br>

        <label> texto de apresentação: </label><br>
        <textarea name="texto_apre" required><?= $dados["texto_apre"]; ?></textarea><br><br>

        <label> Formações: </label><br>
        <input type="text" name="formacao" value="<?=$dados["formacao"];?>" required><br><br>

        <label> tempo de experiencia: </label><br>
        <select name="tempo_exp" id="">
            <option <?= ($dados["tempo_exp"] == "m1" ? "selected" : "")?> value="m1"> Menos de 1 ano </option>
            <option <?=($dados["tempo_exp"] == "1a2" ? "selected" : "")?> value="1a2"> 1-2 anos </option>
            <option <?=($dados["tempo_exp"] == "2a3" ? "selected" : "")?> value="2a3"> 2-3 anos </option>
            <option <?=($dados["tempo_exp"] == "3a4" ? "selected" : "")?> value="3a4"> 3-4 anos </option>
            <option <?=($dados["tempo_exp"] == "4m" ? "selected" : "")?> value="4m"> 4+ anos </option>
        </select><br><br>

        <label> Gênero </label>
        <select name="genero" id="genero">
            <option <?=($dados["genero"] == "masculino" ? "selected" : "")?> value="masculino">Masculino</option>
            <option <?=($dados["genero"] == "feminino" ? "selected" : "")?> value="feminino">Feminino</option>
            <option <?=($dados["genero"] == "nao-binario" ? "selected" : "")?> value="nao-binario">Não-binário</option>
            <option <?=($dados["genero"] == "outro" ? "selected" : "")?> value="outro">Outro</option>
            <option <?=($dados["genero"] == "pnd" ? "selected" : "")?> value="pnd">Prefiro não dizer</option>
        </select><br><br>

        <label> Cor/Raça: </label>
        <select name="corRaca" id="corRaca">
            <option <?=($dados["corRaca"] == "branca" ? "selected" : "")?> value="branca">Branco(a)</option>
            <option <?=($dados["corRaca"] == "preta" ? "selected" : "")?> value="preta">Preto(a)</option>
            <option <?=($dados["corRaca"] == "parda" ? "selected" : "")?> value="parda">Pardo(a)</option>
            <option <?=($dados["corRaca"] == "amarela" ? "selected" : "")?> value="amarela">Amarelo(a)</option>
            <option <?=($dados["corRaca"] == "indigena" ? "selected" : "")?> value="indigena">Indígena</option>
            <option <?=($dados["corRaca"] == "pnd" ? "selected" : "")?> value="pnd">Prefiro não dizer</option>
        </select><br><br>

        <input type="submit" value="Editar">
    </form>
</body>
</html>