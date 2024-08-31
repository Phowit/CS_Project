<?php
    // ตรวจสอบว่ามีการส่งข้อมูลมาจากฟอร์มหรือไม่
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // เชื่อมต่อฐานข้อมูล
    require_once("connect_db.php");

    // รับข้อมูลจากฟอร์ม
    $Gene_Name = $_POST['Gene_Name'];
    $Description = $_POST['Description'];

    // เตรียมคำสั่ง SQL
    $sqli = "insert into gene(Gene_Name,Description)";
    $sqli .= "values('$Gene_Name','$Description')";

    mysqli_query($conn,$sqli); 
    echo"SQL = ".$sqli;

    $conn->close();
}

?>
<meta http-equiv="refresh" content = "0; url =Admin_ManageGeneChicken.php">