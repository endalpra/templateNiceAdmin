<?php
require_once (__DIR__ .'/../modelos/Estantes.php');
require_once (__DIR__ .'/../bibliotecas/URL.php');


if(URL::isPaginaAtual("cadastrarestante.php")){
    if(isset($_POST['nome']) && !empty($_POST['nome'])){
        $nome = $_POST['nome'];
        
        //Verifica se estante já não está cadastrada
        
        $retorno = Estantes::cadastrarEstante($nome);
        if($retorno){
            $msg = 1;
        }else{
            $msg = 0;
        }
    }else{
         $msgErro = "Preencha o campo obrigatório *";
    }
}
