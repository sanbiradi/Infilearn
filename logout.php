<?php
session_start();
session_reset();
session_unset();
session_destroy();
@$email = $_COOKIE['email'];
@$key = $_COOKIE['key'];
setcookie("email" , $email, time() - 2628000);
setcookie("key", $key, time() - 2628000);

header('Location: index.php');

?>