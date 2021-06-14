<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Cadastro</title>
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



    <div class="container">
        <br>
        <h1><b>Supermercado</b></h1>
        <h3>Para acessar o programa por favor insira suas credencias</h3>

        <form action="#####" method="POST">

            <div class="form-group">
                <label><b>Usuário:</b></label>
                <input class="form-control" name="usuario" type="text" placeholder="Insira o nome de seu usuário" required><br>
         </div>

            <div class="form-group">
                <label><b>Senha:</b></label>
                <input class="form-control" name="senha" type="password" placeholder="Insira sua senha" required><br><br>
            </div>

            <input id="login" name="login" type="submit" value="Logar">
        </form>

        <br><br>
        <p>Não tem cadastro? Cadastre-se agora: </p><a href="CadUsuario.php" class="usercad"><button type="button" class="btn btn-info btn-sm">Cadastrar-se</button></a>
    </div>
</body>
</html>