<?php
session_start();

if(!isset($_SESSION["id_int"]) || $_SESSION["id_int"] == ""){
    session_destroy();
    ?>
        <form method="post" name="myForm" id="myForm" action="../../index.php">
            <input type="hidden" name="msg" value="0">
        </form>
        <script>
            document.getElementById("myForm").submit();
        </script>
    <?php
    exit();
}

include_once "../../Adm/Model/manager.class.php";
$manager = new Manager();
$id_int = $_SESSION["id_int"];

$dadosC = array();
$dadosA = array();
$dadosC = $manager->listarHistoricoAgendamentoConcluidoInt($id_int);
$dadosA = $manager->listarHistoricoAgendamentoAndamentoInt($id_int);

//checa se existe alguma data que ja tenha passado e se sim atualiza o status
$manager->atualizarStatusComData();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Historico </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/gh/eliyantosarage/font-awesome-pro@main/fontawesome-pro-6.5.1-web/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>
    <!-- Agendamentos concluidos -->
    <h1> Serviços concluidos </h1>
    <?php
        if (isset($dadosC["numL"]) && $dadosC["numL"] > 0) {
    ?>
    
    <table border="1">
        <tr>
            <th> CEP </th>
            <th> RUA </th>
            <th> NÚMERO </th>
            <th> BAIRRO </th>
            <th> CIDADE </th>
            <th> ESTADO </th>
            <th> STATUS </th>
            <th> VER MAIS </th>
            <th> MAPA </th>

        </tr>
        <?php
            for($i = 1; $i <= $dadosC["numL"]; $i++){   
                $endereco = urlencode($dadosC["rua"][$i] . ", " . $dadosC["numero"][$i] . " - " . $dadosC["bairro"][$i] . ", " . $dadosC["cidadeL"][$i] . " - " .$dadosC["estado"][$i] . ", " . $dadosC["cep"][$i]);

                $linkMaps = "https://www.google.com/maps/search/?api=1&query=" . $endereco;

                echo "<tr>";
                //echo "<td>" . $dadosC["idL"][$i] . "</td>"; 
                //echo "<td>" . $dadosC["id_cliL"][$i] . "</td>"; 
                echo "<td>" . $dadosC["cep"][$i] . "</td>";         
                echo "<td>" . $dadosC["rua"][$i] . "</td>";         
                echo "<td>" . $dadosC["numero"][$i] . "</td>";      
                echo "<td>" . $dadosC["bairro"][$i] . "</td>";      
                echo "<td>" . $dadosC["cidadeL"][$i] . "</td>";     
                echo "<td>" . $dadosC["estado"][$i] . "</td>";   
                //echo "<td>" . $dadosC["codVerify"][$i] . "</td>";    
                echo "<td>" . $dadosC["statusL"][$i] . "</td>";    

                echo "<td>";
                echo "<a href='#' data-toggle='modal' data-target='#modal" . $i . "'> Ver mais </a>";
                echo "</td>";

                echo "<td><a href='" . $linkMaps . "' target='_blank'> Ver no mapa </a></td>";
                    
                echo "</tr>";
                
            }
        ?>
    </table>
    <?php
    } else {
        echo "Nenhum serviço encontrado!" . "<br><br>";
    }
    ?>

    <br>
    <!-- Agendamentos não concluidos -->
    <h1> Serviços não concluidos </h1>

    <?php
        if (isset($dadosA["numL"]) && $dadosA["numL"] > 0) {   
    ?>
    <table border="1">
        <tr>
            <th> CEP </th>
            <th> RUA </th>
            <th> NÚMERO </th>
            <th> BAIRRO </th>
            <th> CIDADE </th>
            <th> ESTADO </th>
            <th> STATUS </th>
            <th> VER MAIS </th>
            <th> MAPA </th>

        </tr>
        <?php
            for($i = 1; $i <= $dadosA["numL"]; $i++){
                
                $endereco = urlencode($dadosA["rua"][$i] . ", " . $dadosA["numero"][$i] . " - " . $dadosA["bairro"][$i] . ", " . $dadosA["cidadeL"][$i] . " - " . $dadosA["estado"][$i] . ", " . $dadosA["cep"][$i]);

                $linkMaps = "https://www.google.com/maps/search/?api=1&query=" . $endereco;

                echo "<tr>";
                //echo "<td>" . $dadosA["idL"][$i] . "</td>"; 
                //echo "<td>" . $dadosA["id_cliL"][$i] . "</td>"; 
                echo "<td>" . $dadosA["cep"][$i] . "</td>";         
                echo "<td>" . $dadosA["rua"][$i] . "</td>";         
                echo "<td>" . $dadosA["numero"][$i] . "</td>";      
                echo "<td>" . $dadosA["bairro"][$i] . "</td>";      
                echo "<td>" . $dadosA["cidadeL"][$i] . "</td>";     
                echo "<td>" . $dadosA["estado"][$i] . "</td>";   
                //echo "<td>" . $dadosA["codVerify"][$i] . "</td>";    
                echo "<td>" . $dadosA["statusL"][$i] . "</td>";    

                echo "<td>";
                echo "<a href='#' data-toggle='modal' data-target='#modal" . $i . "'> Ver mais </a>";
                echo "</td>";

                echo "<td><a href='" . $linkMaps . "' target='_blank'> Ver no mapa </a></td>";
                    
                echo "</tr>";
                
            }
        ?>
    </table>
    <?php
    } else {
        echo "Nenhum serviço encontrado!";
    }
    ?>




<!-- modais -->
<!-- MODAL - NÃO CONCLUIDO -->
<?php

if(!isset($dadosA["numA"]) || $dadosA["numA"] == 0){
    $dadosA["numA"] = 0;
}

for($i = 1; $i <= $dadosA["numA"]; $i++){
?>
    <!-- Modal para linha <?= $i; ?> -->
    <div class="modal fade" id="modal<?= $i; ?>" tabindex="-1" role="dialog" aria-labelledby="modalLabel<?= $i; ?>" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel<?= $i; ?>">Dados Adicionais</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p><strong> Serviço: </strong> <?= $dadosA['nomeSer'][$i]; ?></p>
                    <p><strong> interpretes: </strong> 
                    <?php
                    foreach ($dadosA['nomes_interpretes'] as $nome) {
                        echo $nome . "</b><br>";
                    }
                    
                    ?>
                    </p>
                    <p><strong> PRECO: </strong> 
                    <?php 
                       echo $total = $dadosA['preco'][$i] + (($dadosA['preco'][$i] * $dadosA['quantInt'][$i] * $dadosA['quantHoras'][$i]) * 0.15); 
                    ?>
                    </p>
                    <p><strong> QUANTIDADE INT: </strong> <?= $dadosA['quantInt'][$i]; ?></p>
                    <p><strong> QUANT HORAS: </strong> <?= $dadosA['quantHoras'][$i]; ?></p>
                    <p><strong> CIDADEA: </strong> <?= $dadosA['cidadeA'][$i]; ?></p>
                    <p><strong> DATA: </strong> <?= date("d/m/Y", strtotime($dadosA["data"][$i])); ?></p>
                    <p><strong> STATUS: </strong> <?= $dadosA['statusA'][$i]; ?></p>
                    
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>
<?php
}




//<!-- MODAL - NÃO CONCLUIDO -->
if(!isset($dadosC["numA"]) || $dadosC["numA"] == 0){
    $dadosC["numA"] = 0;
}
for($i = 1; $i <= $dadosC["numA"]; $i++){
    ?>
        <!-- Modal para linha <?= $i; ?> -->
        <div class="modal fade" id="modal<?= $i; ?>" tabindex="-1" role="dialog" aria-labelledby="modalLabel<?= $i; ?>" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel<?= $i; ?>">Dados Adicionais</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p><strong> Serviço: </strong> <?= $dadosC['nomeSer'][$i]; ?></p>
                        <p><strong> interpretes: </strong> 
                        <?php
                        foreach ($dadosC['nomes_interpretes'] as $nome) {
                            echo $nome . "</b><br>";
                        }
                        
                        ?>
                        </p>
                        <p><strong> PRECO: </strong> 
                        <?php 
                           echo $total = $dadosC['preco'][$i] + (($dadosC['preco'][$i] * $dadosC['quantInt'][$i] * $dadosC['quantHoras'][$i]) * 0.15); 
                        ?>
                        </p>
                        <p><strong> QUANTIDADE INT: </strong> <?= $dadosC['quantInt'][$i]; ?></p>
                        <p><strong> QUANT HORAS: </strong> <?= $dadosC['quantHoras'][$i]; ?></p>
                        <p><strong> CIDADEA: </strong> <?= $dadosC['cidadeA'][$i]; ?></p>
                        <p><strong> DATA: </strong> <?= date("d/m/Y", strtotime($dadosC["data"][$i])); ?></p>
                        <p><strong> STATUS: </strong> <?= $dadosC['statusA'][$i]; ?></p>
                        
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    </div>
                </div>
            </div>
        </div>
    <?php
    }
?>

</body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk/nAr4vladkuBjXqzQIIvI3F88JFcE1zvsqKfp" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

</html>