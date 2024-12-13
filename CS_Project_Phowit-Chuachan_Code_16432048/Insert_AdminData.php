<?php
   // ตรวจสอบว่ามีการส่งข้อมูลมาจากฟอร์มหรือไม่
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // เชื่อมต่อฐานข้อมูล
    require_once("connect_db.php");

    // รับข้อมูลจากฟอร์ม
    $User_Name = $_POST['User_Name'];
    $User_Password = $_POST['User_Password'];
    $User_Tel = $_POST['User_Tel'];
    $User_Address = $_POST['User_Address'];
    $User_Email = $_POST['User_Email'];
    $Program = $_POST['Program'];
    $User_Status = 'Admin'; // กำหนดค่าเริ่มต้นให้กับ User_Status

    // ตรวจสอบว่ามีการอัปโหลดไฟล์หรือไม่
    if (!empty($_FILES['User_Image']['tmp_name'])) {
        $User_Image = file_get_contents($_FILES['User_Image']['tmp_name']);
    } else {
        // ใช้รูปภาพเริ่มต้นหากไม่มีการอัปโหลด
        $User_Image = file_get_contents('img/User_Default.png');
    }

    // ใช้ Prepared Statement เพื่อบันทึกข้อมูลลงฐานข้อมูล
    $stmt = $conn->prepare(
        "INSERT INTO User (
            User_Name,
            User_Password,
            User_Tel,
            User_Address,
            User_Email,
            Program,
            User_Image,
            User_Status
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?)"
    );

    $stmt->bind_param(
        "ssssssss",
        $User_Name,
        $User_Password,
        $User_Tel,
        $User_Address,
        $User_Email,
        $Program,
        $User_Image,
        $User_Status
    );

    // ดำเนินการคำสั่ง
    if ($stmt->execute()) {
        echo "Record added successfully!";
    } else {
        echo "Error adding record: " . $stmt->error;
    }

    // ปิดการเชื่อมต่อ
    $stmt->close();
    $conn->close();

    // เปลี่ยนหน้า
    echo '<meta http-equiv="refresh" content="0; url=Admin_ManageData.php">';
}


?>