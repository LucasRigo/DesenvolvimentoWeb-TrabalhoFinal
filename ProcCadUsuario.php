<?php
    session_start();
    include_once("Conexao.php");

    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];
    $confirmasenha = $_POST['confirmasenha'];

    $testaNome = 0;

    $lista_usuarios = "SELECT * FROM usuarios";
    $resultado_lista = mysqli_query($conecta, $lista_usuarios);
        
    while($row_usuario = mysqli_fetch_assoc($resultado_lista)){
        if($row_usuario['user'] == $nome){
            $testaNome = $testaNome + 1;
        }
    }
    
    if($testaNome > 0){
        $_SESSION['msg'] = "<p style='color:red;'>Este usuário já foi cadastrado!!</p>";
        header("Location: CadUsuario.php");
    }
    if($senha != $confirmasenha){
        $_SESSION['msg'] = "<p style='color:red;'>As senhas não coincidem!!</p>";
        header("Location: CadUsuario.php");

    }else{
        $result_usuario = "INSERT INTO usuarios (user, senha) VALUES ('$usuario','$senha')";
            mysqli_query($conecta, $result_usuario);

        if(mysqli_affected_rows($conecta)){
                $_SESSION['msg'] = "<p style='color:green;'>Cadastrado com sucesso!</p>";
                header("Location: CadUsuario.php");
            }else{    
                $_SESSION['msg'] = "<p style='color:red;'>Falha no cadastro!</p>";
                header("Location: CadUsuario.php");
            }
    }
    
    
    
?>