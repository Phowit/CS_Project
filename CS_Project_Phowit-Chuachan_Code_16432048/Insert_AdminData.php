<?php
    // ตรวจสอบว่ามีการส่งข้อมูลมาจากฟอร์มหรือไม่
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // เชื่อมต่อฐานข้อมูล
    require_once("connect_db.php");

    // รับข้อมูลจากฟอร์ม
    $Admin_ID = $_POST['Admin_ID'];
    $Name = $_POST['Name'];
    $Password = $_POST['Password'];
    $Tel = $_POST['Tel'];
    $Address = $_POST['Address'];
    $Email = $_POST['Email'];
    $Program_ID = $_POST['Program_ID'];

    // เตรียมคำสั่ง SQL
    $sqli = "insert into admin(Admin_ID,Name,Password,Tel,Address,Email,Program_ID)";
    $sqli .= "values('$Admin_ID','$Name','$Password','$Tel','$Address','$Email','$Program_ID')";

    mysqli_query($conn,$sqli); 
    echo"SQL = ".$sqli;


    $conn->close();
}

?>
<meta http-equiv="refresh" content = "0; url =Admin_ManageData.php ">