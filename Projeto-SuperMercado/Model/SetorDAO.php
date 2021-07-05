<?php
class SetorDAO {
  // Recebe a conexão
  public $p = null;
  public $erro = null;
  
  // construtor
  public function __construct() {
    $this->p = new FabricaConexao();
    $this->p->exec("set names utf8");  /* Define todas as transações com charset UTF-8 */
  }
  
  // inserção
  public function Inserir($setor) {
    try {
      $stmt = $this->p->prepare("INSERT INTO setores (setor) VALUES (?)");
	  
	  // Inicia a transação
      $this->p->beginTransaction();
      $stmt->bindValue(1, $setor->setor);
	  
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
  public function Alterar($setor) {
    try {
      $stmt = $this->p->prepare("UPDATE setores SET setor=? WHERE id=?");
      // Inicia a transação
      $this->p->beginTransaction();
      // Vincula um valor a um parâmetro da sentença SQL, na ordem
      $stmt->bindValue(1, $setor->setor);
      $stmt->bindValue(2, $setor->id);
    
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
  public function Excluir($setor) {
    try {
      $stmt = $this->p->prepare("DELETE FROM setores WHERE id=?");
      // Inicia a transação
      $this->p->beginTransaction();
      // Vincula um valor a um parâmetro da sentença SQL, na ordem
      $stmt->bindValue(1, $setor->id);
    
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
        $stmt = $this->p->query("SELECT * FROM setores");
  
	  while($registro = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT))
	  {
	    $p = new Setor();
	  
	    // Sempre verifica se a query SQL retornou a respectiva coluna
	    if(isset($registro["id"]))
	      $p->id = $registro["id"];
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
          $sql = "SELECT * FROM setores WHERE id = $param";  // volta só um registro
          break;
      }
              
      $stmt = $this->p->query($sql);
    
      while($registro = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT))
      {
        $p = new Setor();
      
        // Sempre verifica se a query SQL retornou a respectiva coluna
        if(isset($registro["id"]))
          $p->id = $registro["id"];
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


}
?>