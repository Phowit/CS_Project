// โหลดกราฟ Temperature
function loadTemperatureChart() {
    if (document.getElementById("Temperature_Chart")) {
        fetch('Chart_Temperature.php') // ควรตรวจสอบชื่อไฟล์ PHP
            .then(response => response.json())
            .then(data => {
                console.log("Temperature Chart Data:", data); // แสดงข้อมูลที่ได้รับใน console
                if (!data || !data.DT_record || !data.T_Level) {
                    console.error("JSON ที่ได้รับไม่สมบูรณ์:", data); // ถ้าข้อมูลไม่ครบ จะพิมพ์ข้อความนี้
                    return;
                }

                const ctx3 = document.getElementById("Temperature_Chart").getContext("2d");
                new Chart(ctx3, {
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
            .catch(error => console.error("Error loading Temperature chart:", error)); // ถ้ามี error แสดงข้อความนี้
    }
}

// โหลดกราฟ Food Level
function loadFoodChart() {
    if (document.getElementById("Food_Chart")) {
        fetch('Chart_FoodLevel.php') // ควรตรวจสอบชื่อไฟล์ PHP
            .then(response => response.json())
            .then(data => {
                console.log("Food Level Chart Data:", data); // แสดงข้อมูลที่ได้รับใน console
                if (!data || !data.DT_record || !data.FoodLevel) {
                    console.error("JSON ที่ได้รับไม่สมบูรณ์:", data); // ถ้าข้อมูลไม่ครบ จะพิมพ์ข้อความนี้
                    return;
                }

                const ctx3 = document.getElementById("Food_Chart").getContext("2d");
                new Chart(ctx3, {
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
            .catch(error => console.error("Error loading Food chart:", error)); // ถ้ามี error แสดงข้อความนี้
    }
}

// โหลดกราฟ Food Tray Level
function loadFoodTrayChart() {
    if (document.getElementById("FoodTray_Chart")) {
        fetch('Chart_FoodTrayLevel.php') // ควรตรวจสอบชื่อไฟล์ PHP
            .then(response => response.json())
            .then(data => {
                console.log("Food Tray Chart Data:", data); // แสดงข้อมูลที่ได้รับใน console
                if (!data || !data.DT_record || !data.FoodTray1 || !data.FoodTray2) {
                    console.error("JSON ที่ได้รับไม่สมบูรณ์:", data); // ถ้าข้อมูลไม่ครบ จะพิมพ์ข้อความนี้
                    return;
                }

                const ctx1 = document.getElementById("FoodTray_Chart").getContext("2d");
                new Chart(ctx1, {
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
            .catch(error => console.error("Error loading Food Tray chart:", error)); // ถ้ามี error แสดงข้อความนี้
    }
}

// โหลดกราฟ Food Supplement Level
function loadFoodSChart() {
    if (document.getElementById("FoodS_Chart")) {
        fetch('Chart_FoodSLevel.php') // ควรตรวจสอบชื่อไฟล์ PHP
            .then(response => response.json())
            .then(data => {
                console.log("Food Supplement Chart Data:", data); // แสดงข้อมูลที่ได้รับใน console
                if (!data || !data.DT_record || !data.FoodSLevel) {
                    console.error("JSON ที่ได้รับไม่สมบูรณ์:", data); // ถ้าข้อมูลไม่ครบ จะพิมพ์ข้อความนี้
                    return;
                }

                const ctx1 = document.getElementById("FoodS_Chart").getContext("2d");
                new Chart(ctx1, {
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
            .catch(error => console.error("Error loading Food Supplement chart:", error)); // ถ้ามี error แสดงข้อความนี้
    }
}


// โหลดกราฟ Collect Chart
function loadCollectChart() {
    if (document.getElementById("Collect_Chart")) {

        // ตรวจสอบว่ามีอินสแตนซ์ของกราฟเก่าอยู่หรือไม่ และทำลายมัน
        // นี่คือขั้นตอนสำคัญหากคุณมีการเรียกใช้ loadCollectChart ซ้ำๆ
        let existingChart = Chart.getChart("Collect_Chart");
        if (existingChart) {
            existingChart.destroy();
        }

        // ดึงข้อมูล JSON จาก PHP
        fetch('Chart_Collect.php') // ระบุ URL ที่ชี้ไปยังไฟล์ PHP ที่ส่งข้อมูล JSON
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok ' + response.statusText);
            }
            return response.json(); // แปลงผลลัพธ์เป็น JSON
        })
        .then(data => {
            const labels = data.Collect_Date; // วันที่เก็บไข่ (จะกลายเป็นแกนนอน)
            const eggAmounts = data.EggAmount; // จำนวนไข่ (จะกลายเป็นแกนตั้ง)

            // กำหนดการตั้งค่ากราฟ
            const ctx = document.getElementById('Collect_Chart').getContext('2d'); // เตรียมพื้นที่สำหรับกราฟ
            new Chart(ctx, {
                type: 'bar', // ประเภทกราฟเป็นแท่ง (แนวตั้งคือค่าเริ่มต้นของ 'bar')
                data: {
                    labels: labels, // กำหนดแกนนอนเป็นวันที่
                    datasets: [{
                        label: 'จำนวนการเก็บไข่', // ชื่อชุดข้อมูล
                        data: eggAmounts, // กำหนดแกนตั้งเป็นจำนวนไข่
                        backgroundColor: 'rgba(75, 192, 192, 0.7)', // สีแท่งกราฟแบบโปร่งแสง
                        borderColor: 'rgba(75, 192, 192, 1)', // สีขอบแท่งกราฟ
                        borderWidth: 1 // ความหนาขอบแท่งกราฟ
                    }]
                },
                options: {
                    maintainAspectRatio: false, // ไม่บังคับอัตราส่วนกราฟ
                    responsive: true, // ทำให้กราฟตอบสนองต่อขนาดหน้าจอ
                    // *** ลบ หรือ คอมเมนต์ 'indexAxis: 'y'' ออกไป เพื่อให้เป็นกราฟแนวตั้ง ***
                    // indexAxis: 'y', // ถ้าเปิดไว้ จะทำให้เป็นแนวนอน
                    plugins: {
                        legend: {
                            position: 'top' // ตำแหน่งของคำอธิบายกราฟ
                        },
                        title: {
                            display: true,
                            text: 'กราฟแสดงจำนวนการเก็บไข่ในแต่ละวัน' // ชื่อกราฟ
                        }
                    },
                    scales: {
                        x: { // ตอนนี้ x คือแกนหมวดหมู่ (วันที่)
                            beginAtZero: true, // แกน x เริ่มต้นที่ 0 (มักไม่จำเป็นสำหรับแกน labels)
                            // สามารถเพิ่ม title ได้หากต้องการให้มีชื่อแกน
                            title: {
                                display: true,
                                text: 'วันและเวลาที่เก็บไข่'
                            }
                        },
                        y: { // ตอนนี้ y คือแกนค่า (จำนวนไข่)
                            beginAtZero: true, // แกน y เริ่มต้นที่ 0
                            // สามารถเพิ่ม title ได้หากต้องการให้มีชื่อแกน
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
            // เพิ่มการแจ้งเตือนผู้ใช้หากเกิดข้อผิดพลาดในการโหลดข้อมูล
            alert('ไม่สามารถโหลดข้อมูลกราฟได้ กรุณาลองใหม่อีกครั้ง');
        });
    }
}

// โหลดกราฟ Chicken Import Level
function loadImportChart() {
    if (document.getElementById("Import_Chart")) {

        // 1. ดึงข้อมูล JSON จาก PHP
        fetch('Chart_Import.php') // ระบุ URL ที่ชี้ไปยังไฟล์ PHP ที่ส่งข้อมูล JSON
            .then(response => response.json()) // แปลงผลลัพธ์เป็น JSON
            .then(data => {
                const labels = data.Import_Date; // ดึงวันที่นำเข้ามาเป็นแกน X

                // สร้างชุดข้อมูลแยกตามสายพันธุ์
                const datasets = Object.keys(data.Import_Amount).map((breed, index) => ({
                    label: breed, // ชื่อสายพันธุ์
                    data: data.Import_Amount[breed], // จำนวนไก่ของสายพันธุ์ในแต่ละวัน
                    backgroundColor: `rgba(${50 + index * 50}, ${100 + index * 30}, ${150 + index * 20}, 0.7)`, // สีแท่งกราฟแบบโปร่งแสง
                    borderWidth: 1 // ความหนาขอบแท่งกราฟ
                }));

                // 2. กำหนดการตั้งค่ากราฟ
                const ctx = document.getElementById('Import_Chart').getContext('2d'); // เตรียมพื้นที่สำหรับกราฟ
                new Chart(ctx, {
                    type: 'bar', // ประเภทกราฟเป็นแท่ง
                    data: {
                        labels: labels, // กำหนดแกน X เป็นวันที่
                        datasets: datasets // กำหนดชุดข้อมูลในกราฟ
                    },
                    options: {
                        responsive: true, // ทำให้กราฟตอบสนองต่อขนาดหน้าจอ
                        plugins: {
                            legend: {
                                position: 'top' // ตำแหน่งของคำอธิบายกราฟ
                            },
                            title: {
                                display: true,
                            }
                        },
                        scales: {
                            x: {
                                stacked: false, // ไม่ซ้อนกันในแกน X
                            },
                            y: {
                                beginAtZero: true // แกน Y เริ่มต้นที่ 0
                            }
                            
                        }
                    }
                });
            });
    }
}

// โหลดกราฟ Chicken Import Level
function loadExportChart() {
    if (document.getElementById("Export_Chart")) {

        // 1. ดึงข้อมูล JSON จาก PHP
        fetch('Chart_Export.php') // ระบุ URL ที่ชี้ไปยังไฟล์ PHP ที่ส่งข้อมูล JSON
            .then(response => response.json()) // แปลงผลลัพธ์เป็น JSON
            .then(data => {
                const labels = data.Export_Date; // ดึงวันที่นำเข้ามาเป็นแกน X

                // สร้างชุดข้อมูลแยกตามสายพันธุ์
                const datasets = Object.keys(data.Export_Amount).map((breed, index) => ({
                    label: breed, // ชื่อสายพันธุ์
                    data: data.Export_Amount[breed], // จำนวนไก่ของสายพันธุ์ในแต่ละวัน
                    backgroundColor: `rgba(${50 + index * 50}, ${100 + index * 30}, ${150 + index * 20}, 0.7)`, // สีแท่งกราฟแบบโปร่งแสง
                    borderWidth: 1 // ความหนาขอบแท่งกราฟ
                }));

                // 2. กำหนดการตั้งค่ากราฟ
                const ctx = document.getElementById('Export_Chart').getContext('2d'); // เตรียมพื้นที่สำหรับกราฟ
                new Chart(ctx, {
                    type: 'bar', // ประเภทกราฟเป็นแท่ง
                    data: {
                        labels: labels, // กำหนดแกน X เป็นวันที่
                        datasets: datasets // กำหนดชุดข้อมูลในกราฟ
                    },
                    options: {
                        responsive: true, // ทำให้กราฟตอบสนองต่อขนาดหน้าจอ
                        plugins: {
                            legend: {
                                position: 'top' // ตำแหน่งของคำอธิบายกราฟ
                            },
                            title: {
                                display: true,
                            }
                        },
                        scales: {
                            x: {
                                stacked: false, // ไม่ซ้อนกันในแกน X
                            },
                            y: {
                                beginAtZero: true // แกน Y เริ่มต้นที่ 0
                            }
                        }
                    }
                });
            });
    }
}

// โหลดกราฟ Chicken Remain Level
function loadRemainChart() {
    if (document.getElementById("Remain_Chart")) {

        // 1. ดึงข้อมูล JSON จาก PHP
        fetch('Chart_Remain.php') // ระบุ URL ที่ชี้ไปยังไฟล์ PHP ที่ส่งข้อมูล JSON
            .then(response => response.json()) // แปลงผลลัพธ์เป็น JSON
            .then(data => {
                const labels = data.Remain_Date; // ดึงวันที่คงเหลือมาเป็นแกน X

                // สร้างชุดข้อมูลแยกตามสายพันธุ์
                const datasets = Object.keys(data.Remain_Amount).map((breed, index) => ({
                    label: breed, // ชื่อสายพันธุ์
                    data: data.Remain_Amount[breed], // จำนวนไก่คงเหลือของสายพันธุ์ในแต่ละวัน
                    backgroundColor: `rgba(${50 + index * 50}, ${100 + index * 30}, ${150 + index * 20}, 0.7)`, // สีแท่งกราฟแบบโปร่งแสง
                    borderWidth: 1 // ความหนาขอบแท่งกราฟ
                }));

                // 2. กำหนดการตั้งค่ากราฟ
                const ctx = document.getElementById('Remain_Chart').getContext('2d'); // เตรียมพื้นที่สำหรับกราฟ
                new Chart(ctx, {
                    type: 'bar', // ประเภทกราฟเป็นแท่ง
                    data: {
                        labels: labels, // กำหนดแกน X เป็นวันที่
                        datasets: datasets // กำหนดชุดข้อมูลในกราฟ
                    },
                    options: {
                        responsive: true, // ทำให้กราฟตอบสนองต่อขนาดหน้าจอ
                        plugins: {
                            legend: {
                                position: 'top' // ตำแหน่งของคำอธิบายกราฟ
                            },
                            title: {
                                display: true,
                                text: 'Chicken Remain Level' // ชื่อกราฟ
                            }
                        },
                        scales: {
                            x: {
                                stacked: false, // ไม่ซ้อนกันในแกน X
                            },
                            y: {
                                beginAtZero: true // แกน Y เริ่มต้นที่ 0
                            }
                        }
                    }
                });
            });
    }
}

// โหลดกราฟ Temperature
function loadTotalChart() {
    if (document.getElementById("Total_Chart")) {
        fetch('Chart_Total.php') // ควรตรวจสอบชื่อไฟล์ PHP
            .then(response => response.json())
            .then(data => {
                console.log("Total Chart Data:", data); // แสดงข้อมูลที่ได้รับใน console
                if (!data || !data.Total_Date || !data.Total) {
                    console.error("JSON ที่ได้รับไม่สมบูรณ์:", data); // ถ้าข้อมูลไม่ครบ จะพิมพ์ข้อความนี้
                    return;
                }

                const ctx3 = document.getElementById("Total_Chart").getContext("2d");
                new Chart(ctx3, {
                    type: 'bar', // ประเภทกราฟเป็นแท่ง
                    data: {
                        labels: data.Total_Date,
                        datasets: [{
                            label: "Total",
                            fill: true,
                            backgroundColor: "rgba(232, 211, 255, 1)",
                            borderWidth: 1 ,// ความหนาขอบแท่งกราฟ
                            data: data.Total,
                        }],
                    },
                    options: { responsive: true },
                });
            })
            .catch(error => console.error("Error loading Total chart:", error)); // ถ้ามี error แสดงข้อความนี้
    }
}

// เรียกใช้ฟังก์ชันตามความจำเป็นเมื่อหน้าโหลดเสร็จ
document.addEventListener('DOMContentLoaded', () => {
    loadTemperatureChart();
    loadFoodChart();
    loadFoodTrayChart();
    loadFoodSChart();
    loadCollectChart();
    loadImportChart();
    loadExportChart();
    loadRemainChart();
    loadTotalChart();
});
