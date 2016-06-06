<?php

require_once (__DIR__ . '/../bibliotecas/Configuracao.php');
require_once (__DIR__ . '/../bibliotecas/Banco.php');

class Areas_do_conhecimento {

    private $id;
    private $nome;
    private $pessoa;

//    public static function cadastrarAreas_do_conhecimento($nome, $pessoa) {
//        $bd = new Banco(BANCO_HOST, BANCO_USUARIO, BANCO_SENHA, BANCO_BASE_DADOS);
//        $sql = "INSERT INTO areas_do_conhecimento(nome,pessoa) VALUES('$nome','$pessoa') ";
//        return $bd->executarSQL($sql);
//    }

    public static function buscarAreas_do_conhecimentoNome($nome) {
        $bd = new Banco(BANCO_HOST, BANCO_USUARIO, BANCO_SENHA, BANCO_BASE_DADOS);
        $sql = "SELECT * FROM areas_do_conhecimento WHERE nome='" . $nome . "' ";
        return $bd->executarSQL($sql, 'Areas_do_conhecimento');
    }

//    public static function buscarAreas_do_conhecimentoPessoa($pessoa) {
//        $bd = new Banco(BANCO_HOST, BANCO_USUARIO, BANCO_SENHA, BANCO_BASE_DADOS);
//        $sql = "SELECT * FROM areas_do_conhecimento WHERE pessoa=" . $pessoa;
//        return $bd->executarSQL($sql, 'Areas_do_conhecimento');
//    }

    public static function buscarTodasAreas_do_conhecimento() {
        $bd = new Banco(BANCO_HOST, BANCO_USUARIO, BANCO_SENHA, BANCO_BASE_DADOS);
        $sql = "SELECT * FROM Areas_do_conhecimento ORDER BY nome";
        return $bd->executarSQL($sql, 'Areas_do_conhecimento');
    }

    function getPessoa() {
        return $this->pessoa;
    }

    function setPessoa($pessoa) {
        $this->pessoa = $pessoa;
    }

    function getId() {
        return $this->id;
    }

    function getNome() {
        return $this->nome;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

}
