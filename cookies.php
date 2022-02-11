<?php


ob_start();


setcookie('username', 'Jhon', time() + 60 * 60 * 24); 

echo $_COOKIE['username'];

?>