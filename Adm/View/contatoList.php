<?php
session_start();

if(!isset($_SESSION["id_adm"]) || $_SESSION["id_adm"] == ""){
    session_abort();
    ?>
        <form action="../index.php" name="return" id="return" method="post">
            <input type="hidden" name="cod" value="OA02">
        </form>
        <script>
            document.getElementById("return").submit();
        </script>
    <?php
}

require "../Model/manager.class.php";
$manager = new Manager();
$dadosL = $manager->contatoListLida(); 
$dadosNL = $manager->contatoListNLida(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin List</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/gh/eliyantosarage/font-awesome-pro@main/fontawesome-pro-6.5.1-web/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <link rel="stylesheet" href="../css/style2.css">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <style>
        body {
    font-family: 'Roboto', sans-serif;
    margin: 20px;
    background-color: #f0f4f8;
    color: #333;
    line-height: 1.6;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
}

th, td {
    border: 1px solid #e0e0e0;
    padding: 12px;
    text-align: left;
    transition: background-color 0.3s ease;
}

th {
    background-color: #335e92;
    color: white;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

tr:hover {
    background-color: rgba(51, 94, 146, 0.1);
}

input[type="submit"] {
    background-color: #335e92;
    color: white;
    border: none;
    padding: 12px 24px;
    margin: 4px 2px;
    cursor: pointer;
    border-radius: 8px;
    font-size: 16px;
    transition: background-color 0.3s ease, transform 0.2s ease;
}

input[type="submit"]:hover {
    background-color: #2a4b6e;
    transform: scale(1.05);
}

button {
    background-color: transparent;
    color: #ba6d67;
    border: none;
    cursor: pointer;
    font-size: 18px;
    transition: color 0.3s ease, transform 0.2s ease;
}

button:hover {
    color: #9c4a48;
    transform: scale(1.1);
}

.fa-trash {
    font-size: 20px;
    transition: color 0.3s ease;
}

.fa-trash:hover {
    color: #ba6d67;
}

input[type="text"], input[type="email"], textarea {
    width: calc(100% - 24px);
    padding: 12px;
    margin: 10px 0;
    border: 1px solid #ddd;
    border-radius: 8px;
    font-size: 16px;
    transition: border-color 0.3s ease;
}

input[type="text"]:focus, input[type="email"]:focus, textarea:focus {
    border-color: #335e92;
    outline: none;
}
    </style>
    <script>
        function confirmDelete(id) {
            var resp = confirm("Tem certeza que deseja apagar este registro?");
            if (resp == true) {
                location.href = "../Controller/controller.php?carrossel_delete=1&id=" + id;
            } else {
                return null;
            }
        }
    </script>
</head>
<body>   
    
    <h2> Mensagens Lidas </h2>
    <?php
        if (isset($dadosL["num"]) && $dadosL["num"] > 0){
    ?>
    <table>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Email</th>
            <th>Telefone</th>
            <th>Assunto</th>
            <th>Mensagem</th>
            <th>Status</th>
        </tr>
        <?php
            for($i = 1; $i <= $dadosL["num"]; $i++){
                echo "<tr>";
                echo "<td>" . $dadosL[$i]["id"] . "</td>";
                echo "<td>" . $dadosL[$i]["nome"]  . "</td>";
                echo "<td>" . $dadosL[$i]["email"] . "</td>";
                echo "<td>" . $dadosL[$i]["telefone"] . "</td>";

                echo "<td>";
                if($dadosL[$i]["assunto"] == "duvidas"){
                    echo "<span class='status process'> Duvidas </span>";
                } elseif($dadosL[$i]["assunto"] == "sugestoes"){
                    echo "<span class='status completed'> Sugestões </span>";
                } elseif($dadosL[$i]["assunto"] == "reclamacoes"){
                    echo "<span class='status pending'> Reclamações </span>";
                }
                echo "</td>";

                echo "<td>";
                $mensagem = $dadosL[$i]["mensagem"];
                if(strlen($mensagem) > 50) { 
                    echo substr($mensagem, 0, 50) . "..."; 
                    echo " <a href='#' data-toggle='modal' data-target='#mensagemModal" . $dadosL[$i]["id"] . "'>Ver mais</a>";
                } else {
                    echo $mensagem;
                }
                echo "</td>";

                echo "<td>";
                echo $dadosL[$i]["status"] == 1 ? "Lido" : "Não lido";
                echo "</td>";

                echo "<td>";
                ?>
                    <form name="formEdit" action="../controller/controller.php" method="post">
                        <input type="hidden" name="id" value="<?=$dadosL[$i]['id'];?>">
                        <input type="hidden" name="mudarStatusContato" value="1">
                        <input type="hidden" name="statusChange" value="LparaNL">
                        <input type="submit" name="sbmt" value="Não Lida">
                    </form>
                <?php
                echo "</td>";
                echo "</tr>";

                ?>
                    <div class="modal fade" id="mensagemModal<?= $dadosL[$i]["id"] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Mensagem Completa</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <?= nl2br($dadosL[$i]["mensagem"]); ?>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        </div>
                        </div>
                    </div>
                    </div>

                <?php
            }
        ?>
    </table>
    <?php
    } else {
        echo "Nenhuma avaliação encontrada!";
    }
    ?>

    <br><br>
    <h2> Mensagens Não Lidas </h2>
    <?php
        if (isset($dadosNL["num"]) && $dadosNL["num"] > 0){
    ?>
    <table>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Email</th>
            <th>Telefone</th>
            <th>Assunto</th>
            <th>Mensagem</th>
            <th>Status</th>
        </tr>
        <?php
            for($i = 1; $i <= $dadosNL["num"]; $i++){
                echo "<tr>";
                echo "<td>" . $dadosNL[$i]["id"] . "</td>";
                echo "<td>" . $dadosNL[$i]["nome"]  . "</td>";
                echo "<td>" . $dadosNL[$i]["email"] . "</td>";
                echo "<td>" . $dadosNL[$i]["telefone"] . "</td>";

                echo "<td>";
                if($dadosNL[$i]["assunto"] == "duvidas"){
                    echo "<span class='status process'> Duvidas </span>";
                } elseif($dadosNL[$i]["assunto"] == "sugestoes"){
                    echo "<span class='status completed'> Sugestões </span>";
                } elseif($dadosNL[$i]["assunto"] == "reclamacoes"){
                    echo "<span class='status pending'> Reclamações </span>";
                }
                echo "</td>";

                echo "<td>";
                $mensagem = $dadosNL[$i]["mensagem"];
                if(strlen($mensagem) > 50) { 
                    echo substr($mensagem, 0, 50) . "..."; 
                    echo " <a href='#' data-toggle='modal' data-target='#mensagemModal" . $dadosNL[$i]["id"] . "'>Ver mais</a>";
                } else {
                    echo $mensagem;
                }
                echo "</td>";

                echo "<td>";
                echo $dadosNL[$i]["status"] == 1 ? "Lido" : "Não lido";
                echo "</td>";

                echo "<td>";
                ?>
                    <form name="formEdit" action="../controller/controller.php" method="post">
                        <input type="hidden" name="id" value="<?=$dadosNL[$i]['id'];?>">
                        <input type="hidden" name="mudarStatusContato" value="1">
                        <input type="hidden" name="statusChange" value="NLparaL">
                        
                        <input type="submit" name="sbmt" value="Lida">
                    </form>
                <?php
                echo "</td>";

                echo "</tr>";

                ?>
                    <div class="modal fade" id="mensagemModal<?= $dadosNL[$i]["id"] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Mensagem Completa</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <?= nl2br($dadosNL[$i]["mensagem"]); ?>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        </div>
                        </div>
                    </div>
                    </div>

                <?php
            }
        ?>
    </table>
    <?php
    } else {
        echo "Nenhuma avaliação encontrada!";
    }
    ?>

<div class="modal fade" id="textomodalcelsomito" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Aviso!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p id="textomodal"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Confirmar</button>
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

</body>
</html>

<?php
   if (isset($_REQUEST["msg"]) && $_REQUEST["msg"] != 0) {
    require_once "../Model/msg.php";
    $cod = $_REQUEST["msg"];
    $msgExibir = $MSG[$cod];
    echo "<script>
    var textomodal = document.getElementById('textomodal')
    textomodal.innerHTML = '".$MSG[$cod]."'
    $('#textomodalcelsomito').modal('show');
    </script>";
}

?>
