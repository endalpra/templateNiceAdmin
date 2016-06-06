<?php
require_once (__DIR__ . '/../bibliotecas/Configuracao.php');
require_once (__DIR__ . '/../bibliotecas/Banco.php');


class Estantes {
    
    private $id;
    private $nome;
    private $paginas;


    public static function cadastrarEstante($nome, $pessoa) {
        $bd = new Banco(BANCO_HOST, BANCO_USUARIO, BANCO_SENHA, BANCO_BASE_DADOS);
        $sql = "INSERT INTO estantes(nome, pessoa) VALUES('$nome','$pessoa') ";
        return $bd->executarSQL($sql);
    }

    public static function buscarEstanteId($id, $pessoa){
        $bd = new Banco(BANCO_HOST, BANCO_USUARIO, BANCO_SENHA, BANCO_BASE_DADOS);
        $sql = "SELECT * FROM estantes WHERE id=".$id." AND pessoa=".$pessoa ;
        return $bd->executarSQL($sql, 'Estantes');
    }
    
     public static function buscarEstantesPessoa($pessoa, $primeiroRegistro, $qtdRegistros){
        $bd = new Banco(BANCO_HOST, BANCO_USUARIO, BANCO_SENHA, BANCO_BASE_DADOS);
        $sql = "SELECT * FROM estantes e WHERE e.pessoa=".$pessoa." LIMIT $primeiroRegistro, $qtdRegistros";
        return $bd->executarSQL($sql, 'Estantes');
    }
    
     public static function buscarTodasEstantesPessoa($pessoa){
        $bd = new Banco(BANCO_HOST, BANCO_USUARIO, BANCO_SENHA, BANCO_BASE_DADOS);
        $sql = "SELECT * FROM estantes e WHERE e.pessoa=".$pessoa;
        return $bd->executarSQL($sql, 'Estantes');
    }
    
     public static function getNumPaginas($pessoa, $limitePagina){
        $bd = new Banco(BANCO_HOST, BANCO_USUARIO, BANCO_SENHA, BANCO_BASE_DADOS);
        $sql = "SELECT CEIL(COUNT(id) / $limitePagina) AS paginas FROM estantes WHERE pessoa=".$pessoa;
        return $bd->executarSQL($sql, 'Estantes');
    }
    
      public static function alterarEstante($id,$nome) {
        $bd = new Banco(BANCO_HOST, BANCO_USUARIO, BANCO_SENHA, BANCO_BASE_DADOS);
        $sql = "UPDATE estantes SET nome='$nome' WHERE id=".$id;
        return $bd->executarSQL($sql);
    }
    
      public static function excluirEstante($id) {
        $bd = new Banco(BANCO_HOST, BANCO_USUARIO, BANCO_SENHA, BANCO_BASE_DADOS);
        $sql = "DELETE FROM estantes WHERE id=".$id;
        return $bd->executarSQL($sql);
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
    
    function getPaginas() {
        return $this->paginas;
    }

    function setPaginas($paginas) {
        $this->paginas = $paginas;
    }



}
