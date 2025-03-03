<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="regPage.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Thai:wght@100;200;300;400;500;600;700&family=IBM+Plex+Sans:ital,wght@0,100..700;1,100..700&display=swap"
        rel="stylesheet">

</head>
<body>
    <div class="header">
        <h1>Welcome to Currensa</h1>
        <p>Let us be the part of your investing journey</p>
    </div>
    <div class="container" id="forgot-pass">
        <h1 class="form-title">Forgot Username / Password</h1>
        <form id="forgotForm" method="post" action="system/send-password-reset.php">
            <div class="input-group">
                <i class="fas fa-envelope"></i>
                <label for="email"></label>
                <input type="email" name="email" id="email" placeholder="youremail@email.com" required>
            </div>

            <button class="btn">Recover Password</button>
        </form>
        <p class="back">
            <a href="regPage.php" class="btn-back">Back</a>
        </p>
    </div>
</body>
</html>