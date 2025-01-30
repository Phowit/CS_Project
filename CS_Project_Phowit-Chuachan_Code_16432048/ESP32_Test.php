<?php
if (isset($_GET['data'])) { // รับค่าที่ส่งมาด้วย method GET
    $data = $_GET['data']; // รับค่าพารามิเตอร์ชื่อ 'data'
    echo "Received data: " . $data; // แสดงข้อมูลที่ได้รับ
} else {
    echo "No data received"; // หากไม่มีข้อมูลที่ส่งมา
}
?>
