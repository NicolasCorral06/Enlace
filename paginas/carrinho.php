<?php
session_start();
include_once "../Adm/model/manager.class.php";
$manager = new Manager();

/*       
if(!isset($_SESSION["id_cli"]) || empty($_SESSION["id_cli"])){
    ?>
        <form method="post" name="myForm" id="myForm" action="agendamentoServicos.php">
            <input type="hidden" name="msg" value="OA05">
        </form>
        <script>
            document.getElementById("myForm").submit();
        </script>
    <?php
    exit();
}
    */

$id_cli = $_SESSION["id_cli"];
$codVerify = $_POST["codVerify"];

$dados = $manager->puxarAgendamento($codVerify);
$dadosSNome = $manager->nomeServico($dados);


$totalI = $dados["preco"] * $dados["quantInt"] * $dados["quantHoras"];

$totalP1 = $dados["preco"] * 0.15;
$totalP2 = $totalI + $totalP1;

?>

<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../assets - amanda3/style/styleCarrinho.css">
    <title>Agendamento - Final</title>
    <style>
        
    </style>
</head>
<body>
    <!-- --------------- MENU ------------- -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <img src="../assets - amanda3/logotipos/LOGOTIPO.png" alt="">
        </nav>
        <div class="bg-revisao text-content">
            <i class="bi bi-list-ul"></i> &nbsp; Revisão
        </div>
    </header>

    <!-- ------- VLIBRAS --------- -->
    <div vw class="enabled">
      <div vw-access-button class="active"></div>
      <div vw-plugin-wrapper>
        <div class="vw-plugin-top-wrapper"></div>
      </div>
    </div>
    <script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
    <script>
      new window.VLibras.Widget('https://vlibras.gov.br/app');
    </script>

    <!-- ------- ALTERAR FONTE --------- -->
    <aside class="fixed-button" aria-label="Ajustar tamanho da fonte">
        <button class="buttonConta">
            <i id="toggleTheme" class="bi bi-sun"></i>
        </button>
        <br><br>
        <button onclick="aumentarFonte()" aria-controls="main-content" aria-label="Aumentar tamanho da fonte">A <i class="bi bi-plus"></i></button><br>
        <hr>
        <button onclick="diminuirFonte()" aria-controls="main-content" aria-label="Reduzir tamanho da fonte">A <i class="bi bi-dash"></i></button>
    </aside>




    <!-- ------- CONTEÚDO --------- -->
     <div class="container">
        <div class="row">
            <div class="col-12 colTexto">
                <a href="servicos.php"><i class="text-content bi bi-arrow-left"></i></a> &nbsp; Finalizar Compra
            </div>
            <div class="col-8">
                <div class="col-12 colEndereco-geral">
                    <form action="../Adm/Controller/ageController.php" method="post">
                        <input type="hidden" name="agendamentoLocal" value="1">
                        <input type="hidden" name="id_cli" value="<?= $id_cli ?>">
                        <input type="hidden" name="nome_cli" value="<?= $_SESSION["nome_cli"] ?>">
                        <input type="hidden" name="email_cli" value="<?= $_SESSION["email_cli"] ?>">
                        <input type="hidden" name="codVerify" value="<?= $codVerify ?>">
                        <input type="hidden" name="cidade" value="<?= $dados["cidade"] ?>">
                        <input type="hidden" id="uf" name="uf" >


                        <br>
                        <label for="city" class="text-content cidade"><i class="bi bi-geo-alt"></i> <?= $dados["cidade"] ?> </label><br>
                        <hr><br>
                        <div class="row">

                                <label> CEP:  caso não saiba o cep, clique <a href="https://buscacepinter.correios.com.br/app/endereco/index.php" target="_blank"> aqui </a></label><br>
                                <input name="cep" type="text" id="cep" value="" size="10" maxlength="9" required>
                                
                            <div class="col-6 mb-3">
                                <label for="street" class="text-content">Rua</label><br>
                                <input type="text" id="rua" name="rua" class="text-content form-control" placeholder="Digite o nome da rua" required>
                            </div>
                            <div class="col-6 mb-3">
                                <label for="neighborhood" class="text-content">Bairro</label><br>
                                <input type="text" id="bairro" name="bairro" class="text-content form-control" placeholder="Digite o bairro" required>
                            </div>
                            <div class="col-6 mb-3">
                                <label for="number" class="text-content">Número</label><br>
                                <input type="text" id="numero" name="numero" class="form-control text-content" placeholder="Digite o número" required>
                            </div>
                            <div class="col-6 mb-3">
                                <label for="complement" class="text-content">Complemento</label><br>
                                <input type="text" id="complemento" name="complemento" class="form-control text-content" placeholder="Digite o complemento (opcional)">
                            </div>
                            <div class="col-12 mb-3">
                                <label for="additional-info" class="text-content">Informações adicionais</label><br>
                                <textarea id="additional-info" name="informacoesAdicionais" class="form-control text-content" placeholder="Insira informações adicionais"></textarea>
                            </div>
                        </div>
                        <br><br> Ao agendar você aceita os <a href="" type="button" class="text-content" data-toggle="modal" data-target="#modalExemplo" style="color: #2e6b73">Termos de uso</a>.</p>
                        <!-- Modal Termos de Uso -->
                        <div class="modal fade" id="modalExemplo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Termos de Uso</h5>
                                    </div>
                                    <div class="modal-body">
                                        <p>
                                        Bem-vindo ao <span style="font-weight: bold;">Enlace!</span>
                                        </p>
                                        <p>
                                        Estes Termos de Uso descrevem as regras e condições para o uso do nosso site e dos serviços oferecidos. Ao acessar ou utilizar nosso site, você concorda em cumprir e estar vinculado a estes termos. Recomendamos que você leia atentamente todas as condições antes de continuar.
                                        </p>
                                        <p>
                                        <span style="font-weight: bold;">1. Objetivo do Serviço</span><br>
                                        Nosso site é uma plataforma que conecta clientes a intérpretes de Libras para a contratação de serviços de interpretação em diversos contextos, como conferências, consultas médicas, eventos educacionais e outros. Oferecemos um ambiente seguro e eficiente para que ambas as partes possam estabelecer uma relação profissional de forma clara e organizada.
                                        </p>
                                        <p>
                                        <span style="font-weight: bold;">2. Cadastro e Acesso à Plataforma</span><br>
                                        2.1. Para acessar algumas funcionalidades do site, é necessário criar uma conta fornecendo informações pessoais e de contato.<br>
                                        2.2. Você é responsável por manter a confidencialidade de suas informações de login e por todas as atividades realizadas na sua conta.<br>
                                        2.3. Garantimos a proteção dos seus dados conforme nossa <span style="font-weight: bold;">Política de Privacidade</span>.
                                        </p>
                                        <p>
                                        <span style="font-weight: bold;">3. Funcionamento do Serviço</span><br>
                                        3.1. O cliente poderá escolher o intérprete de sua preferência com base em avaliações, disponibilidade e especialidade.<br>
                                        3.2. O preço dos serviços será definido com base na quantidade de horas contratadas, conforme as diretrizes apresentadas na plataforma.<br>
                                        3.3. O intérprete concorda em cumprir os horários e condições estipulados no momento da contratação.<br>
                                        3.4. Limitações de tempo podem ser aplicadas aos serviços oferecidos, como uma jornada máxima de horas consecutivas por dia.
                                        </p>
                                        <p>
                                        <span style="font-weight: bold;">4. Obrigações dos Usuários</span><br>
                                        4.1. O cliente deve fornecer informações completas e precisas sobre o serviço desejado, garantindo que o intérprete tenha todas as condições para realizar o trabalho.<br>
                                        4.2. O intérprete deve agir de forma ética e profissional, respeitando as necessidades do cliente e o sigilo das informações a que tiver acesso durante a execução do serviço.<br>
                                        4.3. É proibido utilizar o site para finalidades ilegais ou que possam violar os direitos de terceiros.
                                        </p>
                                        <p>
                                        <span style="font-weight: bold;">5. Pagamentos e Cancelamentos</span><br>
                                        5.1. Os pagamentos devem ser realizados exclusivamente por meio das opções oferecidas na plataforma.<br>
                                        5.2. Em caso de cancelamento, as políticas de reembolso e taxas de cancelamento serão aplicadas conforme as condições apresentadas no ato da contratação.
                                        </p>
                                        <p>
                                        <span style="font-weight: bold;">6. Limitação de Responsabilidade</span><br>
                                        Nos esforçamos para manter a qualidade, precisão e segurança de nossa plataforma. No entanto, não nos responsabilizamos por:<br>
                                        - Cancelamentos ou atrasos por parte do intérprete ou cliente;<br>
                                        - Qualquer prejuízo decorrente de informações incorretas fornecidas por usuários;<br>
                                        - Problemas técnicos fora do controle da nossa plataforma.
                                        </p>
                                        <p>
                                        <span style="font-weight: bold;">7. Modificações nos Termos</span><br>
                                        Reservamo-nos o direito de modificar estes Termos de Uso a qualquer momento. As alterações serão informadas por meio de aviso na plataforma, e o uso contínuo do site após a publicação das alterações será considerado como aceitação dos novos termos.
                                        </p>
                                        <p>
                                        <span style="font-weight: bold;">8. Dúvidas e Suporte</span><br>
                                        Caso tenha dúvidas sobre estes Termos de Uso ou precise de suporte, entre em contato conosco por meio dos canais disponibilizados em nossa plataforma.
                                        </p>
                                        <p>
                                        Ao utilizar nosso site, você concorda em respeitar estes Termos de Uso e reconhece sua importância para o bom funcionamento da plataforma e para a proteção de todos os envolvidos. Obrigado por confiar no <span style="font-weight: bold;">Enlace!</span>
                                        </p>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="text-content btn btn-primary">Enviar</button>
                    
                </div>
                <div class="col-12 colPagamento-geral">
                    <br>
                    <h1 class="text-content">Pagamento</h1>
                    <hr><br>
                    <div class="row rowPagamento">
                        <!-- Pix -->
                        <div class="col-6 colPix">
                            <label class="payment-label">
                                <i class="bi bi-cash text-content"></i>
                                <h2 class="text-content">Pix</h2>
                                <p class="text-content">aprovação imediata</p>
                                <input type="radio" name="formaPagamento" value="pix" required>
                            </label>
                        </div>

                        <!-- Cartão de Crédito -->
                        <div class="col-6 colCartao">
                            <label class="payment-label">
                                <i class="bi bi-credit-card text-content"></i>
                                <h2 class="text-content">Cartão de Crédito</h2>
                                <p class="text-content">aprovação imediata</p>
                                <input type="radio" name="formaPagamento" value="cartao" required>
                            </label>
                        </div>
                    </div>

                    </form>


                </div>
                <br><br><br><br><br>
            </div>
            <div class="col-4 colInfos">
                <h1>Meu agendamento</h1>
                <hr>
                <p class="text-content">Serviço: <span> <?= $dadosSNome["nome_ser"] ?> </span></p>
                <p class="text-content">Data: <span> <?= date("d/m/Y", strtotime($dados["data"])) ?> </span></p>
                <p class="text-content">Hora de começo: <span> <?= substr($dados["horaComeca"], 0 , 5) ?> </span></p>
                <p class="text-content">Quantidade de Interpretes: <span> <?= $dados["quantInt"]?></span> </p>
                <p class="text-content">Hora(s) de serviço: <span> <?= $dados["quantHoras"]?></span> </p>
                <hr>
                <p class="text-content">Preço hora: <span>R$ <?= $dados["preco"]?></span></p>
                <p class="text-content">Preço final: <span>R$ <?= $totalI ?></span></p>
                <p class="text-content">Taxa (15%): <span>R$ <?= $totalP1 ?></span></p>
                <hr>
                <p class="text-content">Total: <span>R$ <?= $totalP2 ?></span></p>
               
                <br><br><br>
            </div>
        </div>
     </div>
    
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
                        $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/", function(dados){

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
 
    <script src="../assets - amanda3/js/script-paginas.js"></script>
</body>
</html>
