<?php
    // ตรวจสอบว่ามีการส่งข้อมูลมาจากฟอร์มหรือไม่
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // เชื่อมต่อฐานข้อมูล
    require_once("connect_db.php");

    // รับข้อมูลจากฟอร์ม
    $Collect_Date = $_POST['Collect_Date'];
    $EggAmount = $_POST['EggAmount'];

    // เตรียมคำสั่ง SQL
    $sqli = "insert into collect (Collect_Date,EggAmount)";
    $sqli .= "values('$Collect_Date','$EggAmount')";

    mysqli_query($conn,$sqli); 
    //echo"SQL = ".$sqli;

    $conn->close();
}

?>
<meta http-equiv="refresh" content = "0; url =Admin_ManageCollect.php">