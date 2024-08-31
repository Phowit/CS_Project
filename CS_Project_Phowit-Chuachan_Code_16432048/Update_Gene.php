<!--zone_update.php-->
<?php
    // เชื่อมต่อกับฐานข้อมูล
    require_once("connect_db.php");

    // รับข้อมูลจากฟอร์ม
    $Gene_ID = $_POST['Gene_ID'];
    $Gene_Name = $_POST['Gene_Name'];
    $Description = $_POST['Description'];

        // เขียนคำสั่ง SQL สำหรับลบข้อมูลสมาชิก
        $sqli = "UPDATE gene SET Gene_Name = '$Gene_Name',Description = '$Description' WHERE Gene_ID = '$Gene_ID'";

        // ทำการลบข้อมูล
        mysqli_query($conn,$sqli); 
        echo"SQL = ".$sqli;
?>

<meta http-equiv="refresh" content = "0; url = Admin_ManageGeneChicken.php ">