<?php

session_start();
session_destroy();
?>

<form method="post" name="myForm" id="myForm" action="../clienteLogin.php">
    <input type="hidden" name="msg" value="OP51">
</form>

<script>
    document.getElementById('myForm').submit();
</script>
