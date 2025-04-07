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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title> Area - ADM </title>
    <script>
        function logout(){
            var resp = confirm("Deseja realmente fazer logout?");
            if (resp == true){
                window.location.assign("logout.php");
            }
        }
    </script>
    <style>
        .container-fluid{
            position: fixed;
        }
        
        .col-2{
            height: 100vh;
            width: 100%;
            background-color: #335e92;
        }

        li{
            list-style-type: none;
            padding: 5% 3%;
            color: white;
        }

        .rowUm{
            height: 35%;
            justify-content: center;
            align-items: center;
            display: flex;
            text-align: center;
            color: #fff;
            font-size: 30px;
        }

        .rowDois{
            margin-top: 30%;
            height: 75%;
        }

        .rowUm img{
            width: 50%;
            height: 50%;
            border-radius: 100px;
        }

        .hr{
            color: #fff;
        }

        .rowDois a{
            text-decoration: none;
            color: #fff;
        }

        .rowDois a:hover{
            text-decoration: none;
            color: #fff;
        }

        .col-9{
            padding: 5% 5%;
        }

        .titulo{
            font-size: 30px;
            color: #457ec2;
        }

        p{
            font-size: 20x;
        }

        .col-1{
            padding: 5% 6% 0% 0%;
        }

        button{
            padding: 20% 100%;
            background-color: #457ec2;
            color: #fff;
            border: none;
            border-radius: 15px;
        }

        .dados{
            font-size: 18px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
            <div class="col-9">
                <p>
                    <span class="dados">Nome:</span><br>
                    <?= $_SESSION["nome_adm"]?><br><br>
                    <span class="dados">Email:</span><br>
                    <?= $_SESSION["email_adm"]?>
                </p>
            </div>
        </div>
    </div>
</body>
</html>