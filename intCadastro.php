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
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../assets-amanda/style/styleCadastro.css">
    <title>Cadastro</title>
</head>
<body>

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
        <div class="row rowTopo-login">
            <div class="col-1 buttonVoltar">
                <a href="servicos.php"><svg fill="currentColor" height="22" viewBox="0 0 22 22" width="22" xmlns="http://www.w3.org/2000/svg"><rect class="BackArrow-stem-zLMkj BackArrow-exited-OVpTp" height="2" width="0" x="7" y="10"></rect><path class="BackArrow-exited-OVpTp" d="M15.75 4H13L6 11L13 18H15.75L8.75 11L15.75 4Z"></path></svg> Voltar</a>
            </div>
            <div class="col-10"></div>
            <div class="col-1 buttonConta">
                <br>
                <i id="toggleTheme" class="bi bi-sun"></i>
            </div>
        </div>

        <div class="row rowLogo-login">
            <div class="col-12 colLogo-login">
                <img src="../assets-amanda/arquivos/logotipos/LOGOTIPO-mao.png" alt="Logotipo da empresa Enlace com mãos simbolizando libras" title="Logotipo da Empresa Enlace">
            </div>
            <br><br><br><br><br><br>
        </div>

        <div class="row rowForms-login">
            <!-- Primeira Coluna -->
            <div class="col-12 col-sm-6">
                <form id="loginCad" action="../php/cadastro.php" method="post"  enctype="multipart/form-data"> <!-- INICIO DO FORM -->
                    <label for="nome" class="labelForms-login text-content">NOME COMPLETO</label>
                    <input type="text" name="nome" id="nome" placeholder="Nome completo" class="text-content" required><br>

                    <label for="email" class="labelForms-login text-content">ENDEREÇO DE EMAIL</label>
                    <input type="email" name="email" id="email" placeholder="nome@exemplo.com" class="text-content" required><br>
                    
                    <label for="telefone" class="labelForms-login text-content">Telefone</label>
                    <input type="text" name="telefone" id="telefone" placeholder="(00)00000-0000" class="text-content" required><br>

                    <label for="cpf" class="labelForms-login text-content">CPF</label>
                    <input type="text" name="cpf" id="cpf" placeholder="000.000.000-00" class="text-content" required><br>       
            </div>

            <!-- Segunda Coluna -->
            <div class="col-12 col-sm-6">
                <label for="curriculo" class="labelForms-login text-content"> Curriculo </label>
                <input type="file" name="curriculo" id="curriculo" accept=".pdf" required><br><br><br><br>

                <label for="video" class="labelForms-login text-content">Video apresentação</label>
                <input type="file" id="video" accept=".mp4" required><br><br><br><br>        
                    
                <label for="password" class="labelForms-login text-content">Senha</label>
                <input type="password" id="password" class="text-content labelSenha" placeholder="******" maxlength="15" required><br>
                    
                <label for="confirmaSenha" class="labelForms-login text-content">Confirmação de Senha</label>
                <input type="password" id="confirmaSenha" placeholder="******" class="text-content" required><br>

               
            </div>
        </div>


        <div class="row rowButton-login">
            <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 colButton-login colTermos-login">
                <button type="submit" class="text-content button" > Cadastre-se </button>
                </form> <!-- FINAL DO FORM -->
                <p class="text-content">Login seguro com CAPTCHA <br> Ao logar você aceita os <a href="" type="button" class="text-content" data-toggle="modal" data-target="#modalExemplo">Termos de uso</a>.</p>
                <!-- Modal Termos de Uso -->
                <div class="modal fade" id="modalExemplo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Termos de Uso</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <h4>Introdução</h4>
                                <p>Bem-vindo ao nosso serviço! Ao acessar e usar o nosso site, você concorda em cumprir os seguintes termos e condições de uso. Caso não concorde, não utilize nossos serviços.</p>
                                <h4>Uso do Serviço</h4>
                                <p>O serviço oferece agendamento de intérpretes. Você concorda em fornecer informações precisas e completas para realizar a reserva. O uso do nosso site é restrito a fins legais.</p>
                                <h4>Privacidade</h4>
                                <p>Respeitamos sua privacidade. As informações coletadas serão usadas apenas para o propósito de prestação de serviços.</p>
                                <h4>Alterações nos Termos</h4>
                                <p>Podemos alterar os termos a qualquer momento, e essas alterações estarão em vigor assim que publicadas no site.</p>
                                <h4>Limitação de Responsabilidade</h4>
                                <p>Não nos responsabilizamos por danos indiretos ou consequenciais que possam ocorrer ao utilizar nossos serviços.</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12">
                <div id="passwordRequirements">
                    <div class="row">
                        <div class="col-6">
                            <p class="requirement text-content" id="length"><i class="bi bi-x"></i> Mínimo de 8 caracteres</p>
                            <p class="requirement text-content" id="uppercase"><i class="bi bi-x"></i> Pelo menos uma letra maiúscula</p>
                        </div>
                        <div class="col-6">
                            <p class="requirement text-content" id="lowercase"><i class="bi bi-x"></i> Pelo menos uma letra minúscula</p>
                            <p class="requirement text-content" id="number"><i class="bi bi-x"></i> Pelo menos um número</p>
                        </div>
                    </div>
                </div>     
            </div>
        </div>        
    </div>
    

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
    
        // Função pra primeira letra de cada palavra ser maiúscula - nome
        document.getElementById('nome').addEventListener('input', function(event) {
            var input = event.target.value;
            event.target.value = input.replace(/\b\w/g, function(match) {
                return match.toUpperCase();
            });
        });
    
        const passwordInput = document.getElementById('password');
        const lengthRequirement = document.getElementById('length');
        const uppercaseRequirement = document.getElementById('uppercase');
        const lowercaseRequirement = document.getElementById('lowercase');
        const numberRequirement = document.getElementById('number');
    
        // Função para atualizar ícone conforme requisito
        function updateIcon(element, condition) {
            const icon = element.querySelector('i');
            if (condition) {
                icon.classList.remove('bi-x');
                icon.classList.add('bi-check');
                element.classList.add('valid');
            } else {
                icon.classList.remove('bi-check');
                icon.classList.add('bi-x');
                element.classList.remove('valid');
            }
        }
    
        passwordInput.addEventListener('input', function() {
            const password = passwordInput.value;
            updateIcon(lengthRequirement, password.length >= 8);
            updateIcon(uppercaseRequirement, /[A-Z]/.test(password));
            updateIcon(lowercaseRequirement, /[a-z]/.test(password));
            updateIcon(numberRequirement, /\d/.test(password));
        });
    </script>



    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="../assets-amanda/js/script.js"></script>
</body>
</html>
