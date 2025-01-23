<?php
    // เชื่อมต่อกับฐานข้อมูล
    require_once("connect_db.php");

    // รับข้อมูลจากฟอร์ม
    $Message_ID = $_POST['Message_ID'];
    $Message_Title = $_POST['Message_Title'];
    $Message_Detail = $_POST['Message_Detail'];

    $sql = "UPDATE message SET 
            Message_Title = '$Message_Title',
            Message_Detail = '$Message_Detail'
            WHERE Message_ID = '$Message_ID';
            ";

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
    echo '<meta http-equiv="refresh" content="0; url = Admin_Message.php">';
?>
