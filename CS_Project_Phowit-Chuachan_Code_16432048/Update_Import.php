<?php
    // เชื่อมต่อกับฐานข้อมูล
    require_once("connect_db.php");


// เริ่ม รับข้อมูลจากฟอร์ม -----------------------------------------------------
    $Import_ID = $_POST['Import_ID'];
    $Import_Date = $_POST['Import_Date'];
    $Breed_ID = $_POST['Breed_ID'];
    $New_Import_Amount = $_POST['New_Import_Amount'];
    $Import_Details = $_POST['Import_Details'];

    //echo "New_Import_Amount รับจากฟอร์ม = $New_Import_Amount <br><br>";
    //[เริ่ม] ส่วนการตรวจสอบข้อมูลเก่า
    $Check_Old_Import = "SELECT * FROM `import` WHERE `import_ID` = '$Import_ID'; ";

    $Check_result = mysqli_query($conn, $Check_Old_Import);

    while($row = $Check_result->fetch_assoc()) {
        $Old_Import_Date_Record = $row['Import_Date_Record'];
        $Old_Import_Date = $row['Import_Date'];
        $Old_Breed_ID = $row['Breed_ID'];
        $Old_Import_Amount = $row['Import_Amount'];
    }
    //[จบ] ส่วนการตรวจสอบข้อมูลเก่า

// จบ รับข้อมูลจากฟอร์ม -----------------------------------------------------



// เริ่ม แก้ไขข้อมูลการนำเข้า -----------------------------------------------------intval(
if(!$New_Import_Amount or $New_Import_Amount == ''){
    // ถ้าค่าจำนวนใหม่ว่าง ให้จำนวนเท่าเดิม
    $New_Import_Amount = $Old_Import_Amount;
}
$New_Import_Amount = intval($New_Import_Amount);
//echo "New_Import_Amount หลังจากตรวจสอบ+แก้ประเภทแล้ว = $New_Import_Amount <br><br>";

$sql = "UPDATE import SET 
        Import_Date = '$Import_Date',
        Breed_ID = '$Breed_ID',
        Import_Amount = '$New_Import_Amount',
        Import_Details = '$Import_Details'
        WHERE Import_ID = '$Import_ID'
        ";

// ดำเนินการคำสั่ง SQL
if (mysqli_query($conn, $sql)) {
    //echo "Update successful!";
} else {
    echo "Error updating record: " . mysqli_error($conn);
}
// จบ แก้ไขข้อมูลการนำเข้า -----------------------------------------------------



// เริ่ม แก้ไขค่า remain เก่า -----------------------------------------------------

// [เริ่ม] ส่วนกลาง remain โดยดึงค่า remain เก่ามาก่อน +++++
$sqli = "SELECT * FROM `remain` WHERE `Breed_ID` = $Old_Breed_ID ORDER BY `Remain_Date` DESC LIMIT 1";

$resulti = mysqli_query($conn , $sqli);

while($row = $resulti->fetch_assoc()) {
    $Old_Remain_Amount = $row['Remain_Amount'];
    $remain_ID = $row['remain_ID'];
}   //นี่คือค่า Remain_Amount เก่า และ ID ที่ต้องการแก้เก่า
// [จบ] ส่วนกลาง remain โดยดึงค่า remain เก่ามาก่อน +++++


if($Breed_ID != $Old_Breed_ID){
    // 1. หากแก้ไขที่สายพันธุ์อย่างเดียว จะทำการ - remain ด้วยค่าเดิม แล้วไปเพิ่ม remain ด้วยค่าใหม่
    $New_Breed_ID = $Breed_ID;

    $New_Remain_Amount = $Old_Remain_Amount - $Old_Import_Amount;

    //อัพเดทค่า remain ของสายพันธุ์เดิม
    $Old_remain_result = " UPDATE `remain` SET `Remain_Amount` = '$New_Remain_Amount' WHERE  `remain_ID` = '$remain_ID'; ";
    mysqli_query($conn, $Old_remain_result);

    //เลือกค่า remain ล่าสุด ของสายพันธุ์ใหม่มาเพิ่มค่า
    $sql0 = "SELECT * FROM `remain` WHERE `Breed_ID` = $New_Breed_ID ORDER BY `Remain_Date` DESC LIMIT 1; ";
    $result0 = mysqli_query($conn , $sql0);

    while($row = $result0->fetch_assoc()) {
        $Latest_Remain_Amount = $row['Remain_Amount'];
    }   //นี่คือค่า Remain_Amount ล่าสุดของสายพันธุ์ใหม่
    $New_Latest_Remain_Amount = $Latest_Remain_Amount + $New_Import_Amount;

    //เพิ่มค่า remain ของสายพันธุ์ใหม่
    $New_remain_result = "INSERT INTO `remain`(`Remain_Amount`, `total_ID`, `Breed_ID`) VALUES ('$New_Latest_Remain_Amount','1','$New_Breed_ID')";
    mysqli_query($conn, $New_remain_result);

    //echo "New_Import_Amount ในแก้ไขที่สายพันธุ์อย่างเดียว $New_Import_Amount <br><br>";
    
} elseif ( $New_Import_Amount != $Old_Import_Amount AND $Breed_ID === $Old_Breed_ID) {
    //2. แต่ถ้าไม่ได้เปลี่ยนสายพันธุ์ แต่เปลี่ยนแค่จำนวน ให้คำนวนค่าใหม่ของ remain

    //ถ้า ค่าใหม่ มากกว่า ค่าเก่า ให้เอาค่าใหม่ ลบเก่า จะได้ค่าที่ต้อง + เพิ่มใน Remain_Amount
    if ($New_Import_Amount > $Old_Import_Amount) {
        $Difference = $New_Import_Amount - $Old_Import_Amount;
        $New_Remain_Amount = $Old_Remain_Amount + $Difference;
        //echo "New_Import_Amount ในค่าใหม่ มากกว่า ค่าเก่า $New_Import_Amount <br><br>";
    }
    
    //ถ้า ค่าใหม่ น้อยกว่า ค่าเก่า ให้เอาค่าเก่า ลบใหม่ จะได้ค่าที่ต้อง - ออกจาก Remain_Amount
    else if ($New_Import_Amount < $Old_Import_Amount) {
        $Difference = $Old_Import_Amount - $New_Import_Amount;
        $New_Remain_Amount = $Old_Remain_Amount - $Difference;
        //echo "New_Import_Amount ในค่าใหม่ น้อยกว่า ค่าเก่า $New_Import_Amount <br><br>";
    }

    //อัพเดทเพียงค่า remain amount เพราะสายพันธุ์ไม่เปลี่ยน
    $New_remain_result = " UPDATE `remain` SET `Remain_Amount` = '$New_Remain_Amount' WHERE  `remain_ID` = '$remain_ID'; ";
    mysqli_query($conn, $New_remain_result);
}

// จบ แก้ไขค่า remain เก่า -----------------------------------------------------



// เริ่ม คำนวนค่า total ในตาราง total ใหม่--------------------------------------------------
    $sql1 = "   SELECT r1.*
                FROM remain r1
                JOIN (SELECT Breed_ID, MAX(Remain_Date) AS max_date FROM remain GROUP BY Breed_ID)
                r2 ON r1.Breed_ID = r2.Breed_ID AND r1.Remain_Date = r2.max_date;
                ";  //เลือกค่า remain ทั้งหมดมา โดยที่ สายพันธุ์ไม่ซ้ำ และเป็นค่าล่าสุดของแต่ละสายพันธุ์เท่านั้น
                    //เพื่อนำมาคำนวนค่า total ใหม่ทุกๆครั้ง แทนการตรวจสอบว่าค่าเพิ่มหรือลด เพื่อความเสถียร์ของข้อมูล

    $result1 = $conn->query($sql1); // นำค่ามาเก็บไว้

    $total_amount = 0; // ตัวแปรเก็บผลรวม

    if ($result1->num_rows > 0) {
        while ($row = $result1->fetch_assoc()) {
            $total_amount += $row['Remain_Amount']; // รวมค่า
        }
    }

    $sql2 = "INSERT INTO `total`(`Total`) VALUES ('$total_amount');";   // เพิ่มค่าใหม่เข้าไปในฐาน
    mysqli_query($conn, $sql2);
// จบ คำนวนค่า total ในตาราง total ใหม่ --------------------------------------------------



    //ส่วนการตรวจสอบข้อมูล
    /*
    echo "[เริ่ม] ค่าจากฟอร์มที่ได้รับ ------- <br>";
    echo "Import_ID = $Import_ID <br>";
    echo "Import_Date = $Import_Date <br>";
    echo "Breed_ID = $Breed_ID <br>";
    echo "New_Import_Amount หลังตรวจสอบเงื่อนไขแล้ว = $New_Import_Amount <br>";
    echo "Import_Details = $Import_Details <br>";
    echo "[จบ] ค่าจากฟอร์มที่ได้รับ ------- <br><br>";

    echo "คำสั่งตรวจสอบข้อมูลเก่า Check_Old_Import = $Check_Old_Import <br>";
    echo    "   Check_result = <br>
                Old_Import_Date_Record : $Old_Import_Date_Record , <br>
                Old_Import_Date : $Old_Import_Date , <br>
                Old_Breed_ID : $Old_Breed_ID , <br>
                Old_Import_Amount : $Old_Import_Amount <br>
                <br>
            ";

    echo "คำสั่งอัพเดทค่า import $sql <br>";

    echo "คำสั่งดูค่า remain ที่ตรงกับสายพันธุ์เดิม $sqli <br>";
    echo    "   ผลลัพท์ค่า remain สายพันธุ์เดิม = <br>
                Old_Remain_Amount : $Old_Remain_Amount , <br>
                remain_ID : $remain_ID <br>
            ";

    echo "New_remain_result = $New_remain_result <br>";

    echo "เพิ่มค่า total ใหม่เข้าไปในฐาน sql2 = $sql2 <br>";

    echo "aaaaaaa <br>";
*/
    // ปิดการเชื่อมต่อ
    mysqli_close($conn);

    // เปลี่ยนหน้า
    echo '<meta http-equiv="refresh" content="0; url=Admin_ManageImport.php">';
?>
