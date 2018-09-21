<?php

require_once (__DIR__ . '/../modelos/Editoras.php');
require_once (__DIR__ . '/../bibliotecas/URL.php');

if (URL::isPaginaAtual("cadastraestante.php")) {
    
} else if (URL::isPaginaAtual("editora.php")) {
    if(isset($_POST['editora'])){
        $editora = $_POST['editora'];
        $retorno = Editoras::cadastrarEditora($editora);
        $id = $retorno[0]->getId();
        if($retorno){
            echo $id;
        }else{
            echo '0';
        }
    }
}

