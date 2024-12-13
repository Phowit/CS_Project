<?php
    // เชื่อมต่อกับฐานข้อมูล
    require_once("connect_db.php");

    // รับข้อมูลจากฟอร์ม
    $Breed_ID = $_POST['Breed_ID'];
    $Breed_Name = $_POST['Breed_Name'];
    $Breed_Description = $_POST['Breed_Description'];

    // ตรวจสอบว่ามีการอัปโหลดไฟล์หรือไม่
    if (!empty($_FILES['Breed_Img']['tmp_name'])) {
        $Breed_Img = file_get_contents($_FILES['Breed_Img']['tmp_name']);
        $Breed_Img = mysqli_real_escape_string($conn, $Breed_Img);

        $sql = "UPDATE breed 
                SET Breed_Name = '$Breed_Name', 
                    Breed_Description = '$Breed_Description', 
                    Breed_Img = '$Breed_Img' 
                WHERE Breed_ID = '$Breed_ID'";
    } else {
        $sql = "UPDATE breed 
                SET Breed_Name = '$Breed_Name', 
                    Breed_Description = '$Breed_Description' 
                WHERE Breed_ID = '$Breed_ID'";
    }

    // ดำเนินการคำสั่ง SQL
    
    if (mysqli_query($conn, $sql)) {
        //echo "Update successful!";
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }

    // ปิดการเชื่อมต่อ
    mysqli_close($conn);

    // เปลี่ยนหน้า
    echo '<meta http-equiv="refresh" content="0; url=Admin_ManageBreedChicken.php">';
?>
