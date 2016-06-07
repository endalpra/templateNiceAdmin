<?php
session_start();
if (isset($_SESSION['ses-usu-id'])) {
    ?>
    <!DOCTYPE html>
    <html lang="pt">
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
            <meta name="author" content="GeeksLabs">
            <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
            <link rel="shortcut icon" href="img/favicon.png">

            <title>Título</title>



            <!-- Bootstrap CSS -->    
            <link href="../template/css/bootstrap.min.css" rel="stylesheet">
            <!-- bootstrap theme -->
            <link href="../template/css/bootstrap-theme.css" rel="stylesheet">
            <!--external css-->
            <!-- font icon -->
            <link href="../template/css/elegant-icons-style.css" rel="stylesheet" />
            <link href="../template/css/font-awesome.min.css" rel="stylesheet" />    
            <!-- full calendar css-->
            <link href="../template/assets/fullcalendar/fullcalendar/bootstrap-fullcalendar.css" rel="stylesheet" />
            <link href="../template/assets/fullcalendar/fullcalendar/fullcalendar.css" rel="stylesheet" />
            <!-- easy pie chart-->
            <link href="../template/assets/jquery-easy-pie-chart/jquery.easy-pie-chart.css" rel="stylesheet" type="text/css" media="screen"/>
            <!-- owl carousel -->
            <link rel="stylesheet" href="../template/css/owl.carousel.css" type="text/css">
            <link href="../template/css/jquery-jvectormap-1.2.2.css" rel="stylesheet">
            <!-- Custom styles -->
            <link rel="stylesheet" href="../template/css/fullcalendar.css">
            <link href="../template/css/widgets.css" rel="stylesheet">
            <link href="../template/css/style.css" rel="stylesheet">
            <link href="../template/css/style-responsive.css" rel="stylesheet" />
            <link href="../template/css/xcharts.min.css" rel=" stylesheet">	
            <link href="../template/css/jquery-ui-1.10.4.min.css" rel="stylesheet">
        </head>

        <body onload="listarLivros(0,<?= $_SESSION['ses-usu-id'] ?>, 0, 0)">
            <!-- container section start -->
            <section id="container" class="">


                <header class="header dark-bg">
                    <div class="toggle-nav">
                        <div class="icon-reorder tooltips" title="Mostra/Esconde Menu" data-placement="bottom"><i class="icon_menu"></i></div>
                    </div>

                    <!--logo start-->
                    <a href="index.html" class="logo">Nome <span class="lite"> S.</span></a>
                    <!--logo end-->

                    <div class="nav search-row tooltips search-max-740" id="top_menu" data-original-title="Busque um título" data-placement="bottom">
                        <!--  search form start -->
                        <ul class="nav top-menu">                    
                            <li>
                                <form class="navbar-form">
                                    <input class="form-control" placeholder="Pesquisa" type="text">
                                </form>
                            </li>                    
                        </ul>
                        <!--  search form end -->                
                    </div>

                    <div class="top-nav notification-row">                
                        <!-- notificatoin dropdown start-->
                        <ul class="nav pull-right top-menu">
                            <!-- inbox notificatoin start-->
                            <li id="mail_notificatoin_bar" class="dropdown">
                                <a data-toggle="dropdown" class="dropdown-toggle tooltips" data-original-title="Suas mensagens" data-placement="bottom" href="#">
                                    <i class="icon-envelope-l"></i>
                                    <span class="badge bg-important">6</span>
                                </a>
                                <ul class="dropdown-menu extended inbox">
                                    <div class="notify-arrow notify-arrow-blue"></div>
                                    <li>
                                        <p class="blue">You have 5 new messages</p>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <span class="photo"><img alt="avatar" src="template/img/avatar-mini.jpg"></span>
                                            <span class="subject">
                                                <span class="from">Greg  Martin</span>
                                                <span class="time">1 min</span>
                                            </span>
                                            <span class="message">
                                                I really like this admin panel.
                                            </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <span class="photo"><img alt="avatar" src="template/img/avatar-mini2.jpg"></span>
                                            <span class="subject">
                                                <span class="from">Bob   Mckenzie</span>
                                                <span class="time">5 mins</span>
                                            </span>
                                            <span class="message">
                                                Hi, What is next project plan?
                                            </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <span class="photo"><img alt="avatar" src="template/img/avatar-mini3.jpg"></span>
                                            <span class="subject">
                                                <span class="from">Phillip   Park</span>
                                                <span class="time">2 hrs</span>
                                            </span>
                                            <span class="message">
                                                I am like to buy this Admin Template.
                                            </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <span class="photo"><img alt="avatar" src="template/img/avatar-mini4.jpg"></span>
                                            <span class="subject">
                                                <span class="from">Ray   Munoz</span>
                                                <span class="time">1 day</span>
                                            </span>
                                            <span class="message">
                                                Icon fonts are great.
                                            </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">See all messages</a>
                                    </li>
                                </ul>
                            </li>
                            <!-- inbox notificatoin end -->
                            <!-- alert notification start-->
                            <li id="alert_notificatoin_bar" class="dropdown">
                                <a data-toggle="dropdown" class="dropdown-toggle" href="#">

                                    <i class="icon-bell-l"></i>
                                    <span class="badge bg-important">7</span>
                                </a>
                                <ul class="dropdown-menu extended notification">
                                    <div class="notify-arrow notify-arrow-blue"></div>
                                    <li>
                                        <p class="blue">You have 4 new notifications</p>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <span class="label label-primary"><i class="icon_profile"></i></span> 
                                            Friend Request
                                            <span class="small italic pull-right">5 mins</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <span class="label label-warning"><i class="icon_pin"></i></span>  
                                            John location.
                                            <span class="small italic pull-right">50 mins</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <span class="label label-danger"><i class="icon_book_alt"></i></span> 
                                            Project 3 Completed.
                                            <span class="small italic pull-right">1 hr</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <span class="label label-success"><i class="icon_like"></i></span> 
                                            Mick appreciated your work.
                                            <span class="small italic pull-right"> Today</span>
                                        </a>
                                    </li>                            
                                    <li>
                                        <a href="#">See all notifications</a>
                                    </li>
                                </ul>
                            </li>
                            <!-- alert notification end-->
                            <!-- user login dropdown start-->
                            <li class="dropdown">
                                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                    <span class="profile-ava">
                                        <img alt="" src="template/img/avatar1_small.jpg">
                                    </span>
                                    <span class="username">Jenifer Smith</span>
                                    <b class="caret"></b>
                                </a>
                                <ul class="dropdown-menu extended logout">
                                    <div class="log-arrow-up"></div>
                                    <li class="eborder-top">
                                        <a href="#"><i class="icon_profile"></i> My Profile</a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="icon_mail_alt"></i> My Inbox</a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="icon_clock_alt"></i> Timeline</a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="icon_chat_alt"></i> Chats</a>
                                    </li>
                                    <li>
                                        <a href="login.html"><i class="icon_key_alt"></i> Log Out</a>
                                    </li>
                                    <li>
                                        <a href="documentation.html"><i class="icon_key_alt"></i> Documentation</a>
                                    </li>
                                    <li>
                                        <a href="documentation.html"><i class="icon_key_alt"></i> Documentation</a>
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
                                <input class="form-control" placeholder="Pesquisa" type="text">
                            </li>

                            <!--Mostra mensagem e notificação quando tela <=512px -->
                            <li>
                            <li class="dropdown notification-minha">
                                <a data-toggle="dropdown" class="dropdown-toggle tooltips" data-original-title="Suas mensagens" data-placement="bottom" href="#">
                                    <i class="icon-envelope-l"></i>
                                    <span class="badge bg-important">6</span>
                                </a>
                                <ul class="dropdown-menu extended inbox">
                                    <div class="notify-arrow notify-arrow-blue"></div>
                                    <li>
                                        <p class="blue">You have 5 new messages</p>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <span class="photo"><img alt="avatar" src="./img/avatar-mini.jpg"></span>
                                            <span class="subject">
                                                <span class="from">Greg  Martin</span>
                                                <span class="time">1 min</span>
                                            </span>
                                            <span class="message">
                                                I really like this admin panel.
                                            </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <span class="photo"><img alt="avatar" src="./img/avatar-mini2.jpg"></span>
                                            <span class="subject">
                                                <span class="from">Bob   Mckenzie</span>
                                                <span class="time">5 mins</span>
                                            </span>
                                            <span class="message">
                                                Hi, What is next project plan?
                                            </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <span class="photo"><img alt="avatar" src="./img/avatar-mini3.jpg"></span>
                                            <span class="subject">
                                                <span class="from">Phillip   Park</span>
                                                <span class="time">2 hrs</span>
                                            </span>
                                            <span class="message">
                                                I am like to buy this Admin Template.
                                            </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <span class="photo"><img alt="avatar" src="./img/avatar-mini4.jpg"></span>
                                            <span class="subject">
                                                <span class="from">Ray   Munoz</span>
                                                <span class="time">1 day</span>
                                            </span>
                                            <span class="message">
                                                Icon fonts are great.
                                            </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">See all messages</a>
                                    </li>
                                </ul>
                            </li>
                            <!-- inbox notificatoin end -->
                            <!-- alert notification start-->
                            <li class="dropdown notification-minha">
                                <a data-toggle="dropdown" class="dropdown-toggle" href="#">

                                    <i class="icon-bell-l"></i>
                                    <span class="badge bg-important">7</span>
                                </a>
                                <ul class="dropdown-menu extended notification">
                                    <div class="notify-arrow notify-arrow-blue"></div>
                                    <li>
                                        <p class="blue">You have 4 new notifications</p>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <span class="label label-primary"><i class="icon_profile"></i></span> 
                                            Friend Request
                                            <span class="small italic pull-right">5 mins</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <span class="label label-warning"><i class="icon_pin"></i></span>  
                                            John location.
                                            <span class="small italic pull-right">50 mins</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <span class="label label-danger"><i class="icon_book_alt"></i></span> 
                                            Project 3 Completed.
                                            <span class="small italic pull-right">1 hr</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <span class="label label-success"><i class="icon_like"></i></span> 
                                            Mick appreciated your work.
                                            <span class="small italic pull-right"> Today</span>
                                        </a>
                                    </li>                            
                                    <li>
                                        <a href="#">See all notifications</a>
                                    </li>
                                </ul>
                            </li>
                            <!-- alert notification end-->
                            <!-- user login dropdown start-->
                            <li class="dropdown login-max-412">
                                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                    <span class="profile-ava">
                                        <img alt="" src="template/img/avatar1_small.jpg">
                                    </span>
                                    <span class="username">Jenifer Smith</span>
                                    <b class="caret"></b>
                                </a>
                                <ul class="dropdown-menu extended logout">
                                    <div class="log-arrow-up"></div>
                                    <li class="eborder-top">
                                        <a href="#"><i class="icon_profile"></i> My Profile</a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="icon_mail_alt"></i> My Inbox</a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="icon_clock_alt"></i> Timeline</a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="icon_chat_alt"></i> Chats</a>
                                    </li>
                                    <li>
                                        <a href="login.html"><i class="icon_key_alt"></i> Log Out</a>
                                    </li>
                                    <li>
                                        <a href="documentation.html"><i class="icon_key_alt"></i> Documentation</a>
                                    </li>
                                    <li>
                                        <a href="documentation.html"><i class="icon_key_alt"></i> Documentation</a>
                                    </li>
                                </ul>
                            </li>
                            <!-- user login dropdown end -->
                            </li>


                            <li>
                                <a class="" href="index.php">
                                    <i class="icon_house_alt"></i>
                                    <span>Home</span>
                                </a>
                            </li>
                            <li class="">
                                <a class="" href="cadastrarpessoa.php">
                                    <i class="icon_document_alt"></i>
                                    <span>Cadastrar pessoa</span>
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
                                <h3 class="page-header"><i class="fa fa-user-md"></i> Listagem de livros</h3>
                                <ol class="breadcrumb">
                                    <li><i class="fa fa-home"></i><a href="index.php">Home</a></li>
                                    <li><i class="fa fa-user-md"></i>Listar livros</li>
                                </ol>
                            </div>
                        </div>



                        <?php
                        require_once (__DIR__ . '/../controles/livro.php');
                        ?>


                        <div class="row">
                            <div class="col-lg-12">
                                <section class="panel">
                                    
                                    <!--Campos de titulo e de quantidade de registro por página-->                                                         
                                         <div style="padding-left: 0!important" class="input-group col-xs-6"> 
                                            <span style="border:none;" class="input-group-addon"><i class="fa fa-search" aria-hidden="true"></i></span>
                                            <input style="border:none;" class="form-control" id="pesquisar_titulo" name="pesquisar_titulo" onkeyup="listarLivros(0,<?= $_SESSION['ses-usu-id'] ?>, '', '');" placeholder="Pesquisar livro por título, autor, área ou prateleira" type="text">
                                        </div>                       
                                         <div style="padding-left: 0!important" class="input-group col-xs-6">
                                            <span style="border:none;" class="input-group-addon"><i class="fa fa-search" aria-hidden="true"></i></span>
                                            <input style="border:none;" class="form-control" id="quantidade_titulos" name="quantidade_titulos" onkeyup="listarLivros(0,<?= $_SESSION['ses-usu-id'] ?>, '', '');" placeholder="Quantidade de títulos por página" type="text">
                                         </div>
                                                           

                                    <table class="table table-striped table-advance table-hover">
                                        <tr>
                                            <th><i class="icon_lifesaver"></i> Título</th>
                                            <th><i class="icon_profile"></i> Autor</th>
                                            <th><i class="icon_cloud"></i> Área</th>
                                            <th><i class="icon_table"></i> Prateleira</th>
                                            <th style="text-align: left"><i class="icon_cogs"></i> Ação</th>
                                        </tr>
                                        <tbody class="paginacao_ajax">
                                            <!--AQUI O AJAX ESCREVE DADOS DE ESTANTES-->
                                        </tbody>
                                    </table>
                                    <nav class="paginas" style="text-align: center">

                                    </nav>

                                </section>
                            </div>
                        </div>
                    </section>
                </section>

                <script src="../javascript/meuscript.js"></script>

                <script src="../template/js/jquery.js"></script>
                <script src="../template/js/bootstrap.min.js"></script>


                <!-- nice scroll -->
                <script src="../template/js/jquery.scrollTo.min.js"></script>
                <script src="../template/js/jquery.nicescroll.js" type="text/javascript"></script>
                <!-- charts scripts -->
                <script src="../template/assets/jquery-knob/js/jquery.knob.js"></script>
                <script src="../template/js/jquery.sparkline.js" type="text/javascript"></script>
                <script src="../template/assets/jquery-easy-pie-chart/jquery.easy-pie-chart.js"></script>
                <script src="../template/js/owl.carousel.js" ></script>
                <!-- jQuery full calendar -->
                <<script src="../template/js/fullcalendar.min.js"></script> <!-- Full Google Calendar - Calendar -->
                <script src="../template/assets/fullcalendar/fullcalendar/fullcalendar.js"></script>
                <!--script for this page only-->
                <script src="../template/js/calendar-custom.js"></script>
                <script src="../template/js/jquery.rateit.min.js"></script>
                <!-- custom select -->
                <script src="../template/js/jquery.customSelect.min.js" ></script>
                <script src="../template/assets/chart-master/Chart.js"></script>
                <!--custome script for all page-->
                <script src="../template/js/scripts.js"></script>
                <!-- custom script for this page-->
                <script src="../template/js/sparkline-chart.js"></script>
                <script src="../template/js/easy-pie-chart.js"></script>
                <script src="../template/js/jquery-jvectormap-1.2.2.min.js"></script>
                <script src="../template/js/jquery-jvectormap-world-mill-en.js"></script>
                <script src="../template/js/xcharts.min.js"></script>
                <script src="../template/js/jquery.autosize.min.js"></script>
                <script src="../template/js/jquery.placeholder.min.js"></script>
                <script src="../template/js/gdp-data.js"></script>	
                <script src="../template/js/morris.min.js"></script>
                <script src="../template/js/sparklines.js"></script>	
                <script src="../template/js/charts.js"></script>
                <script src="../template/js/jquery.slimscroll.min.js"></script>
        </body>
    </html>

    <?php
} else {
    require_once(__DIR__ . '/../bibliotecas/URL.php');
    URL::redirecionar("login.php");
}







