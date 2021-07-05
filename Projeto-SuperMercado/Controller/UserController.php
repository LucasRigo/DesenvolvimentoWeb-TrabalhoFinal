<?php
require_once("../model/Conexao.php");
require_once("../model/User.php");
require_once("../model/UserDAO.php");

class UserController {

  public function controlaConsulta() {
    if (!empty($_POST['user']) && !empty($_POST['pwd'])) {
      $user = new User();
      $user->user = $_POST['user'];
      $user->senha = $_POST['pwd'];
  
      $DAO = new UserDAO();
      $result = $DAO->Consultar($user);
  
      if($result) { /* Testa se a consulta retornou algum registro */
        if($result == -2) {
          echo "<p>USUÁRIO NÃO ENCONTRADO!</p>";
          echo "<a href=\"../index.php\"><button>Voltar</button></a>";  
        }
        else if($result == -1) {
          echo "<p>SENHA INVÁLIDA!</p>";

          echo "<a href=\"../index.php\"><button>Voltar</button></a>";  
        }
        else {  /* Tudo certo - registrando as variáveis de sessão */
          session_start();
          $_SESSION["nome_usuario"] = $user->user;
          $_SESSION["senha_usuario"] = $user->senha;
          header("location: ../view/inicio.php");  /* Direciona para a página inicial */
        }
      }
    }
  }

  public function controlaInsercao() {
    if(isset($_POST["user"]) && isset($_POST["pwd"])) {
      $erros = array();
      $user = new User();
      $user->user = $_POST['user'];
      $user->senha = $_POST['pwd'];
  
      $DAO = new UserDAO();
      $result = $DAO->Inserir($user);
      if($result == 1) {
        
        $_SESSION['msg'] = "<p style='color:green;'>Cadastrado com sucesso!!</p>";
        header("Location: ../view/CadUsuario.php");
      }
      else if($result == -1) {
        $erros[] = "USUÁRIO JÁ EXISTENTE! TENTE NOVAMENTE!";
        $err = serialize($erros);
        header("Location: ../view/CadUsuario.php?error=$err");
      }	  
      else {
        $erros[] = "ERRO NO BANCO DE DADOS: $DAO->erro";
        $err = serialize($erros);
        header("Location: ../view/CadUsuario.php?error=$err");
      }
      
      unset($user);
    }
  }

  public function controlaAlteracao(){
    if(isset($_POST["id"]) && isset($_POST["senha"])) {
    $erros = array();;
    $user = $_POST["id"];
    $senha = $_POST["senha"];   
    
      if(count($erros) == 0) {
        $DAO = new UserDAO();
        $users = new User();
        $users->user = $user;
        $users->senha = $senha;      

        if($DAO->Alterar($users)) {
            header("Location: ../View/logout.php");
        }
        else
        {
        $erros[] = "ERRO NO BANCO DE DADOS: $DAO->erro";
        $err = serialize($erros);
        $_SESSION['msg'] = "<p style='color:red;'>".$err."</p>";
        header("Location: ../View/EditaUser.php");

        }
        
        unset($setores);
        }
        else {
            $err = serialize($erros);  // Caso tenha erro no preenchimento do formulário
            header("Location: ../view/EditaSetor.php?errorMode=$err&user=$user");
        }
    }
    }

    public function controlaExclusao(){
      if(isset($_POST["id"])){
          $DAO = new UserDAO();
          $users = new User();

          $user = $_POST["id"];
          $users->user = $user;

          if($DAO->Excluir($users)) {
            header("Location: ../View/logout.php");
          }
          
          else{
            $erros[] = "ERRO NO BANCO DE DADOS: $DAO->erro";
            $err = serialize($erros);
            $_SESSION['msg'] = "<p style='color:red;'>".$err."</p>";
            header("Location: ../View/ExcluiUser.php");
          }
          
          unset($users);
      }
    }


  }

?>