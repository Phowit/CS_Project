<?php
// เชื่อมต่อฐานข้อมูล
require_once("connect_db.php");

// กำหนดวันที่เริ่มต้น
$current_date_php = date('Y-m-d'); // วันที่ปัจจุบันในรูปแบบ YYYY-MM-DD
$selected_date_chart = $current_date_php; // ตั้งค่าเริ่มต้นเป็นวันที่ปัจจุบัน

if (isset($_GET['date']) && !empty($_GET['date'])) {
    $selected_date_chart = mysqli_real_escape_string($conn, $_GET['date']);
}

// 1. ดึงข้อมูลวันที่ส่งออก, สายพันธุ์, จำนวนที่ส่งออกมาจากฐานข้อมูล
$sql_export = "SELECT
                    DATE_FORMAT(export.Export_Date, '%H:00') AS Export_Hour,
                    breed.Breed_Name,
                    SUM(export.Export_Amount) AS Total_Export_Amount
                FROM export
                INNER JOIN import ON import.import_ID = export.Import_ID
                INNER JOIN breed ON import.Breed_ID = breed.Breed_ID
                WHERE DATE(export.Export_Date) = '$selected_date_chart' -- *** แก้ไขตรงนี้: ใช้ export.Export_Date แทน import.Import_Date ***
                GROUP BY breed.Breed_Name, Export_Hour
                ORDER BY Export_Hour ASC"; // *** แก้ไขตรงนี้: เปลี่ยนเป็น ASC เพื่อเรียงจากน้อยไปมาก ***
$result_Export = $conn->query($sql_export);

$labels = [];
$all_breeds = [];
$hourly_data = [];

if ($result_Export->num_rows > 0) {
    while ($row = $result_Export->fetch_assoc()) {
        $hour = $row['Export_Hour'];
        $breed = $row['Breed_Name'];
        $amount = (int)$row['Total_Export_Amount'];

        if (!in_array($hour, $labels)) {
            $labels[] = $hour;
        }
        if (!in_array($breed, $all_breeds)) {
            $all_breeds[] = $breed;
        }

        $hourly_data[$hour][$breed] = $amount;
    }
}

// เรียง labels (ชั่วโมง) เพื่อให้แน่ใจว่าเรียงถูกต้อง (00:00, 01:00, ...)
sort($labels);

// ถ้าไม่มีข้อมูลเลยในวันที่เลือก ให้สร้าง labels 24 ชั่วโมง
if (empty($labels)) {
    for ($i = 0; $i < 24; $i++) {
        $labels[] = sprintf('%02d:00', $i);
    }
}

$datasets = [];
// สร้าง datasets สำหรับแต่ละสายพันธุ์
foreach ($all_breeds as $breed) {
    $data_for_breed = [];
    foreach ($labels as $hour) {
        $data_for_breed[] = $hourly_data[$hour][$breed] ?? 0;
    }
    $datasets[] = [
        'label' => $breed,
        'data' => $data_for_breed,
        // *** ลบ borderColor ออกจาก PHP หรือใช้ฟังก์ชันสุ่มสีจริง ๆ ***
        // 'borderColor' => '#E8D3FF',
        // ควรให้ JavaScript เป็นผู้กำหนดสีเพื่อความสม่ำเสมอ หรือสร้างฟังก์ชันสุ่มสีใน PHP ที่นี่
        'fill' => false,
        'tension' => 0.1
    ];
}

// ส่งข้อมูลเป็น JSON รองรับภาษาไทย
header('Content-Type: application/json; charset=utf-8');
echo json_encode([
    'Export_Date' => $labels, // เปลี่ยนชื่อ keys ให้ตรงกับที่ JS คาดหวัง
    'Export_Amount' => $datasets
], JSON_UNESCAPED_UNICODE);

$conn->close();
?>