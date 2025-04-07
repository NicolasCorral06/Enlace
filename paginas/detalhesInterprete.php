<?php
session_start();
include_once "../Adm/Model/manager.class.php";
$manager = new Manager();


$nomeInt = $_GET["interprete"];
$dados = $manager->listIntALL($nomeInt);


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
    <link rel="stylesheet" href="../assets-amanda/style/styleDetalhes.css">
    <title>Detalhes do Interprete</title>
</head>
<body>

   <!-- --------------- MENU ------------- -->
   <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <div class="colLogo">
                    <a class="navbar-brand" href="../index.php">
                        <img src="../assets-amanda/arquivos/logotipos/LOGOTIPO.png" alt="Logotipo da empresa Enlace - Clique para retornar à página inicial" title="Logotipo da Enlace - Clique para retornar à página inicial">
                    </a>
                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link navUm text-content" href="servicos.php">Serviços&nbsp;&nbsp;</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link navDois text-content" href="equipe.php">Equipe&nbsp;&nbsp;</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link navTres text-content" href="duvidas.php">Dúvidas&nbsp;&nbsp;</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link navTres text-content" href="contatos.php">Contatos</a>
                        </li>
                    </ul>
                    <div class="navbar-nav">
                        <a href="../Interprete/interpreteLogin.php" class="buttonContatos mr-2 text-content" aria-label="Clique para acessar a página Trabalhe Conosco">Trabalhe Conosco</a>
                        <a href="../cliente/clienteLogin.php" class="buttonPerfil text-content" aria-label="Clique para acessar o seu perfil de usuário">Perfil <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>     
                <i id="toggleTheme" class="bi bi-sun" aria-label="Alternar entre modo claro e escuro"></i>
            </div>
        </nav>
        <div class="divBotoes">
                <button class="text-content" onclick="lerTexto()">Ouvir Texto</button> &nbsp; |
                <button class="text-content" onclick="pararTexto()">Parar Leitura</button>
            </div>
            <style>
                body a{
                    text-decoration: none;
                }

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
   <aside class="fixed-button" aria-label="Ajustar tamanho da fonte">
        <button onclick="aumentarFonte()" aria-controls="main-content" aria-label="Aumentar tamanho da fonte">A <i class="bi bi-plus"></i></button><br>
        <hr>
        <button onclick="diminuirFonte()" aria-controls="main-content" aria-label="Reduzir tamanho da fonte">A <i class="bi bi-dash"></i></button>
    </aside>



    <!-- ------- CONTEÚDO --------- -->
    <main class="container-fluid">
        <section class="row">
            <article class="col-4 fotoFixa">
                <div class="divImgSobreLinha">
                    <img src="../assets/interprete/perfil/<?= $dados["foto_perfil"] ?>" class="imagemSobreLinha" alt="Foto de perfil do interprete" title="Foto de perfil do interprete">
                </div>
            </article>
            <article class="col-7 scrollable-content">
                <div class="">
                    <div class="colUm">
                        <p class="text-content">Conhecendo a nossa equipe</p>
                        <h1 class="text-content">Olá, eu sou<br> <span  class="text-content"> <?= $dados["nome"] ?> </span></h1>
                        <h2 class="text-content">Interprete de Libras</h2>
                        <a href="#sobre">
                            <button class="button button-primary">
                                <span class="text-content"> Ler mais </span>
                                <i class="bi bi-arrow-down-right"> </i>   
                            </button>
                        </a>
                    </div>
                    <div class="colDois" id="sobre">
                        <h1 class="text-content">Sobre mim</h1>
                        <p class="text-content textoSobre"> <?= $dados["texto_apre"] ?> </p>
                    </div>                    
                </div>
            </article>       
        </section>

        <section class="row">
            <article class="col-12 carousel-container">
                <h1 class="text-content">Categorias de Serviços</h1>
                <div id="carouselExample" class="carousel slide">
                    <div class="carousel-inner">
                        <?php 
                            if (!empty($dados['id_ser'])) {
                                foreach ($dados['nome_ser'] as $index => $nome_ser) {
                                    // Define a classe "active" apenas para o primeiro item
                                    $activeClass = ($index === 0) ? 'active' : ''; 
                        ?>
                                <!-- começo do loop -->
                                <div class="carousel-item <?= $activeClass; ?>">
                                    <div class="card">
                                        <div class="row card-body">
                                            <div class="col-9">
                                                <h5 class="card-title text-content"><?= $nome_ser; ?></h5>
                                                <p class="card-text text-content">
                                                    <?= $dados['sobre_ser'][$index]; ?>
                                                </p>
                                            </div>
                                            <div class="col-3">
                                                <a href="" class="text-content">Descobrir mais</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- fim do loop -->
                        <?php 
                                } 
                            } else {
                                echo "<p> Esse interprete não se cadastrou em nenhum serviço </p>";
                            } 
                        ?>
                    </div>

                    <a class="carousel-control-prev" href="#carouselExample" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Anterior</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExample" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Próximo</span>
                    </a>
                </div>
            </article>
        </section>


        <section class="row rowVideo">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h2 class="titulo text-content">Vídeo de Apresentação</h2>
                    <a href="#infoAdd"><button class="btnInfos text-content">Informações adicionais</button></a>
                </div>
                <hr class="linha-divisoria">
                <div class="colVideo">
                    
                    <video id="video" controls autoplay="false">
                            <source src="../assets/interprete/perfil/<?= $dados["video_apre"] ?>"> type="video/mp4">
                            Seu navegador nao suporta videos
                    </video>
                    <!-- ELE FICA DANDO AUTOPLAY DIRETO PQ ELE N SUPORTA NO IFRAME,
                    <iframe id="video" src="../Assets/Interprete/perfil/<?= $dados["video_apre"] ?>" title="Vídeo de Apresentação do Interprete" frameborder="0" allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                    -->
                </div>
            </div>
        </section>
    
        <section class="row rowTudo">
            <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 colTitulo">
                <h3 class="text-content" id="infoAdd">Informações Adicionais</h3>
                <h2 class="text-content">Onde e quando você pode encontrar o seu intérprete.</h2>
            </div>
            <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 colTexto">
                <p class="text-content">Encontre todas as informações essenciais sobre o seu intérprete. Saiba onde e quando ele estará disponível para garantir uma experiência de comunicação completa e sem barreiras.</p>
                <a href="duvidas.php" class="text-content">Entenda como funciona <i class="bi bi-arrow-right"></i></a>
            </div>                
            <div class="col-12"> 
                <div class="cardInfosUm">
                    <h1 class="text-content">Locais</h1>
                    <!-- o loop é cada 'p' -->
                    <p class="text-content"><i class="bi bi-geo-alt text-content"></i> &nbsp; <?= $dados["cidade"] ?></p>
                </div><br>
            </div>               
        </section>
        
       
        
    </main>


    



    <script src="../assets-amanda/js/script.js"></script>
    <script>
         document.getElementById('video').autoplay = false;
    </script>
</body>
</html>
