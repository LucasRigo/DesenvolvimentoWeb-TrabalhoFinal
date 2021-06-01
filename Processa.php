<?php
    session_start();
    include_once("Conexao.php");

    $nome = $_POST['ProdNome'];
    $preco = $_POST['ProdPreco'];

    $testaNome = 0;


    $lista_produtos = "SELECT * FROM produtos";
    $resultado_lista = mysqli_query($conecta, $lista_produtos);
        
    while($row_produto = mysqli_fetch_assoc($resultado_lista)){
        if($row_produto['nome'] == $nome){
            $testaNome = $testaNome + 1;
        }
    }
    if($testaNome > 0){
        $_SESSION['msg'] = "<p style='color:red;'>Produto já cadastrado!!</p>";
        header("Location: Cadastro.php");
    }else{
        $result_produtos = "INSERT INTO produtos (nome, preco) VALUES ('$nome','$preco')";
        mysqli_query($conecta, $result_produtos);

        if(mysqli_insert_id($conecta)){
            $_SESSION['msg'] = "<p style='color:green;'>Cadastrado com sucesso!!</p>";
            header("Location: Cadastro.php");
        }else{
            header("Location: Cadastro.php");
            $_SESSION['msg'] = "<p style='color:red;'>Falha no cadastro!</p>";
        }
    }




    
?>