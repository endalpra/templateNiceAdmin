<?php
session_start();
//Não deixa mostrar os possíveis erros
error_reporting(0);
ini_set("display_errors", 0);

if (isset($_SESSION['ses-usu-id'])) {
    require_once (__DIR__ . '/../controles/verificasessao.php');
    ?>
    <!DOCTYPE html>
    <html lang="pt">
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="description" content="O Bibliotecapessoal.com é um sistema de gerenciamento de livros pessoais e de acesso à títulos de outros usuários.">
            <meta name="keywords" content="Biblioteca, Biblioteca Pessoal, Empréstimo de livros">
            <meta name="robot" content="all">
            <meta name="rating" content="general">
            <meta name="distribution" content="global"> 
            <meta name="author" content="Érico N. Dalprá">
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

            <!--Plugin Wookmark CSS Reset -->
            <link rel="stylesheet" href="../bower_components/normalize.css/normalize.css">
            <!-- Global CSS for the page and tiles -->
            <link rel="stylesheet" href="../plugins/wookmark/css/main.css">


        </head>

        <body>

            <!-- container section start -->
            <section id="container" class="">
                <header class="header dark-bg">
                    <div class="toggle-nav">
                        <div class="icon-reorder" title="Mostra/Esconde Menu" data-placement="bottom"><i class="icon_menu"></i></div>
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
                        <!--  search form end -->                
                    </div>
                    <script>
                        //                        $("#document").ready(function(){
                        //                           $("#mail_notificatoin_bar").click(function(){
                        //                              redirecionar("mensagem.php"); 
                        //                           }); 
                        //                           $("#alert_notificatoin_bar").click(function(){
                        //                              redirecionar("notificacoes.php"); 
                        //                           });
                        //});
                    </script>

                    <div class="top-nav notification-row">                
                        <!-- notificatoin dropdown start-->
                        <ul class="nav pull-right top-menu">
                            <!-- inbox notificatoin start-->
                            <li id="mail_notificatoin_bar" class="dropdown">
                                <a data-toggle="dropdown" class="dropdown-toggle" title="Suas mensagens" data-placement="bottom" href="#">
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
                                        ?></span>
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
                                <h3 class="page-header"><i class="fa fa-book"></i> Ultimos livros cadastrados</h3>
                            </div>
                        </div>
                        <!--Plugin WOOKMARK-->
                        <ul class="tiles-wrap animated" style="right:0px !important" id="wookmark1">
                            <!-- These are our grid blocks -->
                            <?php
                            require_once (__DIR__ . '/../controles/index.php');
                            //Altura das imagens do mosaico
                            //$altura = [70, 120, 70, 165, 130, 60, 70, 245, 115, 80, 190, 110, 85];
                            //$altura = [120, 130, 120, 130, 120, 130, 120, 110, 130, 120, 120, 110, 120, 110, 130, 120, 110, 130];
                            $i = 0;
                            foreach ($livros as $l):
                                if ($i == QTD_LIVROS_INDEX)
                                    break;
                                ?>
                                <li class="appendLivros"><a onclick="maisDetalhesLivro(<?php echo $l->getId() ?>, 0)"><img src="../img/livros/<?php echo $l->getImagem() ?>" width="177" height="<?php echo 177 ?>"></a><p><?php ?></p></li>
                                <?php
                                $i++;
                            endforeach;
                            ?>
                        </ul>
                        <div style="text-align: center" id="carregando_ajax"></div>
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


        </body>

        <script>
            // maisLivrosIndex();
        </script>

        <!-- Include the plug-in -->
        <script src="../plugins/wookmark/wookmark.js"></script>

        <!-- Once the page is loaded, initalize the plug-in. -->
        <script type="text/javascript">
            function imagens() {
                var wookmark1 = new Wookmark('#wookmark1', {
                    outerOffset: 0, // Optional, the distance to the containers border
                    itemWidth: 187, // Optional, the width of a grid item
                    autoResize: true,
                    flexibleWidth: true
                });
            }
            ;
            $(document).ready(function () {
                imagens();
            });
        </script>
        <script>
            setInterval(function () {
                totalMensagensNaoLidas(<?php echo $_SESSION['ses-usu-id'] ?>);
            }, 5000);
            //Chama função pela primeira vez sem esperar 
            totalMensagensNaoLidas(<?php echo $_SESSION['ses-usu-id'] ?>);
        </script>
        <!--Quando scroll chega ao fim da página carrega mais livros-->
        <script>
            $(window).scroll(function () {
                if (($(window).outerHeight() + $(window).scrollTop()) > ($(document).outerHeight() - 200)) {
                    maisLivrosIndex();
                    console.log("Carregando...")
                }
            });
            //setTimeout(function(){  maisLivrosIndex();},1000)
        </script>



    </html>

    <?php
} else {
    require_once(__DIR__ . '/../bibliotecas/URL.php');
    URL::redirecionar("login.php");
}







