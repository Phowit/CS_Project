<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <title>ส่งข้อมูลไป ESP8366</title>
</head>
<body>
  <h2>ส่งค่าตัวเลขไปที่ ESP32</h2>
  <form action="http://192.168.1.155/data" method="get">
    <label>กรอกค่า:</label>
    <input type="text" name="value" placeholder="เช่น 1">
    <button type="submit">ส่ง</button>
  </form>
</body>
</html>