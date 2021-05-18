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
    </head>
    <body>
        <div class="container">
        <h1>Listagem de Produtos</h1>
        <br>
        <?php
        if(isset($_SESSION['msg'])){
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
        $lista_produtos = "SELECT * FROM produtos";
        $resultado_lista = mysqli_query($conecta, $lista_produtos);
        
        while($row_produto = mysqli_fetch_assoc($resultado_lista)){
            echo "<b>_____________________________________________</b>";
            echo "<br>";
            echo "<b>ID:</b> " . $row_produto['id'] . "<br>";
            echo "<b>Nome:</b> " . $row_produto['nome'] . "<br>";
            echo "<b>Preco:</b> R$ " . $row_produto['preco'] . "<br>";
            
        }
        ?>

        <br>
        <a href="Cadastro.php"><button>Cadastrar Produtos</button></a>
        </div>
        
    </body>
</html>