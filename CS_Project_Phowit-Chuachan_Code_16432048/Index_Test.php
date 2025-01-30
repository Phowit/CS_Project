<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arduino Data Viewer</title>
</head>
<body>
    <h1>Data from Arduino</h1>
    <p>Log of received data:</p>
    <pre>
    <?php
// อ่านข้อมูลจาก log โดยระบุเส้นทางให้ชัดเจน
$logFile = __DIR__ . '/data_log.txt'; // ระบุ path แบบสัมพันธ์กับโฟลเดอร์ปัจจุบัน
if (file_exists($logFile)) {
    echo htmlspecialchars(file_get_contents($logFile));
} else {
    echo "No data received yet.";
}
?>
    </pre>
</body>
</html>
