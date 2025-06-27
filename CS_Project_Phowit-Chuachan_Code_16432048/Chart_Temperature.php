<?php

// Temperature_chart.php

require_once("connect_db.php");

// 1. รับค่าวันที่จาก GET parameter
// ถ้ามีค่า 'date' ใน URL ให้ใช้ค่านั้น ถ้าไม่มี ให้ใช้เป็นวันที่ปัจจุบันของระบบ
$selectedDate = isset($_GET['date']) ? $_GET['date'] : date('Y-m-d');

// (ไม่บังคับแต่แนะนำ) ตรวจสอบความถูกต้องของวันที่
// ตรวจสอบว่ารูปแบบวันที่เป็น-MM-DD
if (!preg_match("/^\d{4}-\d{2}-\d{2}$/", $selectedDate)) {
    // หากวันที่ที่ส่งมาไม่ถูกต้อง ให้ใช้เป็นวันที่ปัจจุบันแทน เพื่อป้องกัน SQL Injection หรือ Error
    $selectedDate = date('Y-m-d');
}

// 2. สร้าง SQL query โดยใช้เงื่อนไข WHERE DATE(DT_record) = 'selectedDate'
// ลบ LIMIT 5 ออก เพื่อดึงข้อมูลทั้งหมดของวันที่เลือก
// เปลี่ยน ORDER BY เป็น ASC เพื่อให้ข้อมูลเรียงตามเวลาจากเช้าไปดึกในกราฟ
$sql_T_Level = "SELECT T_Level, DT_record 
                FROM status 
                WHERE DATE(DT_record) = '$selectedDate' 
                ORDER BY DT_record ASC"; 

$result_T_Level = $conn->query($sql_T_Level);

$data = ["T_Level" => [], "DT_record" => []];
while ($row = $result_T_Level->fetch_assoc()) {
    $data["T_Level"][] = $row["T_Level"];
    // จัดรูปแบบ DT_record ให้แสดงเฉพาะเวลา (HH:MM:SS) 
    // เนื่องจากกราฟจะแสดงข้อมูลของวันเดียวกันอยู่แล้ว
    $data["DT_record"][] = date_create_from_format("Y-m-d H:i:s", $row["DT_record"])->format("H:i:s");
}

echo json_encode($data);

// ปิดการเชื่อมต่อฐานข้อมูล
$conn->close();

?>