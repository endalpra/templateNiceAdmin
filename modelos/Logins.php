<?php

require_once (__DIR__ . '/../bibliotecas/Configuracao.php');
require_once (__DIR__ . '/../bibliotecas/Banco.php');

class Logins {

    private $id;
    private $nome;
    private $email;
    private $login;
    private $senha;
    private $facebook;
    private $whatsapp;
    private $cidade;
    private $estado;
    private $pais;
    private $confiabilidade;
    private $latitude;
    private $longitude;
    private $imagem;

    public static function getPessoa($login, $senha) {
        $bd = new Banco(BANCO_HOST, BANCO_USUARIO, BANCO_SENHA, BANCO_BASE_DADOS);
        $login = $bd->real_escape_string($login);
        $senha = sha1( $bd->real_escape_string($senha) );
        $sql = "SELECT id, nome, imagem FROM pessoas where login='" . $login . "' AND senha='" . $senha . "' ";

        return $bd->executarSQL($sql, 'Logins');
    }

    public static function getEmailPessoa($login) {
        $bd = new Banco(BANCO_HOST, BANCO_USUARIO, BANCO_SENHA, BANCO_BASE_DADOS);
        $login = $bd->real_escape_string($login);
        $sql = "SELECT email, nome FROM pessoas WHERE login='" . $login . "'";

        return $bd->executarSQL($sql, 'Logins');
    }
    
    function getImagem() {
        return $this->imagem;
    }

    function setImagem($imagem) {
        $this->imagem = $imagem;
    }
    
    function getId() {
        return $this->id;
    }

    function getNome() {
        return $this->nome;
    }

    function getEmail() {
        return $this->email;
    }

    function getLogin() {
        return $this->login;
    }

    function getSenha() {
        return $this->senha;
    }

    function getFacebook() {
        return $this->facebook;
    }

    function getWhatsapp() {
        return $this->whatsapp;
    }

    function getCidade() {
        return $this->cidade;
    }

    function getEstado() {
        return $this->estado;
    }

    function getPais() {
        return $this->pais;
    }

    function getConfiabilidade() {
        return $this->confiabilidade;
    }

    function getLatitude() {
        return $this->latitude;
    }

    function getLongitude() {
        return $this->longitude;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setLogin($login) {
        $this->login = $login;
    }

    function setSenha($senha) {
        $this->senha = $senha;
    }

    function setFacebook($facebook) {
        $this->facebook = $facebook;
    }

    function setWhatsapp($whatsapp) {
        $this->whatsapp = $whatsapp;
    }

    function setCidade($cidade) {
        $this->cidade = $cidade;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }

    function setPais($pais) {
        $this->pais = $pais;
    }

    function setConfiabilidade($confiabilidade) {
        $this->confiabilidade = $confiabilidade;
    }

    function setLatitude($latitude) {
        $this->latitude = $latitude;
    }

    function setLongitude($longitude) {
        $this->longitude = $longitude;
    }

}
