<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="regPage.css">
    <title>Register/Login</title>
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
    <!-- หน้า register -->
    <div class="container" id="register" style="display: none">
        <h1 class="form-title">Register</h1>
        <form id="registerForm">
            <div class="input-group">
                <i class="fas fa-user"></i>
                <label for="username"></label>
                <input type="text" name="username" id="username" placeholder="Username" required>
            </div>
            
            <div class="input-group">
                <i class="fas fa-envelope"></i>
                <label for="email"></label>
                <input type="email" name="email" id="email" placeholder="youremail@email.com" required>
            </div>
            <div class="input-group">
                <i class="fas fa-lock"></i>
                <label for="password"></label>
                <input type="password" name="password" id="password" placeholder="Password" required>
            </div>
            <div class="input-group">
                <i class="fas fa-lock"></i>
                <label for="conf-password"></label>
                <input type="password" name="conf-password" id="conf-password" placeholder="Confirm Password" required>
            </div>
            <input type="submit" class="btn" value="Register" name="register">
        </form>
        <div class="links">
            <button id="loginButton">Already have an account? Login Here</button>
        </div>
    </div>
    <!-- หน้า login -->
    <div class="container" id="login" >
        <h1 class="form-title"><i class="fa-solid fa-right-to-bracket"></i> Login</h1>
        <p class="form-title">please sign in to your account</p>
        <form id="loginForm">
            <div class="input-group">
                <i class="fas fa-user"></i>
                <label for="username"></label>
                <input type="text" name="username" id="username" placeholder="Username" required>
            </div>
            <div class="input-group">
                <i class="fas fa-lock"></i>
                <label for="password"></label>
                <input type="password" name="password" id="password" placeholder="Password" required>
            </div>
            <p class="recover">
                <a href="forgot_password.php">Forgot Username / Password?</a>
            </p>
            <input type="submit" class="btn" value="Login" name="login">
        </form>
        <div class="links">
            <button id="regButton">Don't have an account? Register now</button>
        </div>
    </div>

    <!-- error message -->
    <div id="error-bar" class="error-bar">
        <span id="error-message">Something went wrong!</span>
        <button onclick="closeErrorBar()">✖</button>
    </div>
    
    <script src="reg_scripts.js"></script>
    <script src="loginSys.js"></script>
</body>
</html>