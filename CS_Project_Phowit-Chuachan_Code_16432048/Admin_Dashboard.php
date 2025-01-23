<?php
require_once("connect_db.php");
?>
<!-- progress start-->
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-6 col-xl-3">
            <div class="bg-light rounded h-100 p-3">
                <div class="text-center">
                    <img src="My_img/silos.png" style="width: 50px; height: 50px;">
                    <h6 class="mb-1 text-dark">ระบบให้อาหาร </h6>
                </div>

                <div class="row">
                    <div class="col-3"> ปิด </div>

                    <div class="col-6">
                        <div class="form-switch text-center">
                            <input class="form-check-input" type="checkbox" role="switch" id="#" style="width:50px; height:30px;">
                        </div>
                    </div>

                    <div class="col-3"> เปิด </div>
                </div>
                
            </div>
        </div>

        <div class="col-sm-6 col-xl-3">
            <div class="bg-light rounded h-100 p-3">
                <div class="text-center">
                    <img src="My_img/water1.png" style="width: 50px; height: 50px;">
                    <h6 class="mb-1 text-dark">ระบบน้ำดื่ม</h6>
                </div>

                <div class="row">
                    <div class="col-3"> ปิด </div>

                    <div class="col-6">
                        <div class="form-switch text-center">
                            <input class="form-check-input" type="checkbox" role="switch" id="#" style="width:50px; height:30px;">
                        </div>
                    </div>

                    <div class="col-3"> เปิด </div>
                </div>

            </div>
        </div>

        <div class="col-sm-6 col-xl-3">
            <div class="bg-light rounded h-100 p-3">
                <div class="text-center">
                    <img src="My_img/sprinkler.png" style="width: 50px; height: 50px;">
                    <h6 class="mb-1 text-dark">สปิงเกอร์</h6>
                </div>

                <div class="row">
                    <div class="col-3"> ปิด </div>

                    <div class="col-6">
                        <div class="form-switch text-center">
                            <input class="form-check-input" type="checkbox" role="switch" id="#" style="width:50px; height:30px;">
                        </div>
                    </div>

                    <div class="col-3"> เปิด </div>
                </div>

            </div>
        </div>

        <div class="col-sm-6 col-xl-3">
            <div class="bg-light rounded h-100 p-3">
                <div class="text-center">
                    <img src="My_img/tank.png" style="width: 50px; height: 50px;">
                    <h6 class="mb-1 text-dark">ระบบอาหารเสริม</h6>
                </div>

                <div class="row">
                    <div class="col-3"> ปิด </div>

                    <div class="col-6">
                        <div class="form-switch text-center">
                            <input class="form-check-input" type="checkbox" role="switch" id="#" style="width:50px; height:30px;">
                        </div>
                    </div>

                    <div class="col-3"> เปิด </div>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- show from database end -->