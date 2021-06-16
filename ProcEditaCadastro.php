<?php
    session_start();
    include_once("Conexao.php");

    $id = $_POST['id'];
    $nome = $_POST['ProdNome'];
    $preco = $_POST['ProdPreco'];
    $setor = $_POST['Setor'];

    $lista_produtos = "SELECT * FROM produtos";
    $resultado_lista = mysqli_query($conecta, $lista_produtos);
        
    while($row_produto = mysqli_fetch_assoc($resultado_lista)){
        if($row_produto['nome'] == $nome){
            $testaNome = $testaNome + 1;
        }
    }
    
    if($testaNome > 0){
        $_SESSION['msg'] = "<p style='color:red;'>Produto já cadastrado!!</p>";
        header("Location: EditaCad.php?id=" . $id);
    }elseif(is_null($setor)){
        $_SESSION['msg'] = "<p style='color:red;'>Informe o setor!!</p>";
        header("Location: EditaCad.php?id=" . $id);
    }else{
        $result_produtos = "UPDATE produtos SET nome='$nome', preco='$preco', setor='$setor' WHERE id='$id'";
        mysqli_query($conecta, $result_produtos);

        if(mysqli_affected_rows($conecta)){
            $_SESSION['msg'] = "<p style='color:green;'>Editado com sucesso!!</p>";
            header("Location: Listagem.php");
        }else{    
            $_SESSION['msg'] = "<p style='color:red;'>Falha na edição!</p>";
            header("Location: Listagem.php");
        }
    }
    
?>