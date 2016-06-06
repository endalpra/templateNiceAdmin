<?php 
//require_once (__DIR__ .'/../modelos/Areas_do_conhecimento.php');
//require_once (__DIR__ .'/../bibliotecas/URL.php');
//
//
//if(URL::isPaginaAtual("cadastrarareadoconhecimento.php")){
//    if(isset($_POST['nome']) && !empty($_POST['nome'])){
//        $nome = $_POST['nome'];
//        $pessoa = $_POST['pessoa'];
//        
//        //Verifica se área do conhecimento já não está cadastrada
//        
//        $retorno = Areas_do_conhecimento::cadastrarAreas_do_conhecimento($nome, $pessoa);
//        if($retorno){
//            $msg = 1;
//        }else{
//            $msg = 0;
//        }
//    }else{
//         $msgErro = "Preencha o campo obrigatório *";
//    }
//}