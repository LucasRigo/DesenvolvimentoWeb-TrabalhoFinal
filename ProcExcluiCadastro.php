<?php
    session_start();
    include_once("Conexao.php");

    $id = $_POST['id'];

    $result_produtos = "DELETE FROM produtos WHERE id='$id'";
    mysqli_query($conecta, $result_produtos);

    if(mysqli_affected_rows($conecta)){
        $_SESSION['msg'] = "<p style='color:green;'>Excluído com sucesso!!</p>";
        header("Location: Listagem.php");
    }else{    
        $_SESSION['msg'] = "<p style='color:red;'>Falha na exclusão!</p>";
        header("Location: Listagem.php");
    }
?>