<?php
require_once("connect_db.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // SQL to delete the record
    $sql = "DELETE FROM user WHERE User_ID = $id";

    if (mysqli_query($conn, $sql)) {
        //echo "Record deleted successfully";
    } else {
        //echo "Error deleting record: " . mysqli_error($conn);
    }
}
else {
    echo "No Gene ID provided";
}

session_start(); // เริ่มต้น session
session_unset(); // ลบตัวแปรทั้งหมดใน session
session_destroy(); // ทำลาย session ทั้งหมด

// ส่งผู้ใช้กลับไปยังหน้าล็อกอินหรือหน้าแรก
header("Location: User_Index.php");
exit();

?>