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
    <link rel="stylesheet" href="../assets-amanda/style/styleContatos.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous">
    <title>Contatos</title>
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
                        <a href="../Cliente/ClienteLogin.php" class="buttonPerfil text-content" aria-label="Clique para acessar o seu perfil de usuário">Perfil <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>     
                <i id="toggleTheme" class="bi bi-sun" aria-label="Alternar entre modo claro e escuro"></i>
            </div>
        </nav>
        
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
        <button onclick="aumentarFonte()" aria-controls="main-content" aria-label="Aumentar o tamanho da fonte no conteúdo principal">A <i class="bi bi-plus"></i></button><br>
        <hr>
        <button onclick="diminuirFonte()" aria-controls="main-content" aria-label="Reduzir tamanho da fonte">A <i class="bi bi-dash"></i></button>
    </aside>



    <!-- ------- CONTEÚDO --------- -->
    <section class="contact-section">
        <header class="contact-bg">
            <h2 class="text-content">Entre em contato</h2>
            <p class="text-content">A nossa equipe está pronta para te ajudar e responder rapidamente!</p>
            <div class="line">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </header>

        <main class="contact-container" id="main-content">
            <section class="contact-info" aria-labelledby="contact-title">
                <h2 class="underline" style="color: #2e6b73;">Encontre-nos</h2>
                <article class="info-item">
                    <span class="icon"><i class="fas fa-map-marker-alt"></i></span>
                    <p>
                        <strong><span class="textform text-content">Endereço</span></strong><br>
                        <span class="text-content">Av. Jornalista Roberto<br>Marinho, 20 - Morumbi</span>
                    </p>
                </article>
                <article class="info-item">
                    <span class="icon"><i class="fas fa-envelope-open"></i></span>
                    <p>
                        <strong><span class="textform">E-mail</span></strong><br>
                        <span class="text-content">suporte.enlace@gmail.com<br>
                        contato.elace@gmail.com</span>
                    </p>
                </article>
                <article class="info-item">
                    <span class="icon"><i class="fas fa-mobile-alt"></i></span>
                    <p>
                        <strong><span class="textform">Número para contato</span></strong><br>
                        <span class="text-content">(11) 5600-0000<br>
                        (11) 94000-0000</span>
                    </p>
                </article>

                <hr>

                <h4 style="color: #2e6b73;" class="text-content">Siga nossas redes sociais</h4>
                <ul class="social-icons">
                    <li><a href="https://www.facebook.com/profile.php?id=61569271222488&sk=map" class="text-content social-icon"><i class="fab fa-facebook-f"></i></a></li>
                    <li><a href="https://x.com/Enlace1455318?t=dX7QX7N5yprC-rCXH3FuJQ&s=09" class="text-content social-icon"><i class="fab fa-twitter"></i></a></li>
                    <li><a href="https://www.instagram.com/enlacetcc?igsh=MTFkcjZqejlrbDRzZA==" class="text-content social-icon"><i class="fab fa-instagram"></i></a></li>
                </ul>
            </section>

            <section class="contact-form">
                <form method="post" action="../adm/controller/controller.php">
                    <input type="hidden" name="contato" value="1">
                    <h2 class="underline" style="color: #2e6b73; font-weight: bold;">Envie uma mensagem</h2>

                    <div class="form-group">
                        <label for="nome" class="text-content">Nome</label>
                        <input type="text" id="nome" name="nome" placeholder="Digite seu nome">
                    </div>

                    <div class="row">
                        <div class="small">
                            <label for="email" class="text-content">E-mail</label>
                            <input type="email" id="email" name="email" placeholder="exemplo@email.com">
                        </div>
                        <div class="small">
                            <label for="telefone" class="text-content">Telefone</label>
                            <input type="tel" id="telefone" name="telefone" placeholder="Digite seu telefone">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="assunto" class="text-content">Assunto</label>
                        <select id="assunto" name="assunto">
                            <option class="text-content" value="" disabled selected>Selecione um assunto</option>
                            <option class="text-content" value="duvidas">Dúvidas</option>
                            <option class="text-content" value="sugestoes">Sugestões</option>
                            <option class="text-content" value="reclamacoes">Reclamações</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="mensagem" class="text-content">Mensagem (opcional)</label>
                        <textarea id="mensagem" name="mensagem" aria-describedby="msg-descricao" placeholder="Escreva sua mensagem"></textarea>
                        <span id="msg-descricao" class="sr-only">Descreva sua dúvida, sugestão ou reclamação</span>
                    </div>

                    <input type="submit" class="send-btn" value="Enviar">
                </form>
            </section>
        </main>

        <footer class="map">
            <iframe 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3655.7311275174893!2d-46.69954272375839!3d-23.613973863528933!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94ce50ceee6fd2cf%3A0x228e8bc004a4e470!2sETEC%20Jornalista%20Roberto%20Marinho!5e0!3m2!1spt-BR!2sbr!4v1727282921333!5m2!1spt-BR!2sbr" 
                width="100%" 
                height="500" 
                style="border:0;" 
                allowfullscreen 
                loading="lazy" 
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </footer>
    </section>

    
    <script src="../assets-amanda/js/script.js"></script>
</body>
</html>
