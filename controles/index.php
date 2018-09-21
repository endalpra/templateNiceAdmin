<?php

require_once (__DIR__ . '/../modelos/Pessoas.php');
require_once (__DIR__ . '/../modelos/Livros.php');
require_once (__DIR__ . '/../modelos/Logins.php');
require_once (__DIR__ . '/../bibliotecas/URL.php');

if (URL::isPaginaAtual("index.php")) {
    $livros = Livros::buscarLivrosOnline(0,QTD_LIVROS_INDEX);         
}
?>