<?php
require_once("connect_db.php");

// รับค่าจาก URL
if (isset($_GET['pack'])) {
    // Status ID ล่าสุดของ status
    $SQL_Status_ID = "SELECT `status_ID` FROM `status` ORDER BY `status_ID` DESC LIMIT 1";
    $Result_Status_ID = $conn->query($DateControl_ID);
    while ($row = $ResultStatus_ID->fetch_assoc()) {    $Last_Status_ID = $row["status_ID"];    }

    // Status ID ล่าสุดของ LevelFoodTray_ID
    $SQL_LFT_SID = "SELECT `status_ID` FROM `levelfoodtray` ORDER BY `LevelFoodTray_ID` DESC LIMIT 1";
    $Result_LFT_SID = $conn->query($SQL_LFT_SID);
    while ($row = $Result_LFT_SID->fetch_assoc()) {    $Last_LFT_SID = $row["status_ID"];    }

    if($Last_LFT_SID <= $Last_Status_ID) {
        $Real_Status_ID = $Last_Status_ID;
    } else {
        $Real_Status_ID = $Last_LFT_SID;
    }

    $pack = $_GET['pack']; // ตัวอย่าง "25.3;12;15;9;1;0"
    $values = explode(";", $pack);

    $FTL1 = $values[0];
    $FTL2 = $values[1];

    if ($FTL1 < 4) {
        $LevelFoodTray_1 = 3;
    } elseif ($FTL1 < 8) {
        $LevelFoodTray_1 = 2;
    } elseif ($FTL1 < 12) {
        $LevelFoodTray_1 = 1;
    } else {
        $LevelFoodTray_1 = 0;
    }

    if ($FTL2 < 4) {
        $LevelFoodTray_2 = 3;
    } elseif ($FTL2 < 8) {
        $LevelFoodTray_2 = 2;
    } elseif ($FTL2 < 12) {
        $LevelFoodTray_2 = 1;
    } else {
        $LevelFoodTray_2 = 0;
    }

    $Insert_Status = "  INSERT INTO `levelfoodtray`(`LevelFoodTray_1`, `LevelFoodTray_2`, `status_ID`) 
                        VALUES ('$LevelFoodTray_1','$LevelFoodTray_2','$Real_Status_ID')";

    mysqli_query($conn, $Insert_Status);
} else {
    echo "No data";
}

// ปิดการเชื่อมต่อ
$conn->close();
?>