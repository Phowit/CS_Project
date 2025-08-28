<?php

// ตรวจสอบว่ามีการส่งข้อมูลมาจากฟอร์มหรือไม่
if ($_SERVER["REQUEST_METHOD"] == "POST") {

// เชื่อมต่อกับฐานข้อมูล
require_once("connect_db.php");

// เริ่ม รับข้อมูลจากฟอร์ม -----------------------------------------------------
$Export_ID = $_POST['Export_ID'];

$Export_Date = $_POST['Export_Date'];
$Breed_ID = $_POST['Breed_ID'];
$New_Export_Amount = $_POST['New_Export_Amount'];
$Export_Details = $_POST['Export_Details'];

/*
echo "ค่าที่รับมา = Export_ID : " . $Export_ID . "<br>";
echo "Export_Date : " . $Export_Date . "<br>";
echo "Breed_ID : " . $Breed_ID . "<br>";
echo "New_Export_Amount : " . $New_Export_Amount . "<br>";
echo "Export_Details : " . $Export_Details . "<br>";
echo "จบส่วนค่าที่รับมา <br><br>";
*/

//[เริ่ม] ส่วนการตรวจสอบข้อมูลเก่าของ Export
$Check_Old_Export = "SELECT * FROM `export` WHERE `Export_ID` = '$Export_ID'; ";

$Check_result = mysqli_query($conn, $Check_Old_Export);

while ($row = $Check_result->fetch_assoc()) {
    $Old_Export_Date = $row['Export_Date'];
    $Old_Export_Amount = $row['Export_Amount'];
}

/*
echo "ส่วนการตรวจสอบข้อมูลเก่าของ Export <br>";
echo "Check_Old_Export : " . $Check_Old_Export . "<br>";
echo "Old_Export_Date : " . $Old_Export_Date . "<br>";
echo "Old_Export_Amount : " . $Old_Export_Amount . "<br>";
echo "จบส่วนการตรวจสอบข้อมูลเก่าของ Export <br><br>";
*/

//[จบ] ส่วนการตรวจสอบข้อมูลเก่า

// จบ รับข้อมูลจากฟอร์ม -----------------------------------------------------



if (!$New_Export_Amount or $New_Export_Amount == '') {
    // ถ้าค่าจำนวนใหม่ว่าง ให้จำนวนเท่าเดิม
    $New_Export_Amount = $Old_Export_Amount;
}
$New_Export_Amount = intval($New_Export_Amount);
//echo "New_Export_Amount หลังจากตรวจสอบ+แก้ประเภทแล้ว = $New_Export_Amount <br><br>";

/*
echo "ส่วนการตรวจสอบ New_Export_Amount <br>";
echo "New_Export_Amount : " . $New_Export_Amount . "<br>";
echo "จบ ส่วนการตรวจสอบ New_Export_Amount <br><br>";
*/


// เริ่ม ส่วนการคำนวนค่าและอัพเดท remain ใหม่ -----------------------------------------------------

// [เริ่ม] ส่วนกลาง remain โดยดึงค่า remain เก่ามาก่อน +++++
$sqli = "   SELECT
            r.`Remain_Amount`,
            r.`Import_ID`,
            i.Breed_ID
            FROM `remain` AS r 
            JOIN export AS e ON r.Export_ID = e.Export_ID
            JOIN import AS i ON i.import_ID = r.Import_ID
            WHERE e.Export_ID = $Export_ID
            ORDER BY r.`Remain_ID` DESC LIMIT 1
        ";

$resulti = mysqli_query($conn, $sqli);

while ($row = $resulti->fetch_assoc()) {
    $Old_Remain_Amount = $row['Remain_Amount'];
    $Old_Import_ID = $row['Import_ID'];
    $Old_Breed_ID = $row['Breed_ID'];
}   //นี่คือค่า Remain_Amount เก่า และ ID ที่ต้องการแก้เก่า

/*
echo "ส่วนกลาง remain โดยดึงค่า remain เก่ามาก่อน <br>";
echo "sqli : " . $sqli . "<br>";
echo "Old_Remain_Amount : " . $Old_Remain_Amount . "<br>";
echo "Old_Import_ID : " . $Old_Import_ID . "<br>";
echo "จบ ส่วนกลาง remain <br><br>";
*/

// [จบ] ส่วนกลาง remain โดยดึงค่า remain เก่ามาก่อน +++++



// เริ่ม คำนวนค่า remain ใหม่
if( $Breed_ID != $Old_Breed_ID ) {
    // 1. หากแก้ไขที่สายพันธุ์อย่างเดียว จะทำการ - remain ด้วยค่าเดิม แล้วไปเพิ่ม remain ด้วยค่าใหม่
    $New_Breed_ID = $Breed_ID;

    //เลือกค่า remain ล่าสุด ของสายพันธุ์ใหม่มาเพิ่มค่า
    $sql0 = "   SELECT * FROM `remain` AS r 
                JOIN import AS i ON r.`Import_ID` = i.`import_ID`
                WHERE i.`Breed_ID` = $New_Breed_ID ORDER BY r.`Remain_Date` DESC LIMIT 1; ";
    $result0 = mysqli_query($conn , $sql0);

    while($row = $result0->fetch_assoc()) {
        $Latest_Remain_Amount = $row['Remain_Amount']; //นี่คือค่า Remain_Amount ล่าสุดของสายพันธุ์ใหม่
        $Latest_Remain_Import = $row['Import_ID'];  //นี่คือค่า Import_ID ล่าสุดของสายพันธุ์ใหม่
    }

    /*
    echo "เข้าเงื่อนไข สายพันธุ์ใหม่ ไม่เท่ากับสายพันธุ์เก่า <br>";
    echo "New_Breed_ID : " . $New_Breed_ID . "<br>";
    echo "sql0 : " . $sql0 . "<br>";
    echo "Latest_Remain_Amount : " . $Latest_Remain_Amount . "<br>";
    echo "Latest_Remain_Import : " . $Latest_Remain_Import . "<br>";
    echo "จบ เงื่อนไข สายพันธุ์ใหม่ ไม่เท่ากับสายพันธุ์เก่า <br><br>";
    */

    // ถ้าค่าคงเหลือล่าสุดของสายพันธุ์ใหม่ เหลือมากกว่าค่าการนำออก ที่แก้ไขเข้ามา ก็สามารถแก้ไขต่อได้
    if ( $Latest_Remain_Amount >= $New_Export_Amount ) {

        // เริ่ม คำนวนค่าและเพิ่มค่า remain ของสายพันธุ์เดิม ....................................................
        $New_Remain_Amount = $Old_Remain_Amount + $Old_Export_Amount;

        $Old_remain_result = "  INSERT INTO `remain`(`Remain_Amount`,`Import_ID`, `Export_ID`) 
                                VALUES ('$New_Remain_Amount','$Old_Import_ID','$Export_ID') ";
        mysqli_query($conn, $Old_remain_result);
        // จบ คำนวนค่าและเพิ่มค่า remain ของสายพันธุ์เดิม ....................................................

        //คำนวนและเพิ่มค่าล่าสุดของสายพันธุ์ใหม่ [ค่าใหม่ล่าสุดของสายพันธุ์ใหม่ = ค่าของสายพันธุ์ใหม่ - ค่าที่นำออก]
        $New_Latest_Remain_Amount = $Latest_Remain_Amount - $New_Export_Amount;

        $New_Import_ID = "SELECT `import_ID` FROM `import` WHERE Breed_ID = $New_Breed_ID ORDER BY `import_ID` DESC LIMIT 1";

        $New_ImportID_Result = mysqli_query($conn , $New_Import_ID);

        while($row = $New_ImportID_Result->fetch_assoc()) {
            $New_Import_ID_For_New_Remain = $row['import_ID']; //นี่คือค่า Remain_Amount ล่าสุดของสายพันธุ์ใหม่
        }


        //เพิ่มค่า remain ของสายพันธุ์ใหม่
        $New_remain_result = "  INSERT INTO `remain`(`Remain_Amount`, `Import_ID`, `Export_ID`) 
                                VALUES ('$New_Latest_Remain_Amount','$New_Import_ID_For_New_Remain' , '$Export_ID' )";
        mysqli_query($conn, $New_remain_result);

        /*
        echo "เข้าเงื่อนไข ค่าคงเหลือล่าสุดของสายพันธุ์ใหม่ เหลือมากกว่าค่าการนำออก <br>";
        echo "New_Remain_Amount : " . $New_Remain_Amount . "=" . $Old_Remain_Amount . "+" . $Old_Export_Amount . "<br>";
        echo "Old_remain_result : " . $Old_remain_result . "<br>";
        echo "New_Latest_Remain_Amount : " . $New_Latest_Remain_Amount . "=" . $Latest_Remain_Amount . "-" . $New_Export_Amount . "<br>";
        echo "New_remain_result : " . $New_remain_result . "<br>";
        echo "จบ เงื่อนไข ค่าคงเหลือล่าสุดของสายพันธุ์ใหม่ เหลือมากกว่าค่าการนำออก <br><br>";
        */

    } else {
        //แต่ถ้าหากค่าคงเหลือล่าสุดของสายพันธุ์ใหม่ น้อยกว่าค่านำออกที่แก้ไขส่งมา ให้แจ้ง error และเปลี่ยนหน้าทันที
        echo"
            <script>
            document.addEventListener('DOMContentLoaded', function() {
                let modal = document.getElementById('errorModal');
                modal.style.display = 'block';
            });
            </script>
        ";

        // ปิดการเชื่อมต่อ
        mysqli_close($conn);

        // เปลี่ยนหน้า
        echo '<meta http-equiv="refresh" content="3; url=Admin_ManageExport.php">';
    }
    
} elseif ( $New_Export_Amount != $Old_Export_Amount AND $Breed_ID === $Old_Breed_ID) {
    //2. แต่ถ้าไม่ได้เปลี่ยนสายพันธุ์ แต่เปลี่ยนแค่จำนวน ให้คำนวนค่าใหม่ของ remain
    //echo "เข้าขั้นตอนการเปลี่ยนจำนวน" ;
    //ถ้า ค่าใหม่ มากกว่า ค่าเก่า ให้เอาค่าใหม่ ลบเก่า จะได้ค่าที่ต้อง + เพิ่มใน Remain_Amount
    if ($New_Export_Amount > $Old_Export_Amount) {
        $Difference = $New_Export_Amount - $Old_Export_Amount;
        $New_Remain_Amount = $Old_Remain_Amount - $Difference;
        //echo "New_Import_Amount ในค่าใหม่ มากกว่า ค่าเก่า $New_Import_Amount <br><br>";
    }
    
    //ถ้า ค่าใหม่ น้อยกว่า ค่าเก่า ให้เอาค่าเก่า ลบใหม่ จะได้ค่าที่ต้อง - ออกจาก Remain_Amount
    else if ($New_Export_Amount < $Old_Export_Amount) {
        $Difference = $Old_Export_Amount - $New_Export_Amount;
        $New_Remain_Amount = $Old_Remain_Amount + $Difference;
        //echo "New_Import_Amount ในค่าใหม่ น้อยกว่า ค่าเก่า $New_Import_Amount <br><br>";
    }

    //เพิ่มเพียงค่า remain amount เพราะสายพันธุ์ไม่เปลี่ยน
    $New_remain_result = "  INSERT INTO `remain`(`Remain_Amount`,`Import_ID`, `Export_ID`) 
                            VALUES ('$New_Remain_Amount','$Old_Import_ID','$Export_ID') ";
    mysqli_query($conn, $New_remain_result);

    /*
    echo "เข้าเงื่อนไข ไม่ได้เปลี่ยนสายพันธุ์ แต่เปลี่ยนแค่จำนวน ให้คำนวนค่าใหม่ของ remain <br>";
    echo "Difference : " . $Difference . "<br>";
    echo "New_Remain_Amount : " . $New_Remain_Amount . "=" . $Old_Export_Amount . "และ" . $New_Export_Amount . "<br>";
    echo "New_remain_result : " . $New_remain_result . "<br>";
    echo "จบ เงื่อนไข ไม่ได้เปลี่ยนสายพันธุ์ แต่เปลี่ยนแค่จำนวน ให้คำนวนค่าใหม่ของ remain <br><br>";
    */
}

// เริ่ม คำนวนค่า total ในตาราง total ใหม่--------------------------------------------------
if(($Breed_ID != $Old_Breed_ID) or ($New_Export_Amount != $Old_Export_Amount)) {
    $sql1 = "   SELECT
                    r1.*,
                    b.Breed_Name
                FROM remain r1
                INNER JOIN import i ON r1.import_ID = i.import_ID
                INNER JOIN breed b ON i.Breed_ID = b.Breed_ID
                JOIN (
                    SELECT
                        i.Breed_ID,
                        MAX(r2.Remain_Date) AS max_date
                    FROM remain r2
                    INNER JOIN import i ON r2.import_ID = i.import_ID
                    GROUP BY i.Breed_ID
                ) AS subquery ON i.Breed_ID = subquery.Breed_ID AND r1.Remain_Date = subquery.max_date;
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

    /*
    echo "คำนวนค่า total <br>";
    echo "sql1 : " . $sql1 . "<br>";
    echo "total_amount : " . $total_amount . "<br>";
    echo "sql2 : " . $sql2 . "<br>";
    echo "จบ คำนวนค่า total <br><br>";
    */
}
// จบ คำนวนค่า total ในตาราง total ใหม่ --------------------------------------------------

$Update_Export_SQL = "  UPDATE `export` SET
                        `Export_Date`='$Export_Date',
                        `Export_Amount`='$New_Export_Amount',
                        `Export_Details`='$Export_Details'
                        WHERE `Export_ID` = $Export_ID
                    ";
                    mysqli_query($conn, $Update_Export_SQL);

    /*
    echo "Update_Export_SQL <br>";
    echo "Update_Export_SQL : " . $Update_Export_SQL . "<br>";
    echo "จบ Update_Export_SQL <br><br>";
    */
}

    // ปิดการเชื่อมต่อ
    mysqli_close($conn);

    // เปลี่ยนหน้า
    echo '<meta http-equiv="refresh" content="0; url=Admin_ManageExport.php">';
?>
<div id="errorModal" style="display:none; position:fixed; top:30%; left:50%; transform:translate(-50%, -50%);
                             background-color:white; padding:20px; border:1px solid #ccc; z-index:1000; box-shadow: 0 0 10px rgba(0,0,0,0.5);">
    <p style="color:red;">❌ จำนวนไก่ไข่ไม่ถูกต้อง</p>
    <p>จำนวนไก่ไข่ที่นำออกมีมากกว่าจำนวนที่เหลือ</p>
    <a>โปรดระบุจำนวนไก่ไข่ที่นำออกให้ถูกต้อง</a>
</div>