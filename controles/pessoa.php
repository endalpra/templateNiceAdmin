<?php

require_once (__DIR__ . '/../modelos/Pessoas.php');
require_once (__DIR__ . '/../modelos/Livros.php');
require_once (__DIR__ . '/../modelos/Estantes.php');
require_once (__DIR__ . '/../modelos/Prateleiras.php');
require_once (__DIR__ . '/../bibliotecas/URL.php');
require_once (__DIR__ . '/../bibliotecas/funcoes.php');

if (URL::isPaginaAtual("login.php")) {
    if (isset($_POST['latitude']) && isset($_POST['longitude']) && !empty($_POST['longitude']) && $_POST['latitude']) {
        if (isset($_POST['nome']) && isset($_POST['email']) && isset($_POST['login']) && isset($_POST['senha']) && $_POST['repetir_senha'] && !empty($_POST['nome']) && !empty($_POST['email']) && !empty($_POST['login']) && !empty($_POST['senha']) && !empty($_POST['repetir_senha'])) {
            $nome = $_POST['nome'];
            $email = $_POST['email'];
            $login = $_POST['login'];
            $senha = $_POST['senha'];
            $repetir_senha = $_POST['repetir_senha'];
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

            if ($senha == $repetir_senha) {
                //Verifica se login já não está cadastrado
                $existe = Pessoas::verificaExistenciaLogin($login);
                if (count($existe) == 0) {
                    //O método retorna o último id inserido para logar automaticamente
                    $retorno = Pessoas::cadastrarPessoa($nome, $email, $login, $senha, $latitude, $longitude);
                    $id = $retorno[0]->getId();
                    $pessoa = Pessoas::buscarPessoaId($id);
                    $r = Estantes::cadastrarEstante("Estante 1", $id);
                    Prateleiras::cadastrarPrateleira("Prateleira 1", $r[0]->getId(), $id);
                    Prateleiras::cadastrarPrateleira("Prateleira 2", $r[0]->getId(), $id);
                    if ($retorno != NULL) {
                        $msg = 1;
                        $_SESSION['ses-usu-id'] = $id;
                        $_SESSION['ses-usu-nome'] = $pessoa[0]->getNome();
                        $_SESSION['ses-usu-img'] = "sem_imagem.jpg";
                        $_SESSION['registro'] = time();
                        $_SESSION['limite'] = TEMPO_SESSAO_ON;
                        $_SESSION['ses-usu-ip'] = $_SERVER['REMOTE_ADDR'];
                        require_once (__DIR__ . '/acesso.php');
                        echo "<script>window.location.href = 'index.php'</script>";
                    } else {
                        $msg = 0;
                    }
                } else {
                    //Usuario já existe
                    $msgErro = 10;
                }
            } else {
                //Senhas não conferem
                $msgErro = 9;
            }
        } else {
            //$msgErro = "Preencha os campos obrigatórios *";
        }
    } else {
        //$msgErro = "local";
    }
} else if (URL::isPaginaAtual("editarpessoa.php")) {
    $id = $_SESSION['ses-usu-id'];

    if (isset($_POST['nome']) && isset($_POST['email']) && isset($_POST['login']) && !empty($_POST['nome']) && !empty($_POST['email']) && !empty($_POST['login'])) {
        $msgErro = "";
        $nome_pessoa = $_POST['nome'];
        $email = $_POST['email'];
        $login = $_POST['login'];
        $existe_senha = false;
        $existe_local = false;
        $existe_imagem = false;
        $resposta = 0;

        //Verifica se existe login. Se existe verifica se email é igual ao informado
        $r = Pessoas::verificaExistenciaLoginRecuperar($login, $email);
        $existe_login = $r[0]->getId();
        if ($existe_login == 0) {
            if (isset($_POST['senha']) && isset($_POST['repetir_senha']) && !empty($_POST['senha']) && !empty($_POST['repetir_senha'])) {
                $senha = $_POST['senha'];
                $repetir_senha = $_POST['repetir_senha'];
                if ($senha != $repetir_senha) {
                    $msgErro .= "Senhas não conferem!";
                } else {
                    $existe_senha = true;
                    $senha = $senha;
                }
            } else if ((empty($_POST['senha']) && !empty($_POST['repetir_senha'])) || (!empty($_POST['senha']) && empty($_POST['repetir_senha']))) {
                $msgErro .= "Senhas não conferem!";
            }

            if (isset($_POST['latitude']) && isset($_POST['longitude']) && !empty($_POST['latitude']) && !empty($_POST['longitude'])) {
                $latitude = $_POST['latitude'];
                $longitude = $_POST['longitude'];
                $existe_local = true;
            }
            if (isset($_FILES['imagem']['name']) && !empty($_FILES['imagem']['name'])) {
                $existe_imagem = true;
            }

            //Referente ao upload de imagem    
            if ($existe_imagem && empty($msgErro)) {
                $erro = 0;
                $msg = '';
                $extensao = array('.jpeg', '.JPEG', '.jpg', '.JPG', '.png', '.PNG');
                $nome_arquivo = $_FILES['imagem']['name'];
                $tamanho_arquivo = $_FILES['imagem']['size'];
                $ext_arquivo = strrchr($nome_arquivo, '.');

                //extrai a extensão do arquivo enviado
                $msgErro = "";
                if ($tamanho_arquivo > LIMITE_TAM_IMAGEM) {
                    $erro++;
                    $msgErro = "Erro de tamanho";
                }
                if (!in_array($ext_arquivo, $extensao)) {
                    $erro++;
                    $msgErro .= '\nErro extensão';
                }
                if ($erro == 0) {
                    $nome = 'pessoa_' . $id . $ext_arquivo;
                    if (move_uploaded_file($_FILES['imagem']['tmp_name'], '../img/pessoas/' . $nome)) {
                        //Chama a função de redimensionamento
                        redimensionar('../img/pessoas/' . $nome);
                        //Update na tabela de livros 
                        $retorno = Pessoas::updatePessoasImagem($id, $nome);
                        if ($retorno) {
                            if ($existe_senha && $existe_local) {
                                $resposta = Pessoas::updatePessoaSenhaLocal($id, $nome_pessoa, $email, $login, $latitude, $longitude, $senha);
                            } else if ($existe_senha) {
                                $resposta = Pessoas::updatePessoaSenha($id, $nome_pessoa, $email, $login, $senha);
                            } else if ($existe_local) {
                                $resposta = Pessoas::updatePessoaLocal($id, $nome_pessoa, $email, $login, $latitude, $longitude);
                            } else {
                                $resposta = Pessoas::updatePessoaBasico($id, $nome_pessoa, $email, $login);
                            }
                            if ($resposta) {
                                $msg = 1;
                                //$pessoa = Pessoas::buscarPessoaId($id);
                                if (!empty($pessoa)) {
//                                unset($_SESSION['ses-usu-imagem']);
//                                unset($_SESSION['ses-usu-nome']);
//                                $_SESSION['ses-usu-imagem'] = $pessoa[0]->getImagem();
//                                $_SESSION['ses-usu-nome'] = $pessoa[0]->getNome();
                                }
                            } else {
                                $msg = 0;
                            }
                        } else {
                            $msg = 0;
                        }
                    }
                }
            } else if ($existe_senha && $existe_local && empty($msgErro)) {//Imagem não está setada
                $resposta = Pessoas::updatePessoaSenhaLocal($id, $nome_pessoa, $email, $login, $latitude, $longitude, $senha);
            } else if ($existe_senha && empty($msgErro)) {
                $resposta = Pessoas::updatePessoaSenha($id, $nome_pessoa, $email, $login, $senha);
            } else if ($existe_local && empty($msgErro)) {
                $resposta = Pessoas::updatePessoaLocal($id, $nome_pessoa, $email, $login, $latitude, $longitude);
            } else if (empty($msgErro)) {
                $resposta = Pessoas::updatePessoaBasico($id, $nome_pessoa, $email, $login);
            }
            if ($resposta) {
                $msg = 1;
            } else {
                $msg = 0;
            }
        } else {
            $msgErro = "Login já existe. Tente outro!";
            $msg = 0;
        }
    } else {//Se não estão preechidos os campos então carrega
        $pessoa = Pessoas::buscarPessoaId($id);
    }
} else if (URL::isPaginaAtual("perfilpessoa.php")) {
    if (isset($_POST['id_pessoa']) && is_numeric($_POST['id_pessoa'])) {
        $pessoa = Pessoas::buscarPessoaPerfil($_SESSION['ses-usu-id'], $_POST['id_pessoa']);
    }
} else if (URL::isPaginaAtual("pessoa.php")) {
    if (isset($_POST['id_pessoa_ajax']) && is_numeric($_POST['id_pessoa_ajax']) && isset($_POST['pagina']) && is_numeric($_POST['pagina'])) {
        $comentarios = Pessoas::buscarDescricaoEmprestimosPessoa($_POST['id_pessoa_ajax'], ($_POST['pagina'] * QTD_REG_COMENTARIOS), QTD_REG_COMENTARIOS);
        $xml = "";
        $xml .= "<?xml version='1.0' encoding='UTF-8'?>";
        $xml .= "<comentarios>";
        foreach ($comentarios as $c):
            $d = explode(" ", $c->getData());
            $data = inverte_data($d[0], '-', '/');
            $hora = $d[1];
            $xml .= "<comentario>";
            $xml .= "<nome>" . $c->getNome() . "</nome>";
            $xml .= "<imagem>" . $c->getImagem() . "</imagem>";
            $xml .= "<descricao>" . $c->getDescricao() . "</descricao>";
            $xml .= "<data>" . $data . " " . $hora . "</data>";
            $xml .= "</comentario>";
        endforeach;
        $xml .= "</comentarios>";
        echo $xml;
    }
    //Referente à recuperação de senha
    if (isset($_POST['email_recuperar_senha'])) {
        $email = $_POST['email_recuperar_senha'];
        $r = Pessoas::buscarPessoaEmail($email);
        $existe = $r[0]->getId();
        if ($existe > 0) {
            //Gera nova senha, atualiza no banco e envia para o email do usuario
            $chave = sha1(geraSenha());
            $r = Pessoas::insereRecuperacao($email, $chave);
            if ($r) {
                $link = "https://www.bibliotecapessoal.com/visoes/recuperar.php?utilizador=$email&chave=$chave";
                $assunto = "Recuperar senha para Bibliotecapessoal.com";
                $msg = "<br><br>Mensagem enviada por admin@bibliotecapessoal.com";
                $msg .="<br><br>Se você solicitou a recuperação de senha visite o seguinte <a href='".$link."'>link</a>" ;
                if ($r) {
                    $r = enviaEmail($email, $assunto, $msg);
                    if ($r) {
                        echo 1;
                    } else {
                        echo 0;
                    }
                } else {
                    echo 0;
                }
            }
        } else {
            echo 2; //Email não encontrado
        }
    }
} elseif (URL::isPaginaAtual("contatardono.php")) {
    if (isset($_GET['id_1']) && is_numeric($_GET['id_1']) && isset($_GET['id_2']) && is_numeric($_GET['id_2'])) {
        $idPessoa = $_GET['id_1'];
        $idLivro = $_GET['id_2'];
        $pessoa = Pessoas::buscarPessoaId($idPessoa);
        $livro = Livros::buscarLivroIdContDono($idLivro);
    }
} else if (URL::isPaginaAtual("recuperar.php")) {
    if (isset($_GET['utilizador']) && $_GET['chave']) {
        $r = Pessoas::verificaExistenciaRecuperacao($_GET['utilizador'], $_GET['chave']);
        $existe = $r[0]->getId();
        if ($existe > 0) {
            //Deletar do banco este registro?
        }
    }

    if (isset($_POST['login']) && isset($_POST['email']) && isset($_POST['senha']) && isset($_POST['repetir_senha'])) {
        //Verifica se existe login. Se existe verifica se email é igual ao informado
        $r = Pessoas::verificaExistenciaLoginRecuperar($_POST['login'], $_POST['email']);
        $segue = $r[0]->getId();
        if ($segue == 0) {
            if ($_POST['senha'] == $_POST['repetir_senha']) {
                $r = Pessoas::redefinirLoginSenha($_POST['email'], $_POST['login'], $_POST['senha']);
                if ($r) {
                    $msgR = 1;
                    Pessoas::deletarRecuperacao($_POST['email']);
                } else {
                    $msgR = 0;
                }
            } else {
                $msgErro = 9;
            }
        } else {
            $msgErro = 10;
        }
    }
}    
  