// ประกาศตัวแปร global เพื่อเก็บ instance ของ Chart แต่ละตัว
// นี่คือสิ่งที่สำคัญเพื่อให้เราสามารถทำลายกราฟเก่าก่อนสร้างใหม่ได้
let temperatureChartInstance = null;
let foodChartInstance = null;
let foodTrayChartInstance = null;
let foodSChartInstance = null;
let collectChartInstance = null;
let importChartInstance = null;
let exportChartInstance = null;
let remainChartInstance = null;
let totalChartInstance = null;


// ฟังก์ชันกลางสำหรับโหลดกราฟทั้งหมดตามวันที่ที่ระบุ
// dateString ควรอยู่ในรูปแบบ YYYY-MM-DD
function loadAllChartsByDate(selectedDate) {
    // อัปเดตวันที่ที่แสดงบนหน้าจอ
    const displayDateElement = document.getElementById("displaySelectedDate");
    if (displayDateElement) {
        // แปลง YYYY-MM-DD เป็น DD/MM/YYYY สำหรับแสดงผล
        const [year, month, day] = selectedDate.split('-');
        displayDateElement.textContent = `${day}/${month}/${year}`;
    }

    // เรียกฟังก์ชันโหลดกราฟแต่ละตัว โดยส่งวันที่ที่เลือกเข้าไปด้วย
    loadTemperatureChart(selectedDate);
    loadFoodChart(selectedDate);
    loadFoodTrayChart(selectedDate);
    loadFoodSChart(selectedDate);
    loadCollectChart(selectedDate);
    loadImportChart(selectedDate);
    loadExportChart(selectedDate);
    loadRemainChart(selectedDate);
    loadTotalChart(selectedDate);
}


// โหลดกราฟ Temperature
function loadTemperatureChart(selectedDate = null) {
    if (document.getElementById("Temperature_Chart")) {
        // สร้าง URL สำหรับ fetch โดยเพิ่ม parameter 'date'
        let url = 'Chart_Temperature.php';
        if (selectedDate) {
            url += `?date=${selectedDate}`; // เช่น Chart_Temperature.php?date=2024-11-01
        }

        fetch(url)
            .then(response => response.json())
            .then(data => {
                console.log("Temperature Chart Data:", data);
                if (!data || !data.DT_record || !data.T_Level) {
                    console.error("JSON ที่ได้รับไม่สมบูรณ์:", data);
                    return;
                }

                const ctx = document.getElementById("Temperature_Chart").getContext("2d");

                // ตรวจสอบและทำลายกราฟเก่าหากมีอยู่
                if (temperatureChartInstance) {
                    temperatureChartInstance.destroy();
                }

                temperatureChartInstance = new Chart(ctx, {
                    type: "line",
                    data: {
                        labels: data.DT_record,
                        datasets: [{
                            label: "Temperature",
                            fill: true,
                            backgroundColor: "rgba(232, 211, 255, .7)",
                            data: data.T_Level,
                        }],
                    },
                    options: { responsive: true },
                });
            })
            .catch(error => console.error("Error loading Temperature chart:", error));
    }
}

// โหลดกราฟ Food Level
function loadFoodChart(selectedDate = null) {
    if (document.getElementById("Food_Chart")) {
        let url = 'Chart_FoodLevel.php';
        if (selectedDate) {
            url += `?date=${selectedDate}`;
        }

        fetch(url)
            .then(response => response.json())
            .then(data => {
                console.log("Food Level Chart Data:", data);
                if (!data || !data.DT_record || !data.FoodLevel) {
                    console.error("JSON ที่ได้รับไม่สมบูรณ์:", data);
                    return;
                }

                const ctx = document.getElementById("Food_Chart").getContext("2d");

                // ตรวจสอบและทำลายกราฟเก่าหากมีอยู่
                if (foodChartInstance) {
                    foodChartInstance.destroy();
                }

                foodChartInstance = new Chart(ctx, {
                    type: "line",
                    data: {
                        labels: data.DT_record,
                        datasets: [{
                            label: "Food Level",
                            fill: true,
                            backgroundColor: "rgba(232, 211, 255, .7)",
                            data: data.FoodLevel,
                        }],
                    },
                    options: { responsive: true },
                });
            })
            .catch(error => console.error("Error loading Food chart:", error));
    }
}

// โหลดกราฟ Food Tray Level
function loadFoodTrayChart(selectedDate = null) {
    if (document.getElementById("FoodTray_Chart")) {
        let url = 'Chart_FoodTrayLevel.php';
        if (selectedDate) {
            url += `?date=${selectedDate}`;
        }

        fetch(url)
            .then(response => response.json())
            .then(data => {
                console.log("Food Tray Chart Data:", data);
                if (!data || !data.DT_record || !data.FoodTray1 || !data.FoodTray2) {
                    console.error("JSON ที่ได้รับไม่สมบูรณ์:", data);
                    return;
                }

                const ctx = document.getElementById("FoodTray_Chart").getContext("2d");

                // ตรวจสอบและทำลายกราฟเก่าหากมีอยู่
                if (foodTrayChartInstance) {
                    foodTrayChartInstance.destroy();
                }

                foodTrayChartInstance = new Chart(ctx, {
                    type: "bar",
                    data: {
                        labels: data.DT_record,
                        datasets: [{
                            label: "ถาดที่ 1",
                            data: data.FoodTray1,
                            backgroundColor: "rgba(232, 211, 255, 1)"
                        }, {
                            label: "ถาดที่ 2",
                            data: data.FoodTray2,
                            backgroundColor: "rgba(232, 211, 255, .5)"
                        }],
                    },
                    options: { responsive: true },
                });
            })
            .catch(error => console.error("Error loading Food Tray chart:", error));
    }
}

// โหลดกราฟ Food Supplement Level
function loadFoodSChart(selectedDate = null) {
    if (document.getElementById("FoodS_Chart")) {
        let url = 'Chart_FoodSLevel.php';
        if (selectedDate) {
            url += `?date=${selectedDate}`;
        }

        fetch(url)
            .then(response => response.json())
            .then(data => {
                console.log("Food Supplement Chart Data:", data);
                if (!data || !data.DT_record || !data.FoodSLevel) {
                    console.error("JSON ที่ได้รับไม่สมบูรณ์:", data);
                    return;
                }

                const ctx = document.getElementById("FoodS_Chart").getContext("2d");

                // ตรวจสอบและทำลายกราฟเก่าหากมีอยู่
                if (foodSChartInstance) {
                    foodSChartInstance.destroy();
                }

                foodSChartInstance = new Chart(ctx, {
                    type: "bar",
                    data: {
                        labels: data.DT_record,
                        datasets: [{
                            label: "ระดับอาหารเสริม",
                            data: data.FoodSLevel,
                            backgroundColor: "rgba(232, 211, 255, 1)"
                        }],
                    },
                    options: { responsive: true },
                });
            })
            .catch(error => console.error("Error loading Food Supplement chart:", error));
    }
}

// โหลดกราฟ Collect Chart
function loadCollectChart(selectedDate = null) {
    if (document.getElementById("Collect_Chart")) {
        let url = 'Chart_Collect.php';
        if (selectedDate) {
            url += `?date=${selectedDate}`;
        }

        let existingChart = Chart.getChart("Collect_Chart");
        if (existingChart) {
            existingChart.destroy();
        }

        fetch(url)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok ' + response.statusText);
            }
            return response.json();
        })
        .then(data => {
            const labels = data.Collect_Date;
            const eggAmounts = data.EggAmount;

            const ctx = document.getElementById('Collect_Chart').getContext('2d');
            collectChartInstance = new Chart(ctx, { // เก็บ instance ของกราฟลงในตัวแปร global
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'จำนวนการเก็บไข่',
                        data: eggAmounts,
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
                            text: 'กราฟแสดงจำนวนการเก็บไข่ในแต่ละวัน'
                        }
                    },
                    scales: {
                        x: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'วันและเวลาที่เก็บไข่'
                            }
                        },
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'จำนวนไข่ (ฟอง)'
                            }
                        }
                    }
                }
            });
        })
        .catch(error => {
            console.error('There has been a problem with your fetch operation:', error);
            alert('ไม่สามารถโหลดข้อมูลกราฟได้ กรุณาลองใหม่อีกครั้ง');
        });
    }
}

// โหลดกราฟ Chicken Import Level
function loadImportChart(selectedDate = null) {
    if (document.getElementById("Import_Chart")) {
        let url = 'Chart_Import.php';
        if (selectedDate) {
            url += `?date=${selectedDate}`;
        }

        let existingChart = Chart.getChart("Import_Chart");
        if (existingChart) {
            existingChart.destroy();
        }

        fetch(url)
            .then(response => response.json())
            .then(data => {
                const labels = data.Import_Date;
                const datasets = Object.keys(data.Import_Amount).map((breed, index) => ({
                    label: breed,
                    data: data.Import_Amount[breed],
                    backgroundColor: `rgba(${50 + index * 50}, ${100 + index * 30}, ${150 + index * 20}, 0.7)`,
                    borderWidth: 1
                }));

                const ctx = document.getElementById('Import_Chart').getContext('2d');
                importChartInstance = new Chart(ctx, { // เก็บ instance ของกราฟลงในตัวแปร global
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: datasets
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'top'
                            },
                            title: {
                                display: true,
                            }
                        },
                        scales: {
                            x: {
                                stacked: false,
                            },
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            });
    }
}

// โหลดกราฟ Chicken Export Level
function loadExportChart(selectedDate = null) {
    if (document.getElementById("Export_Chart")) {
        let url = 'Chart_Export.php';
        if (selectedDate) {
            url += `?date=${selectedDate}`;
        }

        let existingChart = Chart.getChart("Export_Chart");
        if (existingChart) {
            existingChart.destroy();
        }

        fetch(url)
            .then(response => response.json())
            .then(data => {
                const labels = data.Export_Date;
                const datasets = Object.keys(data.Export_Amount).map((breed, index) => ({
                    label: breed,
                    data: data.Export_Amount[breed],
                    backgroundColor: `rgba(${50 + index * 50}, ${100 + index * 30}, ${150 + index * 20}, 0.7)`,
                    borderWidth: 1
                }));

                const ctx = document.getElementById('Export_Chart').getContext('2d');
                exportChartInstance = new Chart(ctx, { // เก็บ instance ของกราฟลงในตัวแปร global
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: datasets
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'top'
                            },
                            title: {
                                display: true,
                            }
                        },
                        scales: {
                            x: {
                                stacked: false,
                            },
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            });
    }
}

// โหลดกราฟ Chicken Remain Level
function loadRemainChart(selectedDate = null) {
    if (document.getElementById("Remain_Chart")) {
        let url = 'Chart_Remain.php';
        if (selectedDate) {
            url += `?date=${selectedDate}`;
        }

        let existingChart = Chart.getChart("Remain_Chart");
        if (existingChart) {
            existingChart.destroy();
        }

        fetch(url)
            .then(response => response.json())
            .then(data => {
                const labels = data.Remain_Date;
                const datasets = Object.keys(data.Remain_Amount).map((breed, index) => ({
                    label: breed,
                    data: data.Remain_Amount[breed],
                    backgroundColor: `rgba(${50 + index * 50}, ${100 + index * 30}, ${150 + index * 20}, 0.7)`,
                    borderWidth: 1
                }));

                const ctx = document.getElementById('Remain_Chart').getContext('2d');
                remainChartInstance = new Chart(ctx, { // เก็บ instance ของกราฟลงในตัวแปร global
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: datasets
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'top'
                            },
                            title: {
                                display: true,
                                text: 'Chicken Remain Level'
                            }
                        },
                        scales: {
                            x: {
                                stacked: false,
                            },
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            });
    }
}

// โหลดกราฟ Total Chart
function loadTotalChart(selectedDate = null) {
    if (document.getElementById("Total_Chart")) {
        let url = 'Chart_Total.php';
        if (selectedDate) {
            url += `?date=${selectedDate}`;
        }

        let existingChart = Chart.getChart("Total_Chart");
        if (existingChart) {
            existingChart.destroy();
        }

        fetch(url)
            .then(response => response.json())
            .then(data => {
                console.log("Total Chart Data:", data);
                if (!data || !data.Total_Date || !data.Total) {
                    console.error("JSON ที่ได้รับไม่สมบูรณ์:", data);
                    return;
                }

                const ctx = document.getElementById("Total_Chart").getContext("2d");
                totalChartInstance = new Chart(ctx, { // เก็บ instance ของกราฟลงในตัวแปร global
                    type: 'bar',
                    data: {
                        labels: data.Total_Date,
                        datasets: [{
                            label: "Total",
                            fill: true,
                            backgroundColor: "rgba(232, 211, 255, 1)",
                            borderWidth: 1 ,
                            data: data.Total,
                        }],
                    },
                    options: { responsive: true },
                });
            })
            .catch(error => console.error("Error loading Total chart:", error));
    }
}


// เมื่อ DOM โหลดเสร็จ:
document.addEventListener('DOMContentLoaded', () => {
    // 1. ดึงวันที่ปัจจุบันมาเป็นค่าเริ่มต้น
    const today = new Date();
    const year = today.getFullYear();
    const month = String(today.getMonth() + 1).padStart(2, '0'); // เดือน 0-11
    const day = String(today.getDate()).padStart(2, '0');
    const currentDateFormatted = `${year}-${month}-${day}`; // รูปแบบ YYYY-MM-DD

    // ตั้งค่า input type="date" เป็นวันที่ปัจจุบัน
    const datePicker = document.getElementById("chartDatePicker");
    if (datePicker) {
        datePicker.value = currentDateFormatted;
    }

    // แสดงวันที่ปัจจุบันบนหน้าจอ
    const displayDateElement = document.getElementById("displaySelectedDate");
    if (displayDateElement) {
        displayDateElement.textContent = `${day}/${month}/${year}`;
    }

    // โหลดกราฟทั้งหมดด้วยวันที่ปัจจุบันเมื่อหน้าเว็บโหลดครั้งแรก
    loadAllChartsByDate(currentDateFormatted);

    // 2. เพิ่ม Event Listener เมื่อมีการเปลี่ยนแปลงวันที่ใน Date Picker หรือคลิกปุ่มค้นหา
    const searchButton = document.getElementById("searchChartData");
    if (searchButton) {
        searchButton.addEventListener('click', () => {
            const selectedDate = datePicker.value; // ดึงวันที่ที่ผู้ใช้เลือก
            if (selectedDate) {
                loadAllChartsByDate(selectedDate); // โหลดกราฟใหม่ตามวันที่ที่เลือก
            } else {
                alert("กรุณาเลือกวันที่ที่ต้องการค้นหา");
            }
        });
    }

    // โค้ดสำหรับเมนู Active (ส่วนนี้ยังคงเดิม)
    var currentPage = '<?php echo basename($_SERVER["PHP_SELF"]); ?>';  //=======
    var navLinks = document.querySelectorAll('.navbar-nav .nav-link');
    navLinks.forEach(function(link) {
        if (link.getAttribute('href') === currentPage) {
            link.classList.add('active');
        }
    });

    // โค้ดสำหรับ Modal (ส่วนนี้ยังคงเดิม)
    var modal = document.getElementById("Modal");
    var btn = document.getElementById("myBtn");
    var span = document.getElementsByClassName("close")[0];
    if (btn) {
        btn.onclick = function() { modal.style.display = "block"; }
    }
    if (span) {
        span.onclick = function() { modal.style.display = "none"; }
    }
    window.onclick = function(event) {
        if (event.target == modal) { modal.style.display = "none"; }
    }
});