<?php
require_once("connect_db.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // SQL to delete the record
    $sql = "DELETE FROM timefood WHERE TimeFood_ID = $id";
    
    if (mysqli_query($conn, $sql)) {
        //echo "Record deleted successfully";
    } else {
        //echo "Error deleting record: " . mysqli_error($conn);
    }
} else {
    echo "No TimeFood_ID ID provided";
}

//echo $sql;

// ปิดการเชื่อมต่อ
mysqli_close($conn);

// เปลี่ยนหน้า
echo '<meta http-equiv="refresh" content="0; url = Admin_ManageEnvironment.php">';
