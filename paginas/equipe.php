
<?php
session_start();
include_once "../Adm/Model/manager.class.php";
$manager = new Manager();

$dados = $manager->puxarIntComFoto();

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
    <link rel="stylesheet" href="../assets - amanda2/style/styleEquipe.css">
    <title>Equipe</title>
</head>
<body>

   <!-- --------------- MENU ------------- -->
   <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <div class="colLogo">
                    <a class="navbar-brand" href="../index.php">
                        <img src="../assets - amanda2/logotipos/LOGOTIPO.png" alt="Logotipo da empresa Enlace - Clique para retornar à página inicial" title="Logotipo da Enlace - Clique para retornar à página inicial">
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
                        <a href="../Cliente/clienteLogin.php" class="buttonPerfil text-content" aria-label="Clique para acessar o seu perfil de usuário">Perfil <i class="bi bi-arrow-right"></i></a>
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
                    z-index: 999;
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
   <aside class="fixed-button" aria-labe - amanda2l="Ajustar tamanho da fonte">
        <button onclick="aumentarFonte()" aria-controls="main-content" aria-label="Aumentar tamanho da fonte">A <i class="bi bi-plus"></i></button><br>
        <hr>
        <button onclick="diminuirFonte()" aria-controls="main-content" aria-label="Reduzir tamanho da fonte">A <i class="bi bi-dash"></i></button>
    </aside>




    <!-- ------- CONTEÚDO --------- -->
    <main>
        <section>
            <div class="container-banner">
                <div class="row rowBanner">
                    <div class="col-12 colBanner">
                        <h2 class="text-content">Intérpretes de Libras que conectam você ao mundo da acessibilidade.</h2>
                        <hr class="my-4">
                        <p class="text-content">Quer entender como funciona para contratar um serviço?</p>
                        <br>
                        <a href="duvidas.php" class="text-content">Como funciona <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>    
                <div class="row row-svgServicos">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                        <path fill="var(--cor-fundo)" fill-opacity="1" d="M0,224L60,213.3C120,203,240,181,360,176C480,171,600,181,720,192C840,203,960,213,1080,213.3C1200,213,1320,203,1380,197.3L1440,192L1440,320L1380,320C1320,320,1200,320,1080,320C960,320,840,320,720,320C600,320,480,320,360,320C240,320,120,320,60,320L0,320Z"></path>
                    </svg>
                </div>
            </div>        
        </section>        

        <section class="container-fluid">
            <section class="row rowCards-equipe">
                <div class="col-12">
                    <header class="row rowTotal">
                        <div class="col-12 tituloCards-equipe">
                            <div class="row align-items-center">
                                <div class="col-12">
                                    <h1 class="text-content">Serviços</h1>
                                </div>
                            </div>
                        </div>                                                
                    </header>

                    <!-- ----------- CARDS INTERPRETES ----------- -->
                    <div class="row row-cards">
                        <?php
                        for($i = 1; $i <= $dados["num"]; $i++){
                            
                        ?>
                        <!-- começo do loop -->
                        <article class="col-xl-4 col-lg-6 col-md-6 col-sm-12 colCards-equipe">
                            <a href="detalhesInterprete.php?interprete=<?= $dados[$i]['nome']?>" class="card" aria-label="Visualizar mais detalhes sobre este intérprete">
                                <figure class="card__img"><svg xmlns="http://www.w3.org/2000/svg" width="100%"><rect fill="#ffffff" width="540" height="450"></rect><defs><linearGradient id="a" gradientUnits="userSpaceOnUse" x1="0" x2="0" y1="0" y2="100%" gradientTransform="rotate(222,648,379)"><stop offset="0" stop-color="#ffffff"></stop><stop offset="1" stop-color="#3f7f88"></stop></linearGradient><pattern patternUnits="userSpaceOnUse" id="b" width="300" height="250" x="0" y="0" viewBox="0 0 1080 900"><g fill-opacity="0.5"><polygon fill="#444" points="90 150 0 300 180 300"></polygon><polygon points="90 150 180 0 0 0"></polygon><polygon fill="#AAA" points="270 150 360 0 180 0"></polygon><polygon fill="#DDD" points="450 150 360 300 540 300"></polygon><polygon fill="#999" points="450 150 540 0 360 0"></polygon><polygon points="630 150 540 300 720 300"></polygon><polygon fill="#DDD" points="630 150 720 0 540 0"></polygon><polygon fill="#444" points="810 150 720 300 900 300"></polygon><polygon fill="#FFF" points="810 150 900 0 720 0"></polygon><polygon fill="#DDD" points="990 150 900 300 1080 300"></polygon><polygon fill="#444" points="990 150 1080 0 900 0"></polygon><polygon fill="#DDD" points="90 450 0 600 180 600"></polygon><polygon points="90 450 180 300 0 300"></polygon><polygon fill="#666" points="270 450 180 600 360 600"></polygon><polygon fill="#AAA" points="270 450 360 300 180 300"></polygon><polygon fill="#DDD" points="450 450 360 600 540 600"></polygon><polygon fill="#999" points="450 450 540 300 360 300"></polygon><polygon fill="#999" points="630 450 540 600 720 600"></polygon><polygon fill="#FFF" points="630 450 720 300 540 300"></polygon><polygon points="810 450 720 600 900 600"></polygon><polygon fill="#DDD" points="810 450 900 300 720 300"></polygon><polygon fill="#AAA" points="990 450 900 600 1080 600"></polygon><polygon fill="#444" points="990 450 1080 300 900 300"></polygon><polygon fill="#222" points="90 750 0 900 180 900"></polygon><polygon points="270 750 180 900 360 900"></polygon><polygon fill="#DDD" points="270 750 360 600 180 600"></polygon><polygon points="450 750 540 600 360 600"></polygon><polygon points="630 750 540 900 720 900"></polygon><polygon fill="#444" points="630 750 720 600 540 600"></polygon><polygon fill="#AAA" points="810 750 720 900 900 900"></polygon><polygon fill="#666" points="810 750 900 600 720 600"></polygon><polygon fill="#999" points="990 750 900 900 1080 900"></polygon><polygon fill="#999" points="180 0 90 150 270 150"></polygon><polygon fill="#444" points="360 0 270 150 450 150"></polygon><polygon fill="#FFF" points="540 0 450 150 630 150"></polygon><polygon points="900 0 810 150 990 150"></polygon><polygon fill="#222" points="0 300 -90 450 90 450"></polygon><polygon fill="#FFF" points="0 300 90 150 -90 150"></polygon><polygon fill="#FFF" points="180 300 90 450 270 450"></polygon><polygon fill="#666" points="180 300 270 150 90 150"></polygon><polygon fill="#222" points="360 300 270 450 450 450"></polygon><polygon fill="#FFF" points="360 300 450 150 270 150"></polygon><polygon fill="#444" points="540 300 450 450 630 450"></polygon><polygon fill="#222" points="540 300 630 150 450 150"></polygon><polygon fill="#AAA" points="720 300 630 450 810 450"></polygon><polygon fill="#666" points="720 300 810 150 630 150"></polygon><polygon fill="#FFF" points="900 300 810 450 990 450"></polygon><polygon fill="#999" points="900 300 990 150 810 150"></polygon><polygon points="0 600 -90 750 90 750"></polygon><polygon fill="#666" points="0 600 90 450 -90 450"></polygon><polygon fill="#AAA" points="180 600 90 750 270 750"></polygon><polygon fill="#444" points="180 600 270 450 90 450"></polygon><polygon fill="#444" points="360 600 270 750 450 750"></polygon><polygon fill="#999" points="360 600 450 450 270 450"></polygon><polygon fill="#666" points="540 600 630 450 450 450"></polygon><polygon fill="#222" points="720 600 630 750 810 750"></polygon><polygon fill="#FFF" points="900 600 810 750 990 750"></polygon><polygon fill="#222" points="900 600 990 450 810 450"></polygon><polygon fill="#DDD" points="0 900 90 750 -90 750"></polygon><polygon fill="#444" points="180 900 270 750 90 750"></polygon><polygon fill="#FFF" points="360 900 450 750 270 750"></polygon><polygon fill="#AAA" points="540 900 630 750 450 750"></polygon><polygon fill="#FFF" points="720 900 810 750 630 750"></polygon><polygon fill="#222" points="900 900 990 750 810 750"></polygon><polygon fill="#222" points="1080 300 990 450 1170 450"></polygon><polygon fill="#FFF" points="1080 300 1170 150 990 150"></polygon><polygon points="1080 600 990 750 1170 750"></polygon><polygon fill="#666" points="1080 600 1170 450 990 450"></polygon><polygon fill="#DDD" points="1080 900 1170 750 990 750"></polygon></g></pattern></defs><rect x="0" y="0" fill="url(#a)" width="100%" height="100%"></rect><rect x="0" y="0" fill="url(#b)" width="100%" height="100%"></rect></svg></figure>
                                <div class="card__avatar">
                                    <img src="../Assets/Interprete/perfil/<?= $dados[$i]["foto_perfil"] ?>" alt="Foto de perfil do intérprete" title="Foto de perfil do intérprete">
                                </div>
                                <header class="text-content card__title"> <?= $dados[$i]['nome']?> </header>
                                <p class="text-content card__subtitle">Intérprete de Libras</p>
                                <div class="card__arrow">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" height="15" width="15">
                                        <path fill="#fff" d="M13.4697 17.9697C13.1768 18.2626 13.1768 18.7374 13.4697 19.0303C13.7626 19.3232 14.2374 19.3232 14.5303 19.0303L20.3232 13.2374C21.0066 12.554 21.0066 11.446 20.3232 10.7626L14.5303 4.96967C14.2374 4.67678 13.7626 4.67678 13.4697 4.96967C13.1768 5.26256 13.1768 5.73744 13.4697 6.03033L18.6893 11.25H4C3.58579 11.25 3.25 11.5858 3.25 12C3.25 12.4142 3.58579 12.75 4 12.75H18.6893L13.4697 17.9697Z"></path>
                                    </svg>
                                </div>
                            </a>
                        </article>

                        <?php
                        
                        }
                        
                        ?>
                        <!-- fim do loop -->
                    </div>
                </div>
            </section>
        </section>
    </main>


    <div class="container-fluid footer">
            <footer class="py-5">
            <div class="row">
                <div class="col-12 col-md-4 mb-6 colLogo-footer">
                <img src="../assets - amanda3/logotipos/logoBrancoAmarelo.png" alt="Logotipo da empresa Enlace" title="Logotipo da Enlace">
                </div>
                <div class="col-6 col-md-2 mb-3 sites">
                <h5>INSTITUCIONAL</h5>
                <ul class="nav flex-column">
                    <li class=""><a href="servicos.php" class="">Serviços</a></li>
                    <li class=""><a href="equipe.php" class="">Equipe</a></li>
                    <li class=""><a href="duvidas.php" class="">Dúvidas</a></li>
                    <li class=""><a href="contatos.php" class="">Contatos</a></li>
                    <li class=""><a href="../interprete/interpreteLogin.php" class="">Trabalhe Conosco</a></li>
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
                <p>&copy; <a href="../adm/" class="a-footer">2024 Enlace. </a> Todos os direitos reservados.</p>
                <ul class="list-unstyled d-flex">
                <li class="ms-3"><a class="link-body-emphasis" href="https://www.facebook.com/profile.php?id=61569271222488&sk=map"><i  style="color: #fff; font-size: 1.3rem;" class="bi bi-facebook"></i></a></li>
                <li class="ms-3"><a class="link-body-emphasis" href="https://www.instagram.com/enlacetcc?igsh=MTFkcjZqejlrbDRzZA=="><i  style="color: #fff; font-size: 1.3rem;" class="bi bi-instagram"></i></a></li>
                <li class="ms-3"><a class="link-body-emphasis" href="https://x.com/Enlace1455318?t=dX7QX7N5yprC-rCXH3FuJQ&s=09"><i  style="color: #fff; font-size: 1.3rem;" class="bi bi-twitter"></i></a></li>
                </ul>
            </div>
            </footer>
        </div>


    <script src="../assets - amanda2/js/script-paginas.js"></script>
</body>
</html>
