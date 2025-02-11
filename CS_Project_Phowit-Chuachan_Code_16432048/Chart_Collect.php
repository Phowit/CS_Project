<?php
require_once("connect_db.php"); // เชื่อมต่อฐานข้อมูล

// ดึงข้อมูลวันที่เก็บไข่และจำนวนไข่จากฐานข้อมูล
$sql_collect = "SELECT 
        Collect_Date, 
        SUM(EggAmount) AS EggAmount 
        FROM collect 
        GROUP BY Collect_Date 
        ORDER BY Collect_Date DESC"; // คิวรีข้อมูลจากตาราง collect
$result_collect = $conn->query($sql_collect); // รันคิวรีและเก็บผลลัพธ์

$data = [
    "Collect_Date" => [], // เก็บรายการวันที่
    "EggAmount" => []    // เก็บจำนวนไข่
];

// จัดรูปแบบข้อมูล
while ($row = $result_collect->fetch_assoc()) { // วนลูปดึงข้อมูลแต่ละแถวจากผลลัพธ์คิวรี
    $date = date_create_from_format("Y-m-d H:i:s", $row["Collect_Date"])->format("d/m/Y"); // แปลงวันที่เป็นรูปแบบ d/m/Y
    $data["Collect_Date"][] = $date; // เก็บวันที่ในรูปแบบใหม่
    $data["EggAmount"][] = (int)$row["EggAmount"]; // เก็บจำนวนไข่
}

// ส่งข้อมูลเป็น JSON รองรับภาษาไทย
header('Content-Type: application/json; charset=utf-8'); // กำหนด header สำหรับ JSON ภาษาไทย
echo json_encode($data, JSON_UNESCAPED_UNICODE); // ส่งข้อมูล JSON ออกไป
?>
