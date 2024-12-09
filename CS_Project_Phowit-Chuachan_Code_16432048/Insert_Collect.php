<?php
    // ตรวจสอบว่ามีการส่งข้อมูลมาจากฟอร์มหรือไม่
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // เชื่อมต่อฐานข้อมูล
    require_once("connect_db.php");

    // รับข้อมูลจากฟอร์ม
    $Date_Harvest = $_POST['Date_Harvest'];
    $EggAmount = $_POST['EggAmount'];
    $Admin_Name = $_POST['Admin_Name'];

    // เตรียมคำสั่ง SQL
    $sqli = "insert into harvest(Date_Harvest,EggAmount,Name)";
    $sqli .= "values('$Date_Harvest','$EggAmount','$Name')";

    mysqli_query($conn,$sqli); 
    echo"SQL = ".$sqli;

    $conn->close();
}

?>
<meta http-equiv="refresh" content = "0; url =Admin_ManageCollect.php">