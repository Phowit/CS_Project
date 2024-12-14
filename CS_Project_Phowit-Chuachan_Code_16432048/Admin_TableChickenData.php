<div class="col-sm-12 col-xl-12 p-4">
    <div class="bg-light rounded h-100 p-3">
        <h6 class="mb-4">ข้อมูลไก่ไข่</h6>
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <button class="nav-link active col-3" id="nav-Import-tab" data-bs-toggle="tab"
                    data-bs-target="#nav-Import" type="button" role="tab" aria-controls="nav-Import"
                    aria-selected="true">การนำเข้าไก่ไข่
                </button>

                <button class="nav-link col-3" id="nav-Export-tab" data-bs-toggle="tab"
                    data-bs-target="#nav-Export" type="button" role="tab"
                    aria-controls="nav-Export" aria-selected="false">การส่งออกไก่ไข่
                </button>

                <button class="nav-link col-3" id="nav-remain-tab" data-bs-toggle="tab"
                    data-bs-target="#nav-remain" type="button" role="tab"
                    aria-controls="nav-remain" aria-selected="false">คงเหลือ
                </button>

                <button class="nav-link col-3" id="nav-total-tab" data-bs-toggle="tab"
                    data-bs-target="#nav-total" type="button" role="tab"
                    aria-controls="nav-total" aria-selected="false">ภาพรวม
                </button>
            </div>
        </nav>

        <div class="tab-content pt-3" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-Import" role="tabpanel" aria-labelledby="nav-Import-tab">
            <?php
                require_once("Admin_TableImport.php");
            ?>
            </div>

            <div class="tab-pane fade" id="nav-Export" role="tabpanel" aria-labelledby="nav-Export-tab">
                <a>2</a>
            </div>

            <div class="tab-pane fade" id="nav-remain" role="tabpanel" aria-labelledby="nav-remain-tab">
                <a>3</a>
            </div>

            <div class="tab-pane fade" id="nav-total" role="tabpanel" aria-labelledby="nav-total-tab">
                <a>4</a>
            </div>
        </div>
    </div>
</div>