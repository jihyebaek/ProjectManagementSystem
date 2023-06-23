<?php
include_once('./common.php');

session_unset(); 
session_destroy(); 

// unset($_COOKIE['memId']);
// unset($_COOKIE['memName']);

setcookie('memId', '', time() - (6*60*60), '/');
header('Location:./login.php');

?>