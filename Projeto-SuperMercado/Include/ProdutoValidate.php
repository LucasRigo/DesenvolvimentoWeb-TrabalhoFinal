<?php
  class ProdutoValidate {
    public static function testarNome($paramNome) {
      if (trim(strlen($paramNome)) >= 2)
        return true;
      else
        return false;
    }	
  }
?>