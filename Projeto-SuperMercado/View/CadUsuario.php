<?php
    session_start();
    include_once("../Model/Conexao.php");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Cadastro Usuário</title>
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


    <div class="container">
        <br>
        <h1><b>Cadastro de Usuários</b></h1>
        <h3>Preencha os dados para se cadastrar</h3>

        <?php
        if(isset($_SESSION['msg'])){
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
        ?>

        <form action="CadUsuario.php" method="POST">

            <div class="form-group">
                <label><b>Usuário:</b></label>
                <input class="form-control" name="user" type="text" placeholder="Insira um nome para seu usuário" required><br>
            </div>

            <div class="form-group">
                <label><b>Senha:</b></label>
                <input class="form-control" name="pwd" type="password" placeholder="Insira uma senha" required><br>
            </div>

            <input class="btConfirma" id="cadastra" name="cadastra" type="submit" value="Inserir">
        </form>
        <br><br>
        <p>Já possui cadastro?</p>
        <a href="../index.php" class="usercad"><button type="button" class="btn btn-info btn-sm">Entrar agora</button></a>
    </div>
    <?php
        include_once("../controller/UserController.php");
        $obj = new UserController();
        $obj->controlaInsercao();
    ?>
</body>
</html>