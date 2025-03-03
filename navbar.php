<!--navbar-->
<link rel="stylesheet" href="navbar.css">
<div class="navbar">
        <div class="logo">
            <h1>G10</h1>
        </div>
        <div class="menu-items">
            <a href="index.php" class="menu-item"><i class="fa-solid fa-house"></i>Home</a>
            <a href="mainfunction.php" class="menu-item"><i class="fa-solid fa-calculator"></i>Function</a>
            <a href="aboutus.php" class="menu-item"><i class="fas fa-info-circle"></i>About us</a>
            <!-- <form action="../currencyApp/loginSystem/regPage.php">
                    <i class='fa-solid fa-arrow-right-to-bracket'></i>
                    <input class='login-btn' type='submit' value='Login'/>
                </form> -->
            <!-- เพิ่ม login -->

            <?php
                include 'loginSystem/system/connect.php';
                session_start();
                
                if (!isset($_SESSION['id'])) {
                    echo"
                    <a href=\"../currencyApp/loginSystem/regPage.php\" class='menu-item'>
                    <i class='fa-solid fa-arrow-right-to-bracket'></i>
                    <p>Login</p>
                    </a>
                    ";
                    // exit();
                }
                else{
                    $username = $_SESSION['username'];
                    echo "
                    <div class='nav-dropdown'>
                        <i class=\"fa-solid fa-user\"></i>
                        <button class='nav-dropdown-btn'>$username</button>
                        <div class='nav-dropdown-content'>
                            <a href='profile.php'>
                            <i class='fa-solid fa-user-circle'>
                            </i>  Profile</a>
                            <a href='loginSystem/system/logout.php'>
                            <i class='fa-solid fa-sign-out-alt'></i> 
                             Logout</a>
                        </div>
                    </div>";
                    // exit();

                }
            ?>

        </div>
    </div>
    <!-- เมนูด้านล่างสำหรับมือถือ -->
    <div class="bottom-nav">
        <a href="index.php" class="menu-item">
            <i class="fa-solid fa-house"></i>
            <p>Home</p>
        </a>
        <a href="mainfunction.php" class="menu-item">
            <i class="fa-solid fa-calculator"></i>
            <p>Function</p>
        </a>
        <a href="aboutus.php" class="menu-item">
            <i class="fas fa-info-circle"></i>
            <p>About us</p>
        </a>
        <!-- เพิ่ม login -->
        <?php
                
                if (!isset($_SESSION['id'])) {
                    echo"
                    <a href=\"../currencyApp/loginSystem/regPage.php\" class='menu-item'>
                    <i class='fa-solid fa-arrow-right-to-bracket'></i>
                    <p>Login</p>
                    </a>
                    ";
                    // exit();
                }
                else{
                    $username = $_SESSION['username'];
                    echo "
                    <div class='nav-dropdown'>
                        <i class=\"fa-solid fa-user\"></i>
                        <button class='nav-dropdown-btn-mb'>$username</button>
                        <div class='nav-dropdown-content-mb'>
                            <a href='profile.php'>
                            <i class='fa-solid fa-user-circle'>
                            </i>  Profile</a>
                            <a href='loginSystem/system/logout.php'>
                            <i class='fa-solid fa-sign-out-alt'></i> 
                             Logout</a>
                        </div>
                    </div>";
                    // exit();

                }
            ?>

    </div>



<script>
    document.addEventListener("DOMContentLoaded", function () {
        const currentPath = window.location.pathname.split("/").pop(); // ดึงชื่อไฟล์ เช่น "index.php"
        const menuItems = document.querySelectorAll(".menu-item");

        menuItems.forEach(item => {
            if (item.getAttribute("href") === currentPath) {
                item.classList.add("menu-item-home"); // เพิ่มคลาส active
            }
        });

        const dropdownBtn = document.querySelector(".nav-dropdown-btn");
        const dropdownContent = document.querySelector(".nav-dropdown-content");

        dropdownBtn.addEventListener("click", function (event) {
            event.stopPropagation(); // ป้องกันการปิดเมนูเมื่อกดปุ่ม
            dropdownContent.style.display = dropdownContent.style.display === "block" ? "none" : "block";

        });

        document.addEventListener("click", function () {
            dropdownContent.style.display = "none"; // ปิดเมนูเมื่อคลิกที่อื่น
        });

        const dropdownBtn2 = document.querySelector(".nav-dropdown-btn-mb");
        const dropdownContent2 = document.querySelector(".nav-dropdown-content-mb");

        dropdownBtn2.addEventListener("click", function (event) {
            event.stopPropagation(); // ป้องกันการปิดเมนูเมื่อกดปุ่ม
            dropdownContent2.style.display = dropdownContent.style.display === "block" ? "none" : "block";

        });

        document.addEventListener("click", function () {
            dropdownContent2.style.display = "none"; // ปิดเมนูเมื่อคลิกที่อื่น
        });
    });



</script>