<?php
require_once("connect_db.php");                 //เชื่อมต่อฐานข้อมูล โดยดึงมาจากไฟล์ connect_db.php อีกที

$sql1 = "SELECT T_level, DT_record FROM status";// sql1 = "เลือก Data1 , Data2 จาก table status"
$result = $conn->query(query: $sql1);           //เก็บค่าไว้ในตัวแปล $result โดยเปลี่ยนเป็น array 2 มิติ (query:$sql1)

$data = array();                                //นำข้อมูลมาเปลี่ยน type เป็น array

if ($result->num_rows > 0) {                    //ตรวจสอบผลลัพธ์ถ้ามีข้อมูล ให้....
    while ($row = $result->fetch_assoc()) {     //ลูป while เพื่อแสดงข้อมูลเรื่อยๆ
        $data[] = $row;
    }
}

echo json_encode($data);                //แสดงผลเป็นไฟล์ประเภท json_encode เพื่อไปจัดรูปเป็นกราฟด้วย JS
?>