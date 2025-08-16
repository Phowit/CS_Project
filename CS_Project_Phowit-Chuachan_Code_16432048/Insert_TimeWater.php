<?php
    // ตรวจสอบว่ามีการส่งข้อมูลมาจากฟอร์มหรือไม่
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // เชื่อมต่อฐานข้อมูล
    require_once("connect_db.php");

    // รับข้อมูลจากฟอร์ม 
    $TimeWater = $_POST['TimeWater'];

    // เตรียมคำสั่ง SQL
    $sqli = "INSERT INTO `timewater`(`TimeWater`, `DateControl_ID`) VALUES ('$TimeWater',1)";

    mysqli_query($conn,$sqli);
    //echo"SQL = ".$sqli;
    //echo"error = " . mysqli_error($conn);
}
    // ปิดการเชื่อมต่อ
    mysqli_close($conn);

    // เปลี่ยนหน้า
    echo '<meta http-equiv="refresh" content="0; url = Admin_ManageEnvironment.php">';
?>
