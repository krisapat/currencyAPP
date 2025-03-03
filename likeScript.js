document.addEventListener("DOMContentLoaded", function() {
    const buttons = document.querySelectorAll(".like-btn");

    buttons.forEach(button => {
        button.addEventListener("click", function() {
            const stockId = this.getAttribute("data-id");
            console.log("หุ้นที่ถูกกดมี ID:", stockId); // ✅ ตรวจสอบผ่าน Console

            // 🔄 ส่งข้อมูลไปยัง PHP ด้วย Fetch API
            fetch('like-stock.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: `stock_id=${stockId}`
            })
            .then(response => response.text())
            .then(data => {
                alert(data); // แสดงผลลัพธ์จาก PHP
            });
        });
    });
});
