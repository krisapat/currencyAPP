<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="regPage.css">
    <title>Register/Login</title>
</head>
<body>
    <!-- หน้า register -->
    <div class="container" id="register" style="display: none">
        <h1 class="form-title">Register</h1>
        <form id="registerForm">
            <div class="input-group">
                <i class="fas fa-user"></i>
                <label for="username">Username</label>
                <input type="text" name="username" id="username" placeholder="Username" required>
            </div>
            
            <div class="input-group">
                <i class="fas fa-envelope"></i>
                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="youremail@email.com" required>
            </div>
            <div class="input-group">
                <i class="fas fa-lock"></i>
                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="Password" required>
            </div>
            <div class="input-group">
                <i class="fas fa-lock"></i>
                <label for="conf-password">Confirm Password</label>
                <input type="password" name="conf-password" id="conf-password" placeholder="Confirm Password" required>
            </div>
            <input type="submit" class="btn" value="Register" name="register">
        </form>
        <div class="links">
            <p>Already Have Account?</p>
            <button id="loginButton">Login</button>
        </div>
    </div>
    <!-- หน้า login -->
    <div class="container" id="login" >
        <h1 class="form-title">Login</h1>
        <form id="loginForm">
            <div class="input-group">
                <i class="fas fa-user"></i>
                <label for="username">Username</label>
                <input type="text" name="username" id="username" placeholder="Username" required>
            </div>
            <div class="input-group">
                <i class="fas fa-lock"></i>
                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="Password" required>
                <p class="recover">
                    <a href="forgot_password.php">Forgot Username / Password?</a>
                </p>
            </div>
            <input type="submit" class="btn" value="Login" name="login">
        </form>
        <div class="links">
            <p>Don't have an account?</p>
            <button id="regButton">Register</button>
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