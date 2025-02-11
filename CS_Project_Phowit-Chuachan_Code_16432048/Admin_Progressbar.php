<?php

require_once("connect_db.php"); // เรียกใช้ไฟล์สำหรับเชื่อมต่อฐานข้อมูล

$sql_FoodLevel = "SELECT `FoodLevel` FROM `status` ORDER BY `DT_record` DESC LIMIT 1"; // คำสั่ง SQL เพื่อดึงข้อมูลล่าสุดจากฐานข้อมูล

$result_FoodLevel = mysqli_query($conn, $sql_FoodLevel); // ส่งคำสั่ง SQL ไปยังฐานข้อมูลและเก็บผลลัพธ์

if ($result_FoodLevel->num_rows > 0) { // ตรวจสอบว่ามีผลลัพธ์หรือไม่
    $row = $result->fetch_assoc(); // ดึงข้อมูลจากผลลัพธ์ในรูปแบบ Associative Array
    $Progress_Food = $row['FoodLevel']; // ดึงค่าความสูง Progress Bar จากฐานข้อมูล
} else {
    $Progress_Food = 0; // หากไม่มีข้อมูลในฐานข้อมูล ให้ตั้งค่าความสูงเป็น 0%
}

echo $Progress_Food; // ส่งค่าความสูง Progress Bar กลับไปยัง JavaScript

$conn->close(); // ปิดการเชื่อมต่อฐานข้อมูล
?>
