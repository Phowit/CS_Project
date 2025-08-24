<?php
    // เชื่อมต่อฐานข้อมูล
    require_once("connect_db.php");

    //เริ่มส่วนการเพิ่มข้อมูล import --------------------------------------------
    // ตรวจสอบว่ามีการส่งข้อมูลมาจากฟอร์มหรือไม่
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // รับข้อมูลจากฟอร์ม
        $Import_Date = $_POST['Import_Date'];
        $Breed_ID = $_POST['Breed_ID'];
        $Import_Amount = $_POST['Import_Amount'];
        $Import_Details = $_POST['Import_Details'];

        // เตรียมคำสั่ง SQL
        $sqli = "   INSERT into Import (Import_Date,Breed_ID,Import_Amount,Import_Details) 
                    values ('$Import_Date','$Breed_ID','$Import_Amount','$Import_Details')  ";

        mysqli_query($conn,$sqli);
        //echo"SQL = ".$sqli;
        //echo"error = " . mysqli_error($conn);
    }
    //จบส่วนการเพิ่มข้อมูล import --------------------------------------------



//เริ่มส่วนการตรวจสอบและเพิ่ม remain ใหม่ --------------------------------------------
//หลังจากเพิ่มข้อมูลการนำเข้าเสร็จ ดึงข้อมูล remain มาตรวจสอบว่ามี Breed_ID เหมือนกันหรือไม่? 
//โดยดูจากข้อมูล่าสุด หากไม่มี ให้เพิ่ม remain ใหม่ เข้าไป
$sql0 = "   SELECT * FROM `remain` AS r
            JOIN import AS i ON i.import_ID = r.Import_ID
            JOIN breed AS b ON b.Breed_ID = i.Breed_ID
            WHERE b.Breed_ID = $Breed_ID ORDER BY `Remain_Date` DESC LIMIT 1;
        " ;
$result0 = mysqli_query($conn, $sql0);//ดึงข้อมูลทั้งหมดจาก remain มา

// import id ส่วนกลาง
$sql2 = "SELECT `import_ID` FROM `import` ORDER BY `Import_Date_Record` DESC LIMIT 1";
$result2 = $conn->query($sql2);//ดึงข้อมูล id ล่าสุดจาก import ที่พึ่งเพิ่มไปด้านบน
while($row = $result2->fetch_assoc()){
    $import_ID = $row['import_ID'];
}

//ตรวจสอบว่ามีข้อมูลเก่าอยู่แล้วหรือไม่
if($result0 && $result0->num_rows > 0) {
    //ถ้ามี ให้นำค่าเก่าล่าสุดมา + เพิ่มกับค่าใหม่ แล้วค่อยสร้างชุดข้อมูลใหม่ เพื่อที่จะสามารถสร้างเป็นกราฟวัดได้ ว่าเพิ่มลดเท่าไร
    while($row = $result0->fetch_assoc()){
        $Remain_Amount = $row['Remain_Amount'];
        $Remain_Import_ID = $row['Import_ID']; 
        $Remain_Export_ID = $row['Export_ID'];
    }

    $New_Remain_Amount = $Remain_Amount + $Import_Amount; //ข้อมูลเก่า + ใหม่
    //echo $Remain_Amount . "," . $Remain_Import_ID  . "," . $Remain_Export_ID . "<br>";
    $sql1 = " INSERT INTO `remain`(`Remain_Amount`, `Import_ID` , `Export_ID`) VALUES ($New_Remain_Amount , $import_ID , $Remain_Export_ID);";
    //echo "พบค่าเก่า =" . $Remain_Amount . "<br>";
} else {
    //ถ้าไม่มี ให้สร้างสาย remain ด้วยข้อมูลใหม่ทั้งหมดใหม่

    $sql1 = "INSERT INTO `remain`(`Remain_Amount`, `Import_ID`) VALUES ($Import_Amount, $import_ID);";
    //echo "ไม่พบค่าเก่า <br>";
}
mysqli_query($conn,$sql1);
//จบส่วนการตรวจสอบและเพิ่ม remain ใหม่ --------------------------------------------



// เริ่ม ส่วนการรวมค่า total -----------------------------------------------------------
$sql3 = "SELECT * FROM `total` ORDER BY `Total_Date` DESC LIMIT 1; ";                         
//เลือกค่า total ล่าสุดมา 1 ค่า

$result3 = $conn->query($sql3); // นำค่ามาเก็บไว้

if ($result3->num_rows > 0) {
    while($row = $result3->fetch_assoc()){
        $total_amount = $row['Total'];
    }
        $New_Total = $total_amount + $Import_Amount; // รวมค่า
        //echo "New_Total แบบมีค่าเก่า = " . $New_Total . "<br>";
    } else {
        $New_Total = $Import_Amount;
        //echo "New_Total แบบไม่มีค่าเก่า = " . $New_Total . "<br>";
    }

    $sql4 = "SELECT `Remain_ID` FROM `remain` ORDER BY `Remain_Date` DESC LIMIT 1";
    $result4 = $conn->query($sql4);//ดึงข้อมูล id ล่าสุดจาก import ที่พึ่งเพิ่มไปด้านบน
    while($row = $result4->fetch_assoc()){
        $Remain_ID = $row['Remain_ID'];
    }

$sql5 = "INSERT INTO `total`(`Total` , `Remain_ID`) VALUES ('$New_Total' , $Remain_ID);";   // เพิ่มค่าใหม่เข้าไปในฐาน
mysqli_query($conn, $sql5);
// จบ ส่วนการรวมค่า total -----------------------------------------------------------


/*
echo "SQLi =" . $sqli ."คือการเพิ่ม import <br>";
echo "SQL0 =" . $sql0 ."ดึง remain ล่าสุดมา <br>";
echo "SQL1 =" . $sql1 ."เพิ่ม remain ใหม่ไป อาจรวมกับค่าเก่าแล้ว <br>";
echo "SQL2 =" . $sql2 ."ดึงข้อมูล id ล่าสุดจาก import ที่พึ่งเพิ่มไปด้านบน <br>";
echo "SQL3 =" . $sql3 ."รวมค่า total จะได้" . $New_Total . "<br>";
echo "SQL4 =" . $sql4 ."ดึงข้อมูล id ล่าสุดจาก remain ที่พึ่งเพิ่มไปด้านบน <br>";
echo "SQL5 =" . $sql5 ."เพิ่มค่า total" . "<br>";
//echo "New_Remain_Amount" . $New_Remain_Amount . "=" . $Remain_Amount . "+" . $Import_Amount . "<br>";
*/
    // ปิดการเชื่อมต่อ
    mysqli_close($conn);

    // เปลี่ยนหน้า
    echo '<meta http-equiv="refresh" content="0; url=Admin_ManageImport.php">';
?>
