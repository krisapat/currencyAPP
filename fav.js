document.addEventListener("DOMContentLoaded", function () {
    loadFavorites();

    document.getElementById("clear-favorites").addEventListener("click", function () {
        localStorage.removeItem("favorites");
        loadFavorites();
    });

    document.getElementById("search-bar").addEventListener("input", function () {
        searchFavorites(this.value);
    });
});

function loadFavorites() {
    let favorites = JSON.parse(localStorage.getItem("favorites")) || [];
    let favoriteList = document.getElementById("favorite-list");
    favoriteList.innerHTML = "";

    favorites.forEach(item => {
        let div = document.createElement("div");
        div.classList.add("favorite-item");
        div.innerHTML = `
            <div class="item-head">
                <h3>${item.title}</h3>
                <button class="favorite-btn" onclick="removeFavorite('${item.title}')">★</button>
            </div>
            <div class="tradingview-widget-container" id="widget-${item.symbol.replace(":", "-")}"></div>
        `;

        favoriteList.appendChild(div);

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
        "height": "160",
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
}

function searchFavorites(query) {
    query = query.toLowerCase();
    document.querySelectorAll(".favorite-item").forEach(item => {
        let title = item.querySelector("h3").textContent.toLowerCase();
        item.style.display = title.includes(query) ? "block" : "none";
    });
}
