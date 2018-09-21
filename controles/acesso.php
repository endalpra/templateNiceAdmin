<?php

require_once (__DIR__ . '/../modelos/Acessos.php');
require_once (__DIR__ . '/../bibliotecas/URL.php');

if (URL::isPaginaAtual("login.php")) {
    Acessos::inserirDadosAcesso($_SESSION['ses-usu-id'], $_SESSION['ses-usu-ip']);
}
