<?php
    session_start();
    if(isset($_SESSION['ses-usu-id'])){
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

    <body>
        <!-- container section start -->
        <section id="container" class="">


            <header class="header dark-bg">
                <div class="toggle-nav">
                    <div class="icon-reorder tooltips" data-original-title="Mostra/Esconde Menu" data-placement="bottom"><i class="icon_menu"></i></div>
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
                            <a data-toggle="dropdown" class="dropdown tooltips" data-original-title="Minhas mensagens" data-placement="bottom" href="#">
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
                        <li id="alert_notificatoin_bar" class="dropdown tooltips" data-original-title="Minhas notificações" data-placement="bottom">
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
                                <span class="username"><?php echo $_SESSION['ses-usu-nome'] ?></span>
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
                            <a data-toggle="dropdown" class="dropdown-toggle tooltips" data-original-title="Minhas mensagens" data-placement="bottom" href="#">
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


                        <li class="active">
                            <a class="" href="">
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
<!--                         <li class="sub-menu">
                            <a href="javascript:;" class="">
                                <i class="icon_document_alt"></i>
                                <span>A. conhecimento</span>
                                <span class="menu-arrow arrow_carrot-right"></span>
                            </a>
                            <ul class="sub">
                                <li><a class="" href="cadastrarareadoconhecimento.php">Cadastrar</a></li>                          
                                <li><a class="" href="listarareasdoconhecimento.php">Listar</a></li>
                            </ul>
                        </li> -->
                    </ul>
                    <!-- sidebar menu end-->
                </div>
            </aside>
            <!--sidebar end-->

            <!--main content start-->
            <section id="main-content">
                <section class="wrapper">            
                    <!--overview start-->
                    <div class="row">
                        <div class="col-lg-12">
                            <h3 class="page-header"><i class="fa fa-laptop"></i> Dashboard</h3>
                            <ol class="breadcrumb">
                                <li><i class="fa fa-home"></i><a href="index.html">Home</a></li>
                                <li><i class="fa fa-laptop"></i>Dashboard</li>						  	
                            </ol>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                            <div class="info-box blue-bg">
                                <i class="fa fa-globe"></i>
                                <div class="count">6.674</div>
                                <div class="title">Livros na rede</div>						
                            </div><!--/.info-box-->			
                        </div><!--/.col-->

                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                            <div class="info-box brown-bg">
                                <i class="fa fa-book"></i>
                                <div class="count">78</div>
                                <div class="title">Livros seus</div>						
                            </div><!--/.info-box-->			
                        </div><!--/.col-->	

                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                            <div class="info-box dark-bg">
                                <i class="fa fa-send-o"></i>
                                <div class="count">4</div>
                                <div class="title">Livros emprestados</div>						
                            </div>			
                        </div>

                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                            <div class="info-box green-bg">
                                <i class="fa fa-cubes"></i>
                                <div class="count">1.426</div>
                                <div class="title">Stock</div>						
                            </div>			
                        </div>

                    </div><!--/.row-->


<!--                    <div class="row">
                        <div class="col-lg-9 col-md-12">

                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h2><i class="fa fa-map-marker red"></i><strong>Countries</strong></h2>
                                    <div class="panel-actions">
                                        <a href="index.html#" class="btn-setting"><i class="fa fa-rotate-right"></i></a>
                                        <a href="index.html#" class="btn-minimize"><i class="fa fa-chevron-up"></i></a>
                                        <a href="index.html#" class="btn-close"><i class="fa fa-times"></i></a>
                                    </div>	
                                </div>
                                <div class="panel-body-map">
                                    <div id="map" style="height:380px;"></div>	
                                </div>

                            </div>
                        </div>
                        <div class="col-md-3">
                             List starts 
                            <ul class="today-datas">
                                 List #1 
                                <li>
                                     Graph 
                                    <div><span id="todayspark1" class="spark"></span></div>
                                     Text 
                                    <div class="datas-text">11,500 visitors/day</div>
                                </li>
                                <li>
                                    <div><span id="todayspark2" class="spark"></span></div>
                                    <div class="datas-text">15,000 Pageviews</div>
                                </li>
                                <li>
                                    <div><span id="todayspark3" class="spark"></span></div>
                                    <div class="datas-text">30.55% Bounce Rate</div>
                                </li>
                                <li>
                                    <div><span id="todayspark4" class="spark"></span></div>
                                    <div class="datas-text">$16,00 Revenue/Day</div>
                                </li> 
                                <li>
                                    <div><span id="todayspark5" class="spark"></span></div>
                                    <div class="datas-text">12,000000 visitors every Month</div>
                                </li>                                                                                                              
                            </ul>
                        </div>


                    </div>  -->


                    <!-- Today status end -->



                    <div class="row">

                        <div class="col-lg-9 col-md-12">	
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h2><i class="fa fa-flag-o red"></i><strong>Reputação</strong></h2>
<!--                                    <div class="panel-actions">
                                        <a href="index.html#" class="btn-setting"><i class="fa fa-rotate-right"></i></a>
                                        <a href="index.html#" class="btn-minimize"><i class="fa fa-chevron-up"></i></a>
                                        <a href="index.html#" class="btn-close"><i class="fa fa-times"></i></a>
                                    </div>-->
                                </div>
                                <div class="panel-body">
                                    <table class="table bootstrap-datatable countries">
                                        <thead>
                                            <tr>                                               
                                                <th>Livros não devolvidos</th>                                              
                                                <th>Sua credibilidade</th>
                                            </tr>
                                        </thead>   
                                        <tbody>
                                            <tr>
                                               <td>1</td>
                                                <td>
                                                    <div class="progress thin">
                                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="73" aria-valuemin="0" aria-valuemax="100" style="width: 73%">
                                                        </div>
                                                        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="27" aria-valuemin="0" aria-valuemax="100" style="width: 27%">
                                                        </div>
                                                    </div>
                                                    <span class="sr-only">73%</span>   	
                                                </td>
                                            </tr>
                                            
                                        </tbody>
                                    </table>
                                </div>

                            </div>	

                        </div><!--/col-->
                        <div class="col-md-3">

                            <div class="social-box twitter">
                                <i class="">Anuncie aqui!</i>
                                <ul>
                                    <li>
                                        <strong>256k</strong>
                                        <span>friends</span>
                                    </li>
                                    <li>
                                        <strong>359</strong>
                                        <span>feeds</span>
                                    </li>
                                </ul>
                            </div><!--/social-box-->
                        </div>
                        <div class="col-md-3">

                            <div class="social-box google-plus">
                                <i class="fa ">Anuncie aqui!</i>
                                <ul>
                                    <li>
                                        <strong>962</strong>
                                        <span>followers</span>
                                    </li>
                                    <li>
                                        <strong>256</strong>
                                        <span>circles</span>
                                    </li>
                                </ul>
                            </div><!--/social-box-->			

                        </div><!--/col-->
<!--                        <div class="col-md-3">
                            <div class="social-box facebook">
                                <i class="fa ">Anuncie aqui!</i>
                                <ul>
                                    <li>
                                        <strong>1562k</strong>
                                        <span>followers</span>
                                    </li>
                                    <li>
                                        <strong>2562</strong>
                                        <span>tweets</span>
                                    </li>
                                </ul>
                            </div>/social-box			

                        </div>/col-->

                    </div>



                    <!-- statics end -->




                    <!-- project team & activity start -->
<!--                    <div class="row">
                        <div class="col-md-4 portlets">
                             Widget 
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="pull-left">Message</div>
                                    <div class="widget-icons pull-right">
                                        <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> 
                                        <a href="#" class="wclose"><i class="fa fa-times"></i></a>
                                    </div>  
                                    <div class="clearfix"></div>
                                </div>

                                <div class="panel-body">
                                     Widget content 
                                    <div class="padd sscroll">

                                        <ul class="chats">

                                             Chat by us. Use the class "by-me". 
                                            <li class="by-me">
                                                 Use the class "pull-left" in avatar 
                                                <div class="avatar pull-left">
                                                    <img src="img/user.jpg" alt=""/>
                                                </div>

                                                <div class="chat-content">
                                                     In meta area, first include "name" and then "time" 
                                                    <div class="chat-meta">John Smith <span class="pull-right">3 hours ago</span></div>
                                                    Vivamus diam elit diam, consectetur dapibus adipiscing elit.
                                                    <div class="clearfix"></div>
                                                </div>
                                            </li> 

                                             Chat by other. Use the class "by-other". 
                                            <li class="by-other">
                                                 Use the class "pull-right" in avatar 
                                                <div class="avatar pull-right">
                                                    <img src="img/user22.png" alt=""/>
                                                </div>

                                                <div class="chat-content">
                                                     In the chat meta, first include "time" then "name" 
                                                    <div class="chat-meta">3 hours ago <span class="pull-right">Jenifer Smith</span></div>
                                                    Vivamus diam elit diam, consectetur fconsectetur dapibus adipiscing elit.
                                                    <div class="clearfix"></div>
                                                </div>
                                            </li>   

                                            <li class="by-me">
                                                <div class="avatar pull-left">
                                                    <img src="img/user.jpg" alt=""/>
                                                </div>

                                                <div class="chat-content">
                                                    <div class="chat-meta">John Smith <span class="pull-right">4 hours ago</span></div>
                                                    Vivamus diam elit diam, consectetur fermentum sed dapibus eget, Vivamus consectetur dapibus adipiscing elit.
                                                    <div class="clearfix"></div>
                                                </div>
                                            </li>  

                                            <li class="by-other">
                                                 Use the class "pull-right" in avatar 
                                                <div class="avatar pull-right">
                                                    <img src="img/user22.png" alt=""/>
                                                </div>

                                                <div class="chat-content">
                                                     In the chat meta, first include "time" then "name" 
                                                    <div class="chat-meta">3 hours ago <span class="pull-right">Jenifer Smith</span></div>
                                                    Vivamus diam elit diam, consectetur fermentum sed dapibus eget, Vivamus consectetur dapibus adipiscing elit.
                                                    <div class="clearfix"></div>
                                                </div>
                                            </li>                                                                                  

                                        </ul>

                                    </div>
                                     Widget footer 
                                    <div class="widget-foot">

                                        <form class="form-inline">
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Type your message here...">
                                            </div>
                                            <button type="submit" class="btn btn-info">Send</button>
                                        </form>


                                    </div>
                                </div>


                            </div> 
                        </div>

                        <div class="col-lg-8">
                            Project Activity start
                            <section class="panel">
                                <div class="panel-body progress-panel">
                                    <div class="row">
                                        <div class="col-lg-8 task-progress pull-left">
                                            <h1>To Do Everyday</h1>                                  
                                        </div>
                                        <div class="col-lg-4">
                                            <span class="profile-ava pull-right">
                                                <img alt="" class="simple" src="template/img/avatar1_small.jpg">
                                                Jenifer smith
                                            </span>                                
                                        </div>
                                    </div>
                                </div>
                                <table class="table table-hover personal-task">
                                    <tbody>
                                        <tr>
                                            <td>Today</td>
                                            <td>
                                                web design
                                            </td>
                                            <td>
                                                <span class="badge bg-important">Upload</span>
                                            </td>
                                            <td>
                                                <span class="profile-ava">
                                                    <img alt="" class="simple" src="img/avatar1_small.jpg">
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Yesterday</td>
                                            <td>
                                                Project Design Task
                                            </td>
                                            <td>
                                                <span class="badge bg-success">Task</span>
                                            </td>
                                            <td>
                                                <div id="work-progress2"></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>21-10-14</td>
                                            <td>
                                                Generate Invoice
                                            </td>
                                            <td>
                                                <span class="badge bg-success">Task</span>
                                            </td>
                                            <td>
                                                <div id="work-progress3"></div>
                                            </td>
                                        </tr>                              
                                        <tr>
                                            <td>22-10-14</td>
                                            <td>
                                                Project Testing
                                            </td>
                                            <td>
                                                <span class="badge bg-primary">To-Do</span>
                                            </td>
                                            <td>
                                                <span class="profile-ava">
                                                    <img alt="" class="simple" src="img/avatar1_small.jpg">
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>24-10-14</td>
                                            <td>
                                                Project Release Date
                                            </td>
                                            <td>
                                                <span class="badge bg-info">Milestone</span>
                                            </td>
                                            <td>
                                                <div id="work-progress4"></div>
                                            </td>
                                        </tr>                              
                                        <tr>
                                            <td>28-10-14</td>
                                            <td>
                                                Project Release Date
                                            </td>
                                            <td>
                                                <span class="badge bg-primary">To-Do</span>
                                            </td>
                                            <td>
                                                <div id="work-progress5"></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Last week</td>
                                            <td>
                                                Project Release Date
                                            </td>
                                            <td>
                                                <span class="badge bg-primary">To-Do</span>
                                            </td>
                                            <td>
                                                <div id="work-progress1"></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>last month</td>
                                            <td>
                                                Project Release Date
                                            </td>
                                            <td>
                                                <span class="badge bg-success">To-Do</span>
                                            </td>
                                            <td>
                                                <span class="profile-ava">
                                                    <img alt="" class="simple" src="img/avatar1_small.jpg">
                                                </span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </section>
                            Project Activity end
                        </div>
                    </div><br><br>-->

                    <div class="row">
<!--                        <div class="col-md-6 portlets">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h2><strong>Calendar</strong></h2>
                                    <div class="panel-actions">
                                        <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> 
                                        <a href="#" class="wclose"><i class="fa fa-times"></i></a>
                                    </div>  

                                </div><br><br><br>
                                <div class="panel-body">
                                     Widget content 

                                     Below line produces calendar. I am using FullCalendar plugin. 
                                    <div id="calendar"></div>

                                </div>
                            </div> 

                        </div>-->

<!--                        <div class="col-md-6 portlets">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="pull-left">Quick Post</div>
                                    <div class="widget-icons pull-right">
                                        <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> 
                                        <a href="#" class="wclose"><i class="fa fa-times"></i></a>
                                    </div>  
                                    <div class="clearfix"></div>
                                </div>
                                <div class="panel-body">
                                    <div class="padd">

                                        <div class="form quick-post">
                                             Edit profile form (not working)
                                            <form class="form-horizontal">
                                                 Title 
                                                <div class="form-group">
                                                    <label class="control-label col-lg-2" for="title">Title</label>
                                                    <div class="col-lg-10"> 
                                                        <input type="text" class="form-control" id="title">
                                                    </div>
                                                </div>   
                                                 Content 
                                                <div class="form-group">
                                                    <label class="control-label col-lg-2" for="content">Content</label>
                                                    <div class="col-lg-10">
                                                        <textarea class="form-control" id="content"></textarea>
                                                    </div>
                                                </div>                           
                                                 Cateogry 
                                                <div class="form-group">
                                                    <label class="control-label col-lg-2">Category</label>
                                                    <div class="col-lg-10">                               
                                                        <select class="form-control">
                                                            <option value="">- Choose Cateogry -</option>
                                                            <option value="1">General</option>
                                                            <option value="2">News</option>
                                                            <option value="3">Media</option>
                                                            <option value="4">Funny</option>
                                                        </select>  
                                                    </div>
                                                </div>              
                                                 Tags 
                                                <div class="form-group">
                                                    <label class="control-label col-lg-2" for="tags">Tags</label>
                                                    <div class="col-lg-10">
                                                        <input type="text" class="form-control" id="tags">
                                                    </div>
                                                </div>

                                                 Buttons 
                                                <div class="form-group">
                                                     Buttons 
                                                    <div class="col-lg-offset-2 col-lg-9">
                                                        <button type="submit" class="btn btn-primary">Publish</button>
                                                        <button type="submit" class="btn btn-danger">Save Draft</button>
                                                        <button type="reset" class="btn btn-default">Reset</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>


                                    </div>
                                    <div class="widget-foot">
                                         Footer goes here 
                                    </div>
                                </div>
                            </div>

                        </div>-->

                    </div> 
                    <!-- project team & activity end -->

                </section>
            </section>
            <!--main content end-->
        </section>
        <!-- container section start -->

        <!-- javascripts -->
        <script src="../template/js/jquery.js"></script>
        <script src="../template/js/jquery-ui-1.10.4.min.js"></script>
        <script src="../template/js/jquery-1.8.3.min.js"></script>
        <script type="text/javascript" src="../template/js/jquery-ui-1.9.2.custom.min.js"></script>
        <!-- bootstrap -->
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
        <script>

            //knob
            $(function () {
                $(".knob").knob({
                    'draw': function () {
                        $(this.i).val(this.cv + '%')
                    }
                })
            });

            //carousel
            $(document).ready(function () {
                $("#owl-slider").owlCarousel({
                    navigation: true,
                    slideSpeed: 300,
                    paginationSpeed: 400,
                    singleItem: true

                });
            });

            //custom select box

            $(function () {
                $('select.styled').customSelect();
            });

            /* ---------- Map ---------- */
            $(function () {
                $('#map').vectorMap({
                    map: 'world_mill_en',
                    series: {
                        regions: [{
                                values: gdpData,
                                scale: ['#000', '#000'],
                                normalizeFunction: 'polynomial'
                            }]
                    },
                    backgroundColor: '#eef3f7',
                    onLabelShow: function (e, el, code) {
                        el.html(el.html() + ' (GDP - ' + gdpData[code] + ')');
                    }
                });
            });



        </script>
    </body>
</html>
<?php
    }else{
        echo "Acesso negado!";
    }

