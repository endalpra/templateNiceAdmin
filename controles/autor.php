<?php

require_once (__DIR__ . '/../modelos/Autores.php');
require_once (__DIR__ . '/../bibliotecas/URL.php');

if (URL::isPaginaAtual("cadastrarautor.php")) {
    
} else if (URL::isPaginaAtual("autor.php")) {
    if (isset($_POST['autor'])) {
        $autor = $_POST['autor'];
        $retorno = Autores::cadastrarAutor($autor);
        $id = $retorno[0]->getId();
        if ($retorno) {
            echo $id;
        } else {
            echo '0';
        }
    }
}



