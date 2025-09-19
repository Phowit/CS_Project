<div class="container-fluid pt-4 px-4">
    <div class="h-100 bg-light rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-2">
            <h6 class="mb-0">แผงควบคุม</h6>
        </div>
        <div class="table-responsive p-1">
            <?php
            require_once("connect_db.php");
            $sql = "SELECT * FROM `datacontrol` ORDER BY `DateControl_ID` DESC LIMIT 1";
            $result = mysqli_query($conn, $sql);

            $sql0 = "SELECT * FROM `timefood`";
            $result0 = mysqli_query($conn, $sql0);

            $sql1 = "SELECT * FROM `timewater`";
            $result1 = mysqli_query($conn, $sql1);
            ?>
            <table class="table text-start align-middle table-bordered mb-0">
                <thead>
                    <tr class="text-dark">
                        <th scope="col" class="col-3">ระดับอุณหภูมิ</th>
                        <th scope="col" class="col-3">เวลาให้อาหารเสริม</th>
                        <th scope="col" class="col-3">
                            <div class="row">
                                <div class="col-8">
                                    เวลาให้น้ำไก่
                                </div>
                                <button type="button" class="btn btn-warning p-1" data-bs-toggle="modal"
                                    data-bs-target="#addTimeWaterModal" style="height: 30px; width: 70px; font-size: 12px;">เพิ่มข้อมูล
                                </button>

                                <!--Start add-->
                                <div class="modal fade" id="addTimeWaterModal" tabindex="-1" aria-labelledby="addTimeWaterModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-sm">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="addTimeWaterModalLabel<">เพิ่มเวลาให้น้ำไก่</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>

                                            <div class="modal-body">
                                                <!-- Form for Editing Record -->

                                                <form id="addTimeWaterModalForm" action="Insert_TimeWater.php" method="post">

                                                    <div class="form-floating mb-3">
                                                        <input type="time" class="form-control" name="TimeWater" placeholder required>
                                                        <label for="TimeWater" class="form-label">วัน เวลา</label>
                                                    </div>

                                                    <button type="submit" class="btn btn-primary md-4">บันทึก</button>
                                                    <button type="reset" class="btn btn-primary md-4" value="Reset">ล้างข้อมูล</button>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--End add-->
                            </div>
                        </th>



                        <th scope="col" class="col-3">
                            <div class="row">
                                <div class="col-8">
                                    เวลาให้อาหาร
                                </div>
                                <button type="button" class="btn btn-warning p-1" data-bs-toggle="modal"
                                    data-bs-target="#addTimeFoodModal" style="height: 30px; width: 70px; font-size: 12px;">เพิ่มข้อมูล
                                </button>

                                <!--Start add-->
                                <div class="modal fade" id="addTimeFoodModal" tabindex="-1" aria-labelledby="addTimeFoodModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-sm">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="addTimeFoodModalLabel<">เพิ่มเวลาให้อาหารไก่</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>

                                            <div class="modal-body">
                                                <!-- Form for Editing Record -->

                                                <form id="addTimeFoodModalForm" action="Insert_TimeFood.php" method="post">

                                                    <div class="form-floating mb-3">
                                                        <input type="time" class="form-control" name="TimeFood" placeholder required>
                                                        <label for="TimeFood" class="form-label">วัน เวลา</label>
                                                    </div>

                                                    <button type="submit" class="btn btn-primary md-4">บันทึก</button>
                                                    <button type="reset" class="btn btn-primary md-4" value="Reset">ล้างข้อมูล</button>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--End add-->
                            </div>

                        </th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    while ($row = $result->fetch_assoc()) {
                        $DateControl_ID = $row['DateControl_ID'];
                        $Temperature_range = $row['Temperature_range'];
                        $TimeFoodS = date_create_from_format(format: "Y-m-d H:i:s", datetime: $row["TimeFoodS"]) ->format(format: "d/m/Y H:i");
                    ?>
                        <tr style="font-size: 13px;">
                            <td>
                                <form action="Update_Temperature_range.php" method="post">
                                    <div class="form-floating">
                                        <div class="row" style="height: 50px;">
                                            <div class="col-8 pt-3">
                                                <h5><?php echo $Temperature_range; ?>°C</h5>
                                            </div>
                                            <div class="col-4">
                                                <button type="submit" class="btn float-end">
                                                    <img src='My_img/save.png' style='width: auto; height: 30px;'>
                                                </button>
                                            </div>
                                        </div>
                                        <input type="number" class="form-control" name="Temperature_range" id="Temperature_range">
                                    </div>
                                </form>
                                <a>(สปิงค์เกอร์จะทำงาน เมื่ออุณหภูมิถึงระดับที่กำหนด)</a>
                            </td>

                            <td>
                                <form action="Update_TimeFoodS.php" method="post">
                                    <div class="form-floating">
                                        <div class="row" style="height: 50px;">
                                            <div class="col-8 pt-3">
                                                <a><?php echo $TimeFoodS; ?></a>
                                            </div>
                                            <div class="col-4">
                                                <button type="submit" class="btn float-end">
                                                    <img src='My_img/save.png' style='width: auto; height: 30px;'>
                                                </button>
                                            </div>
                                        </div>
                                        <input type="Datetime-local" class="form-control" name="TimeFoodS" id="TimeFoodS">
                                    </div>
                                </form>
                                <a>(ให้อาหารเสริม ตามวัน และเวลาที่กำหนด)</a>
                            </td>

                            <td>
                                <?php
                                // ดึงค่าจากผลลัพธ์ทีละแถว
                                while ($row = $result1->fetch_assoc()) {
                                    $TimeWater_ID = $row['TimeWater_ID']; // เพิ่มค่า TimeFood 
                                    $TimeWater = $row['TimeWater'];
                                ?>
                                    <a style="font-size:15px;"><?php echo $TimeWater; ?></a>
                                    <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#EditTimeWaterModal<?= $TimeWater_ID; ?>">
                                        <i class='far fa-edit' style='color:blue; font-size:16px;'></i>
                                    </button>

                                    <!--Start Edit-->
                                    <div class="modal fade" id="EditTimeWaterModal<?= $TimeWater_ID; ?>" tabindex="-1" aria-labelledby="EditTimeWaterModal<?= $TimeWater_ID; ?>" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-sm">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="EditTimeWaterModal<?= $TimeWater_ID; ?>">แก้ไขข้อมูล</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <!-- Form for Editing Import ทดสอบ การแก้ไขข้อมูลการนำเข้าไก่ไข่ครั้งที่ 1 -->
                                                    <form id="EditTimeFoodForm" action="Update_TimeWater.php" method="post">
                                                        <input type="hidden" class="form-control" name="TimeWater_ID" id="TimeWater_ID" value="<?php echo $TimeWater_ID; ?>" readonly>

                                                        <div class="row">
                                                            <div class="col-8">
                                                                <div class="form-floating">
                                                                    <input type="time" class="form-control" name="TimeWater" id="TimeFood" value="<?php echo $TimeWater; ?>" placeholder required>
                                                                    <label for="TimeWater" class="form-label">เวลาให้น้ำไก่</label>
                                                                </div>
                                                            </div>

                                                            <div class="col-4">
                                                                <button type="submit" class="btn btn-primary float-end" style="margin-top: 20px; margin-right:10px">บันทึก</button>
                                                            </div>
                                                        </div><br>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--End Edit-->

                                    <button class="btn" data-bs-toggle="modal" onclick="TimeWaterID(<?= $TimeWater_ID; ?>)"
                                        data-bs-target="#confirmDeleteWaterModal">
                                        <i class='material-icons' style='color:red; font-size:20px;'>delete</i>
                                    </button>

                                    <!--Start Waring For Delete-->
                                    <div class="modal fade" id="confirmDeleteWaterModal" tabindex="-1" aria-labelledby="confirmDeleteWaterModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-sm">
                                            <div class="modal-content">

                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="confirmDeleteWaterModalLabel">ยืนยันการลบข้อมูล</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>

                                                <div class="modal-body">
                                                    <p>ต้องการจะลบข้อมูลนี้หรือไม่ ?</p>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                                                    <button type="button" class="btn btn-warning" onclick="deleteTimeWater()">ยืนยัน</button>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <!--END Warning For Delete-->
                                    <br>
                                <?php   }   ?>
                            </td>

                            <td>
                                <?php
                                // ดึงค่าจากผลลัพธ์ทีละแถว
                                while ($row = $result0->fetch_assoc()) {
                                    $TimeFood_ID = $row['TimeFood_ID']; // เพิ่มค่า TimeFood 
                                    $TimeFood = $row['TimeFood'];
                                ?>
                                    <a style="font-size:15px;"><?php echo $TimeFood; ?></a>
                                    <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#EditTimeFoodModal<?= $TimeFood_ID; ?>">
                                        <i class='far fa-edit' style='color:blue; font-size:16px;'></i>
                                    </button>

                                    <!--Start Edit-->
                                    <div class="modal fade" id="EditTimeFoodModal<?= $TimeFood_ID; ?>" tabindex="-1" aria-labelledby="EditTimeFoodModalLabel<?= $TimeFood_ID; ?>" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-sm">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="EditTimeFoodModalLabel<?= $TimeFood_ID; ?>">แก้ไขข้อมูล</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <!-- Form for Editing Import ทดสอบ การแก้ไขข้อมูลการนำเข้าไก่ไข่ครั้งที่ 1 -->
                                                    <form id="EditTimeFoodForm" action="Update_TimeFood.php" method="post">
                                                        <input type="hidden" class="form-control" name="TimeFood_ID" id="TimeFood_ID" value="<?php echo $TimeFood_ID; ?>" readonly>

                                                        <div class="row">
                                                            <div class="col-8">
                                                                <div class="form-floating">
                                                                    <input type="time" class="form-control" name="TimeFood" id="TimeFood" value="<?php echo $TimeFood; ?>" placeholder required>
                                                                    <label for="TimeFood" class="form-label">เวลาให้อาหาร</label>
                                                                </div>
                                                            </div>

                                                            <div class="col-4">
                                                                <button type="submit" class="btn btn-primary float-end" style="margin-top: 20px; margin-right:10px">บันทึก</button>
                                                            </div>
                                                        </div><br>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--End Edit-->

                                    <button class="btn" data-bs-toggle="modal" onclick="TimeFoodID(<?= $TimeFood_ID; ?>)"
                                        data-bs-target="#confirmDeleteModal">
                                        <i class='material-icons' style='color:red; font-size:20px;'>delete</i>
                                    </button>

                                    <!--Start Waring For Delete-->
                                    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-sm">
                                            <div class="modal-content">

                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="confirmDeleteModalLabel">ยืนยันการลบข้อมูล</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>

                                                <div class="modal-body">
                                                    <p>ต้องการจะลบข้อมูลนี้หรือไม่ ?</p>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                                                    <button type="button" class="btn btn-warning" onclick="deleteTimeFood()">ยืนยัน</button>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <!--END Warning For Delete-->
                                    <br>
                                <?php   }   ?>
                            </td>
                        </tr>
                    <?php } ?> <!-- close php-->
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    // Get the modal
    var modal = document.getElementById("myModal");

    // Get the button that opens the modal
    var btn = document.getElementById("myBtn");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("btn-close")[0];

    // When the user clicks on the button, open the modal
    btn.onclick = function() {
        modal.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>

<script>
    var TimeFoodID;

    // ฟังก์ชันเพื่อรับค่า TimeFoodID เมื่อคลิกที่ปุ่ม "ลบ"
    function TimeFoodID(TimeFood_ID) {
        TimeFoodID = TimeFood_ID;
    }

    function deleteTimeFood() {

        // ถ้ายืนยันการลบ ทำการ redirect ไปยังไฟล์ Delete_TimeFood.php พร้อมส่งค่า id ของแถวที่ต้องการลบ
        window.location.href = "Delete_TimeFood.php?id=" + TimeFoodID;

    }
</script>

<script>
    var TimeWaterID;

    // ฟังก์ชันเพื่อรับค่า member_ID เมื่อคลิกที่ปุ่ม "ลบ"
    function TimeWaterID(TimeWater_ID) {
        TimeWaterID = TimeWater_ID;
    }

    function deleteTimeWater() {

        // ถ้ายืนยันการลบ ทำการ redirect ไปยังไฟล์ Delete_TimeWater.php พร้อมส่งค่า id ของแถวที่ต้องการลบ
        window.location.href = "Delete_TimeWater.php?id=" + TimeWaterID;

    }
</script>