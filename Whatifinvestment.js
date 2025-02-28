const stockReturns = {
    "1": { 
        "NVDA": [25.12, 61.01, 83.43, 75.56, 122.82, 154.43, 138.58, 143.72, 146.87, 169.67,181.28,173.40],
        "AMZN": [2.48, 16.68, 19.24, 15.69, 16.52, 27.59, 23.62, 17.92, 23.13, 23.21, 37.33, 44.85],
        "PLTR": [-5.04, 48.34, 35.75, 30.21, 28.20, 50.35, 59.42, 86.11, 119.84, 146.03, 296.48, 348.26],
        "WM": [4.42, 15.65, 19.94, 17.00, 18.47, 20.01, 13.99, 19.27, 16.69, 21.36, 28.35, 13.50],
        "GOLD": [-1.28, -1.05, 8.08, 10.67, 12.66, 12.62, 18.48, 21.18, 27.55, 32.85, 28.30, 27.06]
    },
    "5": {
        "NVDA": [120, 398.67, 147.08, 739.28, 2168.16],
        "AMZN": [76.59, 82.44, -8.78, 64.79, 137.54],
        "PLTR": [164.96, 79.65, -37.61, 73.01, 652.65],
        "WM": [3.16, 45.91, 37.17, 56.60, 76.27],
        "GOLD": [25.05, 20.79, 20.28, 35.79, 73.11]
    }
};

const sp500Returns = {
    "1": [2.11, 7.36, 10.67, 6.13, 11.19, 15.08, 16.32, 19.04, 21.38, 20.24, 27.09, 23.94],
    "5": [15.94, 46.74, 18.62, 47.05, 81.44]
};

const stockSelect = document.getElementById("stock-select");
const stockPercentInput = document.getElementById("stock-percent");
const addStockBtn = document.getElementById("add-stock-btn");
const portfolioList = document.getElementById("portfolio-list");
const timeRangeSelect = document.getElementById("time-range");
const resultDiv = document.getElementById("result");
const ctx = document.getElementById("myChart").getContext("2d");

let portfolio = [];
let chart;

addStockBtn.addEventListener("click", () => {
    const stock = stockSelect.value;
    const percent = parseFloat(stockPercentInput.value);
    let totalPercent = portfolio.reduce((sum, item) => sum + item.percent, 0) + percent;

    if (percent <= 0 || percent > 100 || isNaN(percent)) {
        alert("กรุณากรอกสัดส่วน 1-100%");
        return;
    }

    if (totalPercent > 100) {
        alert("สัดส่วนรวมต้องไม่เกิน 100%");
        return;
    }

    if (portfolio.some(item => item.stock === stock)) {
        alert("หุ้นนี้ถูกเพิ่มแล้ว");
        return;
    }

    portfolio.push({ stock, percent });
    updatePortfolioList();
    calculatePortfolio();
});

function updatePortfolioList() {
    portfolioList.innerHTML = "";
    portfolio.forEach((item, index) => {
        let div = document.createElement("div");
        div.innerHTML = `${item.stock} - ${item.percent}% <button class="delete-btn" onclick="removeStock(${index})">ลบ</button>`;
        portfolioList.appendChild(div);
    });
}

function removeStock(index) {
    portfolio.splice(index, 1);
    updatePortfolioList();
    calculatePortfolio();
}

function calculatePortfolio() {
    let totalPercent = portfolio.reduce((sum, item) => sum + item.percent, 0);
    if (totalPercent !== 100) {
        resultDiv.innerHTML = "กรุณาเพิ่มหุ้นให้ครบ 100%";
        if (chart) chart.destroy();
        return;
    }

    let timeFrame = timeRangeSelect.value;
    let totalReturns = new Array(timeFrame == "1" ? 12 : 5).fill(0);
    let stockData = [];

    portfolio.forEach(item => {
        let returnData = stockReturns[timeFrame][item.stock] || [];
        returnData.forEach((value, index) => {
            totalReturns[index] += value * (item.percent / 100);
        });
        stockData.push({ stock: item.stock, returnData });
    });

    let sp500Data = sp500Returns[timeFrame];
    resultDiv.innerHTML = `ผลตอบแทนรวมของพอร์ต: <b>${totalReturns[totalReturns.length - 1].toFixed(2)}%</b><br>ผลตอบแทน S&P 500: <b>${sp500Data[sp500Data.length - 1].toFixed(2)}%</b>`;
    drawChart(stockData, totalReturns, sp500Data, timeFrame);
}

function drawChart(stockData, totalReturns, sp500Data, timeFrame) {
    if (chart) chart.destroy();

    let labels = timeFrame === "1" ? ["ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค."] : ["2020", "2021", "2022", "2023", "2024"];
    let chartLabel = timeFrame === "1" ? "ผลตอบแทนรวมย้อนหลังปี 2024 (%)" : "ผลตอบแทนรวมย้อนหลังปี 2020-2024 (%)";

    chart = new Chart(ctx, {
        type: "line",
        data: {
            labels: labels,
            datasets: [
                {
                    label: "พอร์ตลงทุนของคุณ",
                    data: totalReturns,
                    borderColor: "#66FF33",
                    fill: false
                },
                {
                    label: "S&P 500",
                    data: sp500Data,
                    borderColor: "#FF9933",
                    fill: false
                }
            ]
        }
    });
}

timeRangeSelect.addEventListener("change", calculatePortfolio);
