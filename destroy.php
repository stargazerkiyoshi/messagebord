<?php
session_start();
//unset($_SESSION['username']);
session_destroy();
setcookie("username","",time()-1);
header("Location:login.html");
?>