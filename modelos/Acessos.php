<?php

require_once (__DIR__ . '/../bibliotecas/Configuracao.php');
require_once (__DIR__ . '/../bibliotecas/Banco.php');

class Acessos {
      public static function inserirDadosAcesso($pessoa, $ip) {
        $bd = new Banco(BANCO_HOST, BANCO_USUARIO, BANCO_SENHA, BANCO_BASE_DADOS);
        $sql = "INSERT INTO acessos(pessoa,ip,data_hora) VALUES($pessoa,'$ip',(SELECT DATE_SUB(NOW(),INTERVAL 2 HOUR)))";
        return $bd->executarSQL($sql);
    }
}
