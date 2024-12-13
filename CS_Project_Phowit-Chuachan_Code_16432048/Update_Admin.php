<?php
    // เชื่อมต่อกับฐานข้อมูล
    require_once("connect_db.php");

    // รับข้อมูลจากฟอร์ม
    $User_ID = $_POST['User_ID'];
    $User_Name = $_POST['User_Name'];
    $User_Tel = $_POST['User_Tel'];
    $User_Address = $_POST['User_Address'];
    $User_Email = $_POST['User_Email'];
    $Program = $_POST['Program'];

    // ตรวจสอบว่ามีการอัปโหลดไฟล์หรือไม่
    if (!empty($_FILES['User_Image']['tmp_name'])) {
        $User_Image = file_get_contents($_FILES['User_Image']['tmp_name']);
        $User_Image = mysqli_real_escape_string($conn, $User_Image);

        $sql = "UPDATE user 
                SET User_Name = '$User_Name',
                    User_Tel = '$User_Tel',
                    User_Address = '$User_Address',
                    User_Email = '$User_Email',
                    Program = '$Program',
                    User_Image = '$User_Image'
                WHERE User_ID = '$User_ID'";
    } else {
        $sql = "UPDATE user 
                SET User_Name = '$User_Name',
                    User_Tel = '$User_Tel',
                    User_Address = '$User_Address',
                    User_Email = '$User_Email',
                    Program = '$Program'
                WHERE User_ID = '$User_ID'";
    }

    // ดำเนินการคำสั่ง SQL
    if (mysqli_query($conn, $sql)) {
        //echo "Update successful!";
    } else {
        //echo "Error updating record: " . mysqli_error($conn);
    }

    // ปิดการเชื่อมต่อ
    mysqli_close($conn);

    // เปลี่ยนหน้า
    echo '<meta http-equiv="refresh" content="0; url=Admin_ManageData.php">';
?>
