const regButton = document.getElementById("regButton");
const loginButton = document.getElementById("loginButton");
const loginForm = document.getElementById("login");
const regForm = document.getElementById("register");


regButton.addEventListener('click', function(){
    loginForm.style.display = "none";   // ซ่อนหน้า Login
    regForm.style.display = "flex";     // แสดงหน้า Register
    regForm.style.flexDirection = "column"; 
    regForm.style.justifyContent = "center"; 
    regForm.style.alignItems = "center"; 
})

loginButton.addEventListener('click', function(){
    regForm.style.display = "none";  // ซ่อนหน้า Register
    loginForm.style.display = "flex"; // แสดงหน้า Login
    loginForm.style.flexDirection = "column"; 
    loginForm.style.justifyContent = "center"; 
    loginForm.style.alignItems = "center"; 
})



// แจ้งเตือน error
function showError(message){
    const errorBar = document.getElementById("error-bar");
    const errorMessage = document.getElementById("error-message");
    errorMessage.textContent = message;
    
    errorBar.classList.add("show");

    // Auto-hide after 3 seconds
    setTimeout(() => {
        errorBar.classList.remove("show");
    }, 3000);
}

function closeErrorBar() {
    document.getElementById("error-bar").classList.remove("show");
}
