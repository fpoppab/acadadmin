<!-- Page header -->
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <h2 class="page-title text-muted">
                    <a class='text-blue' href="<?php echo site_url("personnel"); ?>">Personnel</a>/
                    <?php echo (!empty($this->uri->segment(2))) ? "Edit personnel" : "Create new personnel"; ?>
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
                            <h2 class="mb-4">Personnel</h2>
                            <h3 class="card-title">User Image</h3>
                            <div class="row align-items-center">
                                <input type='file' id="inPersonnelLogo" style="display:none;" />
                                <input type='hidden' id="inPersonnelLogo64" name="inPersonnelLogo64" style="display:none;" value="<?php echo (!empty($row["profile_image"])) ? $row["profile_image"] : ""; ?>" />
                                <div class="col-auto">
                                    <span class="avatar avatar-xl" id="logo-image" style="background-image: url('<?php echo (!empty($row["profile_image"])) ? $row["profile_image"] : ""; ?>');">
                                    </span>
                                </div>
                                <div class="col-auto">
                                    <a href="#" class="btn" id="btn-change-image">Change avatar</a>
                                </div>
                            </div>
                            <h3 class="card-title mt-4">Information</h3>
                            <div class="row g-3">
                                <div class="col-md">
                                    <?php _label("Title Name"); ?>
                                    <select class="form-select tomselected " id="inTitleName" name="inTitleName">
                                        <option value="">เลือกข้อมูล</option>
                                        <?php $title = array( "นาย", "นางสาว"); ?>
                                        <?php foreach ($title as $t) { ?>
                                            <?php $sel = (!empty($row["titlename"]) && $row["titlename"] == $t) ? "selected" : ""; ?>
                                            <option value="<?php echo $t ?>" <?php echo $sel ?>><?php echo $t ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md">
                                    <?php _label("First Name"); ?>
                                    <input type="text" class="form-control " id="inFirstName" name="inFirstName" value="<?php echo (!empty($row["firstname"])) ? $row["firstname"] : ""; ?>" required />
                                </div>
                                <div class="col-md">
                                    <?php _label("Last Name"); ?>
                                    <input type="text" class="form-control" id="inLastName" name="inLastName" value="<?php echo (!empty($row["lastname"])) ? $row["lastname"] : ""; ?>" required />
                                </div>
                                <div class="col-md">
                                    <?php _label("Nick Name"); ?>
                                    <input type="text" class="form-control" id="inNickName" name="inNickName" value="<?php echo (!empty($row["nickname"])) ? $row["nickname"] : ""; ?>" />
                                </div>
                                <div class="col-md">
                                    <?php _label("Id Card"); ?>
                                    <input type="text" class="form-control" id="inIdCard" name="inIdCard" value="<?php echo (!empty($row["idcard"])) ? $row["idcard"] : ""; ?>" />
                                </div>
                            </div>
                            <div class="row g-3">
                                <div class="col-md">
                                    <?php _label("Birth Date"); ?>
                                    <input type="date" class="form-control" id="inBirthDate" name="inBirthDate" value="<?php echo (!empty($row["birthdate"])) ? todate($row["birthdate"]) : ""; ?>" />
                                </div>
                                <div class="col-md">
                                    <?php _label("Gender"); ?>
                                    <select type="text" class="form-select tomselected " id="inGenDer" name="inGenDer">
                                        <option value="">เลือกข้อมูล</option>
                                        <?php $gender = array("ชาย", "หญิง"); ?>
                                        <?php foreach ($gender as $g) { ?>
                                            <?php $sel = (!empty($row["gender"]) && $row["gender"] == $g) ? "selected" : ""; ?>
                                            <option value="<?php echo $g ?>" <?php echo $sel ?>><?php echo $g ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md">
                                    <?php _label("Blood Type"); ?>
                                    <select type="text" class="form-select tomselected " id="inBloodType" name="inBloodType">
                                        <option value="">เลือกข้อมูล</option>
                                        <?php $blood = array("O", "A", "B"); ?>
                                        <?php foreach ($blood as $b) { ?>
                                            <?php $sel = (!empty($row["bloodtype"]) && $row["bloodtype"] == $b) ? "selected" : ""; ?>
                                            <option value="<?php echo $b ?>" <?php echo $sel ?>><?php echo $b ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md">
                                    <?php _label("Phone Number"); ?>
                                    <input type="text" class="form-control" id="inPhoneNumber" name="inPhoneNumber" value="<?php echo (!empty($row["phonenumber"])) ? $row["phonenumber"] : ""; ?>" />
                                </div>
                            </div>
                            <div class="row g-3">
                                <div class="col-md">
                                    <?php _label("Religion"); ?>
                                    <select type="text" class="form-select tomselected " id="inReligion" name="inReligion" value="" tabindex="-1">
                                        <option value="">เลือกข้อมูล</option>
                                        <?php $religion = array("พุทธ", "คริสต์", "อิสลาม"); ?>
                                        <?php foreach ($religion as $r) { ?>
                                            <?php $sel = (!empty($row["religion"]) && $row["religion"] == $r) ? "selected" : ""; ?>
                                            <option value="<?php echo $r ?>" <?php echo $sel ?>><?php echo $r ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md">
                                    <?php _label("Ethnicity"); ?>
                                    <select type="text" class="form-select tomselected " id="inEthnicity" name="inEthnicity" value="" tabindex="-1">
                                        <option value="">เลือกข้อมูล</option>
                                        <?php $ethnicity = array("ไทย", "อังกฤษ"); ?>
                                        <?php foreach ($ethnicity as $e) { ?>
                                            <?php $sel = (!empty($row["ethnicity"]) && $row["ethnicity"] == $e) ? "selected" : ""; ?>
                                            <option value="<?php echo $e ?>" <?php echo $sel ?>><?php echo $e ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md">
                                    <?php _label("Nationality"); ?>
                                    <select type="text" class="form-select tomselected " id="inNationality" name="inNationality" value="" tabindex="-1">
                                        <option value="">เลือกข้อมูล</option>
                                        <?php $nationality = array("ไทย", "อังกฤษ"); ?>
                                        <?php foreach ($nationality as $n) { ?>
                                            <?php $sel = (!empty($row["nationality"]) && $row["nationality"] == $n) ? "selected" : ""; ?>
                                            <option value="<?php echo $n ?>" <?php echo $sel ?>><?php echo $n ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md">
                                    <?php _label("Type"); ?>
                                    <select type="text" class="form-select tomselected " id="inType" name="inType" value="" tabindex="-1" required>
                                        <option value="">เลือกข้อมูล</option>
                                        <?php foreach ($type as $t) { ?>
                                            <?php $sel = (!empty($row["type_id"]) && $row["type_id"] == $t["id"]) ? "selected" : ""; ?>
                                            <option value="<?php echo $t["id"] ?>" <?php echo $sel ?>><?php echo $t["name"] ?></option>
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