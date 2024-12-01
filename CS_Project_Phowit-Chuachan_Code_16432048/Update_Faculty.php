<!--zone_update.php-->
<?php
    // เชื่อมต่อกับฐานข้อมูล
    require_once("connect_db.php");

    // รับข้อมูลจากฟอร์ม
    $Faculty_ID = $_POST['Faculty_ID'];
    $Faculty_Name = $_POST['Faculty_Name'];

        // เขียนคำสั่ง SQL สำหรับลบข้อมูลสมาชิก
        $sqli = "UPDATE faculty SET Faculty_Name = '$Faculty_Name' WHERE Faculty_ID = '$Faculty_ID'";

        // ทำการลบข้อมูล
        mysqli_query($conn,$sqli); 
?>

<meta http-equiv="refresh" content = "0; url = Admin_FacultyProgram.php ">