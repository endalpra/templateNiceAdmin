<?php
session_start();
//Não deixa mostrar os possíveis erros
error_reporting(0);
ini_set("display_errors", 0 );

if (isset($_SESSION['ses-usu-id'])) {
    require_once (__DIR__ . '/../controles/verificasessao.php');
    ?>
    <!DOCTYPE html>
    <html lang="pt">
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta name="description" content="Bilioteca pessoal">
            <meta name="author" content="Érico N. Dalprá">
            <meta name="keyword" content="Biblioteca, Biblioteca Pessoal, Empréstimo de livros">
            <link rel="shortcut icon" href="../img/icon.png">

            <title>Bibliotecapessoal.com</title>



            <!-- Bootstrap CSS -->    
            <link href="../template/css/bootstrap.min.css" rel="stylesheet">
            <link href="../css/meucss.css" rel="stylesheet">
            <!-- bootstrap theme -->
            <link href="../template/css/bootstrap-theme.css" rel="stylesheet">
            <!--external css-->
            <!-- font icon -->
            <link href="../template/css/elegant-icons-style.css" rel="stylesheet" />
            <link href="../template/css/font-awesome.min.css" rel="stylesheet" />    
            <link href="../template/css/widgets.css" rel="stylesheet">
            <link href="../template/css/style.css" rel="stylesheet">
            <link href="../template/css/style-responsive.css" rel="stylesheet" />

            <script src="../template/js/jquery.js"></script>
            <script>
                /*Funcionamento do calendário*/
                $(function () {
                    $(".calendario").datepicker();
                });

                /*Funcionamento das estrelas de avaliação*/
                var ponto = 0;
                $(document).ready(function () {
                    $(function () {
                        $('.star').on('mouseover', function () {
                            var indice = $('.star').index(this);
                            for (var i = 0; i <= indice; i++) {
                                $('.star:eq(' + i + ')').addClass('full');
                            }
                        });

                        $('.star').on('mouseout', function () {
                            $('.star').removeClass('full');
                            if (ponto > 0) {
                                for (var i = 0; i < ponto; i++) {
                                    $('.star:eq(' + i + ')').addClass('full');
                                }
                            }
                        });
                        $('.star').on('click', function () {
                            ponto = $(this).attr('id');
                            $("#nota").val(ponto);
                        });
                    });
                });
            </script>

        </head>

        <!-- 0 equivale a Pendente ---- 1 equivale a Finalizado-->
        <body onload="listarEmprestimos(0,<?= $_SESSION['ses-usu-id'] ?>)">
            <!-- container section start -->
            <section id="container" class="">
                <header class="header dark-bg">
                    <div class="toggle-nav">
                        <div class="icon-reorder " title="Mostra/Esconde Menu" data-placement="bottom"><i class="icon_menu"></i></div>
                    </div>

                    <!--logo start-->
                    <a href="index.php" class="logo">Biblioteca <span class="lite">Pessoal</span></a>
                    <!--logo end-->

                    <div class="nav search-row search-max-740" id="top_menu" data-placement="bottom">
                        <!--  search form start -->
                        <ul class="nav top-menu">                    
                            <li>
                                <form class="navbar-form" id="form_pesquisa" action="buscarlivros.php" method="post">
                                    <input class="form-control" name="pesquisar_titulo"  id="pesquisar_titulo" onkeyup="buscarLivroOnline(<?php echo $_SESSION['ses-usu-id'] ?>)" placeholder="BUSCA ONLINE" type="text">
                                    <input type="hidden" id="hidden_buscar" name="hidden_buscar">
                                    <input type="hidden" id="click" name="click">
                                </form>
                            </li>                    
                        </ul>
                        <script>
                            $("#pesquisar_titulo").keypress(function (e) {
                                if (e.which == 13) {
                                    $("#click").val(1);
                                }
                            });
                        </script>
                        <!--  search form end -->                
                    </div>

                    <div class="top-nav notification-row">                
                        <!-- notificatoin dropdown start-->
                        <ul class="nav pull-right top-menu">
                            <!-- inbox notificatoin start-->
                            <li id="mail_notificatoin_bar" class="dropdown">
                                <a data-toggle="dropdown" class="dropdown-toggle " title="Suas mensagens" data-placement="bottom" href="#">
                                    <i class="icon-envelope-l"></i>
                                    <span class="badge bg-important" id="totalMsg"></span>
                                </a>
                                <ul class="dropdown-menu extended notification">
                                    <div class="notify-arrow notify-arrow-blue"></div>
                                    <li style="display: none; text-align: center" id="irMsg">
                                        <a href="mensagem.php">Verifique suas mensagens</a>
                                    </li>
                                </ul>
                            </li>
                            <!-- inbox notificatoin end -->
                            <!-- alert notification start-->
                            <li id="alert_notificatoin_bar" class="dropdown">
                                <a data-toggle="dropdown" class="dropdown-toggle" title="Suas notificações" href="#">
                                    <i class="icon-bell-l"></i>
                                    <span class="badge bg-important" id="totalNtf"></span>
                                </a>
                                <ul class="dropdown-menu extended notification">
                                    <div class="notify-arrow notify-arrow-blue"></div>
                                    <li style="display: none; text-align: center" id="irEmpr">
                                        <a href="listaremprestimosobtidos.php">Verifique seus empréstimos</a>
                                    </li>
                                </ul> 
                            </li>
                            <!-- alert notification end-->
                            <!-- user login dropdown start-->
                            <li class="dropdown">
                                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                    <span class="profile-ava">
                                        <img alt="" width="38px" height="38px" src="../img/pessoas/<?php echo $_SESSION['ses-usu-img'] != '' ? $_SESSION['ses-usu-img'] : 'sem_imagem.jpg' ?>">
                                    </span>
                                    <span class="username"><?php
                                        if (isset($_SESSION['ses-usu-id']))
                                            echo $_SESSION['ses-usu-nome'];
                                        else
                                            echo 'Login';
                                        ?>
                                    </span>
                                    <b class="caret"></b>
                                </a>
                                <ul class="dropdown-menu extended logout">
                                    <div class="log-arrow-up"></div>
                                    <li class="eborder-top">
                                        <a href="editarpessoa.php"><i class="icon_profile"></i> Meu Perfil</a>
                                    </li>
                                    <li>
                                        <a href="../controles/logout.php"><i class="icon_key_alt"></i> Logout</a>
                                    </li>
                                </ul>
                            </li>
                            <!-- user login dropdown end -->
                        </ul>
                        <!-- notificatoin dropdown end-->
                    </div>
                </header>      
                <!--header end-->



                <!--sidebar start-->
                <aside>
                    <div id="sidebar"  class="nav-collapse">
                        <!-- sidebar menu start-->
                        <ul class="sidebar-menu"> 
                            <li class="sidebar-search search-minha">                                   
                                <input class="form-control" name="pesquisar_titulo_mobile"  id="pesquisar_titulo_mobile" onkeyup="buscarLivroOnlineMobile(<?php echo $_SESSION['ses-usu-id'] ?>)" placeholder="BUSCA ONLINE" type="text">
                                <!--<input type="hidden" id="hidden_buscar_mobile" name="hidden_buscar_mobile">-->
                            </li>

                            <!--Mostra mensagem e notificação quando tela <=512px -->
                            <li>
                            <li class="dropdown notification-minha">
                                <a data-toggle="dropdown" class="dropdown-toggle" title="Suas mensagens" data-placement="bottom" href="#">
                                    <i class="icon-envelope-l"></i>
                                    <span class="badge bg-important" id="totalMsgMobile"></span>
                                </a>
                                <ul class="dropdown-menu extended inbox">
                                    <div class="notify-arrow notify-arrow-blue"></div>
                                    <li style="display: none;" id="irMsgMobile">
                                        <a href="mensagem.php">Verifique suas mensagens</a>
                                    </li>
                                </ul>
                            </li>
                            <!-- inbox notificatoin end -->
                            <!-- alert notification start-->
                            <li class="dropdown notification-minha">
                                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                    <i class="icon-bell-l"></i>
                                    <span class="badge bg-important" id="totalNtfMobile"></span>
                                </a>
                                <ul class="dropdown-menu extended notification">
                                    <div class="notify-arrow notify-arrow-blue"></div>
                                    <li style="display: none;" id="irEmprMobile">
                                        <a href="listaremprestimosobtidos.php">Verifique seus empréstimos</a>
                                    </li>
                                </ul>
                            </li>
                            <!-- alert notification end-->
                            <!-- user login dropdown start-->
                            <li class="dropdown login-max-412">
                                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                    <span class="profile-ava">
                                        <img alt="" width="28px" height="28px" src="../img/pessoas/<?php echo $_SESSION['ses-usu-img'] != '' ? $_SESSION['ses-usu-img'] : 'sem_imagem.jpg' ?>">
                                    </span>
                                    <span class="username"><?php
                                        if (isset($_SESSION['ses-usu-id']))
                                            echo $_SESSION['ses-usu-nome'];
                                        else
                                            echo 'Login';
                                        ?>
                                    </span>
                                    <b class="caret"></b>
                                </a>
                                <ul class="dropdown-menu extended logout">
                                    <div class="log-arrow-up"></div>
                                    <li class="eborder-top">
                                        <a href="editarpessoa.php"><i class="icon_profile"></i> Meu Perfil</a>
                                    </li>
                                    <li>
                                        <a href="../controles/logout.php"><i class="icon_key_alt"></i> Logout</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a class="" href="index.php">
                                    <i class="icon_house_alt"></i>
                                    <span>Home</span>
                                </a>
                            </li>
                            <li class="sub-menu">
                                <a href="javascript:;" class="">
                                    <i class="icon_book_alt"></i>
                                    <span>Meu livro</span>
                                    <span class="menu-arrow arrow_carrot-right"></span>
                                </a>
                                <ul class="sub">
                                    <li><a class="" href="cadastrarlivro.php">Cadastrar</a></li>                          
                                    <li><a class="" href="listarlivros.php">Listar</a></li>
                                </ul>
                            </li> 
                            <li class="sub-menu">
                                <a href="javascript:;" class="">
                                    <i class="icon_drawer"></i>
                                    <span>Minha estante</span>
                                    <span class="menu-arrow arrow_carrot-right"></span>
                                </a>
                                <ul class="sub">
                                    <li><a class="" href="cadastrarestante.php">Cadastrar</a></li>                          
                                    <li><a class="" href="listarestantes.php">Listar</a></li>
                                </ul>
                            </li> 
                            <li class="sub-menu">
                                <a href="javascript:;" class="">
                                    <i class="icon_table"></i>
                                    <span>Minha prateleira</span>
                                    <span class="menu-arrow arrow_carrot-right"></span>
                                </a>
                                <ul class="sub">
                                    <li><a class="" href="cadastrarprateleira.php">Cadastrar</a></li>                          
                                    <li><a class="" href="listarprateleiras.php">Listar</a></li>
                                </ul>
                            </li>
                            <li class="sub-menu">
                                <a href="javascript:;" class="">
                                    <i class="fa fa-exchange"></i>
                                    <span>Empréstimos</span>
                                    <span class="menu-arrow arrow_carrot-right"></span>
                                </a>
                                <ul class="sub">
                                    <li><a class="" href="geraremprestimo.php">Gerar</a></li>                          
                                    <li><a class="" href="listaremprestimos.php">Concedidos</a></li>
                                    <li><a class="" href="listaremprestimosobtidos.php">Retirados</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="mensagem.php">
                                    <i class="icon_mail_alt"></i>
                                    <span>Mensagens</span>
                                </a>
                            </li>
                        </ul>
                        <!-- sidebar menu end-->
                    </div>
                </aside>
                <!--sidebar end-->

                <!--main content start-->
                <section id="main-content">
                    <section class="wrapper">
                        <div class="row">
                            <div class="col-lg-12">
                                <h3 class="page-header"><i class="fa fa-exchange"></i>Empréstimos concedidos</h3>
                                <!--                                <ol class="breadcrumb">
                                                                    <li><i class="fa fa-home"></i><a href="index.php">Home</a></li>
                                                                    <li><i class="fa fa-exchange"></i>Empréstimos gerados</li>
                                                                </ol>-->
                            </div>
                        </div>



                        <?php
                        require_once (__DIR__ . '/../controles/emprestimo.php');
                        ?>

                        <!--
                                               <div class="row">
                                                   <div class="col-lg-12">
                                                       <section class="panel">
                       
                        <!--Campos de titulo e de quantidade de registro por página                                                         
                        <div style="padding-left: 0!important" class="input-group col-xs-7"> 
                            <span style="border:none;" class="input-group-addon"><i class="fa fa-search" aria-hidden="true"></i></span>
                            <input style="border:none;" class="form-control" id="pesquisar_emprestimo" name="pesquisar_emprestimo" onkeyup="listarEmprestimos(0,<?= $_SESSION['ses-usu-id'] ?>);" placeholder="Buscar meus emprestimos" type="text">
                        </div>                       



                        <div class="col-lg-2" style="float: right; margin-bottom: 4px; margin-top: -5px;">
                            <select onchange="listarEmprestimos(<?= $_SESSION['ses-usu-id'] ?>);" id="quantidade_emprestimos" style="margin-top: 9px;" class="form-control">
                                <option value="5">5 linhas por página</option>
                                <option value="10">10 linhas por página</option>
                                <option value="20">20 linhas por página</option>
                                <option value="50">50 linhas por página</option>
                            </select>
                        </div>

                       

                        <table class="table table-striped table-advance table-hover">
                            <tr>
                                <th><i class="fa fa-book"></i> Título</th>
                                <th><i class="icon_profile"></i> Pessoa</th>
                                <th><i class="fa fa-calendar"></i> Data</th>
                                <th><i class="fa fa-calendar"></i> Data prevista</th>
                                <th><i class="fa fa-calendar"></i> Data devolução</th>
                                <th><i class="fa fa-comment-o"></i> Observação</th>                                           
                                <th style="text-align: left"><i class="fa fa-thumbs-o-up"></i> Devolvido</th>
                            </tr>
                            <tbody class="paginacao_ajax">
                        <!--AQUI O AJAX ESCREVE DADOS DE EMPRESTIMOS
                    </tbody>
                </table>
                <nav class="paginas" style="text-align: center">

                </nav>
                <div id="carregando_ajax" style="text-align: center" ></div>
            
                       

                </div>
            </div> -->

                        <!-- page start-->
                        <div class="row">
                            <div class="col-lg-12">
                                <section class="panel">
                                    <header class="panel-heading tab-bg-info">
                                        <ul class="nav nav-tabs">
                                            <li class="active">
                                                <a data-toggle="tab" href="#pendentes">
                                                    <i class="icon-home"></i>
                                                    Pendentes
                                                </a>
                                            </li>
                                            <li onclick="listarEmprestimos(1,<?= $_SESSION['ses-usu-id'] ?>);">
                                                <a data-toggle="tab" href="#finalizados">
                                                    <i class="icon-user"></i>
                                                    Finalizados
                                                </a>
                                            </li>
                                        </ul>
                                    </header>
                                    <div class="panel-body">
                                        <div class="tab-content">
                                            <!--pendentes-->
                                            <div id="pendentes" class="tab-pane active">
                                                <section class="panel">  
                                                    <div class="profile-activity panel-body">  
                                                        <table class="table table-striped table-advance table-hover">
                                                            <tr>
                                                                <th><i class="fa fa-book"></i> Título</th>
                                                                <th><i class="icon_profile"></i> Pessoa</th>
                                                                <th><i class="fa fa-calendar"></i> Data</th>
                                                                <th><i class="fa fa-calendar"></i> Data prevista</th>
                                                                <th><i class="fa fa-calendar"></i> Data devolução</th>
                                                                <th><i class="fa fa-comment-o"></i> Observação</th>                                           
                                                                <th style="text-align: left"><i class="fa fa-thumbs-o-up"></i> Devolvido</th>
                                                            </tr>
                                                            <tbody class="pendentes">
                                                                <!--AQUI O AJAX ESCREVE DADOS DE EMPRESTIMOS-->
                                                            </tbody>
                                                        </table>
                                                        <nav class="paginas" style="text-align: center">

                                                        </nav>
                                                        <div id="carregando_ajax" style="text-align: center" ></div>
                                                    </div>
                                                </section>
                                            </div>
                                            <!-- finalizados -->
                                            <div id="finalizados" class="tab-pane">
                                                <section class="panel">                                                                        
                                                    <div class="panel-body">
                                                        <table class="table table-striped table-advance table-hover">
                                                            <tr>
                                                                <th><i class="fa fa-book"></i> Título</th>
                                                                <th><i class="icon_profile"></i> Pessoa</th>
                                                                <th><i class="fa fa-calendar"></i> Data</th>
                                                                <th><i class="fa fa-calendar"></i> Data prevista</th>
                                                                <th><i class="fa fa-calendar"></i> Data devolução</th>
                                                                <th><i class="fa fa-comment-o"></i> Observação</th>                                           
                                                                <th style="text-align: left"><i class="fa fa-thumbs-o-up"></i> Devolvido</th>
                                                            </tr>
                                                            <tbody class="finalizados">
                                                                <!--AQUI O AJAX ESCREVE DADOS DE EMPRESTIMOS-->
                                                            </tbody>
                                                        </table>
                                                        <nav class="paginas" style="text-align: center">

                                                        </nav>
                                                        <div id="carregando_ajax" style="text-align: center" ></div>
                                                    </div>
                                                </section>
                                                <section>
                                                    <div class="row">                                              
                                                    </div>
                                                </section>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>

                        <!-- page end-->
                    </section>
                    <div class="footer rodape">
                        <div class="row rodape-margin" >
                            <div class="col-sm-offset-1 col-sm-3"><span class="rodape-span-biblioteca">BIBLIOTECAPESSOAL</span>.com 
                                <p>O Bibliotecapessoal.com é um sistema de gerenciamento de livros pessoais e de acesso à títulos de outros usuários.</p>
                                <p style="margin-top: 20px;"> 
                                    <?php echo 'Copyright &copy ' . date('Y') . ' Érico N. Dalprá - Todos os direitos reservados' ?>
                                </p>
                                <div>
                                    <div class="credits">                           
                                        <a href="https://bootstrapmade.com/free-business-bootstrap-themes-website-templates/">Business Bootstrap Themes</a> by <a href="https://bootstrapmade.com/">BootstrapMade</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-offset-1  col-sm-4"><span class="rodape-span-template">Sobre</span>
                                <div>
                                    Sistema desenvolvido como Trabalho de Conclusão do Curso de Tecnologia em Sistemas Para Internet sob orientação do professor Me. Maikon Cismoski dos Santos - IFSul
                                </div>
                            </div>
                            <div class="col-lg-offset-1 col-sm-2">
                                <span class="rodape-span-suporte">Suporte</span>
                                <p><a href="https://www.facebook.com/erico.dalpra?ref=bookmarks" target="_blank"> <i class="fa fa-facebook-square fa-3x" aria-hidden="true"></i> </a></p>
                            </div>
                        </div>
                        <div class="row rodape-margin" >                  
                        </div>
                    </div>
                </section>









                <!-- Modal devolução-->
                <div id="modalDevolver" class="modal fade" role="dialog">
                    <div class="modal-dialog modal-sm">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h3 class="modal-title">Devolução</h3>
                            </div>
                            <div class="modal-body">
                                <div class="panel-body bio-graph-info">
                                    <form class="form-horizontal" role="form" action="" method="post">                                                  
                                        <div class="form-group">
                                            <!--<label class="col-lg-2 control-label">Data</label>-->
                                            <div class="col-lg-10">
                                                <input type="text" class="form-control calendario"  id="data" required="required" placeholder="Data">
                                            </div>
                                        </div> 
                                        <div class="form-group">
                                            <!--<label class="col-lg-2 control-label">Descrição</label>-->
                                            <div class="col-lg-10">
                                                <!--<input type="text" class="form-control calendario"  id="descricao" required="required" class="form-control calendario"  id="descricao">-->
                                                <textarea class="form-control"  id="descricao" class="form-control calendario" placeholder="Descreva o usuário quanto a este empréstimo."  id="descricao">
                                                                                            
                                                </textarea>
                                            </div>
                                        </div> 
                                        <div class="form-group">
                                            <div class="col-lg-10">
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="devolvido" value="sim">
                                                        Devolvido
                                                    </label>
                                                </div>
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="devolvido" value="nao" checked>
                                                        Não Devolvido
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <!--<label class="col-lg-2 control-label">Nota</label>-->
                                            <div class=" col-lg-10">
                                                <div class="barra">
                                                    <span class="bg"></span>
                                                    <div class="estrelas">
                                                        <span class="star" id="1">
                                                            <span class="starAbsolute"></span>
                                                        </span>
                                                        <span class="star" id="2">
                                                            <span class="starAbsolute"></span>
                                                        </span>
                                                        <span class="star" id="3">
                                                            <span class="starAbsolute"></span>
                                                        </span>
                                                        <span class="star" id="4">
                                                            <span class="starAbsolute"></span>
                                                        </span>
                                                        <span class="star" id="5">
                                                            <span class="starAbsolute"></span>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" id="nota" name="nota">
                                        <div class="form-group">
                                            <div class="col-lg-10">
                                                <button type="button" onclick="devolver()" class="btn btn-primary">Salvar</button>
                                            </div>
                                            <input type="hidden" id="id_"><!--Javascript seta o id e o recupera-->
                                            <input type="hidden" id="pessoa_id" value="<?php echo $_SESSION['ses-usu-id'] ?>">
                                            <input type="hidden" id="pessoa_emprestou">
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" id="closemodal" class="btn btn-default" data-dismiss="modal">Fechar</button>
                            </div>
                        </div>
                    </div>
                </div>


                <!--        <input type="hidden" name="nome" id="nome">-->    
                <input type="hidden" name="destinatario" id="destinatario">
                <!-- Modal Mensagem-->
                <div id="myModal" name="modal" class="modal fade" role="dialog">
                    <div class="modal-dialog modal-sm">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h3 class="modal-title"><div id="nome"></div></h3>
                            </div>
                            <div class="modal-body">
                                <div class="panel-body bio-graph-info">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <textarea id="conteudoMsg" style="width: 100%; border-radius: 10px 10px 10px 10px" placeholder="Sua mensagem..."></textarea>
                                        </div>
                                        <button type="submit" onclick="enviarMensagem($('#conteudoMsg').val(),<?php echo $_SESSION['ses-usu-id'] ?>, $('#destinatario').val(), 1)" class="btn btn-info">Enviar</button>
                                    </div>  
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <script src="../template/js/jquery.js"></script>
                <script src="../jqueryUI/jquery.ui.datepicker-pt-BR.js"></script>
                <script src="../jqueryUI/jquery-ui.js"></script>
                <script src="../jqueryUI/jquery-ui.min.js"></script>
                <script src="../jqueryUI/jquery-ui.js"></script>
                <!-- CSS jQueryUI -->
                <link href="../jqueryUI/jquery-ui.css" rel="stylesheet">
                <link href="../jqueryUI/jquery-ui.min.css" rel="stylesheet">
                <link href="../jqueryUI/jquery-ui.structure.css">
                <link href="../jqueryUI/jquery-ui.structure.min.css">
                <link href="../jqueryUI/jquery-ui.theme.css">
                <link href="../jqueryUI/jquery-ui.theme.min.css">
                <script src="../javascript/meuscript.js"></script>
                <script src="../template/js/bootstrap.min.js"></script>
                <script src="../template/js/jquery.scrollTo.min.js"></script>
                <script src="../template/js/jquery.nicescroll.js" type="text/javascript"></script>
                <script src="../template/js/scripts.js"></script>
                <script src="../template/js/jquery.autosize.min.js"></script>
                <script src="../template/js/jquery.placeholder.min.js"></script>             	
                <script src="../template/js/morris.min.js"></script>
                <script src="../template/js/sparklines.js"></script>	             
                <script src="../template/js/jquery.slimscroll.min.js"></script>

                <script>
                                            setInterval(function () {
                                                totalMensagensNaoLidas(<?php echo $_SESSION['ses-usu-id'] ?>);
                                            }, 5000);
                                            //Chama função pela primeira vez sem esperar 
                                            totalMensagensNaoLidas(<?php echo $_SESSION['ses-usu-id'] ?>);
                </script>
        </body>
    </html>

    <?php
} else {
    require_once(__DIR__ . '/../bibliotecas/URL.php');
    URL::redirecionar("login.php");
}








