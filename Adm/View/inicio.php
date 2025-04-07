<?php
session_start();
require "../Model/manager.class.php";
$manager = new Manager();
$total    = $manager->somaPreco();
$countInt = $manager->countInt();
$dadosInt = $manager->graficoInt(); 
$dadosCli = $manager->graficoCli(); 
$dadosAge = $manager->graficoAge(); 

$manager->atualizarStatusComData();


?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/style2.css">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        window.dadosInt = <?= json_encode($dadosInt); ?>;
        window.dadosCli = <?= json_encode($dadosCli); ?>;
        window.dadosAge = <?= json_encode($dadosAge); ?>;
    </script>
    <script src="../../Assets/grafico/grafico.js"></script>
</head>
<body>

<section id="content">

<main>
    <div class="head-title">
        <div class="left">
            <h1>Seja Bem-vindo ADM !</h1>
            <ul class="breadcrumb">
                <li>
                    <a href="#"> Início</a>
                </li>
                <li><i class='bx bx-chevron-right'></i></li>
                <li>
                    <a class="active" href="#">Visão Geral</a>
                </li>
            </ul>
        </div>
        <a href="#" class="btn-download" onclick="printReport(event)">
            <i class='bx bxs-cloud-download'></i>
            <span class="text">Download Relatório</span>
        </a>
    </div>

    <ul class="box-info">
        <li>
            <i class='bx bxs-calendar-check'></i>
            <span class="text">
                <h3><?= $countInt ?></h3>
                <p>Interpretes total</p>
            </span>
        </li>
        <li>
            <i class='bx bxs-dollar-circle'></i>
            <span class="text">
                <h3><?= $total ?></h3>
                <p>Valor total de contratações</p>
            </span>
        </li>
    </ul>

	<br><br>
    <!-- Gráficos -->
    <div class="chart-container">
        <div id="chart_interpretes" class="chart"></div><br>
        <div id="chart_clientes" class="chart"></div><br>
        <div id="chart_agendamentos" class="chart"></div><br>
    </div>


</section>

<script src="../../Assets/js/script.js"></script>
</body>
</html>
