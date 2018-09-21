<?php

require_once (__DIR__ . '/../modelos/Pessoas.php');
require_once (__DIR__ . '/../modelos/Livros.php');
require_once (__DIR__ . '/../modelos/Logins.php');
//require_once (__DIR__ . '/../bibliotecas/funcoes.php');
require_once (__DIR__ . '/../bibliotecas/URL.php');

if (URL::isPaginaAtual("login.php")) {
    $livros = Livros::buscarLivrosOnlineAleatorio(QTD_LIVROS_LOGIN);    
    
    if (isset($_POST['login']) and isset($_POST['senha']) and !empty($_POST['login']) and !empty($_POST['senha'])) {
        $login = $_POST['login'];
        $senha = $_POST['senha'];
        
        $dados = Logins::getPessoa($login, $senha);
        
        if (!empty($dados)) {
        $p = $dados[0];
        $_SESSION['ses-usu-id'] = $p->getId();
        $_SESSION['ses-usu-nome'] = $p->getNome();
        $_SESSION['registro'] = time();
        $_SESSION['limite'] = TEMPO_SESSAO_ON;
        $_SESSION['ses-usu-ip'] = $_SERVER['REMOTE_ADDR'];
        if ($p->getImagem() != "") {
            $_SESSION['ses-usu-img'] = $p->getImagem();
        } else {
            $_SESSION['ses-usu-img'] = "";
        }
        require_once (__DIR__.'/acesso.php');
        echo "<script>window.location.href = 'index.php'</script>";
    } else {
        $msgErro = 11;     
    }
    }
    
}
?>