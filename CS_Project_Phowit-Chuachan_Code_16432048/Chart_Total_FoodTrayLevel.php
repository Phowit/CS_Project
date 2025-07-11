<?php
header('Content-Type: application/json');

// เชื่อมต่อฐานข้อมูล
require_once("connect_db.php");

$sql = "SELECT DT_record, FoodTray1, FoodTray2 FROM status ORDER BY DT_record ASC";

$result = $conn->query($sql);

$DT_record = [];
$FoodTray1 = [];
$FoodTray2 = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $DT_record[] = $row['DT_record'];
        $FoodTray1[] = (float)$row['FoodTray1'];
        $FoodTray2[] = (float)$row['FoodTray2'];
    }
}

echo json_encode(['DT_record' => $DT_record, 'FoodTray1' => $FoodTray1, 'FoodTray2' => $FoodTray2]);

$conn->close();
?>