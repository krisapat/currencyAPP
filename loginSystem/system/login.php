<?php

include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username=$_POST['username'];
    $password=$_POST['password'];
    $password=md5(string: $password);

    $sql="SELECT * FROM users WHERE username='$username' and password ='$password'";
    $result = $connection->query(query: $sql);

    if($result->num_rows > 0){
        session_start();
        $row= $result->fetch_assoc();

        $_SESSION["username"]=$row["username"];
        echo "Login Successful";
        exit();
    }
    else{
        echo "Username/Password Incorrect!";
    }

}
?>