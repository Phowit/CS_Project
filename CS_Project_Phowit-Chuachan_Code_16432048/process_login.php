<?php
    // เริ่มต้น session เพื่อเก็บข้อมูลการเข้าสู่ระบบ
    session_start();

    // เชื่อมต่อฐานข้อมูล
    require_once("connect_db.php");

    // รับข้อมูลจากฟอร์ม
    $User_ID_Input = $_POST['User_ID_Input']; // ชื่อผู้ใช้ที่ส่งมาจากฟอร์ม
    $User_Password_Input = $_POST['User_Password_Input']; // รหัสผ่านที่ส่งมาจากฟอร์ม

    // ดึงข้อมูลผู้ใช้จากฐานข้อมูล
    $sql = "SELECT `User_ID`,`User_Password` FROM user WHERE User_ID = ?";
    $stmt = $conn->prepare($sql); // เตรียมคำสั่ง SQL เพื่อป้องกัน SQL Injection
    $stmt->bind_param("s", $User_ID_Input); // ผูกค่าพารามิเตอร์
    $stmt->execute(); // รันคำสั่ง
    $result = $stmt->get_result(); // รับผลลัพธ์จากฐานข้อมูล

    if ($result->num_rows === 1) {
        $User_Data = $result->fetch_assoc();

        // เปรียบเทียบรหัสผ่าน
        if ($User_Password_Input == $User_Data['User_Password']) { // เปรียบเทียบแบบข้อความธรรมดา

            // รหัสผ่านถูกต้อง
            $_SESSION['User_ID'] = $User_Data['User_ID']; // เก็บข้อมูลใน session
            $User_Status = $row['User_Status'];

            // เปลี่ยนเส้นทางตามสถานะ
            if ($User_Status === 'Admin') {
                header("Location: Admin_Index.php"); // หน้าสำหรับ Admin
            } elseif ($User_Status === 'Staff') {
                header("Location: Staff_Index.php"); // หน้าสำหรับ Staff
            } else {
                header("Location: User_Index.php"); // หน้าสำหรับ User ทั่วไป
            }
            exit();

        } else {
            echo "รหัสผ่านไม่ถูกต้อง! <br>";
            echo $User_Password_Input , '<br>';
            echo $User_ID_Input , '<br>';
            echo "-------------- <br>";
            echo $User_Data['User_Password'] , '<br>';
            echo $User_Data['User_ID'];
        }
    } else {
        echo "ไม่พบผู้ใช้งาน!";
    }

?>
