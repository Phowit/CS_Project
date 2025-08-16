<?php
    // เชื่อมต่อกับฐานข้อมูล
    require_once("connect_db.php");

    // รับข้อมูลจากฟอร์ม 
    $TimeWater_ID = $_POST['TimeWater_ID'];
    $TimeWater = $_POST['TimeWater'];

    $sql = "UPDATE `timewater` SET `TimeWater`='$TimeWater' WHERE `TimeWater_ID` = $TimeWater_ID";

    // ดำเนินการคำสั่ง SQL
    if (mysqli_query($conn, $sql)) {
        //echo "Update successful!";
    } else {
        //echo "Error updating record: " . mysqli_error($conn);
    }

    // ปิดการเชื่อมต่อ
    mysqli_close($conn);

    // เปลี่ยนหน้า
    echo '<meta http-equiv="refresh" content="0; url = Admin_ManageEnvironment.php">';
?>
