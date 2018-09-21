<?php

require_once (__DIR__ . '/../bibliotecas/Configuracao.php');
require_once (__DIR__ . '/../bibliotecas/Banco.php');

class Mensagens {

    private $id;
    private $conteudo;
    private $nomeRemetente;
    private $nomeDestinatario;
    private $data_hora;
    private $imagemRemetente;
    private $imagemDestinatario;
    private $nome;
    private $imagem;
    private $lida;
    private $idRemetente;
    
    public static function gravarMensagem($conteudo, $remetente, $destinatario) {
        $bd = new Banco(BANCO_HOST, BANCO_USUARIO, BANCO_SENHA, BANCO_BASE_DADOS);
        $conteudo = $bd->real_escape_string($conteudo);
        $sql = "INSERT INTO mensagens(conteudo, remetente, destinatario, data_hora) VALUES('$conteudo',$remetente,$destinatario,(SELECT DATE_SUB(NOW(),INTERVAL 2 HOUR))) ";
        return $bd->executarSQL($sql);
    }

    public static function totalMensagensNaoLidas($usuario) {
        $bd = new Banco(BANCO_HOST, BANCO_USUARIO, BANCO_SENHA, BANCO_BASE_DADOS);
        $sql = "SELECT COUNT(id) as id FROM `mensagens` WHERE lida=0 AND destinatario=".$usuario;
        return $bd->executarSQL($sql, 'Mensagens');
    }
    
     public static function buscarMensagensUsuario($usuario1, $usuario2) {
        $bd = new Banco(BANCO_HOST, BANCO_USUARIO, BANCO_SENHA, BANCO_BASE_DADOS);
        $sql = "SELECT m.id as id, m.lida as lida, m.conteudo as conteudo, m.data_hora as data_hora, p1.nome as nomeRemetente, p1.id as idRemetente, p1.imagem as imagemRemetente, p2.nome as nomeDestinatario, p2.imagem as imagemDestinatario FROM mensagens m, pessoas p1, pessoas p2 WHERE p1.id=m.remetente AND p2.id=m.destinatario AND ((remetente=$usuario1 and destinatario=$usuario2) OR (remetente=$usuario2 and destinatario=$usuario1)) ORDER BY m.data_hora";
        return $bd->executarSQL($sql, 'Mensagens');
    }
        
     public static function buscarUsuariosConversas($usuario) {
        $bd = new Banco(BANCO_HOST, BANCO_USUARIO, BANCO_SENHA, BANCO_BASE_DADOS);
        $sql = "SELECT mensagens.remetente as id_remetente, mensagens.destinatario as id_destinatario, mensagens.lida as lida, MAX(mensagens.data_hora) as data_ultima_msg, pessoas.id as id, pessoas.nome as nome, pessoas.imagem as imagem FROM pessoas, mensagens WHERE (mensagens.remetente=pessoas.id OR mensagens.destinatario=pessoas.id) AND (mensagens.destinatario=$usuario OR mensagens.remetente=$usuario) AND pessoas.id NOT IN (SELECT pessoas.id FROM pessoas WHERE pessoas.id =$usuario) GROUP BY id ORDER BY data_ultima_msg DESC ";
        return $bd->executarSQL($sql, 'Mensagens');
    }

     public static function verificaMensagemDia($remetente, $destinatario) {
        $bd = new Banco(BANCO_HOST, BANCO_USUARIO, BANCO_SENHA, BANCO_BASE_DADOS);
        $sql = "SELECT COUNT(*) as id FROM mensagens WHERE (remetente=$remetente AND destinatario=$destinatario) AND ( date(data_hora) = date(DATE_SUB(NOW(),INTERVAL 2 HOUR)) ) ";
        return $bd->executarSQL($sql, 'Mensagens');
    }
    
    public static function setarMensagemLida($remetente, $destinatario) {
        $bd = new Banco(BANCO_HOST, BANCO_USUARIO, BANCO_SENHA, BANCO_BASE_DADOS);
        $sql = "UPDATE mensagens SET lida=1 WHERE destinatario=$destinatario AND remetente=$remetente";
        return $bd->executarSQL($sql);
    }
    
     public static function baixarMensagemNaoLida($usuario1, $usuario2) {
        $bd = new Banco(BANCO_HOST, BANCO_USUARIO, BANCO_SENHA, BANCO_BASE_DADOS);
        $sql = "SELECT m.id as id, m.lida as lida, m.conteudo as conteudo, m.data_hora as data_hora, p1.nome as nomeRemetente, p1.id as idRemetente, p1.imagem as imagemRemetente, p2.nome as nomeDestinatario, p2.imagem as imagemDestinatario FROM mensagens m, pessoas p1, pessoas p2 WHERE p1.id=m.remetente AND p2.id=m.destinatario AND ((remetente=$usuario1 and destinatario=$usuario2) OR (remetente=$usuario2 and destinatario=$usuario1)) AND m.lida=0 ORDER BY m.data_hora";
        return $bd->executarSQL($sql, 'Mensagens');
    }
    
    function getId() {
        return $this->id;
    }

    function getConteudo() {
        return $this->conteudo;
    }

    function getNomeRemetente() {
        return $this->nomeRemetente;
    }

    function getNomeDestinatario() {
        return $this->nomeDestinatario;
    }

    function getData_hora() {
        return $this->data_hora;
    }

    function getImagemRemetente() {
        return $this->imagemRemetente;
    }

    function getImagemDestinatario() {
        return $this->imagemDestinatario;
    }

    function getNome() {
        return $this->nome;
    }

    function getImagem() {
        return $this->imagem;
    }

    function getLida() {
        return $this->lida;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setConteudo($conteudo) {
        $this->conteudo = $conteudo;
    }

    function setNomeRemetente($nomeRemetente) {
        $this->nomeRemetente = $nomeRemetente;
    }

    function setNomeDestinatario($nomeDestinatario) {
        $this->nomeDestinatario = $nomeDestinatario;
    }

    function setData_hora($data_hora) {
        $this->data_hora = $data_hora;
    }

    function setImagemRemetente($imagemRemetente) {
        $this->imagemRemetente = $imagemRemetente;
    }

    function setImagemDestinatario($imagemDestinatario) {
        $this->imagemDestinatario = $imagemDestinatario;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setImagem($imagem) {
        $this->imagem = $imagem;
    }

    function setLida($lida) {
        $this->lida = $lida;
    }

    function getIdRemetente() {
        return $this->idRemetente;
    }

    function setIdRemetente($idRemetente) {
        $this->idRemetente = $idRemetente;
    }


}
