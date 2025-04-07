<?php
session_start();

require "../adm/Model/manager.class.php";
$manager = new Manager();
$codVerify = $_POST["codVerify"];

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

$compra = $manager->notaFiscal($codVerify);

$jsonCompra = json_encode($compra);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Obrigado pela compra </title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    Obrigado <?= $_SESSION["nome_cli"] ?><br>
    Fique de olho no seu email e conta para ver qualquer alteração :) <br>

    Veja seu historico <a href="../Cliente/View/cliente.php"> Aqui </a><br><br>

    <button onclick="baixarNotaFiscal()"> Baixar Nota Fiscal em PDF </button>




<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script>
    // Recebendo os dados do PHP (os valores da array $compra)
    const compra = <?php echo $jsonCompra; ?>;

    // Função que gera o PDF
    function baixarNotaFiscal() {
        // Criando o PDF
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF();

        // Título da Nota Fiscal
        doc.text('Nota Fiscal', 20, 20);

        // Adicionando os campos de compra
        doc.text('Dados do agendamento', 20, 30);
        doc.text('Serviço: ' + compra.nome_ser, 20, 40);
        doc.text('Quantidade de Intérpretes: ' + compra.quantInt, 20, 50);
        doc.text('Quantidade de Horas: ' + compra.quantHoras, 20, 60);
        doc.text('Cidade: ' + compra.cidade, 20, 70);
        doc.text('Hora de Início: ' + compra.horaComeca, 20, 80);
        doc.text('Preço por hora: ' + compra.preco, 20, 90);

        // Cálculo do preço total com o percentual
        var precoTotal = compra.preco * compra.quantHoras * compra.quantInt;
        var precoComDesconto = precoTotal + (precoTotal * 0.15); // 15% de desconto

        // Adicionando o preço total com o percentual
        doc.text('Preço total com 15%: ' + precoComDesconto.toFixed(2), 20, 100);

        // Adicionando as informações do endereço
        doc.text('Dados do local do agendamento', 20, 110);
        doc.text('CEP: ' + compra.cep, 20, 120);
        doc.text('Rua: ' + compra.rua, 20, 130);
        doc.text('Número: ' + compra.numero, 20, 140);
        doc.text('Bairro: ' + compra.bairro, 20, 150);
        doc.text('Cidade: ' + compra.cidade, 20, 160);
        doc.text('Estado: ' + compra.estado, 20, 170);

        // Gerar o PDF
        doc.save('nota_fiscal.pdf');
    }
</script>
    
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
        <p id="textomodal">
            
        </p>
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
    require_once "../Adm/Model/msg.php";
    $cod = $_REQUEST["msg"];
    $msgExibir = $MSG[$cod];
    echo "<script>
    var textomodal = document.getElementById('textomodal')
    textomodal.innerHTML = '".$MSG[$cod]."'
    $('#textomodalcelsomito').modal('show');

    </script>";
}

?>