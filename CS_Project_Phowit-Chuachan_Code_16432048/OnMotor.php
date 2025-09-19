<?php
// เชื่อมต่อฐานข้อมูล
require_once("connect_db.php");

// เตรียมคำสั่ง SQL clone row ล่าสุด → เป็น row ใหม่ แต่เปลี่ยนเฉพาะค่า DC_Motor
$OnMotor = "INSERT INTO datacontrol (`Temperature_range`,`TimeFoodS`,`DC_Motor`,`DC_BV_Tem`,`DC_BV_water`,`DC_BV_FoodS`,`User_ID`)
            SELECT `Temperature_range`,`TimeFoodS`,1, `DC_BV_Tem`,`DC_BV_water`,`DC_BV_FoodS`,`User_ID`
            FROM datacontrol
            ORDER BY `DateControl_ID` DESC LIMIT 1
            ";

mysqli_query($conn,$OnMotor); 

$conn->close();
?>
<meta http-equiv="refresh" content = "0; url = Admin_ManageEnvironment.php">