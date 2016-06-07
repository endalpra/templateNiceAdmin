<?php
require_once (__DIR__ .'/../modelos/Estantes.php');
require_once (__DIR__ .'/../bibliotecas/URL.php');


if(URL::isPaginaAtual("cadastrarestante.php")){
    if(isset($_POST['nome']) && !empty($_POST['nome']) &&isset($_POST['pessoa']) && !empty($_POST['pessoa'])){
        $nome = $_POST['nome'];
        $pessoa = $_POST['pessoa'];
        //Verifica se estante já não está cadastrada
        
        $retorno = Estantes::cadastrarEstante($nome, $pessoa);
        if($retorno){
            $msg = 1;
        }else{
            $msg = 0;
        }
    }else{
         $msgErro = "Preencha o campo obrigatório *";
    }
}else if(URL::isPaginaAtual("editarestante.php")){
    //CARREGA OS DADOS NA PÁGINA
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        //PASSAR A PESSOA PARA QUE NÃO SEJA POSSÍVEL ACESSAR REGISTROS DE OUTROS USUARIOS MODIFICANDO O ID NA URL
        $pessoa = $_SESSION['ses-usu-id'];
        $estantes = Estantes::buscarEstanteId($id, $pessoa);    
     //SALVA OS DADOS   
    }else if(isset($_POST['nome']) && !empty($_POST['nome'])){
        $id = $_POST['id'];
        $nome = $_POST['nome'];
        Estantes::alterarEstante($id, $nome);
    }
    
}
//AJAX
else if(URL::isPaginaAtual("estante.php")){
    if(isset($_POST['pagina']) && isset($_POST['pessoa'])){
        $pagina = $_POST['pagina'];
        $primeiroRegistro = $pagina * QTD_PAG_ESTANTE;
        $pessoa = $_POST['pessoa'];
        $estantes = Estantes::buscarTodasEstantesPessoa($pessoa, $primeiroRegistro, QTD_PAG_ESTANTE);
        $qtdPaginas = Estantes::getNumPaginas($pessoa, QTD_PAG_ESTANTE);
        
        $xml = "";
        $xml .= "<?xml version='1.0' encoding='UTF-8'?>";
        $xml .= "<estantes>";
        foreach ($estantes as $e):
            $xml .= "<estante>";
            $xml .= "<id>" . $e->getId() . "</id>";
            $xml .= "<nome>" . $e->getNome() . "</nome>";
            $xml .= "</estante>";
        endforeach;
        $xml .= "<qtdPaginas>". $qtdPaginas[0]->getPaginas() ."</qtdPaginas>";
        $xml .= "</estantes>";

        echo $xml;
        
    //EXCLUIR ESTANTE
    }else if(isset ($_POST['id'])){
        $id = $_POST['id'];
        $retorno = Estantes::excluirEstante($id);
        if($retorno){
            echo $id;
        }else{
            echo 0;
        }
    }
}
