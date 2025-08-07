<?php
require_once("connect_db.php");

$Collect_ID = $_POST['Collect_ID'];

if($Collect_ID >0 ){
    // เริ่ม ลบการเก็บไข่ ออกจากตาราง -----------------------------------------------------
    $sql = "UPDATE `collect` SET `Collect_Delete`= 1 WHERE `Collect_ID` = $Collect_ID";

    if (mysqli_query($conn, $sql)) {
        echo "Record deleted successfully";
        echo $Collect_ID;
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
    echo '<meta http-equiv="refresh" content="0; url=Admin_ManageCollect.php">';
?>