<?php
    // เชื่อมต่อกับฐานข้อมูล
    require_once("connect_db.php");

    // รับข้อมูลจากฟอร์ม
    $User_ID = $_POST['User_ID'];
    $Old_User_Password = $_POST['Old_User_Password'];
    $New_User_Password = $_POST['New_User_Password'];

    $sql = "SELECT `User_Password` FROM `user` WHERE `User_ID` = $User_ID";

    $result = mysqli_query($conn, $sql); // รับผลลัพธ์จากฐานข้อมูล

    while ($row = $result->fetch_assoc()) {
        $User_Password = $row['User_Password'];
    }
    if($User_Password === $Old_User_Password) {
        $sqli = "UPDATE user SET User_Password = '$New_User_Password' WHERE `User_ID` = $User_ID";
        mysqli_query($conn, $sqli);

        echo"

            <script>
            document.addEventListener('DOMContentLoaded', function() {
                let modal = document.getElementById('successModal');
                modal.style.display = 'block';
            });
            </script>
        ";
    }else {
        echo"

            <script>
            document.addEventListener('DOMContentLoaded', function() {
                let modal = document.getElementById('errorModal');
                modal.style.display = 'block';
            });
            </script>
        ";
    }

    // ปิดการเชื่อมต่อ
    mysqli_close($conn);

    // เปลี่ยนหน้า
    echo '<meta http-equiv="refresh" content="2; url=User_Data.php">';
?>
<!-- Modal error-->
<div id="errorModal" style="display:none; position:fixed; top:30%; left:50%; transform:translate(-50%, -50%);
                             background-color:white; padding:20px; border:1px solid #ccc; z-index:1000; box-shadow: 0 0 10px rgba(0,0,0,0.5);">
    <p style="color:red;">❌ รหัสผ่านเดิมไม่ถูกต้อง</p>
    <a>โปรดลองใหม่อีกครั้งภายหลัง</a>
</div>

<!-- Modal success-->
<div id="successModal" style="display:none; position:fixed; top:30%; left:50%; transform:translate(-50%, -50%);
                             background-color:white; padding:20px; border:1px solid #ccc; z-index:1000; box-shadow: 0 0 10px rgba(0,0,0,0.5);">
    <p style="color:green;">✅ รหัสผ่านเดิมถูกต้อง</p>
    <a>ทำการเปลี่ยนรหัสผ่านสำเร็จ</a>
</div>