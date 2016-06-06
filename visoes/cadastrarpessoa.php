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


        <script src="../template/js/jquery-ui-1.10.4.min.js"></script>
        <script src="../template/js/jquery-1.8.3.min.js"></script>
        <!--Configuração css do mapa
       <link rel="stylesheet" href="../plugins/jquery-addresspicker-master/demos/demo.css">
        -->

        <script>
            $(function () {
                var addresspicker = $("#addresspicker").addresspicker({
                    componentsFilter: 'country:BR'
                });
                var addresspickerMap = $("#addresspicker_map").addresspicker({
                    regionBias: "br",
                    language: "br",
                    updateCallback: showCallback,
                    mapOptions: {
                        zoom: 4,
                        center: new google.maps.LatLng(-28, -52),
                        scrollwheel: false,
                        mapTypeId: google.maps.MapTypeId.ROADMAP
                    },
                    elements: {
                        map: "#map",
                        lat: "#latitude",
                        lng: "#longitude",
                        street_number: '#street_number',
                        route: '#route',
                        locality: '#cidade',
                        sublocality: '#sublocality',
                        administrative_area_level_3: '#administrative_area_level_3',
                        administrative_area_level_2: '#administrative_area_level_2',
                        administrative_area_level_1: '#estado',
                        country: '#pais',
                        postal_code: '#cep',
                        type: '#type'
                    }
                });

                var gmarker = addresspickerMap.addresspicker("marker");
                gmarker.setVisible(true);
                addresspickerMap.addresspicker("updatePosition");

                $('#reverseGeocode').change(function () {
                    $("#addresspicker_map").addresspicker("option", "reverseGeocode", ($(this).val() === 'true'));
                });

                function showCallback(geocodeResult, parsedGeocodeResult) {
                    $('#callback_result').text(JSON.stringify(parsedGeocodeResult, null, 4));
                }
                // Update zoom field
                var map = $("#addresspicker_map").addresspicker("map");
                google.maps.event.addListener(map, 'idle', function () {
                    $('#zoom').val(map.getZoom());
                });

            });
        </script>
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
                                <span class="badge bg-important">60</span>
                            </a>
                            <ul class="dropdown-menu extended inbox">
                                <div class="notify-arrow notify-arrow-blue"></div>
                                <li>
                                    <p class="blue">You have 5 new messages</p>
                                </li>
                                <!--                                <li>
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
                                                                </li>-->
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
                        <li class="active">
                            <a class="" href="#">
                                <i class="icon_document_alt"></i>
                                <span>Cadastrar pessoa</span>
                            </a>
                        </li>
                        <li class="">
                            <a class="" href="cadastrarlivro.php">
                                <i class="icon_document_alt"></i>
                                <span>Cadastrar livro</span>
                            </a>
                        </li>
                        <!--                        <li class="sub-menu">
                                                    <a href="javascript:;" class="">
                                                        <i class="icon_document_alt"></i>
                                                        <span>Forms</span>
                                                        <span class="menu-arrow arrow_carrot-right"></span>
                                                    </a>
                                                    <ul class="sub">
                                                        <li><a class="" href="form_component.html">Form Elements</a></li>                          
                                                        <li><a class="" href="form_validation.html">Form Validation</a></li>
                                                    </ul>
                                                </li>       -->

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
                            <h3 class="page-header"><i class="fa fa-user-md"></i> Cadastro de usuário</h3>
                            <ol class="breadcrumb">
                                <li><i class="fa fa-home"></i><a href="../index.php">Home</a></li>
                                <li><i class="fa fa-user-md"></i>Cadastrar pessoa</li>
                            </ol>
                        </div>
                    </div>


                    <?php
                    if (isset($_POST['btCadastrar'])) {
                        require_once (__DIR__ . '/../controles/pessoa.php');
                        if (isset($msg)) {
                            echo $msg;
                        } else if (isset($msgErro)) {
                            echo $msgErro;
                            //Pega o valor dos campos e seta no value do formulário
                            $nome = $_POST['nome'];
                            $email = $_POST['email'];
                            $login = $_POST['login'];
                            $senha = $_POST['senha'];
                            $repetir_senha = $_POST['repetir_senha'];
                            $procurar_por_cidade = $_POST['addresspicker_map'];
                            $cidade = $_POST['cidade'];
                            $estado = $_POST['estado'];
                            $pais = $_POST['pais'];
                            //$facebook = $_POST['facebook'];
                            //$whatsapp = $_POST['whatsapp'];
                            $latitude = $_POST['latitude'];
                            $longitude = $_POST['longitude'];
                        }
                    }
                    ?>


                    <!-- page start-->
                    <div class="row">
                        <div class="col-lg-12">
                            <section class="panel">
                                <div class="panel-body">
                                    <div class="tab-content">
                                        <div id="recent-activity" class="tab-pane active">
                                            <div class="profile-activity">                                          
                                                <div class="act-time">                                      
                                                    <div class="activity-body act-in">


                                                        <!-- edit-profile -->
                                                        <div id="edit-profile" class="tab-pane">
                                                            <section class="panel">                                          
                                                                <div class="panel-body bio-graph-info">
                                                                    <h1>Dados pessoais</h1>
                                                                    <form class="form-horizontal" role="form" action="cadastrarpessoa.php" method="post">                                                  
                                                                        <div class="form-group">
                                                                            <label class="col-lg-2 control-label">Nome *</label>
                                                                            <div class="col-lg-6">
                                                                                <input type="text" class="form-control" id="nome" name="nome" value="<?= @$nome ?>" required="required" placeholder=" ">
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label class="col-lg-2 control-label">Email *</label>
                                                                            <div class="col-lg-6">
                                                                                <input type="email" class="form-control" id="email" name="email" value="<?= @$email ?>" required="required" placeholder=" ">
                                                                            </div>
                                                                        </div>
                                                                        <!--                                                        <div class="form-group">
                                                                                                                                    <label class="col-lg-2 control-label">About Me</label>
                                                                                                                                    <div class="col-lg-10">
                                                                                                                                        <textarea name="" id="" class="form-control" cols="30" rows="5"></textarea>
                                                                                                                                    </div>
                                                                                                                                </div>-->
                                                                        <div class="form-group">
                                                                            <label class="col-lg-2 control-label">Login *</label>
                                                                            <div class="col-lg-6">
                                                                                <input type="text" class="form-control" id="login" name="login" value="<?= @$login ?>" required="required" placeholder=" ">
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label class="col-lg-2 control-label">Senha *</label>
                                                                            <div class="col-lg-6">
                                                                                <input type="password" class="form-control" id="senha" name="senha" value="<?= @$senha ?>" required="required" placeholder=" ">
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group linha">
                                                                            <label class="col-lg-2 control-label">Repetir senha *</label>
                                                                            <div class="col-lg-6">
                                                                                <input type="password" class="form-control" id="repetir_senha" name="repetir_senha" required="required" value="<?= @$repetir_senha ?>"  placeholder=" ">
                                                                            </div>
                                                                        </div>
                                                                        <!--                                                                        <div class="form-group">
                                                                                                                                                    <label class="col-lg-2 control-label">Facebook</label>
                                                                                                                                                    <div class="col-lg-6">
                                                                                                                                                        <input type="text" class="form-control" id="facebook" name="facebook" value="<?= $facebook ?>" required="required" placeholder=" ">
                                                                                                                                                    </div>
                                                                                                                                                </div>
                                                                                                                                                <div class="form-group">
                                                                                                                                                    <label class="col-lg-2 control-label">Whatsapp</label>
                                                                                                                                                    <div class="col-lg-6">
                                                                                                                                                        <input type="text" class="form-control" id="whatsapp" name="whatsapp" value="<?= @whatsapp ?>" placeholder="">
                                                                                                                                                    </div>
                                                                                                                                                </div> -->

                                                                        <h1>Dados de endereço</h1>
                                                                        <div class="form-group">
                                                                            <label class="col-lg-2 control-label">Procurar por cidade</label>
                                                                            <div class="col-lg-6">
                                                                                <input type="text" class="form-control" id="addresspicker_map" name="addresspicker_map" value="<?= @$procurar_por_cidade ?>" required="required" placeholder="Passo Fundo">
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label class="col-lg-2 control-label">Cidade *</label>
                                                                            <div class="col-lg-6">
                                                                                <input type="text" readonly="true" class="form-control" id="cidade" name="cidade" value="<?= @$cidade ?>" placeholder=" ">
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label class="col-lg-2 control-label">Estado *</label>
                                                                            <div class="col-lg-6">
                                                                                <input type="text" readonly="true" class="form-control" id="estado" name="estado" value="<?= @$estado ?>" placeholder=" ">
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label class="col-lg-2 control-label">País</label>
                                                                            <div class="col-lg-6">
                                                                                <input type="text" readonly="true" class="form-control" id="pais" name="pais" value="<?= @$pais ?>" placeholder="">
                                                                            </div>
                                                                        </div>  
                                                                        <div class="form-group">
                                                                            <label class="col-lg-2 control-label">Latitude</label>
                                                                            <div class="col-lg-6">
                                                                                <input type="text" readonly="true" class="form-control" id="latitude" name="latitude" value="<?= @$latitude ?>" placeholder="">
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label class="col-lg-2 control-label">Longitude</label>
                                                                            <div class="col-lg-6">
                                                                                <input type="text" readonly="true" class="form-control" id="longitude" name="longitude" value="<?= @$longitude ?>" placeholder="">
                                                                            </div>
                                                                        </div>                                                                      
                                                                        <div class="form-group">
                                                                            <div class="col-lg-offset-2 col-lg-10">
                                                                                <button type="submit" name="btCadastrar" class="btn btn-primary">Save</button>
                                                                                <button type="button" name="btCancelar" class="btn btn-danger">Cancel</button>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </section>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>

                    <!-- page end-->
                </section>
            </section>


            <!--CONFLITO COM O ADDRESSPICKER-->
            <script src="../template/js/jquery.js"></script>
            <script src="../template/js/bootstrap.min.js"></script>
            <!--FIM CONFLITO-->

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

            <!-- Necessários para funcionamento do jquery-addresspicker -->
            <script src="http://maps.google.com/maps/api/js?sensor=false"></script>      
            <script type="text/javascript" src="../template/js/jquery-ui-1.9.2.custom.min.js"></script>
            <script src="../plugins/jquery-addresspicker-master/src/jquery.ui.addresspicker.js"></script>
            <!--Estiliza o jQuery Ui buscar autocompletar-->
            <link rel="stylesheet" href="../plugins/jquery-addresspicker-master/demos/themes/base/jquery.ui.all.css">

            </body>
            </html>
