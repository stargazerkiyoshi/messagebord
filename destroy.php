<?php
session_start();
unset($_SESSION['username']);
setcookie("username","",time()-1);
header("Location:load.php");
?>