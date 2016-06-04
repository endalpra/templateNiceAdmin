<?php
session_start();
require_once (__DIR__ . '/../modelos/Pessoas.php');
require_once (__DIR__ . '/../modelos/Logins.php');
require_once (__DIR__ . '/../bibliotecas/URL.php');

if (URL::isPaginaAtual("login.php")) {
    if (isset($_POST['login']) and isset($_POST['senha'])) {
        $c = array('=', ',','\'', ';', '-', '//', '@', '#');
        $login = $_POST['login'];
        $senha = $_POST['senha'];
        foreach ($c as $v) {
            $login = str_replace($v, '', $login);
            $senha = str_replace($v, '', $senha);
        }
      $dados = Logins::getPessoa($login, $senha);  
    }    
    if(!empty($dados)){
        $p = $dados[0];
        $_SESSION['ses-usu-id'] = $p->getId();
        $_SESSION['ses-usu-nome'] = $p->getNome();
        
        echo "<script>window.location.href = 'index.php'</script>";
    }else{
        echo 'Dados inválidos!!!';
    }
}

