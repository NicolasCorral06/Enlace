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
    <link rel="stylesheet" href="../assets - amanda2/style/styleDuvidas.css">
    <title>Dúvidas</title>
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
                        <a href="../Interprete/interpreteLogin.php" class="buttonContatos mr-2 text-content">Trabalhe Conosco</a>
                        <a href="../Cliente/clienteLogin.php" class="buttonPerfil text-content">Perfil <i class="bi bi-arrow-right"></i></a>
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
    <div class="container-fluid">
        <div class="row rowBanner">
          <div class="jumbotron text-center">
            <h1 class="text-content display-4">Centro de informações</h1>
            <p class="text-content lead">Aqui você pode entender como funciona nosso site e tirar as suas dúvidas!</p>
            <hr class="my-4">
            <div class="d-flex justify-content-center flex-wrap">
                <a class="text-content buttonBanner m-2" href="#rowFunciona" role="button">Como funciona</a>
                <a class="text-content buttonBanner m-2" href="#rowRegras" role="button">Regras de uso</a>
                <a class="text-content buttonBanner m-2" href="#rowDuvidas" role="button">Dúvidas frequentes</a>
            </div>
          </div>   
        </div>
        <div class="row rowFunciona-um" id="rowFunciona">
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-um">
                <h1 class="text-content">Como contratar um serviço</h1>
                <p class="text-content">Nesta página, você encontrará as categorias de serviços disponíveis em nosso site. Utilize o botão com uma seta (<i class="bi bi-chevron-right"></i>) para navegar e explorar mais opções. Se algum serviço chamou sua atenção, clique sobre ele para acessar mais detalhes e realizar o agendamento.</p>
                <a href="servicos.php" class="text-content">Visitar a página</a>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-dois">
                <img src="../Assets/img/servico.png" alt="Imagem da página de serviços" title="Imagem da página de serviços">
            </div>
        </div>
        <div class="row rowFunciona-dois">
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-um">
                <img src="../Assets/img/agendamento.png" alt="Imagem da página de agendamento" title="Imagem da página de agendamento">
            </div>
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-dois">
                <h1 class="text-content">Página de Agendamento</h1>
                <p class="text-content">Nesta página, você pode agendar o serviço selecionado. Basta escolher a data do evento, definir os horários de início e término, selecionar um ou mais intérpretes para realizar o serviço e consultar os preços.</p>
                <a href="servicos.php" class="text-content">Visitar a página</a>
            </div>
        </div>
        <div class="row rowFunciona-tres">
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-um">
                <h1 class="text-content">Página de Equipe</h1>
                <p class="text-content">Esta página apresenta todos os intérpretes que fazem parte da nossa equipe, você pode saber melhor quem trabalha conosco. Utilize o botão "Filtros" para encontrar intérpretes de regiões específicas ou especializados em determinados serviços. Ao clicar em um intérprete, você será direcionado a uma página com todos os detalhes sobre ele.</p>
                <a href="equipe.php" class="text-content">Visitar a página</a>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-dois">
                <img src="../Assets/img/equipe.png" alt="Imagem da página de Equipe" title="Imagem da página de Equipe">
            </div>
        </div>
        <div class="row rowFunciona-quatro">
            <div class="col-12 col-dois">
                <h1 class="text-content">Página de Detalhes do Interprete</h1>
                <p class="text-content">Nesta página, você pode acessar todas as informações sobre o nosso intérprete, permitindo que o conheça melhor antes de contratá-lo. Encontre um texto descritivo sobre ele, um vídeo interpretando em Libras, os serviços que oferece, os locais onde atua, além de seus horários e dias disponíveis. Também é possível entrar em contato diretamente por aqui.</p>
                <a href="equipe.php" class="text-content">Visitar a página</a>
            </div>
        </div>

        <div class="row rowRegras" id="rowRegras">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="info-panel">
                    <h5 class="text-content panel-title">Estrutura dos Nossos Serviços</h5>
                    <p class="text-content panel-content">Na Enlace, nossos serviços de interpretação em Libras são organizados para atender suas necessidades, aqui está as nossas recomendações :</p>
                    <ul class="panel-list">
                        <li class="text-content"><strong>1 ou 2 horas</strong>: 1 intérprete</li>
                        <li class="text-content"><strong>3 horas</strong>: 2 intérpretes</li>
                        <li class="text-content"><strong>4 horas</strong>: 2 intérpretes</li>
                        <li class="text-content"><strong>5 horas</strong>: 3 intérpretes</li>
                        <li class="text-content"><strong>6 horas</strong>: 3 intérpretes</li>
                    </ul>
                    <br>
                    <p class="text-content panel-content">
                      Essa estrutura é cuidadosamente planejada para assegurar a máxima qualidade na interpretação, proporcionando uma comunicação clara e eficaz durante todo o evento. A quantidade de intérpretes aumenta conforme a duração do serviço, garantindo que a interpretação seja feita de maneira contínua e sem sobrecarga para os profissionais. Isso também assegura que o bem-estar dos intérpretes seja preservado, permitindo que eles ofereçam um serviço com total concentração e precisão, sem comprometer a qualidade da comunicação.
                    </p>
                </div>
            </div>
        </div>

        <div class="row rowDuvidas" id="rowDuvidas">
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 colTexto-duvidas">
                <h2 class="text-content">Dúvidas</h2>
                <h1 class="text-content">Sua dúvida pode ser a de muitos! <br> Confira nossas perguntas frequentes.</h1>
                <p class="text-content">Aqui, você pode entender como funciona o nosso site e tirar todas as suas dúvidas! Se você está com alguma questão sobre nossos serviços, agendamentos, ou como contratar um intérprete, esta é a seção ideal para esclarecer tudo o que precisa.</p>
                <a href="contatos.php" class="text-content">Faça perguntas</a>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                <div class="container my-5">                    
                    <div class="faq-card">
                      <div class="accordion" id="faqAccordion">
                        <!-- Serviço Online -->
                        <div class="accordion-item">
                          <h2 class="accordion-header" id="headingOne">
                            <button class="text-content accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseUm" aria-expanded="false" aria-controls="collapseTwo">
                              Vocês trabalham apenas presencialmente?
                            </button>
                          </h2>
                         <div id="collapseUm" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#faqAccordion">
                            <div class="text-content accordion-body">
                            Sim, nossos serviços são realizados exclusivamente de forma presencial. Acreditamos que, para garantir a melhor qualidade de comunicação e interação, é essencial que os intérpretes estejam fisicamente presentes. Isso permite uma conexão mais eficiente e natural entre o intérprete e o público-alvo, além de evitar possíveis falhas técnicas que podem ocorrer em meios virtuais. Nosso compromisso é entregar um serviço impecável, e a presença presencial é fundamental para isso.
                            </div>
                          </div>
                        </div>
                  
                        
                        <div class="accordion-item">
                          <h2 class="accordion-header" id="headingTwo">
                            <button class="text-content accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseDois" aria-expanded="false" aria-controls="collapseTwo">
                              Os serviços são realizados apenas em São Paulo?
                            </button>
                          </h2>
                          <div id="collapseDois" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#faqAccordion">
                            <div class="text-content accordion-body">
                            Sim, atendemos exclusivamente na cidade de São Paulo. Essa escolha foi feita para garantir a pontualidade e a logística necessária para o deslocamento dos intérpretes, uma vez que o serviço envolve compromissos presenciais. Além disso, concentrar nosso atendimento em uma região permite oferecer suporte rápido e eficiente tanto para os intérpretes quanto para os clientes. Nosso foco é manter a qualidade e atender às demandas com excelência, o que é mais viável ao atuar dentro de um limite geográfico.
                            </div>
                          </div>
                        </div>
                  
                       
                       <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwo">
                          <button class="text-content accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTres" aria-expanded="false" aria-controls="collapseTwo">
                            Posso alterar a data ou horário do serviço depois de agendado?
                          </button>
                        </h2>
                        <div id="collapseTres" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#faqAccordion">
                          <div class="text-content accordion-body">
                            Não é possível alterar a data ou horário de um serviço já agendado. Essa política foi adotada para respeitar o planejamento e a dedicação dos intérpretes, que organizam suas agendas com antecedência. Quando um serviço é agendado, o intérprete compromete seu tempo para atender exclusivamente àquela solicitação, e qualquer alteração pode prejudicar o cronograma dele. Por isso, pedimos que os clientes tenham certeza ao contratar o serviço. Essa abordagem garante que ambos os lados, cliente e intérprete, possam confiar no compromisso estabelecido.
                          </div>
                        </div>
                      </div>

                      
                      <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwo">
                          <button class="text-content accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseQuatro" aria-expanded="false" aria-controls="collapseTwo">
                            Vocês têm política de cancelamento ou reembolso?
                          </button>
                        </h2>
                        <div id="collapseQuatro" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#faqAccordion">
                          <div class="text-content accordion-body">
                            Não trabalhamos com cancelamento ou reembolso. Quando o cliente agenda um serviço, o intérprete reserva aquele horário exclusivamente para atender à solicitação. Mesmo que o cliente não utilize o serviço, o intérprete é remunerado, pois sua disponibilidade foi comprometida. Essa política protege os profissionais e garante que eles possam se dedicar plenamente ao trabalho. Recomendamos que os clientes tenham total certeza ao contratar para evitar quaisquer inconvenientes. Nosso objetivo é garantir o equilíbrio entre as necessidades dos clientes e o respeito ao trabalho dos intérpretes.
                          </div>
                        </div>
                      </div>

                      
                      <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwo">
                          <button class="text-content accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseCinco" aria-expanded="false" aria-controls="collapseTwo">
                            O que está incluído no serviço de interpretação?
                          </button>
                        </h2>
                        <div id="collapseCinco" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#faqAccordion">
                          <div class="text-content accordion-body">
                          O valor do serviço inclui tanto o deslocamento do intérprete até o local combinado quanto o trabalho de interpretação em si. Além disso, seguimos regras para preservar o bem-estar dos intérpretes, como pausas obrigatórias de 15 minutos a cada 1 hora de serviço. Essas pausas são essenciais para que o profissional mantenha sua concentração e energia durante o atendimento. Nosso compromisso é oferecer um serviço de qualidade enquanto respeitamos as condições de trabalho dos intérpretes.
                          </div>
                        </div>
                      </div>

                      <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwo">
                          <button class="text-content accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeis" aria-expanded="false" aria-controls="collapseTwo">
                            O que acontece se o cliente ou intérprete não comparecer ao serviço?
                          </button>
                        </h2>
                        <div id="collapseSeis" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#faqAccordion">
                          <div class="text-content accordion-body">
                            Se houver algum problema, o cliente deve entrar em contato conosco por e-mail, explicando a situação. Estamos sempre dispostos a avaliar os casos e buscar a melhor solução possível, dentro das nossas políticas. Essa medida garante que os intérpretes tenham segurança e estabilidade no trabalho.
                          </div>
                        </div>
                      </div>

                      <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwo">
                          <button class="text-content accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSete" aria-expanded="false" aria-controls="collapseTwo">
                            Como o valor é calculado (por hora, evento, ou número de intérpretes)?
                          </button>
                        </h2>
                        <div id="collapseSete" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#faqAccordion">
                          <div class="text-content accordion-body">
                            O valor do serviço é calculado com base na duração e nas necessidades do cliente, seguindo as regras estabelecidas para garantir um atendimento de qualidade. A cobrança inclui uma taxa de serviço para a empresa e considera o bem-estar dos intérpretes, respeitando condições que permitem um trabalho eficiente e profissional. Calculado por hora de atendimento, levando em consideração a quantidade de intérpretes necessária para a duração do serviço. Seguindo as regras, quanto maior o tempo do evento, mais intérpretes são exigidos, o que aumenta o preço da hora proporcionalmente.
                          </div>
                        </div>
                      </div>

                      <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwo">
                          <button class="text-content accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOito" aria-expanded="false" aria-controls="collapseTwo">
                            Vocês atendem em outras línguas além de Libras?
                          </button>
                        </h2>
                        <div id="collapseOito" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#faqAccordion">
                          <div class="text-content accordion-body">
                            Não, nosso foco é exclusivamente em interpretação de Libras. Acreditamos na importância de especialização para garantir a máxima qualidade no serviço. Isso nos permite atender com excelência tanto surdos quanto ouvintes que dependem da Libras para comunicação. Nossa equipe é altamente capacitada nessa área, garantindo um atendimento especializado e eficiente.
                          </div>
                        </div>
                      </div>
                  
                      </div>
                    </div>
                  </div>
            </div>
        </div>
    </div>


     <br><br><br><br><br>

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





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets - amanda2/js/script-paginas.js"></script>
</body>
</html>
