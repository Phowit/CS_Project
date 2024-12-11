<?php
    // ตรวจสอบว่ามีการส่งข้อมูลมาจากฟอร์มหรือไม่
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // เชื่อมต่อฐานข้อมูล
    require_once("connect_db.php");

    // รับข้อมูลจากฟอร์ม
    $User_Name = $_POST['User_Name'];
    $User_Password = $_POST['User_Password'];
    $User_Tel = $_POST['User_Tel'];
    $User_Address = $_POST['User_Address'];
    $User_Email = $_POST['User_Email'];
    $Program = $_POST['Program'];

    // ตรวจสอบว่ามีการอัปโหลดไฟล์หรือไม่
    if (!empty($_FILES['User_Image']['tmp_name'])) {
        $User_Image = file_get_contents($_FILES['User_Image']['tmp_name']);
        $User_Image_Img = mysqli_real_escape_string($conn, $User_Image);

        // เตรียมคำสั่ง SQL ในกรณีที่มีการอัพโหลดภาพ
        $sqli = "insert into User(
                    User_Name,
                    User_Password,
                    User_Tel,
                    User_Address,
                    User_Email,
                    Program,
                    User_Image,
                    User_Status)";
        $sqli .= "values(
                    '$User_Name',
                    '$User_Password',
                    '$User_Tel',
                    '$User_Address',
                    '$User_Email',
                    '$Program',
                    '$User_Image',
                    'Admin')";
    } else {
        
        // เตรียมคำสั่ง SQL
        $defaultImg = file_get_contents('img/User_Default.png');
        $defaultImg = mysqli_real_escape_string($conn, $defaultImg);

        // เตรียมคำสั่ง SQL ในกรณีที่มีการอัพโหลดภาพ
        $sqli = "insert into User(
                    User_Name,
                    User_Password,
                    User_Tel,
                    User_Address,
                    User_Email,
                    Program,
                    User_Image,
                    User_Status)";
        $sqli .= "values(
                    '$User_Name',
                    '$User_Password',
                    '$User_Tel',
                    '$User_Address',
                    '$User_Email',
                    '$Program',
                    '$defaultImg',
                    'Admin')";
    }

    // ดำเนินการคำสั่ง SQL
    if (mysqli_query($conn, $sqli)) {
        echo "Record added successfully!";
    } else {
        echo "Error adding record: " . mysqli_error($conn);
        echo $sqli;
    }

    // ปิดการเชื่อมต่อ
    mysqli_close($conn);

    // เปลี่ยนหน้า
    echo '<meta http-equiv="refresh" content="0; url=Admin_ManageData.php">';
}

?>