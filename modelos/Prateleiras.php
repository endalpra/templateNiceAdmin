<?php
require_once (__DIR__ . '/../bibliotecas/Configuracao.php');
require_once (__DIR__ . '/../bibliotecas/Banco.php');


class Prateleiras {
    
    private $id;
    private $nome;
    private $estante;
    private $pessoa;
    private $paginas;
    
      public static function cadastrarPrateleira($nome, $estante, $pessoa) {
        $bd = new Banco(BANCO_HOST, BANCO_USUARIO, BANCO_SENHA, BANCO_BASE_DADOS);
        $sql = "INSERT INTO prateleiras(nome, estante, pessoa) VALUES('$nome','$estante','$pessoa') ";
        return $bd->executarSQL($sql);
    }

    public static function buscarPrateleiraNome($nome, $pessoa){
        $bd = new Banco(BANCO_HOST, BANCO_USUARIO, BANCO_SENHA, BANCO_BASE_DADOS);
        $sql = "SELECT * FROM prateleiras WHERE nome='".$nome."' AND pessoa=".$pessoa;
        return $bd->executarSQL($sql, 'Prateleiras');
    }
    
     public static function buscarPrateleiraId($id, $pessoa){
        $bd = new Banco(BANCO_HOST, BANCO_USUARIO, BANCO_SENHA, BANCO_BASE_DADOS);
        $sql = "SELECT * FROM prateleiras WHERE id=".$id." AND pessoa=".$pessoa;
        return $bd->executarSQL($sql, 'Prateleiras');
    }
        
     public static function buscarPrateleirasPessoa($pessoa, $primeiroRegistro, $qtdRegistros){
        $bd = new Banco(BANCO_HOST, BANCO_USUARIO, BANCO_SENHA, BANCO_BASE_DADOS);
        $sql = "SELECT p.id id, p.nome nome,e.nome estante FROM prateleiras p, estantes e WHERE p.estante=e.id AND p.pessoa=".$pessoa." ORDER BY p.nome LIMIT $primeiroRegistro, $qtdRegistros";
        return $bd->executarSQL($sql, 'Prateleiras');
    }
    
    public static function buscarTodasPrateleirasPessoa($pessoa){
        $bd = new Banco(BANCO_HOST, BANCO_USUARIO, BANCO_SENHA, BANCO_BASE_DADOS);
        $sql = "SELECT * FROM prateleiras  WHERE pessoa=".$pessoa;
        return $bd->executarSQL($sql, 'Prateleiras');
    }
    
    public static function getNumPaginas($pessoa, $limitePagina){
        $bd = new Banco(BANCO_HOST, BANCO_USUARIO, BANCO_SENHA, BANCO_BASE_DADOS);
        $sql = "SELECT CEIL(COUNT(id) / $limitePagina) AS paginas FROM prateleiras WHERE pessoa=".$pessoa;
        return $bd->executarSQL($sql, 'Prateleiras');
    }
    
    public static function editarPrateleira($id, $nome, $estante) {
        $bd = new Banco(BANCO_HOST, BANCO_USUARIO, BANCO_SENHA, BANCO_BASE_DADOS);
        $sql = "UPDATE prateleiras SET nome='$nome', estante='$estante' WHERE id=".$id;
        return $bd->executarSQL($sql);
    }
    
     public static function excluirPrateleira($id) {
        $bd = new Banco(BANCO_HOST, BANCO_USUARIO, BANCO_SENHA, BANCO_BASE_DADOS);
        $sql = "DELETE FROM prateleiras WHERE id=".$id;
        return $bd->executarSQL($sql);
    }
            
    function getEstante() {
        return $this->estante;
    }

    function getPessoa() {
        return $this->pessoa;
    }

    function setEstante($estante) {
        $this->estante = $estante;
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

    function getPaginas() {
        return $this->paginas;
    }

    function setPaginas($paginas) {
        $this->paginas = $paginas;
    }
}

