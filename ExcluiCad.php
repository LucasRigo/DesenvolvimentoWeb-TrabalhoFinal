<?php
    session_start();
    include_once("Conexao.php");
    $id = filter_input(INPUT_GET, 'id');
    $result_produto = "SELECT * FROM produtos WHERE id = '$id'";
    $resultado_produto = mysqli_query($conecta, $result_produto);
    $row_produto = mysqli_fetch_assoc($resultado_produto);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Editar Cadastro</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/c2732b0761.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="Estilos.css">
</head>
<body>

    <div id="menu">
		<ul>
            <li class="direita"><a href="Cadastro.php"><i class="fas fa-book"></i> Cadastrar</a></li>
			<li class="esquerda"><a href="Listagem.php"><i class="fas fa-list"></i> Listagem</a></li>
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
        <form action="ProcExcluiCadastro.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $row_produto['id']; ?>">

            <input id="exclui" name="exclui" type="submit" value="Excluir">
        </form>
    </div>
    <br>
    <div class="container">
        <a href="Listagem.php"><button type="button" class="btn btn-info"><i class="fas fa-times"></i>Cancelar</button></a>
    </div>
</body>
</html>