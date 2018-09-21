<?php

require_once (__DIR__ . '/../bibliotecas/URL.php');
require_once (__DIR__ . '/../bibliotecas/funcoes.php');
require_once (__DIR__ . '/../modelos/Livros.php');
require_once (__DIR__ . '/../modelos/Editoras.php');
require_once (__DIR__ . '/../modelos/Pessoas.php');
require_once (__DIR__ . '/../modelos/Emprestimos.php');
require_once (__DIR__ . '/../modelos/Autores.php');
require_once (__DIR__ . '/../modelos/Areas_do_conhecimento.php');
require_once (__DIR__ . '/../modelos/Prateleiras.php');

if (URL::isPaginaAtual("cadastrarlivro.php")) {
    $areas_do_conhecimento = Areas_do_conhecimento::buscarTodasAreas_do_conhecimento();
    $prateleiras = Prateleiras::buscarTodasPrateleirasPessoa($_SESSION['ses-usu-id']);
    if (isset($_POST['titulo']) && isset($_POST['area_do_conhecimento']) && isset($_POST['prateleira']) && isset($_POST['pessoa']) && isset($_POST['ideditora']) && isset($_POST['online']) && isset($_POST['idautor']) && !empty($_POST['titulo']) && !empty($_POST['area_do_conhecimento']) && !empty($_POST['prateleira']) && !empty($_POST['pessoa']) && !empty($_POST['ideditora']) && !empty($_POST['online']) && !empty($_POST['idautor'])) {
        $titulo = $_POST['titulo'];
        $area_do_conhecimento = (int) $_POST['area_do_conhecimento'];
        $prateleira = (int) $_POST['prateleira'];
        $pessoa = (int) $_POST['pessoa'];
        $autor = (int) $_POST['idautor'];
        $editora = (int) $_POST['ideditora'];

        if ($_POST['online'] == "sim") {
            $online = 1;
        } else {
            $online = 0;
        }
        if (!empty($_POST['numero_paginas'])) {
            $numero_paginas = (int) $_POST['numero_paginas'];
        } else {
            $numero_paginas = 0;
        }
        if (!empty($_POST['descricao'])) {
            $descricao = $_POST['descricao'];
        } else {
            $descricao = "";
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
        if (!empty($_POST['lido'])) {
            if ($_POST['lido'] == "sim") {
                $lido = 1;
            } else {
                $lido = 0;
            }
        } else {
            $lido = 0;
        }

        //Verifica se cadastros não excedem o limite
        $r = Livros::verificaExcedenteLivros($pessoa);
        $num_registros = $r[0]->getId();
        if ($num_registros < MAX_REG_LIVROS) {
            //Verifica se livro já existe para esta pessoa
            $existe = Livros::verificaExistenciaLivro($titulo, $edicao, $pessoa);
            if ($existe[0]->getId() == 0) {

                //Referente ao upload de imagem    
                if (isset($_FILES['imagem']['name']) && !empty($_FILES['imagem']['name'])) {
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
                        //Insere o livro e recebe o último id para inserir na tabela autores_livros
                        $retorno = Livros::cadastrarLivro($titulo, $area_do_conhecimento, $prateleira, $pessoa, $numero_paginas, $descricao, $editora, $edicao, $isbn, $online, $lido);
                        //<<-- REVER VAR_DUMP($retorno) -->> Retorna um id para cada registro gravado    
                        //var_dump($retorno);
                        $livro = $retorno[0]->getId();
                        if ($retorno != NULL) {
                            $r = Livros::inserirAutoresLivros($autor, $livro);

                            $nome = 'livro_' . $livro . $ext_arquivo;
                            if (move_uploaded_file($_FILES['imagem']['tmp_name'], '../img/livros/' . $nome)) {
                                //Chama a função de redimensionamento
                                redimensionar('../img/livros/' . $nome);

                                //Update na tabela de livros 
                                $retorno = Livros::updateLivrosImagem($livro, $nome);
                                if ($retorno) {
                                    $msg = 1;
                                } else {
                                    $msg = 0;
                                }
                            }
                        }
                    }
                } else {
                    //Insere o livro e recebe o último id para inserir na tabela autores_livros
                    $retorno = Livros::cadastrarLivro($titulo, $area_do_conhecimento, $prateleira, $pessoa, $numero_paginas, $descricao, $editora, $edicao, $isbn, $online, $lido);
                    $livro = $retorno[0]->getId();
                    if ($retorno != NULL) {
                        $r = Livros::inserirAutoresLivros($autor, $livro);
                        if ($r) {
                            $msg = 1;
                        } else {
                            $msg = 0;
                        }
                    } else {
                        $msg = 0;
                    }
                }
            } else {
                $msgErroL = 10; //Registro existente
                $msg = 0;
            }
        } else {
            $msgErroL = 8; //Excedido o máximo de registros de livros
            $msg = 0;
        }
    } else if (isset($_POST['btCadastrar'])) {
        $msgErro = "Preencha os campos obrigatórios *";
    }
} else if (URL::isPaginaAtual("editarlivro.php")) {
    //Carrega os dados
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $id = $_GET['id'];
        $pessoa = $_SESSION['ses-usu-id'];
        $areas_do_conhecimento = Areas_do_conhecimento::buscarTodasAreas_do_conhecimento();
        $prateleiras = Prateleiras::buscarTodasPrateleirasPessoa($pessoa);
        //Passar a pessoa para que não seja possível acessar outros registros modificando o id na url
        $livros = Livros::buscarLivroId($id, $pessoa);

        //Buscar id do autor de livro na tabela autores_livros
        $retorno = Livros::buscarAutorLivro($id);
        if (!empty($retorno)) {
            $idautor = $retorno[0]->getAutor();
            $autor = $retorno[0]->getNome_autor();
        }
        //Salva os dados
    } else {
        if (isset($_POST['titulo']) && isset($_POST['area_do_conhecimento']) && isset($_POST['prateleira']) && !empty($_POST['titulo']) && !empty($_POST['area_do_conhecimento']) && !empty($_POST['prateleira'])) {
            $id = (int) $_POST['id'];
            $idautor = (int) $_POST['idautor'];
            $titulo = $_POST['titulo'];
            $area_do_conhecimento = (int) $_POST['area_do_conhecimento'];
            $prateleira = (int) $_POST['prateleira'];

            if (!empty($_POST['numero_paginas'])) {
                $numero_paginas = (int) $_POST['numero_paginas'];
            } else {
                $numero_paginas = 0;
            }
            if (!empty($_POST['descricao'])) {
                $descricao = $_POST['descricao'];
            } else {
                $descricao = "";
            }
            if (!empty($_POST['ideditora'])) {
                $editora = (int) $_POST['ideditora'];
            } else {
                $editora = "";
            }
            if (!empty($_POST['edicao'])) {
                $edicao = (int) $_POST['edicao'];
            } else {
                $edicao = 0;
            }
            if (!empty($_POST['isbn'])) {
                $isbn = $_POST['isbn'];
            } else {
                $isbn = "";
            }
            if ($_POST['lido'] == "sim") {
                $lido = 1;
            } else {
                $lido = 0;
            }


            //Referente ao upload de imagem    
            if (isset($_FILES['imagem']['name']) && !empty($_FILES['imagem']['name'])) {
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

                    $retorno = Livros::alterarLivro($id, $titulo, $area_do_conhecimento, $prateleira, $numero_paginas, $descricao, $editora, $edicao, $isbn, $lido);
                    if ($retorno != NULL) {
                        //Alterar autor na tabela autores_livros
                        Livros::updateAutoresLivros($idautor, $id);
                        $nome = 'livro_' . $id . $ext_arquivo;
                        if (move_uploaded_file($_FILES['imagem']['tmp_name'], '../img/livros/' . $nome)) {
                            //Chama a função de redimensionamento
                            redimensionar('../img/livros/' . $nome);
                            //Update na tabela de livros 
                            $retorno = Livros::updateLivrosImagem($id, $nome);
                            if ($retorno) {
                                $msg = 1;
                            } else {
                                $msg = 0;
                            }
                        }
                    }
                }
            } else {
                $retorno = Livros::alterarLivro($id, $titulo, $area_do_conhecimento, $prateleira, $numero_paginas, $descricao, $editora, $edicao, $isbn, $lido);
                if ($retorno != NULL) {
                    //Alterar autor na tabela autores_livros
                    $r = Livros::updateAutoresLivros($idautor, $id);
                    if ($r) {
                        $msg = 1;
                    } else {
                        $msg = 0;
                    }
                } else {
                    $msg = 0;
                }
            }
        } else if (isset($_POST['btCadastrar'])) {
            $msgErro = "Preencha os campos obrigatórios *";
        }
    }

//Listar livros com ajax
} else if (URL::isPaginaAtual("livro.php")) {
    if (isset($_POST['pessoa']) && is_numeric($_POST['pessoa']) && isset($_POST['pagina']) && is_numeric($_POST['pagina'])) {
        $pessoa = $_POST['pessoa'];
        $pagina = $_POST['pagina'];

        //Se está setado o campo quantidade -> de registros por página 
        if (isset($_POST['quantidade']) && $_POST['quantidade'] != 0 && !empty($_POST['quantidade'])) {
            $qtdRegistros = (int) $_POST['quantidade'];
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
    }else if (isset($_POST['id']) && is_numeric($_POST['id'])) {
        $id = $_POST['id'];
        $existe_emprestimo = Emprestimos::existeLivroEmEmprestimos($id);
        if (count($existe_emprestimo) == 0) {
            $retorno = Livros::excluirLivro($id);
            Livros::excluirAutorLivro($id);
            if ($retorno) {
                echo $id;
            } else {
                echo "0";
            }
        } else {
            echo '0'; //Existe dependência
        }

        //Muda a coluna "online" na tabela livros
    } else if (isset($_POST['id_online']) && is_numeric($_POST['id_online'])) {
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

        //BUSCA DE LIVROS ONLINE
    } else if (isset($_POST['string'])) {
        $string = $_POST['string'];
        $pessoa = (int) $_POST['pessoa'];


        //O método já calcula a distância através da função do MySQL
        $livros = Livros::buscarLivroOnlineAutoCompletar($string, $pessoa, QTD_LIVROS_AUTOCOMPLETAR);

        $xml = "";
        $xml .= "<?xml version='1.0' encoding='UTF-8'?>";
        $xml .= "<livros>";
        foreach ($livros as $l):
            $xml .= "<livro>";
            $xml .= "<id>" . $l->getId() . "</id>";
            $xml .= "<titulo>" . $l->getTitulo() . "</titulo>";
            $xml .= "<distancia>" . $l->getDistancia() . "</distancia>";
            $xml .= "</livro>";
        endforeach;
        $xml .= "</livros>";
        echo $xml;
    }

    //Autocompletar Editora
    else if (isset($_POST['buscarEditora'])) {
        $string = $_POST['buscarEditora'];

        $editoras = Editoras::buscarEditoras($string);
        $xml = "";
        $xml .= "<?xml version='1.0' encoding='UTF-8'?>";
        $xml .= "<editoras>";
        foreach ($editoras as $e):
            $xml .= "<editora>";
            $xml .= "<id>" . $e->getId() . "</id>";
            $xml .= "<nome>" . $e->getNome() . "</nome>";
            $xml .= "</editora>";
        endforeach;
        $xml .= "</editoras>";
        echo $xml;
    }
    //Autocompletar Autor
    else if (isset($_POST['buscarAutor'])) {
        $string = $_POST['buscarAutor'];

        $autores = Autores::buscarAutores($string);
        $xml = "";
        $xml .= "<?xml version='1.0' encoding='UTF-8'?>";
        $xml .= "<autores>";
        foreach ($autores as $a):
            //$xml .= "<autor label='".$a->getNome()."' value='".$a->getId()."'/>";
            $xml .= "<autor>";
            $xml .= "<id>" . $a->getId() . "</id>";
            $xml .= "<nome>" . $a->getNome() . "</nome>";
            $xml .= "</autor>";
        endforeach;
        $xml .= "</autores>";
        echo $xml;
    }
    //Ajax que traz os dados de livro buscado na barra de pesquisa BUSCA ONLINE
    else if (isset($_POST['idBuscarLivro']) && is_numeric($_POST['idBuscarLivro'])) {
        $livro = $_POST['idBuscarLivro'];
        $pessoa = (int) $_POST['pessoa'];
        $dados = Livros::buscarLivroOnlineId($livro, $pessoa);

        $xml = "";
        $xml .= "<?xml version='1.0' encoding='UTF-8'?>";
        $xml .= "<livro>";
        foreach ($dados as $l):
            $xml .= "<titulo>" . $l->getTitulo() . "</titulo>";
            $xml .= "<autor>" . $l->getAutor() . "</autor>";
            $xml .= "<imagem>" . $l->getImagem() . "</imagem>";
            $xml .= "<edicao>" . $l->getEdicao() . "</edicao>";
            //$xml .= "<editora>" . $l->getEditora() . "</editora>";
            $xml .= "<paginas>" . $l->getPaginas() . "</paginas>";
            $xml .= "<pessoa>" . $l->getPessoa() . "</pessoa>";
            $xml .= "<distancia>" . $l->getDistancia() . "</distancia>";
            $xml .= "<descricao>" . $l->getDescricao() . "</descricao>";
            $xml .= "<idpessoa>" . $l->getId() . "</idpessoa>";
        endforeach;
        $xml .= "</livro>";
        echo $xml;
    }else if (isset($_POST['string_titulo'])) {
        $string = $_POST['string_titulo'];
        $pessoa = (int) $_POST['pessoa'];
        $primeiroRegistro = 0;
        $qtdRegistros = (int) $_POST['qtdRegistros'];
        $r = Livros::getNumPaginasStringOnline($qtdRegistros, $string);
        $numero_paginas = $r[0]->getPaginas();
        $livros = Livros::buscarLivroStringOnline($pessoa, $primeiroRegistro, $qtdRegistros, $string);

        $xml = "";
        $xml .= "<?xml version='1.0' encoding='UTF-8'?>";
        $xml .= "<livros>";
        foreach ($livros as $l):
            $xml .= "<livro>";
            $xml .= "<titulo>" . $l->getTitulo() . "</titulo>";
            $xml .= "<autor>" . $l->getAutor() . "</autor>";
            $xml .= "<imagem>" . $l->getImagem() . "</imagem>";
            $xml .= "<edicao>" . $l->getEdicao() . "</edicao>";
            $xml .= "<editora>" . $l->getEditora() . "</editora>";
            $xml .= "<paginas>" . $l->getPaginas() . "</paginas>";
            $xml .= "<pessoa>" . $l->getPessoa() . "</pessoa>";
            $xml .= "<distancia>" . $l->getDistancia() . "</distancia>";
            $xml .= "<idpessoa>" . $l->getId() . "</idpessoa>";
            $xml .= "<numpaginas>" . $numero_paginas . "</numpaginas>";
            $xml .= "</livro>";
        endforeach;
        $xml .= "</livros>";
        echo $xml;
    }
    if (isset($_POST['pagi']) && is_numeric($_POST['pagi'])) {
        $livros = Livros::buscarLivrosOnline($_POST['pagi'] * QTD_LIVROS_INDEX, QTD_LIVROS_INDEX);

        $xml = "";
        $xml .= "<?xml version='1.0' encoding='UTF-8'?>";
        $xml .= "<livros>";
        foreach ($livros as $l):
            $xml .= "<livro>";
            $xml .= "<id>" . $l->getId() . "</id>";
            $xml .= "<imagem>" . $l->getImagem() . "</imagem>";
            $xml .= "</livro>";
        endforeach;
        $xml .= "</livros>";
        echo $xml;
    }
    if (isset($_POST['id_detalhe_livro']) && is_numeric($_POST['id_detalhe_livro'])) {
        $livro = Livros::buscarDetalheLivroId($_POST['id_detalhe_livro']);
        $xml = "";
        $xml .= "<?xml version='1.0' encoding='UTF-8'?>";
        $xml .= "<livro>";
        foreach ($livro as $l):
            $xml .= "<descricao>" . $l->getDescricao() . "</descricao>";
            $xml .= "<imagem>" . $l->getImagem() . "</imagem>";
            $xml .= "<edicao>" . $l->getEdicao() . "</edicao>";
            $xml .= "<editora>" . $l->getEditora() . "</editora>";
            $xml .= "<lido>" . $l->getLido() . "</lido>";
            $xml .= "<isbn>" . $l->getIsbn() . "</isbn>";
            $xml .= "<numero_paginas>" . $l->getNumero_paginas() . "</numero_paginas>";
        endforeach;
        $xml .= "</livro>";
        echo $xml;
    }
}

