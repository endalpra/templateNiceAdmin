<?php

require_once (__DIR__ . '/../modelos/Prateleiras.php');
require_once (__DIR__ . '/../modelos/Estantes.php');
require_once (__DIR__ . '/../modelos/Livros.php');
require_once (__DIR__ . '/../bibliotecas/URL.php');
//require_once (__DIR__ . '/../bibliotecas/funcoes.php');


if (URL::isPaginaAtual("cadastrarprateleira.php")) {
    //Carregar estantes
    $estantes = Estantes::buscarTodasEstantesPessoa($_SESSION['ses-usu-id']);
    if (isset($_POST['nome']) && !empty($_POST['nome']) && isset($_POST['estante']) && !empty($_POST['estante'])) {
        $nome = $_POST['nome'];
        $estante = $_POST['estante'];
        $pessoa = $_POST['pessoa'];

        //Verifica se prateleira já não está registrada

        $retorno = Prateleiras::cadastrarPrateleira($nome, $estante, $pessoa);
        if ($retorno) {
            $msg = 1;
        } else {
            $msg = 0;
        }
    } else if (isset($_POST['btCadastrar'])) {
        $msgErro = "Preencha os campos obrigatórios *";
    }
} else if (URL::isPaginaAtual("listarprateleiras.php")) {
    $primeiroRegistro = 0;
    $pessoa = $_SESSION['ses-usu-id'];
    $prateleiras = Prateleiras::buscarPrateleirasPessoa($pessoa, $primeiroRegistro, QTD_PAG_PRATELEIRA);
    $qtdPaginas = Prateleiras::getNumPaginas($pessoa, QTD_PAG_PRATELEIRA);
} else if (URL::isPaginaAtual("editarprateleira.php")) {
    //CARREGA OS DADOS NA PÁGINA
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $pessoa = $_SESSION['ses-usu-id'];
        $estantes = Estantes::buscarTodasEstantesPessoa($pessoa);
        $id = $_GET['id'];
        //PASSAR A PESSOA PARA QUE NÃO SEJA POSSÍVEL ACESSAR REGISTROS DE OUTROS USUARIOS MODIFICANDO O ID NA URL
        $prateleiras = Prateleiras::buscarPrateleiraId($id, $pessoa);
        //SALVA OS DADOS
    } else if (isset($_POST['nome']) && !empty($_POST['nome']) && isset($_POST['estante']) && !empty($_POST['estante'])) {
        $id = (int) $_POST['id'];
        $nome = $_POST['nome'];
        $estante =  $_POST['estante'];
        $retorno = Prateleiras::editarPrateleira($id, $nome, $estante);
        if ($retorno) {
            $msg = '1';
        } else {
            $msg = '0';
        }
    } else if (isset($_POST['btCadastrar'])) {
        $msgErro = 'Preencha os campos obrigatórios';
    }
} else if (URL::isPaginaAtual("prateleira.php")) {
    //AJAX PAGINAÇÃO
    if (isset($_POST['pagina']) && is_numeric($_POST['pagina']) && isset($_POST['pessoa']) && is_numeric($_POST['pessoa'])) {
        $pagina = $_POST['pagina'];
        $primeiroRegistro = $pagina * QTD_PAG_PRATELEIRA;
        $pessoa = $_POST['pessoa'] ;
        $prateleiras = Prateleiras::buscarPrateleirasPessoa($pessoa, $primeiroRegistro, QTD_PAG_PRATELEIRA);

        $xml = "";
        $xml .= "<?xml version='1.0' encoding='UTF-8'?>";
        $xml .= "<prateleiras>";
        foreach ($prateleiras as $p):
            $xml .= "<prateleira>";
            $xml .= "<id>" . $p->getId() . "</id>";
            $xml .= "<nome>" . $p->getNome() . "</nome>";
            $xml .= "<estante>" . $p->getEstante() . "</estante>";
            $xml .= "</prateleira>";
        endforeach;
        $xml .= "</prateleiras>";

        echo $xml;
    }
    if (isset($_POST['id']) && is_numeric($_POST['id']) && isset($_POST['pessoa']) &&  is_numeric($_POST['pessoa'])) {
        $id = $_POST['id'];
        $existe_livro = Livros::existePrateleiraEmLivros($id, $_POST['pessoa']);
        if (count($existe_livro)==0) {
            $retorno = Prateleiras::excluirPrateleira($id);
            if ($retorno) {
                echo $id;
            } else {
                echo '0';
            }
        }else{
            echo '0';
        }
    }
}


