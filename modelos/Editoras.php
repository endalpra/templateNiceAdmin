<?php

require_once (__DIR__ . '/../bibliotecas/Configuracao.php');
require_once (__DIR__ .'/../bibliotecas/Banco.php');

class Editoras{
    
    private $id;
    private $nome;

    public static function cadastrarEditora($nome) {
        $bd = new Banco(BANCO_HOST, BANCO_USUARIO, BANCO_SENHA, BANCO_BASE_DADOS);
        $nome = $bd->real_escape_string($nome);
        $sql = "INSERT INTO editoras(nome) VALUES('$nome')";
        $bd->executarSQL($sql);
        return $bd->executarSQL("SELECT LAST_INSERT_ID() as id FROM editoras", "Editoras");
    }
    
    public static function buscarEditoras($string){
        $bd = new Banco(BANCO_HOST, BANCO_USUARIO, BANCO_SENHA, BANCO_BASE_DADOS);
        $string = $bd->real_escape_string($string);
        $sql = "SELECT * FROM editoras WHERE LOWER(nome) LIKE LOWER('".$string."%') ";
        return $bd->executarSQL($sql, 'Editoras');
    }
    
    function getId() {
        return $this->id;
    }

    function setId($id) {
        $this->id = $id;
    }
       
    function getNome() {
        return $this->nome;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

}


