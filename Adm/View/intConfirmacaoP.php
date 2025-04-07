<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin List</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/gh/eliyantosarage/font-awesome-pro@main/fontawesome-pro-6.5.1-web/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #ddd;
        }
        th {
            background-color: #335e92;
            color: white;
        }
        input[type="submit"]{
            background-color: #335e92;
            color: white;
            border: none;
            padding: 10px 20px;
            text-decoration: none;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 4px;
        }
        button {
            background-color: transparent;
            color: #ba6d67;
            border: none;
            cursor: pointer;
        }
        .fa-trash {
            font-size: 20px;
        }
    </style>
</head>
<body>    
    <?php
        require "../Model/manager.class.php";
        $manager = new Manager();
        $dados = $manager->intP_TEMPListar();
        
        if(isset($dados["num"]) && $dados["num"] > 0){
    ?>
    <table>
        <tr>
            <th>ID</th>
            <th>ID Interprete</th>
            <th>Foto Perfil</th>
            <th>Vídeo Apresentação</th>
            <th>Texto Apresentação</th>
            <th>Formação</th>
            <th>Tempo de Experiência</th>
            <th>Gênero</th>
            <th>Cor/Raça</th>
            <th>Data/Hora</th>
            <th>Status</th>
            <th></th>
            <th></th>
        </tr>
        <?php
            for($i = 1; $i <= $dados["num"]; $i++){
                echo "<tr>";
                echo "<td>" . $dados[$i]["id"] . "</td>";
                echo "<td>" . $dados[$i]["id_int"] . "</td>";
                echo "<td><img src='../../Assets/Interprete/perfil/" . $dados[$i]["foto_perfil"] . "' alt='Foto' width='100'></td>";
                echo "<td>
                    <video width='300' controls>
                        <source src='../../Assets/Interprete/perfil/" . $dados[$i]["video_apre"] . "' type='video/mp4'>
                        Seu navegador não suporta a tag de vídeo.
                    </video>
                </td>";
                echo "<td>" . $dados[$i]["texto_apre"] . "</td>";
                echo "<td>" . $dados[$i]["formacao"] . "</td>";
                echo "<td>" . $dados[$i]["tempo_exp"] . "</td>";
                echo "<td>" . $dados[$i]["genero"] . "</td>";
                echo "<td>" . $dados[$i]["corRaca"] . "</td>";
                echo "<td>" . $dados[$i]["data_hora"] . "</td>";
                echo "<td>" . ($dados[$i]["status"] == 1 ? 'Ativo' : 'Inativo') . "</td>";
                
                echo "<td>";
                ?>
                    <form name="formEdit" action="../Controller/intController.php" method="post">
                        <input type="hidden" name="id" value="<?=$dados[$i]['id'];?>">
                        <input type="hidden" name="intPAprovado" value="1">
                        <input type="submit" name="sbmt" value="Aprovado">
                    </form>
                <?php
                echo "</td>";

                echo "<td>";
                ?>
                    <form name="formEdit" action="../Controller/intController.php" method="post">
                        <input type="hidden" name="id" value="<?=$dados[$i]['id'];?>">
                        <input type="hidden" name="intPNegado" value="1">
                        <input type="submit" name="sbmt" value="Negado">
                    </form>
                <?php
                echo "</td>";
                echo "</tr>";
            }
        ?>
    </table>
    <?php
    } else {
        echo "<b>Nenhuma solicitação de um intérprete novo</b>";
    }
    ?>
</body>
</html>
