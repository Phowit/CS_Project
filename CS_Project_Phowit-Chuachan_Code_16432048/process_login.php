<?php
// เริ่มต้น session เพื่อเก็บข้อมูลการเข้าสู่ระบบ
session_start();

// เชื่อมต่อฐานข้อมูล
require_once("connect_db.php");

// รับข้อมูลจากฟอร์ม
$User_Name_Input = $_POST['User_Name_Input']; // ชื่อผู้ใช้ที่ส่งมาจากฟอร์ม
$User_Password_Input = $_POST['User_Password_Input']; // รหัสผ่านที่ส่งมาจากฟอร์ม

// ดึงข้อมูลผู้ใช้จากฐานข้อมูล
$sql =  "   SELECT `User_ID`,`User_Password`,`User_Status`,`User_Name`,`User_Delete` 
            FROM user WHERE `User_Name` = ? AND `User_Password` = ?
        ";
$stmt = $conn->prepare($sql); // เตรียมคำสั่ง SQL เพื่อป้องกัน SQL Injection
$stmt->bind_param("ss", $User_Name_Input, $User_Password_Input); // ผูกค่าพารามิเตอร์
$stmt->execute(); // รันคำสั่ง
$result = $stmt->get_result(); // รับผลลัพธ์จากฐานข้อมูล

if ($result->num_rows === 1) {

    $row = $result->fetch_assoc();
    
    $User_Delete = $row['User_Delete'];

    if($User_Delete === 0) {
        // รหัสผ่านถูกต้อง และยังไม่ถูกลบข้อมูล
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
        echo"
            <script>
            document.addEventListener('DOMContentLoaded', function() {
                let modal = document.getElementById('errorModal');
                modal.style.display = 'block';
            });
            </script>
            ";
                
            // ปิดการเชื่อมต่อ
            mysqli_close($conn);

            // เปลี่ยนหน้า
            echo '<meta http-equiv="refresh" content="3; url = Index.php">';
    }
    
} else {
        
    echo"
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            let modal = document.getElementById('errorModal0');
            modal.style.display = 'block';
        });
        </script>
        ";

    echo '<meta http-equiv="refresh" content="2; url= Index.php">';
}
?>
<div id="errorModal" style="display:none; position:fixed; top:30%; left:50%; transform:translate(-50%, -50%);
                             background-color:white; padding:20px; border:1px solid #ccc; z-index:1000; box-shadow: 0 0 10px rgba(0,0,0,0.5);">
    <p style="color:red;">❌ ข้อมูลผู้ใช้ของคุณถูกลบ </p>
    <p>ไม่สามารถเข้าสู่ระบบได้</p>
</div>

<div id="errorModal0" style="display:none; position:fixed; top:30%; left:50%; transform:translate(-50%, -50%);
                             background-color:white; padding:20px; border:1px solid #ccc; z-index:1000; box-shadow: 0 0 10px rgba(0,0,0,0.5);">
    <p style="color:red;">❌ รหัสผ่านไม่ถูกต้อง</p>
    <p>โปรดลองใหม่อีกครั้ง</p>
</div>