<!-- Page header -->
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <h2 class="page-title text-muted">
                    <a class='text-blue' href="<?php echo site_url("building"); ?>">Building</a>/
                    <?php echo (!empty($this->uri->segment(2))) ? "Edit building" : "Create new building"; ?>
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
                        <input type="hidden" id="inBld" name="inBld" value="<?php echo (!empty($this->uri->segment(2))) ? $this->uri->segment(2) : ""; ?>" />

                        <div class="card-body">
                            <h2 class="mb-4">Building</h2>
                            <div class="row g-3">
                                <div class="col-md">
                                    <?php _label("Type"); ?>
                                    <select class="form-select tomselected " id="inType" name="inType" required>
                                        <option value="">เลือกข้อมูล</option>
                                        <?php foreach ($building_type as $t) { ?>
                                            <?php $sel = (!empty($row["building_type_id"]) && $row["building_type_id"] == $t["building_type_id"]) ? "selected" : ""; ?>
                                            <option value="<?php echo $t["building_type_id"] ?>" <?php echo $sel ?>><?php echo $t["building_type_name"] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md">
                                    <?php _label("Name"); ?>
                                    <input type="text" class="form-control " id="inName" name="inName" value="<?php echo (!empty($row["building_name"])) ? $row["building_name"] : ""; ?>" required />
                                </div>
                            </div>
                            <div class="row g-3">
                                <div class="col-md">
                                    <?php _label("Detail"); ?>
                                    <input type="text" class="form-control " id="inDetail" name="inDetail" value="<?php echo (!empty($row["building_descriptions"])) ? $row["building_descriptions"] : ""; ?>" required />
                                </div>
                            </div>
                            <div class="row g-3">
                                <div class="col-md">
                                    <?php _label("year received"); ?>
                                    <input type="number" class="form-control" id="inReceive" name="inReceive" value="<?php echo (!empty($row["building_purchase_year"])) ? $row["building_purchase_year"] : ""; ?>"  min="0" required />
                                </div>

                                <div class="col-md">
                                    <?php _label("State"); ?>
                                    <select type="text" class="form-select tomselected " id="inStatus" name="inStatus" required>
                                        <option value="">เลือกข้อมูล</option>
                                        <?php $blood = array("ปกติ", "ไม่ได้ใช้งาน"); ?>
                                        <?php foreach ($blood as $b) { ?>
                                            <?php $sel = (!empty($row["building_status"]) && $row["building_status"] == $b) ? "selected" : ""; ?>
                                            <option value="<?php echo $b ?>" <?php echo $sel ?>><?php echo $b ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
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
    $("#insert-form").submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: " <?php echo site_url("BuildingController/update_building") ?>",
            data: $(this).serialize(),
        }).done(function(data) {
            alert ("บันทึกข้อมูลสำเร็จ");
            //$("#inFirstName").addClass("is-invalid");
            location.reload();
        });
    });
</script>