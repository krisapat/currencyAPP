document.getElementById("amount").addEventListener("input", convertCurrency);
document.getElementById("fromCurrency").addEventListener("change", convertCurrency);
document.getElementById("toCurrency").addEventListener("change", convertCurrency);

async function fetchExchangeRate(from, to) {
    try {
        const response = await fetch(`https://api.exchangerate-api.com/v4/latest/${from}`);
        const data = await response.json();
        return data.rates[to] || null;
    } catch (error) {
        console.error("Error fetching exchange rate:", error);
        return null;
    }
}

async function convertCurrency() {
    const fromCurrency = document.getElementById("fromCurrency").value;
    const toCurrency = document.getElementById("toCurrency").value;
    const amount = document.getElementById("amount").value;

    if (!amount || amount <= 0) {
        document.getElementById("result").innerText = "Please enter a valid amount.";
        return;
    }

    const rate = await fetchExchangeRate(fromCurrency, toCurrency);
    if (!rate) {
        document.getElementById("result").innerText = "Exchange rate not available.";
        return;
    }

    const convertedAmount = (amount * rate).toFixed(2);
    document.getElementById("result").innerText = `${amount} ${fromCurrency} = ${convertedAmount} ${toCurrency}`;

    fetchHistoricalData(fromCurrency, toCurrency);
}

async function fetchHistoricalData(from, to) {
    try {
        const endDate = new Date().toISOString().split('T')[0];
        const startDate = new Date();
        startDate.setFullYear(startDate.getFullYear() - 1);
        const startDateStr = startDate.toISOString().split('T')[0];

        const url = `https://api.frankfurter.app/${startDateStr}..${endDate}?from=${from}&to=${to}`;
        const response = await fetch(url);
        const data = await response.json();

        if (!data.rates) {
            console.error("No historical data found");
            return;
        }

        const labels = Object.keys(data.rates);
        const values = labels.map(date => data.rates[date][to] || 0);

        updateChart(labels, values, from, to);
    } catch (error) {
        console.error("Error fetching historical data:", error);
    }
}

let chart;
function updateChart(labels, values, from, to) {
    const ctx = document.getElementById("exchangeRateChart").getContext("2d");
    if (chart) chart.destroy();
    chart = new Chart(ctx, {
        type: "line",
        data: {
            labels: labels,
            datasets: [{
                label: `Exchange Rate ${from} → ${to}`,
                data: values,
                borderColor: "#00aaff",
                fill: false
            }]
        },
        options: {
            responsive: true,
            scales: {
                x: { display: true },
                y: { display: true }
            }
        }
    });
}

convertCurrency();