<?php
session_start();

if(!isset($_SESSION["id_adm"]) || $_SESSION["id_adm"] == ""){
    session_abort();
    ?>
        <form action="../index.php" name="return" id="return" method="post">
            <input type="hidden" name="cod" value="OA02">
        </form>
        <script>
            document.getElementById("return").submit();
        </script>
    <?php
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../css/style2.css">
	<title>Enlace Adm</title>
    

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
	<box-icon name='image-alt'></box-icon>
	<!-- SIDEBAR -->
	<section id="sidebar">
		<a href="../../index.php" class="brand">
			<i class='bx bxs-acessibility'></i>
			<span class="text">Enlace</span>
		</a>
		<ul class="side-menu top">
			<li class="active">
				<a href="inicio.php" target="iframe-adm">
					<i class='bx bxs-dashboard' ></i>
					<span class="text">Inicio</span>
				</a>
			</li>

			<li>
				<a href="dados.php" target="iframe-adm">
					<i class='bx bxs-user' ></i>
					<span class="text">Meu Dados</span>
				</a>
			</li>

			<?php // 3 - gestor_chamados
				if($_SESSION["poder_adm"] == 3 || $_SESSION["poder_adm"] == 5){
			?>

			<li>
				<a href="chamadosList.php" target="iframe-adm">
					<i class='bx bxs-user' ></i>
					<span class="text">Chamados</span>
				</a>
			</li>

			<li>
				<a href="contatoList.php" target="iframe-adm">
					<i class='bx bxs-user' ></i>
					<span class="text">Comentarios/avaliações do site</span>
				</a>
			</li>

			<?php
				}	
			?>
			
			<?php // 1 - ADM
				if($_SESSION["poder_adm"] == 1 || $_SESSION["poder_adm"] == 5){
			?>

			<li><a href="admList.php" target="iframe-adm">
					<i class='bx x bxs-group' ></i>
					<span class="text">Administradores</span>
				</a>
			</li>

	
			<li><a href="cliList.php" target="iframe-adm">
					<i class='bx x bxs-group' ></i>
					<span class="text">Clientes</span>
				</a>
			</li>

			<li><a href="IntList.php" target="iframe-adm">
					<i class='bx x bxs-group' ></i>
					<span class="text">Interpretes</span>
				</a>
			</li>

			<?php
				} 
			?>
			

			
			<?php //3 - gestor + 1 - adm
				if($_SESSION["poder_adm"] == 3 || $_SESSION["poder_adm"] == 5 || $_SESSION["poder_adm"] == 1){
			?>

			<li>
				<a href="servicoList.php" target="iframe-adm">
					<i class='bx bxs-doughnut-chart' ></i>
					<span class="text">Serviços</span>
				</a>
			</li>

			<li>
				<a href="agendamentoList.php" target="iframe-adm">
					<i class='bx bxs-doughnut-chart' ></i>
					<span class="text">Agendamento</span>
				</a>
			</li>

			<li>
				<a href="avaliacaoList.php" target="iframe-adm">
					<i class='bx bxs-doughnut-chart' ></i>
					<span class="text"> Avaliação dos serviços </span>
				</a>
			</li>
				
			<?php
				}
			?>
			<?php // 2 - RH
				if($_SESSION["poder_adm"] == 2 || $_SESSION["poder_adm"] == 5){
			?>

			<li>
				<a href="intConfirmacao.php" target="iframe-adm">
					<i class='bx bxs-message-dots' ></i>
					<span class="text"> Confir. do intérprete </span>
				</a>
			</li>

			<li>
				<a href="intConfirmacaoDP.php" target="iframe-adm">
					<i class='bx bxs-message-dots' ></i>
					<span class="text"> Confir. dos dados pessoais </span>
				</a>
			</li>

			<li>
				<a href="intConfirmacaoP.php" target="iframe-adm">
					<i class='bx bxs-message-dots' ></i>
					<span class="text"> Confir. do perfil </span>
				</a>
			</li>

			<?php
				} 
			?>
			
			<?php // 4 - designer
				if($_SESSION["poder_adm"] == 4 || $_SESSION["poder_adm"] == 5){
			?>
			<li>
				<a href="carrosselList.php" target="iframe-adm">
				<i class='bx bxs-image'></i>
					<span class="text"> Imagens do carrosel </span>
				</a>
			</li>
			<?php
				}
			?>
			
		</ul>
		<ul class="side-menu">
			<li>
				<a href="#" class="logout" style="margin-top: 400px;" onclick="logout()">
					<i class='bx bxs-log-out-circle' ></i>
					<span class="text" >Sair</span>
				</a>
			</li>
		</ul>
	</section>
	



	<!-- inicio do conteúdo -->
	<section id="content">
		<!-- NAVBAR -->
		<nav>
			<i class='bx bx-menu' ></i>
			<form action="#">
				<div class="form-input">
					<!-- <input type="search" placeholder="Search..."> -->
					<!-- <button type="submit" class="search-btn"><i class='bx bx-search'></i></button> -->
				</div>
			</form>
			<!-- <input type="checkbox" id="switch-mode" hidden>
			<label for="switch-mode" class="switch-mode"></label> -->
			
			<a href="#" class="profile">
				<img src="../../Assets/img/user 2.png">
			</a>
		</nav>
		<!-- FIM DA NAVBAR -->

		<!-- MAIN -->

		<iframe id="iframe-adm" name="iframe-adm" src="inicio.php" width="100%"  style=" position:relative; width: calc(100% - 15%); left: 10%;border:none; height:96vh; "></iframe>
				
		<!-- MAIN -->
	</section>
	

	<script src="../../Assets/js/script.js"></script>
</body>
</html>