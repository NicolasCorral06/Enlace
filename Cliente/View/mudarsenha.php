<?php
session_start();

if($_SESSION["id_cli"] == "" || !isset($_SESSION["id_cli"])){
    ?>
        <form method="post" name="myForm" id="myForm" action="../../Cliente/clienteLogin.php">
            <input type="hidden" name="msg" value="OA00">
        </form>
        <script>
            document.getElementById("myForm").submit();
        </script>
    <?php
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Mudar senha </title>
</head>
<body>
    <?php
    if(isset($_POST["mudar_senhaC"]) && $_POST["mudar_senhaC"] == 1 ){
        ?>
        <form action="../../Adm/Controller/cliController.php" method="post">
                <input type="hidden" name="idCli" value="<?= $_SESSION["id_cli"] ?>">
                <input type="hidden" name="mudarSenhaConfirm" value="1">

                <label> Informe sua nova senha </label><br>
                <input type="password" name="pass1" required><br><br>

                <label> Informe novamente a senha </label><br>
                <input type="password" name="pass2" required><br><br>

                <input type="submit" value="Enviar">
            </form>

        <?php
    } else {
        ?>
            <form action="../../Adm/Controller/cliController.php" method="post">
                <input type="hidden" name="idCli" value="<?= $_POST["idCli"] ?>">
                <input type="hidden" name="emailCli" value="<?= $_SESSION["email_cli"] ?>">
                <input type="hidden" name="mudarSenhaCodigo" value="1">
                
                <label> Informe o codigo que você recebeu pelo email <?= $_SESSION["email_cli"] ?> </label><br>
                <input type="number" name="codigo" maxlength="6" required><br><br>

                <input type="submit" value="Enviar">
            </form>
        <?php
    } 
    
    
    
    ?>
    
</body>
</html>