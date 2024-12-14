<?php
    // ตรวจสอบว่ามีการส่งข้อมูลมาจากฟอร์มหรือไม่
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // เชื่อมต่อฐานข้อมูล
    require_once("connect_db.php");

    // รับข้อมูลจากฟอร์ม
    $User_ID = $_POST['User_ID'];
    $Import_Date = $_POST['Import_Date'];
    $Breed_ID = $_POST['Breed_ID'];
    $Import_Amount = $_POST['Import_Amount'];
    $Import_Details = $_POST['Import_Details'];

    // เตรียมคำสั่ง SQL
    $sqli = "insert into Import (User_ID,Import_Date,Breed_ID,Import_Amount,Import_Details)";
    $sqli .= "values('$User_ID','$Import_Date','$Breed_ID','$Import_Amount','$Import_Details')";

    mysqli_query($conn,$sqli);
    //echo"SQL = ".$sqli;
    //echo"error = " . mysqli_error($conn);
}
    // ปิดการเชื่อมต่อ
    mysqli_close($conn);

    // เปลี่ยนหน้า
    echo '<meta http-equiv="refresh" content="0; url=Admin_ManageChicken.php">';
?>
