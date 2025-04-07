<!DOCTYPE html>
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

       

        
        <div class="row rowCardAgendamentoGeral">
            <div class="col-6 colCardAgendamentoGeral">
                <form action="#" method="post">
                    <div>
                        <label for="rua">Rua:</label><br>
                        <input type="text" id="rua" name="rua"><br>
                        <br>
                        <label for="numero">Número:</label><br>
                        <input type="number" id="numero" name="numero"><br>
                        <br>
                        <label for="cep">CEP:</label><br>
                        <input type="text" id="cep" name="cep"><br>
                        <br>
                        <label for="bairro">Bairro:</label><br>
                        <input type="text" id="bairro" name="bairro"><br>
                        <br>
                        <label for="infoAdicional">Informações Adicionais (bloco, etc):</label><br>
                        <input type="text" id="infoAdicional" name="infoAdicional"><br>
                        <br>
                        <input type="submit" value="Enviar">
                    </div>
                </form>
            </div>    
            <div class="col-6" style="font-size: 50px; justify-content: center; align-items: center; display: flex;">
                TEMPORÁRIO
            </div>      
            
            <div class="col-10"></div>
            <div class="col-2 colButtonAgendamentoGeral">
                <a href="dados_clienteAgendamento.php"><button>Prosseguir</button></a>
            </div>
        </div>

        <br><br><br>

    </div>
</body>
</html>