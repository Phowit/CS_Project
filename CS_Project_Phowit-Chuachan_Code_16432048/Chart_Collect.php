<?php
// Chart_Collect.php
require_once("connect_db.php");

// กำหนดวันที่เริ่มต้น
$current_date_php = date('Y-m-d'); // วันที่ปัจจุบันในรูปแบบ YYYY-MM-DD
$selected_date_chart = $current_date_php; // ตั้งค่าเริ่มต้นเป็นวันที่ปัจจุบัน

// *** เปลี่ยนจาก $_GET['search_date'] เป็น $_GET['date'] ***
if (isset($_GET['date']) && !empty($_GET['date'])) {
    $selected_date_chart = mysqli_real_escape_string($conn, $_GET['date']);
}

$sql_collect = "SELECT 
        Collect_Date, 
        SUM(EggAmount) AS EggAmount 
        FROM collect 
        WHERE DATE(Collect_Date) = '$selected_date_chart' 
        GROUP BY Collect_Date 
        ORDER BY Collect_Date ASC"; 

$result_collect = $conn->query($sql_collect);

$data = [
    "Collect_Date" => [], 
    "EggAmount" => []     
];

if ($result_collect) {
    while ($row = $result_collect->fetch_assoc()) {
        $date_obj = date_create_from_format("Y-m-d H:i:s", $row["Collect_Date"]);
        if ($date_obj) {
            $formatted_date = $date_obj->format("d/m/Y H:i"); // เพิ่ม H:i เพื่อให้แสดงเวลาด้วย (ถ้าต้องการละเอียดขึ้น)
            $data["Collect_Date"][] = $formatted_date;
            $data["EggAmount"][] = (int)$row["EggAmount"];
        }
    }
} else {
    error_log("Error fetching chart data: " . $conn->error);
}

header('Content-Type: application/json; charset=utf-8');
echo json_encode($data, JSON_UNESCAPED_UNICODE);

$conn->close();
?>