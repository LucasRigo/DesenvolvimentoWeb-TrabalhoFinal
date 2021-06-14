<?php
    session_start();
    include_once("Conexao.php");

    $setor = $_POST['SetorNome'];

    $testaNome = 0;


    $lista_setores = "SELECT * FROM setores";
    $resultado_lista = mysqli_query($conecta, $lista_setores);
        
    while($row_setores = mysqli_fetch_assoc($resultado_lista)){
        if($row_setores['setor'] == $setor){
            $testaNome = $testaNome + 1;
        }
    }
    if($testaNome > 0){
        $_SESSION['msg'] = "<p style='color:red;'>Setor já cadastrado!!</p>";
        header("Location: CadSetores.php");
    }else{
        $result_setores = "INSERT INTO setores (setor) VALUES ('$setor')";
        mysqli_query($conecta, $result_setores);

        if(mysqli_insert_id($conecta)){
            $_SESSION['msg'] = "<p style='color:green;'>Cadastrado com sucesso!!</p>";
            header("Location: CadSetores.php");
        }else{
            $_SESSION['msg'] = "<p style='color:red;'>Falha no cadastro!</p>";
            header("Location: CadSetores.php");
        }
    }

    
?>