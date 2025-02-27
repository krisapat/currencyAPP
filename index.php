<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="mainhome.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    
    <link
        href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Thai:wght@100;200;300;400;500;600;700&family=IBM+Plex+Sans:ital,wght@0,100..700;1,100..700&display=swap"
        rel="stylesheet">
</head>

<body>
    <?php include 'navbar.php'; ?>

    <div id="item-list">

    <h1 class="head">List of assets</h1>
    <div class="search-container">
        <input type="text" id="search-bar" placeholder="ค้นหาหุ้น...">
        <a href="stock_fav.php" class="fav-link">Favorite</a>
    </div>

    <!-- ✅ เพิ่ม jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
    $(document).ready(function() {
    // 🎯 เมื่อคลิกปุ่มถูกใจ
    $(".favorite-btn").click(function(e) {
        e.preventDefault(); // ป้องกันการรีเฟรชหน้า

        const button = $(this);
        const stockId = button.data("id");

        // 🛡️ เช็คว่าผู้ใช้ล็อกอินหรือยัง
        $.ajax({
            url: 'loginSystem/system/check_login.php', // 🔍 เช็ค Session
            type: 'GET',
            success: function(isLoggedIn) {
                if (isLoggedIn === "not_logged_in") {
                    window.location.href = "../currencyapp/loginSystem/regPage.php"; // ไปหน้า Login
                    return;
                }

                // ✅ ถ้าล็อกอินแล้วให้ส่งข้อมูลไป like_stock.php
                else{
                    $.ajax({
                    url: 'favSystem/like_stock.php',
                    type: 'POST',
                    data: { stock_id: stockId },
                    success: function(response) {
                        if (response === "liked") {
                            button.html('★'); // แสดงว่ากดถูกใจแล้ว
                        } else if (response === "unliked") {
                            button.html('☆'); // แสดงว่ายกเลิกถูกใจ
                        }
                    }
                });
                }
                
            }
        });
    });
});

    </script>

    <?php
        // include 'loginSystem/system/connect.php';
        // session_start();
        if (isset($_SESSION['id'])) {
            $userId = $_SESSION['id']; // ดึง user_id จาก session
        }

        $sql = "SELECT id, stock_symbol, stock_name FROM stocks";
        $result = $connection->query($sql);

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
                        <button class='favorite-btn' data-id='{$row['id']}'>
                            " . ($liked ? '★' : '☆') . "
                        </button>
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
    <script src="script.js"></script>
</body>

</html>