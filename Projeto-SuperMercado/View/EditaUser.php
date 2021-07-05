<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Editar User</title>
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
    <h1><b>Editar sua Senha:</b></h1>


    <form id="formAlterar" name="formAlterar" method="post" action="EditaUser.php">
        <!-- Enviando o código de forma oculta, para ações futuras no BD -->
        <input type="hidden" name="id" id="id" value="<?php echo $_SESSION['nome_usuario'];?>">

        <p>
        <label>Nova Senha:
        <input type="password" name="senha" id="senha" value="" required>
        </label>
        </p>
        
        <p>
        <label>
        <button class="btConfirma" type="submit" name="button" id="button" value="Alterar"><i class="far fa-save"></i> Salvar</button>
        </label>
        </p>
    </form>
    <?php
        /* fechando o bloco da função... */
    
    include("../include/SessaoValidate.php");  // Faz a autenticação
    include_once("../controller/UserController.php");
    $obj = new UserController();   
    $obj->controlaAlteracao();
    ?>
    </div>
    
</body>
</html>