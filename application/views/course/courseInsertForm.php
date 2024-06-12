
<!-- Page header -->
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <h2 class="page-title text-muted">
                    <a class='text-blue' href="<?php echo site_url("course"); ?>">Course</a>/
                    <?php echo (!empty($this->uri->segment(2))) ? "Edit Course" : "Create new Course"; ?>
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
                        <input type="hidden" id="inCourseId" name="inCourseId" value="<?php echo (!empty($this->uri->segment(2))) ? $this->uri->segment(2) : ""; ?>" />
                        <div class="card-body">
                            <h2 class="mb-4">Course</h2>
                            <h3 class="card-title mt-4">Information</h3>
                            <div class="row g-3">
                                <div class="col-md">
                                    <?php _label("กลุ่มสาระ"); ?>
                                    <select class="form-select tomselected " id="inGroup_Learning_id" name="inGroup_Learning_id">
                                    <option value="">เลือกข้อมูล</option>
                                        <?php foreach ($group_learning as $g) { ?>
                                            <?php $sel = (!empty($row["group_learning_id"]) && $row["group_learning_id"] == $g["group_learning_id"]) ? "selected" : ""; ?>
                                            <option value="<?php echo $g["group_learning_id"] ?>" <?php echo $sel ?>><?php echo $g["group_learning_name"] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="col-md">
                                <?php _label("ระดับชั้น"); ?>
                                <select class="form-select tomselected " id="inSchool_Class_Register_id" name="inSchool_Class_Register_id">
                                    <option value="">เลือกข้อมูล</option>
                                        <?php foreach ($school_clss as $s) { ?>
                                            <?php $sel = (!empty($row["clss_id"]) && $row["clss_id"] == $s["clss_id"]) ? "selected" : ""; ?>
                                            <option value="<?php echo $s["clss_id"] ?>" <?php echo $sel ?>><?php echo $s["clss_name"] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md">
                                    <?php _label("ชื่อวิชา"); ?>
                                    <input type="text" class="form-control" id="inName" name="inName" value="<?php echo (!empty($row["course_name"])) ? $row["course_name"] : ""; ?>" required />
                                </div>
                                <div class="col-md">
                                    <?php _label("รหัสวิชา"); ?>
                                    <input type="text" class="form-control" id="inCode" name="inCode" value="<?php echo (!empty($row["course_code"])) ? $row["course_code"] : ""; ?>" />
                                </div>
                                <div class="col-md">
                                    <?php _label("ประเภท"); ?>
                                    <select type="text" class="form-select tomselected " id="inType" name="inType">
                                        <option value="">เลือกข้อมูล</option>
                                        <?php $type_c = array("พื้นฐาน","เพิ่มเติม","กิจกรรม","เลือกเรียน"); ?>
                                        <?php foreach ($type_c as $t) { ?>
                                            <?php $sel = (!empty($row["course_type"]) && $row["course_type"] == $t) ? "selected" : ""; ?>
                                            <option value="<?php echo $t ?>" <?php echo $sel ?>><?php echo $t ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row g-3">
                                <div class="col-md">
                                    <?php _label("จำนวนชั่วโมงเรียนต่อสัปดาห์"); ?>
                                    <select type="text" class="form-select tomselected " id="inHours_Per_Week" name="inHours_Per_Week">
                                        <option value="">เลือกข้อมูล</option>
                                        <?php $hours_per_week = array("1","2","3","4","5","6"); ?>
                                        <?php foreach ($hours_per_week as $h) { ?>
                                            <?php $sel = (!empty($row["course_hours"]) && $row["course_hours"] == $h) ? "selected" : ""; ?>
                                            <option value="<?php echo $h ?>" <?php echo $sel ?>><?php echo $h ?> ชั่วโมง </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                
                                <div class="col-md">
                                    <?php _label("รายละเอียดวิชา"); ?>
                                    <input type="text" class="form-control" id="inDescriptions" name="inDescriptions" value="<?php echo (!empty($row["course_descriptions"])) ? $row["course_descriptions"] : ""; ?>" />
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
            url: " <?php echo site_url("CourseController/update_course") ?>",
            data: $(this).serialize(),
        }).done(function(data) {
            alert ("บันทึกสำเร็จ !!");
            //$("#inFirstName").addClass("is-invalid");
            location.reload();
        });
    });
</script>