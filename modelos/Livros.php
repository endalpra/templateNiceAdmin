<?php
require_once (__DIR__ . '/../bibliotecas/Configuracao.php');
require_once (__DIR__ . '/../bibliotecas/Banco.php');


class Livros {

    private $id;
    private $titulo;
    private $area_do_conhecimento;
    private $prateleira;
    private $pessoa;
    private $numero_paginas;
    private $descricao;
    private $autor;
    private $editora;
    private $edicao;
    private $isbn;
    private $online;
    private $paginas;

    public static function cadastrarLivro($titulo, $area_do_conhecimento, $prateleira, $pessoa, $numero_paginas, $descricao, $autor, $editora, $edicao, $isbn, $online) {
        $bd = new Banco(BANCO_HOST, BANCO_USUARIO, BANCO_SENHA, BANCO_BASE_DADOS);
        $sql = "INSERT INTO livros(titulo,area_do_conhecimento,prateleira,pessoa,numero_paginas,descricao,autor,editora,edicao,isbn,online) VALUES('$titulo','$area_do_conhecimento','$prateleira','$pessoa','$numero_paginas','$descricao','$autor','$editora','$edicao','$isbn','$online') ";
        return $bd->executarSQL($sql);
    }

    public static function buscarLivroTitulo($pessoa, $primeiroRegistro, $qtdRegistros, $titulo){
        $bd = new Banco(BANCO_HOST, BANCO_USUARIO, BANCO_SENHA, BANCO_BASE_DADOS);
        $sql = "SELECT l.id as id, titulo,a.nome as area_do_conhecimento,p.nome as prateleira,autor,numero_paginas,descricao,editora,edicao,isbn,online FROM livros l, areas_do_conhecimento a, prateleiras p WHERE l.area_do_conhecimento=a.id AND l.prateleira=p.id AND l.pessoa=".$pessoa." AND (LOWER(titulo) LIKE LOWER('%" . $titulo . "%') OR LOWER(autor) LIKE LOWER('%" . $titulo . "%') OR LOWER(a.nome) LIKE LOWER('%" . $titulo . "%') OR LOWER(p.nome) LIKE LOWER('%" . $titulo . "%') ) ORDER BY titulo LIMIT $primeiroRegistro, $qtdRegistros";
        //$sql = "SELECT postagens.codigo from postagens WHERE LOWER(titulo) LIKE LOWER('%" . $titulo . "%') ORDER BY postagens.data DESC";
        return $bd->executarSQL($sql, 'Livros');
    }
    
     public static function buscarLivroId($id, $pessoa){
        $bd = new Banco(BANCO_HOST, BANCO_USUARIO, BANCO_SENHA, BANCO_BASE_DADOS);
        $sql = "SELECT * FROM livros WHERE id=".$id." AND pessoa=".$pessoa;
        return $bd->executarSQL($sql, 'Livros');
    }
    
     public static function buscarLivroIdContDono($id){
        $bd = new Banco(BANCO_HOST, BANCO_USUARIO, BANCO_SENHA, BANCO_BASE_DADOS);
        $sql = "SELECT * FROM livros WHERE id=".$id;
        return $bd->executarSQL($sql, 'Livros');
    }
    
     public static function buscarLivrosPessoa($pessoa, $primeiroRegistro, $qtdRegistros){
        $bd = new Banco(BANCO_HOST, BANCO_USUARIO, BANCO_SENHA, BANCO_BASE_DADOS);
        $sql = "SELECT l.id as id, titulo,a.nome as area_do_conhecimento,p.nome as prateleira,autor,numero_paginas,descricao,editora,edicao,isbn,online FROM livros l, areas_do_conhecimento a, prateleiras p WHERE l.area_do_conhecimento=a.id AND l.prateleira=p.id AND l.pessoa=".$pessoa." ORDER BY titulo LIMIT $primeiroRegistro, $qtdRegistros";
        return $bd->executarSQL($sql, 'Livros');
    }    
      
    public static function getNumPaginas($pessoa, $qtdRegistros){
        $bd = new Banco(BANCO_HOST, BANCO_USUARIO, BANCO_SENHA, BANCO_BASE_DADOS);
        $sql = "SELECT CEIL(COUNT(id) / $qtdRegistros) AS paginas FROM livros WHERE pessoa=".$pessoa;
        return $bd->executarSQL($sql, 'Livros');
    }
    
    public static function getNumPaginasString($pessoa, $qtdRegistros,$string){
        $bd = new Banco(BANCO_HOST, BANCO_USUARIO, BANCO_SENHA, BANCO_BASE_DADOS);
        $sql = "SELECT CEIL(COUNT(l.id) / $qtdRegistros) AS paginas FROM livros l, areas_do_conhecimento a, prateleiras p WHERE l.area_do_conhecimento=a.id AND l.prateleira=p.id AND l.pessoa=".$pessoa." AND ( LOWER(titulo) LIKE LOWER('%" . $string . "%') OR LOWER(autor) LIKE LOWER('%" . $string . "%') OR LOWER(a.nome) LIKE LOWER('%" . $string . "%') OR LOWER(p.nome) LIKE LOWER('%" . $string . "%') ) ";
        return $bd->executarSQL($sql, 'Livros');
    }
    
    public static function excluirLivro($id) {
        $bd = new Banco(BANCO_HOST, BANCO_USUARIO, BANCO_SENHA, BANCO_BASE_DADOS);
        $sql = "DELETE FROM livros WHERE id=".$id;
        return $bd->executarSQL($sql);
    }
   
     public static function alterarLivro($id,$titulo, $area_do_conhecimento, $prateleira, $numero_paginas, $descricao, $autor, $editora, $edicao, $isbn) {
        $bd = new Banco(BANCO_HOST, BANCO_USUARIO, BANCO_SENHA, BANCO_BASE_DADOS);
        $sql = "UPDATE livros set titulo='$titulo', area_do_conhecimento=$area_do_conhecimento, prateleira=$prateleira, numero_paginas=$numero_paginas, descricao='$descricao', autor='$autor', editora='$editora', edicao=$edicao, isbn='$isbn' WHERE id=".$id;
        return $bd->executarSQL($sql);
    }
    
    public static function alterarOnlineLivro($id, $online) {
        $bd = new Banco(BANCO_HOST, BANCO_USUARIO, BANCO_SENHA, BANCO_BASE_DADOS);
        $sql = "UPDATE livros set online=$online WHERE id=".$id;
        return $bd->executarSQL($sql);
    }
    
    //FUNÇÕES REFERENTES À BUSCA ONLINE
    public static function getNumPaginasStringOnline($qtdRegistros,$string){
        $bd = new Banco(BANCO_HOST, BANCO_USUARIO, BANCO_SENHA, BANCO_BASE_DADOS);
        $sql = "SELECT CEIL(COUNT(l.id) / $qtdRegistros) AS paginas FROM livros l, areas_do_conhecimento a WHERE l.area_do_conhecimento=a.id AND l.online=1 AND ( LOWER(titulo) LIKE LOWER('%" . $string . "%') OR LOWER(autor) LIKE LOWER('%" . $string . "%') OR LOWER(a.nome) LIKE LOWER('%" . $string . "%') )";
        return $bd->executarSQL($sql, 'Livros');
    }
    
    public static function buscarLivroStringOnline($primeiroRegistro, $qtdRegistros, $string){
        $bd = new Banco(BANCO_HOST, BANCO_USUARIO, BANCO_SENHA, BANCO_BASE_DADOS);
        $sql = "SELECT l.id as id, titulo,a.nome as area_do_conhecimento, l.pessoa, autor,numero_paginas,descricao,editora,edicao,isbn,online FROM livros l, areas_do_conhecimento a WHERE l.area_do_conhecimento=a.id AND l.online=1 AND ( LOWER(titulo) LIKE LOWER('%" . $string . "%') OR LOWER(autor) LIKE LOWER('%" . $string . "%') OR LOWER(a.nome) LIKE LOWER('%" . $string . "%') ) ORDER BY titulo LIMIT $primeiroRegistro, $qtdRegistros";
         return $bd->executarSQL($sql, 'Livros');
    }
    
    function getId() {
        return $this->id;
    }

    function getTitulo() {
        return $this->titulo;
    }

    function getArea_do_conhecimento() {
        return $this->area_do_conhecimento;
    }

    function getPessoa() {
        return $this->pessoa;
    }

    function getNumero_paginas() {
        return $this->numero_paginas;
    }

    function getDescricao() {
        return $this->descricao;
    }

    function getAutor() {
        return $this->autor;
    }

    function getEditora() {
        return $this->editora;
    }

    function getEdicao() {
        return $this->edicao;
    }

    function getIsbn() {
        return $this->isbn;
    }

    function getOnline() {
        return $this->online;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    function setArea_do_conhecimento($area_do_conhecimento) {
        $this->area_do_conhecimento = $area_do_conhecimento;
    }

    function setPessoa($pessoa) {
        $this->pessoa = $pessoa;
    }

    function setNumero_paginas($numero_paginas) {
        $this->numero_paginas = $numero_paginas;
    }
    
    function getPrateleira() {
        return $this->prateleira;
    }

    function setPrateleira($prateleira) {
        $this->prateleira = $prateleira;
    }
    
    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    function setAutor($autor) {
        $this->autor = $autor;
    }

    function setEditora($editora) {
        $this->editora = $editora;
    }

    function setEdicao($edicao) {
        $this->edicao = $edicao;
    }

    function setIsbn($isbn) {
        $this->isbn = $isbn;
    }

    function setOnline($online) {
        $this->online = $online;
    }
    
    function getPaginas() {
        return $this->paginas;
    }

    function setPaginas($paginas) {
        $this->paginas = $paginas;
    }

}
