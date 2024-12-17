<div class="col-sm-12 col-xl-12 p-4">
    <div class="bg-light rounded h-100 p-3">
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <button class="nav-link active col-4" id="nav-Import-tab" data-bs-toggle="tab"
                    data-bs-target="#nav-Import" type="button" role="tab" aria-controls="nav-Import"
                    aria-selected="true">ข้อมูลการนำเข้า ส่งออก ไก่ไข่ของคุณ
                </button>

                <button class="nav-link col-4" id="nav-Export-tab" data-bs-toggle="tab"
                    data-bs-target="#nav-Export" type="button" role="tab"
                    aria-controls="nav-Export" aria-selected="false">ข้อมูลการนำเข้า ส่งออก ไก่ไข่ผู้ใช้อื่น
                </button>

                <button class="nav-link col-4" id="nav-remain-tab" data-bs-toggle="tab"
                    data-bs-target="#nav-remain" type="button" role="tab"
                    aria-controls="nav-remain" aria-selected="false">ภาพรวม
                </button>
            </div>
        </nav>

        <div class="tab-content pt-3" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-Import" role="tabpanel" aria-labelledby="nav-Import-tab">
            <?php
                require_once("Admin_CardChicken.php");
            ?>
            </div>

            <div class="tab-pane fade" id="nav-Export" role="tabpanel" aria-labelledby="nav-Export-tab">
            <?php
                require_once("Admin_CardChicken2.php");
            ?>
            </div>

            <div class="tab-pane fade" id="nav-remain" role="tabpanel" aria-labelledby="nav-remain-tab">
                <a>3</a>
            </div>
        </div>
    </div>
</div>