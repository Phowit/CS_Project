// ดึงข้อมูลจาก data.php
fetch('connect_chart.php')
    .then(response => response.json())
    .then(data => {
        // แยกข้อมูล labels และ data สำหรับกราฟ

            const labels_DT = data.map(item => item.DT_record);   //DT

            //FoodTray
            const FoodTrayLevel1  = data.map(item => item.FoodTrayLevel1);    //FoodTray 1
            const FoodTrayLevel2 = data.map(item => item.FoodTrayLevel2);   //FoodTray 2

            //Food
            const FoodLevel = data.map(item => item.FoodLevel);

            //Temperature
            const T_Level = data.map(item => item.T_Level);

            //Supplementary
            const Supplementary = data.map(item => item.FoodSLevel);


var ctx1 = $("#FoodTray-sales").get(0).getContext("2d");
    var myChart1 = new Chart(ctx1, {
        type: "bar",
        data: {
            labels: labels_DT,
            datasets: [{
                    label: "ระดับอาหารในถาดให้อาหารที่ 1",
                    data: FoodTrayLevel1,
                    backgroundColor: "rgb(150, 150, 255,.8)"
                },
                {
                    label: "ระดับอาหารในถาดให้อาหารที่ 2",
                    data: FoodTrayLevel2,
                    backgroundColor: "rgb(150, 150, 255, .5)"
                }

            ]
            },
        options: {
            responsive: true
        }
    });


    // Salse & Revenue Chart
    var ctx2 = $("#Food-revenue").get(0).getContext("2d");
    var myChart2 = new Chart(ctx2, {
        type: "line",
        data: {
            labels: labels_DT,
            datasets: [{
                    label: "ระดับอาหารหลักในถังเก็บ",
                    data: FoodLevel,
                    backgroundColor: "rgb(150, 150, 255, .5)",
                    fill: true
                }
            ]
            },
        options: {
            responsive: true
        }
    });
    


    // Single Line Chart
    var ctx3 = $("#Temperature-chart").get(0).getContext("2d");
    var myChart3 = new Chart(ctx3, {
        type: "line",
        data: {
            labels: labels_DT,
            datasets: [{
                label: "อุณหภูมิในโรงเรือน",
                fill: false,
                backgroundColor: "rgba(150, 150, 255, .7)",
                data: T_Level
            }]
        },
        options: {
            responsive: true
        }
    });


    // Single Bar Chart
    var ctx4 = $("#Supplementary-chart").get(0).getContext("2d");
    var myChart4 = new Chart(ctx4, {
        type: "bar",
        data: {
            labels: labels_DT,
            datasets: [{
                label: "ระดับอาหารเสริม",
                backgroundColor: [
                    "rgba(150, 150, 255, .8)",
                    "rgba(150, 150, 255, .7)",
                    "rgba(150, 150, 255, .6)",
                    "rgba(150, 150, 255, .5)",
                    "rgba(150, 150, 255, .4)",
                    "rgba(150, 150, 255, .3)",
                    "rgba(150, 150, 255, .2)"
                ],
                data: Supplementary
            }]
        },
        options: {
            responsive: true
        }
    });
})
.catch(error => console.error('Error fetching data:', error));