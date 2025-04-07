<?php
session_start();

include_once "../Adm/Model/manager.class.php";
$manager = new Manager();

if(!isset($_SESSION["id_cli"]) || $_SESSION["id_cli"] == ""){
    ?>
        <form method="post" name="myForm" id="myForm" action="../../paginas/agendamentoServicos.php">
            <input type="hidden" name="msg" value="OA05">
        </form>
        <script>
            document.getElementById("myForm").submit();
        </script>
    <?php
    exit();
}

$dados = array();
$dados["codVerify"] = $_POST["codVerify"];

//puxar todos os dados para mostrar ao cliente. vai se fude 
$dados = $manager->agendamentoALLPuxar($dados);

if(!isset($dados["result"]) || $dados["result"] == 0){
    ?>
        <form method="post" name="myForm" id="myForm" action="../../paginas/agendamentoServicos.php">
            <input type="hidden" name="msg" value="OP00">
        </form>
        <script>
            document.getElementById("myForm").submit();
        </script>
    <?php
    exit();
}


//valor total do serviço dos interpretes
$total_porInt = ($dados["preco"] * $dados["quantHoras"]) * $dados["quantInt"];

//valor total a ser pago com os 15%
$total = $total_porInt + ($total_porInt * 0.15);

//valor total que cada interprete vai receber
$intPreco = $total_porInt / $dados["quantInt"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Confirmação </title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            height: 100vh;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            display: flex;
            justify-content: space-between;
            width: 90%;
            margin: auto;
        }

        #agendamento, #agendamentoLocal, #pagamento {
            background-color: #ffffff;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            width: 30%;
            box-sizing: border-box;
        }

        #agendamento h3, #agendamentoLocal h3, #pagamento h3 {
            color: #333;
            margin-bottom: 15px;
            text-align: center;
        }

        #agendamento label, #agendamentoLocal label, #pagamento label {
            display: block;
            margin-bottom: 10px;
            color: #555;
        }

        .container div {
            text-align: left;
        }

    </style>
</head>
<body>
    
    
    <div class="container">
        <!--
        Form agendamento
        tabela - AGENDAMENTO
        -->
        <div id="agendamento">

            <h3> Dados do serviço </h3>
            
            <label> id agendamento: <b><?= $dados["idA"] ?></b> </label><br>
            <label> Serviço: <b><?= $dados["nomeSer"] ?></b> </label><br>
            <label> Preço por hora do interprete: R$ <b><?= $dados["preco"] ?></b> </label><br>
            <label> Cliente: <b><?= $dados["nomeCli"] ?></b> </label><br>

            <label> Interprete: <b>
                <?php
                    foreach ($dados["nomes_interpretes"] as $nome) {
                        echo $nome . "</b><br>";
                    }
                ?>
            </label><br>

            <label> Tempo de serviço: <b><?= $dados["quantHoras"] ?> Hora(s)</b> </label><br>
            <label> Cidade: <b><?= $dados["cidade"] ?></b> </label><br>
            <label> Data: <b><?= date("d/m/Y", strtotime($dados["data"])); ?></b> </label><br>
            <label> Total: R$ <b><?= $total ?></b> </label><br>
        </div>

        <!--
        Form agendamento local
        tabela - AGENTAMENTOLOCAL
        -->
        <div id="agendamentoLocal">
            <h3> Endereço </h3>
            <label> CEP: <b><?= $dados["cep"] ?></b> </label><br>
            <label> Rua: <b><?= $dados["rua"] ?></b> </label><br>
            <label> Número: <b><?= $dados["numero"] ?></b> </label><br>
            <label> Bairro: <b><?= $dados["bairro"] ?></b> </label><br>
            <label> Cidade: <b><?= $dados["cidade"] ?></b> </label><br>
            <label> Estado: <b><?= $dados["estado"] ?></b> </label><br>
        </div>

        <!-- 
            Form pagamento 
            aqui os campos vão estar vazios
        -->
        <div id="pagamento">
            <form action="../Adm/Controller/ageController.php" method="post">
                <input type="hidden" name="agendamentoConfirm" value="1">
                <input type="hidden" name="codVerify" value="<?= $dados["codVerify"] ?>">
                <input type="hidden" name="id_cli" value="<?= $dados["id_cli"] ?>">
                <input type="hidden" name="email_cli" value="<?= $_SESSION["email_cli"] ?>">
                <input type="hidden" name="nome_cli" value="<?= $_SESSION["nome_cli"] ?>">


                <h3> Formas de pagamento </h3>

                <label> Valor total R$ <b><?= $total ?></b> </label><br>

                <input type="radio" id="cartao" name="forma_pagamento" value="cartao" required>
                <label for="cartao"> Cartão de Crédito/Débito </label><br>

                <input type="radio" id="boleto" name="forma_pagamento" value="boleto">
                <label for="boleto"> Boleto Bancário </label><br>

                <input type="radio" id="pix" name="forma_pagamento" value="pix">
                <label for="pix"> Pix </label><br>

                <button type="submit">Confirmar pagamento</button>
            </form>

            
        </div>
    </div>

</body>
</html>