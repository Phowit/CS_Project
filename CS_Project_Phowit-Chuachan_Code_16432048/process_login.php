<?php
// เริ่มต้น session เพื่อเก็บข้อมูลการเข้าสู่ระบบ
session_start();

// เชื่อมต่อฐานข้อมูล
require_once("connect_db.php");

// รับข้อมูลจากฟอร์ม
$User_Name_Input = $_POST['User_Name_Input']; // ชื่อผู้ใช้ที่ส่งมาจากฟอร์ม
$User_Password_Input = $_POST['User_Password_Input']; // รหัสผ่านที่ส่งมาจากฟอร์ม

// ดึงข้อมูลผู้ใช้จากฐานข้อมูล
$sql = "SELECT `User_ID`,`User_Password`,`User_Status`,`User_Name` FROM user WHERE User_Name = ? AND User_Password = ?";
$stmt = $conn->prepare($sql); // เตรียมคำสั่ง SQL เพื่อป้องกัน SQL Injection
$stmt->bind_param("ss", $User_Name_Input, $User_Password_Input); // ผูกค่าพารามิเตอร์
$stmt->execute(); // รันคำสั่ง
$result = $stmt->get_result(); // รับผลลัพธ์จากฐานข้อมูล

if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();

    // รหัสผ่านถูกต้อง
    $_SESSION['User_ID'] = $row['User_ID']; // เก็บข้อมูลใน session
    $User_Status = $row['User_Status'];

    // เปลี่ยนเส้นทางตามสถานะ
    if ($User_Status === 'Admin') {
        header("Location: Admin_Index.php"); // หน้าสำหรับ Admin
    } else {
        header("Location: User_Index.php"); // หน้าสำหรับ User ทั่วไป
    }
    exit();
} else {
    echo '<meta http-equiv="refresh" content="0; url= Index.php">';
}
