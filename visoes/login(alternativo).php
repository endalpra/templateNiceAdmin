<?php
session_start();
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

        
    </head>

    <body>
        <!-- container section start -->
        <section id="container" class="">

            <header class="header dark-bg">
                <!--                <div class="toggle-nav">
                                    <div class="icon-reorder tooltips" data-original-title="Mostra/Esconde Menu" data-placement="bottom"><i class="icon_menu"></i></div>
                                </div>-->


                <div class="row">
                    <div class="col-lg-2"></div>
                    <div class="col-lg-4">
                        <!--logo start-->
                        <a href="index.html" class="logo">Biblioteca <span class="lite">Pessoal</span></a>
                        <!--logo end-->
                    </div>
                    <div class="col-lg-1"></div>

                    <div class="col-lg-offset-1 col-lg-2">    
                        <div class="top-nav notification pull-right">                
                            <!-- notificatoin dropdown start-->
                            <ul class="nav  top-menu">                                  
                                <li class="dropdown">
                                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                         <!--   <span class="profile-ava">
                                              <img alt="" src="../template/img/avatar1_small.jpg">
                                          </span>-->
                                        <i class="icon_profile"></i>
                                        <span class="username">LOGIN</span>
                                        <b class="caret"></b>
                                    </a>

                                    <ul class="dropdown-menu extended ">
                                        <div class="log-arrow-up"></div>                                          
                                        <form class="login-form" action="login.php" method="post">        
                                            <div class="login-wrap">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="icon_profile"></i></span>
                                                    <input type="text" name="login" class="form-control" required="required" placeholder="Login" autofocus>
                                                </div>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="icon_key_alt"></i></span>
                                                    <input type="password" name="senha" class="form-control" required="required" placeholder="Senha">
                                                </div>
                                                <!--<label class="checkbox">
                                                    <input type="checkbox" value="remember-me"> Lembrar                                                        
                                                </label>-->
                                                <div class="input-group">
                                                    <span class=""> <a href="#"> Esqueceu sua senha?</a></span>
                                                </div>
                                                <button class="btn btn-primary btn-lg btn-block" name="btLogin" type="submit">Entrar</button>
                                                <!--<button class="btn btn-info btn-lg btn-block" type="submit">Signup</button>-->
                                            </div>
                                        </form>
                                    </ul>
                                </li>
                                <!-- user login dropdown end -->
                            </ul>
                            <!-- notificatoin dropdown end-->
                        </div>
                    </div>
                    <!--col-lg-3-->
                </div>
                <!--row-->
            </header>      
            <!--header end-->



            <!--sidebar start-->


            <section id="">
                <section class="wrapper"> 
                    <div class="row">
                        <div class="col-lg-2"></div>
                        <div class="col-lg-4">
                            <h3> No Biblioteca Pessoal você organiza seus livros de uma maneira descomplicada.
                                Além disso, você amplia sua gama de livros, pois 
                                fica muito simples pesquisar títulos e contatar o dono do livro. 
                                Faça parte desta rede, cadastre-se!
                            </h3>
                            <img src="../img/l.jpg" width="300px" class="img-responsive ">
                        </div>

                        <div class="col-lg-1"></div>
                        <div class="col-lg-3">
                            <!--main content start-->
                            <section>
                                <section>

                                    <?php
                                    if (isset($_POST['btLogin'])) {
                                        require_once (__DIR__ . '/../controles/login.php');
                                    }
                                    ?>


                                    <?php
                                     if (isset($_POST['btCadastrar']) && isset($_POST['latitude']) && isset($_POST['longitude'])
                                            && !empty($_POST['latitude']) && !empty($_POST['longitude'])) {
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
                                            <section class="">
                                                <!--<div class="panel-body">-->
                                                <div class="">
                                                    <div id="" class="tab-pane active">
                                                        <div class="profile-activity">                                          
                                                            <div class="act-time">                                      
                                                                <div class="activity-body act-in">


                                                                    <!-- edit-profile -->
                                                                    <div id="" class="">
                                                                        <section class="">                                          
                                                                            <div class="panel-body bio-graph-info form-abrir-conta" >

                                                                                <form class="form-horizontal" role="form" action="login.php" method="post">                                                  
                                                                                    <div class="row">
                                                                                        <div class="col-lg-12">
                                                                                            <h3 class="page-header"> Abra sua conta</h3>
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="form-group">

                                                                                        <div class="col-lg-12">
                                                                                            <input type="text" class="form-control" id="nome" name="nome" value="<?= @$nome ?>" required="required" placeholder="Nome ">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group">

                                                                                        <div class="col-lg-12">
                                                                                            <input type="email" class="form-control" id="email" name="email" value="<?= @$email ?>" required="required" placeholder="Email ">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <div class="col-lg-12">
                                                                                            <input type="text" class="form-control" id="login" name="login" value="<?= @$login ?>" required="required" placeholder="Login ">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <div class="col-lg-12">
                                                                                            <input type="password" class="form-control" id="senha" name="senha" value="<?= @$senha ?>" required="required" placeholder="Senha ">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group linha">

                                                                                        <div class="col-lg-12">
                                                                                            <input type="password" class="form-control" id="repetir_senha" name="repetir_senha" required="required" value="<?= @$repetir_senha ?>"  placeholder="Repita senha ">
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
                                                                                                                                                            </div> 


                                                                                    <div class="form-group">
                                                                                        <div class="col-lg-12">
                                                                                            <button id="localizacao" type="button" onclick="fc_buscar_mapa();" class="btn btn-primary">Preencher com minha localização</button> Por quê? 
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group">

                                                                                        <div class="col-lg-12">
                                                                                            <input type="text" readonly="true" class="form-control" id="cidade" name="cidade" value="<?= @$cidade ?>" placeholder="Cidade ">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group">

                                                                                        <div class="col-lg-12">
                                                                                            <input type="text" readonly="true" class="form-control" id="estado" name="estado" value="<?= @$estado ?>" placeholder="Estado ">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group">

                                                                                        <div class="col-lg-12">
                                                                                            <input type="text" readonly="true" class="form-control" id="pais" name="pais" value="<?= @$pais ?>" placeholder="País">
                                                                                        </div>
                                                                                    </div>  
                                                                                    <div class="form-group">

                                                                                        <div class="col-lg-12">
                                                                                            <input type="text" readonly="true" class="form-control" id="latitude" name="latitude" value="<?= @$latitude ?>" placeholder="Latitude">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group">

                                                                                        <div class="col-lg-12">
                                                                                            <input type="text" readonly="true" class="form-control" id="longitude" name="longitude" value="<?= @$longitude ?>" placeholder="Longitude">
                                                                                        </div>
                                                                                    </div> -->
                                                                                    <input type="hidden" id="latitude" name="latitude">
                                                                                    <input type="hidden" id="longitude" name="longitude">                                                                                       
                                                                                    <div class="form-group">
                                                                                        <div class="col-lg-12">
                                                                                            <button type="submit" id="btCadastrar" name="btCadastrar" class="btn btn-primary">Abrir conta</button>
                                                                                      
                                                                                            <button type="button" id="btLocalizar" name="btLocalizar" class="btn btn-success">Localizar</button>
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
        </div>
    </div>
</section>




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

<script>// check for Geolocation support
//            if (navigator.geolocation) {
//                console.log('Geolocation is supported!');
//            } else {
//                console.log('Geolocation is not supported for this Browser/OS version yet.');
//            }
            $(document).ready(function(){
               $("#btLocalizar").click(function(){
                                
                var startPos;
                var geoOptions = {
                    timeout: 10 * 1000
                }

                var geoSuccess = function (position) {
                    startPos = position;
                    $("#latitude").val(startPos.coords.latitude);
                    $("#longitude").val(startPos.coords.longitude);
                    //alert(startPos.coords.latitude);
                    //alert(startPos.coords.longitude);
                };
                var geoError = function (error) {
                    console.log('Error occurred. Error code: ' + error.code);
                    // error.code can be:
                    //   0: unknown error
                    //   1: permission denied
                    //   2: position unavailable (error response from location provider)
                    //   3: timed out
                };

                navigator.geolocation.getCurrentPosition(geoSuccess, geoError, geoOptions);
               
               }); 
            });
          
        </script>

</body>
</html>
