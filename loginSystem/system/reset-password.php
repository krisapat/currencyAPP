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

<div class="container" id="reset-password">
    <h1 class="form-title">Reset your password</h1>
    <form method="POST" action="">
        <div class="input-group">
            <label for="password">รหัสผ่านใหม่:</label>
            <input type="password" name="password" required>
        </div>
        <div class="input-group">
            <label for="confirm_password">ยืนยันรหัสผ่านใหม่:</label>
            <input type="password" name="confirm_password" required>
        </div>
        <button type="submit">รีเซ็ตรหัสผ่าน</button>
    </form>
</div>
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
