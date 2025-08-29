<?php

require_once("connect_db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" ) {

$Delete_User_ID = $_POST['Delete_User_ID'];
$Delete_User_Password = $_POST['Delete_User_Password'];

    if ($Delete_User_ID > 0 AND $Delete_User_Password > 0) {

        // เริ่ม ตรวจสอบรหัสผ่าน ------------------
        $Check_User_Password = " SELECT `User_ID`,`User_Password` FROM `user` WHERE `User_ID` = $Delete_User_ID ";

        $Check_User_Result = mysqli_query($conn,$Check_User_Password);

        while ($row = $Check_User_Result->fetch_assoc()) {
            $User_Password = $row['User_Password'];
        }

        if ($Delete_User_Password === $User_Password) {

            $Delete_User_SQL = " UPDATE `user` SET `User_Delete`='1' WHERE `User_ID` = $Delete_User_ID ";

            if ( mysqli_query($conn,$Delete_User_SQL) ) {

            session_start(); // เริ่มต้น session
            session_unset(); // ลบตัวแปรทั้งหมดใน session
            session_destroy(); // ทำลาย session ทั้งหมด

            // ส่งผู้ใช้กลับไปยังหน้าล็อกอินหรือหน้าแรก
            header("Location: Index.php");
            exit();

            }
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
            echo '<meta http-equiv="refresh" content="3; url = User_Data.php">';
        }
        // จบ ตรวจสอบรหัสผ่าน ------------------

    }
}

?>
<div id="errorModal" style="display:none; position:fixed; top:30%; left:50%; transform:translate(-50%, -50%);
                             background-color:white; padding:20px; border:1px solid #ccc; z-index:1000; box-shadow: 0 0 10px rgba(0,0,0,0.5);">
    <p style="color:red;">❌ รหัสผ่านไม่ถูกต้อง</p>
    <p>โปรดลองใหม่อีกครั้ง</p>
</div>