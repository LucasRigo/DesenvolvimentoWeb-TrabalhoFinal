<?php
    session_start();
    include_once("../Model/Conexao.php");
?>

<html lang="pt-br">
    <head>
        <title>Listagem</title>
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
                <li ><a href="CadProdutos.php"><i class="fas fa-book"></i> Cadastrar Produtos</a></li>
                <li ><a href="Listagem.php"><i class="fas fa-list"></i> Listagem</a></li>
                <li ><a href="CadSetores.php"><i class="fas fa-store"></i> Cadastrar Setores</a></li>
		    </ul>
	    </div>

        <div class="container">
        <h1>Listagem de Produtos</h1>
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
                <th>Id</th>
                <th>Nome</th>
                <th>Preço</th>
                <th>Setor</th>
                <th>Editar/Excluir</th>
            </tr>

        


        <?php
        include("../include/SessaoValidate.php");
        include_once("../Controller/ProdutoController.php");
        $obj = new ProdutoController();
        $obj->controlaConsulta(1);
        ?>

        </table>

        </div>
        
    </body>
</html>