
<!-- Page header -->
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <h2 class="page-title text-muted">
                    <a class='text-blue' href="<?php echo site_url("personnel"); ?>">Course</a>/
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
                        <input type="hidden" id="inPer" name="inPer" value="<?php echo (!empty($this->uri->segment(2))) ? $this->uri->segment(2) : ""; ?>" />

                        <div class="card-body">
                            <h2 class="mb-4">Course</h2>
                            <h3 class="card-title mt-4">Information</h3>
                            <div class="row g-3">
                                <div class="col-md">
                                    <?php _label("กลุ่มสาระ"); ?>
                                    <select class="form-select tomselected " id="inTitleName" name="inTitleName">
                                        <option value="">เลือกข้อมูล</option>
                                        <?php $title = array( "2567 : ภาษาไทย", "2567 : คณิตศาสตร์"); ?>
                                        <?php foreach ($title as $t) { ?>
                                            <?php $sel = (!empty($row["titlename"]) && $row["titlename"] == $t) ? "selected" : ""; ?>
                                            <option value="<?php echo $t ?>" <?php echo $sel ?>><?php echo $t ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md">
                                <?php _label("ระดับชั้น"); ?>
                                    <select type="text" class="form-select tomselected " id="inGenDer" name="inGenDer">
                                        <option value="">เลือกข้อมูล</option>
                                        <?php $gender = array("ประถมศึกษาปีที่ 1", "ประถมศึกษาปีที่ 2"); ?>
                                        <?php foreach ($gender as $g) { ?>
                                            <?php $sel = (!empty($row["gender"]) && $row["gender"] == $g) ? "selected" : ""; ?>
                                            <option value="<?php echo $g ?>" <?php echo $sel ?>><?php echo $g ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md">
                                    <?php _label("ชื่อวิชา"); ?>
                                    <input type="text" class="form-control" id="inLastName" name="inLastName" value="<?php echo (!empty($row["lastname"])) ? $row["lastname"] : ""; ?>" required />
                                </div>
                                <div class="col-md">
                                    <?php _label("รหัสวิชา"); ?>
                                    <input type="text" class="form-control" id="inNickName" name="inNickName" value="<?php echo (!empty($row["nickname"])) ? $row["nickname"] : ""; ?>" />
                                </div>
                                <div class="col-md">
                                    <?php _label("ประเภท"); ?>
                                    <select type="text" class="form-select tomselected " id="inGenDer" name="inGenDer">
                                        <option value="">เลือกข้อมูล</option>
                                        <?php $gender = array("พื้นฐาน", "เพิ่มเติม"); ?>
                                        <?php foreach ($gender as $g) { ?>
                                            <?php $sel = (!empty($row["gender"]) && $row["gender"] == $g) ? "selected" : ""; ?>
                                            <option value="<?php echo $g ?>" <?php echo $sel ?>><?php echo $g ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row g-3">
                                <div class="col-md">
                                    <?php _label("จำนวนชั่วโมงเรียนต่อสัปดาห์"); ?>
                                    <select type="text" class="form-select tomselected " id="inGenDer" name="inGenDer">
                                        <option value="">เลือกข้อมูล</option>
                                        <?php $gender = array("1 ชั่วโมง", "2 ชั่วโมง"); ?>
                                        <?php foreach ($gender as $g) { ?>
                                            <?php $sel = (!empty($row["gender"]) && $row["gender"] == $g) ? "selected" : ""; ?>
                                            <option value="<?php echo $g ?>" <?php echo $sel ?>><?php echo $g ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                
                                <div class="col-md">
                                    <?php _label("คะแนนเก็บ"); ?>
                                    <input type="text" class="form-control" id="inPhoneNumber" name="inPhoneNumber" value="<?php echo (!empty($row["phonenumber"])) ? $row["phonenumber"] : ""; ?>" />
                                </div>
                                <div class="col-md">
                                    <?php _label("คะแนนสอบ"); ?>
                                    <input type="text" class="form-control" id="inPhoneNumber" name="inPhoneNumber" value="<?php echo (!empty($row["phonenumber"])) ? $row["phonenumber"] : ""; ?>" />
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
    $("#btn-change-image").click(function() {
        $('#inPersonnelLogo').trigger('click');
    });

    $("#inPersonnelLogo").change(function() {
        readURL(this);
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $("#inPersonnelLogo64").val(e.target.result);
                $('#logo-image').css('background-image', 'url(' + e.target.result + ')');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#insert-form").submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: " <?php echo (!empty($this->uri->segment(2))) ? site_url("PersonnelController/update_personnel") : site_url("PersonnelController/insert_personnel"); ?>",
            data: $(this).serialize(),
        }).done(function(data) {
            alert (data);
            //$("#inFirstName").addClass("is-invalid");
            location.reload();
        });
    });
</script>