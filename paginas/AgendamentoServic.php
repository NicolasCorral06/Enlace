<!DOCTYPE html>
<?php

$id = $_GET["id"];
include "../Adm/Model/manager.class.php";
$manager = new Manager();

//vai puxar todos os dados do bd pra ca diante do id
//n fiz mais q isso por preguiça
//um dia eu acabo

//ou n
//:P
$dados = $manager->servicoPuxar($id);

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <title>Início</title>
    <style>
        body{
            background-color: #f0f0f0;
        }

        .menu{
            text-align: center;
            background-color: #fff;
            height: 15vh;
        }

        .menu .col-2{
            margin-top: 2.5%;
        }

        .colCardModalAgendamento{
            padding: 5%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .divCardModalAgendamento{
            border: 1px solid blue;
            background-color: #fff;
            height: 50vh;
            width: 100%;
            padding: 10%;
            font-size: 50px;
        }

        .spanModalAgendamento{
            color: brown;
            font-size: 12px;
        }

        .colCardAgendamentoGeral{
            padding: 5%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .divCardAgendamentoGeral{
            border: 1px solid blue;
            background-color: #fff;
            height: 25vh;
            width: 100%;
            padding: 20% 10%;
            text-align: center;
            font-size: 23px;
        }

        .colButtonAgendamentoGeral button{
            margin: 0% 0% 0% 35%;
        }

        .rowNomeServico{
            font-size: 25px;
            margin-left: 3.5%;
        }

        .rowNomeServico select{
            font-size: 17px;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row menu">
            <div class="col-2">
                <a href="servicos.php">Serviços</a>
            </div>
            <div class="col-2">
                <a href="equipe.php">Equipe</a>
            </div>
            <div class="col-2">
                <a href="sobre.php">Sobre</a>
            </div>
            <div class="col-2">
                <a href="comofunciona.php">Como Funciona</a>
            </div>
            <div class="col-2">
                <a href="duvidas.php">Dúvidas</a>
            </div>
            <div class="col-2">
                <a href="contato.php">Contato</a>
            </div>
        </div>

        <div class="row">
            <div class="col-2"></div>
            <div class="col-8 colCardModalAgendamento">
                <div class="divCardModalAgendamento">
                    <?=$dados["nome"]?><br>
                    <video src="../Assets/servicos/<?=$dados["video"]?>" a controls></video><br>
                    MODAL: Qual sua região? <br> <span class="spanModalAgendamento">Aqui vai aparecer como modal, a pessoa responde e conforme a resposta vai ter uma filtragem na parte "escolha o intérprete".</span>
                   
                </div>
                
            </div>
            <div class="col-2"></div>
        </div>    

        <br><br><br><br><hr><br><br><br><br>


        <div class="row rowNomeServico">
            <div class="col-5">Nome em específico do serviço vindo do banco de dados</div>
            <div class="col-5"></div>
            <div class="col-1">
                <!-- <select id="interpretes">
                    <option value="todos">Todos Intérpretes</option>
                    <option value="">Amanda Luana</option>
                    <option value="">Nicolás Corral</option>
                    <option value="">Daniel Lopes</option>
                </select> -->
            </div>
            <div class="col-1"></div>
        </div>

        
        <div class="row rowCardAgendamentoGeral">
            <div class="col-6 colCardAgendamentoGeral">
                <div class="divCardAgendamentoGeral">
                    Aqui vai ser o calendário<br>
                </div>
            </div>    
            <div class="col-6 colCardAgendamentoGeral">
                <div class="divCardAgendamentoGeral">
                    Aqui vai ser os horários<br>
                </div>
            </div>      
            
            <div class="col-10"></div>
            <div class="col-2 colButtonAgendamentoGeral">
                <a href="detalhesAgendamento.php"><button>Prosseguir</button></a>
            </div>
        </div>

        <br><br><br>

    </div>
</body>
</html>