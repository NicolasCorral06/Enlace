<?php

session_start();
session_destroy();
?>

<form method="post" name="myForm" id="myForm" action="../interpreteLogin.php">
    <input type="hidden" name="msg" value="OP51">
</form>

<script>
    document.getElementById('myForm').submit();
</script>
