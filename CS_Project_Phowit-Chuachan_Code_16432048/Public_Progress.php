<?php
    require_once("connect_Progress.php");
?>
<!-- progress start-->
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <?php
                while ($row = $result->fetch_assoc()) {
                $FoodLevel = $row['FoodLevel'];
                $FoodSLevel = $row['FoodSLevel'];
                $FoodTrayLevel = $row['FoodTrayLevel1'];
                $FoodTrayLevel = $row['FoodTrayLevel2'];
                $T_Level = $row['T_Level'];
            ?>
                <div class="col-sm-6 col-xl-3">
                    <div class="bg-light rounded h-100 p-4">
                        <h6 class="mb-4 text-dark">ระดับอาหารหลักในถัง</h6>
                        <div class="pg-bar mb-3">
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped bg-danger" role="progressbar" aria-valuemin="0" aria-valuemax="100" id=""></div>
                            </div>
                        </div>
                        <a>ระดับ : <?php echo $row['FoodLevel']; ?> %ของถังเก็บ</a>
                    </div>
                </div>

                <div class="col-sm-6 col-xl-3">
                    <div class="bg-light rounded h-100 p-4">
                        <h6 class="mb-4 text-dark">ระดับอาหารในถาด</h6>
                        <div class="pg-bar mb-3">
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped bg-danger" role="progressbar" aria-valuenow="5" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <a>ระดับ : <?php echo $row['FoodSLevel']; ?> %ของถาดอาหาร</a>
                    </div>
                </div>

                <div class="col-sm-6 col-xl-3">
                    <div class="bg-light rounded h-100 p-4">
                        <h6 class="mb-4 text-dark">ระดับอาหารเสริม</h6>
                        <div class="pg-bar mb-3">
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped bg-danger" role="progressbar" aria-valuenow="3" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <a>ระดับ: <?php echo $row['FoodTrayLevel1']; ?>% ของกระบอกเก็บ</a>
                        <a>ระดับ: <?php echo $row['FoodTrayLevel2']; ?>% ของกระบอกเก็บ</a>
                    </div>
                </div>

                <div class="col-sm-6 col-xl-3">
                    <div class="bg-light rounded h-100 p-4">
                        <h6 class="mb-4 text-dark">ระดับอุณหภูมิ</h6>
                        <div class="pg-bar mb-3">
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped bg-danger" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <a>ระดับ : <?php echo $row['T_Level']; ?> องศาเซลเซียส</a>
                    </div>
                </div>
            </div>

            <div id="progress-bars"></div>
        <?php } ?>
    </div>

    <script>
        // ดึงข้อมูลจาก PHP
        fetch('connect_Progress.php')
            .then(response => response.json())
            .then(data => {
                data.forEach((item, index) => {
                    const Food_Progress = document.getElementById(`task${index + 1}-bar`);
                    const FoodS_Progress = document.getElementById(`task${index + 1}-bar`);
                    const FoodTray_Progress = document.getElementById(`task${index + 1}-bar`);
                    
                    // อัปเดตชื่อ Task
                    taskNameElement.textContent = item.task_name;
                    
                    // อัปเดต Progress Bar
                    progressBarElement.style.width = item.progress_percentage + '%';
                    progressBarElement.textContent = item.progress_percentage + '%';
                });
            });
    </script>
<!-- progress end -->

<!-- show from database start -->
<!--
<script type="text/javascript" src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
 <script>
$(document).ready(function(){
    $('.progress-value > span').each(function(){
        $(this).prop('Counter',0).animate({
            Counter: $(this).text()
        },{
            duration: 1500,
            easing: 'swing',
            step: function (now){
                $(this).text(Math.ceil(now));
            }
        });
    });
});
 </script>
 -->
<!-- show from database end -->