// Temperature_Chart
fetch('connect_chart.php')
.then(response => response.json())
.then(data => {
    var ctx3 = $("#Temperature_Chart").get(0).getContext("2d");
    var myChart3 = new Chart(ctx3, {
        type: "line",
        data: {
            labels: [50, 60, 70, 80, 90, 100, 110, 120, 130, 140, 150],
            datasets: [{
                label: "Salse",
                fill: false,
                backgroundColor: "rgba(235, 22, 22, .7)",
                data: [7, 8, 8, 9, 9, 9, 10, 11, 14, 14, 15]
            }]
        },
        options: {
            responsive: true
        }
    });
});

// ดึงข้อมูลจาก connect_chart.php
fetch('connect_chart.php')
    .then(response => response.json())
    .then(data => {
        // แยกข้อมูล labels และ data สำหรับกราฟ
        const labels_DT = data.map(item => item.DT_record);   //DT

        //Food
        const FoodLevel = data.map(item => item.FoodLevel);

        //Supplementary
        const Supplementary = data.map(item => item.FoodSLevel);

        // Combined Bar Chart for FoodLevel and Supplementary
        var ctx5 = $("#Food-and-Supplementary-chart").get(0).getContext("2d");
        var myChart5 = new Chart(ctx5, {
            type: "bar",
            data: {
                labels: labels_DT,
                datasets: [{
                        label: "ระดับอาหารหลักในถังเก็บ",
                        data: FoodLevel,
                        backgroundColor: "rgba(150, 150, 255, .7)",
                    },
                    {
                        label: "ระดับอาหารเสริม",
                        data: Supplementary,
                        backgroundColor: "rgba(255, 150, 150, .7)",
                    }
                ]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    })
    .catch(error => console.error('Error fetching data:', error));
