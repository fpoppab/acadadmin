<!-- Page header -->
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <h2 class="page-title text-muted">
                    <a class='text-blue' href="<?php echo site_url("room"); ?>">Room and Homeroom</a>/
                    <?php echo (!empty($this->uri->segment(2))) ? "Edit room" : "Create new room"; ?>
                </h2>
            </div>
        </div>
    </div>
</div>
<!-- Page body -->
<div class="page-body">
    <div class="container-xl">
        <div class="card">
            <div class="row g-0">
                <div class="col d-flex flex-column">
                    <form id="insert-form" method="post" autocomplete="off" enctype="multipart/form-data">
                        <input type="hidden" id="inRoomId" name="inRoomId"
                            value="<?php echo (!empty($this->uri->segment(2))) ? $this->uri->segment(2) : ""; ?>" />
                        <div class="card-body">
                            <h2 class="mb-4">Room</h2>
                            <div class="row g-3">
                                <div class="col-md">
                                    <?php _label("Class name", "required"); ?>
                                    <select class="form-select  " id="inClssId" name="inClssId" required>
                                        <option value="">เลือกข้อมูล</option>
                                        <?php foreach ($clss as $c) { ?>
                                            <?php $sel = (!empty($row["clss_id"]) && $row["clss_id"] == $c["clss_id"]) ? "selected" : ""; ?>
                                            <option value="<?= $c["clss_id"]; ?>" <?= $sel; ?>>
                                                <?= $c["clss_name"] ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md">
                                    <?php _label("Educatioin plan", "required"); ?>
                                    <select class="form-select" id="inPlanId" name="inPlanId" required>
                                        <option value="">เลือกข้อมูล</option>
                                        <?php foreach ($plan as $p) { ?>
                                            <?php $sel = (!empty($row["ed_plan_id"]) && $row["ed_plan_id"] == $p["ed_plan_id"]) ? "selected" : ""; ?>
                                            <option value="<?= $p["ed_plan_id"]; ?>" <?= $sel; ?>>
                                                <?= $p["ed_plan_name"] ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md">
                                    <?php _label("Room number", "required"); ?>
                                    <input type="number" class="form-control " id="inRoomNumber" name="inRoomNumber"
                                        value="<?php echo (!empty($row["number"])) ? $row["number"] : ""; ?>" min="0"
                                        max="100" required />
                                </div>
                            </div>
                            <br />
                            <p class="text-danger">* ต้องกรอกข้อมูล</p>
                        </div>
                        <div class="card-body">
                            <h2 class="mb-4">Homeroom teacher</h2>
                            <div class="row g-3" style="overflow: scroll;">
                                <?php foreach ($personnel as $p) { ?>
                                    <div class="col-md-3">
                                        <label class="form-selectgroup-item flex-fill">
                                            <input type="checkbox" name="inPersonnel[]" value="<?= $p["personel_regis_id"]?>"
                                                class="form-selectgroup-input">
                                            <div class="form-selectgroup-label d-flex align-items-center p-2">
                                                <div class="me-3">
                                                    <span class="form-selectgroup-check"></span>
                                                </div>
                                                <div class="form-selectgroup-label-content d-flex align-items-center">
                                                    <span class="avatar me-2"
                                                        style="background-image: url(<?= $p["personnel_profile_image"]?>)"></span>
                                                    <div>
                                                        <div class="font-weight-medium"><?= $p["personnel_fullname"]?></div>
                                                        <div class="text-secondary"><?= $p["type_name"]?></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </label>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent mt-auto">
                            <div class="btn-list justify-content-end">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $("#insert-form").submit(function (e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "<?= site_url("SchoolController/update_room") ?>",
            data: $(this).serialize(),
        }).done(function (data) {
            alert(data);
            location.reload();
        });
    });
</script>