<?php

// เปิดการรายงานข้อผิดพลาดเพื่อช่วย debug
error_reporting(E_ALL);
ini_set('display_errors', 1);

// นำเข้าข้อมูลการเชื่อมต่อฐานข้อมูล
require_once("connect_db.php"); 

try {
    // สร้างการเชื่อมต่อฐานข้อมูลด้วย PDO
    $conn = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8", $db_user, $db_pass); 
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // ตั้งค่าโหมดข้อผิดพลาดให้เป็น Exception

    // เตรียมคำสั่ง SQL เพื่อดึงข้อมูลทั้งหมดจากตาราง breed
    $stmt = $conn->prepare("SELECT * FROM breed");
    $stmt->execute(); // รันคำสั่ง SQL

    // ดึงข้อมูลทั้งหมดในรูปแบบ Associative Array
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // ตรวจสอบว่าได้ข้อมูลจากฐานข้อมูลหรือไม่
    if ($result) {
        // แปลงข้อมูลในฟิลด์ที่เป็น BLOB ให้เป็น Base64
        foreach ($result as &$row) {
            if (isset($row['Breed_Img']) && !empty($row['Breed_Img'])) {
                $row['image_base64'] = base64_encode($row['Breed_Img']);
            } else {
                $row['image_base64'] = ''; // กรณีไม่มีรูปภาพ ให้เป็นค่าว่าง
            }
        }

        header('Content-Type: application/json');
        echo json_encode($result);  // ส่งข้อมูลที่มีการแปลง BLOB กลับไปในรูปแบบ JSON
    } else {
        echo json_encode([]); // กรณีไม่มีข้อมูล ส่ง array ว่างกลับ
    }

} catch (PDOException $e) {
    // หากเกิดข้อผิดพลาด ให้แสดงข้อความข้อผิดพลาดในรูปแบบ JSON
    echo json_encode(["error" => $e->getMessage()]);
}
