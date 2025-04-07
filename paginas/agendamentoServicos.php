<?php
session_start();

include "../Adm/Model/manager.class.php";
$manager = new Manager();

$id = $_GET["id"];

if(!isset($id) || empty($id)){
    header("Location: servicos.php");
    exit();
}

$dados = $manager->servicoPuxar($id);
$precoTotal = $dados["preco"] + ($dados["preco"] * 0.10);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cidade'])) {
    $cidade = $_POST['cidade'];
    if (!empty($cidade)) {
        $interpretes = $manager->puxarIntByCidade($cidade, $id);
        echo json_encode($interpretes);
    } else {
        echo json_encode([]);
    }
    exit; 
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <link rel="stylesheet" href="../assets - amanda2/style/styleAgendamento.css">
    <title>Serviços</title>
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
                <i id="toggleTheme" class="bi bi-sun"></i>
            </div>
        </nav>
        <div class="divBotoes">
                <button class="text-content" onclick="lerTexto()">Ouvir Texto</button> &nbsp; |
                <button class="text-content" onclick="pararTexto()">Parar Leitura</button>
            </div>
            <style>
                 .divBotoes {
                    background-color: none;
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
                    border: none;
                    color: #2e6b73;
                    background-color: none;
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
    <div class="container-fluid">
        <div class="row rowBanner-servico">
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 colTexto-banner">
                <h2 class="text-content">Entenda sobre o serviço</h2>
                <h1 class="text-content"><?= $dados["nome"] ?></h1>
                <p class="text-content"><?= $dados["sobre"] ?></p>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 colPreco-banner">
                <div class="preco">
                    <i class="bi bi-cash-coin text-content"></i>
                    <span class="text-content">R$<?= $dados["preco"] ?></span>
                </div>
                <br><br>
                <a href="duvidas.php">Como funciona <i class="bi bi-arrow-right"></i></a>
                <br><br><br>
            </div>
        </div>
    </div>

    
    <form action="../Adm/Controller/ageController.php" method="post">
        <h1>Agendamento</h1>
        <input type="hidden" name="agendamento" value="1">
        <?= (isset($_SESSION["id_cli"]) ? "<input type='hidden' name='id_cli' value='" . $_SESSION["id_cli"] . "'>" : "") ?>
        <input type="hidden" name="idSer" value="<?= $id ?>">
        <input type="hidden" name="preco" value="<?= $dados["preco"] ?>">
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 colData-agendamentoTotal">
                <div class="colData-agendamento" class="text-content">
                    <input type="date" name="data" id="data" placeholder="Selecione uma data" class="text-content" required>
                </div>
                <br><br><br>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 colSelects-agendamento">
                <label for="quantInt"> A quantidade de Interpretes </label><br>
                <select name="quantInt" id="quantInt" required>
                    <option value="" disabled selected> -- Selecione -- </option>
                    <option value="1"> 1 </option>
                    <option value="2"> 2 </option>
                    <option value="3"> 3 </option>
                    <option value="4"> 4 </option>
                    <option value="5"> 5 </option>
                </select>
                <br><br>

                <label for="horaComeca"> Que horas o(s) interpretes devem chegar? </label><br>
                <input type="time" name="horaComeca" id="horaComeca" required><br><br>

                <label for="horaSer"> Quanto tempo de evento? </label><br>
                <select name="horaSer" id="horaSer" required>
                    <option value="" disabled selected> -- Selecione o tempo de evento -- </option>
                    <option value="1"> 1 Hora </option>
                    <option value="2"> 2 Horas </option>
                    <option value="3"> 3 Horas </option>
                    <option value="4"> 4 Horas </option>
                    <option value="5+"> +5 Horas </option>
                </select><br><br>
                

                <label for="cidade">Selecione uma cidade:</label><br>
                <select id="cidade" name="cidade" disabled required>
                    <option value="" disabled selected>-- Selecione uma cidade valida --</option>
                    <option value="São Paulo"> São Paulo </option>
                    <option value="Guarulhos"> Guarulhos </option>
                    <option value="Campinas"> Campinas </option>
                    <option value="São Bernardo do Campo"> São Bernardo do Campo </option>
                    <option value="Santo André"> Santo André </option>
                </select><br><br>


                <div id="interpretesContainer">
                    <label for="interprete">Selecione um intérprete:</label><br>
                    <select id="interprete" name="interprete" disabled required>
                        <option value="" disabled selected>-- Selecione uma cidade primeiro --</option> 
                    </select><br><br>
                </div>   
                <br>

                <input type="submit" value="Agendar" class="text-content agendarButton">
            </div>
            
            
            <br><br><br>
        </div>
    </form>

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
  
  

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
  </html>
    <script>
     $(document).ready(function() {
        const interpretesSelecionados = []; 

        $('#quantInt').change(function() {
            const quantidade = $(this).val();
            const cidadeSelect = $('#cidade');
            const container = $('#interpretesContainer');

            if (quantidade) {
                cidadeSelect.prop('disabled', false);
                container.empty(); 
                interpretesSelecionados.length = 0; 

                for (let i = 1; i <= quantidade; i++) {
                    container.append(`
                        <label for="interprete${i}">Selecione o ${i}° intérprete:</label>
                        <select class="interprete" id="interprete${i}" name="interprete[]" data-index="${i}" disabled selected required>
                            <option value="">-- Selecione uma cidade primeiro --</option>
                        </select>
                        <br><br>
                        <a href="" class="conheca-link" id="conhecaLink${i}" style="display:none; color: #2e6b73; " target="_blank">Conheça o intérprete <i class="bi bi-arrow-right"></i> </a>
                        <br><br>
                    `);
                }
            } else {
                cidadeSelect.prop('disabled', true).val('');
                container.empty(); 
            }
        });

        $('#cidade').change(function() {
            const cidade = $(this).val();
            if (cidade) {
                $('.interprete').prop('disabled', false);
                updateInterpreteOptions(cidade);
            } else {
                interpretesSelecionados.length = 0;
                $('.interprete').empty().append('<option value="">-- Selecione uma cidade primeiro --</option>').prop('disabled', true);
            }
        });

        $(document).on('change', '.interprete', function() {
            const index = $(this).data('index') - 1;
            const previousValue = interpretesSelecionados[index];
            const selectedValue = $(this).val();
            const selectedText = $(this).find('option:selected').text(); // Pegando o nome do intérprete


            // Remove o valor anterior da lista de selecionados
            if (previousValue) {
                interpretesSelecionados.splice(interpretesSelecionados.indexOf(previousValue), 1);
            }

            // Adiciona o valor atual à lista de selecionados
            if (selectedValue) {
                const nomeInterprete = $(this).find('option:selected').text(); // Pega o nome do intérprete

                interpretesSelecionados[index] = selectedValue;
                $(`#conhecaLink${index + 1}`).attr('href', `detalhesInterprete.php?interprete=${nomeInterprete}`).show();
            } else {
                $(`#conhecaLink${index + 1}`).hide();
            }

            updateInterpreteOptions($('#cidade').val());
        });

        // Atualiza as opções de intérpretes disponíveis em cada <select>
        function updateInterpreteOptions(cidade) {
            $('.interprete').each(function() {
                const select = $(this);
                const currentValue = select.val();

                $.ajax({
                    url: '', // Defina a URL correta para buscar intérpretes
                    method: 'POST',
                    data: { cidade },
                    dataType: 'json',
                    success: function(data) {
                        select.empty();
                        select.append('<option value="">-- Selecione --</option>');

                        data.forEach(function(interprete) {
                            // Exclui os intérpretes já selecionados nos outros selects
                            if (!interpretesSelecionados.includes(interprete.id) || interprete.id === currentValue) {
                                select.append(`<option value="${interprete.id}">${interprete.nome}</option>`);
                            }
                        });

                        // Mantém o valor atual selecionado
                        select.val(currentValue);
                    },
                    error: function() {
                        alert('Erro ao buscar intérpretes.');
                    }
                });
            });
        }
        // Calcula a data atual
        const hoje = new Date();
        const ano = hoje.getFullYear();
        const mes = String(hoje.getMonth() + 1).padStart(2, '0'); 
        const dia = String(hoje.getDate()).padStart(2, '0');
        const dataAtual = `${ano}-${mes}-${dia}`; 

        // Define o mínimo no input
        $('#data').attr('min', dataAtual);

        // Configura o Flatpickr para bloquear datas anteriores
        flatpickr("#data", {
            inline: true, 
            dateFormat: "Y-m-d", 
            minDate: new Date() // Define o mínimo como a data atual
        });
    });

    
    </script>
    <script src="../assets - amanda2/js/script-paginas.js"></script>
</body>
</html>

  
<?php
  
  if (isset($_REQUEST["msg"])) {
   require_once "Model/msg.php";
   $cod = $_REQUEST["msg"];
   $msgExibir = $MSG[$cod];
   echo "<script>
   var textomodal = document.getElementById('textomodal')
   textomodal.innerHTML = '".$MSG[$cod]."'
   $('#textomodalcelsomito').modal('show');

   </script>";
}

?>