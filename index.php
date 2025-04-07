<?php
session_start();
include "Adm/Model/manager.class.php";
include "Adm/Model/cookie.php";


$manager = new Manager();
$dados = $manager->listarCarousel();


//usar isso aqui em baixo pra limpar os cookies
//setcookie("cookieEnlace", "", time() - 3600, "/");

?>
<!DOCTYPE html>
    <html lang="en" data-theme="dark">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="assets - amanda3/style/styleIndex.css">
        <title>Início</title>
    </head>
    <body>
        <!-- --------------- MENU ------------- -->
        <header>
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <div class="colLogo">
                        <a class="navbar-brand" href="index.php">
                            <img src="assets - amanda3/logotipos/LOGOTIPO.png" alt="Logotipo da empresa Enlace - Clique para retornar à página inicial" title="Logotipo da Enlace - Clique para retornar à página inicial">
                        </a>
                    </div>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item">
                                <a class="nav-link navUm text-content" href="paginas/servicos.php">Serviços&nbsp;&nbsp;</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link navDois text-content" href="paginas/equipe.php">Equipe&nbsp;&nbsp;</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link navTres text-content" href="paginas/duvidas.php">Dúvidas&nbsp;&nbsp;</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link navTres text-content" href="paginas/contatos.php">Contatos</a>
                            </li>
                        </ul>
                        <div class="navbar-nav">
                            <a href="interprete/interpreteLogin.php" class="buttonContatos mr-2 text-content"> Trabalhe Conosco </a>

                            <a href="Cliente/clienteLogin.php" class="buttonPerfil text-content"> Perfil <i class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>     
                    <i id="toggleTheme" class="bi bi-sun"></i>
                </div>
            </nav>
            <div class="divBotoes">
                <button class="text-content" onclick="lerTexto()">Ouvir Texto</button> &nbsp; |
                <button class="text-content" onclick="pararTexto()">Parar Leitura</button>
            </div>
            <style>
                 .divBotoes {
                    background-color: #2e6b7375;
                    padding: 0.1%;
                    display: flex;            
                    justify-content: flex-end; 
                    width: 20%;
                    justify-content: center;
                    align-items: center;
                    color: #fff;
                    position: absolute;
                    right: 0;
                }

                .divBotoes button {
                    margin-left: 10px;      
                    background-color: transparent;
                    border: none;
                    color: #fff;
                }
            </style>
            <script>
                let sintetizador = window.speechSynthesis; 

                function lerTexto() {
                    const texto = document.body.innerText;  

                    const fala = new SpeechSynthesisUtterance(texto);

                    fala.lang = 'pt-BR';  
                    fala.rate = 1; 
                    fala.pitch = 1;  

                    sintetizador.speak(fala);
                }

                function pararTexto() {
                    sintetizador.cancel();
                }
            </script>
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
    <aside class="fixed-button" aria-label="Ajuste de Fonte">
            <button onclick="aumentarFonte()">A <i class="bi bi-plus"></i></button><br>
            <hr>
            <button onclick="diminuirFonte()">A <i class="bi bi-dash"></i></button>
        </aside>    



    <!-- ------- CONTEÚDO --------- -->
    <!-- <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                <img class="d-block w-100" src="" alt="Primeiro Slide">
                </div>
                <div class="carousel-item">
                <img class="d-block w-100" src="" alt="Segundo Slide">
                </div>
                <div class="carousel-item">
                <img class="d-block w-100" src="" alt="Terceiro Slide">
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Anterior</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Próximo</span>
            </a>
        </div> -->

        <div class="container-fluid">
            <div class="row rowConheca">
                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 colImg">
                <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <?php
                        for($i = 1; $i <= $dados["num"] ; $i++){
                        ?>
                            <div class="carousel-item <?=  $i == 1 ? 'active' : '' ?>">
                                <img src="assets/carrossel/<?= $dados[$i]['imggd'] ?>" class="d-block w-100" alt="<?= $dados[$i]['altgd']?>">
                            </div>
                            <?php
                        }
                    
                    ?>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>

                </div>
                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                    <h2 class="text-content">Conheça a Enlace</h2>
                    <h1 class="text-content">Um site único feito para ajudar a encontrar o melhor serviço!</h1>
                    <p class="text-content">Enlace é o portal que conecta você aos melhores serviços de interpretação em Libras. Aqui, você encontra intérpretes qualificados para eventos, consultas e diversas ocasiões, além de um espaço dedicado para profissionais se cadastrarem e oferecerem seus serviços. Simplificamos o acesso e promovemos a inclusão!</p>
                    <a href="paginas/servicos.php" class="text-content">Conheça os serviços</a>
                </div>
            </div>

            <div class="row rowDuplo">
                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                    <div class="cardUm">
                        <div class="row">
                            <div class="col-6">
                                <h1 class="text-content">Equipe</h1>
                                <p class="text-content">Contamos com intérpretes experientes e preparados para atender às suas necessidades com excelência.</p>
                                <a href="paginas/equipe.php" class="text-content">Conheça nossa equipe</a>
                            </div>
                            <div class="col-6 colImg">
                                <img src="assets - amanda3/imagens-geral/paciente.png" alt="Icone de equipes" title="Icone de equipes">
                            </div>
                        </div>
                    </div>
                    <br><br><br>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                    <div class="cardDois">
                        <div class="row">
                            <div class="col-6">
                                <h1 class="text-content">Dúvidas</h1>
                                <p class="text-content">Confira nossa seção de dúvidas frequentes e encontre respostas claras e objetivas sobre nossos serviços.</p>
                                <a href="paginas/duvidas.php" class="text-content">Tire suas dúvidas</a>
                            </div>
                            <div class="col-6 colImg">
                                <img src="assets - amanda3/imagens-geral/equipe.png" alt="Icone de dúvidas" title="Icone de dúvidas">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row rowServicos">
                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 colTitulo">
                    <img src="assets - amanda3/logotipos/LOGOTIPO-mao.png" alt="logotipo maõs" title="logotipo mãos">
                    <h1 class="text-content">Serviços</h1>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 colTexto">
                    <p class="text-content">Na Enlace, oferecemos uma ampla gama de serviços de interpretação em Libras, adaptados às suas necessidades. Seja para eventos, consultas ou outras ocasiões, conectamos você a intérpretes qualificados que garantem uma comunicação inclusiva e eficiente.</p>
                    <br>
                    <a href="paginas/servicos.php" class="text-content">Serviços</a>
                </div>
            </div>

            <div class="row rowTrabalhe">
                <div class="col-12">
                    <div class="jumbotron text-center">
                        <h1 class="text-content display-4">Trabalhe Conosco</h1>
                        <p class="text-content lead">Aqui você pode entender como funciona nosso site e tirar as suas dúvidas!</p>
                        <hr class="my-4">
                        <div class="d-flex justify-content-center flex-wrap">
                            <a class="text-content buttonBanner m-2" href="interprete/interpreteLogin.php" role="button">Faça seu cadastro</a>
                            <a class="text-content buttonBanner m-2" href="paginas/duvidas.php" role="button">Entenda como funciona</a>
                        </div>
                    </div> 
                </div>
            </div>
                

            <br><br><br><br><br><br><br><br>
        </div>

        <div class="container-fluid footer">
            <footer class="py-5">
            <div class="row">
                <div class="col-12 col-md-4 mb-6 colLogo-footer">
                <img src="assets - amanda3/logotipos/logoBrancoAmarelo.png" alt="Logotipo da empresa Enlace" title="Logotipo da Enlace">
                </div>
                <div class="col-6 col-md-2 mb-3 sites">
                <h5>INSTITUCIONAL</h5>
                <ul class="nav flex-column">
                    <li class=""><a href="Paginas/servicos.php" class="">Serviços</a></li>
                    <li class=""><a href="Paginas/equipe.php" class="">Equipe</a></li>
                    <li class=""><a href="Paginas/duvidas.php" class="">Dúvidas</a></li>
                    <li class=""><a href="Paginas/contatos.php" class="">Contatos</a></li>
                    <li class=""><a href="interprete/interpreteLogin.php" class="">Trabalhe Conosco</a></li>
                </ul>
                </div>
                <div class="col-md-5 offset-md-1 mb-3">
                <form>
                    <h5>Envie sua mensagem para nós</h5>
                    <p>Tem alguma dúvida? Envie sua mensagem e entraremos em contato.</p>
                    <div class="d-flex flex-column flex-sm-row w-100 gap-2">
                    <label for="newsletter1" class="visually-hidden">Email</label>
                    <input id="newsletter1" type="text" class="form-control" placeholder="Email">
                    <button class="btn btn-primary" type="button">Enviar</button>
                    </div>
                </form>
                </div>
            </div>
            <div class="d-flex flex-column flex-sm-row justify-content-between py-4 my-4 border-top divIcons">
                <p>&copy; <a href="adm/" class="a-footer">2024 Enlace. </a> Todos os direitos reservados.</p>
                <ul class="list-unstyled d-flex">
                <li class="ms-3"><a class="link-body-emphasis" href="https://www.facebook.com/profile.php?id=61569271222488&sk=map"><i  style="color: #fff; font-size: 1.3rem;" class="bi bi-facebook"></i></a></li>
                <li class="ms-3"><a class="link-body-emphasis" href="https://www.instagram.com/enlacetcc?igsh=MTFkcjZqejlrbDRzZA=="><i  style="color: #fff; font-size: 1.3rem;" class="bi bi-instagram"></i></a></li>
                <li class="ms-3"><a class="link-body-emphasis" href="https://x.com/Enlace1455318?t=dX7QX7N5yprC-rCXH3FuJQ&s=09"><i  style="color: #fff; font-size: 1.3rem;" class="bi bi-twitter"></i></a></li>
                </ul>
            </div>
            </footer>
        </div>

        <script>
            var carousel = new bootstrap.Carousel(document.getElementById('carouselExample'));
        </script>
        <script src="assets - amanda3/js/script-paginas.js"></script>




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

    <div class="modal fade" id="avisodoInterprete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Aviso!</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
            <p id="textomodalA">
                
            </p>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal">Confirmar</button>
            </div>
        </div>
        </div>
    </div>

    <div class="modal fade" id="avisodoNF" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Aviso!</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
            <p id="textomodalNF">
                Obrigado <?= $_SESSION["nome_cli"] ?> pela confiança!<br>
                Seu serviço foi agendado com sucesso.
                <br><br>

                Acesse o seu perfil e veja seu historico junto com sua nota fiscal! 

                <!--
                    <button onclick="baixarNotaFiscal()"> Baixar Nota Fiscal em PDF </button>
                -->
            </p>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
        </div>
    </div>
   
   

    

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script>
    // Recebendo os dados do PHP (os valores da array $compra)
    const compra = <?php echo $jsonCompra; ?>;

    // Função que gera o PDF
    function baixarNotaFiscal() {
        // Criando o PDF
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF();

        let dataOriginal = compra.data; 
        let partesData = dataOriginal.split('-'); 
        let dataFormatada = partesData[2] + '/' + partesData[1] + '/' + partesData[0];

        let horaFormatada = compra.horaComeca.substring(0, 5);

        var precoTotal = compra.preco * compra.quantHoras * compra.quantInt;
        var precoComDesconto = precoTotal + (precoTotal * 0.15); // 15% de desconto


        // Título da Nota Fiscal
        doc.text('== Nota Fiscal ==', 20, 20);
        doc.text('========================================', 20, 30);

        // Adicionando os campos de compra
        doc.text('--Dados do agendamento--', 20, 50);
        doc.text('Serviço: ' + compra.nome_ser, 20, 60);
        doc.text('Quantidade de Intérpretes: ' + compra.quantInt, 20, 70);
        doc.text('Quantidade de Horas: ' + compra.quantHoras, 20, 80);
        doc.text('Cidade: ' + compra.cidade, 20, 90);
        doc.text('Data: ' + dataFormatada, 20, 100);
        doc.text('Hora de Início: ' + horaFormatada, 20, 110);
        doc.text('Preço por hora: ' + compra.preco, 20, 120);
        doc.text('Preço total com 15%: ' + precoComDesconto.toFixed(2), 20, 130);

        doc.text('--Dados do local do agendamento--', 20, 150);
        doc.text('CEP: ' + compra.cep, 20, 160);
        doc.text('Rua: ' + compra.rua, 20, 170);
        doc.text('Número: ' + compra.numero, 20, 180);
        doc.text('Bairro: ' + compra.bairro, 20, 190);
        doc.text('Cidade: ' + compra.cidade, 20, 200);
        doc.text('Estado: ' + compra.estado, 20, 210);

        doc.text('========================================', 20, 230);

        // Gerar o PDF
        doc.save('nota_fiscal.pdf');
    }
</script>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

  </body>
  </html>
  
  <?php
  
    if (isset($_REQUEST["msg"])) {
      require_once "Adm/Model/msg.php";
      $cod = $_REQUEST["msg"];
      $msgExibir = $MSG[$cod];
      echo "<script>
      var textomodal = document.getElementById('textomodal')
      textomodal.innerHTML = '".$MSG[$cod]."'
      $('#textomodalcelsomito').modal('show');
  
      </script>";
    }

    if (isset($_REQUEST["msgA"])) {
        echo "<script>
        var textomodalA = document.getElementById('textomodalA')
        textomodalA.innerHTML =  ' Conta enviada para analise. <br> Aguarde ate 24 para ser avaliada e ativada!'
        $('#avisodoInterprete').modal('show');
    
        </script>";
    }

    if(isset($_REQUEST["msgNF"]) && isset($_REQUEST["codVerify"])){
        ?>
        <script>
            var textomodalNF = document.getElementById('textomodalNF')
            $('#avisodoNF').modal('show');
        </script>
        <?php
    }
  
  
  ?>
