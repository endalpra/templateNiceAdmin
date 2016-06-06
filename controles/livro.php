<?php

require_once (__DIR__ . '/../bibliotecas/URL.php');
require_once (__DIR__ . '/../modelos/Livros.php');
require_once (__DIR__ . '/../modelos/Areas_do_conhecimento.php');
require_once (__DIR__ . '/../modelos/Prateleiras.php');

if (URL::isPaginaAtual("cadastrarlivro.php")) {
    $areas_do_conhecimento = Areas_do_conhecimento::buscarTodasAreas_do_conhecimento();
    $prateleiras = Prateleiras::buscarTodasPrateleirasPessoa($_SESSION['ses-usu-id']);
    if (isset($_POST['titulo']) && isset($_POST['area_do_conhecimento']) && isset($_POST['prateleira']) && isset($_POST['pessoa']) && isset($_POST['online']) && !empty($_POST['titulo']) && !empty($_POST['area_do_conhecimento']) && !empty($_POST['prateleira']) && !empty($_POST['pessoa']) && !empty($_POST['online'])) {
        $titulo = $_POST['titulo'];
        $area_do_conhecimento = $_POST['area_do_conhecimento'];
        $prateleira = $_POST['prateleira'];
        $pessoa = $_POST['pessoa'];

        if ($_POST['online'] == "sim") {
            $online = 1;
        } else {
            $online = 0;
        }
        if (!empty($_POST['numero_paginas'])) {
            $numero_paginas = $_POST['numero_paginas'];
        } else {
            $numero_paginas = "";
        }
        if (!empty($_POST['descricao'])) {
            $descricao = $_POST['descricao'];
        } else {
            $descricao = "";
        }
        if (!empty($_POST['autor'])) {
            $autor = $_POST['autor'];
        } else {
            $autor = "";
        }
        if (!empty($_POST['editora'])) {
            $editora = $_POST['editora'];
        } else {
            $editora = "";
        }
        if (!empty($_POST['edicao'])) {
            $edicao = $_POST['edicao'];
        } else {
            $edicao = "0";
        }
        if (!empty($_POST['isbn'])) {
            $isbn = $_POST['isbn'];
        } else {
            $isbn = "";
        }

        //Verifica se título já não está registrado

        $retorno = Livros::cadastrarLivro($titulo, $area_do_conhecimento, $prateleira, $pessoa, $numero_paginas, $descricao, $autor, $editora, $edicao, $isbn, $online);
        if ($retorno) {
            $msg = 1;
        } else {
            $msg = 0;
        }
    } else {
        $msgErro = "Preencha os campos obrigatórios *";
    }

//Listar livros com ajax
} else if (URL::isPaginaAtual("livro.php")) {
    if (isset($_POST['pessoa']) && isset($_POST['pagina'])) {
        $pessoa = $_POST['pessoa'];
        $pagina = $_POST['pagina'];
        
        //Se está setado o campo quantidade -> de registros por página 
        if(isset($_POST['quantidade']) && $_POST['quantidade']!=0 && !empty($_POST['quantidade'])){
            $qtdRegistros = $_POST['quantidade'];
        }  else {
            $qtdRegistros = QTD_PAG_LIVRO;
        } 
        $qtdPaginas = Livros::getNumPaginas($pessoa, $qtdRegistros);
        $primeiroRegistro = $pagina * $qtdRegistros;
        
        //Se está setado o campo título pesquisa pelo título e pela pessoa
        if(isset($_POST['titulo']) && $_POST['titulo']!="0" && !empty($_POST['titulo'])){
            $titulo = $_POST['titulo'];
            $livros = Livros::buscarLivroTitulo($pessoa, $primeiroRegistro, $qtdRegistros, $titulo);
//            if(count($livros) < $qtdPaginas)
//                $qtdPaginas = count($livros);
        //Se não está setado o campo título pesquisa pela pessoa
        }else{
         $livros = Livros::buscarLivrosPessoa($pessoa, $primeiroRegistro, $qtdRegistros);
        }
        $xml = "";
        $xml .= "<?xml version='1.0' encoding='UTF-8'?>";
        $xml .= "<livros>";
        foreach ($livros as $l):
            $xml .= "<livro>";
            $xml .= "<id>" . $l->getId() . "</id>";
            $xml .= "<titulo>" . $l->getTitulo() . "</titulo>";
            $xml .= "<autor>" . $l->getAutor() . "</autor>";
            $xml .= "<area_do_conhecimento>" . $l->getArea_do_conhecimento() . "</area_do_conhecimento>";
            $xml .= "<prateleira>" . $l->getPrateleira() . "</prateleira>";
            $xml .= "<online>" . $l->getOnline() . "</online>";
            $xml .= "</livro>";
        endforeach;
        $xml .= "<qtdPaginas>" . $qtdPaginas[0]->getPaginas() . "</qtdPaginas>";
        $xml .= "</livros>";
        echo $xml;
        
    //Excluir livros com ajax
    }else if (isset($_POST['id'])) {
        $id = $_POST['id'];
        $retorno = Livros::excluirLivro($id);
        if ($retorno) {
            echo $id;
        } else {
            echo "0";
        }
        
    //Muda a coluna "online" na tabela livros
    }else if (isset($_POST['id_online'])) {
        $id = $_POST['id_online'];
        $online = Livros::buscarLivroId($id);
        $on = $online[0]->getOnline();
        //Se online==true inverte para false | online==false inverte para true
        if($on==1){
            $on = 0;
        }else{
            $on = 1;
        }       
        $retorno = Livros::alterarOnlineLivro($id, $on);
        echo $retorno;
    }
} 

