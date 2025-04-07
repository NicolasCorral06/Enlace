<?php

if (isset($_REQUEST["msg"])) {
    require_once "../Adm/Model/msg.php";
    $cod = $_REQUEST["msg"];
    $msgExibir = $MSG[$cod];
}

$config = require '../Adm/Model/api.php';
$site_key = $config['site_key'];
?>
<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../assets - amanda2/style/styleContrato.css">
    <link rel="stylesheet" href="../assets - amanda2/style/styleCadastro.css">

    <script src='https://www.hCaptcha.com/1/api.js' async defer></script>

    <title>Trabalhe Conosco</title>
    <style>
        .form-step {
            display: none;
        }

        .form-step.active {
            display: block;
        }

        .form-control.is-invalid {
            border: 2px solid red;
        }

        .error-message {
            display: none;
        }

        .error-message.active {
            display: block;
        }

        .btn-sucess{
            color: #fff;
            background-color: #2e6b73;
            width: 100%;
            border-radius: 30px;
            border: none;
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
                            <a class="nav-link navUm text-content" href="../paginas/servicos.php">Serviços&nbsp;&nbsp;</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link navDois text-content" href="../paginas/equipe.php">Equipe&nbsp;&nbsp;</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link navTres text-content" href="../paginas/duvidas.php">Dúvidas&nbsp;&nbsp;</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link navTres text-content" href="../paginas/contatos.php">Contatos</a>
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
    <section class="contact-section">
        <header class="contact-bg">
            <h2 class="text-content">Trabalhe Conosco</h2>
            <p class="text-content">Faça parte do nosso time de profissionais dedicados à inclusão!</p>
            <div class="line">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </header>

        <main class="contact-container" id="main-content">
            <section class="row justify-content-center">
                <article class="col-12 col-md-8 col-lg-6">
                    <form id="loginCad" action="../Adm/Controller/intController.php" method="post" novalidate enctype="multipart/form-data"> <!-- INICIO DO FORM -->
                    <input type="hidden" name="interpreteCadastrar" value="1">
                        <!-- Etapa 1 -->
                        <div class="form-step active">
                            <h2 class="text-center">Dados Pessoais</h2>
                            <br>
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <label for="nome" class="text-content">Nome Completo</label>
                                    <input type="text" class="form-control text-content" id="nome" name="nome" required placeholder="Nome completo">
                                    <small class="error-message text-danger"></small>
                                </div>
                                <div class="col-12 col-md-6">
                                    <label for="cidade" class="text-content">Cidade de trabalho/moradia</label>
                                    <select id="cidade" name="cidade">
                                        <option value="">-- Selecione uma cidade valida --</option>
                                        <option value="São Paulo" selected> São Paulo </option>
                                        <option value="Guarulhos"> Guarulhos </option>
                                        <option value="Campinas"> Campinas </option>
                                        <option value="São Bernardo do Campo"> São Bernardo do Campo </option>
                                        <option value="Santo André"> Santo André </option>
                                    </select><br><br>
                                    <small class="error-message text-danger"></small>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12 col-md-6">
                                    <label for="email" class="text-content">E-mail</label>
                                    <input type="email" class="form-control" id="email" name="email" required placeholder="nome@exemplo.com" class="text-content">
                                    <small class="error-message text-danger"></small>
                                </div>
                                <div class="col-12 col-md-6">
                                    <label for="telefone" class="text-content">Telefone</label>
                                    <input type="text" class="form-control" id="telefone" name="telefone" placeholder="(00)00000-0000" required>
                                    <small class="error-message text-danger"></small>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12 col-md-6">
                                    <label for="nasc" class="text-content">Data de Nascimento</label>
                                    <input type="date" class="form-control" name="nasc" id="nasc" required>
                                    <small class="error-message text-danger"></small>
                                </div>
                                <div class="col-12 col-md-6 mt-3 mt-md-0">
                                    <label for="cpf" class="text-content">CPF</label>
                                    <input type="text" class="form-control" name="cpf" id="cpf" maxlength="14" placeholder="000.000.000-00" class="text-content" onkeypress="formatar('###.###.###-##', this)" required>
                                    <small class="error-message text-danger"></small>
                                </div>

                                <div class="h-captcha" data-sitekey="<?= $site_key ?>"></div>

                            </div>
                            <div class="text-center mt-4">
                                <button type="button" class="next-btn">Próximo</button>
                            </div>
                        </div>

                        <!-- Etapa 2 -->
                        <div class="form-step">
                            <h2 class="text-center">Envio de Arquivos</h2>
                            <div class="form-group file-input" data-label="Vídeo">
                                <label for="video">Envie seu vídeo</label>
                                <input type="file" name="video" id="video" accept=".mp4" required>
                                <i class="bi bi-camera-video"></i>
                                <p class="mt-2 text-muted">Clique ou arraste o arquivo aqui</p>
                                <small class="error-message text-danger"></small>
                            </div>
                            <div class="form-group file-input mt-4" data-label="Currículo">
                                <label for="curriculo">Envie seu currículo</label>
                                <input type="file" name="curriculo" id="curriculo" accept=".pdf" required>
                                <i class="bi bi-file-earmark-text"></i>
                                <p class="mt-2 text-muted">Clique ou arraste o arquivo aqui</p>
                                <small class="error-message text-danger"></small>
                            </div>
                            <div class="d-flex justify-content-between mt-4">
                                <button type="button" class="prev-btn">Anterior</button>
                                <button type="button" class="next-btn">Próximo</button>
                            </div>
                        </div>


                        <!-- Etapa 3 -->
                        <div class="form-step">
                            <h2 class="text-center">Criação de Senha</h2>
                            <div class="form-group">
                                <label for="senha">Senha</label>
                                <input type="password" class="form-control" id="password" name="senha1" required minlength="6" placeholder="******" maxlength="15">
                                <small class="error-message text-danger"></small>
                            </div>
                            <div class="form-group">
                                <label for="confirmaSenha">Confirme a Senha</label>
                                <input type="password" name="senha2" id="confirmaSenha" placeholder="******" class="text-content" maxlength="15" required><br>
                                <small class="error-message text-danger"></small>
                            </div>
                        
                            <div class="d-flex justify-content-between mt-4">
                                <button type="button" class="prev-btn">Anterior</button>
                                <br>
                                <input type="submit" class="btn-success" value="Enviar" style="width: 100%; background-color: var(----cor-principal); border: none; padding: 1.5%; color: var(--cor-branco-light); border-radius: 20px;" ></input>
                            </div>
                        </div>
                    </form>
                </article>
            </section>
        </main>




        <br><br><br><br><br>



        <main class="contact-container-fim" id="main-content">
            <div class="row row-fimServicos">
                <div class="col-12 text-content">
                    <h1>Entenda como funciona o trabalho de intérprete no Enlace!</h1>
                    <br>
                    <a href="../Paginas/contatos.php" class="text-content">Entrar em contato</a>
                </div>
            </div>
        </main>
        <br><br><br><br><br>
    </section>

    
 
    <script>

         // Função pra formatar telefone
         document.getElementById('telefone').addEventListener('input', function(event) {
            var input = event.target.value.replace(/\D/g, '');
            if (input.length <= 2) {
                input = '(' + input;
            } else if (input.length <= 7) {
                input = '(' + input.slice(0, 2) + ') ' + input.slice(2);
            } else {
                input = '(' + input.slice(0, 2) + ') ' + input.slice(2, 7) + '-' + input.slice(7, 11);
            }
            event.target.value = input;
        });

        // Função pra formatar cpf
        document.getElementById('cpf').addEventListener('input', function(event) {
        var input = event.target.value.replace(/\D/g, ''); // Remove tudo que não for número

            // Aplica o formato do CPF com base na quantidade de caracteres
            if (input.length <= 3) {
                input = input; // Apenas os 3 primeiros dígitos
            } else if (input.length <= 6) {
                input = input.slice(0, 3) + '.' + input.slice(3); // Adiciona o primeiro ponto
            } else if (input.length <= 9) {
                input = input.slice(0, 3) + '.' + input.slice(3, 6) + '.' + input.slice(6); // Adiciona o segundo ponto
            } else {
                input = input.slice(0, 3) + '.' + input.slice(3, 6) + '.' + input.slice(6, 9) + '-' + input.slice(9, 11); // Adiciona o traço
            }

            event.target.value = input; // Aplica o valor formatado ao campo
        });
    document.addEventListener("DOMContentLoaded", () => {
        // Variáveis
        const steps = document.querySelectorAll(".form-step");
        const nextBtns = document.querySelectorAll(".next-btn");
        const prevBtns = document.querySelectorAll(".prev-btn");
        let currentStep = 0;
        const form = document.getElementById("loginCad");
        const inputs = form.querySelectorAll("input");
        const errorMessages = form.querySelectorAll(".error-message");
        const toggleThemeBtn = document.getElementById("toggleTheme");
        const fontButtons = document.querySelectorAll(".fixed-button button");
        const mainContent = document.getElementById("main-content");

        // Função para validar campos
        function validateField(field) {
            const errorMessage = field.nextElementSibling;
            if (!field.validity.valid) {
                field.classList.add("is-invalid");
                errorMessage.textContent = field.validationMessage || "Campo inválido!";
                errorMessage.classList.add("active");
                return false;
            } else {
                field.classList.remove("is-invalid");
                errorMessage.textContent = "";
                errorMessage.classList.remove("active");
                return true;
            }
        }

        // Validação dos campos ao avançar ou retroceder nas etapas
        function validateStep(stepIndex) {
            const inputsInStep = steps[stepIndex].querySelectorAll("input");
            let valid = true;
            inputsInStep.forEach(input => {
                if (!validateField(input)) {
                    valid = false;
                }
            });
            return valid;
        }

        // Função para avançar para a próxima etapa
        nextBtns.forEach(btn => {
            btn.addEventListener("click", () => {
                if (validateStep(currentStep)) {
                    steps[currentStep].classList.remove("active");
                    currentStep++;
                    steps[currentStep].classList.add("active");
                }
            });
        });

        // Função para retornar à etapa anterior
        prevBtns.forEach(btn => {
            btn.addEventListener("click", () => {
                steps[currentStep].classList.remove("active");
                currentStep--;
                steps[currentStep].classList.add("active");
            });
        });


        // Alterar tema da página (escuro/claro)
        toggleThemeBtn.addEventListener("click", () => {
            document.body.classList.toggle("dark-theme");
            if (document.body.classList.contains("dark-theme")) {
                toggleThemeBtn.classList.replace("bi-sun", "bi-moon");
            } else {
                toggleThemeBtn.classList.replace("bi-moon", "bi-sun");
            }
        });

        // Alteração de fonte
        fontButtons.forEach(button => {
            button.addEventListener("click", () => {
                const fontSize = button.innerHTML.includes('+') ? 'larger' : 'smaller';
                if (fontSize === 'larger') {
                    mainContent.style.fontSize = 'larger';
                } else {
                    mainContent.style.fontSize = 'smaller';
                }
            });
        });

        // Função de verificação de todos os campos antes de avançar
        inputs.forEach(input => {
            input.addEventListener("input", () => {
                validateField(input);
            });
        });
    });
</script>

<div class="container-fluid footer">
            <footer class="py-5">
            <div class="row">
                <div class="col-12 col-md-4 mb-6 colLogo-footer">
                <img src="../assets - amanda3/logotipos/logoBrancoAmarelo.png" alt="Logotipo da empresa Enlace" title="Logotipo da Enlace">
                </div>
                <div class="col-6 col-md-2 mb-3 sites">
                <h5>INSTITUCIONAL</h5>
                <ul class="nav flex-column">
                    <li class=""><a href="../paginas/servicos.php" class="">Serviços</a></li>
                    <li class=""><a href="../paginas/equipe.php" class="">Equipe</a></li>
                    <li class=""><a href="../paginas/duvidas.php" class="">Dúvidas</a></li>
                    <li class=""><a href="../paginas/contatos.php" class="">Contatos</a></li>
                    <li class=""><a href="../interprete/interpreteLogin.php" class="">Trabalhe Conosco</a></li>
                </ul>
                </div>
                <div class="col-md-5 offset-md-1 mb-3">
                <form>
                    <h5>Envie sua mensagem para nós</h5>
                    <p>Tem alguma dúvida? Envie sua mensagem e entraremos em contato.</p>
                    <div class="d-flex flex-column flex-sm-row w-100 gap-2">
                    <input id="newsletter1" type="text" class="form-control" placeholder="Email">
                    </div>
                </form>
                </div>
            </div>
            <div class="d-flex flex-column flex-sm-row justify-content-between py-4 my-4 border-top divIcons">
                <p>&copy; <a href="../adm/" class="a-footer">2024 Enlace. </a> Todos os direitos reservados.</p>
            </div>
            </footer>
        </div>
    
</body>
</html>
