<?php
session_start(); // เริ่มต้น session

// ลบข้อมูลใน session
session_unset(); 

// ทำลาย session
session_destroy(); 

// ตรวจสอบว่า $_SERVER['HTTP_REFERER'] มีค่า หรือไม่
if (isset($_SERVER['HTTP_REFERER'])) {
    // ถ้ามีค่า ให้ redirect กลับไปยังหน้าก่อนหน้า
    header("Location: " . $_SERVER['HTTP_REFERER']);
} else {
    // ถ้าไม่มีค่า ก็ให้ redirect ไปยังหน้า home หรือหน้า default
    header("Location: index.php");
}
exit(); // หยุดการทำงานหลังจาก redirect
?>
