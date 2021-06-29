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


        private function preparaDados(){
            $produto = new Produto();
    
            $nome = $_POST["nome"];
            $preco = $_POST["preco"];
            $setor = $_POST["setor"];

    
            $produto->nome = $nome;
            $produto->preco = $preco;
            $produto->setor = $setor;
    
            return $produto;
        }


        public function controlaAlteracao(){
        if (isset($_POST["nome"]) && isset($_POST["preco"]) && isset($_POST["setor"])) {
            $DAO  = new ProdutoDAO();
            $produto = $this->preparaDados();

            $codproduto = $_POST["id"];
            $produto->id = $codproduto;

            if ($DAO->Alterar($produto)) {
                print "<script>";
                print "document.formBuscar.buscaCod.disabled = false;";
                print "document.formBuscar.button2.disabled  = false;";
                print "window.location = '../view/editaproduto.php';";
                print "</script>";
            } else {
                print "<script>";
                print "alert('Registro NÃO ALTERADO! ERRO: $DAO->erro');";
                print "document.getElementById('buscaCod').value = '$codproduto';";
                print "document.getElementById('formBuscar').submit();";
                print "</script>";
            }

            unset($produto);
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

        public function exclui($cod){

            
                $DAO = new ProdutoDAO();
                $produto = $DAO->Excluir($cod);


                $_SESSION['msg'] = "<p style='color:green;'>Excluido com sucesso!!</p>";
                header("Location: ../View/Listagem.php");
                unset($produto);
        
            
        }
    
    }
    
    
    


?>