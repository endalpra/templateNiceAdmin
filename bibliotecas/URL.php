<?php
require_once(__DIR__.'/../bibliotecas/Configuracao.php'); 

class URL
{
    public static function getPaginaAtual()
    {
        $URI = $_SERVER['REQUEST_URI'];
        $URLNavegador = parse_url($URI, PHP_URL_PATH);
        $partes = explode('/', $URLNavegador);
        
        $arquivoPHP = $partes[sizeof($partes)-1];
        if (strlen($arquivoPHP) > 4 && substr($arquivoPHP, -4) == ".php")
            return $arquivoPHP;
        else
            return "index.php";
        

    }
    
    public static function isPaginaAtual($pagina)
    {
        if (URL::getPaginaAtual() == $pagina)
            return true;
        else
            return false;

    }
    
    
    function redirecionar($novaURL, $permanente = false)
    {
        header('Location: ' . $novaURL, true, $permanente ? 301 : 302);
        die();
    }

}
?>