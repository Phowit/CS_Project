<?php
header('Content-Type: application/json');

// เชื่อมต่อฐานข้อมูล
require_once("connect_db.php");

$sql = "SELECT Collect_Date, EggAmount FROM collect ORDER BY Collect_Date ASC";

$result = $conn->query($sql);

$Collect_Date = [];
$EggAmount = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $Collect_Date[] = $row['Collect_Date'];
        $EggAmount[] = (int)$row['EggAmount'];
    }
}

echo json_encode(['Collect_Date' => $Collect_Date, 'EggAmount' => $EggAmount]);

$conn->close();
?>