<?php
require 'connect.php';  // เชื่อมต่อกับฐานข้อมูล
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../vendor/autoload.php'; // เรียกใช้งาน PHPMailer ผ่าน Composer

// 📌 ตรวจสอบว่ามีการส่งอีเมลมาจากฟอร์มหรือไม่
if (isset($_POST['email'])) {
    $email = $_POST['email'];

    // 🔍 ค้นหา username จาก email ในฐานข้อมูล
    $stmt = $connection->prepare("SELECT username FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        echo "❌ ไม่พบอีเมลนี้ในระบบ";
        exit;
    }

    $user = $result->fetch_assoc(); // ดึงข้อมูล username
    $username = $user['username'];

    // 🔑 สร้าง token สำหรับ reset password
    $token = bin2hex(random_bytes(16));  // สร้าง token ความยาว 32 ตัวอักษร
    $hashed_token = hash('sha256', $token);
    $expires_at = date("Y-m-d H:i:s", strtotime("+1 hour")); // ให้หมดอายุใน 1 ชั่วโมง

    // 💾 บันทึก token ลงในฐานข้อมูล
    $stmt = $connection->prepare("UPDATE users SET reset_token_hash = ?, reset_token_expires_at = ? WHERE email = ?");
    $stmt->bind_param("sss", $hashed_token, $expires_at, $email);
    $stmt->execute();

    // 🌐 สร้างลิงก์สำหรับรีเซ็ตรหัสผ่าน
    $resetLink = "http://localhost/currencyAPP/loginSystem/system/reset-password.php?token=" . $token;

    // ✉️ เริ่มการส่งอีเมลด้วย PHPMailer
    $mail = new PHPMailer(true);
    try {
        // ตั้งค่า SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'peemgamer89@gmail.com';  // 🔒 เปลี่ยนเป็นอีเมลของคุณ
        $mail->Password = 'gfklqhfrbmlzqcsm';  // 🛡️ เปลี่ยนเป็นรหัสผ่านของคุณ
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // 🏷️ ตั้งค่าผู้ส่งและผู้รับ
        $mail->setFrom('your-email@gmail.com', 'CurrencyApp Support');
        $mail->addAddress($email, $username);             // ชื่อผู้ใช้จากฐานข้อมูล
        $mail->addReplyTo($email, $username);             // ให้ reply-to เป็นอีเมลผู้ใช้

        // 📝 ตั้งค่าหัวเรื่องและเนื้อหาของอีเมล
        $mail->Subject = "Reset Your Password";
        $mail->isHTML(true);
        $mail->Body    = '
            <h3>สวัสดีคุณ ' . htmlspecialchars($username) . ',</h3>
            <p>เราพบว่าคุณได้ร้องขอการเปลี่ยนรหัสผ่าน โปรดคลิกที่ลิงก์ด้านล่างเพื่อรีเซ็ตรหัสผ่านของคุณ:</p>
            <a href="' . $resetLink . '">' . $resetLink . '</a>
            <p>หากคุณไม่ได้ร้องขอ โปรดไม่ต้องดำเนินการใด ๆ</p>
            <br>
            <p>ขอบคุณ,</p>
            <p><strong>ทีมงาน CurrencyApp</strong></p>
        ';

        // 🚀 ส่งอีเมล
        $mail->send();
        echo '✅ อีเมลสำหรับรีเซ็ตรหัสผ่านถูกส่งเรียบร้อยแล้ว';
    } catch (Exception $e) {
        echo "❌ ไม่สามารถส่งอีเมลได้: {$mail->ErrorInfo}";
    }
} else {
    echo "❗ โปรดกรอกอีเมลของคุณในแบบฟอร์ม";
}
?>
