<?php
require_once (__DIR__ . '/../bibliotecas/Configuracao.php');
require_once (__DIR__ . '/../bibliotecas/Banco.php');


class Estantes {
    
    private $id;
    private $nome;
    
      public static function cadastrarEstante($nome) {
        $bd = new Banco(BANCO_HOST, BANCO_USUARIO, BANCO_SENHA, BANCO_BASE_DADOS);
        $sql = "INSERT INTO estantes(nome) VALUES('$nome') ";
        return $bd->executarSQL($sql);
    }

    public static function buscarEstante($nome){
        $bd = new Banco(BANCO_HOST, BANCO_USUARIO, BANCO_SENHA, BANCO_BASE_DADOS);
        $sql = "SELECT * FROM estantes WHERE nome='".$nome."' ";
        return $bd->executarSQL($sql, 'Estantes');
    }
    
     public static function buscarTodasEstantesPessoa($pessoa){
        $bd = new Banco(BANCO_HOST, BANCO_USUARIO, BANCO_SENHA, BANCO_BASE_DADOS);
        $sql = "SELECT * FROM estantes WHERE pessoa=".$pessoa;
        return $bd->executarSQL($sql, 'Estantes');
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
