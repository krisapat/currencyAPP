<?php
include '../loginSystem/system/connect.php';
session_start();

$userId = $_SESSION['id'];
$stockId = $_POST['stock_id'] ?? null;

if ($stockId) {
    $stmt = $connection->prepare("SELECT 1 FROM liked_stocks WHERE user_id = ? AND stock_id = ?");
    $stmt->bind_param("ii", $userId, $stockId );
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // 💔 ยกเลิกถูกใจ
        $stmt = $connection->prepare("DELETE FROM liked_stocks WHERE user_id = ? AND stock_id = ?");
        $stmt->bind_param("ii", $userId, $stockId);
        $stmt->execute();
        echo "unliked"; // 🔄 ส่งกลับเมื่อยกเลิกถูกใจ
    } else {
        // 💖 กดถูกใจ
        $stmt = $connection->prepare("INSERT INTO liked_stocks (user_id, stock_id) VALUES (?, ?)");
        $stmt->bind_param("ii", $userId, $stockId);
        $stmt->execute();
        echo "liked"; // 💡 ส่งกลับเมื่อกดถูกใจ
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'ไม่พบข้อมูลหุ้นที่เลือก']);
}