<?php

class Produto {
  private $id;
  private $nome;
  private $preco;
  private $setor;

  public function __set($propriedade, $valor) {
    $this->$propriedade = $valor;
  }

  public function __get($propriedade) {
    return $this->$propriedade;
  }
}

?>