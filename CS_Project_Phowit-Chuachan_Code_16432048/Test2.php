<?php
// เริ่มต้น session เพื่อเก็บข้อมูลการเข้าสู่ระบบ
session_start();

// เชื่อมต่อฐานข้อมูล
require_once("../conn/conn.php");

// รับข้อมูลจากฟอร์ม ชื่อจะต่างจากในฐานเพื่อให้เห็นชัดเข้าใจง่ายและไม่ซ้ำ
$email_username_input = $_POST['email_username_input']; // ชื่อผู้ใช้ที่ส่งมาจากฟอร์ม
$password_input = $_POST['password_input']; // รหัสผ่านที่ส่งมาจากฟอร์ม

// ดึงข้อมูลผู้ใช้จากฐานข้อมูล
$sql = "SELECT `email_username`,`password` FROM tblUsers WHERE email_username = ? AND password = ?";
$stmt = $conn->prepare($sql); // เตรียมคำสั่ง SQL เพื่อป้องกัน SQL Injection
$stmt->bind_param("ss", $email_username_input, $password_input); // ผูกค่าพารามิเตอร์
$stmt->execute(); // รันคำสั่ง
$result = $stmt->get_result(); // รับผลลัพธ์จากฐานข้อมูล

if ($result->num_rows === 1) {
    // รหัสผ่านถูกต้อง
    $_SESSION['email_username'] = $row['email_username']; // เก็บข้อมูลใน session

    //header("Location: dashboard.php"); // หน้าสำหรับ Admin

    exit();
} else {
    //echo '<meta http-equiv="refresh" content="0; url= login.php">'; 
}
while ($row = $result->fetch_assoc()) {
    $email_username = $row['email_username'];
    $password = $row['password'];
}

    echo "นี่คือค่า email_username_input จากฟอร์ม = ". $email_username_input . "<br>";
    echo "นี่คือค่า password_input จากฟอร์ม = " . $password_input . "<br><br>";

    echo "นี่คือค่า email_username จากฐาน = ". $email_username_input . "<br>";
    echo "นี่คือค่า password จากฐาน = " . $password . "<br>";