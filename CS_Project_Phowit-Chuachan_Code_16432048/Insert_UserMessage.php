<?php
    // ตรวจสอบว่ามีการส่งข้อมูลมาจากฟอร์มหรือไม่
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // เชื่อมต่อฐานข้อมูล
    require_once("connect_db.php");

    // รับข้อมูลจากฟอร์ม
    $User_ID = $_POST['User_ID'];
    $Message_Title = $_POST['Message_Title'];
    $Message_Detail = $_POST['Message_Detail'];

    // เตรียมคำสั่ง SQL
    $sqli = "insert into message (User_ID,Message_Title,Message_Detail)";
    $sqli .= "values('$User_ID','$Message_Title','$Message_Detail')";

    mysqli_query($conn,$sqli);
    //echo"SQL = ".$sqli;
    //echo"error = " . mysqli_error($conn);
}
    // ปิดการเชื่อมต่อ
    mysqli_close($conn);

    // เปลี่ยนหน้า
    echo '<meta http-equiv="refresh" content="0; url=User_Data.php">';
?>
