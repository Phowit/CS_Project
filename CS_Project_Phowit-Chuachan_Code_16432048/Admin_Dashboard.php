<?php
require_once("connect_db.php");
?>
<!-- progress start-->
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-6 col-xl-3">
            <div class="bg-light rounded h-100 p-3">
                <div style="height:120px;" class="text-center">
                    <img src="My_img/silos.png" alt="" style="width: 50px; height: 50px;">
                    <h6 class="mb-1 text-dark">เซอร์โวมอเตอร์ </h6>
                    <small>(ระบบให้อาหาร)</small>
                </div>

                <div class="form-switch text-center">
                    <input class="form-check-input" type="checkbox" role="switch" id="#" style="width:50px; height:30px;">
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3">
            <div class="bg-light rounded h-100 p-3">
                <div style="height:120px;" class="text-center">
                    <img src="My_img/water1.png" alt="" style="width: 50px; height: 50px;">
                    <h6 class="mb-1 text-dark">วาล์วน้ำดื่ม</h6>
                    <small>(ระบบน้ำดื่ม)</small>
                </div>

                <div class="form-switch text-center">
                    <input class="form-check-input" type="checkbox" role="switch" id="#" style="width:50px; height:30px;">
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3">
            <div class="bg-light rounded h-100 p-3">
                <div style="height:120px;" class="text-center">
                    <img src="My_img/sprinkler.png" alt="" style="width: 50px; height: 50px;">
                    <h6 class="mb-1 text-dark">วาล์วน้ำลดอุณหภูมิ</h6>
                    <small>(ควบคุมสปิงเกอร์)</small>
                </div>

                <div class="form-switch text-center">
                    <input class="form-check-input" type="checkbox" role="switch" id="#" style="width:50px; height:30px;">
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3">
            <div class="bg-light rounded h-100 p-3">
                <div style="height:120px;" class="text-center">
                    <img src="My_img/tank.png" alt="" style="width: 50px; height: 50px;">
                    <h6 class="mb-1 text-dark">วาล์วเก็บอาหารเสริม</h6>
                    <small>(อาหารเสริม)</small>
                </div>

                <div class="form-switch text-center">
                    <input class="form-check-input" type="checkbox" role="switch" id="#" style="width:50px; height:30px;">
                </div>
            </div>
        </div>
    </div>
</div>

<!-- show from database end -->