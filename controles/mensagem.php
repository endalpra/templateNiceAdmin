<?php

require_once (__DIR__ . '/../modelos/Mensagens.php');
require_once (__DIR__ . '/../modelos/Pessoas.php');
require_once (__DIR__ . '/../bibliotecas/URL.php');
require_once (__DIR__ . '/../bibliotecas/funcoes.php');
if (URL::isPaginaAtual("mensagem.php")) {
    
    if (isset($_POST['usuarioLogado']) && is_numeric($_POST['usuarioLogado'])) {
        $usuarios = Mensagens::buscarUsuariosConversas(r_c_e($_POST['usuarioLogado']));
        $xml = "";
        $xml .= "<?xml version='1.0' encoding='UTF-8'?>";
        $xml .= "<usuarios>";
        foreach ($usuarios as $u):
            $xml .= "<usuario>";
            $xml .= "<id>" . $u->getId() . "</id>";
            $xml .= "<nome>" . $u->getNome() . "</nome>";
            $xml .= "<imagem>" . $u->getImagem() . "</imagem>";
            $xml .= "<lida>" . $u->getLida() . "</lida>";
            $xml .= "</usuario>";
        endforeach;
        $xml .= "</usuarios>";
        echo $xml;
    }
    if (isset($_POST['usuLogado']) &&  is_numeric($_POST['usuLogado']) && isset($_POST['usu2']) && is_numeric($_POST['usu2'])) {
        $mensagens = Mensagens::buscarMensagensUsuario($_POST['usuLogado'], $_POST['usu2']);
        $xml = "";
        $xml .= "<?xml version='1.0' encoding='UTF-8'?>";
        $xml .= "<mensagens>";
        foreach ($mensagens as $m):
            $d = explode(" ", $m->getData_Hora());
            $da = inverte_data($d[0], "-", "/");
            $data = $da . " " . $d[1];
            $xml .= "<mensagem>";
            $xml .= "<id>" . $m->getId() . "</id>";
            $xml .= "<conteudo>" . $m->getConteudo() . "</conteudo>";
            $xml .= "<idRemetente>" . $m->getIdRemetente() . "</idRemetente>";
            $xml .= "<nomeRemetente>" . $m->getNomeRemetente() . "</nomeRemetente>";
            $xml .= "<nomeDestinatario>" . $m->getNomeDestinatario() . "</nomeDestinatario>";
            $xml .= "<imagemRemetente>" . $m->getImagemRemetente() . "</imagemRemetente>";
            $xml .= "<imagemDestinatario>" . $m->getImagemDestinatario() . "</imagemDestinatario>";
            $xml .= "<dataHora>" . $data . "</dataHora>";
            $xml .= "<lida>" . $m->getLida() . "</lida>";
            $xml .= "</mensagem>";
        endforeach;
        $xml .= "</mensagens>";
        echo $xml;
    }
    //Gravar a msg no banco
    if (isset($_POST['msg']) && isset($_POST['remetente']) && is_numeric($_POST['remetente']) && isset($_POST['destinatario']) && is_numeric($_POST['destinatario'])) {
        $conteudo = $_POST['msg'];
        $retorno = Mensagens::verificaMensagemDia($_POST['remetente'], $_POST['destinatario']);
        $existe = $retorno[0]->getId();
        //echo $existe;
        $r = Mensagens::gravarMensagem($conteudo, $_POST['remetente'], $_POST['destinatario']);
        if ($r) {             
            if($existe==0){//Se é a 1° msg daquele rem e naquele dia, avisa por email que recebeu mensagem daquele remetente
                //Busca email do destinatario
                $rd = Pessoas::buscarPessoaId($_POST['destinatario']);
                $rm = Pessoas::buscarPessoaId($_POST['remetente']);
                $nome_remetente = $rm[0]->getNome();
                $to = $rd[0]->getEmail();
                //echo $nome_remetente;
                $subject = "Bibliotecapessoal.com";
                $msg = "Você possui nova mensagem de ".$nome_remetente.".</br></br>"
                        . "Acesse <a href='https://www.bibliotecapessoal.com'>Bibliotecapessoal.com</a> e verifique sua mensagem!";
                if(enviaEmail($to, $subject, $msg)){
                    echo 1;
                }else{
                    echo 0;
                }
            }else{
                echo 'Já possui msg para este dia';
            }            
        } else {
            echo 0;
        }
    } else//Marcar msgs como lida 
    if (isset($_POST['remetente']) && is_numeric($_POST['remetente']) && isset($_POST['destinatario']) && is_numeric($_POST['destinatario'])) {
        $r = Mensagens::setarMensagemLida($_POST['remetente'], $_POST['destinatario']);
        if ($r) {
            echo 1;
        } else {
            echo 0;
        }
    }
    //Baixa as msgs não lidas
    if (isset($_POST['rem']) && is_numeric($_POST['rem']) && isset($_POST['dest']) && is_numeric($_POST['dest'])) {
        $mensagens = Mensagens::baixarMensagemNaoLida($_POST['rem'], $_POST['dest']);
        $xml = "";
        $xml .= "<?xml version='1.0' encoding='UTF-8'?>";
        $xml .= "<mensagens>";
        foreach ($mensagens as $m):
            $d = explode(" ", $m->getData_Hora());
            $da = inverte_data($d[0], "-", "/");
            $data = $da . " " . $d[1];
            $xml .= "<mensagem>";
            $xml .= "<id>" . $m->getId() . "</id>";
            $xml .= "<conteudo>" . $m->getConteudo() . "</conteudo>";
            $xml .= "<idRemetente>" . $m->getIdRemetente() . "</idRemetente>";
            $xml .= "<nomeRemetente>" . $m->getNomeRemetente() . "</nomeRemetente>";
            $xml .= "<nomeDestinatario>" . $m->getNomeDestinatario() . "</nomeDestinatario>";
            $xml .= "<imagemRemetente>" . $m->getImagemRemetente() . "</imagemRemetente>";
            $xml .= "<imagemDestinatario>" . $m->getImagemDestinatario() . "</imagemDestinatario>";
            $xml .= "<dataHora>" . $data . "</dataHora>";
            $xml .= "<lida>" . $m->getLida() . "</lida>";
            $xml .= "</mensagem>";
        endforeach;
        $xml .= "</mensagens>";
        echo $xml;
    }
    if (isset($_POST['destinatarioTotalMsg']) && is_numeric($_POST['destinatarioTotalMsg'])) {
        $r = Mensagens::totalMensagensNaoLidas( $_POST['destinatarioTotalMsg']  );
        $rn = Pessoas::buscarNotificacaoPessoa( $_POST['destinatarioTotalMsg'] );
        $num_Msg = $r[0]->getId();
        $num_Ntf = $rn[0]->getId();
        echo $num_Msg . ',' . $num_Ntf;
    }
}
