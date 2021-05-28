<?php
    session_start();
    include_once("Conexao.php");
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
        <h1>Listagem de Produtos</h1>
        <br>

        <a href="Cadastro.php"><button type="button" class="btn btn-info">Cadastrar Produtos</button></a>
        <br><br>

        <?php
        if(isset($_SESSION['msg'])){
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
        $lista_produtos = "SELECT * FROM produtos";
        $resultado_lista = mysqli_query($conecta, $lista_produtos);
        
        while($row_produto = mysqli_fetch_assoc($resultado_lista)){
  
            echo "<table class='table table-striped table-sm'";
            
            echo "<tr>";
            echo "<td><b>ID:</b></td> <td>" . $row_produto['id'] . "</td>";
            echo "</tr>";

            echo "<tr>";
            echo "<td><b>Nome:</b> </td> <td>" . $row_produto['nome'] . "</td>";
            echo "</tr>";

            echo "<tr>";
            echo "<td><b>Preco:</b> </td> <td>R$ " . $row_produto['preco'] . "</td>";
            echo "</tr>";

            echo "<tr>";
            echo "<td><a href='EditaCad.php?id=" . $row_produto['id'] . "'><button type='button' class='btn btn-info'><i class='fas fa-edit'></i>Editar</button></a></td>";
            echo "<td><a href='ExcluiCad.php?id=" . $row_produto['id'] . "'><button type='button' class='btn btn-info'><i class='fas fa-trash-alt'></i>Excluir</button></a></td>";
            echo "</tr>";

            echo "</table><br>";

        }
        ?>

        </div>
        
    </body>
</html>