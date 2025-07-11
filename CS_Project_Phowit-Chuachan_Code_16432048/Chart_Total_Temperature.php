<?php
header('Content-Type: application/json');

// เชื่อมต่อฐานข้อมูล
require_once("connect_db.php");

// SQL query เพื่อดึงข้อมูลอุณหภูมิทั้งหมด
$sql = "SELECT DT_record, T_Level FROM status ORDER BY DT_record ASC";

$result = $conn->query($sql);

$DT_record = [];
$T_Level = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $DT_record[] = $row['DT_record'];
        $T_Level[] = (float)$row['T_Level']; // ตรวจสอบให้แน่ใจว่าเป็นตัวเลข
    }
}

echo json_encode(['DT_record' => $DT_record, 'T_Level' => $T_Level]);

$conn->close();
?>