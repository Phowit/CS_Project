<?php
header('Content-Type: application/json');

// เชื่อมต่อฐานข้อมูล
require_once("connect_db.php");

$sql = "SELECT DT_record, FoodSLevel FROM status ORDER BY DT_record ASC"; // เปลี่ยนชื่อตารางของคุณ

$result = $conn->query($sql);

$DT_record = [];
$FoodSLevel = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $DT_record[] = $row['DT_record'];
        $FoodSLevel[] = (float)$row['FoodSLevel'];
    }
}

echo json_encode(['DT_record' => $DT_record, 'FoodSLevel' => $FoodSLevel]);

$conn->close();
?>