<?php

require_once (__DIR__ . '/../modelos/Pessoas.php');
require_once (__DIR__ . '/../modelos/Livros.php');
require_once (__DIR__ . '/../bibliotecas/URL.php');

if (URL::isPaginaAtual("cadastrarpessoa.php")) {
    if (isset($_POST['nome']) && isset($_POST['email']) && isset($_POST['login']) && isset($_POST['senha']) && isset($_POST['cidade']) && isset($_POST['estado']) && isset($_POST['pais']) && !empty($_POST['nome']) && !empty($_POST['email']) && !empty($_POST['login']) && !empty($_POST['senha']) && !empty($_POST['cidade'] && !empty($_POST['estado']) && !empty($_POST['pais']))) {
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $login = $_POST['login'];
        $senha = $_POST['senha'];
        $cidade = $_POST['cidade'];
        $estado = $_POST['estado'];
        $pais = $_POST['pais'];

        //Testes para os campos não obrigatórios
        if (!empty($_POST['facebook'])) {
            $facebook = $_POST['facebook'];
        } else {
            $facebook = "";
        }
        if (!empty($_POST['whatsapp'])) {
            $whatsapp = $_POST['whatsapp'];
        } else {
            $whatsapp = "";
        }
        if (!empty($_POST['latitude'])) {
            $latitude = $_POST['latitude'];
        } else {
            $latitude = 0;
        }
        if (!empty($_POST['longitude'])) {
            $longitude = $_POST['longitude'];
        } else {
            $longitude = 0;
        }

        //Verifica se login já não está cadastrado

        $retorno = Pessoas::cadastrarPessoa($nome, $email, $login, $senha, $facebook, $whatsapp, $cidade, $estado, $pais, $latitude, $longitude);
        if ($retorno) {
            $msg = 1;
        } else {
            $msg = 0;
        }
    } else {
        $msgErro = "Preencha os campos obrigatórios *";
    }
} elseif (URL::isPaginaAtual("contatardono.php")) {
    if (isset($_GET['id_1']) && isset($_GET['id_2'])) {
        $idPessoa = $_GET['id_1'];
        $idLivro = $_GET['id_2'];
        $pessoa = Pessoas::buscarPessoaId($idPessoa);
        $livro = Livros::buscarLivroIdContDono($idLivro);
    }
}