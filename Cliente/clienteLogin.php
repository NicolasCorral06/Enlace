<?php
session_start();

if (isset($_SESSION["id_cli"])) {
    header("Location: View/cliente.php");
}

if (isset($_REQUEST["msg"])) {
    require_once "../Adm/Model/msg.php";
    $cod = $_REQUEST["msg"];
    $msgExibir = $MSG[$cod];
}

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
    <link rel="stylesheet" href="../Assets-amanda/style/styleLogin.css">
    <title>Login</title>
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
            <div class="col-4 col-md-2 buttonVoltar">
                <a class="text-content" href="../index.php"><svg fill="currentColor" height="22" viewBox="0 0 22 22" width="22" xmlns="http://www.w3.org/2000/svg"><rect class="BackArrow-stem-zLMkj BackArrow-exited-OVpTp" height="2" width="0" x="7" y="10"></rect><path class="BackArrow-exited-OVpTp" d="M15.75 4H13L6 11L13 18H15.75L8.75 11L15.75 4Z"></path></svg> Voltar</a>
            </div>
            <div class="col-5 col-md-8"></div>
            <div class="col-3 col-md-2 buttonSun">
                <br>
                <i id="toggleTheme" class="bi bi-sun"></i>
            </div>
        </div>
        <div class="row rowLogo-login">
            <div class="col-12">
                <img src="../Assets-amanda/arquivos/logotipos/LOGOTIPO-mao.png" alt="Logotipo da empresa Enlace com mãos simbolizando libras" title="Logotipo da Empresa Enlace">
            </div>
            <div class="col-12">
                <br><br>
            </div>
        </div>
        <div class="row rowForms-login">
            <div class="col-12 col-md-6 colForms-login">
                <form action="../Adm/Controller/cliController.php" method="POST">
                    <input type="hidden" name="clienteLogar" value="1">

                    <label for="email" class="labelForms-login text-content">ENDEREÇO DE EMAIL</label>
                    <input type="email" name="email" id="email" class="text-content" placeholder="nome@exemplo.com" required><br>

                    <label for="password" class="labelForms-login text-content">Senha</label><br>
                    <input type="password"name="senha" id="password" class="text-content labelSenha" placeholder="******" maxlength="15" required><br>
                    
                    <a href="javascript:void(0)" class="text-content" style="color: #2e6b73" onclick="window.open('mudarsenha.php', '_blank', 'width=500,height=400,resizable=yes,scrollbars=yes')"> Esqueci a senha</a>

                    <p>Não tem uma conta? <a href="clienteCadastro.php"> Criar conta</a></p>            
                    <button type="submit" class="labelButtonForms-login text-content">Entrar</button>
                </form>
            </div>
            <div class="col-12 col-md-1 colVertical-login">
                <div class="vertical-login"></div>
            </div>
            <div class="col-12 col-md-5 colDireito d-none d-md-block">
                <h1 class="text-content">Bem vindo!</h1>
                <p class="text-content">Aqui você encontra profissionais prontos para ajudar, com agendamentos rápidos e fáceis. Conecte-se de forma prática e acessível.</p>
                <a href="clienteCadastro.php" class="text-content">Criar conta</a>
            </div>
        </div>
        <br><br><br>
        <div class="row rowDireitos-login">
            <div class="col-12 colTermos-login">
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
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="../Assets-amanda/js/script.js"></script>

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
  
  
      <footer>
      </footer>
  
      
  
      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
  </html>
  
  <?php
  
     if (isset($_REQUEST["msg"])) {
      require_once "../adm/Model/msg.php";
      $cod = $_REQUEST["msg"];
      $msgExibir = $MSG[$cod];
      echo "<script>
      var textomodal = document.getElementById('textomodal')
      textomodal.innerHTML = '".$MSG[$cod]."'
      $('#textomodalcelsomito').modal('show');
  
      </script>";
  }
  
  ?>
