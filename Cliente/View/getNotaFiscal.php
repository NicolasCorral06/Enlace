<?php
if (isset($_GET['codVerify'])) {
    include_once '../../Adm/Model/manager.class.php';
    $codVerify = $_GET['codVerify'];

    // Chama sua função para gerar a nota fiscal com o codVerify recebido
    $manager = new Manager();
    $compra = $manager->notaFiscal(['codVerify' => $codVerify]);

    // Retorna os dados em formato JSON
    echo json_encode($compra);
}
?>
