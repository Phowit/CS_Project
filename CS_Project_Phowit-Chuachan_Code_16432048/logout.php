<?php
session_start(); // เริ่มต้น session
session_unset(); // ลบตัวแปรทั้งหมดใน session
session_destroy(); // ทำลาย session ทั้งหมด

// ส่งผู้ใช้กลับไปยังหน้าล็อกอินหรือหน้าแรก
header("Location: User_Index.php");
exit();
?>
