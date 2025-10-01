<?php
header('Content-Type: application/json');

// เชื่อมต่อฐานข้อมูล
require_once("connect_db.php");

// ดึงข้อมูลโดยแยก HOUR และ MINUTE ออกมา
$sql = "SELECT HOUR(`TimeFood`) AS h, MINUTE(`TimeFood`) AS m 
        FROM timefood;
        ";
$result = $conn->query($sql);

$result = $conn->query("SELECT `TimeFood` FROM `timefood`; ");

$schedule = [];
while ($row = $result->fetch_assoc()) {
    list($h, $m, $s) = explode(":", $row["TimeFood"]);
    $schedule[] = ["h" => (int)$h, "m" => (int)$m];
}

header('Content-Type: application/json');
echo json_encode($schedule);
?>