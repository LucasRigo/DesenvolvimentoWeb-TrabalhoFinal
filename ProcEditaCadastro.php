<?php
    session_start();
    include_once("Conexao.php");

    $id = $_POST['id'];
    $nome = $_POST['ProdNome'];
    $preco = $_POST['ProdPreco'];

    $result_produtos = "UPDATE produtos SET nome='$nome', preco='$preco' WHERE id='$id'";
    mysqli_query($conecta, $result_produtos);

    if(mysqli_affected_rows($conecta)){
        $_SESSION['msg'] = "<p style='color:green;'>Editado com sucesso!!</p>";
        header("Location: Listagem.php");
    }else{    
        $_SESSION['msg'] = "<p style='color:red;'>Falha na edição!</p>";
        header("Location: Listagem.php");
    }
?>