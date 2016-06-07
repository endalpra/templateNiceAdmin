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
            $numero_paginas = 0;
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
            $edicao = 0;
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

}else if(URL::isPaginaAtual("editarlivro.php")){
    //Carrega os dados
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $pessoa = $_SESSION['ses-usu-id'];
        $areas_do_conhecimento = Areas_do_conhecimento::buscarTodasAreas_do_conhecimento();
        $prateleiras = Prateleiras::buscarTodasPrateleirasPessoa($pessoa);
        //Passar a pessoa para que não seja possível acessar outros registros modificando o id na url
        $livros = Livros::buscarLivroId($id, $pessoa);        
    
    //Salva os dados
    }else{    
        if (isset($_POST['titulo']) && isset($_POST['area_do_conhecimento']) && isset($_POST['prateleira']) && !empty($_POST['titulo']) && !empty($_POST['area_do_conhecimento']) && !empty($_POST['prateleira'])) {
        $id = $_POST['id'];
        $titulo = $_POST['titulo'];
        $area_do_conhecimento = $_POST['area_do_conhecimento'];
        $prateleira = $_POST['prateleira'];
  
        if (!empty($_POST['numero_paginas'])) {
            $numero_paginas = $_POST['numero_paginas'];
        } else {
            $numero_paginas = 0;
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
            $edicao = 0;
        }
        if (!empty($_POST['isbn'])) {
            $isbn = $_POST['isbn'];
        } else {
            $isbn = "";
        }

        //Verifica se título já não está registrado

        $retorno = Livros::alterarLivro($id, $titulo, $area_do_conhecimento, $prateleira, $numero_paginas, $descricao, $autor, $editora, $edicao, $isbn);
        if ($retorno) {
            $msg = 1;
        } else {
            $msg = 0;
        }
    } else {
        $msgErro = "Preencha os campos obrigatórios *";
    }
    }
    
//Listar livros com ajax
} else if (URL::isPaginaAtual("livro.php")) {
    if (isset($_POST['pessoa']) && isset($_POST['pagina'])) {
        $pessoa = $_POST['pessoa'];
        $pagina = $_POST['pagina'];

        //Se está setado o campo quantidade -> de registros por página 
        if (isset($_POST['quantidade']) && $_POST['quantidade'] != 0 && !empty($_POST['quantidade'])) {
            $qtdRegistros = $_POST['quantidade'];
        } else {
            $qtdRegistros = QTD_PAG_LIVRO;
        }
        //Pega número de páginas contabilizando todos os registros dividido pela qtd de registros por página
        $qtdPaginas = Livros::getNumPaginas($pessoa, $qtdRegistros);
        $primeiroRegistro = $pagina * $qtdRegistros;

        //Se está setado o campo título pesquisa pelo título e pela pessoa
        if (isset($_POST['titulo']) && $_POST['titulo'] != "0" && !empty($_POST['titulo'])) {
            $titulo = $_POST['titulo'];
            //Pega o número de páginas contabilizando os registros que contém a string de busca dividido pela qtd de registros por página  
            $qtdPaginas = Livros::getNumPaginasString($pessoa, $qtdRegistros, $titulo);
            $livros = Livros::buscarLivroTitulo($pessoa, $primeiroRegistro, $qtdRegistros, $titulo);
            
        } else {//Se não está setado o campo título, pesquisa todos os livros pela pessoa
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
    } else if (isset($_POST['id_online'])) {
        $id = $_POST['id_online'];
        $pessoa = $_POST['pessoa'];
        $online = Livros::buscarLivroId($id, $pessoa);
        $on = $online[0]->getOnline();
        //Se online==true inverte para false | online==false inverte para true
        if ($on == 1) {
            $on = 0;
        } else {
            $on = 1;
        }
        $retorno = Livros::alterarOnlineLivro($id, $on);
        echo $retorno;
    }
} 

