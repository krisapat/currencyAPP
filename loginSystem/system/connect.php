<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "currencyapp";
$connection = new mysqli($host, $user, $pass, $db);

if($connection->connect_error){
    echo "Connecting Database Failed".$connection->connect_error;
}

?>