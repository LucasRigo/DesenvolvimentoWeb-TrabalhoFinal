<?php
    session_start();
    include_once("../Model/Conexao.php");

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Excluir Cadastro</title>
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

    <div id="menu">
		<ul>
      <li ><a href="inicio.php"><i class="fas fa-store"></i> Tela Inicial</a></li>
      <li ><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Sair</a></li>
		</ul>
	</div>

  <div class="container">
  <h1><b>Excluir seu Usuário</b></h1>
  


  <form id="formExcluir" name="formExcluir" method="post" action="ExcluiUser.php" onsubmit="return confirm('Você tem certeza que deseja excluir seu usuário?');">
    <!-- Enviando o código de forma oculta, para ações futuras no BD -->
    <input type="hidden" name="id" id="id" value="<?php echo $_SESSION['nome_usuario'];?>">

    <p>
      <label>
        <button class="btExclui" type="submit" name="button" id="button" value="Confirma exclusão?"><i class="fas fa-trash-alt"></i> Excluir seu usuário?</button>
      </label>
    </p>
  </form>
<?php


  include("../include/SessaoValidate.php");  // Faz a autenticação
  include_once("../controller/UserController.php");
  $obj = new UserController();   
  $obj->controlaExclusao();
?>

  </div>
</body>
</html>