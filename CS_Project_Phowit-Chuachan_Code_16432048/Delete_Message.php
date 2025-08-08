<?php
require_once("connect_db.php");

$Message_ID = $_POST['Message_ID'];
$User_ID = $_POST['User_ID'];

if ($Message_ID > 0) {
    // เริ่ม ลบการเก็บไข่ ออกจากตาราง -----------------------------------------------------
    $sql = "UPDATE `message` SET `Message_Delete`= 1 WHERE `Message_ID` = $Message_ID";

    if (mysqli_query($conn, $sql)) {
        //echo "Record deleted successfully";
        //echo $User_ID;
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
    // จบ ลบการเก็บไข่ ออกจากตาราง -----------------------------------------------------
} else {
    echo "No Breed ID provided";
}
//echo $sql;

//ตรวจสอบว่าเป็นใคร เพื่อป้องกันข้อผิดพลาด
$sql0 = "SELECT `User_Status` FROM `user` WHERE `User_ID` = $User_ID";
$result0 = mysqli_query($conn, $sql0);

while ($row = $result0->fetch_assoc()) {
    $User_Status = $row['User_Status'];
}

//เปลี่ยนเส้นทาง
if ($User_Status == "Admin") {
    $Goto_page = "Admin_Message.php";
} else {
    $Goto_page = "User_Message.php";
}

// ปิดการเชื่อมต่อ
mysqli_close($conn);

echo '<meta http-equiv="refresh" content = "0; url = ' . $Goto_page . ' ">';
?>