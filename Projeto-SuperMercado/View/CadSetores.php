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
        <br>
        <h1><b>Cadastro de Setores</b></h1>
        <h3>Preencha os dados do setor que deseja cadastrar</h3>
        <?php
        if(isset($_SESSION['msg'])){
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }

        ?>
        <form action="CadSetores.php" method="POST">

            <div class="form-group">
                <label><b>Nome do Setor:</b></label>
                <input class="form-control" name="SetorNome" type="text" placeholder="Insira o nome do setor" required><br>
         </div>

            <button class="btConfirma" type="submit"><i class="far fa-save"></i> Cadastrar</button>
        </form>
    </div>

    <?php
        include("../include/SessaoValidate.php");  // Faz a autenticação
        include_once("../controller/SetorController.php");
        $obj = new SetorController();
        $obj->controlaInsercao();
    ?>

</body>
</html>