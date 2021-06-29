<?php
    //  APAGAR DPS  //-------------------DAQUI PRA BAIXO
    //session_start();
    //include_once("Conexao.php");

    //$setor = $_POST['SetorNome'];

    //$testaNome = 0;


    //$lista_setores = "SELECT * FROM setores";
    //$resultado_lista = mysqli_query($conecta, $lista_setores);
        
    //while($row_setores = mysqli_fetch_assoc($resultado_lista)){
    //    if($row_setores['setor'] == $setor){
    //        $testaNome = $testaNome + 1;
    //    }
    //}
    //if($testaNome > 0){
    //    $_SESSION['msg'] = "<p style='color:red;'>Setor já cadastrado!!</p>";
    //    header("Location: CadSetores.php");
    //}else{
    //    $result_setores = "INSERT INTO setores (setor) VALUES ('$setor')";
    //    mysqli_query($conecta, $result_setores);

    //    if(mysqli_insert_id($conecta)){
    //        $_SESSION['msg'] = "<p style='color:green;'>Cadastrado com sucesso!!</p>";
    //        header("Location: CadSetores.php");
    //    }else{
    //        $_SESSION['msg'] = "<p style='color:red;'>Falha no cadastro!</p>";
    //        header("Location: CadSetores.php");
    //    }
    //}
    //  APAGAR DPS  //-------------------DAQUI PRA CIMA
    //---------------------------------------------------------------------------------------------------------------------

 
    require_once("../model/Conexao.php");
    require_once("../model/Setor.php");
    require_once("../model/SetorDAO.php");

    

    class SetorController {


    public function controlaConsulta($op) {
        $DAO = new SetorDAO();
        $lista = array();
        //$numCol = 3;
        
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
    }
    
?>