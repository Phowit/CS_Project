<?php
    // ตรวจสอบว่ามีการส่งข้อมูลมาจากฟอร์มหรือไม่
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // เชื่อมต่อฐานข้อมูล
    require_once("connect_db.php");

    // รับข้อมูลจากฟอร์ม
    $Date_in = $_POST['Date_in'];
    $Gene = $_POST['Gene'];
    $Amount = $_POST['Amount'];
    $Name = $_POST['Name'];

    // เตรียมคำสั่ง SQL
    $sqli = "insert into chicken_data(Date_in,Gene,Amount,Name)";
    $sqli .= "values('$Date_in','$Gene','$Amount','$Name')";

    mysqli_query($conn,$sqli); 
    echo"SQL = ".$sqli;

    $conn->close();
}

?>
<meta http-equiv="refresh" content = "0; url =Admin_ManageChicken.php">