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
    private $nome_autor;
    private $editora;
    private $nome_editora;
    private $edicao;
    private $isbn;
    private $online;
    private $paginas;
    private $latitude;
    private $longitude;
    private $distancia;
    private $imagem;
    private $lido;

    public static function cadastrarLivro($titulo, $area_do_conhecimento, $prateleira, $pessoa, $numero_paginas, $descricao, $editora, $edicao, $isbn, $online, $lido) {
        $bd = new Banco(BANCO_HOST, BANCO_USUARIO, BANCO_SENHA, BANCO_BASE_DADOS);
        $titulo = $bd->real_escape_string($titulo);
        $descricao = $bd->real_escape_string($descricao);
        $isbn = $bd->real_escape_string($isbn);
        $sql = "INSERT INTO livros(titulo,area_do_conhecimento,prateleira,pessoa,numero_paginas,descricao,editora,edicao,isbn,online,lido) VALUES('$titulo',$area_do_conhecimento,$prateleira,$pessoa,'$numero_paginas','$descricao',$editora,'$edicao','$isbn','$online','$lido') ;";
        $bd->executarSQL($sql);
        return $bd->executarSQL("SELECT LAST_INSERT_ID() as id FROM livros", "Livros");
    }

    public static function inserirAutoresLivros($autor, $livro) {
        $bd = new Banco(BANCO_HOST, BANCO_USUARIO, BANCO_SENHA, BANCO_BASE_DADOS);
        $sql = "INSERT INTO autores_livros(autor,livro) VALUES('$autor','$livro') ";
        return $bd->executarSQL($sql);
    }

     //$sql = "update tblproduto set PRO_IMAGEM = '" . $nome . "' where PRO_CODIGO = " . $id;

     public static function updateLivrosImagem($livro, $imagem) {
        $bd = new Banco(BANCO_HOST, BANCO_USUARIO, BANCO_SENHA, BANCO_BASE_DADOS);
        $imagem = $bd->real_escape_string($imagem);
        $sql = "UPDATE livros SET imagem='" . $imagem . "' WHERE id=" . $livro;
        return $bd->executarSQL($sql);
    }
    
    public static function updateAutoresLivros($newAutor, $livro) {
        $bd = new Banco(BANCO_HOST, BANCO_USUARIO, BANCO_SENHA, BANCO_BASE_DADOS);
        $sql = "UPDATE autores_livros SET autor=" . $newAutor . " WHERE livro=" . $livro;
        return $bd->executarSQL($sql);
    }

    public static function buscarAutorLivro($livro) {
        $bd = new Banco(BANCO_HOST, BANCO_USUARIO, BANCO_SENHA, BANCO_BASE_DADOS);
        $sql = "SELECT al.autor as autor, a.nome as nome_autor FROM autores_livros al, autores a WHERE a.id=al.autor AND livro=" . $livro;
        return $bd->executarSQL($sql, 'Livros');
    }
    
     public static function verificaExcedenteLivros($pessoa) {
        $bd = new Banco(BANCO_HOST, BANCO_USUARIO, BANCO_SENHA, BANCO_BASE_DADOS);
        $sql = "SELECT count(*) as id FROM livros WHERE pessoa=" . $pessoa;
        return $bd->executarSQL($sql, 'Livros');
    }
    
    public static function buscarLivroTitulo($pessoa, $primeiroRegistro, $qtdRegistros, $titulo) {
        $bd = new Banco(BANCO_HOST, BANCO_USUARIO, BANCO_SENHA, BANCO_BASE_DADOS);
        $titulo = $bd->real_escape_string($titulo);
        $sql = "SELECT l.id as id, titulo,a.nome as area_do_conhecimento,p.nome as prateleira,au.nome as autor,numero_paginas,descricao,editora,edicao,isbn,online FROM livros l, areas_do_conhecimento a, autores au, autores_livros al, prateleiras p WHERE (al.autor=au.id AND al.livro=l.id) AND l.area_do_conhecimento=a.id AND l.prateleira=p.id AND l.pessoa=" . $pessoa . " AND (LOWER(titulo) LIKE LOWER('%" . $titulo . "%') OR LOWER(au.nome) LIKE LOWER('%" . $titulo . "%') OR LOWER(a.nome) LIKE LOWER('%" . $titulo . "%') OR LOWER(p.nome) LIKE LOWER('%" . $titulo . "%') ) ORDER BY titulo LIMIT $primeiroRegistro, $qtdRegistros";
        //$sql = "SELECT postagens.codigo from postagens WHERE LOWER(titulo) LIKE LOWER('%" . $titulo . "%') ORDER BY postagens.data DESC";
        return $bd->executarSQL($sql, 'Livros');
    }

    public static function buscarLivroId($id, $pessoa) {
        $bd = new Banco(BANCO_HOST, BANCO_USUARIO, BANCO_SENHA, BANCO_BASE_DADOS);
        $sql = "SELECT l.id as id, l.imagem as imagem, l.titulo as titulo, l.area_do_conhecimento as area_do_conhecimento, l.prateleira as prateleira, l.pessoa as pessoa, l.numero_paginas as numero_paginas, l.descricao as descricao, l.editora as editora, l.edicao as edicao, l.isbn as isbn, l.online as online, l.lido as lido, e.nome as nome_editora, a.nome as nome_autor, p.nome as nome_pessoa FROM livros l, editoras e, autores a, autores_livros al, pessoas p WHERE l.editora=e.id AND l.pessoa=p.id AND al.livro=l.id AND a.id=al.autor AND l.id=" . $id." AND l.pessoa=".$pessoa;
        return $bd->executarSQL($sql, 'Livros');
    }
    
     public static function verificaExistenciaLivro($titulo, $edicao, $pessoa) {
        $bd = new Banco(BANCO_HOST, BANCO_USUARIO, BANCO_SENHA, BANCO_BASE_DADOS);
        $titulo = $bd->real_escape_string($titulo);
        $sql = "SELECT COUNT(*) as id FROM livros WHERE titulo='$titulo' AND edicao=$edicao AND livros.pessoa=".$pessoa;
        return $bd->executarSQL($sql, 'Livros');
    }

    public static function buscarLivroIdContDono($id) {
        $bd = new Banco(BANCO_HOST, BANCO_USUARIO, BANCO_SENHA, BANCO_BASE_DADOS);
        $sql = "SELECT * FROM livros WHERE id=" . $id;
        return $bd->executarSQL($sql, 'Livros');
    }

    public static function buscarLivrosPessoa($pessoa, $primeiroRegistro, $qtdRegistros) {
        $bd = new Banco(BANCO_HOST, BANCO_USUARIO, BANCO_SENHA, BANCO_BASE_DADOS);
        $sql = "SELECT l.id as id, titulo,a.nome as area_do_conhecimento,p.nome as prateleira,au.nome as autor,numero_paginas,descricao,editora,edicao,isbn,online FROM livros l, areas_do_conhecimento a, autores au, autores_livros al, prateleiras p WHERE (al.autor=au.id AND al.livro=l.id) AND l.area_do_conhecimento=a.id AND l.prateleira=p.id AND l.pessoa=" . $pessoa . " ORDER BY titulo LIMIT $primeiroRegistro, $qtdRegistros";
        return $bd->executarSQL($sql, 'Livros');
    }
    
     public static function existePrateleiraEmLivros($prateleira, $pessoa) {
        $bd = new Banco(BANCO_HOST, BANCO_USUARIO, BANCO_SENHA, BANCO_BASE_DADOS);
        $sql = "SELECT * FROM livros WHERE prateleira=$prateleira AND pessoa=$pessoa";
        return $bd->executarSQL($sql, 'Livros');
    }

    public static function existePessoaEmLivros($pessoa) {
        $bd = new Banco(BANCO_HOST, BANCO_USUARIO, BANCO_SENHA, BANCO_BASE_DADOS);
        $sql = "SELECT * FROM livros WHERE pessoa=$pessoa";
        return $bd->executarSQL($sql, 'Livros');
    }
    
    public static function buscarLivrosPessoaId($pessoa) {
        $bd = new Banco(BANCO_HOST, BANCO_USUARIO, BANCO_SENHA, BANCO_BASE_DADOS);
        $sql = "SELECT id, titulo FROM livros WHERE pessoa=" . $pessoa;
        return $bd->executarSQL($sql, 'Livros');
    }

    public static function getNumPaginas($pessoa, $qtdRegistros) {
        $bd = new Banco(BANCO_HOST, BANCO_USUARIO, BANCO_SENHA, BANCO_BASE_DADOS);
        $sql = "SELECT CEIL(COUNT(id) / $qtdRegistros) AS paginas FROM livros WHERE pessoa=" . $pessoa;
        return $bd->executarSQL($sql, 'Livros');
    }

    public static function getNumPaginasString($pessoa, $qtdRegistros, $string) {
        $bd = new Banco(BANCO_HOST, BANCO_USUARIO, BANCO_SENHA, BANCO_BASE_DADOS);
        $string = $bd->real_escape_string($string);
        $sql = "SELECT CEIL(COUNT(l.id) / $qtdRegistros) AS paginas FROM livros l, areas_do_conhecimento a, prateleiras p, autores au, autores_livros al WHERE (al.autor=au.id AND al.livro=l.id) AND l.area_do_conhecimento=a.id AND l.prateleira=p.id AND l.pessoa=" . $pessoa . " AND ( LOWER(titulo) LIKE LOWER('%" . $string . "%') OR LOWER(au.nome) LIKE LOWER('%" . $string . "%') OR LOWER(a.nome) LIKE LOWER('%" . $string . "%') OR LOWER(p.nome) LIKE LOWER('%" . $string . "%') ) ";
        return $bd->executarSQL($sql, 'Livros');
    }

    public static function excluirLivro($id) {
        $bd = new Banco(BANCO_HOST, BANCO_USUARIO, BANCO_SENHA, BANCO_BASE_DADOS);
        $sql = "DELETE FROM livros WHERE id=" . $id;
        return $bd->executarSQL($sql);
    }
    
    public static function excluirAutorLivro($livro) {
        $bd = new Banco(BANCO_HOST, BANCO_USUARIO, BANCO_SENHA, BANCO_BASE_DADOS);
        $sql = "DELETE FROM autores_livros WHERE livro=" . $livro;
        return $bd->executarSQL($sql);
    }

    public static function alterarLivro($id, $titulo, $area_do_conhecimento, $prateleira, $numero_paginas, $descricao, $editora, $edicao, $isbn, $lido) {
        $bd = new Banco(BANCO_HOST, BANCO_USUARIO, BANCO_SENHA, BANCO_BASE_DADOS);
        $titulo = $bd->real_escape_string($titulo);
        $descricao = $bd->real_escape_string($descricao);
        $isbn = $bd->real_escape_string($isbn);
        $sql = "UPDATE livros set titulo='$titulo', area_do_conhecimento=$area_do_conhecimento, prateleira=$prateleira, numero_paginas=$numero_paginas, descricao='$descricao', editora='$editora', edicao=$edicao, isbn='$isbn', lido=$lido WHERE id=" . $id;
        return $bd->executarSQL($sql);
    }

    public static function alterarOnlineLivro($id, $online) {
        $bd = new Banco(BANCO_HOST, BANCO_USUARIO, BANCO_SENHA, BANCO_BASE_DADOS);
        $sql = "UPDATE livros set online=$online WHERE id=" . $id;
        return $bd->executarSQL($sql);
    }

    public static function buscarLivroOnlineAutoCompletar($string, $pessoa, $limite) {
        $bd = new Banco(BANCO_HOST, BANCO_USUARIO, BANCO_SENHA, BANCO_BASE_DADOS);
        $string = $bd->real_escape_string($string);
        $sql = "SELECT ROUND( ( ST_Distance( Point( (SELECT longitude FROM pessoas WHERE id=$pessoa), (SELECT latitude FROM pessoas WHERE id=$pessoa)),
        Point((SELECT longitude FROM pessoas WHERE id=p.id),(SELECT latitude FROM pessoas WHERE id=p.id))) * 100), 2) as distancia,
        l.id as id, l.titulo, l.pessoa, p.latitude as latitude, p.longitude as longitude FROM livros l, pessoas p WHERE
        l.pessoa=p.id AND l.online=1 AND ( LOWER(titulo) LIKE LOWER('%".$string."%') ) AND l.pessoa<>$pessoa ORDER BY distancia LIMIT $limite ";
        return $bd->executarSQL($sql, 'Livros');
    }
    
     public static function buscarLivroOnlineId($id, $pessoa) {
        $bd = new Banco(BANCO_HOST, BANCO_USUARIO, BANCO_SENHA, BANCO_BASE_DADOS);
        $sql = "SELECT ROUND( ( ST_Distance( Point( (SELECT longitude FROM pessoas WHERE id=$pessoa), (SELECT latitude FROM pessoas WHERE id=$pessoa)),
        Point((SELECT longitude FROM pessoas WHERE id=p.id),(SELECT latitude FROM pessoas WHERE id=p.id))) * 100), 2) as distancia,
        l.titulo, a.nome as autor, p.nome as pessoa, l.pessoa as id, l.imagem as imagem, l.edicao, e.nome as editora, l.numero_paginas as paginas, l.descricao as descricao FROM livros l, pessoas p, autores a, autores_livros al, editoras e WHERE
        l.pessoa=p.id AND l.online=1 AND l.editora=e.id AND l.id=al.livro AND a.id=al.autor AND l.id=".$id;
        return $bd->executarSQL($sql, 'Livros');
    }
    
    public static function getNumPaginasStringOnline($qtdRegistros, $string) {
        $bd = new Banco(BANCO_HOST, BANCO_USUARIO, BANCO_SENHA, BANCO_BASE_DADOS);
        $string = $bd->real_escape_string($string);
        $sql = "SELECT CEIL(COUNT(l.id) / $qtdRegistros) AS paginas FROM livros l WHERE LOWER(titulo) LIKE LOWER('" . $string . "%')";
        return $bd->executarSQL($sql, 'Livros');
    }

    public static function buscarLivroStringOnline($pessoa, $primeiroRegistro, $qtdRegistros, $string) {
        $bd = new Banco(BANCO_HOST, BANCO_USUARIO, BANCO_SENHA, BANCO_BASE_DADOS);
        $string = $bd->real_escape_string($string);
        $sql = "SELECT ROUND( ( ST_Distance( Point( (SELECT longitude FROM pessoas WHERE id=$pessoa), (SELECT latitude FROM pessoas WHERE id=$pessoa)),
        Point((SELECT longitude FROM pessoas WHERE id=p.id),(SELECT latitude FROM pessoas WHERE id=p.id))) * 100), 2) as distancia,
        l.titulo, a.nome as autor, p.nome as pessoa, l.pessoa as id, l.imagem as imagem, l.edicao, e.nome as editora, l.numero_paginas as paginas FROM livros l, pessoas p, autores a, autores_livros al, editoras e WHERE
        l.pessoa=p.id AND l.online=1 AND l.editora=e.id AND l.id=al.livro AND a.id=al.autor AND LOWER(l.titulo) LIKE LOWER('".$string."%') ORDER BY distancia LIMIT $primeiroRegistro, $qtdRegistros";
        return $bd->executarSQL($sql, 'Livros');
    }
    
     public static function buscarLivrosOnline($primeiroRegistro, $qtdRegistros) {
        $bd = new Banco(BANCO_HOST, BANCO_USUARIO, BANCO_SENHA, BANCO_BASE_DADOS);
        $sql = "SELECT  id, imagem FROM livros WHERE online=1 AND imagem is not NULL ORDER BY id DESC LIMIT $primeiroRegistro, $qtdRegistros";
        return $bd->executarSQL($sql, 'Livros');
    }
    
    public static function buscarLivrosOnlineAleatorio($qtdRegistros) {
        $bd = new Banco(BANCO_HOST, BANCO_USUARIO, BANCO_SENHA, BANCO_BASE_DADOS);
        $sql = "SELECT  id, imagem FROM livros WHERE online=1 AND imagem is not NULL ORDER BY RAND() LIMIT $qtdRegistros";
        return $bd->executarSQL($sql, 'Livros');
    }
    
     public static function buscarDetalheLivroId($id) {
        $bd = new Banco(BANCO_HOST, BANCO_USUARIO, BANCO_SENHA, BANCO_BASE_DADOS);
        $sql = "SELECT imagem, descricao, numero_paginas, edicao, isbn, lido, editoras.nome as editora FROM livros, editoras WHERE livros.editora=editoras.id AND livros.id=".$id;
        return $bd->executarSQL($sql, 'Livros');
    }
    
    function getImagem() {
        return $this->imagem;
    }

    function setImagem($imagem) {
        $this->imagem = $imagem;
    }
        
    function getNome_autor() {
        return $this->nome_autor;
    }

    function setNome_autor($nome_autor) {
        $this->nome_autor = $nome_autor;
    }

    function getNome_editora() {
        return $this->nome_editora;
    }

    function setNome_editora($nome_editora) {
        $this->nome_editora = $nome_editora;
    }

    function getLatitude() {
        return $this->latitude;
    }

    function getLongitude() {
        return $this->longitude;
    }

    function setLatitude($latitude) {
        $this->latitude = $latitude;
    }

    function setLongitude($longitude) {
        $this->longitude = $longitude;
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

    function getAutor() {
        return $this->autor;
    }

    function setAutor($autor) {
        $this->autor = $autor;
    }

    function getDistancia() {
        return $this->distancia;
    }

    function setDistancia($distancia) {
        $this->distancia = $distancia;
    }
    
    function getLido() {
        return $this->lido;
    }

    function setLido($lido) {
        $this->lido = $lido;
    }


    
}
