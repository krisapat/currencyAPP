<?php
include '../loginSystem/system/connect.php';
session_start();

if (!isset($_SESSION['id'])) {
    echo "error";
    exit();
}

$userId = $_SESSION['id'];

// 🚀 ลบหุ้นที่ถูกใจทั้งหมดของผู้ใช้
$stmt = $connection->prepare("DELETE FROM liked_stocks WHERE user_id = ?");
$stmt->bind_param("i", $userId);

if ($stmt->execute()) {
    echo "cleared"; // ส่งค่าไปยัง JavaScript
} else {
    echo "error";
}
?>
