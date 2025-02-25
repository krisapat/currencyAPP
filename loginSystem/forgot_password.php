<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
</head>
<body>
    <div class="container" id="forgot-pass">
        <h1 class="form-tittle">Forgot Username / Password</h1>
    <form id="forgotForm" method="post" action="system/send-password-reset.php">
        <div class="input-group">
            <i class="fas fa-envelope"></i>
            <label for="email">Email</label>
            <input type="email" name="email" id="email" placeholder="youremail@email.com" required>
        </div>

        <button>Recover Password</button>
    </form>
    </div>
    <p class="back">
        <a href="regPage.php">Back</a>
    </p>
</body>
</html>