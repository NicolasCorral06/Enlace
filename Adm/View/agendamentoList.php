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
    font-family: 'Roboto', sans-serif;
    margin: 20px;
    background-color: #f0f4f8;
    color: #333;
    line-height: 1.6;
    height:100%;
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
        $dados = $manager->agendamentoListar();

        /*
            status = 4 = serviço rejeitado
            status = 3 = serviço concluido
            status = 2 = serviço pendente/falta de informação. 
            status = 1 = serviço aceito/pago
            status = 0 = serviço cancelado
        */


        echo "<h1> Concluido(s) </h1>";
        if($dados["num3"] > 0){
    ?>
    <table>
        <tr>
            <th>ID</th>
            <th>NOME SER.</th>
            <th>NOME CLI.</th>
            <th>PREÇO</th>
            <th>QUANT INT</th>
            <th>HORA(S) DE SER.</th>
            <th>CIDADE</th>

            <th>DATA</th>
            
            <th>STATUS</th>
        </tr>
        <?php
            for($i = 1; $i <= $dados["num3"]; $i++){
                echo "<tr>";
                echo "<td>" . $dados[$i]["id3"] . "</td>";
                echo "<td>" . $dados[$i]["nomeSer3"] . "</td>";
                //echo "<td>" . $dados[$i]["id_int3"] . "</td>";
                echo "<td>" . $dados[$i]["nomeCli3"] . "</td>";
                echo "<td>" . $dados[$i]["preco3"] . "</td>";
                echo "<td>" . $dados[$i]["quantInt3"] . "</td>";
                echo "<td>" . $dados[$i]["quantHoras3"] . "</td>";
                echo "<td>" . $dados[$i]["cidade3"] . "</td>";
                //echo "<td>" . $dados[$i]["codVerify3"] . "</td>";
                echo "<td>" . date("d/m/Y", strtotime($dados[$i]["data3"]))  . "</td>";
                //echo "<td>" . $dados[$i]["data_insercao3"] . "</td>";               
                echo "<td>";
                if ($dados[$i]["status3"] == 3) {
                    echo "Concluido";
                } else {
                    echo "FUDEO DEU ERRO";
                } 
                echo "</td>";
                
                echo "</tr>";
            }
        ?>
    </table>
    <?php
        } else {
            echo "Nenhum agendamento concluido encontrado!";
        }
    ?>

    <?php
        echo "<br><h1> Em espera </h1>";
        if($dados["num"] > 0){
    ?>
    <table>
        <tr>
            <th>ID</th>
            <th>NOME SER.</th>
            <th>NOME CLI.</th>
            <th>PREÇO</th>
            <th>QUANT INT</th>
            <th>HORA(S) DE SER.</th>
            <th>CIDADE</th>

            <th>DATA</th>
            
            <th>STATUS</th>
        </tr>
        <?php
            for($i = 1; $i <= $dados["num"]; $i++){
                echo "<tr>";
                echo "<td>" . $dados[$i]["id"] . "</td>";
                echo "<td>" . $dados[$i]["nomeSer"] . "</td>";
                //echo "<td>" . $dados[$i]["id_int"] . "</td>";
                echo "<td>" . $dados[$i]["nomeCli"] . "</td>";
                echo "<td>" . $dados[$i]["preco"] . "</td>";
                echo "<td>" . $dados[$i]["quantInt"] . "</td>";
                echo "<td>" . $dados[$i]["quantHoras"] . "</td>";
                echo "<td>" . $dados[$i]["cidade"] . "</td>";
                //echo "<td>" . $dados[$i]["codVerify3"] . "</td>";
                echo "<td>" . $dados[$i]["data"] . "</td>";
                //echo "<td>" . $dados[$i]["data_insercao3"] . "</td>";               
                echo "<td>";
                if($dados[$i]["status"] == 1) {
                    echo "Em Espera";
                } else {
                    echo "FUDEO DEU ERRO";
                }
                echo "</td>";
                
                echo "</tr>";
            }
        ?>
    </table>
    <?php
        } else {
            echo "Nenhum agendamento em espera encontrado!";

        }
    ?>





    <?php
        echo "<br><h1> Pendente(s) </h1>";
        if($dados["num2"] > 0){
    ?>
    <table>
        <tr>
            <th>ID</th>
            <th>NOME SER.</th>
            <th>NOME CLI.</th>
            <th>PREÇO</th>
            <th>QUANT INT</th>
            <th>HORA(S) DE SER.</th>
            <th>CIDADE</th>

            <th>DATA</th>
            
            <th>STATUS</th>
        </tr>
        <?php
            for($i = 1; $i <= $dados["num2"]; $i++){
                echo "<tr>";
                echo "<td>" . $dados[$i]["id2"] . "</td>";
                echo "<td>" . $dados[$i]["nomeSer2"] . "</td>";
                //echo "<td>" . $dados[$i]["id_int2"] . "</td>";
                echo "<td>" . $dados[$i]["nomeCli2"] . "</td>";
                echo "<td>" . $dados[$i]["preco2"] . "</td>";
                echo "<td>" . $dados[$i]["quantInt2"] . "</td>";
                echo "<td>" . $dados[$i]["quantHoras2"] . "</td>";
                echo "<td>" . $dados[$i]["cidade2"] . "</td>";
                //echo "<td>" . $dados[$i]["codVerify2"] . "</td>";
                echo "<td>" . $dados[$i]["data2"] . "</td>";
                //echo "<td>" . $dados[$i]["data_insercao2"] . "</td>";               
                echo "<td>";
                if($dados[$i]["status2"] == 2) {
                    echo "Em analise/aguardando pagamento";
                } else {
                    echo "FUDEO DEU ERRO";
                }
                echo "</td>";
                
                echo "</tr>";
            }
        ?>
    </table>
    <?php
        } else {
            echo "Nenhum agendamento pendente encontrado!";

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
