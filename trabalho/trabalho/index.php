<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/c2732b0761.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="Include/Estilos.css">
</head>
<body>



    <div class="container">
        <br>
        <h1><b>Supermercado</b></h1>
        <h3>Para acessar o programa por favor insira suas credencias</h3>

        <form action="./View/login.php" method="POST">

            <div class="form-group">
                <label><b>Informe seu Usuário:</b></label>
                <input class="form-control" name="user" type="text" placeholder="Insira o nome de seu usuário" required><br>
         </div>

            <div class="form-group">
                <label><b>Informe sua Senha:</b></label>
                <input class="form-control" name="pwd" type="password" placeholder="Insira sua senha" required><br><br>
            </div>

            <button class="btConfirma" type="submit" name="enviar" value="Enviar"><i class="fas fa-sign-in-alt" ></i> Logar</button>
        </form>

        <br><br>
        <p>Não tem cadastro? Cadastre-se agora: </p><a href="./View/CadUsuario.php" class="usercad"><button type="button" class="btn btn-info btn-sm">Cadastrar-se</button></a>
    </div>
</body>
</html>