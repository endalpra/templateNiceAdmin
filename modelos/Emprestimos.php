<?php

require_once (__DIR__ . '/../bibliotecas/Configuracao.php');
require_once (__DIR__ . '/../bibliotecas/Banco.php');

class Emprestimos {

    private $id;
    private $livro;
    private $pessoa_emprestou;
    private $id_pessoa_emprestou;
    private $idpessoa;
    private $data;
    private $data_prevista;
    private $data_devolucao;
    private $data_review;
    private $observacao;
    private $descricao;
    private $id_livro;

    public static function gerarEmprestimo($titulo, $pessoa, $data, $data_prevista, $observacao) {
        $bd = new Banco(BANCO_HOST, BANCO_USUARIO, BANCO_SENHA, BANCO_BASE_DADOS);
        $titulo = $bd->real_escape_string($titulo);
        $data = $bd->real_escape_string($data);
        $data_prevista = $bd->real_escape_string($data_prevista);
        $observacao = $bd->real_escape_string($observacao);
        $sql = "INSERT INTO emprestimos(livro,pessoa_emprestou,data,data_prevista,observacao) VALUES($titulo,$pessoa,'$data','$data_prevista','$observacao') ";
        return $bd->executarSQL($sql);
    }

    public static function buscarEmprestimosPendentes($pessoa) {
        $bd = new Banco(BANCO_HOST, BANCO_USUARIO, BANCO_SENHA, BANCO_BASE_DADOS);
        $sql = "SELECT e.id as id, e.livro as id_livro, l.titulo as livro,  p.nome as pessoa_emprestou, p.id as id_pessoa_emprestou, e.data as data, e.data_prevista as data_prevista, e.data_devolucao as data_devolucao, e.observacao as observacao, e.pessoa_emprestou as id_pessoa_emprestou  FROM emprestimos e, pessoas p, livros l WHERE e.livro=l.id AND p.id=e.pessoa_emprestou AND l.pessoa='$pessoa' AND e.data_devolucao IS NULL ORDER BY e.data_prevista";
        return $bd->executarSQL($sql, 'Emprestimos');
    }

    public static function buscarEmprestimosFinalizados($pessoa) {
        $bd = new Banco(BANCO_HOST, BANCO_USUARIO, BANCO_SENHA, BANCO_BASE_DADOS);
        $sql = "SELECT e.id as id, e.livro as id_livro, l.titulo as livro,  p.nome as pessoa_emprestou, p.id as id_pessoa_emprestou, e.data as data, e.data_prevista as data_prevista, e.data_devolucao as data_devolucao, e.observacao as observacao, e.pessoa_emprestou as id_pessoa_emprestou  FROM emprestimos e, pessoas p, livros l WHERE e.livro=l.id AND p.id=e.pessoa_emprestou AND l.pessoa='$pessoa' AND e.data_devolucao IS NOT NULL ORDER BY e.data_devolucao DESC";
        return $bd->executarSQL($sql, 'Emprestimos');
    }

    public static function buscarEmprestimoId($id) {
        $bd = new Banco(BANCO_HOST, BANCO_USUARIO, BANCO_SENHA, BANCO_BASE_DADOS);
        $sql = "SELECT * FROM emprestimos WHERE id=" . $id;
        return $bd->executarSQL($sql, 'Emprestimos');
    }

    public static function buscarEmprestimosObtidosPendentes($pessoa) {
        $bd = new Banco(BANCO_HOST, BANCO_USUARIO, BANCO_SENHA, BANCO_BASE_DADOS);
        $sql = "SELECT e.id as id, p.id as idpessoa, l.titulo as livro, p.nome as pessoa_emprestou, p.id as id_pessoa_emprestou, e.data as data, e.data_prevista as data_prevista, e.data_devolucao as data_devolucao, e.observacao as observacao FROM emprestimos e, livros l, pessoas p WHERE e.livro=l.id AND p.id=l.pessoa AND e.pessoa_emprestou='$pessoa' AND e.data_devolucao IS NULL ORDER BY e.data_prevista";
        return $bd->executarSQL($sql, 'Emprestimos');
    }

    public static function buscarEmprestimosObtidosFinalizados($pessoa) {
        $bd = new Banco(BANCO_HOST, BANCO_USUARIO, BANCO_SENHA, BANCO_BASE_DADOS);
        $sql = "SELECT e.id as id, p.id as idpessoa, l.titulo as livro, p.nome as pessoa_emprestou, p.id as id_pessoa_emprestou, e.data as data, e.data_prevista as data_prevista, e.data_devolucao as data_devolucao, e.observacao as observacao FROM emprestimos e, livros l, pessoas p WHERE e.livro=l.id AND p.id=l.pessoa AND e.pessoa_emprestou='$pessoa' AND e.data_devolucao IS NOT NULL ORDER BY e.data_devolucao DESC";
        return $bd->executarSQL($sql, 'Emprestimos');
    }

    public static function devolver($id, $data, $descricao) {
        $bd = new Banco(BANCO_HOST, BANCO_USUARIO, BANCO_SENHA, BANCO_BASE_DADOS);
        $data = $bd->real_escape_string($data);
        $descricao = $bd->real_escape_string($descricao);
        $sql = "UPDATE emprestimos SET data_sistema=(SELECT DATE_SUB(NOW(),INTERVAL 2 HOUR)), data_devolucao='" . $data . "', descricao='" . $descricao . "' WHERE id=" . $id;
        return $bd->executarSQL($sql);
    }

    public static function naoDevolver($id, $data_review, $descricao) {
        $bd = new Banco(BANCO_HOST, BANCO_USUARIO, BANCO_SENHA, BANCO_BASE_DADOS);
        $data_review = $bd->real_escape_string($data_review);
        $descricao = $bd->real_escape_string($descricao);
        $sql = "UPDATE emprestimos SET data_sistema=(SELECT DATE_SUB(NOW(),INTERVAL 2 HOUR)), data_review='" . $data_review . "', descricao='" . $descricao . "' WHERE id=" . $id;
        return $bd->executarSQL($sql);
    }

    public static function existeLivroEmEmprestimos($livro) {
        $bd = new Banco(BANCO_HOST, BANCO_USUARIO, BANCO_SENHA, BANCO_BASE_DADOS);
        $sql = "SELECT * FROM emprestimos WHERE livro=$livro";
        return $bd->executarSQL($sql, 'Emprestimos');
    }

    function getId_pessoa_emprestou() {
        return $this->id_pessoa_emprestou;
    }

    function setId_pessoa_emprestou($id_pessoa_emprestou) {
        $this->id_pessoa_emprestou = $id_pessoa_emprestou;
    }

    function getId_livro() {
        return $this->id_livro;
    }

    function setId_livro($id_livro) {
        $this->id_livro = $id_livro;
    }

    function getIdpessoa() {
        return $this->idpessoa;
    }

    function setIdpessoa($idpessoa) {
        $this->idpessoa = $idpessoa;
    }

    function getId() {
        return $this->id;
    }

    function getLivro() {
        return $this->livro;
    }

    function getPessoa_emprestou() {
        return $this->pessoa_emprestou;
    }

    function getData() {
        return $this->data;
    }

    function getData_prevista() {
        return $this->data_prevista;
    }

    function getData_devolucao() {
        return $this->data_devolucao;
    }

    function getObservacao() {
        return $this->observacao;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setLivro($livro) {
        $this->livro = $livro;
    }

    function setPessoa_emprestou($pessoa_emprestou) {
        $this->pessoa_emprestou = $pessoa_emprestou;
    }

    function setData($data) {
        $this->data = $data;
    }

    function setData_prevista($data_prevista) {
        $this->data_prevista = $data_prevista;
    }

    function setData_devolucao($data_devolucao) {
        $this->data_devolucao = $data_devolucao;
    }

    function setObservacao($observacao) {
        $this->observacao = $observacao;
    }

    function getData_review() {
        return $this->data_review;
    }

    function getDescricao() {
        return $this->descricao;
    }

    function setData_review($data_review) {
        $this->data_review = $data_review;
    }

    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

}
