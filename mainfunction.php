<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="mainfunction.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Thai:wght@100;200;300;400;500;600;700&family=IBM+Plex+Sans:ital,wght@0,100..700;1,100..700&display=swap"
        rel="stylesheet">
</head>

<body>
    <?php include 'navbar.php'; ?>

    <!--navbar end-->
    <div class="conetentmem">
        <div class="container">
            <a href="dca.php" class="member-card"><i class="fa-solid fa-coins"></i>DCA calculator <p>(คำนวณการลงทุนแบบดอกเบี้ยทบต้น)</p></a>

            <a href="CurrencyConverter.php" class="member-card"><i class="fa-solid fa-scale-balanced"></i>Currency
                converter <p>(แปลงค่าเงิน)</p></a>
            <a href="Whatifinvestment.php" class="member-card"><i class="fa-solid fa-chart-line"></i>What if
                investment <p>(ทดลองจัดพอร์ตการลงทุน)</p></a>
        </div>
    </div>
</body>

</html>