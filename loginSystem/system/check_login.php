<?php
session_start();

if (!isset($_SESSION['id'])) {
    echo "not_logged_in"; // ❌ ถ้ายังไม่ล็อกอิน
} else {
    echo "logged_in"; // ✅ ถ้าล็อกอินแล้ว
}
?>
