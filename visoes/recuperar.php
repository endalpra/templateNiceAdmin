<?php
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

            <section>
                <section class="wrapper"> 
                    <div class="row">
                        <?php
                        require_once (__DIR__ . '/../controles/pessoa.php');
                        if (isset($existe) && $existe > 0 || (isset($msgR)) || isset($msgErro)) {
                            if (isset($_POST["email"]) && isset($_POST['login'])) {
                                $email = $_POST["email"];
                                $login = $_POST['login'];
                            }
                            if (isset($_GET['utilizador'])) {
                                $email = $_GET['utilizador'];
                            }
                            if ($msgR == 1) {
                                $email = "";
                                $login = "";
                            }
                            ?>
                            <section class="panel"> 
                                <div class="panel-body bio-graph-info">
                                    <div class="row">
                                        <div class="col-lg-offset-3 col-lg-6">
                                            <h1>Dados de recuperação de senha</h1>
                                            <form class="form-horizontal" role="form" action="recuperar.php" method="post">                                                  
                                                <div class="form-group">
                                                    <label class="col-lg-2 control-label">Login *</label>
                                                    <div class="col-lg-9">
                                                        <input type="text" class="form-control" id="login" name="login" value="<?= @$login ?>" required="required" placeholder=" ">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-lg-2 control-label">Senha </label>
                                                    <div class="col-lg-9">
                                                        <input type="password" class="form-control" id="senha" name="senha" placeholder=" ">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-lg-2 control-label">Repetir senha </label>
                                                    <div class="col-lg-9">
                                                        <input type="password" class="form-control" id="repetir_senha" name="repetir_senha"  placeholder=" ">
                                                    </div>
                                                </div>
                                                <input type="hidden" name="email" value="<?= @ $email ?>">
                                                <div class="form-group">
                                                    <div class="col-lg-offset-2 col-lg-10" style="margin-bottom: 15px;">
                                                        <button type="submit" id="btCadastrar" name="btCadastrar" class="btn btn-primary">Enviar</button>
                                                    </div>
                                                </div>                                                                              
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </section>


                            <?php
                        }
                        ?>

                    </div>
                </section>
            </section>

            <!--<div class="footer rodape">
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
            </div>-->
        </section>





        <!-- Modal Cadastro Editora-->
        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-sm">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h3 class="modal-title">Aviso</h3>
                    </div>
                    <div class="modal-body">
                        <div class="panel-body bio-graph-info">
                            <div class="col-md-12">
                                <?php
                                if (isset($msgR) && $msgR == 1) {
                                    echo 'Redefinição bem sucedida!';
                                } else {
                                    echo 'Problemas na redefinição.';
                                }
                                if (isset($msgErro) && $msgErro == 9) {
                                    echo "<br>Senhas não conferem!";
                                } else if (isset($msgErro) && $msgErro == 10) {
                                    echo '<br>Login já existe. Tente outro!';
                                }
                                ?>                               
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

        <script type="text/javascript" src="../plugins/noty_2.3.8/js/noty/packaged/jquery.noty.packaged.js"></script>
        <script type="text/javascript">
            function abrirNoty(msg) {
                $.noty.consumeAlert({layout: 'bottom', type: 'warning', dismissQueue: true});
                alert(msg);
            }
        </script>



        <!--Se login já existe não efetua o cadastro da pessoa e avisa com Noty-->
        <?php
        if ((isset($msgR) && $msgR != "") || (isset($msgErro) && $msgErro != "")) {
            echo '<script>$("#myModal").modal();</script>';
        }
        ?>
    </body>
</html>
