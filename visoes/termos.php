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




            <!--main content start-->
            <section id="main-content">
                <section class="wrapper">
                    <div class="row">
                        <div class="col-lg-10">
                            <p style="font-size: 14px; margin-bottom: 10px">BREVE APRESENTAÇÃO</p>
                            <p>                                
                                O objetivo do Bibliotecapessoal.com, antes de tudo, é promover a leitura e, 
                                acreditamos que a troca de livros entre usuários não é uma prática corriqueira.
                                Assim sendo, apresentamos um sistema que facilita a experiência de empréstimo de
                                livros entre usuários e realiza a gerência destes 
                                empréstimos.
                            </p>

                            <P style="margin-top: 20px; font-size: 14px"> TERMOS DE COMPROMISSO</P>

                            <p>1. Localização</p>
                            <p>    
                                Ao realizar seu cadastro junto ao Bibliotecapessoal.com você fornece, 
                                além dos dados explícitos no formulário, sua localização. Dados de 
                                localização não serão visíveis ou informados à nenhum usuário. A localização
                                será usada unicamente para calcular a distância entre usuários, visando uma 
                                melhor experiência na busca de livros.                             
                            </p>
                            <p>2. Suas informações pessoais</p>
                            <p>
                                Você é dono de toda e qualquer informação pessoal que publica no Sistema. Seus dados como
                                nome, foto de perfil e distância ficarão visíveis a outros usuários. 
                            </p>
                            <p>3. Informações de livros</p>
                            <p>
                                Você é dono de toda e qualquer informação de livros que publica no Sistema. Ao cadastrar 
                                um novo título, marcando a opção Permitir busca online, você concorda que outros usuários
                                tenham acesso à informações do referido livro. Desta forma, você está possibilitando que
                                outras pessoas possam fazer um pedido de empréstimo.
                            </p>
                            <p>4. Quanto a gerência de empréstimos</p>
                            <p>
                                Ao efetuar um empréstimo de livro o usuário informa a data atual e a data prevista, ou seja,
                                a data acordada pelas duas partes como sendo o limite para a devolução do referido livro. Nem
                                o Sistema, nem os idealizadores do Sistema ficam responsáveis pela devolução do material. 
                                Contudo, disponibilizamos o mecanismo de avaliação de usuários que qualificará os mesmos quanto
                                à confiabilidade. Trataremos da avaliação de usuários no próximo item.                               
                            </p>
                            <p>5. Quanto à avaliação de usuários</p>
                            <p>
                                Toda e qualquer informação dada no quesito Avaliação de usuários são de propriedade do informante.                                
                                Sempre que uma devolução for editada, o usuário concedente poderá atribuir uma nota e um comentário 
                                referente ao processo de empréstimo. Esta nota e comentário ficarão visíveis na página de perfil
                                do usuário que retirou o livro. 
                            </p>    
                            <p>6. Proteção dos direitos de outras pessoas</p>
                            <p>
                                Esperamos a colaboração dos usuários quanto ao bom uso do sistema. Evite qualquer ato que possa
                                infringir o direito de outrem. Atitudes desrespeitosas implicarão no banimento do usuário.
                            </p>
                            <p>7. Sobre a finalidade de uso do sistema</p>
                            <p>
                                O Bibliotecapessoal.com é um sistema grátis para uso pessoal. Portanto, fica proibido o uso com 
                                fins comerciais. O sistema permite o cadastro de até 250 livros pessoais, podendo este número 
                                ser aumentado conforme acharmos conveniente. Esta foi a maneira encontrada para evitar uso 
                                comercial indevido do sistema. Havendo interesse em adquirir uma versão comercial, entre em 
                                contato com o suporte.
                            </p>
                        </div>
                    </div>
                </section>


            </section>

            <section id="um_livro" style="display: none">
                <section class="wrapper">

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
    </body>
</html>
