<?php
 
    require_once("../model/Conexao.php");
    require_once("../model/Setor.php");
    require_once("../model/SetorDAO.php");

    

    class SetorController {


        public function controlaConsulta($op) {
            $DAO = new SetorDAO();
            $lista = array();
            
            switch($op) {
            case 1:
                $lista = $DAO->Consultar();
            break;
            }
            
            if(count($lista) > 0) {
                for($i = 0; $i < count($lista); $i++) {
                    $setor = $lista[$i]->setor;
                
                    echo "<option value='" . $setor . "'>". $setor . "</option>";

                }
            }
        }



        

        public function consultaSetores($op) {
            $DAO = new SetorDAO();
            $lista = array();
            $numCol = 2;
            
            switch($op) {
            case 1:
            $lista = $DAO->Consultar();
            break;
            }
                
            if(count($lista) > 0) {
                
                for($i = 0; $i < count($lista); $i++) {
                    $id = $lista[$i]->id;
                    $setor = $lista[$i]->setor;
                
                    
                    echo "<tr>";
                        
                    echo "<td style=\"text-align: center;\">$id</td>";

                    echo "<td style=\"text-align: center;\">$setor</td>";
            
                    echo "</tr>";
                    
                }
                
            }
            else {
            echo "<tr>";
            echo "<td colspan=\"$numCol\">Nenhum registro encontrado!</td>";
            echo "</tr>";
            }
        }

        public function controlaInsercao() {
            if(isset($_POST["SetorNome"])) {
                $erros = array();
                $nome = $_POST["SetorNome"];
            
                if(count($erros) == 0) {
                    $DAO  = new SetorDAO();
                    $setor = new Setor();
                    $setor->setor = $nome;
                
                    if($DAO->Inserir($setor)) {
                        $_SESSION['msg'] = "<p style='color:green;'>Cadastrado com sucesso!!</p>";
                        header("Location: ../View/CadSetores.php");
                    }
                    else {
                        $_SESSION['msg'] = "<p style='color:red;'>ERRO NO BANCO DE DADOS: " . $DAO->erro . "</p>";
                        $err = serialize($erros);
                        header("Location: ../View/CadSetores.php");
                    }
                
                    unset($setor);
                }
                else {
                    $err = serialize($erros);
                    header("Location: ../View/CadSetores.php?error=" . $err);
                }
            }
        }


        public function controlaAlteracao(){
            if(isset($_POST["setor"]) && isset($_POST["id"])) {
            $erros = array();;
            $setor = $_POST["setor"];
            $id = $_POST["id"];   
            
                if(count($erros) == 0) {
                    $DAO = new SetorDAO();
                    $setores = new Setor();
                    $setores->setor = $setor;
                    $setores->id = $id;        

                    if($DAO->Alterar($setores)) {
                        $_SESSION['msg'] = "<p style='color:green;'>Alterado com sucesso!!</p>";
                        header("Location: ../View/ListagemSetores.php");
                    }
                    else
                    {
                    $erros[] = "ERRO NO BANCO DE DADOS: $DAO->erro";
                    $err = serialize($erros);
                    $_SESSION['msg'] = "<p style='color:red;'>".$err."</p>";
                    header("Location: ../View/ListagemSetores.php");

                    }
                
                    unset($setores);
                    }
                    else {
                        $err = serialize($erros);  // Caso tenha erro no preenchimento do formulário
                        header("Location: ../view/EditaSetor.php?errorMode=$err&id=$id");
                    }
            }
            else if(isset($_POST["buscaCod"])){
                $codigo = $_POST["buscaCod"];
                $this->buscaDados($codigo, 0);  // chamaFormAlterar
            }
        }



        private function buscaDados($id, $modo){
            $DAO = new SetorDAO();
            
            $setores = $DAO->ConsultarEdit(2, $id);
            
            if(count($setores) == 1)
            {
                $setor = $setores[0]->setor;
        
                if($modo == 0)
                    chamaFormAlterar($id, $setor);
                else
                    chamaFormExcluir($id, $setor);
            
                print "<script>";
                print "document.formBuscar.buscaCod.value = '$id';";
                print "document.formBuscar.buscaCod.disabled = true;";
                print "document.formBuscar.buttonbuscar.disabled  = true;";
                print "</script>";
            }
            else
            {
                print "<script>";
                print "alert('SETOR NÃO ENCONTRADO! Por favor, tente novamente...');";
                print "</script>";          
            }
            
            unset($setores);
        }


        public function controlaExclusao(){
            if(isset($_POST["id"]))
            {
                $DAO = new SetorDAO();
                $setores = new Setor();

                $id = $_POST["id"];
                $setores->id = $id;

                if($DAO->Excluir($setores)) {
                    $_SESSION['msg'] = "<p style='color:green;'>Excluido com sucesso!!</p>";
                    header("Location: ../View/ListagemSetores.php");
                }
                else
                {
                    $erros[] = "ERRO NO BANCO DE DADOS: $DAO->erro";
                    $err = serialize($erros);
                    $_SESSION['msg'] = "<p style='color:red;'>".$err."</p>";
                    header("Location: ../View/ListagemSetores.php");
                }
                
                unset($setores);
            }else if(isset($_POST["buscaCod"])){
                $codigo = $_POST["buscaCod"];
                $this->buscaDados($codigo, 1);  // chamaFormExcluir
            }
        }


    }
    
?>