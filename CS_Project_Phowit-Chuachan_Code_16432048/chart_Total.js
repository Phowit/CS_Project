// ประกาศตัวแปร global เพื่อเก็บ instance ของ Chart แต่ละตัว
let TotalChartInstance = null;

// โหลดกราฟ Collect Chart
    if (document.getElementById("Total_Chart")) {
        let url = 'Chart_Total.php';

        // *** ใช้ตัวแปร global TotalChartInstance ที่ประกาศไว้ด้านบน ***
        if (TotalChartInstance) {
            TotalChartInstance.destroy();
        }

        fetch(url)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok ' + response.statusText);
            }
            return response.json();
        })
        .then(data => {

            const labels = data.Total_Date;
            const total = data.Total;

            const ctx = document.getElementById('Total_Chart').getContext('2d');
            TotalChartInstance = new Chart(ctx, { 
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'จำนวนไก่ไข่ในโรงเรือน',
                        data: total,
                        backgroundColor: 'rgba(75, 192, 192, 0.7)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top'
                        },
                        title: {
                            display: true,
                            text: 'กราฟแสดงจำนวนไก่ไข่'
                        }
                    },
                    scales: {
                        x: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'วันและเวลาที่บันทึก'
                            }
                        },
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'จำนวนไข่ (ตัว)'
                            }
                        }
                    }
                }
            });
        })
        .catch(error => {
            console.error('Error loading Total chart:', error);
            // alert('ไม่สามารถโหลดข้อมูลกราฟการเก็บไข่ได้ กรุณาลองใหม่อีกครั้ง'); // ไม่ควร alert บ่อยเกินไป
        });
    }
