<?php

 ob_start();

 session_start();

 $_SESSION['name']= "Jhone Doe"; 

 $_SESSION['lastname']= " Tony Doe"; 

 $_SESSION['firstname']= " Md Ealius Azam Sha"; 

echo $_SESSION['name'];
echo $_SESSION['firstname']; 
echo $_SESSION['lastname']; 



?>