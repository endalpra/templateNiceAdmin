<!DOCTYPE html>
<html lang="en">
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
    <link href="../template/css/font-awesome.css" rel="stylesheet" />
    <!-- Custom styles -->
    <link href="../template/css/style.css" rel="stylesheet">
    <link href="../template/css/style-responsive.css" rel="stylesheet" />

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 -->
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
</head>

  <body class="login-img3-body">

      <?php
      
        if(isset($_POST['btLogin'])){
            require_once (__DIR__ .'/../controles/login.php');
        }
      ?>
      
    <div class="container">
        <form class="login-form" action="login.php" method="post">        
        <div class="login-wrap">
            <p class="login-img"><i class="icon_lock_alt"></i></p>
            <div class="input-group">
              <span class="input-group-addon"><i class="icon_profile"></i></span>
              <input type="text" name="login" class="form-control" required="required" placeholder="Login" autofocus>
            </div>
            <div class="input-group">
                <span class="input-group-addon"><i class="icon_key_alt"></i></span>
                <input type="password" name="senha" class="form-control" required="required" placeholder="Senha">
            </div>
            <label class="checkbox">
                <input type="checkbox" value="remember-me"> Lembrar
                <span class="pull-right"> <a href="#"> Esqueceu sua senha?</a></span>
            </label>
            <button class="btn btn-primary btn-lg btn-block" name="btLogin" type="submit">Entrar</button>
            <!--<button class="btn btn-info btn-lg btn-block" type="submit">Signup</button>-->
        </div>
      </form>

    </div>


  </body>
</html>


