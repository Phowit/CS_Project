<?php
    // เชื่อมต่อกับฐานข้อมูล
    require_once("connect_db.php");

    // รับข้อมูลจากฟอร์ม
    $User_ID = $_POST['User_ID'];
    $Old_User_Password = $_POST['Old_User_Password'];
    $New_User_Password = $_POST['New_User_Password'];

    $sql = "SELECT `User_Password` FROM `user` WHERE `User_ID` = ?";

    $stmt = $conn->prepare($sql); // เตรียมคำสั่ง SQL เพื่อป้องกัน SQL Injection
    $stmt->bind_param("i", $User_ID); // ผูกค่าพารามิเตอร์
    $stmt->execute(); // รันคำสั่ง
    $result = $stmt->get_result(); // รับผลลัพธ์จากฐานข้อมูล

    while ($row = $result->fetch_assoc()) {
        $User_Password = $row['User_Password'];
    }
    if($User_Password == $Old_User_Password) {
        $sqli = "UPDATE user SET User_Password = '$New_User_Password' WHERE `User_ID` = $User_ID";
        echo "<h1 style='margin-top:20%; margin-left:40%;'>เปลี่ยนรหัสผ่านแล้ว</h1>";
        mysqli_query($conn, $sqli);
    }else {
        echo "<h1 style='margin-top:20%; margin-left:40%;'>รหัสผ่านไม่ถูกต้อง</h1>";
    }

    // ปิดการเชื่อมต่อ
    mysqli_close($conn);

    // เปลี่ยนหน้า
    echo '<meta http-equiv="refresh" content="1; url=User_Data.php">';
?>
