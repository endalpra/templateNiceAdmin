<?php
session_start();
//Não deixa mostrar os possíveis erros
error_reporting(0);
ini_set("display_errors", 0);
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
        <!--<link href="../template/css/widgets.css" rel="stylesheet">-->
        <link href="../template/css/style.css" rel="stylesheet">
        <link href="../template/css/style-responsive.css" rel="stylesheet" />


        <!--Plugin Wookmark CSS Reset -->
        <link rel="stylesheet" href="../bower_components/normalize.css/normalize.css">
        <!-- Global CSS for the page and tiles -->
        <link rel="stylesheet" href="../plugins/wookmark/css/main.css">
    </head>

    <body>
        <!-- container section start -->
        <section id="container" class="">

            <header class="header dark-bg">
                <div class="row">
                    <div class="col-lg-offset-1 col-lg-3">
                        <!--logo start-->
                        <a href="login.php" class="logo">Biblioteca <span class="lite">Pessoal</span></a>
                        <!--logo end-->
                    </div>
                    <div class="col-lg-offset-5 col-lg-2">    
                        <div class="top-nav notification pull-right" style="margin-right: 10px">                
                            <!-- notificatoin dropdown start-->
                            <ul class="nav  top-menu">                                  
                                <li class="dropdown">
                                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
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
                                                <div class="input-group">
                                                    <span class=""> <a id="abrirModalSenha" style="color: #00A0DF !important;cursor: pointer"> Esqueceu sua senha?</a></span>
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
            <?php
            if (isset($_POST['login']) && isset($_POST['senha']) && isset($_POST['btLogin'])) {
                require_once (__DIR__ . '/../controles/login.php');
            }
            ?>



            <div class="container">

                <div id="customContainer"></div>

            </div>


            <!--sidebar start-->


            <section id="mosaico">
                <section class="wrapper"> 
                    <div class="row">
                        <div style="max-width: 949px" class="col-lg-offset-1 col-lg-7">
                            <!--Plugin WOOKMARK-->
                            <ul class="tiles-wrap animated" style="right:0px !important" id="wookmark1">
                                <!-- These are our grid blocks -->

                                <?php
                                require_once (__DIR__ . '/../controles/login.php');
                                //Altura das imagens do mosaico
                                //$altura = [70, 120, 70, 165, 130, 60, 70, 245, 115, 80, 190, 110, 85];
                                $altura = [120, 165, 130, 245, 115, 190, 110];
                                $i = 0;
                                foreach ($livros as $l):
                                    if ($i == (int) QTD_LIVROS_LOGIN)
                                        break;
                                    ?>
                                    <li><a onclick="buscarLivro(<?php echo $l->getId() ?>, 0)"><img src="../img/livros/<?php echo $l->getImagem() ?>" width="177" height="<?php echo $altura[$i] ?>"></a><p></p></li>
                                    <?php
                                    $i++;
                                endforeach;
                                ?>
                            </ul>
                        </div>        


                        <div class="col-lg-0"></div>
                        <div class="col-lg-3">
                            <!--main content start-->
                            <section>
                                <section>



                                    <?php
                                    require_once (__DIR__ . '/../controles/pessoa.php');
                                    if (isset($msg)) {
                                        echo $msg;
                                    } else if (isset($msgErro) && ($msgErro == 10 || $msgErro == 9)) {
                                        //echo $msgErro;
                                        //Pega o valor dos campos e seta no value do formulário
                                        $nome = $_POST['nome'];
                                        $email = $_POST['email'];
                                        $login = $_POST['login'];
                                        $senha = $_POST['senha'];
                                        $repetir_senha = $_POST['repetir_senha'];
                                        $latitude = $_POST['latitude'];
                                        $longitude = $_POST['longitude'];
                                    }
                                    ?>


                                    <div class="">
                                        <div id="" class="tab-pane active">
                                            <div class="profile-activity">                                          
                                                <div class="act-time">                                      
                                                    <div class="activity-body act-in">


                                                        <!-- edit-profile -->
                                                        <div>
                                                            <section class="">                                          
                                                                <div class="panel-body bio-graph-info form-abrir-conta" >


                                                                    <form id="form_cadastro" class="form-horizontal" role="form" action="login.php" method="post">                                                  
                                                                        <div class="row">
                                                                            <?php
                                                                            if (isset($msg)) {
                                                                                echo $msg;
                                                                            }
                                                                            ?>
                                                                            <div class="col-lg-12">
                                                                                <h3 class="page-header"> Abra sua conta</h3>
                                                                            </div>
                                                                        </div>

                                                                        <div class="form-group">

                                                                            <div class="col-lg-12">
                                                                                <input type="text" class="form-control" id="nome" name="nome" value="<?= @$nome ?>" required="required" placeholder="Nome completo">
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
                                                                        <input type="hidden" id="latitude" name="latitude">
                                                                        <input type="hidden" id="longitude" name="longitude">                                                                                       
                                                                        <div class="form-group">
                                                                            <div class="col-lg-12" style="font-size: 10px !important; margin-top: -10px; margin-bottom: 10px;">
                                                                                Ao clicar em Abrir conta você está concordando com nossos <a href="termos.php" target="_blank" style="color: #00A0DF !important;font-size: 10px !important;">termos de uso</a>
                                                                            </div>
                                                                            <div class="col-lg-12">

                                                                                <button type="button" id="btCadastrar" name="btCadastrar" class="btn btn-primary">Abrir conta</button>
                                                                                <input type="text" id="carregando_ajax" style="background: transparent; border: none; margin-left: 15px; width: 28px; height: 25px">

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

            <section id="um_livro" style="display: none">
                <section class="wrapper">
                    <div class="row"  >  
                        <div class="col-lg-offset-3 col-lg-6">
                            <div class="col-lg-6"id="livro_imagem"></div>
                            <div class="col-lg-6">
                                <table class="table table-inbox" style="border: none;">
                                    <tr>
                                        <td  id="l_titulo" style="font-size: 30px; border-top: none;  cursor: default !important;"></td>
                                    </tr>
                                    <tr>
                                        <td id="l_autor" style="font-size: 20px; border-top: none;  cursor: default !important;"></td>
                                    </tr>
                                    <tr>
                                        <td id="l_descricao" style="font-size: 20px; border-top: none; cursor: default !important;"></td>
                                    </tr>                                
                                    <tr>
                                        <td id="l_acao" style="font-size: 20px; border-top: none; ">Encontre este livro!<a href="login.php"> Cadastre-se</a></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </section>
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





        <!-- Modal Cadastro Editora-->
        <div id="modalSenha" class="modal fade" role="dialog">
            <div class="modal-dialog modal-sm">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h3 class="modal-title">Recuperar senha</h3>
                    </div>
                    <div class="modal-body">
                        <div class="panel-body bio-graph-info">
                            <div class="col-md-12">
                                <p style="color: #00A0DF !important;font-size: 12px !important;">                                 
                                    Por favor, digite o email cadastrado no ato de abertura da conta.
                                </p>
                                <div class="form-group">
                                    <input class="form-control" name="email_senha"  id="email_senha" placeholder="Digite o email cadastrado no sistema" type="text">    
                                </div>
                                <button type="button" id="enviar_email_senha" onclick="" class="btn btn-info">Enviar</button>
                            </div>  
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <script src="../template/js/jquery.js"></script>
        <script src="../jqueryUI/jquery-ui.js"></script>
        <script src="../jqueryUI/jquery-ui.min.js"></script>
        <!-- CSS jQueryUI 
        <link href="../jqueryUI/jquery-ui.css" rel="stylesheet">
        <link href="../jqueryUI/jquery-ui.min.css" rel="stylesheet">
        <!--<link href="../jqueryUI/jquery-ui.structure.css">
            <link href="../jqueryUI/jquery-ui.structure.min.css">
            <link href="../jqueryUI/jquery-ui.theme.css">
            <link href="../jqueryUI/jquery-ui.theme.min.css">-->
        <script src="../javascript/meuscript.js"></script>
        <script src="../template/js/bootstrap.min.js"></script>
        <script src="../template/js/scripts.js"></script>
        <script src="../template/js/jquery.scrollTo.min.js"></script>
        <script src="../template/js/jquery.nicescroll.js" type="text/javascript"></script>
        <!--<script src="../template/js/jquery.autosize.min.js"></script>
        <script src="../template/js/jquery.placeholder.min.js"></script>             	
        <script src="../template/js/morris.min.js"></script>
        <script src="../template/js/sparklines.js"></script>	             
        <script src="../template/js/jquery.slimscroll.min.js"></script>
        -->
        <!-- Include the plug-in -->
        <script src="../plugins/wookmark/wookmark.js"></script>
        <!-- Once the page is loaded, initalize the plug-in. -->
        <script type="text/javascript">
                                    window.onload = function () {
                                        var wookmark1 = new Wookmark('#wookmark1', {
                                            outerOffset: 0, // Optional, the distance to the containers border
                                            itemWidth: 187, // Optional, the width of a grid item
                                            autoResize: true,
                                            flexibleWidth: true
                                        });

//                                            var wookmark2 = new Wookmark('#wookmark2', {
//                                                outerOffset: 10, // Optional, the distance to the containers border
//                                                itemWidth: 210 // Optional, the width of a grid item
//                                            });
                                    };
        </script>


        <script type="text/javascript" src="../plugins/noty_2.3.8/js/noty/packaged/jquery.noty.packaged.js"></script>
        <script type="text/javascript">

                                    function abrirNoty(msg) {
                                        $.noty.consumeAlert({layout: 'bottom', type: 'warning', dismissQueue: true});
                                        alert(msg);
                                    }




        </script>


        <script>// check for Geolocation support
            //            if (navigator.geolocation) {
            //                console.log('Geolocation is supported!');
            //            } else {
            //                console.log('Geolocation is not supported for this Browser/OS version yet.');
            //            }
            $(document).ready(function () {
                //Abre modal de recuperação de senha ao clique em Esqueceu sua senha        
                $("#abrirModalSenha").click(function () {
                    $("#modalSenha").modal();
                });
                //Ao clicar em Enviar no modal de redefinição de senha chama função e fecha modal
                $("#enviar_email_senha").click(function () {
                    recuperaSenha($("#email_senha").val());
                    $("#modalSenha").hide();
                });

                $("#btCadastrar").click(function () {

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

                    if ($("#nome").val() !== "" && $("#email").val() !== "" && $("#login").val() !== "" && $("#senha").val() !== "" && $("#repetir_senha").val() !== "") {
                        $("#carregando_ajax").addClass("ui-autocomplete-loading-cadastro-pessoa");
                        setTimeout(function () {
                            if ($("#latitude").val() == "" || $("#longitude").val() == "") {
                                $("#carregando_ajax").removeClass("ui-autocomplete-loading-cadastro-pessoa");
                                abrirNoty("Clique em Abrir Conta e em seguida dê permissão para que seu navegador informe a localização!")
                            }
                        }, 3000);

                        //Aguarda 5 segundos até localizar e depois submete o formulário
                        setTimeout(function () {
                            if ($("#latitude").val() !== "" && $("#longitude").val()) {
                                $("#form_cadastro").trigger("submit");
                            }
                        }, 5000);
                    } else {
                        abrirNoty("Preencha os campos para abrir sua conta!");
                    }
                    if ($("#nome").val() == "") {
                        $("#nome").css("border", "1px solid red");
                    } else {
                        $("#nome").css("border", "1px solid #C7C7CC");
                    }
                    if ($("#email").val() == "") {
                        $("#email").css("border", "1px solid red");
                    } else {
                        $("#email").css("border", "1px solid #C7C7CC");
                    }
                    if ($("#login").val() == "") {
                        $("#login").css("border", "1px solid red");
                    } else {
                        $("#login").css("border", "1px solid #C7C7CC");
                    }
                    if ($("#senha").val() == "") {
                        $("#senha").css("border", "1px solid red");
                    } else {
                        $("#senha").css("border", "1px solid #C7C7CC");
                    }
                    if ($("#repetir_senha").val() == "") {
                        $("#repetir_senha").css("border", "1px solid red");
                    } else {
                        $("#repetir_senha").css("border", "1px solid #C7C7CC");
                    }
                });
            });

        </script>


        <!--Se login já existe não efetua o cadastro da pessoa e avisa com Noty-->
        <?php
        if (isset($msgErro) && $msgErro == 10) {
            echo '<script>abrirNoty("Login já existe. Experimente outro!");'
            . '$("#login").css("border", "1px solid red");</script>';
        }
        if (isset($msgErro) && $msgErro == 9) {
            echo '<script>abrirNoty("Senhas não conferem!");'
            . '$("#senha").css("border", "1px solid red");'
            . '$("#repetir_senha").css("border", "1px solid red");</script>';
        }
        if (isset($msgErro) && $msgErro == 11) {
            echo '<script>abrirNoty("Login ou senha inválidos!");</script>';
        }
        ?>
    </body>
</html>
