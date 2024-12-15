<?php
    // เชื่อมต่อกับฐานข้อมูล
    require_once("connect_db.php");

    // รับข้อมูลจากฟอร์ม
    $Import_ID = $_POST['Import_ID'];
    $Import_Date = $_POST['Import_Date'];
    $Breed_ID = $_POST['Breed_ID'];
    $Import_Amount = $_POST['Import_Amount'];
    $Import_Details = $_POST['Import_Details'];

    $sql = "UPDATE import SET 
            Import_Date = '$Import_Date',
            Breed_ID = '$Breed_ID',
            Import_Amount = '$Import_Amount',
            Import_Details = '$Import_Details'
            WHERE Import_ID = '$Import_ID'
            ";

    // ดำเนินการคำสั่ง SQL
    if (mysqli_query($conn, $sql)) {
        echo "Update successful!";
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }

    echo $sql;

    // ปิดการเชื่อมต่อ
    mysqli_close($conn);

    // เปลี่ยนหน้า
    echo '<meta http-equiv="refresh" content="0; url=Admin_ManageChicken.php">';
?>
