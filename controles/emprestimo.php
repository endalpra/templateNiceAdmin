<?php

require_once (__DIR__ . '/../modelos/Emprestimos.php');
require_once (__DIR__ . '/../modelos/Pessoas.php');
require_once (__DIR__ . '/../modelos/Livros.php');
require_once (__DIR__ . '/../bibliotecas/URL.php');
require_once (__DIR__ . '/../bibliotecas/funcoes.php');

if (URL::isPaginaAtual("geraremprestimo.php")) {
    $pessoas = Pessoas::buscarTodasPessoas();
    $titulos = Livros::buscarLivrosPessoaId($_SESSION['ses-usu-id']);
    if (isset($_POST['titulo']) && isset($_POST['idpessoa']) && is_numeric($_POST['idpessoa']) && isset($_POST['data']) && !empty($_POST['titulo']) && !empty($_POST['idpessoa']) && !empty($_POST['data'])) {
        $titulo = $_POST['titulo'];
        $pessoa = $_POST['idpessoa'];
        $data = $_POST['data'];
        if (strstr($data, "/")) {
            $data = inverte_data($data, '/', '-');
        }
        if (isset($_POST['data_prevista']))
            $data_prevista = $_POST['data_prevista'];
        if (strstr($data_prevista, "/")) {
            $data_prevista = inverte_data($data_prevista, '/', '-');
        }
        if (isset($_POST['observacao']))
            $observacao = $_POST['observacao'];

        $retorno = Emprestimos::gerarEmprestimo($titulo, $pessoa, $data, $data_prevista, $observacao);
        if ($retorno) {
            $msg = 1;
        } else {
            $msg = 0;
        }
    } else if (isset($_POST['btCadastrar'])) {
        $msgErro = "Preencha os campos obrigatórios *";
    }
} else if (URL::isPaginaAtual("emprestimo.php")) {
    //Ajax autocompletar pessoa
    if (isset($_POST['buscarPessoa'])) {
        $string = $_POST['buscarPessoa'];
        $pessoas = Pessoas::buscarPessoasString($string);

        $xml = "";
        $xml .= "<?xml version='1.0' encoding='UTF-8'?>";
        $xml .= "<pessoas>";
        foreach ($pessoas as $p):
            $xml .= "<pessoa>";
            $xml .= "<id>" . $p->getId() . "</id>";
            $xml .= "<nome>" . $p->getNome() . "</nome>";
            $xml .="</pessoa>";
        endforeach;
        $xml .= "</pessoas>";
        echo $xml;
    }

    //Ajax responsável por listar os dados de empréstimos gerados
    else if (isset($_POST['pessoa']) && is_numeric($_POST['pessoa'])) {
        $pessoa = $_POST['pessoa'];
        $opcao = (int) $_POST['opcao'];
        if($opcao==0){
            $emprestimos = Emprestimos::buscarEmprestimosPendentes($pessoa);
        }else{
            $emprestimos = Emprestimos::buscarEmprestimosFinalizados($pessoa);
        }
        
        $xml = "";
        $xml .= "<?xml version='1.0' encoding='UTF-8'?>";
        $xml .= "<emprestimos>";
        foreach ($emprestimos as $e):
            $xml .= "<emprestimo>";
            $xml .= "<id>" . $e->getId() . "</id>";
            $xml .= "<id_livro>" . $e->getId_livro() . "</id_livro>";
            $xml .= "<livro>" . $e->getLivro() . "</livro>";
            $xml .= "<pessoa_emprestou>" . $e->getPessoa_emprestou() . "</pessoa_emprestou>";
            $xml .= "<id_pessoa_emprestou>" . $e->getId_pessoa_emprestou() . "</id_pessoa_emprestou>";
            $xml .= "<data>" . $e->getData() . "</data>";
            $xml .= "<data_prevista>" . $e->getData_prevista() . "</data_prevista>";
            $xml .= "<data_devolucao>" . $e->getData_devolucao() . "</data_devolucao>";
            $xml .= "<observacao>" . $e->getObservacao() . "</observacao>";
            $xml .= "</emprestimo>";
        endforeach;
        $xml .= "</emprestimos>";
        echo $xml;
    }
    //Ajax responsável por listar os dados de empréstimos Obtidos
    else if (isset($_POST['pessoa2']) && is_numeric($_POST['pessoa2'])) {
        $pessoa = $_POST['pessoa2'];
        $opcao = (int) $_POST['opcao'];
        if($opcao==0){
            $emprestimos = Emprestimos::buscarEmprestimosObtidosPendentes($pessoa);
        }else{
             $emprestimos = Emprestimos::buscarEmprestimosObtidosFinalizados($pessoa);
        }
        $xml = "";
        $xml .= "<?xml version='1.0' encoding='UTF-8'?>";
        $xml .= "<emprestimos>";
        foreach ($emprestimos as $e):
            $xml .= "<emprestimo>";
            $xml .= "<id>" . $e->getId() . "</id>";
            $xml .= "<livro>" . $e->getLivro() . "</livro>";
            $xml .= "<pessoa_emprestou>" . $e->getPessoa_emprestou() . "</pessoa_emprestou>";
             $xml .= "<id_pessoa_emprestou>" . $e->getId_Pessoa_emprestou() . "</id_pessoa_emprestou>";
            $xml .= "<data>" . $e->getData() . "</data>";
            $xml .= "<data_prevista>" . $e->getData_prevista() . "</data_prevista>";
            $xml .= "<data_devolucao>" . $e->getData_devolucao() . "</data_devolucao>";
            $xml .= "<observacao>" . $e->getObservacao() . "</observacao>";
            $xml .= "<idpessoa>" . $e->getIdpessoa() . "</idpessoa>";
            $xml .= "</emprestimo>";
        endforeach;
        $xml .= "</emprestimos>";
        echo $xml;
    }
    //Ajax responsável por tratar do empréstimo que está sendo setado como devolvido
    else if (isset($_POST['devolvido']) && $_POST['devolvido'] == 'sim') {
        if (isset($_POST['livro']) && isset($_POST['data']) && isset($_POST['nota']) && !empty($_POST['data']) && !empty($_POST['nota'])) {
            $livro = $_POST['livro'];
            $data = $_POST['data'] ;
            if (strstr($data, "/")) {
                $data = inverte_data($data, '/', '-');
            }
            $nota = $_POST['nota'];
            $id = $_POST['pessoa_emprestou'];
            $descricao = $_POST['descricao'];
            $devolvido = 1; //Teste já foi feito no if, então devolvido recebe true
            //Recuperar qtd de votos e acrescentar mais um
            //Somar pontuação àquela já existente
            $pessoa = Pessoas::buscarPessoaId($id);
            $votos = $pessoa[0]->getVotos();
            $pontos = $pessoa[0]->getPontos() + $nota;
            
            //if data_review esta setada não soma 1 a qtd de votos
            $verData_review = Emprestimos::buscarEmprestimoId($livro);
            if($verData_review[0]->getData_review()== null || $verData_review[0]->getData_review()=="0000-00-00"){
                $votos += 1;
            }
          

            //Refazer confiabilidade
            $confiabilidade = round($pontos / $votos, 1);
            $retorno = Pessoas::updateConfiabilidade($id, $pontos, $votos, $confiabilidade);

            $retorno = Emprestimos::devolver($livro, $data, $descricao);
            if ($retorno) {
                echo 1;
            } else {
                echo 0;
            }
        }
    }
    //Ajax responsável por tratar do empréstimo que está sendo setado como não devolvido
    else if (isset($_POST['devolvido']) && $_POST['devolvido'] == 'nao') {
            $livro = $_POST['livro'];
            $data_review = date("Y-m-d");
            if(isset($_POST['nota'])){
                $nota = $_POST['nota'];
            }else {
                $nota = 0;
            }
            $id = (int) $_POST['pessoa_emprestou'] ;
            if(isset($_POST['descricao'])){
            $descricao = $_POST['descricao'];
            }else{
                $descricao = "";
            }
            $devolvido = 0;

            //Recuperar qtd de votos e acrescentar mais um
            //Somar pontuação àquela já existente
            $pessoa = Pessoas::buscarPessoaId($id);
            $votos = $pessoa[0]->getVotos();
            $pontos = $pessoa[0]->getPontos() + $nota;

            //if data_review esta setada não soma 1 a qtd de votos
            $verData_review = Emprestimos::buscarEmprestimoId($livro);
            if($verData_review[0]->getData_review() == null || $verData_review[0]->getData_review() == "0000-00-00"){
                $votos += 1;
            }
            //Refazer confiabilidade
            $confiabilidade = round($pontos / $votos, 1);
            $retorno = Pessoas::updateConfiabilidade($id, $pontos, $votos, $confiabilidade);

            $retorno = Emprestimos::naoDevolver($livro, $data_review, $descricao);
            if ($retorno) {
                echo 1;
            } else {
                echo 0;
            }        
    }
    //Busca a descrição na tabela de empréstimos e seta no modal devolver em listaremprestimos.php
    else if(isset($_POST['id_emprestimo_descricao']) && is_numeric($_POST['id_emprestimo_descricao'])){
        $id = $_POST['id_emprestimo_descricao'];
        $retorno = Emprestimos::buscarEmprestimoId($id);
        
        echo $retorno[0]->getDescricao();
    }
}
