<?php
session_start();
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
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #ddd;
        }
        th, td {
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #335e92;
            color: white;
        }
        input[type="submit"]{
            background-color: #335e92;
            color: white;
            border: none;
            padding: 10px 20px;
            text-decoration: none;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 4px;
        }
        button {
            background-color: transparent;
            color: #ba6d67;
            border: none;
            cursor: pointer;
        }
        .fa-trash {
            font-size: 20px;
        }
    </style>
    <script>
        function confirmDelete(id) {
            var resp = confirm("Tem certeza que deseja apagar este registro?");
            if (resp == true) {
                location.href = "../Controller/controller.php?adm_delete=1&id=" + id;
            } else {
                return null;
            }
        }
    </script>
</head>
<body>    
    <?php
        require "../Model/manager.class.php";
        $manager = new Manager();
        $dados = $manager->intDP_TEMPListar();
        
        if(isset($dados["num"]) && $dados["num"] > 0){
    ?>
    <table>
        <tr>
            <th>ID</th>
            <th>ID_int</th>
            <th>RG-FRENTE</th>
            <th>RG-VERSO</th>
            <th>COMP.RESIDENCIA</th>
            <th>CAR.TRABALHO</th>
            <th>ANTE.CRIMINAIS</th>
            <th>NOME BANCO</th>
            <th>NUM. DA AGENCIA</th>
            <th>NUM. DA CONTA</th>
            <th>STATUS</th>
            <th></th>
            <th></th>

        </tr>
        <?php
            for($i = 1; $i <= $dados["num"]; $i++){
                echo "<tr>";
                echo "<td>" . $dados[$i]["id"] . "</td>";
                echo "<td>" . $dados[$i]["id_int"] . "</td>";
                echo "<td>
                    <a href='../../Assets/Interprete/dados_pessoais/" . $dados[$i]["rg_frente"] . "' target='_blank'> RG FRENTE </a>
                </td>";
                echo "<td>
                    <a href='../../Assets/Interprete/dados_pessoais/" . $dados[$i]["rg_verso"] . "' target='_blank'> RG VERSO </a>
                </td>";
                echo "<td>
                    <a href='../../Assets/Interprete/dados_pessoais/" . $dados[$i]["comp_resi"] . "' target='_blank'> COMP. RESIDENCIA </a>
                </td>";
                echo "<td>
                    <a href='../../Assets/Interprete/dados_pessoais/" . $dados[$i]["car_trabalho"] . "' target='_blank'> CAR. TRABALHO </a>
                </td>";
                if($dados[$i]["ante_criminais"] != "" || isset($dados[$i]["ante_criminais"])){
                    echo "<td>
                    <a href='../../Assets/Interprete/dados_pessoais/" . $dados[$i]["ante_criminais"] . "' target='_blank'> ANTE. CRIMINAIS </a>
                    </td>";
                } else {
                    echo "<td> Sem ante. criminais </td>";
                }
                

                echo "<td>" . $dados[$i]["db1"] . "</td>";
                echo "<td>" . $dados[$i]["db2"] . "</td>"; 
                echo "<td>" . $dados[$i]["db3"] . "</td>";
                echo "<td>" . $dados[$i]["status"] . "</td>";

                echo "<td>";
                ?>
                    <form name="formEdit" action="../Controller/intController.php" method="post">
                        <input type="hidden" name="id" value="<?=$dados[$i]['id'];?>">
                        <input type="hidden" name="intDPAprovado" value="1">
                        <input type="submit" name="sbmt" value="Aprovado">
                    </form>
                <?php
                echo "</td>";

                echo "<td>";
                ?>
                    <form name="formEdit" action="../Controller/intController.php" method="post">
                        <input type="hidden" name="id" value="<?=$dados[$i]['id'];?>">
                        <input type="hidden" name="intDPNegado" value="1">
                        <input type="submit" name="sbmt" value="Negado">
                    </form>
                <?php
                echo "</td>";
            }
        ?>
    </table>
    <?php
    } else {
        echo "<b>Nenhuma solicitação de um interprete novo</b>";
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
   if (isset($_REQUEST["msg"])) {
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
