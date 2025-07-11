<?php

// Chart_Import.php

require_once("connect_db.php"); // เชื่อมต่อฐานข้อมูล

// กำหนดวันที่เริ่มต้น
$current_date_php = date('Y-m-d'); // วันที่ปัจจุบันในรูปแบบ YYYY-MM-DD
$selected_date_chart = $current_date_php; // ตั้งค่าเริ่มต้นเป็นวันที่ปัจจุบัน

if (isset($_GET['date']) && !empty($_GET['date'])) {
    $selected_date_chart = mysqli_real_escape_string($conn, $_GET['date']);
}

// SQL Query เพื่อดึงข้อมูลการนำเข้าไก่ แยกตามเวลา (ชั่วโมง) และสายพันธุ์ สำหรับวันที่เลือก
// ใช้ DATE_FORMAT เพื่อจัดกลุ่มตามชั่วโมง
$sql_import = "SELECT
                    DATE_FORMAT(import.Import_Date, '%H:00') AS Import_Hour,
                    breed.Breed_Name,
                    SUM(import.Import_Amount) AS Total_Import_Amount
                FROM
                    import
                INNER JOIN
                    breed ON import.Breed_ID = breed.Breed_ID
                WHERE
                    DATE(import.Import_Date) = '$selected_date_chart'
                GROUP BY
                    Import_Hour, breed.Breed_Name
                ORDER BY
                    Import_Hour ASC, breed.Breed_Name ASC"; // เรียงตามชั่วโมงและสายพันธุ์

$result_import = $conn->query($sql_import);

$labels = []; // แกน X: ชั่วโมงของวัน
$datasets = []; // ข้อมูลสำหรับแต่ละสายพันธุ์
$all_breeds = []; // เก็บรายการสายพันธุ์ทั้งหมดที่พบในข้อมูลของวันนี้

// ดึงข้อมูลและจัดโครงสร้างเบื้องต้น
$hourly_data = []; // เก็บข้อมูลในรูปแบบ [ชั่วโมง][สายพันธุ์] = จำนวน

if ($result_import->num_rows > 0) {
    while ($row = $result_import->fetch_assoc()) {
        $hour = $row['Import_Hour'];
        $breed = $row['Breed_Name'];
        $amount = (int)$row['Total_Import_Amount'];

        if (!in_array($hour, $labels)) {
            $labels[] = $hour; // เก็บชั่วโมงเป็น label
        }
        if (!in_array($breed, $all_breeds)) {
            $all_breeds[] = $breed; // เก็บสายพันธุ์
        }

        // เก็บข้อมูลในโครงสร้าง [ชั่วโมง][สายพันธุ์] = จำนวน
        $hourly_data[$hour][$breed] = $amount;
    }
}

// เรียง labels (ชั่วโมง) เพื่อให้แน่ใจว่าเรียงถูกต้อง (00:00, 01:00, ...)
sort($labels);

// สร้าง datasets สำหรับแต่ละสายพันธุ์
foreach ($all_breeds as $breed) {
    $data_for_breed = [];
    foreach ($labels as $hour) {
        // ถ้ามีข้อมูลสำหรับชั่วโมงนั้นและสายพันธุ์นั้น ให้ใช้ค่าจริง ถ้าไม่ ให้เป็น 0
        $data_for_breed[] = $hourly_data[$hour][$breed] ?? 0;
    }
    $datasets[] = [
        'label' => $breed,
        'data' => $data_for_breed,
        'borderColor' => getRandomColor(), // ฟังก์ชันสุ่มสี (จะสร้างด้านล่าง)
        'fill' => false,
        'tension' => 0.1
    ];
}

// ถ้าไม่มีข้อมูลเลยในวันที่เลือก ให้ส่งโครงสร้างเปล่ากลับไป
if (empty($labels) && empty($datasets)) {
    // สร้าง labels สำหรับ 24 ชั่วโมง ถ้าไม่มีข้อมูล เพื่อให้กราฟว่างแต่มีแกนเวลา
    for ($i = 0; $i < 24; $i++) {
        $labels[] = sprintf('%02d:00', $i);
    }
}


// ฟังก์ชันสำหรับสุ่มสี (เพื่อความสวยงามของกราฟหลายเส้น)
function getRandomColor() {
    return 'rgba(' . rand(0, 255) . ', ' . rand(0, 255) . ', ' . rand(0, 255) . ', 1)';
}

// ส่งข้อมูลเป็น JSON รองรับภาษาไทย
header('Content-Type: application/json; charset=utf-8');
echo json_encode(['labels' => $labels, 'datasets' => $datasets], JSON_UNESCAPED_UNICODE);

$conn->close(); // ปิดการเชื่อมต่อฐานข้อมูล
?>