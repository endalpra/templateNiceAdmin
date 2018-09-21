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

        </head>

        <body>
            <!-- container section start -->
            <section id="container" class="">


                <header class="header dark-bg">
                    <div class="toggle-nav">
                        <div class="icon-reorder " title="Mostra/Esconde Menu" data-placement="bottom"><i class="icon_menu"></i></div>
                    </div>

                    <!--logo start-->
                    <a href="index.php" class="logo">Biblioteca <span class="lite"> Pessoal</span></a>
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
                                <h3 class="page-header"><i class="fa fa-user-md"></i> Edição de usuário</h3>
                                <!--                                <ol class="breadcrumb">
                                                                    <li><i class="fa fa-home"></i><a href="index.php">Home</a></li>
                                                                    <li><i class="fa fa-user-md"></i>Editar pessoa</li>
                                                                </ol>-->
                            </div>
                        </div>


                        <?php
                        require_once (__DIR__ . '/../controles/pessoa.php');

                        if (isset($pessoa) && !empty($pessoa)) {
                            $nome_pessoa = $pessoa[0]->getNome();
                            $email = $pessoa[0]->getEmail();
                            $login = $pessoa[0]->getLogin();
//                            $cidade = $pessoa[0]->getCidade();
//                            $estado = $pessoa[0]->getEstado();
//                            $pais = $pessoa[0]->getPais();
                            $latitude = $pessoa[0]->getLatitude();
                            $longitude = $pessoa[0]->getLongitude();
                            $confiabilidade = ($pessoa[0]->getConfiabilidade() * 30);
                        }

                        if (isset($_POST['btCadastrar']) && isset($_POST['latitude']) && isset($_POST['longitude']) && !empty($_POST['latitude']) && !empty($_POST['longitude'])) {
                            //Pega o valor dos campos e seta no value do formulário
                            //if ((isset($msg) && $msg == 0) || isset($msgErro)) {

                            $nome_pessoa = $_POST['nome'];
                            $email = $_POST['email'];
                            $login = $_POST['login'];
                            //$senha = $_POST['senha'];
                            //$repetir_senha = $_POST['repetir_senha'];
                            $latitude = $_POST['latitude'];
                            $longitude = $_POST['longitude'];
                            //}
                        }
                        ?>


                        <!-- Modal -->
                        <div id="myModal" class="modal fade" role="dialog">
                            <div class="modal-dialog modal-sm">
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Aviso</h4>
                                    </div>
                                    <div class="modal-body">
                                        <p><?php
                                            if (isset($msg)) {
                                                if ($msg == 1)
                                                    echo "<p>Pessoa editada com sucesso!</p>";
                                                else if ($msg == 0)
                                                    echo '<p>Erro ao editar pessoa!</p>';
                                            }
                                            if (isset($msgErro)) {
                                                echo"<p>" . $msgErro . "</p>";
                                            }
                                            ?></p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" id="closemodal" class="btn btn-default" data-dismiss="modal">Fechar</button>
                                    </div>
                                </div>

                            </div>
                        </div>

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
                                                                        <div class="row">
                                                                            <div class="col-lg-8">
                                                                                <h1>Dados pessoais</h1>
                                                                                <form class="form-horizontal" role="form" action="editarpessoa.php" method="post" enctype="multipart/form-data">                                                  
                                                                                    <div class="form-group">
                                                                                        <label class="col-lg-2 control-label">Nome *</label>
                                                                                        <div class="col-lg-9">
                                                                                            <input type="text" class="form-control" id="nome" name="nome" value="<?= @$nome_pessoa ?>" required="required" placeholder=" ">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label class="col-lg-2 control-label">Email *</label>
                                                                                        <div class="col-lg-9">
                                                                                            <input type="email" class="form-control" id="email" name="email" value="<?= @$email ?>" required="required" placeholder=" ">
                                                                                        </div>
                                                                                    </div>
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
                                                                                    <div class="form-group">
                                                                                        <label class="col-lg-2 control-label">Imagem</label>
                                                                                        <div class="col-lg-9">
                                                                                            <input type="file" name="imagem" id="imagem" value="" style="height: 30px">
                                                                                        </div>
                                                                                    </div> 
                                                                                    <input type="hidden" id="latitude" name="latitude">
                                                                                    <input type="hidden" id="longitude" name="longitude">
                                                                                    <div class="form-group">
                                                                                        <div class="col-lg-offset-2 col-lg-10" style="margin-bottom: 15px;">
                                                                                            <button type="submit" id="btCadastrar" name="btCadastrar" class="btn btn-primary">Salvar</button>
                                                                                            <button type="button" id="btLocalizar" name="btLocalizar" class="btn btn-success">Atualizar localização</button>
                                                                                        </div>
                                                                                    </div>                                                                              
                                                                                </form>
                                                                            </div>
                                                                            <div class="col-lg-4">
                                                                                <img style="max-height: 400px;" class="img-responsive img-rounded" src="../img/pessoas/<?php echo $_SESSION['ses-usu-img'] != '' ? $_SESSION['ses-usu-img'] : 'sem_imagem.jpg' ?>">
                                                                                <div style="margin-top: 20px">
                                                                                    <div class="barra">
                                                                                        <span class="bg"></span>
                                                                                        <div class="estrelas">
                                                                                            <span class="star" id="1" style=" cursor: default !important;">
                                                                                                <span class="starAbsolute"></span>
                                                                                            </span>
                                                                                            <span class="star" id="2" style=" cursor: default !important;">
                                                                                                <span class="starAbsolute"></span>
                                                                                            </span>
                                                                                            <span class="star" id="3" style=" cursor: default !important;">
                                                                                                <span class="starAbsolute"></span>
                                                                                            </span>
                                                                                            <span class="star" id="4" style=" cursor: default !important;">
                                                                                                <span class="starAbsolute"></span>
                                                                                            </span>
                                                                                            <span class="star" id="5" style=" cursor: default !important;">
                                                                                                <span class="starAbsolute"></span>
                                                                                            </span>
                                                                                        </div>
                                                                                    </div> 
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="panel-body" style="margin-top: 5px" >
                                                                        <div class="tab-content">
                                                                            <div id="recent-activity" class="tab-pane active">
                                                                                <h4><p>Comentários de empréstimos</p></h4>
                                                                                <div class="profile-activity" id="comentarios">                                             

                                                                                </div>
                                                                            </div>
                                                                        </div>
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


                <script>
                                    $(".barra .bg").css("width",<?php echo $confiabilidade ?>);
                                    listarComentariosPerfilPessoa(<?php echo $_SESSION['ses-usu-id'] ?>);
                </script>

                <?php
                if (isset($msg)) {
                    echo "<script>                  
                                     $('#myModal').modal('show');  
                                     </script>";
                } else if (isset($msgErro)) {
                    echo "<script>                  
                                     $('#myModal').modal('show');                                      
                                     </script>";
                }
                ?>



                <script>// check for Geolocation support
                    //            if (navigator.geolocation) {
                    //                console.log('Geolocation is supported!');
                    //            } else {
                    //                console.log('Geolocation is not supported for this Browser/OS version yet.');
                    //            }
                    $(document).ready(function () {
                        $("#btLocalizar").click(function () {

                            var startPos;
                            var geoOptions = {
                                timeout: 5000
                            }

                            var geoSuccess = function (position) {
                                startPos = position;
                                $("#latitude").val(startPos.coords.latitude);
                                $("#longitude").val(startPos.coords.longitude);
                                //Usar trigger submit
                                //Faz a trigger 

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

                <script>
                    setInterval(function () {
                        totalMensagensNaoLidas(<?php echo $_SESSION['ses-usu-id'] ?>);
                    }, 5000);
                    //Chama função pela primeira vez sem esperar 
                    totalMensagensNaoLidas(<?php echo $_SESSION['ses-usu-id'] ?>);
                </script>

                <!--Recarrega página para trazer nova foto de perfil-->
                <script>
                    $("#myModal").click(function () {
                        window.location.href = "editarpessoa.php";
                    });
                </script>
        </body>
    </html>

    <?php
} else {
    require_once(__DIR__ . '/../bibliotecas/URL.php');
    URL::redirecionar("login.php");
}