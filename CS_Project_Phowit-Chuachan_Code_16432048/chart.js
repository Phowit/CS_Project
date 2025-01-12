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


// โหลดกราฟ Food Supplement Level
function loadCollectChart() {
    if (document.getElementById("Collect_Chart")) {

    // 1. ดึงข้อมูล JSON จาก PHP
    fetch('Chart_Collect.php') // ระบุ URL ที่ชี้ไปยังไฟล์ PHP ที่ส่งข้อมูล JSON
    .then(response => response.json()) // แปลงผลลัพธ์เป็น JSON
    .then(data => {
        const labels = data.Collect_Date; // ดึงวันที่เก็บไข่มาเป็นแกน X

        // สร้างชุดข้อมูลแยกตามสายพันธุ์
        const datasets = Object.keys(data.EggAmount).map((breed, index) => ({
            label: breed, // ชื่อสายพันธุ์
            data: data.EggAmount[breed], // จำนวนไข่ของสายพันธุ์ในแต่ละวัน
            backgroundColor: `rgba(${50 + index * 50}, ${100 + index * 30}, ${150 + index * 20}, 0.7)`, // สีแท่งกราฟแบบโปร่งแสง
            borderWidth: 1 // ความหนาขอบแท่งกราฟ
        }));

        // 2. กำหนดการตั้งค่ากราฟ
        const ctx = document.getElementById('Collect_Chart').getContext('2d'); // เตรียมพื้นที่สำหรับกราฟ
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
    })
}};

// เรียกใช้ฟังก์ชันตามความจำเป็นเมื่อหน้าโหลดเสร็จ
document.addEventListener('DOMContentLoaded', () => {
    loadTemperatureChart();
    loadFoodChart();
    loadFoodTrayChart();
    loadFoodSChart();
    loadCollectChart();
});
