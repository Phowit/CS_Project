<?php
header('Content-Type: application/json');

// เชื่อมต่อฐานข้อมูล
require_once("connect_db.php");

$sql = "SELECT DT_record, FoodLevel FROM status ORDER BY DT_record ASC"; // เปลี่ยนชื่อตารางของคุณ

$result = $conn->query($sql);

$DT_record = [];
$FoodLevel = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $DT_record[] = $row['DT_record'];
        $FoodLevel[] = (float)$row['FoodLevel'];
    }
}

echo json_encode(['DT_record' => $DT_record, 'FoodLevel' => $FoodLevel]);

$conn->close();
?>