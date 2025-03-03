<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Favorite Stocks</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="mainhome.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Thai:wght@100;200;300;400;500;600;700&family=IBM+Plex+Sans:ital,wght@0,100..700;1,100..700&display=swap"
        rel="stylesheet">
</head>

<div>
    <!--navbar-->
    <?php include 'navbar.php'; ?>
    <!--navbar-->
    <div id="item-list">
    <h1 class="head">Favorite</h1>
    <div class="search-container">
        <a href="index.php" class="fav-link">Back</a>
        <input type="text" id="search-bar" placeholder="ค้นหาหุ้น...">
        <button class="clear-btn" id="clear-favorites">Clear all</button>
    </div>
    <div id="favorite-list"></div>

    <!-- ✅ เพิ่ม jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
    $(document).ready(function() {
        $(".favorite-btn").click(function(e) {
            e.preventDefault();
            const button = $(this);
            const stockId = button.data("id");

            $.ajax({
                url: 'favSystem/like_stock.php',
                type: 'POST',
                data: { stock_id: stockId },
                success: function(response) {
                    if (response === "unliked") {
                        button.closest(".item").fadeOut(); // ❌ ลบจากหน้าเมื่อยกเลิกถูกใจ
                    }
                }
            });
        });
    });

    // 🎯 ฟังก์ชันสำหรับปุ่ม Clear All
    $(".clear-btn").click(function(e) {
        e.preventDefault();
        
        // if (confirm("คุณต้องการลบหุ้นที่ถูกใจทั้งหมดหรือไม่?")) {
            $.ajax({
                url: 'favSystem/clear_like_stock.php',
                type: 'POST',
                success: function(response) {
                    if (response === "cleared") {
                        // alert("ลบหุ้นที่ถูกใจทั้งหมดเรียบร้อยแล้ว");
                        location.reload(); // รีเฟรชหน้าเพื่ออัปเดต UI
                    } else {
                        alert("เกิดข้อผิดพลาด กรุณาลองอีกครั้ง");
                    }
                }
            });
        // }
    });
    
    </script>

    <?php
        include 'loginSystem/system/connect.php';

        // session_start();
        if (!isset($_SESSION['id'])) {
            echo "<script type='text/javascript'>
                window.location.href = 'loginSystem/regPage.php';
              </script>";
            exit(); // หลังจาก header, หยุดการทำงาน
        }

        $userId = $_SESSION['id'];
        $sql = "SELECT s.id, s.stock_symbol, s.stock_name
                FROM liked_stocks ls
                JOIN stocks s ON ls.stock_id = s.id
                WHERE ls.user_id = ?";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();


        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $stockId = $row['id'];
                $stmt = $connection->prepare("SELECT 1 FROM liked_stocks WHERE user_id = ? AND stock_id = ?");
                $stmt->bind_param("ii", $userId, $stockId);
                $stmt->execute();
                $resultLiked = $stmt->get_result();

                $liked = ($resultLiked->num_rows > 0) ? true : false;
    
                echo "
                <div class='item'>
                    <div class='item-head'>
                        <h3>{$row['stock_name']}</h3>
                        <button class='favorite-btn' data-id='{$row['id']}'><i class=\"fa-solid fa-square-minus\"></i></button>
                    </div>
                    <div class=\"tradingview-widget-container\">
                        <script type=\"text/javascript\" src=\"https://s3.tradingview.com/external-embedding/embed-widget-mini-symbol-overview.js\"> 
                        { \"symbol\": \"{$row['stock_symbol']}\", \"width\": \"100%\", \"height\": \"160\", \"locale\": \"th\", \"dateRange\": \"1D\", \"colorTheme\": \"dark\", \"isTransparent\": false }
                        </script>
                    </div>
                </div>";
            }
        } else {
            echo "ไม่มีข้อมูลหุ้นให้แสดง";
        }
    ?>
    </div>
    <div class="box"></div>
    
    <!-- error message -->
    <div id="error-bar" class="error-bar">
        <span id="error-message">Something went wrong!</span>
        <button onclick="closeErrorBar()">✖</button>
    </div>

    <script src="script.js"></script>

</body>

</html>