<?php

//BANCO
defined('BANCO_HOST') ? NULL : define('BANCO_HOST', 'localhost');
defined('BANCO_USUARIO') ? NULL : define('BANCO_USUARIO', 'root');
defined('BANCO_SENHA') ? NULL : define('BANCO_SENHA', '');
defined('BANCO_BASE_DADOS') ? NULL : define('BANCO_BASE_DADOS', 'biblioteca_tcc');

//Outras configuracoes abaixo...
defined('MAX_REG_LIVROS') ? NULL : define('MAX_REG_LIVROS', '250');
defined('QTD_PAG_PRATELEIRA') ? NULL : define('QTD_PAG_PRATELEIRA', '6');
defined('QTD_PAG_ESTANTE') ? NULL : define('QTD_PAG_ESTANTE', '6');
defined('QTD_PAG_LIVRO') ? NULL : define('QTD_PAG_LIVRO', '6');
defined('QTD_REG_COMENTARIOS') ? NULL : define('QTD_REG_COMENTARIOS', '2');
defined('QTD_LIVROS_INDEX') ? NULL : define('QTD_LIVROS_INDEX', '18');
defined('QTD_LIVROS_LOGIN') ? NULL : define('QTD_LIVROS_LOGIN', '7');
defined('QTD_LIVROS_AUTOCOMPLETAR') ? NULL : define('QTD_LIVROS_AUTOCOMPLETAR', '10');
defined('LIMITE_TAM_IMAGEM') ? NULL : define('LIMITE_TAM_IMAGEM', '8388608');//8MB
defined('TEMPO_SESSAO_ON') ? NULL : define('TEMPO_SESSAO_ON', '3600');//Em segundos

?>