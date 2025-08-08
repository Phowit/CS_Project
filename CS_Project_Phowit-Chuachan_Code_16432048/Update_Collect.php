<?php
// เชื่อมต่อกับฐานข้อมูล
require_once("connect_db.php");

// รับข้อมูลจากฟอร์ม
$Collect_ID = $_POST['Collect_ID'];
$Collect_Date = $_POST['Collect_Date'];
$EggAmount = $_POST['EggAmount'];
$User_ID = $_POST['User_ID'];

$sql = "UPDATE collect SET Collect_Date = '$Collect_Date', EggAmount = '$EggAmount' WHERE Collect_ID = '$Collect_ID'";

// ดำเนินการคำสั่ง SQL
if (mysqli_query($conn, $sql)) {
    //echo "Update successful!";
} else {
    echo "Error updating record: " . mysqli_error($conn);
}

//ตรวจสอบว่าเป็นใคร เพื่อป้องกันข้อผิดพลาด
$sql0 = "SELECT `User_Status` FROM `user` WHERE `User_ID` = $User_ID";
$result0 = mysqli_query($conn, $sql0);

while ($row = $result0->fetch_assoc()) {
    $User_Status = $row['User_Status'];
}

//เปลี่ยนเส้นทาง
if ($User_Status == "Admin") {
    $Goto_page = "Admin_ManageCollect.php";
} else {
    $Goto_page = "User_Collect.php";
}

// ปิดการเชื่อมต่อ
mysqli_close($conn);

echo '<meta http-equiv="refresh" content = "0; url = ' . $Goto_page . ' ">';
?>