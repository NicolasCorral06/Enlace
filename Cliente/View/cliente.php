<?php
session_start();

if (isset($_REQUEST["msg"]) && $_REQUEST["msg"] != "" && $_REQUEST["msg"] != "0") {
    require_once "../../Adm/Model/msg.php";
    $cod = $_REQUEST["msg"];

    if (isset($MSG[$cod])) {
        $msgExibir = $MSG[$cod];
        echo "<script>
        var textomodal = document.getElementById('textomodal');
        textomodal.innerHTML = '".$msgExibir."';
        $('#textomodalcelsomito').modal('show');
        </script>";
    }
}


if(!isset($_SESSION["id_cli"]) || $_SESSION["id_cli"] == ""){
    session_abort();
    ?>
        <form action="../clienteLogin.php" name="return" id="return" method="post">
            <input type="hidden" name="cod" value="OA02">
        </form>
        <script>
            document.getElementById("return").submit();
        </script>
    <?php
    exit();
}

include "../../Adm/Model/manager.class.php";
$manager = new Manager();
$dados = array();
$id = $_SESSION["id_cli"];


$dados = $manager->cliPuxar($id);

$_SESSION["id_cli"] = $dados["id"];
$_SESSION["foto_cli"] = $dados["foto_perfil"];
$_SESSION["nome_cli"] = $dados["nome"];
$_SESSION["email_cli"] = $dados["email"];
$_SESSION["telefone_cli"] = $dados["telefone"];
$_SESSION["nascimento_cli"] = $dados["nascimento"];
$_SESSION["cpf_cli"] = $dados["cpf"];
$_SESSION["data_insercao_cli"] = $dados["data_insercao"];
$_SESSION["status_cli"] = $dados["status"];


$resultado = $manager->cliPuxarFoto($dados["id"]);
if ($resultado["result"] == 1) {
    $_SESSION["foto_cli"] = $resultado["foto_perfil"];
} else {
    $_SESSION["foto_cli"] = null; // Ou um valor padrão, caso não tenha foto
}

$id_cli = $_SESSION["id_cli"];

$dadosC = array();
$dadosA = array();
$dadosC = $manager->listarHistoricoAgendamentoConcluido($id_cli);
$dadosA = $manager->listarHistoricoAgendamentoAndamento($id_cli);

//checa se existe alguma data que já tenha passado e se sim atualiza o status
$manager->atualizarStatusComData();
 
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
    <link rel="stylesheet" href="../../assets - amanda2/style/stylePerfil-interprete.css">
    <title>Perfil Cliente</title>


    <style>
        #mainUm, #mainDois, #mainTres, #mainQuatro, #mainCinco, #mainSeis{
            display: none;
        }

        .rowInfosAdicionais-agendamentos .row {
            display: flex;
            justify-content: space-between;
        }
    
        .info-label {
            font-weight: bold;
            margin-bottom: 8px;
        }
    
        .info-value {
            margin-bottom: 8px;
        }
    
        .text-right {
            text-align: right;
        }
    </style>

    <script>
        function logout(){
            var resp = confirm("Deseja realmente fazer logout?");
            if (resp == true){
                window.location.assign("logout.php");
            }
        }
    </script>
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
        <button class="buttonConta">
            <i id="toggleTheme" class="bi bi-sun"></i>
        </button>
        <br><br>
        <button onclick="aumentarFonte()" aria-controls="main-content" aria-label="Aumentar tamanho da fonte">A <i class="bi bi-plus"></i></button><br>
        <hr>
        <button onclick="diminuirFonte()" aria-controls="main-content" aria-label="Reduzir tamanho da fonte">A <i class="bi bi-dash"></i></button>
    </aside>


    <!-- ------- CONTEUDO SITE --------- -->
    <!-- ---- NAVBAR ------ -->
        <!-- menu hamburger -->
        <i class="bi bi-list mobile-nav-toggle d-xl-none"> </i>

        <header id="header">
            <nav class="col-md-3 col-lg-2 d-md-block bg-dark sidebar">
                <ul class="nav flex-column">
                    <div class="nav-item navFoto">
                        <h2> Área do Cliente </h2>
                    <?php
                            if(empty($_SESSION['foto_cli']) || $_SESSION['foto_cli'] == null){
                                echo '<img src="../../Assets-amanda/arquivos/fotosPerfil-geral/perfil-user.jpg" alt="Foto cliente">';
                            } else {
                                echo '<img src="../../Assets/Cliente/'. $_SESSION['foto_cli']. '" alt="Foto cliente">';
                            }
                        
                        ?>
                    </div>
                    <div class="nav-item">
                        <div class="buttonCriarConta">

                        </div>
                    </div>
                    <li class="nav-item inicio">
                        <a class="nav-link d-flex align-items-center" href="#mainUm" onclick="abrirMain('mainUm')">
                            <span class="menu-icon"><i class="bi bi-house"></i></span>
                            <span class="menu-text ml-2">Início</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center" href="#mainDois" onclick="abrirMain('mainDois')">
                            <span class="menu-icon"><i class="bi bi-person"></i></span>
                            <span class="menu-text ml-2">Dados Pessoais</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center" href="#mainQuatro" onclick="abrirMain('mainQuatro')">
                            <span class="menu-icon"><i class="bi bi-ban"></i></span>
                            <span class="menu-text ml-2">Autenticação</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center" href="#mainSeis" onclick="abrirMain('mainSeis')">
                            <span class="menu-icon"><i class="bi bi-calendar-week"></i></span>
                            <span class="menu-text ml-2">Agendamentos</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center" href="../../index.php"> Voltar &nbsp; <i class="bi bi-arrow-90deg-left"></i>
                        </a>
                    </li>
                    
                    <a class="button" onclick="logout()">Sair &nbsp; <i class="bi bi-box-arrow-in-right"></i></a>
                </ul>
            </nav>
        </header>
    <!-- ---- FIM NAVBAR ------ -->
    
    <div class="container-fluid">
        <div class="row">
            <!-- INICIO -->
            <section id="mainUm" class="col-md-9 ml-sm-auto col-lg-10 px-md-4 main-content">
                <div class="row rowBanner-perfil">
                    <div class="col-12">
                        <div class="row colBanner-perfil">
                            <div class="col-12">
                                <h1>Olá, <?= $_SESSION['nome_cli']?></h1>
                                <p>Seja bem vindo ao seu perfil, veja as suas informações.</p>
                            </div>
                        </div>
                        <div class="row rowCards-perfil">
                            <div class="col-12">
                            <a class="nav-link d-flex align-items-center" href="#mainSeis" onclick="abrirMain('mainSeis')">
                                <span class="menu-icon"><i class="bi bi-calendar-week"></i></span>
                                <span class="menu-text ml-2"> Historico/Agendamentos </span>
                            </a> 
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            
            <!-- DADOS PESSOAIS -->
            <section id="mainDois" class="col-md-9 ml-sm-auto col-lg-10 px-md-4 main-content">
                <div class="row rowDados-perfil">
                    <div class="col-12 tituloDados-perfil">
                        <hr class="custom-hr">
                        <h1 class=" text-content">PERFIL</h1>
                    </div>
                    <div class="col-12 colDados-perfil">
                        <div class="row">
                            <div class="col-xl-5 col-lg-12 col-md-12 col-sm-12 colImg-dados">
                                <?php
                                    if(empty($_SESSION['foto_cli']) || $_SESSION['foto_cli'] == null){
                                        echo '<img src="../../Assets-amanda/arquivos/fotosPerfil-geral/perfil-user.jpg" alt="Foto cliente">';
                                    } else {
                                        echo '<img src="../../Assets/Cliente/'. $_SESSION['foto_cli']. '" alt="Foto cliente">';
                                    }
                                ?>
                            </div>
                            <div class="col-xl-7 col-lg-12 col-md-12 col-sm-12 colInfos-dados">
                                <div class="form-group">
                                    <label for="nome" class=" text-content">Nome</label>
                                    <p class=" text-content"> <?= $_SESSION['nome_cli']?> </p>
                                </div>
                                <div class="form-group">
                                    <label for="email" class=" text-content">E-mail</label>
                                    <p class=" text-content"><?= $_SESSION['email_cli']?> </p>
                                </div>
                                <div class="form-group">
                                    <label for="cpf" class=" text-content">CPF</label>
                                    <p class=" text-content"><?= $_SESSION['cpf_cli']?> </p>
                                </div>
                                <div class="form-group">
                                    <label for="data-nascimento" class=" text-content">Data de Nascimento</label>
                                    <p class=" text-content"> <?= date('d/m/Y', strtotime($_SESSION['nascimento_cli']))?> </p>
                                </div>
                                <div class="form-group text-left">
                                    <a href="#mainTres" onclick="abrirMain('mainTres')" class=" text-content"><button class="nometemp2">Editar Perfil</button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- alteração dados pessoais -->
            <section id="mainTres" class="col-md-9 ml-sm-auto col-lg-10 px-md-4 main-content">
                <div class="row rowDados-perfil">
                    <div class="col-12 tituloDados-perfil">
                        <hr class="custom-hr">
                        <h1 class=" text-content">PERFIL</h1>
                    </div>
                    <div class="col-12 colDados-perfil">
                        <form action="../../adm/Controller/CliController.php" method="POST"  enctype="multipart/form-data">  
                          <input type="hidden" name="cliEdit" value="1">
                          <input type="hidden" name="id_cli" value="<?=$_SESSION['id_cli'];?>">
                        <div class="row">
                            <div class="col-xl-5 col-lg-12 col-md-12 col-sm-12 colImg-dados">
                            <?php
                                if(empty($_SESSION['foto_cli']) || $_SESSION['foto_cli'] == null){
                                    echo '<img src="../../Assets-amanda/arquivos/fotosPerfil-geral/perfil-user.jpg" alt="Foto cliente">';
                                } else {
                                    echo '<img src="../../Assets/Cliente/'. $_SESSION['foto_cli']. '" alt="Foto cliente">';
                                }
                            
                                ?>

                                
                                <input type="file" name="foto_cli" id="" class="arquivo">

                            </div>
                            <div class="col-xl-7 col-lg-12 col-md-12 col-sm-12 colInfos-dados">


                                
                                <div class="form-group">
                                    <label for="nome" class=" text-content">Nome</label>
                                    <input type="text" id="nome" name="nome" value="<?= $_SESSION['nome_cli']?>" class="form-control">
                                    <span id="nome-error" style="color: red; display: none; font-size: 0.9em;" class=" text-content">Por favor, insira um nome válido (somente letras, mínimo 2 caracteres).</span>
                                </div>   
                                <div class="form-group">
                                    <label for="email" class=" text-content">E-mail</label>
                                    <input type="email" id="email" name="email" class="form-control" value="<?= $_SESSION['email_cli']?>">
                                    <span id="email-error" style="color: red; display: none; font-size: 0.9em;" class=" text-content">Por favor, insira um e-mail válido.</span>
                                </div>                
                                
                                <div class="form-group">
                                    <label for="telefone" class=" text-content">Telefone</label>
                                    <input type="text" id="telefone" name="telefone" class="form-control" maxlength="14" value="<?= $_SESSION['telefone_cli']?>">
                                    <span id="telefone-error" style="color: red; display: none; font-size: 0.9em;" class=" text-content">O número de telefone não pode ter todos os dígitos iguais.</span>
                                </div>                                
                                <div class="form-group">
                                    <label for="data-nascimento" class=" text-content">Data de Nascimento</label>
                                    <input type="date" id="data-nascimento" name="nascimento" class="form-control" value="<?= $_SESSION['nascimento_cli']?>">
                                    <span id="data-error" style="color: red; display: none; font-size: 0.9em;" class=" text-content">Não é permitido o cadastro de menores de 18 anos!</span>
                                </div>
                                
                                <div class="form-group text-left">
                                    <a href="#" class=" text-content"><button class="nometemp1" type="submit">Salvar</button></a>

                                    <a href="#mainTres" onclick="abrirMain('mainDois')" class=" text-content"><button class="nometemp2">Cancelar</button></a>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            
            <!-- AUTENTICAÇÃO -->
            <section id="mainQuatro" class="col-md-9 ml-sm-auto col-lg-10 px-md-4 main-content">
                <div class="row rowDados-perfil">
                    <div class="col-12 tituloDados-perfil">
                        <hr class="custom-hr">
                        <h1 class=" text-content">AUTENTICAÇÃO</h1>
                    </div>
                    <div class="col-12 cardAutenticacao-perfil">
                        <h1 class=" text-content">Senha</h1>
                        <p>**************</p>
                        <a href="#mainCinco" onclick="abrirMain('mainCinco')" class="text-content"><button class=" text-content">Alterar Senha</button></a>
                    </div>
                </div>
            </section>
            <!-- alterar senha -->
            <section id="mainCinco" class="col-md-9 ml-sm-auto col-lg-10 px-md-4 main-content">
                <form action="../../adm/Controller/cliController.php" method="post">
                <input type="hidden" name="alterarSenha" value="1">
                <input type="hidden" name="id_cli" value="<?= $_SESSION["id_cli"] ?>">
                
                <div class="row rowDados-perfil">
                    <div class="col-12 tituloDados-perfil">
                        <hr class="custom-hr">
                        <h1 class=" text-content">ALTERAR SENHA</h1>
                    </div>
                    <div class="col-12 cardAutenticacao2-perfil">
                        <div class="col-12">
                            <form id="formSenha" method="post">
                                <div class="form-group">
                                    <label for="password" class="text-content">Senha</label><br>
                                    <input type="password" id="password" class="text-content form-control formAutent" name="senha1" placeholder="******" maxlength="15" required><br>
                                    <label for="confirmaSenha" class="text-content">Confirmação de Senha</label><br>
                                    <input type="password" name="senha2" id="confirmaSenha" placeholder="******" class="form-control formAutent text-content" required><br>
                                    <span id="error-message" class="text-danger text-content" style="display: none;">As senhas não coincidem. Por favor, tente novamente.</span>
                                </div>
                                <div class="form-group">
                                    <p class=" text-content">Sua senha deve ter pelo menos:</p>
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
                                <div class="form-group text-left">
                                    <button type="submit" class="nometemp1 text-content">Salvar</button>
                                    <a href="#mainTres" onclick="abrirMain('mainDois')" class="text-content"><button class="text-content nometemp2">Cancelar</button></a>
                                </div>
                            </form>
                        </div>
                    </div>                    
                </div>
                </form>
            </section>
            
           





            <!-- AGENDAMENTOS -->
            <section id="mainSeis" class="col-md-9 ml-sm-auto col-lg-10 px-md-4 main-content">
                <div class="row rowDados-perfil">
                    <div class="col-12 tituloDados-perfil">
                        <hr class="custom-hr">
                        <h1 class="text-content">AGENDAMENTOS</h1>
                    </div>
                    <div class="col-12 cardAgendamentos-perfil">
                        <div class="col-12">
                            <a href="javascript:void(0);" class="a-analise text-content" onclick="abrirDiv1('analise')">Em análise</a>
                            <a href="javascript:void(0);" class="a-analise text-content" onclick="abrirDiv1('finalizados')">Finalizados</a>
                        </div>
                        
                        <div class="col-12 colTitulos">
                            <div class="row rowTitulos-agendamentos colTitulos align-items-center">
                                <div class="col-xl-1 col-lg-3 col-md-4 col-sm-6">
                                </div>
                                <div class="col-xl-1 col-lg-3 col-md-4 col-sm-6">
                                    <p class="text-content" style="color: var(----cor-principal); font-weight: 400;">Serviço</p>
                                </div>
                                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
                                    <p class="text-content" style="color: var(----cor-principal); font-weight: 400;">Data</p>
                                </div>
                                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
                                    <p class="text-content" style="color: var(----cor-principal); font-weight: 400;">Horário</p>
                                </div>
                                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
                                    <p class="text-content" style="color: var(----cor-principal); font-weight: 400;">Valor</p>
                                </div>
                                <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6">
                                    <p class="text-content" style="color: var(----cor-principal); font-weight: 400;">Status</p>
                                </div>
                                <div class="col-xl-1 col-lg-3 col-md-4 col-sm-6">
                                </div>                                                            
                            </div>
                            <hr>
                        </div>


                        <!-- ---------------------------PARTE DOS PEDIDOS EM ANÁLISE ------------------------------- -->
                        <!-- essa repete desde essa parte aqui (id analise.....) -->
                        
                        <div class="row" id="analise" >
                            <?php
                            if (isset($dadosA["numL"]) && $dadosA["numL"] > 0 ) {
                                for($i = 1; $i <= $dadosA["numL"]; $i++){
                                
                                $totalA = $dadosA["preco"][$i] * $dadosA["quantHoras"][$i] * $dadosA["quantInt"][$i];
                                
                                $totalAP = $totalA + ($totalA * 0.15);


                                $endereco = urlencode($dadosA["rua"][$i] . ", " . $dadosA["numero"][$i] . " - " . $dadosA["bairro"][$i] . ", " . $dadosA["cidadeL"][$i] . " - " .$dadosA["estado"][$i] . ", " . $dadosA["cep"][$i]);

                                $linkMaps = "https://www.google.com/maps/search/?api=1&query=" . $endereco;
                            ?>
                            <div class="col-12">
                                <div class="row rowTitulos-agendamentos align-items-center">
                                    <div class="col-xl-1 col-lg-3 col-md-4 col-sm-6">
                                        <img src="../../assets - amanda3/logotipos/LOGOTIPO-mao.png" alt="Logo enlace">
                                    </div>
                                    <div class="col-xl-1 col-lg-3 col-md-4 col-sm-6">
                                        <p class="text-content"><?= $dadosA["nomeSer"][$i];  ?></p>
                                    </div>
                                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
                                        <p class="text-content"><?= date("d/m/Y", strtotime($dadosA["data"][$i])) ;  ?></p>
                                    </div>
                                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
                                        <p class="text-content"><?= substr($dadosA["horaComeca"][$i], 0, 5)?></p>
                                    </div>
                                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
                                        <p class="text-content">R$<?= $dadosA["preco"][$i];  ?></p>
                                    </div>
                                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6">
                                        <p class="text-content">Em andamento</p>
                                    </div>
                                    <div class="col-xl-1 col-lg-3 col-md-4 col-sm-6">
                                        &nbsp;
                                        <a href="javascript:void(0); #seta" id="toggleButton">
                                            <i class="bi bi-arrow-down" id="arrowIcon" onclick="abrirDiv2('')"></i>
                                        </a>
                                    </div>
                                    <div class="col-12"><hr></div>                                                            
                                </div>
                            </div>
                            <div class="col-12" id="seta">
                                <div class="row rowInfosAdicionais-agendamentos">
                                    <div class="col-md-8 col-12 colEndereco">
                                        <h1 class="text-content">ENDEREÇO - SERVIÇO</h1><br>
                                        <h2 class="text-content">CEP</h2>
                                        <span class="text-content"><?= $dadosA["cep"][$i];  ?></span><br><br>
                                        <h2 class="text-content">Endereço</h2>
                                        <span class="text-content"><?= $dadosA["rua"][$i] .", " .  $dadosA["numero"][$i];  ?></span><br><br>
                                        <h2 class="text-content">Cidade</h2>
                                        <span class="text-content"><?= $dadosA["cidadeA"][$i]?></span><br>
                                        <span class="text-content"> <a href="<?= $linkMaps ?>" target="_blank"> Mapa </a> </span><br><br>
                                        <button onclick="baixarNotaFiscal('<?= $dadosA['codVerify'][$i] ?>')"> Baixar Nota Fiscal em PDF </button>
                                    </div>
                                    <div class="col-md-4 col-12 colCompra">
                                        <h1 class="text-content">MINHA COMPRA</h1>
                                        <div class="row">
                                            <div class="col-6">
                                                <p class="info-label text-content">Preço Hora</p>
                                                <p class="info-label text-content">Duração</p>
                                                <p class="info-label text-content">Intérpretes</p>
                                                <p class="info-label text-content">Subtotal</p>
                                                <p class="info-label text-content taxa">Taxa de Serviço</p>
                                                <p class="info-label text-content total">Total</p>
                                            </div>
                                            <div class="col-6 text-right">
                                                <p class="text-content info-value">R$ <span><?= $dadosA["preco"][$i];  ?></span></p>
                                                <p class="text-content info-value"><span><?= $dadosA["quantHoras"][$i];  ?></span> hora(s)</p>
                                                <p class="text-content info-value"><span><?= $dadosA["quantInt"][$i];  ?></span></p>
                                                <p class="text-content info-value">R$ <span><?= $totalA;  ?></span></p>
                                                <p class="text-content info-value taxa"><span>15</span>% do total</p>
                                                <p class="text-content info-value total">R$ <span><?= $totalAP ?></span></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12"><hr></div>
                                <br>
                                <div class="col-12 colBotoes">
                                   
                                </div>   
                            </div><br><br><br><br>
                            <?php
                                }
                            } else {
                                echo "<div class='col-12'><p class='text-content'>Nenhum agendamento em andamento encontrado.</p></div>";
                            }
                            
                            ?>
                        </div><br><br>
                        <!-- até essa parte aqui TEM QUE INCLUIR OS DOIS <br> !!!!! -->

     
                        <!-- FINALIZADOS -->
                        
                        <div class="row" id="finalizados">
                            <?php
                            if (isset($dadosC["numL"]) && $dadosC["numL"] > 0) {
                                for($i = 1; $i <= $dadosC["numL"]; $i++){   
                                
                                $totalC = $dadosC["preco"][$i] * $dadosC["quantHoras"][$i] * $dadosC["quantInt"][$i];
                                
                                $totalCP = $totalC + ($totalC * 0.15);
                            
                            ?>
                            <div class="col-12">
                                <div class="row rowTitulos-agendamentos align-items-center">
                                    <div class="col-xl-1 col-lg-3 col-md-4 col-sm-6">
                                        <img src="../../assets - amanda3/logotipos/LOGOTIPO-mao.png" alt="Logo enlace">
                                    </div>
                                    <div class="col-xl-1 col-lg-3 col-md-4 col-sm-6">
                                        <p class="text-content"><?= $dadosC["nomeSer"][$i];  ?></p>
                                    </div>
                                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
                                        <p class="text-content"><?= date("d/m/Y", strtotime($dadosC["data"][$i])) ;  ?></p>
                                    </div>
                                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
                                        <p class="text-content"><?= substr($dadosC["horaComeca"][$i], 0, 5)?></p>
                                    </div>
                                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
                                        <p class="text-content">R$<?= $dadosC["preco"][$i];  ?></p>
                                    </div>
                                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6">
                                        <p class="text-content">Finalizado</p>
                                    </div>
                                    <div class="col-xl-1 col-lg-3 col-md-4 col-sm-6">
                                        &nbsp;
                                        <a href="javascript:void(0); #seta" id="toggleButton">
                                            <i class="bi bi-arrow-down" id="arrowIcon" onclick="abrirDiv2('')"></i>
                                        </a>
                                    </div>
                                    <div class="col-12"><hr></div>                                                            
                                </div>
                            </div>
                            <div class="col-12" id="seta">
                                <div class="row rowInfosAdicionais-agendamentos">
                                    <div class="col-md-8 col-12 colEndereco">
                                        <h1 class="text-content">ENDEREÇO - SERVIÇO</h1><br>
                                        <h2 class="text-content">CEP</h2>
                                        <span class="text-content"><?= $dadosC["cep"][$i];  ?></span><br><br>
                                        <h2 class="text-content">Endereço</h2>
                                        <span class="text-content"><?= $dadosC["rua"][$i] .", " .  $dadosC["numero"][$i]  ?></span><br><br>
                                        <h2 class="text-content">Cidade</h2>
                                        <span class="text-content">São Paulo - SP</span><br><br>
                                    </div>
                                    <div class="col-md-4 col-12 colCompra">
                                        <h1 class="text-content">MINHA COMPRA</h1>
                                        <div class="row">
                                            <div class="col-6">
                                                <p class="info-label text-content">Preço Hora</p>
                                                <p class="info-label text-content">Duração</p>
                                                <p class="info-label text-content">Intérpretes</p>
                                                <p class="info-label text-content">Subtotal</p>
                                                <p class="info-label text-content taxa">Taxa de Serviço</p>
                                                <p class="info-label text-content total">Total</p>
                                            </div>
                                            <div class="col-6 text-right">
                                                <p class="text-content info-value">R$ <span><?= $dadosC["preco"][$i];  ?></span></p>
                                                <p class="text-content info-value"><span><?= $dadosC["quantHoras"][$i];  ?></span> hora(s)</p>
                                                <p class="text-content info-value"><span><?= $dadosC["quantInt"][$i];  ?></span></p>
                                                <p class="text-content info-value">R$ <span><?= $totalC;  ?></span></p>
                                                <p class="text-content info-value taxa"><span>15</span>% do total</p>
                                                <p class="text-content info-value total">R$ <span><?= $totalCP ?></span></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12"><hr></div>
                                <br>
                                <div class="col-12 colBotoes">
                                    
                                </div>   
                            </div><br><br>
                            <?php
                                }
                            } else {
                                echo "<div class='col-12'><p class='text-content'> Nenhum agendamento finalizado encontrado .</p></div>";
                            }
                            
                            ?>
                        </div><br><br>
                </div>
            </section>
        </div>
    </div>


    <!-- Main content -->
    <div class="container-fluid">
        <div class="row">
            <main class="col-md-9 ml-sm-auto col-lg-10 px-md-4 main-content">

            </main>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="../../assets - amanda2/js/script-paginas.js"></script>
    <script>
        // Recebendo os dados do PHP (os valores da array $compra)

        // Função que gera o PDF
        function baixarNotaFiscal(codVerify) {
            // Fazer uma requisição AJAX para buscar os dados da nota fiscal
            fetch('getNotaFiscal.php?codVerify=' + codVerify)
            .then(response => response.json())
            .then(compra => {
                console.log(compra); // Adicione esse log para verificar os dados

                // Criando o PDF
                const { jsPDF } = window.jspdf;
                const doc = new jsPDF();

                let dataOriginal = compra.data; 
                let partesData = dataOriginal.split('-'); 
                let dataFormatada = partesData[2] + '/' + partesData[1] + '/' + partesData[0];

                let horaFormatada = compra.horaComeca.substring(0, 5);

                var precoTotal = compra.preco * compra.quantHoras * compra.quantInt;
                var precoComDesconto = precoTotal + (precoTotal * 0.15); // 15% de taxa de serviço

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
            });
            
        }

    </script>

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
  
    <scrip src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></scrip>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
  </html>
  
  <?php
  
     if (isset($_REQUEST["msg"]) && $_REQUEST["msg"] != 0) {
      require_once "../../adm/Model/msg.php";
      $cod = $_REQUEST["msg"];
      $msgExibir = $MSG[$cod];
      echo "<script>
      var textomodal = document.getElementById('textomodal')
      textomodal.innerHTML = '".$MSG[$cod]."'
      $('#textomodalcelsomito').modal('show');
  
      </script>";
  }
  
  ?>