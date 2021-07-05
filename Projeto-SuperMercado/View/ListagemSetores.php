<?php
    session_start();
    include_once("../Model/Conexao.php");
?>

<html lang="pt-br">
    <head>
        <title>Listagem Setores</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script src="https://kit.fontawesome.com/c2732b0761.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="../Include/Estilos.css">

    </head>
    <body>

        <div id="menu">
		    <ul>
                <li ><a href="inicio.php"><i class="fas fa-store"></i> Tela Inicial</a></li>
                <li ><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Sair</a></li>
		    </ul>
	    </div>

        <div class="container">
        <h1><b>Listagem de Setores</b></h1>
        <br>
        <?php
        if(isset($_SESSION['msg'])){
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
        ?>
        <br>


        <table class='table table-dark table-striped table-sm'>
            <tr>
                <th style="text-align: center;">ID</th>
                <th style="text-align: center;">Setor</th>
            </tr>

        


        <?php
        include("../include/SessaoValidate.php");
        include_once("../Controller/SetorController.php");
        $obj = new SetorController();
        $obj->consultaSetores(1);
        ?>

        </table>

        </div>
        
    </body>
</html>