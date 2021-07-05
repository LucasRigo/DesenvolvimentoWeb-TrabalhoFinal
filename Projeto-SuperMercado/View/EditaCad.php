<?php
    session_start();


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
    <h1><b>Edição de Cadastro de Produto</b></h1>
    <form id="formBuscar" name="formBuscar" method="post" action="EditaCad.php">
    <label>Informe o código do produto:
        <input type="text" name="buscaCod" id="buscaCod" required>
    </label>
    <label>
        <button class="btConfirma" type="submit" name="buttonbuscar" id="buttonbuscar" value="Buscar">Buscar</button>
    </label>
    </form>


    <?php
    /* abrindo o bloco da função que mantém oculto "formAlterar"... */
    function chamaFormAlterar($id, $nome, $preco, $setor)
    {
    ?>

    <form id="formAlterar" name="formAlterar" method="post" action="EditaCad.php">
        <!-- Enviando o código de forma oculta, para ações futuras no BD -->
        <input type="hidden" name="id" id="id" value="<?php echo $id;?>">
        <p>
        <label>Nome:
        <input type="text" name="nome" id="nome" value="<?php echo $nome;?>" required>
        </label>
        </p>
        <p>
        <label>Preço:
        <input type="number" name="preco" id="preco" min="0" step="0.01" value="<?php echo $preco;?>" required>
        </label>
        </p>
        <p>
        <label>Setor:
        <select name="setor" id="setor" required>
            <?php
            // Aqui as options serão resolvidas com PHP!
            // Agora, esse trecho só é acessado quando "formAlterar" está ativo
            include_once("../controller/ProdutoController.php");
            $obj = new ProdutoController();
            echo $obj->listaSetorFK($setor);
            ?>
        </select>
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
    include_once("../controller/ProdutoController.php");
    $obj = new ProdutoController();   
    $obj->controlaAlteracao();
    ?>

    </div>
    
</body>
</html>