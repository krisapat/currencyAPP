document.querySelectorAll("input").forEach(input => {
    input.addEventListener("input", calculateInvestment);
});

let chartInstance = null; // เก็บตัวแปรของกราฟเพื่ออัปเดตข้อมูล

function calculateInvestment() {
    let initialAmount = parseFloat(document.getElementById('initialAmount').value) || 0;
    let monthlyContribution = parseFloat(document.getElementById('monthlyContribution').value) || 0;
    let annualReturn = parseFloat(document.getElementById('annualReturn').value) / 100 || 0;
    let years = parseInt(document.getElementById('years').value) || 0;

    if (!initialAmount || !monthlyContribution || !annualReturn || !years) {
        document.getElementById('totalAmount').textContent = "กรุณากรอกข้อมูลให้ครบ";
        return;
    }

    let totalAmount = initialAmount;
    let months = years * 12;
    let dataPoints = [];
    let labels = [];

    for (let i = 1; i <= months; i++) {
        totalAmount += monthlyContribution;
        totalAmount *= (1 + annualReturn / 12);

        if (i % 12 === 0) { // บันทึกค่าทุกปี
            labels.push(i / 12 + " ปี");
            dataPoints.push(totalAmount);
        }
    }

    document.getElementById('totalAmount').textContent = `ผลลัพธ์หลังจาก ${years} ปี: ${totalAmount.toFixed(2)} บาท`;

    updateChart(labels, dataPoints);
}

function updateChart(labels, dataPoints) {
    let ctx = document.getElementById('investmentChart').getContext('2d');

    if (chartInstance) {
        chartInstance.destroy(); // ลบกราฟเดิมก่อนสร้างใหม่
    }

    chartInstance = new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'มูลค่าการลงทุน',
                data: dataPoints,
                borderColor: '#00ac7c',
                backgroundColor: 'rgba(76, 175, 80, 0.2)',
                borderWidth: 2,
                pointRadius: 3,
                tension: 0.3
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: true
                }
            },
            scales: {
                x: {
                    title: {
                        display: true,
                        text: "ระยะเวลา (ปี)"
                    }
                },
                y: {
                    title: {
                        display: true,
                        text: "มูลค่าการลงทุน"
                    }
                }
            }
        }
    });
}
