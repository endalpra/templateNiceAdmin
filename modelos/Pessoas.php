<?php

require_once (__DIR__ . '/../bibliotecas/Configuracao.php');
require_once (__DIR__ . '/../bibliotecas/Banco.php');

class Pessoas {

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

    public static function cadastrarPessoa($nome, $email, $login, $senha, $facebook, $whatsapp, $cidade, $estado, $pais, $latitude, $longitude) {
        $bd = new Banco(BANCO_HOST, BANCO_USUARIO, BANCO_SENHA, BANCO_BASE_DADOS);
        $sql = "INSERT INTO pessoas(nome,email,login,senha,facebook,whatsapp,cidade,estado,pais,latitude,longitude) VALUES('$nome','$email','$login','$senha', '$facebook','$whatsapp','$cidade','$estado','$pais','$latitude','$longitude')";
        return $bd->executarSQL($sql);
    }
    
     public static function buscarPessoaId($id){
        $bd = new Banco(BANCO_HOST, BANCO_USUARIO, BANCO_SENHA, BANCO_BASE_DADOS);
        $sql = "SELECT * FROM pessoas WHERE id=".$id;
        return $bd->executarSQL($sql, 'Pessoas');
    }

    function getId() {
        return $this->id;
    }

    function setId($id) {
        $this->id = $id;
    }

    function getLogin() {
        return $this->login;
    }

    function getSenha() {
        return $this->senha;
    }

    function setLogin($login) {
        $this->login = $login;
    }

    function setSenha($senha) {
        $this->senha = $senha;
    }

    function getNome() {
        return $this->nome;
    }

    function getEmail() {
        return $this->email;
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

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setEmail($email) {
        $this->email = $email;
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
