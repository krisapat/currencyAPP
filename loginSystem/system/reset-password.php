<?php
require 'connect.php';

if (!isset($_GET['token'])) {
    echo "❌ ไม่มี token";
    exit;
}

$token = $_GET['token'];
$current_time = date("Y-m-d H:i:s");

// ตรวจสอบ token ในฐานข้อมูลว่าไม่หมดอายุ
$stmt = $connection->prepare("SELECT * FROM users WHERE reset_token_hash = ? AND reset_token_expires_at > ?");
$hashed_token = hash('sha256', $token);  // เก็บค่า hash ในตัวแปร
$current_time = date("Y-m-d H:i:s");     // เก็บเวลาปัจจุบันในตัวแปร

// ใช้ตัวแปรเหล่านี้ใน bind_param()
$stmt = $connection->prepare("SELECT * FROM users WHERE reset_token_hash = ? AND reset_token_expires_at > ?");
$stmt->bind_param("ss", $hashed_token, $current_time);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "❌ Token ไม่ถูกต้องหรือหมดอายุ";
    exit;
}

$user = $result->fetch_assoc();
$stmt->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset your password</title>
    <link rel="stylesheet" href="../regPage.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Thai:wght@100;200;300;400;500;600;700&family=IBM+Plex+Sans:ital,wght@0,100..700;1,100..700&display=swap"
        rel="stylesheet">

</head>
<body>
    <div class="header">
        <h1>Welcome to Currensa</h1>
        <p>Let us be the part of your investing journey</p>
    </div>
    <div class="container" id="reset-password">
    <h1 class="form-title">Reset your password</h1>
    <form method="POST" action="">
        <div class="input-group">
            <i class="fas fa-lock"></i>
            <label for="password"></label>
            <input type="password" name="password" placeholder="Password" required>
        </div>
        <div class="input-group">
            <i class="fas fa-lock"></i>
            <label for="confirm_password"></label>
            <input type="password" name="confirm_password" placeholder="Confirm Password" required>
        </div>
        <button class="btn" type="submit">รีเซ็ตรหัสผ่าน</button>
    </form>
</div>
</body>
</html>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        echo "❌ รหัสผ่านไม่ตรงกัน";
        exit;
    }

    // แฮชรหัสผ่านใหม่
    $password = md5(string: $password);

    // อัปเดตรหัสผ่านในฐานข้อมูลและลบ token
    $stmt = $connection->prepare("UPDATE users 
                                  SET password = ?, reset_token_hash = NULL, reset_token_expires_at = NULL 
                                  WHERE id = ?");
    $stmt->bind_param("si", $password, $user['id']);
    
    if ($stmt->execute()) {
        echo '<script>
        alert("🎉 รหัสผ่านของคุณถูกเปลี่ยนเรียบร้อยแล้ว!");
        window.location.href = "../regPage.php";
        </script>';
        exit();
    } else {
        echo "❌ เกิดข้อผิดพลาดในการอัปเดตรหัสผ่าน";
    }

    $stmt->close();
}
?>