<?php
require_once("connect_db.php");

// รับค่าจาก URL
if (isset($_GET['pack'])) {
    $pack = $_GET['pack']; // ตัวอย่าง "25.3;12;15;9;1;0"
    $values = explode(";", $pack);

    $temperature = $values[0];
    $s1 = $values[1];
    $s2 = $values[2];
    $s3 = $values[3];
    $w1 = $values[4];
    $w2 = $values[5];

    if ($w1 == 1 && $w2 == 1) {
        $FoodSLevel = 2;
    } elseif ($w1 == 1 && $w2 == 0) {
        $FoodSLevel = 1;
    } else {
        $FoodSLevel = 0;
    }

    $Insert_Status = "  INSERT INTO `status`(`FoodLevel`, `FoodSLevel`, `T_Level`, `FoodTray1`, `FoodTray2`) 
                        VALUES ('$s1','$FoodSLevel','$temperature','$s2','$s3')";

    mysqli_query($conn, $Insert_Status);
} else {
    echo "No data";
}

// ปิดการเชื่อมต่อ
$conn->close();
?>