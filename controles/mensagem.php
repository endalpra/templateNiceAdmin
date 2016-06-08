<?php
require_once (__DIR__ . '/../modelos/Mensagens.php');
require_once (__DIR__ . '/../bibliotecas/URL.php');

if (URL::isPaginaAtual("contatardono.php")) {
    if(isset($_POST['mensagem'])){
        $remetente = $_SESSION['ses-usu-id'];
        $destinatario = $_POST['destinatario'];
        $conteudo = $_POST['mensagem'];
        
        $retorno = Mensagens::gravarMensagem($conteudo, $remetente, $destinatario);
        if($retorno){
            $msg = 1;
        }else{
            $msg = 0;
        }
    }else{
        
    }
}