const regButton = document.getElementById("regButton");
const loginButton = document.getElementById("loginButton");
const loginForm = document.getElementById("login");
const regForm = document.getElementById("register");


regButton.addEventListener('click', function(){
    loginForm.style.display = "none";
    regForm.style.display = "block";
})

loginButton.addEventListener('click', function(){
    loginForm.style.display = "block";
    regForm.style.display = "none";
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

