<?php
    session_start();
    include_once("../Model/Conexao.php");
    include_once("../controller/SetorController.php");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Cadastro Produtos</title>
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
        <h1><b>Cadastro de Produtos</b></h1>
        <h3>Preencha os dados do produto que deseja cadastrar</h3>
        <?php
        if(isset($_SESSION['msg'])){
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }

        ?>
        <form action="CadProdutos.php" method="POST">

            <div class="form-group">
                <label><b>Produto:</b></label>
                <input class="form-control" name="ProdNome" type="text" placeholder="Insira o nome do produto" required><br>
         </div>

            <div class="form-group">
                <label><b>Preço:</b></label>
                <input class="form-control" name="ProdPreco" type="number" min="0" step="0.01" placeholder="Insira o preço do produto" required><br><br>
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

            <button class="btConfirma" type="submit"><i class="far fa-save"></i> Cadastrar</button>
        </form>
    </div>

    <?php
        include("../include/SessaoValidate.php");  // Faz a autenticação
        include_once("../controller/ProdutoController.php");
        $obj = new ProdutoController();
        $obj->controlaInsercao();
    ?>
</body>
</html>