<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DCA</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="dca.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Thai:wght@100;200;300;400;500;600;700&family=IBM+Plex+Sans:ital,wght@0,100..700;1,100..700&display=swap"
        rel="stylesheet">
</head>

<body>
    <!--navbar-->
    <?php include 'navbar.php'; ?>
    <!--navbar end-->
    <div class="bigbox">
        <div class="container">
            <h1 class="head">คำนวณการลงทุนแบบ DCA</h1>
            <form class="from" id="investmentForm">
                <label for="initialAmount">เงินต้น :</label>
                <input class="input" type="number" id="initialAmount" required>

                <label for="monthlyContribution">เงินที่เติมรายเดือน :</label>
                <input class="input" type="number" id="monthlyContribution" required>

                <label for="annualReturn">กำไรต่อปี (%) :</label>
                <input class="input" type="number" id="annualReturn" required>

                <label for="years">ระยะเวลากี่ปี:</label>
                <input class="input" type="number" id="years" required>
            </form>

            <div id="result" class="result">
                <h2>ผลลัพธ์การลงทุน</h2>
                <p id="totalAmount">กรุณากรอกข้อมูลให้ครบ</p>
                <canvas id="investmentChart"></canvas> <!-- กราฟ -->
            </div>
        </div>
    </div>
    <div class="bottom-box"></div>
    <script src="dcs.js"></script>
</body>

</html>