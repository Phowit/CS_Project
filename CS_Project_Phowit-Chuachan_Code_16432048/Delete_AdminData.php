<?php
require_once("connect_db.php");

$User_ID = $_POST['User_ID'];

if($User_ID >0 ){
    // เริ่ม ลบการเก็บไข่ ออกจากตาราง -----------------------------------------------------
    $sql = "UPDATE `user` SET `User_Delete`= 1 WHERE `User_ID` =  $User_ID";

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

    // ปิดการเชื่อมต่อ
    mysqli_close($conn);

    // เปลี่ยนหน้า
    echo '<meta http-equiv="refresh" content="0; url=Admin_ManageData.php">';
?>