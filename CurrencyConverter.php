<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Currency Converter</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="CurrencyConverter.css">
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
            <h1>Currency Converter</h1>
            <input class="input" type="number" id="amount" placeholder="Enter amount" value="1">
            <div>
                <select id="fromCurrency">
                    <option value="USD">USD</option>
                    <option value="EUR">EUR</option>
                    <option value="GBP">GBP</option>
                    <option value="JPY">JPY</option>
                    <option value="THB">THB</option>
                </select>
                ⇄
                <select id="toCurrency">
                    <option value="USD">USD</option>
                    <option value="EUR">EUR</option>
                    <option value="GBP">GBP</option>
                    <option value="JPY">JPY</option>
                    <option value="THB">THB</option>
                </select>
            </div>
            <h2 id="result"></h2>
            <canvas id="exchangeRateChart"></canvas>
        </div>
    </div>
    <script src="CurrencyConverter.js"></script>
</body>

</html>