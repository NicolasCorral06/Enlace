<?php
session_start();
include_once "../Adm/Model/manager.class.php";


$id_cli = $_SESSION["id_cli"];
$codVerify = $_POST["codVerify"];



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Agendamento Local </title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</head>
<body>    
    <form action="../Adm/Controller/ageController.php" method="post">
        <input type="hidden" name="agendamentoLocal" value="1">
        <input type="hidden" name="id_cli" value="<?= $id_cli ?>">
        <input type="hidden" name="codVerify" value="<?= $codVerify ?>">

        <label> CEP:  caso não saiba o cep, clique <a href="https://buscacepinter.correios.com.br/app/endereco/index.php" target="_blank"> aqui </a></label><br>
        <input name="cep" type="text" id="cep" value="" size="10" maxlength="9" required><br><br>

        <label> RUA: </label><br>
        <input name="rua" type="text" id="rua" size="60" required><br><br>

        <label> NÚMERO: </label><br>
        <input name="numero" type="text" id="numero" size="3" required><br><br>

        <label> BAIRRO: </label><br>
        <input name="bairro" type="text" id="bairro" size="40" required><br><br>

        <label> CIDADE: </label><br>
        <input name="cidade" type="text" id="cidade" size="40" required><br><br>

        <label> ESTADO: </label><br>
        <input name="uf" type="text" id="uf" size="2" required><br><br>

        <input type="submit" value="Agendar">
    </form>

    <script>
        $(document).ready(function() {

            function limpa_formulário_cep() {
                // Limpa valores do formulário de cep.
                $("#rua").val("");
                $("#bairro").val("");
                $("#cidade").val("");
                $("#uf").val("");
                $("#ibge").val("");
            }
            
            //Quando o campo cep perde o foco.
            $("#cep").blur(function() {

                //Nova variável "cep" somente com dígitos.
                var cep = $(this).val().replace(/\D/g, '');

                //Verifica se campo cep possui valor informado.
                if (cep != "") {

                    //Expressão regular para validar o CEP.
                    var validacep = /^[0-9]{8}$/;

                    //Valida o formato do CEP.
                    if(validacep.test(cep)) {

                        //Preenche os campos com "..." enquanto consulta webservice.
                        $("#rua").val("...");
                        $("#bairro").val("...");
                        $("#cidade").val("...");
                        $("#uf").val("...");
                        $("#ibge").val("...");

                        //Consulta o webservice viacep.com.br/
                        $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                            if (!("erro" in dados)) {
                                //Atualiza os campos com os valores da consulta.
                                $("#rua").val(dados.logradouro);
                                $("#bairro").val(dados.bairro);
                                $("#cidade").val(dados.localidade);
                                $("#uf").val(dados.uf);
                                $("#ibge").val(dados.ibge);
                            } //end if.
                            else {
                                //CEP pesquisado não foi encontrado.
                                limpa_formulário_cep();
                                alert("CEP não encontrado.");
                            }
                        });
                    } //end if.
                    else {
                        //cep é inválido.
                        limpa_formulário_cep();
                        alert("Formato de CEP inválido.");
                    }
                } //end if.
                else {
                    //cep sem valor, limpa formulário.
                    limpa_formulário_cep();
                }
            });
        });

    </script>
</body>
</html>