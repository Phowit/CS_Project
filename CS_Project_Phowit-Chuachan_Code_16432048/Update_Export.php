<?php
    // เชื่อมต่อกับฐานข้อมูล
    require_once("connect_db.php");


// เริ่ม รับข้อมูลจากฟอร์ม -----------------------------------------------------
    $Export_ID = $_POST['Export_ID'];
    $Export_Date = $_POST['Export_Date'];
    $Breed_ID = $_POST['Breed_ID'];
    $New_Export_Amount = $_POST['New_Export_Amount'];
    $Export_Details = $_POST['Export_Details'];
// จบ รับข้อมูลจากฟอร์ม -----------------------------------------------------


// เริ่ม แก้ไขค่า remain เก่า -----------------------------------------------------
    $sql = "SELECT `Export_Amount` FROM `Export` WHERE `Export_ID` = $Export_ID"; //เลือกค่า Import_Amount เก่ามาเปรียบเทียบ
    $result = mysqli_query($conn, $sql);

    while($row = $result->fetch_assoc()) {
        $Old_Export_Amount = $row['Export_Amount'];
    }   //นี่คือค่า Import_Amount เก่า

    //เลือกค่า Remain_Amount เก่า เพื่อมาทำการแก้ไข
    $sqli = "SELECT `remain_ID`,`Remain_Amount` FROM `remain` WHERE `Breed_ID` = '$Breed_ID' ORDER BY `Remain_Date` LIMIT 1 ";
    $resulti = mysqli_query($conn , $sqli);

    while($row = $resulti->fetch_assoc()) {
        $Old_Remain_Amount = $row['Remain_Amount'];
        $remain_ID = $row['remain_ID'];
    }   //นี่คือค่า Remain_Amount เก่า และ ID ที่ต้องการแก้

    //ถ้า ค่าใหม่ มากกว่า ค่าเก่า ให้เอาค่าใหม่ ลบเก่า จะได้ค่าที่ต้อง + เพิ่มใน Remain_Amount
    if ($New_Export_Amount > $Old_Export_Amount) {
        $Difference = $New_Export_Amount - $Old_Export_Amount;
        $New_Remain_Amount = $Old_Remain_Amount + $Difference;
    } 
    //ถ้า ค่าใหม่ น้อยกว่า ค่าเก่า ให้เอาค่าเก่า ลบใหม่ จะได้ค่าที่ต้อง - ออกจาก Remain_Amount
    else if ($New_Export_Amount < $Old_Export_Amount) {
        $Difference = $Old_Export_Amount - $New_Export_Amount;
        $New_Remain_Amount = $Old_Remain_Amount - $Difference;
    }
    // ถ้าค่าเท่าเดิมให้เท่าเดิม
    else { $New_Remain_Amount = $Old_Remain_Amount; }

    //นำค่า Remain_Amount ใหม่ ที่คำนวนแล้ว มา UPDATE
    $sql0 = "   UPDATE `remain` 
                SET `Remain_Amount` = $New_Remain_Amount
                WHERE `remain_ID` = $remain_ID
                ";

    mysqli_query($conn , $sql0); //ส่งคำสั่งแก้ไขไปที่ฐาน
// จบ แก้ไขค่า remain เก่า -----------------------------------------------------



// เริ่ม การหักลบค่าออกจากฐาน ในตาราง total --------------------------------------------------
    $sql1 = "   SELECT r1.*
                FROM remain r1
                JOIN (SELECT Breed_ID, MAX(Remain_Date) AS max_date FROM remain GROUP BY Breed_ID)
                r2 ON r1.Breed_ID = r2.Breed_ID AND r1.Remain_Date = r2.max_date;
                ";                         //เลือกค่า remain ทั้งหมดมา โดยที่ สายพันธุ์ไม่ซ้ำ และเป็นค่าล่าสุดของแต่ละสายพันธุ์เท่านั้น

    $result1 = $conn->query($sql1); // นำค่ามาเก็บไว้

    $total_amount = 0; // ตัวแปรเก็บผลรวม

    if ($result1->num_rows > 0) {
        while ($row = $result1->fetch_assoc()) {
            $total_amount += $row['Remain_Amount']; // รวมค่า
        }
    }

    $sql2 = "INSERT INTO `total`(`Total`) VALUES ('$total_amount');";   // เพิ่มค่าใหม่เข้าไปในฐาน
    mysqli_query($conn, $sql2);
// จบ การหักลบค่าออกจากฐาน ในตาราง total --------------------------------------------------



    $sql3 = "UPDATE export SET 
            Export_Date = '$Export_Date',
            Breed_ID = '$Breed_ID',
            Export_Amount = '$New_Export_Amount',
            Export_Details = '$Export_Details'
            WHERE Export_ID = '$Export_ID'
            ";

    // ดำเนินการคำสั่ง SQL
    if (mysqli_query($conn, $sql3)) {
        //echo "Update successful!";
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
/*
    echo $sql . "<br><br>";
    echo $sqli . "<br><br>";
    echo $sql0 . "<br><br>";
    echo $sql1 . "<br><br>";
    echo $sql2 . "<br><br>";
    echo $sql3 . "<br><br>";
*/
    // ปิดการเชื่อมต่อ
    mysqli_close($conn);

    // เปลี่ยนหน้า
    echo '<meta http-equiv="refresh" content="0; url=Admin_ManageExport.php">';
?>
