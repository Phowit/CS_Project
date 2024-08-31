<?php
    require_once("connect_db.php");

    //เลือกเฉพาะชุดข้อมูลล่าสุด โดยตรวจสอบจาก DT_record
    $sql = "SELECT FoodLevel, FoodSLevel, FoodTrayLevel1, FoodTrayLevel2, T_Level FROM status ORDER BY  DT_record DESC LIMIT 1";

    $result = mysqli_query($conn, $sql);
    $progressData = [];

    // ส่งข้อมูลกลับในรูปแบบ JSON
    echo json_encode($progressData);
    
?>