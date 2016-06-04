<?php
require_once (__DIR__ .'/../bibliotecas/URL.php');
require_once (__DIR__ .'/../modelos/Livros.php');
require_once (__DIR__ .'/../modelos/Areas_do_conhecimento.php');
require_once (__DIR__ .'/../modelos/Prateleiras.php');

if(URL::isPaginaAtual("cadastrarlivro.php")){
    $areas_do_conhecimento = Areas_do_conhecimento::buscarTodasAreas_do_conhecimento();
    $prateleiras = Prateleiras::buscarTodasPrateleirasPessoa($_SESSION['ses-usu-id']);
    if(isset($_POST['titulo']) && isset($_POST['area_do_conhecimento'])  && isset($_POST['prateleira']) && isset($_POST['pessoa']) && isset($_POST['online']) && !empty($_POST['titulo']) && !empty($_POST['area_do_conhecimento']) && !empty($_POST['prateleira']) && !empty($_POST['pessoa']) && !empty($_POST['online'])){
        $titulo = $_POST['titulo'];
        $area_do_conhecimento = $_POST['area_do_conhecimento'];
        $prateleira = $_POST['prateleira'];
        $pessoa = $_POST['pessoa'];
        
       if ($_POST['online'] == "sim") {
            $online = 1;
        } else {
            $online = 0;
        }        
        if(!empty($_POST['numero_paginas'])){
            $numero_paginas = $_POST['numero_paginas'];
        }else{
            $numero_paginas = "";
        }
        if(!empty($_POST['descricao'])){
            $descricao = $_POST['descricao'];
        }else{
            $descricao = "";
        }
        if(!empty($_POST['autor'])){
            $autor = $_POST['autor'];
        }else{
            $autor = "";
        }
        if(!empty($_POST['editora'])){
            $editora = $_POST['editora'];
        }else{
            $editora = "";
        }
        if(!empty($_POST['edicao'])){
            $edicao = $_POST['edicao'];
        }else{
            $edicao = "0";
        }
        if(!empty($_POST['isbn'])){
            $isbn = $_POST['isbn'];
        }else{
            $isbn = "";
        }
        
        //Verifica se título já não está registrado
        
        $retorno = Livros::cadastrarLivro($titulo, $area_do_conhecimento, $prateleira, $pessoa, $numero_paginas, $descricao, $autor, $editora, $edicao, $isbn, $online);
        if($retorno){
            $msg = 1;
        }else{
            $msg = 0;
        }
        
    }else{
        $msgErro = "Preencha os campos obrigatórios *";
    }   
}

