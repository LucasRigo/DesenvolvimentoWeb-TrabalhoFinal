<?php
class ProdutoDAO {
  // Recebe a conexão
  public $p = null;
  public $erro = null;
  
  // construtor
  public function __construct() {
    $this->p = new FabricaConexao();
    $this->p->exec("set names utf8");  /* Define todas as transações com charset UTF-8 */
  }
  
  // inserção
  public function Inserir($produto) {
    try {
      $stmt = $this->p->prepare("INSERT INTO produtos (nome, preco, setor) VALUES (?, ?, ?)");
	  
	  // Inicia a transação
      $this->p->beginTransaction();
      $stmt->bindValue(1, $produto->nome);
      $stmt->bindValue(2, $produto->preco);
      $stmt->bindValue(3, $produto->setor);
	  
	  // Executa a query
      $stmt->execute();
      
	  // Grava a transação
      $this->p->commit();      
      
    // Fecha a conexão
    unset($this->p);
	    
      return true;
    }
  	// Em caso de erro, retorna a mensagem:
	  catch(PDOException $e) {
      $this->erro = "Erro: " . $e->getMessage();
	    return false;
    }
  }
  
  // alteração
  public function Alterar($produto) {
    try {
      $stmt = $this->p->prepare("UPDATE produtos SET nome=?, preco=?, setor=? WHERE id=?");
      // Inicia a transação
      $this->p->beginTransaction();
      // Vincula um valor a um parâmetro da sentença SQL, na ordem
      $stmt->bindValue(1, $produto->nome);
      $stmt->bindValue(2, $produto->preco);
      $stmt->bindValue(3, $produto->setor);
      $stmt->bindValue(4, $produto->id);
    
      // Executa a query
      $stmt->execute();
  
      // Grava a transação
      $this->p->commit();
    
      // Fecha a conexão
      unset($this->p);

      return true;
    }
    // Em caso de erro, retorna a mensagem:
    catch(PDOException $e) {
      $this->erro = "Erro: " . $e->getMessage();
    return false;
    }
  }

  // exclusão
  public function Excluir($produto) {
    try {
      $stmt = $this->p->prepare("DELETE FROM produtos WHERE id=?");
      // Inicia a transação
      $this->p->beginTransaction();
      // Vincula um valor a um parâmetro da sentença SQL, na ordem
      $stmt->bindValue(1, $produto->id);
    
      // Executa a query
      $stmt->execute();
      
      // Grava a transação
      $this->p->commit();
      
      // Fecha a conexão
      unset($this->p);

      return true;
    }
    // Em caso de erro, retorna a mensagem:
    catch(PDOException $e) {
      $this->erro = "Erro: " . $e->getMessage();
      return false;
    }
  }
  
  // consulta
  public function Consultar($query=null) {
    try {
	  $items = array();
	  
      if($query != null)
        $stmt = $this->p->query($query);
      else
        $stmt = $this->p->query("SELECT * FROM produtos");

	  while($registro = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT))
	  {
	    $p = new Produto();
	  
	    // Sempre verifica se a query SQL retornou a respectiva coluna
	    if(isset($registro["id"]))
	      $p->id = $registro["id"];
      if(isset($registro["nome"]))
	      $p->nome = $registro["nome"];
	    if(isset($registro["preco"]))
	      $p->preco = $registro["preco"];
      if(isset($registro["setor"]))
	      $p->setor = $registro["setor"];

	    // Ao final, adiciona o registro como um item do array de retorno
	    $items[] = $p;
	  }
    // Fecha a conexão
    unset($this->p);  
	  
      return $items;
    }
	  // Em caso de erro, retorna a mensagem:
	  catch(PDOException $e) {
      echo "Erro: ". $e->getMessage();
    }
  }







  public function ConsultarEdit($op, $param=null) {
    try {
      $items = array();

      switch($op) {
        case 2:
          $sql = "SELECT * FROM produtos WHERE id = $param";  // volta só um registro
          break;
      }
              
      $stmt = $this->p->query($sql);
    
      while($registro = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT))
      {
        $p = new Produto();
      
        // Sempre verifica se a query SQL retornou a respectiva coluna
        if(isset($registro["id"]))
          $p->id = $registro["id"];
        if(isset($registro["nome"]))
          $p->nome = $registro["nome"];
        if(isset($registro["preco"]))
          $p->preco = $registro["preco"];
        if(isset($registro["setor"]))
          $p->setor = $registro["setor"];
        
        if($op == 1) {
          if(isset($registro["nome"]))
            $p->setor = $registro["nome"];
        }
        else {  // $op == 2
          if(isset($registro["setor"]))
            $p->setor = $registro["setor"];          
        }

        // Ao final, adiciona o registro como um item do array de retorno
        $items[] = $p;
      }

      // Fecha a conexão
      unset($this->p);
    
      return $items;
    }
    // Em caso de erro, retorna a mensagem:
    catch(PDOException $e) {
      echo "Erro: ". $e->getMessage();
    }
  }













  public function ConsultaEdita($param) {
    try {
      $items = array();

      $sql = "SELECT * FROM produtos WHERE id = $param";  // volta só um registro
        
      
              
      $stmt = $this->p->query($sql);
    
      while($registro = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT))
      {
        $p = new Produto();
      
        // Sempre verifica se a query SQL retornou a respectiva coluna
        if(isset($registro["id"]))
          $p->id = $registro["id"];
        if(isset($registro["nome"]))
          $p->nome = $registro["nome"];
        if(isset($registro["preco"]))
          $p->preco = $registro["preco"];
        if(isset($registro["setor"]))
          $p->preco = $registro["setor"];
        

        // Ao final, adiciona o registro como um item do array de retorno
        $items[] = $p;
      }

      // Fecha a conexão
      unset($this->p);
    
      return $items;
    }
    // Em caso de erro, retorna a mensagem:
    catch(PDOException $e) {
      echo "Erro: ". $e->getMessage();
    }
  }

}
?>