<?php
    session_start();
    include_once("../Model/Conexao.php");
    $id = filter_input(INPUT_GET, 'id');
    include_once("../controller/ProdutoController.php");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Excluir Cadastro</title>
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
            <li ><a href="Cadastro.php"><i class="fas fa-book"></i> Cadastrar Produtos</a></li>
			<li ><a href="Listagem.php"><i class="fas fa-list"></i> Listagem</a></li>
            <li ><a href="CadSetores.php"><i class="fas fa-store"></i> Cadastrar Setores</a></li>
		</ul>
	</div>

    <div class="container">
        <h1><b>Exclui Cadastro</b></h1>
        <?php
        if(isset($_SESSION['msg'])){
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
        ?>
        <br><br>
        <h2>Deseja Realmente Excluir?</h2>
        <form action="ExcluiCad.php" method="POST">
            <input type="hidden" name="id" id="id" value="<?php $id; ?>">
            <?php
                $obj = new ProdutoController();   
                $obj->exclui($id);
            ?>
            <button class="btExclui" type="submit"><i class='fas fa-trash-alt'></i> Excluir Cadastro</button>
        </form>
    </div>
    <br>
    <div class="container">
        <a href="Listagem.php"><button type="button" class="btn btn-info"><i class="fas fa-times"></i> Cancelar</button></a>
    </div>
    <?php
        include("../include/SessaoValidate.php");
    ?>
</body>
</html>