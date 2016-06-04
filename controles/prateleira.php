<?php
require_once (__DIR__ .'/../modelos/Prateleiras.php');
require_once (__DIR__ .'/../modelos/Estantes.php');
require_once (__DIR__ .'/../bibliotecas/URL.php');


if(URL::isPaginaAtual("cadastrarprateleira.php")){
    //Carregar estantes
    $estantes = Estantes::buscarTodasEstantesPessoa($_SESSION['ses-usu-id']);
    if(isset($_POST['nome']) && !empty($_POST['nome']) && isset($_POST['estante']) && !empty($_POST['estante'])){
        $nome = $_POST['nome'];
        $estante = $_POST['estante'];
        $pessoa = $_POST['pessoa'];
        
        //Verifica se prateleira já não está registrada
        
        $retorno = Prateleiras::cadastrarEstante($nome, $estante, $pessoa);
        if($retorno){
            $msg = 1;
        }else{
            $msg = 0;
        }
    }else{
         $msgErro = "Preencha os campos obrigatórios *";
    }
}else if(URL::isPaginaAtual("listarprateleiras.php")){
    $primeiroRegistro = 0;
    $pessoa = $_SESSION['ses-usu-id'];
    $prateleiras = Prateleiras::buscarPrateleirasPessoa($pessoa, $primeiroRegistro, QTD_PAG_PRATELEIRA);
    $qtdPaginas = Prateleiras::getNumPaginas($pessoa, QTD_PAG_PRATELEIRA);
    
}else if(URL::isPaginaAtual("prateleira.php")){
    //AJAX PAGINAÇÃO
    if(isset($_POST['pagina']) && isset($_POST['pessoa'])){
        $pagina = $_POST['pagina'];
        $primeiroRegistro = $pagina * QTD_PAG_PRATELEIRA;
        $pessoa = $_POST['pessoa'];
        $prateleiras = Prateleiras::buscarPrateleirasPessoa($pessoa, $primeiroRegistro, QTD_PAG_PRATELEIRA);
        
        $xml = "";
        $xml .= "<?xml version='1.0' encoding='UTF-8'?>";
        $xml .= "<prateleiras>";
        foreach ($prateleiras as $p):
            $xml .= "<prateleira>";
            $xml .= "<id>" . $p->getId() . "</id>";
            $xml .= "<nome>" . $p->getNome() . "</nome>";
            $xml .= "<estante>" . $p->getEstante() . "</estante>";
            $xml .= "</prateleira>";
        endforeach;
        $xml .= "</prateleiras>";

        echo $xml;
    }
}


