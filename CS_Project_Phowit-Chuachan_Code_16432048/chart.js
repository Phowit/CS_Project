// Temperature_Chart
fetch('Chart_Temperature.php')
    .then(response => response.json())
    .then(data => {
        var ctx3 = $("#Temperature_Chart").get(0).getContext("2d");
        var myChart3 = new Chart(ctx3, {
            type: "line",
            data: {
                labels: data.DT_record,
                datasets: [{
                    label: "Temperature",
                    fill: true,
                    backgroundColor: "rgba(232, 211, 255, .7)",
                    data: data.T_Level
                }]
            }, 
            options: { responsive: true }
        });
    }
);

fetch('Chart_FoodLevel.php')
    .then(response => response.json())
    .then(data => {
        var ctx3 = $("#Food_Chart").get(0).getContext("2d");
        var myChart3 = new Chart(ctx3, {
            type: "line",
            data: {
                labels: data.DT_record,
                datasets: [{
                    label: "Food Level",
                    fill: true,
                    backgroundColor: "rgba(232, 211, 255, .7)",
                    data: data.FoodLevel
                }]
            }, 
            options: { responsive: true }
        });
    }
);

fetch('Chart_FoodTrayLevel.php')
    .then(response => response.json())
    .then(data => {
        var ctx1 = $("#FoodTray_Chart").get(0).getContext("2d");
        var myChart1 = new Chart(ctx1, {
            type: "bar",
            data: {
                labels: data.DT_record,
                datasets: [{
                        label: "ถาดที่ 1",
                        data: data.FoodTray1,
                        backgroundColor: "rgba(232, 211, 255, 1)"
                    },
                    {
                        label: "ถาดที่ 2",
                        data: data.FoodTray2,
                        backgroundColor: "rgba(232, 211, 255, .5)"
                    }]
                },
                options: { responsive: true }
        });
    }
);

fetch('Chart_FoodSLevel.php')
    .then(response => response.json())
    .then(data => {
        var ctx1 = $("#FoodS_Chart").get(0).getContext("2d");
        var myChart1 = new Chart(ctx1, {
            type: "bar",
            data: {
                labels: data.DT_record,
                datasets: [{
                        label: "ระดับอาหารเสริม",
                        data: data.FoodSLevel,
                        backgroundColor: "rgba(232, 211, 255, 1)"
                    }]
                },
                options: { responsive: true }
        });
    }
);