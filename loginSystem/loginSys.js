document.addEventListener("DOMContentLoaded", function () {
    let registerForm = document.getElementById("registerForm");
    let loginForm = document.getElementById("loginForm");
    let errorModal = document.getElementById("errorModal");
    let errorClose = document.getElementById("errorClose");
    let errorMessage = document.getElementById("errorMessage");

// --- Register ---
    registerForm.addEventListener("submit", function (event) {
        event.preventDefault();  // Prevent page reload on submit

        let formData = new FormData(registerForm); // Serialize form data
        const password = document.getElementById('password').value;
        const conf_password = document.getElementById('conf-password').value;

        if (password !== conf_password) {
            showError("❌ รหัสผ่านไม่ตรงกัน กรุณาลองใหม่อีกครั้ง");
        } 
        else if (password.length < 6) {
            showError("❌ รหัสผ่านต้องมีความยาวอย่างน้อย 6 ตัวอักษร");
        } 
        else {
            fetch("system/register.php", {
                method: "POST",
                body: formData  // Send form data to register.php
            })
            .then(response => response.text())  // Parse the response from PHP
            .then(data => {
                
                if (data.includes("Registration successful")) {
                    // register สำเร็จ
                    showSucess("Registration successful");
                    setTimeout(function(){
                        window.location.href = "regPage.php";
                    }, 2000); // 2 seconds
                    
                } else {
                    // register ไม่สำเร็จ
                    showError(data);
                    
                }
            })
        }
    
    });

// --- Login ---
    loginForm.addEventListener("submit", function(event){
        event.preventDefault();

        let formData = new FormData(loginForm);

        fetch("system/login.php", {
            method: "POST",
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            if (data.includes("Login Successful")) {
                // login สำเร็จ
                showSucess("Login successful");
                setTimeout(function(){
                    window.location.href = "../index.php";
                }, 2000); // 2 seconds
            }
            else{
                showError(data);
            }
        })
        .catch(error => {
            console.error("Error: ", error);
            showError("An error occurred. Please try again.");
        });
    });

});