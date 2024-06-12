
<!-- Page header -->
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <h2 class="page-title text-muted">
                    <a class='text-blue' href="<?php echo site_url("learning-resources"); ?>">Learning Resources</a>/
                    <?php echo (!empty($this->uri->segment(2))) ? "Edit Learning Resources" : "Create new Learning Resources"; ?>
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
                        <input type="hidden" id="inLearningResourcesId" name="inLearningResourcesId" value="<?php echo (!empty($this->uri->segment(2))) ? $this->uri->segment(2) : ""; ?>" />
                        <div class="card-body">
                            <h2 class="mb-4">Learning Resources</h2>
                            <h3 class="card-title mt-4">Information</h3>
                            <div class="row g-3">

                            <div class="col-md">
                                    <?php _label("ชื่อแหล่งการเรียนรู้"); ?>
                                    <input type="text" class="form-control" id="inName" name="inName" value="<?php echo (!empty($row["lr_name"])) ? $row["lr_name"] : ""; ?>" required />
                                </div>
                            </div>
                            <div class="row g-3">
                            <div class="col-md">
                                    <?php _label("ประเภทแหล่งเรียนรู้"); ?>
                                    <select type="text" class="form-select tomselected " id="inType" name="inType" required>
                                        <option value="">เลือกข้อมูล</option>
                                        <?php $type = array("ภายนอก","ภายใน"); ?>
                                        <?php foreach ($type as $t) { ?>
                                            <?php $sel = (!empty($row["lr_type"]) && $row["lr_type"] == $t) ? "selected" : ""; ?>
                                            <option value="<?php echo $t ?>" <?php echo $sel ?>><?php echo $t ?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="col-md">
                                    <?php _label("สถานะของแหล่งเรียนรู้"); ?>
                                    <select type="text" class="form-select tomselected " id="instatus" name="instatus" required>
                                        <option value="">เลือกข้อมูล</option>
                                        <?php if($row["lr_status"]){?>
                                                <option value="1" selected>ใช้งานได้</option>
                                                <option value="0">ใช้งานไม่ได้</option>
                                            <?php }else{?>
                                                <option value="1" >ใช้งานได้</option>
                                                <option value="0" selected>ใช้งานไม่ได้</option>
                                        <?php }?>
                                    </select>
                                </div>
                            <div class="col-md">
                                    <?php _label("ปีที่เริ่มใช้งาน"); ?>
                                    <input type="number" class="form-control" id="inPurchase_Year" name="inPurchase_Year" minlength="1900" maxlength="3000" value="<?php echo (!empty($row["lr_purchase_year"])) ? $row["lr_purchase_year"] : ""; ?>" />
                                </div>
                            </div>
                            <div class="row g-3">
                            <div class="col-md">
                                    <?php _label("รายละเอียดแหล่งเรียนรู้"); ?>
                                    <textarea class="form-control" id="inDescriptions" name="inDescriptions" rows="2"><?php echo (!empty($row["lr_descriptions"])) ? $row["lr_descriptions"] : ""; ?></textarea>
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
            url: " <?php echo site_url("LearningResourcesController/update_learningresources") ?>",
            data: $(this).serialize(),
        }).done(function(data) {

            alert (data);
            // alert ("บันทึกสำเร็จ !!");
            //$("#inFirstName").addClass("is-invalid");
            location.reload();
        });
    });
</script>