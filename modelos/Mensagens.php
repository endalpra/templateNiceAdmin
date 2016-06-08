<?php
require_once (__DIR__ . '/../bibliotecas/Configuracao.php');
require_once (__DIR__ . '/../bibliotecas/Banco.php');


class Mensagens {

    private $conteudo;
    private $remetente;
    private $destinatario;
    
    public static function gravarMensagem($conteudo, $remetente, $destinatario) {
        $bd = new Banco(BANCO_HOST, BANCO_USUARIO, BANCO_SENHA, BANCO_BASE_DADOS);
        $sql = "INSERT INTO mensagens(conteudo, remetente, destinatario) VALUES('$conteudo',$remetente,$destinatario) ";
        return $bd->executarSQL($sql);
    }
    
    function getConteudo() {
        return $this->conteudo;
    }

    function getRemetente() {
        return $this->remetente;
    }

    function getDestinatario() {
        return $this->destinatario;
    }

    function setConteudo($conteudo) {
        $this->conteudo = $conteudo;
    }

    function setRemetente($remetente) {
        $this->remetente = $remetente;
    }

    function setDestinatario($destinatario) {
        $this->destinatario = $destinatario;
    }


}