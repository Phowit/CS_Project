<?php
// เริ่มต้น session เพื่อเก็บข้อมูลการเข้าสู่ระบบ
session_start();

// เชื่อมต่อฐานข้อมูล
require_once("connect_db.php");

// รับข้อมูลจากฟอร์ม
$Admin_ID_Input = $_POST['Admin_ID_Input']; // ชื่อผู้ใช้ที่ส่งมาจากฟอร์ม
$Admin_Password_Input = $_POST['Admin_Password_Input']; // รหัสผ่านที่ส่งมาจากฟอร์ม

// ดึงข้อมูลผู้ใช้จากฐานข้อมูล
$sql = "SELECT `Admin_ID`,`Admin_Password` FROM admin WHERE Admin_ID = ?";
$stmt = $conn->prepare($sql); // เตรียมคำสั่ง SQL เพื่อป้องกัน SQL Injection
$stmt->bind_param("s", $Admin_ID_Input); // ผูกค่าพารามิเตอร์
$stmt->execute(); // รันคำสั่ง
$result = $stmt->get_result(); // รับผลลัพธ์จากฐานข้อมูล

if ($result->num_rows === 1) {
    $Admin_Data = $result->fetch_assoc();

    // เปรียบเทียบรหัสผ่าน
    if ($Admin_Password_Input == $Admin_Data['Admin_Password']) { // เปรียบเทียบแบบข้อความธรรมดา

        // รหัสผ่านถูกต้อง
        $_SESSION['Admin_ID'] = $Admin_Data['Admin_ID']; // เก็บข้อมูลใน session
        header("Location: Admin_Index.php"); // ย้ายไปหน้า Admin_Index.php
        exit();
    } else {
        echo "รหัสผ่านไม่ถูกต้อง! <br>";
        echo $Admin_Password_Input , '<br>';
        echo $Admin_ID_Input , '<br>';
        echo "-------------- <br>";
        echo $Admin_Data['Admin_Password'] , '<br>';
        echo $Admin_Data['Admin_ID'];
    }
} else {
    echo "ไม่พบผู้ใช้งาน!";
}

?>
