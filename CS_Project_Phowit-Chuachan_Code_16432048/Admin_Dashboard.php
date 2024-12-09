<?php
require_once("connect_db.php");
?>
<!-- progress start-->
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-6 col-xl-3">
            <div class="bg-light rounded h-100 p-3">
                <img src="My_img/silos.png" alt="" style="width: 40px; height: 40px; margin-right:10px;">
                <h6 class="mb-1 text-dark">สถานะ : เซอร์โวมอเตอร์ </h6>
                <small>(ระบบให้อาหาร)</small>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" role="switch" id="#" style="width:75%; height:50px;">
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3">
            <div class="bg-light rounded h-100 p-3">
                <img src="My_img/water1.png" alt="" style="width: 40px; height: 40px; margin-right:10px;">
                <h6 class="mb-1 text-dark">สถานะ : วาล์วน้ำดื่ม</h6>
                <small>(ระบบน้ำดื่ม)</small>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" role="switch" id="#" style="width:75%; height:50px;">
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3">
            <div class="bg-light rounded h-100 p-3">
                <img src="My_img/sprinkler.png" alt="" style="width: 40px; height: 40px; margin-right:10px;">
                <h6 class="mb-1 text-dark">สถานะ : วาล์วน้ำลดอุณหภูมิ</h6>
                <small>(ควบคุมสปิงึ์เกอร์)</small>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" role="switch" id="#" style="width:75%; height:50px;">
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3">
            <div class="bg-light rounded h-100 p-3">
                <img src="My_img/tank.png" alt="" style="width: 40px; height: 40px; margin-right:10px;">
                <h6 class="mb-1 text-dark">สถานะ : วาล์วเก็บอาหารเสริม</h6>
                <small>(อาหารเสริม)</small>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" role="switch" id="#" style="width:75%; height:50px;">
                </div>
            </div>
        </div>
    </div>
</div>

<!-- show from database end -->