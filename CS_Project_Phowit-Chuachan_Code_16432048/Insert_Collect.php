<?php
    // ตรวจสอบว่ามีการส่งข้อมูลมาจากฟอร์มหรือไม่
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // เชื่อมต่อฐานข้อมูล
    require_once("connect_db.php");

    // รับข้อมูลจากฟอร์ม
    $User_ID = $_POST['User_ID'];
    $Collect_Date = $_POST['Collect_Date'];
    $EggAmount = $_POST['EggAmount'];

    // เตรียมคำสั่ง SQL
    $sqli = "insert into collect (Collect_Date,EggAmount,User_ID)";
    $sqli .= "values('$Collect_Date','$EggAmount','$User_ID')";

    mysqli_query($conn,$sqli); 
    //echo"SQL = ".$sqli;



    //ตรวจสอบว่าเป็นใคร
    $sql0 = "SELECT `User_Status` FROM `user` WHERE `User_ID` = $User_ID";
    $result0 = mysqli_query($conn,$sql0);

    while($row = $result0->fetch_assoc()) { $User_Status = $row['User_Status']; }

    //เปลี่ยนเส้นทาง
    if($User_Status == "Admin"){
        $Goto_page = "Admin_ManageCollect.php";
    } else {
        $Goto_page = "User_Collect.php";
    }
    echo '<meta http-equiv="refresh" content = "0; url = ' . $Goto_page . ' ">';

    $conn->close();
}

?>