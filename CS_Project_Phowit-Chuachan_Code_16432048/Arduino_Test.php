<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $key = $_POST['key']; // รับค่าที่ส่งมาจาก Arduino
    echo "Received: " . htmlspecialchars($key); // แสดงผล
}
?>
