<?php
    require_once("../model/Conexao.php");
    require_once("../model/Produto.php");
    require_once("../model/ProdutoDAO.php");

    

    class ProdutoController{

        public function controlaInsercao() {
            if(isset($_POST["ProdNome"]) && isset($_POST["ProdPreco"]) && isset($_POST["Setor"])) {
                $erros = array();
                $nome = $_POST["ProdNome"];
                $preco = $_POST["ProdPreco"];
                $setor = $_POST["Setor"];
            
                if(count($erros) == 0) {
                    $DAO  = new ProdutoDAO();
                    $produto = new Produto();
                    $produto->nome = $nome;
                    $produto->preco = $preco;
                    $produto->setor = $setor;
                
                    if($DAO->Inserir($produto)) {
                        $_SESSION['msg'] = "<p style='color:green;'>Cadastrado com sucesso!!</p>";
                        header("Location: ../View/CadProdutos.php");
                    }
                    else {
                        $_SESSION['msg'] = "<p style='color:red;'>ERRO NO BANCO DE DADOS: " . $DAO->erro . "</p>";
                        $err = serialize($erros);
                        header("Location: ../View/CadProdutos.php");
                    }
                
                    unset($produto);
                }
                else {
                    $err = serialize($erros);
                    header("Location: ../View/CadProdutos.php?error=" . $err);
                }
            }
        }

        public function controlaConsulta($op) {
            $DAO = new ProdutoDAO();
            $lista = array();
            $numCol = 5;
            
            switch($op) {
            case 1:
            $lista = $DAO->Consultar();
            break;
            }
                
            if(count($lista) > 0) {
                
                for($i = 0; $i < count($lista); $i++) {
                    $id = $lista[$i]->id;
                    $nome = $lista[$i]->nome;
                    $preco = $lista[$i]->preco;
                    $setor = $lista[$i]->setor;
                
                    
                    echo "<tr>";
                        
            
                    echo "<td style=\"text-align: center;\">$id</td>";
            
                    echo "<td style=\"text-align: left;\">$nome</td>";

                    echo "<td style=\"text-align: left;\">R$ $preco</td>";

                    echo "<td style=\"text-align: left;\">$setor</td>";
            
                    echo "<td style=\"text-align: left;\"><a href='../View/EditaCad.php?id=".$id."'><button type='button' class='btn btn-info'><i class='fas fa-edit'></i> Editar</button></a>
                    <a href='../View/ExcluiCad.php?id=" . $id . "'><button type='button' class='btn btn-info'><i class='fas fa-trash-alt'></i> Excluir</button></a></td>";
            
                    echo "</tr>";
                    
                }
                
            }
            else {
            echo "<tr>";
            echo "<td colspan=\"$numCol\">Nenhum registro encontrado!</td>";
            echo "</tr>";
            }
        }


        public function controlaAlteracao(){
            if(isset($_POST["ProdNome"]) && isset($_POST["reco"]) && isset($_POST["setor"]) && isset($_POST["id"])) {
            $erros = array();
            $nome = $_POST["ProdNome"];
            $preco = $_POST["ProdPreco"];
            $setor = $_POST["setor"];
            $id = $_POST["id"];      
            
            $DAO = new ProdutoDAO();
            $lista = array();
            $lista = $DAO->Consultar();

            if(count($lista) > 0) {
                    
                for($i = 0; $i < count($lista); $i++) {
                    $nomebd = $lista[$i]->nome;

                    if($nomebd == $nome){
                        $_SESSION['msg'] = "<p style='color:red;'>Produto já cadastrado!!</p>";
                        header("Location: ../View/EditaCad.php?id=" . $id);

                    }elseif(is_null($setor)){
                        $_SESSION['msg'] = "<p style='color:red;'>Informe o setor!!</p>";
                        header("Location: ../View/EditaCad.php?id=" . $id);
                    
                    }else{
                        $produto = new Produto();
                        $produto->id = $id;
                        $produto->nome  = $nome;
                        $produto->preco = $preco;
                        $produto->setor = $setor;

                        if($DAO->Alterar($produto)) {
                            $_SESSION['msg'] = "<p style='color:green;'>Editado com sucesso!!</p>";
                            header("Location: ../view/Listagem.php");
                        }else{
                        
                            $_SESSION['msg'] = "<p style='color:red;'>ERRO NO BANCO DE DADOS: " . $DAO->erro . "</p>";
                            $err = serialize($erros);
                            header("Location: ../view/Listagem.php");          
                        }
                        
                        unset($produto);

                    }
            
                    

                    


                }
            }
            }


        

        }




        public function buscaDados($codigo){
            
            $DAO = new ProdutoDAO();
            $produto = $DAO->ConsultaEdita($codigo);
        
            $nome  = $produto[0]->nome;
            $preco = $produto[0]->preco;
            $setor = $produto[0]->setor;

            chamaFormAlterar($codigo, $nome, $preco, $setor);

        
            //print "<script>";
            //print "document.formBuscar.buscaCod.value = '$codigo';";
            //print "document.formBuscar.buscaCod.disabled = true;";
            //print "document.formBuscar.buttonbuscar.disabled  = true;";
            //print "</script>";
            
        
            unset($produto);
            
        }

        public function exclui(){

            if(isset($_POST["id"])){
                $id = $_POST["id"];
            
                $DAO = new ProdutoDAO();
                $produto = $DAO->Excluir($id);

                unset($produto);
        
            }
        }
    
    }
    
    
    


?>