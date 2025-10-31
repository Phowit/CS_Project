<?php
require_once("connect_db.php");

// รับค่าจาก URL
if (isset($_GET['pack'])) {

    $SQL_DateControl_ID = "SELECT `DateControl_ID` FROM `datacontrol` ORDER BY DateControl_ID DESC LIMIT 1";

    $result = $conn->query($DateControl_ID);

    while ($row = $result->fetch_assoc()) {
        $Last_DateControl_ID = $row["DateControl_ID"];
    }

    $pack = $_GET['pack']; // ตัวอย่าง "25.3;12;15;9;1;0"
    $values = explode(";", $pack);

    $temp = $values[0];
    $food = $values[1];
    $water_h = $values[2];
    $water_l = $values[3];

    if ($water_h == 1 && $water_l == 1) {
        $FoodSLevel = 2;
    } elseif ($water_h == 0 && $water_l == 1) {
        $FoodSLevel = 1;
    } else {
        $FoodSLevel = 0;
    }

    $Insert_Status = "  INSERT INTO `status`(`FoodLevel`, `FoodSLevel`, `T_Level`, `DateControl_ID`) 
                        VALUES ('$food','$FoodSLevel','$temp','$Last_DateControl_ID')";

    mysqli_query($conn, $Insert_Status);
} else {
    echo "No data";
}

// ปิดการเชื่อมต่อ
$conn->close();
?>