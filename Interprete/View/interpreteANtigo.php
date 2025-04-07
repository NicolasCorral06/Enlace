<?php
session_start();

if (isset($_REQUEST["msg"]) && $_REQUEST["msg"] != "" && $_REQUEST["msg"] != "0") {
    require_once "../../Adm/Model/msg.php";
    $cod = $_REQUEST["msg"];

    if (isset($MSG[$cod])) {
        $msgExibir = $MSG[$cod];
        echo "<script>
        var textomodal = document.getElementById('textomodal');
        textomodal.innerHTML = '".$msgExibir."';
        $('#textomodalcelsomito').modal('show');
        </script>";
    }
}


if(!isset($_SESSION["id_int"]) || $_SESSION["id_int"] == ""){
    session_abort();
    ?>
        <form action="../interpreteLogin.php" name="return" id="return" method="post">
            <input type="hidden" name="cod" value="OA02">
        </form>
        <script>
            document.getElementById("return").submit();
        </script>
    <?php
    exit();
}

include "../../Adm/Model/manager.class.php";
$manager = new Manager();
$dados = array();
$dados["id"] = $_SESSION["id_int"];

$dados = $manager->intPuxar($dados);

$_SESSION["id_int"] = $dados["id"];
$_SESSION["nome_int"] = $dados["nome"];
$_SESSION["email_int"] = $dados["email"];
$_SESSION["status_int"] = $dados["status"];


$dadosIS = $manager->interpreteServico($dados);

if(isset($dadosIS["result"]) && $dadosIS["result"] == 1){
    $result = $dadosIS["result"];
    $id_int = $dadosIS["id_int"];
    $id_servico = $dadosIS["id_servico"];
    $hC = $dadosIS["hC"];
    $hA = $dadosIS["hA"];
    $status = $dadosIS["status"];
    
    $id_servico = is_array($id_servico) ? $id_servico : [];
    $totalServicos = count($id_servico);  
} else {
    $result = 0; 
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Inteprete </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/gh/eliyantosarage/font-awesome-pro@main/fontawesome-pro-6.5.1-web/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <style>
        input:invalid + span:after {
            position: absolute;
            content: "✖";
            padding-left: 5px;
        }

        input:valid + span:after {
            position: absolute;
            content: "✓";
            padding-left: 5px;
        }

    </style>
    <script>
        function logout(){
            var resp = confirm("Deseja realmente fazer logout?");
            if (resp == true){
                window.location.assign("logout.php");
            }
        }

        
    </script>
</head>
<body>
    Bem vindo <?=$_SESSION["nome_int"]?><br>
    <a href="#" class="logout" style="margin-top: 400px;" onclick="logout()"> Logout </a><br><br>
    
    <?php
         if($_SESSION["status_int"] == 2){
            echo "Complete seu cadastro clicando <a href='contCadastro.php'> Aqui </a>";
        } elseif($_SESSION["status_int"] == 3) {
            echo "Sua conta está em analise";
        } else {
    ?>
        <a href="#" data-toggle="modal" data-target="#formModal"> Clique aqui para
            <?= ($result == 1) ? "atualizar serviços" : "adicionar serviços"; ?>
        </a><br>
        
        <hr>
        <a href="atualizarInt.php"> Clique aqui para atualizar dados pessoais </a><br>

        <a href="atualizarP.php"> Clique aqui para atualizar o perfil </a><br>

        <a href="historico.php"> Historico </a><br>

        <form action="../../Adm/Controller/intController.php" method="post">
            <input type="hidden" name="idInt" value="<?= $_SESSION["id_int"]?>">
            <input type="hidden" name="emailInt" value="<?= $_SESSION["email_int"]?>">
            <input type="hidden" name="nomeInt" value="<?= $_SESSION["nome_int"]?>">

            <input type="hidden" name="codigoGet" value="1">

            muda a porra da senha <input type="submit" value="aqui">
        </form>
        
        <div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formModalLabel">Formulário</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form action="../../Adm/Controller/intController.php" method="post">
                <?= ($result == 1) ? "<b>PRECISO ACABAR ESSA PARTE DE UPDATE DOS DADOS, CARALHO</b><br><br>" : "";  ?>

                <?= ($result == 1) ? '<input type="hidden" name="atualizarIS" value="true">' : ""; ?>
                <input type="hidden" name="id" value="<?= $_SESSION["id_int"] ?>">
                <input type="hidden" name="intServicos" value="1">

                <label> Horario pra começar </label> 
                <input type="time" name="hC" id="hC" min="08:00" max="22:00" value="<?= ($result == 1 && isset($result)) ? $dadosIS["hC"] : "08:00";  ?>"> (min - 8:00) 
                <span class="validacao"></span><br><br>

                <label> Horario para acabar </label> 
                <input type="time" name="hA" id="hA" min="08:00" max="22:00"value="<?= ($result == 1) ? $dadosIS["hA"] : "22:00";  ?>"> (max - 22:00)
                <span class="validacao"></span><br><br>

                <label> Selecione até 3 serviços que você deseja servir </label><br>
                <?php
                    $dadosSer = $manager->servicosListar();
                    if(isset($dadosSer) && $dadosSer != ""){

                        if(isset($id_servico) && $id_servico != null){
                            for($i = 1; $i <= $dadosSer["num"]; $i++){
                                $checked = in_array($dadosSer[$i]['id'], $id_servico) ? 'checked' : '';

                                echo '<input type="checkbox" class="checkbox-servicos" 
                                        name="servicosCOMint[]" 
                                        value="' . $dadosSer[$i]['id'] . '" ' . $checked . '> ' 
                                        . $dadosSer[$i]['nome'] . '<br>';
                            }
                        } else {
                            for($i = 1; $i <= $dadosSer["num"]; $i++){
                                echo '<input type="checkbox" class="checkbox-servicos" 
                                        name="servicosCOMint[]" 
                                        value="' . $dadosSer[$i]['id'] . '"> ' 
                                        . $dadosSer[$i]['nome'] . '<br>';
                            }
                        }
                    } else {
                        echo "Desculpe! tivemos um problema em listar os nossos Serviços, volte depois";
                    }
                ?>
                
                <br><input type="submit" id="enviar" value="<?= ($result == 1) ? 'Atualizar' : 'Enviar'; ?>">

            </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
            </div>
        </div>
        </div>

    <?php
        //filha da puta, baguçhpo que linka la em cima
        }       
    ?>


<script>
// Seleciona todos os checkboxes com a classe 'checkbox-servicos'
const checkboxes = document.querySelectorAll('.checkbox-servicos');
const maxSelection = 3; // Definimos o máximo de 3 checkboxes

// Função que será chamada quando qualquer checkbox for clicada
checkboxes.forEach(function(checkbox) {
    checkbox.addEventListener('change', function() {
        // Conta quantos checkboxes estão selecionados
        const checkedCount = document.querySelectorAll('.checkbox-servicos:checked').length;

        // Se o número de checkboxes selecionados for igual ao máximo, desabilita as outras
        if (checkedCount >= maxSelection) {
            checkboxes.forEach(function(box) {
                if (!box.checked) {
                    box.disabled = true; // Desabilita as checkboxes não selecionadas
                }
            });
        } else {
            // Caso contrário, habilita todas as checkboxes novamente
            checkboxes.forEach(function(box) {
                box.disabled = false;
            });
        }
    });
});

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
        <p id="textomodal"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Confirmar</button>
      </div>
    </div>
  </div>
</div>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

</body>
</html>

