<?php

session_start();
unset($_SESSION['ses-usu-id']);
unset($_SESSION['ses-usu-nome']);
unset($_SESSION['ses-usu-img']);
unset($_SESSION['registro']);
unset($_SESSION['limite']);
unset($_SESSION['ses-usu-ip']);

session_destroy();

header("Location: ../visoes/login.php");
exit();


