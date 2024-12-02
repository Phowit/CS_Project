<!--zone_update.php-->
<?php
    // เชื่อมต่อกับฐานข้อมูล
    require_once("connect_db.php");

    // รับข้อมูลจากฟอร์ม
    $Breed_ID = $_POST['Breed_ID'];
    $Breed_Name = $_POST['Breed_Name'];
    $Breed_Description = $_POST['Breed_Description'];
    //$Breed_Img = $_POST['Breed_Img']; Breed_Img = '$Breed_Img'

        // เขียนคำสั่ง SQL สำหรับลบข้อมูลสมาชิก
        $sqli = "   UPDATE breed 
                    SET Breed_Name = '$Breed_Name',
                        Breed_Description = '$Breed_Description'
                    WHERE Breed_ID = '$Breed_ID'";

        // ทำการลบข้อมูล
        mysqli_query($conn,$sqli); 
?>

<meta http-equiv="refresh" content = "0; url = Admin_ManageGeneChicken.php ">