<?php
    session_start();
    include_once("../Model/Conexao.php");
    require_once("../model/Produto.php");
    include_once("../Model/ProdutoDAO.php");
    include_once("../controller/SetorController.php");
    include_once("../Controller/ProdutoController.php");
    $idcons = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

    //$result_produto = "SELECT * FROM produtos WHERE id = '$id'";
    //$resultado_produto = mysqli_query($conecta, $result_produto);
    //$row_produto = mysqli_fetch_assoc($resultado_produto);

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
			<li ><a href="Cadastro.php"><i class="fas fa-book"></i> Cadastrar Produtos</a></li>
			<li ><a href="Listagem.php"><i class="fas fa-list"></i> Listagem</a></li>
            <li ><a href="CadSetores.php"><i class="fas fa-store"></i> Cadastrar Setores</a></li>
		</ul>
	</div>

    <div class="container">
        <h1><b>Editar Cadastro</b></h1>
        <h3>Edite os dados que deseja alterar</h3>
        <?php
        if(isset($_SESSION['msg'])){
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }

        $obj = new ProdutoController();
        $obj->buscaDados($idcons);
        ?>
        
        <?php
        /* abrindo o bloco da função que mantém oculto "formAlterar"... */
        function chamaFormAlterar($codigo, $nome, $preco, $setor){

        ?>
        <form action="EditaCad.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $codigo; ?>">
            <div class="form-group">
                <label><b>Produto:</b></label>
                <input class="form-control" name="ProdNome" type="text" placeholder="Insira o nome do produto" value="<?php echo $nome; ?>" required><br>
            </div>

            <div class="form-group">
                <label><b>Preço:</b></label>
                <input class="form-control" name="ProdPreco" type="number" min="0" step="0.01" placeholder="Insira o preço do produto" value="<?php echo floatval($preco); ?>" required><br><br>
            </div>

            <?php
                $DAO = new SetorDAO();
                $lista = array();

                $lista = $DAO->Consultar();

                //$lista_setores = "SELECT * FROM setores";
                //$resultado_lista = mysqli_query($conecta, $lista_setores);

                echo "<label class='seletor'>Escolha um setor para o produto :</label>";

                echo "<select name='Setor'>";
                echo "<option disabled='disabled' selected='selected'>Escolha o setor</option>";

                $obj = new SetorController();
                $obj->controlaConsulta(1);
                    
                //----------
                //while($row_setores = mysqli_fetch_assoc($resultado_lista)){
                //    echo "<option value='" . $row_setores['setor'] . "'>". $row_setores['setor'] . "</option>";
                //}
                echo "</select>";
            ?>
            <br><br>

            <button class="btConfirma" type="submit"><i class='fas fa-edit'></i> Salvar Edição</button>
        </form>
        <?php
            }
        ?>

    </div>
    <br>
    <div class="container">
        <a href="Listagem.php"><button type="button" class="btn btn-info"><i class="fas fa-reply"></i> Voltar para a lista</button></a>
    </div>
    <?php
    include("../include/SessaoValidate.php");
        include_once("../Controller/ProdutoController.php");
        $obj = new ProdutoController();   
        $obj->controlaAlteracao();
    ?>
</body>
</html>