<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Editar Setor</title>
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
    <h1><b>Editar Setor</b></h1>
    <form id="formBuscar" name="formBuscar" method="post" action="EditaSetor.php">
    <label>Informe o código do setor:
        <input type="text" name="buscaCod" id="buscaCod" required>
    </label>
    <label>
        <button class="btConfirma" type="submit" name="buttonbuscar" id="buttonbuscar" value="Buscar">Buscar</button>
    </label>
    </form>


    <?php
    /* abrindo o bloco da função que mantém oculto "formAlterar"... */
    function chamaFormAlterar($id, $setor)
    {
    ?>

    <form id="formAlterar" name="formAlterar" method="post" action="EditaSetor.php">
        <!-- Enviando o código de forma oculta, para ações futuras no BD -->
        <input type="hidden" name="id" id="id" value="<?php echo $id;?>">

        <p>
        <label>Nome do setor:
        <input type="text" name="setor" id="setor" value="<?php echo $setor;?>" required>
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
    }
    include("../include/SessaoValidate.php");  // Faz a autenticação
    include_once("../controller/SetorController.php");
    $obj = new SetorController();   
    $obj->controlaAlteracao();
    ?>
    </div>
    
</body>
</html>