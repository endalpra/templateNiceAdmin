<?php

//BANCO
defined('BANCO_HOST') ? NULL : define('BANCO_HOST', 'localhost');
defined('BANCO_USUARIO') ? NULL : define('BANCO_USUARIO', 'root');
defined('BANCO_SENHA') ? NULL : define('BANCO_SENHA', '');
defined('BANCO_BASE_DADOS') ? NULL : define('BANCO_BASE_DADOS', 'biblioteca_tcc');

//Outras configuracoes abaixo...
defined('QTD_PAG_PRATELEIRA') ? NULL : define('QTD_PAG_PRATELEIRA', '6');
defined('QTD_PAG_ESTANTE') ? NULL : define('QTD_PAG_ESTANTE', '6');
defined('QTD_PAG_LIVRO') ? NULL : define('QTD_PAG_LIVRO', '6');
?>