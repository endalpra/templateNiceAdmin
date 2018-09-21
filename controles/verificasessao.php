<?php
//Verifica se a sessão está ativa e se a requisição está vindo do IP que logou(evita roubo de sessão)
if (isset($_SESSION['ses-usu-id']) && ($_SESSION['ses-usu-ip'] == $_SERVER['REMOTE_ADDR'])) {
    if (isset($_SESSION['registro'])) {
        $segundos = time() - $_SESSION['registro'];
    }
    if ($segundos > $_SESSION['limite']) {
        require_once 'logout.php';        
    } else {
        $_SESSION['registro'] = time();
    }
}else{
    header("Location: ../visoes/login.php");
}


