<?php
require_once("connect_db.php"); // เชื่อมต่อฐานข้อมูล

// 1. ดึงข้อมูลวันที่คงเหลือ, สายพันธุ์, จำนวนคงเหลือจากฐานข้อมูล
$sql_remain = "SELECT 
        breed.Breed_Name, 
        SUM(Remain_Amount) AS Remain_Amount, 
        Remain_Date 
        FROM remain 
        INNER JOIN breed ON remain.Breed_ID = breed.Breed_ID 
        GROUP BY breed.Breed_Name, Remain_Date 
        ORDER BY Remain_Date DESC"; // คิวรีข้อมูลจากตาราง remain และ breed
$result_remain = $conn->query($sql_remain); // รันคิวรีและเก็บผลลัพธ์

$data = [
    "Remain_Date" => [], // เก็บรายการวันที่
    "Remain_Amount" => [], // เก็บจำนวนไก่คงเหลือแยกตามสายพันธุ์
];

$temp_data = []; // ตัวแปรเก็บข้อมูลชั่วคราว
while ($row = $result_remain->fetch_assoc()) { // วนลูปดึงข้อมูลแต่ละแถวจากผลลัพธ์คิวรี
    $date = date_create_from_format("Y-m-d", $row["Remain_Date"])->format("d/m/Y"); // แปลงวันที่เป็นรูปแบบ d/m/Y
    $breed = $row["Breed_Name"]; // ชื่อสายพันธุ์
    $temp_data[$date][$breed] = (int)$row["Remain_Amount"]; // เก็บจำนวนไก่คงเหลือของแต่ละสายพันธุ์ในวันที่กำหนด
}

// 3. สร้างรายการสายพันธุ์ไม่ให้ซ้ำ
$all_breeds = []; // ตัวแปรสำหรับเก็บชื่อสายพันธุ์ทั้งหมด
foreach ($temp_data as $breeds_data) { // วนลูปข้อมูลใน $temp_data
    foreach (array_keys($breeds_data) as $breed) { // วนลูปชื่อสายพันธุ์
        if (!in_array($breed, $all_breeds)) { // ถ้าสายพันธุ์ยังไม่ถูกเพิ่ม
            $all_breeds[] = $breed; // เพิ่มชื่อสายพันธุ์ในรายการ
        }
    }
}

// 4, 5. จัดข้อมูลให้อยู่ในรูปแบบที่ต้องการ
foreach ($temp_data as $date => $breeds_data) { // วนลูปข้อมูลใน $temp_data
    $data["Remain_Date"][] = $date; // เพิ่มวันที่ใน $data["Remain_Date"]
    foreach ($all_breeds as $breed) { // วนลูปชื่อสายพันธุ์ทั้งหมด
        // เพิ่มจำนวนไก่คงเหลือของสายพันธุ์ในวันนั้น ถ้าไม่มีให้ใส่ 0
        $data["Remain_Amount"][$breed][] = $breeds_data[$breed] ?? 0;
    }
}

// 6. ส่งข้อมูลเป็น JSON รองรับภาษาไทย
header('Content-Type: application/json; charset=utf-8'); // กำหนด header สำหรับ JSON ภาษาไทย
echo json_encode($data, JSON_UNESCAPED_UNICODE); // ส่งข้อมูล JSON ออกไป
?>
