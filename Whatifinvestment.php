<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>What If Investment</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="Whatifinvestment.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Thai:wght@100;200;300;400;500;600;700&family=IBM+Plex+Sans:ital,wght@0,100..700;1,100..700&display=swap"
        rel="stylesheet">
</head>

<body>
    <?php include 'navbar.php'; ?>

    <div class="bigbox">
        <div class="container">
            <h1 class="head">What If Investment</h1>

            <!-- เลือกหุ้นและเพิ่มเข้าพอร์ต -->
            <div class="add-stock">
                <select id="stock-select">
                    <option value="NVDA">NVDA</option>
                    <option value="AMZN">AMZN</option>
                    <option value="PLTR">PLTR</option>
                    <option value="WM">WM</option>
                    <option value="GOLD">GOLD</option>
                </select>
                <input type="number" id="stock-percent" placeholder="สัดส่วน %" min="1" max="100">
                <button id="add-stock-btn">เพิ่ม</button>
            </div>

            <!-- รายการหุ้นที่เลือก -->
            <div id="portfolio-list"></div>

            <!-- เลือกช่วงเวลาย้อนหลัง -->
            <div class="time-range">
                <label>เลือกช่วงเวลา:</label>
                <select id="time-range">
                    <option value="1">1 ปี</option>
                    <option value="5">5 ปี</option>
                </select>
            </div>

            <h2 id="result"></h2>
            <canvas id="myChart"></canvas>
        </div>
    </div>
    <div class="bottom-box"></div>
    <script src="Whatifinvestment.js"></script>
</body>

</html>