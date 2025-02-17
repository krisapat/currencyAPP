document.addEventListener("DOMContentLoaded", function () {
    loadFavorites();
    updateFavoriteButtons();

    document.querySelectorAll(".favorite-btn").forEach(button => {
        button.addEventListener("click", function () {
            toggleFavorite(this, this.dataset.title, this.dataset.content);
        });
    });

    document.getElementById("clear-favorites").addEventListener("click", function () {
        localStorage.removeItem("favorites");
        loadFavorites();
        updateFavoriteButtons();
    });
});

function toggleFavorite(button, title, content) {
    let favorites = JSON.parse(localStorage.getItem("favorites")) || [];
    let existingIndex = favorites.findIndex(item => item.title === title);

    if (existingIndex !== -1) {
        favorites.splice(existingIndex, 1);
        button.classList.remove("active");
        button.textContent = "☆ Favorite";
    } else {
        // เพิ่มหุ้นใหม่ตรงนี้
        let symbol;
        if (title === "NVDA") symbol = "NASDAQ:NVDA";
        else if (title === "PLTR") symbol = "NASDAQ:PLTR";
        else if (title === "AMZN") symbol = "NASDAQ:AMZN";
        else if (title === "GOLD") symbol = "TVC:GOLD";
        else if (title === "WM") symbol = "NYSE:WM";
        favorites.push({ title: title, content: content, symbol: symbol });

        button.classList.add("active");
        button.textContent = "★ Unfavorite";
    }

    localStorage.setItem("favorites", JSON.stringify(favorites));
    loadFavorites();
}


function loadFavorites() {
    let favorites = JSON.parse(localStorage.getItem("favorites")) || [];
    let favoriteList = document.getElementById("favorite-list");
    favoriteList.innerHTML = "";

    favorites.forEach(item => {
        let div = document.createElement("div");
        div.classList.add("favorite-item");
        div.innerHTML = `
            <h3>${item.title}</h3>
            <div class="boxline"></div>
            <div class="boxx"></div>
            <div class="tradingview-widget-container" id="widget-${item.symbol.replace(":", "-")}"></div>
            <button onclick="removeFavorite('${item.title}')">ลบ</button>
        `;

        favoriteList.appendChild(div);

        // สร้าง TradingView Widget ใหม่
        createTradingViewWidget(item.symbol, `widget-${item.symbol.replace(":", "-")}`);
    });
}

function createTradingViewWidget(symbol, containerId) {
    let script = document.createElement("script");
    script.type = "text/javascript";
    script.src = "https://s3.tradingview.com/external-embedding/embed-widget-mini-symbol-overview.js";
    script.innerHTML = JSON.stringify({
        "symbol": symbol,
        "width": "100%",
        "height": "220",
        "locale": "th",
        "dateRange": "1D",
        "colorTheme": "dark",
        "isTransparent": false
    });

    document.getElementById(containerId).appendChild(script);
}

function removeFavorite(title) {
    let favorites = JSON.parse(localStorage.getItem("favorites")) || [];
    favorites = favorites.filter(item => item.title !== title);
    localStorage.setItem("favorites", JSON.stringify(favorites));
    loadFavorites();
    updateFavoriteButtons();
}

function updateFavoriteButtons() {
    let favorites = JSON.parse(localStorage.getItem("favorites")) || [];

    document.querySelectorAll(".favorite-btn").forEach(button => {
        let title = button.dataset.title;
        let isFavorite = favorites.some(item => item.title === title);

        if (isFavorite) {
            button.classList.add("active");
            button.textContent = "★ Unfavorite";
        } else {
            button.classList.remove("active");
            button.textContent = "☆ Favorite";
        }
    });
}
