<?php
    // เชื่อมต่อกับฐานข้อมูล
    require_once("connect_db.php");

    // รับข้อมูลจากฟอร์ม
    $TimeFood = $_POST['TimeFood'];
    $TimeFood_ID = $_POST['TimeFood_ID'];

    $sql = "UPDATE timefood SET TimeFood = '$TimeFood' WHERE TimeFood_ID = '$TimeFood_ID'";

    // ดำเนินการคำสั่ง SQL 
    if (mysqli_query($conn, $sql)) {
        //echo "Update successful!";
    } else {
        //echo "Error updating record: " . mysqli_error($conn);
    }

    //echo $sql;

    // ปิดการเชื่อมต่อ
    mysqli_close($conn);

    // เปลี่ยนหน้า
    echo '<meta http-equiv="refresh" content="0; url = Admin_ManageEnvironment.php">';
?>
