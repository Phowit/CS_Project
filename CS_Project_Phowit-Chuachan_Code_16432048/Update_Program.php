<!--zone_update.php-->
<?php
    // เชื่อมต่อกับฐานข้อมูล
    require_once("connect_db.php");

    // รับข้อมูลจากฟอร์ม
    $Program_ID = $_POST['Program_ID'];
    $Program_Name = $_POST['Program_Name'];

        // เขียนคำสั่ง SQL สำหรับลบข้อมูลสมาชิก
        $sqli = "UPDATE program SET Program_Name = '$Program_Name' WHERE Program_ID = '$Program_ID'";

        // ทำการลบข้อมูล
        mysqli_query($conn,$sqli); 
?>

<meta http-equiv="refresh" content = "0; url = Admin_FacultyProgram.php ">