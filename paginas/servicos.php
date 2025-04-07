<?php
session_start();
include_once "../Adm/model/manager.class.php";
                                
$manager = new Manager();
$dados = $manager->servicosListar_Status();

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
    <link rel="stylesheet" href="../assets-amanda/style/styleServicos.css">
    <title>Serviços</title>

    <style>
        body a{
            text-decoration: none !important;
        }

        .estrela {
            font-size: 30px;
            color: #2e6b7375;
            cursor: pointer;
        }
        .estrela.selecionada {
            color: #2e6b73;
        }
    </style>
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
                        <a href="../Interprete/InterpreteLogin.php" class="buttonContatos mr-2 text-content">Trabalhe Conosco</a>
                        <a href="../Cliente/clienteLogin.php" class="buttonPerfil text-content">Perfil <i class="bi bi-arrow-right"></i></a>
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
   <aside class="fixed-button" aria-label="Ajuste de Fonte">
        <button onclick="aumentarFonte()" aria-controls="main-content">A <i class="bi bi-plus"></i></button><br>
        <hr>
        <button onclick="diminuirFonte()" aria-controls="main-content">A <i class="bi bi-dash"></i></button>
    </aside>



    <!-- ------- CONTEÚDO --------- -->
    <main class="container-fluid">
        <section>            
            <article class="row rowCards">
                <header class="col-12 col-tituloServicos">
                    <h2 class="text-content">Enlace em ação</h2>
                    <h1 class="text-content">Encontre o serviço ideal para você</h1>
                </header>
                <div class="col-12 col-12-cards">
                <div id="carouselExampleControls" class="carousel slide" data-interval="false">
    <div class="carousel-inner">
        <div class="colButtons-servicos">
            <a class="carousel-button" href="#carouselExampleControls" role="button" data-slide="prev">
                <i class="bi bi-chevron-left"></i>
                <span class="sr-only">Anterior</span>
            </a>
            <a class="carousel-button" href="#carouselExampleControls" role="button" data-slide="next">
                <i class="bi bi-chevron-right"></i>
                <span class="sr-only">Próximo</span>
            </a>
        </div>

        <!-- INÍCIO DO LOOP -->
        <?php
        $numServicosPorPagina = 6; // Número total de serviços por página (3 em cima, 3 embaixo)
        $totalServicos = $dados["num"];
        $i = 1;

        while ($i <= $totalServicos) {
            // Marcar a primeira página como 'active'
            $activeClass = ($i == 1) ? 'active' : '';
            echo '<div class="carousel-item ' . $activeClass . '">';
            
            // Começa uma nova "página" do carrossel
            echo '<div class="row">';

            // Exibe 6 serviços por página (3 por linha)
            for ($linha = 0; $linha < 2 && $i <= $totalServicos; $linha++) {
                echo '<div class="col-12">'; // Linha com 3 serviços
                echo '<div class="row">';   // Grid row

                // Exibe 3 serviços por linha
                for ($coluna = 0; $coluna < 3 && $i <= $totalServicos; $coluna++, $i++) {
        ?>
            <article class="col-xl-4 col-lg-4 col-md-6 col-sm-12 colCard-servicos">
                <a href="agendamentoServicos.php?id=<?= $dados[$i]["id"] ?>">
                    <?php
                    if ($i % 2 != 0) {
                        echo '<div class="card-servicos spanCardUm">';
                    } else {
                        echo '<div class="card-servicos spanCardDois">';
                    }
                    ?>
                    <figure class="div-imgCard">
                        <img src="../assets-amanda/arquivos/logotipos/LOGOTIPO-mao.png" alt="Logotipo apenas com o símbolo de libras" title="Logotipo com o símbolo de libras">
                    </figure>
                    <h1 class="text-content"> <?= $dados[$i]["nome"] ?> </h1>
                    <p class="text-content"> <?= $dados[$i]["serve"] ?> </p>
                </a>

                <button type="button" data-toggle="modal" class="text-content avaliar" data-target="#avaliacaoModal<?= $dados[$i]["id"] ?>"> Avaliar </button>
                
                </div>              
            </article>
            
        <?php
                }

                ?>  
                
                
                <?php


                echo '</div>'; // Fecha a row de 3 colunas
                echo '</div>'; // Fecha a linha

                
            }

            echo '</div>'; // Fim da página do carrossel (6 serviços no total)
            echo '</div>'; // Fim do carousel-item

            
        }
        ?>
        <!-- FIM DO LOOP -->
        <?php foreach ($dados as $servico): ?>
            <?php
                
                $comentarios = (!empty($servico["id"])) ? $manager->listarComentario($servico["id"]) : [];
    
                
            ?>
            <div class="modal fade" id="avaliacaoModal<?= $servico["id"] ?>" tabindex="-1" role="dialog" aria-labelledby="modalLabel<?= $servico["id"] ?>" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalLabel<?= $servico["id"] ?>">Avaliação</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="../adm/Controller/ageController.php" method="post">
                                <input type="hidden" name="avaliacao" value="1">
                                <?= 
                                (isset($_SESSION["id_cli"]) && $_SESSION["id_cli"] != "") ? "<input type='hidden' name='id_cli' value='" . $_SESSION['id_cli'] . "'>" : "" 
                                ?>

                                <input type="hidden" name="id_ser" value="<?= $servico["id"] ?>">


                                <label for="estrelas">Quantas estrelas você deseja dar?</label><br>
                                <div class="estrelas">
                                    <span class="estrela" data-value="1">&#9733;</span>
                                    <span class="estrela" data-value="2">&#9733;</span>
                                    <span class="estrela" data-value="3">&#9733;</span>
                                    <span class="estrela" data-value="4">&#9733;</span>
                                    <span class="estrela" data-value="5">&#9733;</span>
                                </div>
                                <input type="hidden" name="estrelas" id="estrelas<?= $servico["id"] ?>" value="0">
                                <br>
                                <hr>
                                <br>
                                <label for="comentario">Escreva um comentário descrevendo a sua experiência:</label><br>
                                <textarea name="comentario" cols="50" rows="10"></textarea><br><br>

                                <input class="cadastrarAval" type="submit" 
                                    <?= 
                                    (!isset($_SESSION["id_cli"]) || $_SESSION["id_cli"] == "") ? "disabled value='É necessario logar para poder comentar' " : " value='Enviar' "  
                                    ?>
                                >

                                <?= 
                                (!isset($_SESSION["id_cli"]) || $_SESSION["id_cli"] == "") ? "<br><a href='../Cliente/clienteLogin.php' class='avaliarButton'> Cadastrar </a> " : ""  
                                ?>
                            </form>

                            <hr>

                            <b>Comentários:</b> <br><br>
                            <div id="comentarios">
                                <?php if (!empty($comentarios["result"]) && $comentarios["result"] == 1): ?>
                                    <?php foreach ($comentarios as $key => $comentario): ?>
                                        <?php if (is_array($comentario)): ?>
                                            <p>
                                                <strong>
                                                    <?= $comentario["nome_cli"] ?>
                                                    <?php for ($j = 0; $j < $comentario["estrela"]; $j++): ?>
                                                        &#9733; <!-- Código HTML para uma estrela -->
                                                    <?php endfor; ?>
                                                    <br>
                                                </strong>
                                                &nbsp;&nbsp;&nbsp;&nbsp;
                                                <?= htmlspecialchars($comentario["mensagem"]) ?>
                                            </p>
                                            <hr>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <p>Nenhum comentário encontrado.<br> Seja o primeiro a comentar !.</p>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>


                
    </div>
</div>

                </div>
                <div class="row row-fimServicos">
                    <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 text-content">Não encontrou o serviço ideal para você? Entre em contato conosco e iremos ajudar a personalizar uma solução que atenda às suas necessidades.</div>
                    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12">
                        <a href="contatos.php" class="text-content">Entrar em contato</a>
                    </div>
                </div>
            </article>
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


        
 
<script src="../assets-amanda/js/script.js"></script>
<script>
   document.querySelectorAll('.modal').forEach(modal => {
    const estrelas = modal.querySelectorAll('.estrela'); // Estrelas do modal atual
    const inputEstrelas = modal.querySelector('input[name="estrelas"]'); // Input de estrelas do modal atual

    estrelas.forEach((estrela, index) => {
        estrela.addEventListener('click', () => {
            // Atualiza o valor do input com o valor da estrela clicada
            inputEstrelas.value = index + 1;

            // Atualiza a aparência das estrelas (cor amarela para as selecionadas)
            estrelas.forEach((e, i) => {
                if (i <= index) {
                    e.classList.add('selecionada');
                } else {
                    e.classList.remove('selecionada');
                }
            });
        });
    });
});

</script>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

</body>
</html>

<?php
   if (isset($_REQUEST["msg"])) {
    require_once "../Model/msg.php";
    $cod = $_REQUEST["msg"];
    $msgExibir = $MSG[$cod];
    echo "<script>
    var textomodal = document.getElementById('textomodal')
    textomodal.innerHTML = '".$MSG[$cod]."'
    $('#textomodalcelsomito').modal('show');
    </script>";
}

?>
