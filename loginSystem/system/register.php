<?php

include 'connect.php';

if($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password = md5(string: $password);

    $checkEmail = "SELECT * From users where email='$email'";
    $checkUser = "SELECT * From users where username='$username'";
    $emailResult = $connection->query(query: $checkEmail);
    $usernameResult = $connection->query(query: $checkUser);

    // เช็คว่า username หรือ email ซ้ำ
    if($emailResult->num_rows > 0 or $usernameResult->num_rows > 0) {
        if($emailResult->num_rows>0) {
            echo "Email Address Already Exists !";
            exit();
        }
        if($usernameResult->num_rows> 0) {
            echo "Username Already Exists !";
            exit();
        }
    }
    else{
        // เพิ่มข้อมูลเข้า database
        $insertQuery = "INSERT INTO users(username,email,password) VALUES ('$username', '$email', '$password')";
        if($connection->query(query: $insertQuery)==TRUE) {
            echo("Registration successful");
        }
        else {
            echo("Error:".$connection->error);
        }
    }
}

?>