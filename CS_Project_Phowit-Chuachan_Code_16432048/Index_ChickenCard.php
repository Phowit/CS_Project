<div class="container-fluid pt-4 px-4">
    <div class="d-flex align-items-center justify-content-between mb-4">
        <h6 class="mb-0">ข้อมูลสายพันธุ์ไก่</h6>
    </div>
    <div class="row">
        <?php
        require_once("connect_db.php");
        $sql = "SELECT * FROM breed;";
        $result = mysqli_query($conn, $sql);

        while ($row = $result->fetch_assoc()) {
            $Breed_Name = $row['Breed_Name'];
            $Breed_Description = $row['Breed_Description'];
            $Breed_Img = $row['Breed_Img'];
            $base64Image = base64_encode($Breed_Img); // แปลง BLOB เป็น Base64
        ?>
            <div class="col-sm-4 col-xl-4" style="margin-bottom: 5px;">
                <div class="bg-light rounded h-100 p-4">
                    <div class="row">
                        <h6 class="mb-4"><?php echo $Breed_Name; ?></h6>
                        <div class="col-sm-12 col-xl-12 text-center">
                            <?php echo "<img src='data:image/jpeg;base64,$base64Image' alt='Breed_Img' style='width: auto; height: 150px; border-radius: 5px;'>"; ?>
                        </div>

                        <div class="col-sm-12 col-xl-12">
                            <a><?php echo $Breed_Description; ?></a>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?> <!-- close php-->
    </div>
</div>