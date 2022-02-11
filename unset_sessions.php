<?php


ob_start();

session_start();



session_destroy();

unset($_SESSION['username']);
unset($_SESSION['firstname']);


echo $_SESSION['username'];
echo $_SESSION['firstname'];
echo $_SESSION['lastname'];


?>