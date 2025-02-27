document.addEventListener("DOMContentLoaded", function () {
    // if (document.getElementById("favorite-list")) {
    //     loadFavorites(); // โหลดเฉพาะใน fav.html
    // }

    // updateFavoriteButtons();

    // document.querySelectorAll(".favorite-btn").forEach(button => {
    //     button.addEventListener("click", function () {
    //         toggleFavorite(this, this.dataset.title, this.dataset.content);
    //     });
    // });

    // document.getElementById("clear-favorites")?.addEventListener("click", function () {
    //     localStorage.removeItem("favorites");
    //     loadFavorites();
    //     updateFavoriteButtons();
    // });

    document.getElementById("search-bar")?.addEventListener("input", function () {
        searchItems(this.value);
    });
});

function searchItems(query) {
    query = query.toLowerCase();
    document.querySelectorAll(".item").forEach(item => {
        let title = item.querySelector("h3").textContent.toLowerCase();
        item.style.display = title.includes(query) ? "block" : "none";
    });
}

// function toggleFavorite(button, title, content) {
//     let favorites = JSON.parse(localStorage.getItem("favorites")) || [];
//     let existingIndex = favorites.findIndex(item => item.title === title);

//     if (existingIndex !== -1) {
//         favorites.splice(existingIndex, 1);
//         button.textContent = "☆";
//     } else {
//         let symbol;
//         if (title === "NVDA") symbol = "NASDAQ:NVDA";
//         else if (title === "PLTR") symbol = "NASDAQ:PLTR";
//         else if (title === "AMZN") symbol = "NASDAQ:AMZN";
//         else if (title === "GOLD") symbol = "TVC:GOLD";
//         else if (title === "WM") symbol = "NYSE:WM";
//         favorites.push({ title: title, content: content, symbol: symbol });

//         button.textContent = "★";
//     }

//     localStorage.setItem("favorites", JSON.stringify(favorites));

//     if (document.getElementById("favorite-list")) {
//         loadFavorites(); // โหลดเฉพาะถ้าอยู่ใน fav.html
//     }
// }

// function loadFavorites() {
//     let favorites = JSON.parse(localStorage.getItem("favorites")) || [];
//     let favoriteList = document.getElementById("favorite-list");

//     if (!favoriteList) return; // ป้องกัน error ถ้าไม่ได้อยู่ใน fav.html

//     favoriteList.innerHTML = "";

//     favorites.forEach(item => {
//         let div = document.createElement("div");
//         div.classList.add("favorite-item");
//         div.innerHTML = `
//             <div class="item-head">
//                 <h3>${item.title}</h3>
//                 <button class="favorite-btn" onclick="removeFavorite('${item.title}')">★</button>
//             </div>
//             <div class="tradingview-widget-container" id="widget-${item.symbol.replace(":", "-")}"></div>
//         `;

//         favoriteList.appendChild(div);

//         createTradingViewWidget(item.symbol, `widget-${item.symbol.replace(":", "-")}`);
//     });
// }

function createTradingViewWidget(symbol, containerId) {
    let script = document.createElement("script");
    script.type = "text/javascript";
    script.src = "https://s3.tradingview.com/external-embedding/embed-widget-mini-symbol-overview.js";
    script.innerHTML = JSON.stringify({
        "symbol": symbol,
        "width": "100%",
        "height": "160",
        "locale": "th",
        "dateRange": "1D",
        "colorTheme": "dark",
        "isTransparent": false
    });

    document.getElementById(containerId).appendChild(script);
}

    

// function removeFavorite(title) {
//     let favorites = JSON.parse(localStorage.getItem("favorites")) || [];
//     favorites = favorites.filter(item => item.title !== title);
//     localStorage.setItem("favorites", JSON.stringify(favorites));
//     loadFavorites();
//     updateFavoriteButtons();
// }

// function updateFavoriteButtons() {
//     let favorites = JSON.parse(localStorage.getItem("favorites")) || [];

//     document.querySelectorAll(".favorite-btn").forEach(button => {
//         let title = button.dataset.title;
//         let isFavorite = favorites.some(item => item.title === title);

//         button.textContent = isFavorite ? "★" : "☆";
//     });
// }


