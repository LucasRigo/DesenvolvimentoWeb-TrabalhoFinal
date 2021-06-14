<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Cadastro Setores</title>
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
            <li ><a href="Cadastro.php"><i class="fas fa-book"></i> Cadastrar Produtos</a></li>
			<li ><a href="Listagem.php"><i class="fas fa-list"></i> Listagem</a></li>
            <li ><a href="CadSetores.php"><i class="fas fa-store"></i> Cadastrar Setores</a></li>
		</ul>
	</div>

    <div class="container">
        <br>
        <h1><b>Cadastro de Setores</b></h1>
        <h3>Preencha os dados do setor que deseja cadastrar</h3>
        <?php
        if(isset($_SESSION['msg'])){
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }

        ?>
        <form action="ProcessaCadSetores.php" method="POST">

            <div class="form-group">
                <label><b>Nome do Setor:</b></label>
                <input class="form-control" name="SetorNome" type="text" placeholder="Insira o nome do setor" required><br>
         </div>

            <input id="cadastra" name="cadastra" type="submit" value="CADASTRAR">
        </form>
    </div>
</body>
</html>