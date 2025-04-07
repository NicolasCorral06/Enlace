<?php
session_start();

if(!isset($_SESSION["id_cli"]) || $_SESSION["id_cli"] == ""){
    $id_cli = 0;
}else{
    $id_cli = $_SESSION["id_cli"];
}

$nome_servico = $_GET['nome_servico'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Avaliação com Estrelas</title>
    <style>
        .estrela {
            font-size: 30px;
            color: gray;
            cursor: pointer;
        }
        .estrela.selecionada {
            color: gold;
        }
    </style>
</head>
<body>
    <form action="../adm/Controller/ageController.php" method="post">
        <input type="hidden" name="avaliacao" value="1">
        <input type="hidden" name="id_cli" value="<?= $id_cli ?>">
        <input type="hidden" name="nome_servico" value="<?= $nome_servico ?>">

        <label for="estrelas">Quantas estrelas você deseja dar?</label><br>

        <span class="estrela" data-value="1">&#9733;</span>
        <span class="estrela" data-value="2">&#9733;</span>
        <span class="estrela" data-value="3">&#9733;</span>
        <span class="estrela" data-value="4">&#9733;</span>
        <span class="estrela" data-value="5">&#9733;</span>

        <input type="hidden" name="estrelas" id="estrelas" value="0">

        <br><br>
        <label for="comentario">Escreva um comentário descrevendo a sua experiência</label><br>
        <textarea name="comentario" cols="50" rows="10" id="comentario"></textarea><br><br>

        <input type="submit" value="Enviar">
    </form>

    aqui em baixo vai ficar os outros comentarios. vai ter como filtrar(ou n)




    
    <script>
        const estrelas = document.querySelectorAll('.estrela');
        const inputEstrelas = document.getElementById('estrelas');

        estrelas.forEach((estrela, index) => {
            estrela.addEventListener('click', () => {
                // Define o valor da estrela clicada no input oculto
                inputEstrelas.value = index + 1;

                // Atualiza a aparência das estrelas
                estrelas.forEach((e, i) => {
                    if (i <= index) {
                        e.classList.add('selecionada');
                    } else {
                        e.classList.remove('selecionada');
                    }
                });
            });
        });
    </script>
</body>
</html>
