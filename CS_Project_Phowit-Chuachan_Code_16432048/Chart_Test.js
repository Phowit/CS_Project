
document.addEventListener('DOMContentLoaded', () => {
    const canvasElement = document.getElementById("Collect_Chart");
    console.log("Canvas Element:", canvasElement);

    if (!canvasElement) {
        console.error("ไม่พบ <canvas> ที่มี id='Collect_Chart'");
        return;
    }

    const ctx = canvasElement.getContext("2d");
    if (!ctx) {
        console.error("Canvas ไม่พร้อมใช้งาน");
        return;
    }
    console.log("Canvas พร้อมใช้งาน:", ctx);

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
    const ctx = document.getElementById('eggCollectionChart').getContext('2d'); // เตรียมพื้นที่สำหรับกราฟ
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
                    text: 'Egg Collection by Date and Breed (Grouped Bar Chart)' // ชื่อกราฟ
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
});