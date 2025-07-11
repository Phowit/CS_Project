// chart_Total.js

// NEW GLOBAL CHART INSTANCES FOR DEDICATED TOTAL CHARTS
let totalTemperatureChartInstance;
let totalFoodChartInstance;
let totalFoodTrayChartInstance;
let totalFoodSChartInstance;
let totalCollectChartInstance;
let totalImportChartInstance;
let totalExportChartInstance;
let totalRemainChartInstance;

// หากคุณมีกราฟ totalChartInstance เดิมที่แสดงข้อมูลรวมอยู่แล้ว และต้องการให้มันอยู่ในไฟล์นี้ด้วย
// คุณสามารถย้ายตัวแปรและฟังก์ชัน loadTotalChart(เดิม) มาไว้ที่นี่ได้
// let totalChartInstance;
// function loadTotalChart(selectedDate = null) { ... } // ย้ายมาทั้งก้อน


// =========================================================================
// FUNCTIONS FOR TOTAL CHARTS (แสดงข้อมูลทั้งหมด ไม่มีการกรองวันที่)
// =========================================================================

// โหลดกราฟ Temperature ทั้งหมด
function loadTotalTemperatureChart() {
    if (document.getElementById("Total_Temperature_Chart")) { // ตรวจสอบ ID ใหม่สำหรับกราฟรวม
        const url = 'Chart_Total_Temperature.php'; // เปลี่ยนมาใช้ไฟล์ PHP ใหม่
        fetch(url)
            .then(response => response.json())
            .then(data => {
                console.log("Total Temperature Chart Data:", data);
                if (!data || !data.DT_record || !data.T_Level) {
                    console.error("JSON ที่ได้รับไม่สมบูรณ์สำหรับกราฟอุณหภูมิรวม:", data);
                    return;
                }

                const ctx = document.getElementById("Total_Temperature_Chart").getContext("2d");

                if (totalTemperatureChartInstance) { // ใช้ตัวแปร global ใหม่สำหรับกราฟรวม
                    totalTemperatureChartInstance.destroy();
                }

                totalTemperatureChartInstance = new Chart(ctx, {
                    type: "bar", // หรือ 'line' ตามที่คุณต้องการ
                    data: {
                        labels: data.DT_record,
                        datasets: [{
                            label: "Temperature (ทั้งหมด)",
                            fill: true,
                            backgroundColor: "rgba(100, 149, 237, 0.7)", // สีน้ำเงินคงที่
                            borderColor: "rgba(100, 149, 237, 1)",
                            borderWidth: 1,
                            data: data.T_Level,
                        }],
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            title: {
                                display: true,
                                text: 'กราฟแสดงอุณหภูมิรวมทั้งหมด'
                            }
                        },
                        scales: {
                            x: {
                                title: {
                                    display: true,
                                    text: 'วันและเวลา'
                                }
                            },
                            y: {
                                beginAtZero: true,
                                title: {
                                    display: true,
                                    text: 'อุณหภูมิ (°C)'
                                }
                            }
                        }
                    },
                });
            })
            .catch(error => console.error("Error loading Total Temperature chart:", error));
    }
}

// โหลดกราฟ Food Level ทั้งหมด
function loadTotalFoodChart() {
    if (document.getElementById("Total_Food_Chart")) {
        const url = 'Chart_Total_FoodLevel.php'; // เปลี่ยนมาใช้ไฟล์ PHP ใหม่
        fetch(url)
            .then(response => response.json())
            .then(data => {
                console.log("Total Food Level Chart Data:", data);
                if (!data || !data.DT_record || !data.FoodLevel) {
                    console.error("JSON ที่ได้รับไม่สมบูรณ์สำหรับกราฟระดับอาหารรวม:", data);
                    return;
                }

                const ctx = document.getElementById("Total_Food_Chart").getContext("2d");

                if (totalFoodChartInstance) {
                    totalFoodChartInstance.destroy();
                }

                totalFoodChartInstance = new Chart(ctx, {
                    type: "bar",
                    data: {
                        labels: data.DT_record,
                        datasets: [{
                            label: "Food Level (ทั้งหมด)",
                            fill: true,
                            backgroundColor: "rgba(144, 238, 144, 0.7)", // สีเขียวอ่อนคงที่
                            borderColor: "rgba(144, 238, 144, 1)",
                            borderWidth: 1,
                            data: data.FoodLevel,
                        }],
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            title: {
                                display: true,
                                text: 'กราฟแสดงระดับอาหารรวมทั้งหมด'
                            }
                        },
                        scales: {
                            x: {
                                title: {
                                    display: true,
                                    text: 'วันและเวลา'
                                }
                            },
                            y: {
                                beginAtZero: true,
                                title: {
                                    display: true,
                                    text: 'ระดับอาหาร'
                                }
                            }
                        }
                    },
                });
            })
            .catch(error => console.error("Error loading Total Food chart:", error));
    }
}

// โหลดกราฟ Food Tray Level ทั้งหมด
function loadTotalFoodTrayChart() {
    if (document.getElementById("Total_FoodTray_Chart")) {
        const url = 'Chart_Total_FoodTrayLevel.php'; // เปลี่ยนมาใช้ไฟล์ PHP ใหม่
        fetch(url)
            .then(response => response.json())
            .then(data => {
                console.log("Total Food Tray Chart Data:", data);
                if (!data || !data.DT_record || !data.FoodTray1 || !data.FoodTray2) {
                    console.error("JSON ที่ได้รับไม่สมบูรณ์สำหรับกราฟระดับถาดอาหารรวม:", data);
                    return;
                }

                const ctx = document.getElementById("Total_FoodTray_Chart").getContext("2d");

                if (totalFoodTrayChartInstance) {
                    totalFoodTrayChartInstance.destroy();
                }

                totalFoodTrayChartInstance = new Chart(ctx, {
                    type: "bar",
                    data: {
                        labels: data.DT_record,
                        datasets: [{
                            label: "ถาดที่ 1 (ทั้งหมด)",
                            data: data.FoodTray1,
                            backgroundColor: "rgba(255, 160, 122, 0.7)", // สีส้มพีชคงที่
                            borderColor: "rgba(255, 160, 122, 1)",
                            borderWidth: 1
                        }, {
                            label: "ถาดที่ 2 (ทั้งหมด)",
                            data: data.FoodTray2,
                            backgroundColor: "rgba(255, 218, 185, 0.7)", // สีส้มอ่อนคงที่
                            borderColor: "rgba(255, 218, 185, 1)",
                            borderWidth: 1
                        }],
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            title: {
                                display: true,
                                text: 'กราฟแสดงระดับถาดอาหารรวมทั้งหมด'
                            }
                        },
                        scales: {
                            x: {
                                stacked: true,
                                title: {
                                    display: true,
                                    text: 'วันและเวลา'
                                }
                            },
                            y: {
                                beginAtZero: true,
                                stacked: true,
                                title: {
                                    display: true,
                                    text: 'ระดับ'
                                }
                            }
                        }
                    },
                });
            })
            .catch(error => console.error("Error loading Total Food Tray chart:", error));
    }
}

// โหลดกราฟ Food Supplement Level ทั้งหมด
function loadTotalFoodSChart() {
    if (document.getElementById("Total_FoodS_Chart")) {
        const url = 'Chart_Total_FoodSLevel.php'; // เปลี่ยนมาใช้ไฟล์ PHP ใหม่
        fetch(url)
            .then(response => response.json())
            .then(data => {
                console.log("Total Food Supplement Chart Data:", data);
                if (!data || !data.DT_record || !data.FoodSLevel) {
                    console.error("JSON ที่ได้รับไม่สมบูรณ์สำหรับกราฟระดับอาหารเสริมรวม:", data);
                    return;
                }

                const ctx = document.getElementById("Total_FoodS_Chart").getContext("2d");

                if (totalFoodSChartInstance) {
                    totalFoodSChartInstance.destroy();
                }

                totalFoodSChartInstance = new Chart(ctx, {
                    type: "bar",
                    data: {
                        labels: data.DT_record,
                        datasets: [{
                            label: "ระดับอาหารเสริม (ทั้งหมด)",
                            data: data.FoodSLevel,
                            backgroundColor: "rgba(173, 216, 230, 0.7)", // สีฟ้าอ่อนคงที่
                            borderColor: "rgba(173, 216, 230, 1)",
                            borderWidth: 1
                        }],
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            title: {
                                display: true,
                                text: 'กราฟแสดงระดับอาหารเสริมรวมทั้งหมด'
                            }
                        },
                        scales: {
                            x: {
                                title: {
                                    display: true,
                                    text: 'วันและเวลา'
                                }
                            },
                            y: {
                                beginAtZero: true,
                                title: {
                                    display: true,
                                    text: 'ระดับ'
                                }
                            }
                        }
                    },
                });
            })
            .catch(error => console.error("Error loading Total Food Supplement chart:", error));
    }
}

// โหลดกราฟ Collect Chart ทั้งหมด
function loadTotalCollectChart() {
    if (document.getElementById("Total_Collect_Chart")) {
        const url = 'Chart_Total_Collect.php'; // เปลี่ยนมาใช้ไฟล์ PHP ใหม่
        fetch(url)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok ' + response.statusText);
                }
                return response.json();
            })
            .then(data => {
                if (!data || !data.Collect_Date || !data.EggAmount) {
                    console.error("JSON data for Total Collect Chart is incomplete:", data);
                    return;
                }

                const labels = data.Collect_Date;
                const eggAmounts = data.EggAmount;

                const ctx = document.getElementById('Total_Collect_Chart').getContext('2d');

                if (totalCollectChartInstance) {
                    totalCollectChartInstance.destroy();
                }

                totalCollectChartInstance = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'จำนวนการเก็บไข่ (ทั้งหมด)',
                            data: eggAmounts,
                            backgroundColor: 'rgba(188, 143, 143, 0.7)', // สีน้ำตาลกุหลาบคงที่
                            borderColor: 'rgba(188, 143, 143, 1)',
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
                                text: 'กราฟแสดงจำนวนการเก็บไข่รวมทั้งหมด'
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
                console.error('Error loading Total Collect chart:', error);
            });
    }
}

// โหลดกราฟ Chicken Import Level ทั้งหมด
function loadTotalImportChart() {
    if (document.getElementById("Total_Import_Chart")) {
        const url = 'Chart_Total_Import.php'; // เปลี่ยนมาใช้ไฟล์ PHP ใหม่
        fetch(url)
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                const ctx = document.getElementById('Total_Import_Chart').getContext('2d');

                if (totalImportChartInstance) {
                    totalImportChartInstance.destroy();
                }

                const fixedColors = [
                    { bg: 'rgba(135, 206, 250, 0.7)', border: 'rgba(135, 206, 250, 1)' }, // Sky Blue
                    { bg: 'rgba(255, 228, 181, 0.7)', border: 'rgba(255, 228, 181, 1)' }, // Moccasin
                    { bg: 'rgba(152, 251, 152, 0.7)', border: 'rgba(152, 251, 152, 1)' }, // PaleGreen
                    { bg: 'rgba(221, 160, 221, 0.7)', border: 'rgba(221, 160, 221, 1)' }  // Plum
                ];

                const datasets = data.datasets.map((dataset, index) => ({
                    ...dataset,
                    label: dataset.label + ' (ทั้งหมด)', // เพิ่ม (ทั้งหมด) ต่อท้าย label
                    backgroundColor: fixedColors[index % fixedColors.length].bg,
                    borderColor: fixedColors[index % fixedColors.length].border,
                    borderWidth: 1
                }));

                totalImportChartInstance = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: data.labels,
                        datasets: datasets
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            title: {
                                display: true,
                                text: 'กราฟจำนวนไก่ที่นำเข้ารวมทั้งหมด แยกตามสายพันธุ์'
                            }
                        },
                        scales: {
                            x: {
                                title: {
                                    display: true,
                                    text: 'วันและเวลา'
                                }
                            },
                            y: {
                                title: {
                                    display: true,
                                    text: 'จำนวนไก่ (ตัว)'
                                },
                                beginAtZero: true
                            }
                        }
                    }
                });
            })
            .catch(error => {
                console.error('Error fetching total import data:', error);
            });
    }
}

// โหลดกราฟ Chicken Export Level ทั้งหมด
function loadTotalExportChart() {
    if (document.getElementById("Total_Export_Chart")) {
        const url = 'Chart_Total_Export.php'; // เปลี่ยนมาใช้ไฟล์ PHP ใหม่
        fetch(url)
            .then(response => response.json())
            .then(data => {
                const fixedColors = [
                    { bg: 'rgba(240, 128, 128, 0.7)', border: 'rgba(240, 128, 128, 1)' }, // Light Coral
                    { bg: 'rgba(255, 223, 0, 0.7)', border: 'rgba(255, 223, 0, 1)' },   // Gold
                    { bg: 'rgba(106, 90, 205, 0.7)', border: 'rgba(106, 90, 205, 1)' }, // SlateBlue
                    { bg: 'rgba(139, 69, 19, 0.7)', border: 'rgba(139, 69, 19, 1)' }    // SaddleBrown
                ];

                const labels = data.Export_Date;
                const datasets = data.Export_Amount.map((dataset, index) => ({ // ลูปผ่าน array ของ datasets โดยตรง
                    ...dataset,
                    label: dataset.label + ' (ทั้งหมด)',
                    backgroundColor: fixedColors[index % fixedColors.length].bg,
                    borderColor: fixedColors[index % fixedColors.length].border,
                    borderWidth: 1
                }));

                const ctx = document.getElementById('Total_Export_Chart').getContext('2d');
                if (totalExportChartInstance) { // ใช้ตัวแปร global ใหม่
                    totalExportChartInstance.destroy();
                }

                totalExportChartInstance = new Chart(ctx, {
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
                                text: 'กราฟแสดงจำนวนไก่ที่ส่งออกรวมทั้งหมด แยกตามสายพันธุ์'
                            }
                        },
                        scales: {
                            x: {
                                stacked: false,
                                title: {
                                    display: true,
                                    text: 'วันและเวลา'
                                }
                            },
                            y: {
                                beginAtZero: true,
                                title: {
                                    display: true,
                                    text: 'จำนวนไก่ (ตัว)'
                                }
                            }
                        }
                    }
                });
            });
    }
}

// โหลดกราฟ Chicken Remain Level ทั้งหมด
function loadTotalRemainChart() {
    if (document.getElementById("Total_Remain_Chart")) {
        const url = 'Chart_Total_Remain.php'; // เปลี่ยนมาใช้ไฟล์ PHP ใหม่
        fetch(url)
            .then(response => response.json())
            .then(data => {
                const fixedColors = [
                    { bg: 'rgba(60, 179, 113, 0.7)', border: 'rgba(60, 179, 113, 1)' },  // MediumSeaGreen
                    { bg: 'rgba(70, 130, 180, 0.7)', border: 'rgba(70, 130, 180, 1)' },  // SteelBlue
                    { bg: 'rgba(255, 99, 71, 0.7)', border: 'rgba(255, 99, 71, 1)' },    // Tomato
                    { bg: 'rgba(218, 112, 214, 0.7)', border: 'rgba(218, 112, 214, 1)' } // Orchid
                ];

                const labels = data.Remain_Date;
                const datasets = data.Remain_Amount.map((dataset, index) => ({ // ลูปผ่าน array ของ datasets โดยตรง
                    ...dataset,
                    label: dataset.label + ' (ทั้งหมด)',
                    backgroundColor: fixedColors[index % fixedColors.length].bg,
                    borderColor: fixedColors[index % fixedColors.length].border,
                    borderWidth: 1
                }));

                const ctx = document.getElementById('Total_Remain_Chart').getContext('2d');
                if (totalRemainChartInstance) { // ใช้ตัวแปร global ใหม่
                    totalRemainChartInstance.destroy();
                }

                totalRemainChartInstance = new Chart(ctx, {
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
                                text: 'กราฟแสดงจำนวนไก่คงเหลือรวมทั้งหมด แยกตามสายพันธุ์'
                            }
                        },
                        scales: {
                            x: {
                                stacked: false,
                                title: {
                                    display: true,
                                    text: 'วันและเวลา'
                                }
                            },
                            y: {
                                beginAtZero: true,
                                title: {
                                    display: true,
                                    text: 'จำนวนไก่ (ตัว)'
                                }
                            }
                        }
                    }
                });
            });
    }
}

// ฟังก์ชันสำหรับโหลดกราฟทั้งหมดแบบรวม (ไม่มีการกรองวันที่)
function loadAllTotalCharts() {
    loadTotalTemperatureChart();
    loadTotalFoodChart();
    loadTotalFoodTrayChart();
    loadTotalFoodSChart();
    loadTotalCollectChart();
    loadTotalImportChart();
    loadTotalExportChart();
    loadTotalRemainChart();
    // ถ้า Total_Chart เดิมของคุณเป็นกราฟรวมอยู่แล้วก็เรียกใช้ด้วย
    // loadTotalChart(); // หากคุณย้ายฟังก์ชัน loadTotalChart เดิมมาไว้ในไฟล์นี้
}

// เมื่อ DOM โหลดเสร็จ:
document.addEventListener('DOMContentLoaded', () => {
    // *** เรียกใช้ฟังก์ชันโหลดกราฟรวมทั้งหมดที่นี่ เมื่อ DOM โหลดเสร็จ ***
    loadAllTotalCharts(); // โหลดกราฟรวมทั้งหมดที่ใช้ PHP ไฟล์ใหม่
});