<?php

//include 'connect.php';
//session_start();

//if ($_SERVER["REQUEST_METHOD"] === "POST") {
//    $username=$_POST['username'];
//    $password=$_POST['password'];
//    $password=md5(string: $password);
    

//    $sql="SELECT * FROM users WHERE username='$username' and password ='$password'";
//    $result = $connection->query(query: $sql);

//    if($result->num_rows > 0){
//        $row= $result->fetch_assoc();

        // $_SESSION["username"]=$row["username"];
        // login.php (หลังจากตรวจสอบรหัสผ่านสำเร็จ)
//        $_SESSION['id'] = $user['id'];
//        $_SESSION['username'] = $user['username'];
//        $_SESSION['password'] = $password;
//        echo "Login Successful";

//        exit();
//    }
//    else{
//        echo "Username/Password Incorrect!";
//    }

//}
?>



<?php
include 'connect.php';
session_start(); // ✅ เริ่ม session ก่อนใช้งาน

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // 🔒 ป้องกัน SQL Injection ด้วย prepared statement
    $stmt = $connection->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // ✅ ตรวจสอบรหัสผ่าน
        if (md5(string: $password) === $row['password']) {  // หากใช้ md5
            $_SESSION['id'] = $row['id'];            // 🔄 แก้จาก $user เป็น $row
            $_SESSION['username'] = $row['username'];
            echo "Login Successful";
            exit();
        } else {
            echo "รหัสผ่านไม่ถูกต้อง";
        }
    } else {
        echo "ไม่พบบัญชีผู้ใช้นี้";
    }
}
?>
