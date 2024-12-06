<?php
    // ตรวจสอบว่ามีการส่งข้อมูลมาจากฟอร์มหรือไม่
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // เชื่อมต่อฐานข้อมูล
    require_once("connect_db.php");

    // รับข้อมูลจากฟอร์ม
    $Breed_Name = $_POST['Breed_Name'];
    $Breed_Description = $_POST['Breed_Description'];

    // ตรวจสอบว่ามีการอัปโหลดไฟล์หรือไม่
    if (!empty($_FILES['Breed_Img']['tmp_name'])) {
        $Breed_Img = file_get_contents($_FILES['Breed_Img']['tmp_name']);
        $Breed_Img = mysqli_real_escape_string($conn, $Breed_Img);

        // เตรียมคำสั่ง SQL
        $sqli = "insert into breed(Breed_Name,Breed_Description,Breed_Img)";
        $sqli .= "values('$Breed_Name','$Breed_Description','$Breed_Img')";

    } else {
        
        // เตรียมคำสั่ง SQL
        $defaultImg = file_get_contents('img/Default.jpg');
        $defaultImg = mysqli_real_escape_string($conn, $defaultImg);

        $sqli = "insert into breed(Breed_Name,Breed_Description,Breed_Img)";
        $sqli .= "values('$Breed_Name','$Breed_Description','$defaultImg')";
    }

    // ดำเนินการคำสั่ง SQL
    if (mysqli_query($conn, $sqli)) {
        echo "Record added successfully!";
    } else {
        echo "Error adding record: " . mysqli_error($conn);
    }

    // ปิดการเชื่อมต่อ
    mysqli_close($conn);

    // เปลี่ยนหน้า
    echo '<meta http-equiv="refresh" content="0; url=Admin_ManageBreedChicken.php">';
}

?>