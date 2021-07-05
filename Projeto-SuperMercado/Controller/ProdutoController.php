<?php
    require_once("../model/Conexao.php");
    require_once("../model/Produto.php");
    require_once("../model/ProdutoDAO.php");
    require_once("../model/SetorDAO.php");
    require_once("../model/Setor.php");
    require_once("../Include/ProdutoValidate.php");

    

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
            $numCol = 4;
            
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
            
                    echo "<td style=\"text-align: center;\">$nome</td>";

                    echo "<td style=\"text-align: center;\">R$ $preco</td>";

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


        public function controlaAlteracao(){
            if(isset($_POST["nome"]) && isset($_POST["preco"]) && isset($_POST["setor"]) && isset($_POST["id"])) {
            $erros = array();
            $nome = $_POST["nome"];
            $preco = $_POST["preco"];
            $setor = $_POST["setor"];
            $id = $_POST["id"];   

            
            if(!ProdutoValidate::testarNome($_POST["nome"]))
                $erros[] = "Nome inválido";
            
            if(count($erros) == 0) {
                $DAO = new ProdutoDAO();
                $produto = new Produto();
                $produto->nome = $nome;
                $produto->preco  = $preco;
                $produto->setor = $setor;
                $produto->id = $id;        

                if($DAO->Alterar($produto)) {
                    $_SESSION['msg'] = "<p style='color:green;'>Alterado com sucesso!!</p>";
                    header("Location: ../View/Listagem.php");
                }
                else
                {
                $erros[] = "ERRO NO BANCO DE DADOS: $DAO->erro";
                $err = serialize($erros);
                $_SESSION['msg'] = "<p style='color:red;'>".$err."</p>";
                header("Location: ../View/Listagem.php");

                }
            
                unset($produto);
                }
                else {
                    $err = serialize($erros);  // Caso tenha erro no preenchimento do formulário
                    header("Location: ../view/EditaCad.php?errorMode=$err&id=$id");
                }
            }
            else if(isset($_POST["buscaCod"]))
            {
            $codigo = $_POST["buscaCod"];
            $this->buscaDados($codigo, 0);  // chamaFormAlterar
            }
        }




        private function buscaDados($id, $modo){
            $DAO = new ProdutoDAO();
            
            $produto = $DAO->ConsultarEdit(2, $id);
            
            if(count($produto) == 1)
            {
                $nome = $produto[0]->nome;
                $preco  = $produto[0]->preco;
                $setor = $produto[0]->setor;
        
                if($modo == 0)
                    chamaFormAlterar($id, $nome, $preco, $setor);
                else
                    chamaFormExcluir($id, $nome, $preco, $setor);
            
                print "<script>";
                print "document.formBuscar.buscaCod.value = '$id';";
                print "document.formBuscar.buscaCod.disabled = true;";
                print "document.formBuscar.buttonbuscar.disabled  = true;";
                print "</script>";
            }
            else
            {
                print "<script>";
                print "alert('PRODUTO NÃO ENCONTRADO! Por favor, tente novamente...');";
                print "</script>";          
            }
            
            unset($produto);
        }  

        public function controlaExclusao(){
            if(isset($_POST["id"]))
            {
            $DAO = new ProdutoDAO();
            $produto = new Produto();

            $id = $_POST["id"];
            $produto->id = $id;

            if($DAO->Excluir($produto)) {
                $_SESSION['msg'] = "<p style='color:green;'>Excluido com sucesso!!</p>";
                header("Location: ../View/Listagem.php");
            }
            else
            {
                $erros[] = "ERRO NO BANCO DE DADOS: $DAO->erro";
                $err = serialize($erros);
                $_SESSION['msg'] = "<p style='color:red;'>".$err."</p>";
                header("Location: ../View/Listagem.php");
            }
            
            unset($produto);
            }
            else if(isset($_POST["buscaCod"]))
            {
            $codigo = $_POST["buscaCod"];
            $this->buscaDados($codigo, 1);  // chamaFormExcluir
            }
        }

        public function listaSetorFK($selectedIndex=-1) {
            $DAO = new SetorDAO();
            $lista = array();
            $lista = $DAO->Consultar();
            $resultOptions = "";
        
            if($selectedIndex != -1)
              $selectedIndex--;  // índice de seleção começa em zero
          
            if(count($lista) > 0) {
              // Populando a lista de opções
              for($i = 0; $i < count($lista); $i++) {
                if($i != $selectedIndex)
                {
                  // Para casos de inserção ou consulta
                  $resultOptions .= "<option value=\"" . $lista[$i]->setor . "\">" . $lista[$i]->setor . "</option>" . "\n";
                }
                else {
                  // Para casos de alteração ou exclusão, deve existir só um item selecionado
                  $resultOptions .= "<option selected value=\"" . $lista[$i]->setor . "\">" . $lista[$i]->setor . "</option>" . "\n";
                }
              }
            }
            else {
              // Cria uma option vazia
              $resultOptions .= "<option value=''></option>\n";
            }
            // Retorna os resultados considerando a chamada php dentro de um <select>
            return $resultOptions;
        }
    }
    
    


?>