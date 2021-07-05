<?php
    Class FabricaConexao extends PDO{
        private $dbn = "mysql:host=localhost;port=3306;dbname=mercado";
        private $usuario = "root";
        private $senha = "";
        private $handle = null;

        function __construct(){
            try{
                if($this->handle == null) {
                    $dbh = parent::__construct($this->dbn, $this->usuario ,$this->senha);
                    $this->handle = $dbh;
                    return $this->handle;
                }
            }
            catch(PDOException $e) {
                echo "Conexão falhou. Erro: " . $e->getMessage() . "\n";
                return false;
            }
        }
        function __destruct(){
            $this->handle = null;
        }  
    }

    
?>