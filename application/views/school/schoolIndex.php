<!-- Page header -->
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <!-- Page pre-title -->
                <div class="page-pretitle">
                    School
                </div>
                <h2 class="page-title">
                    School Information
                </h2>
            </div>
        </div>
    </div>
</div>
<!-- Page body -->
<div class="page-body">
    <div class="container-xl">
        <div class="row ">
            <div class="col-9 d-flex flex-column">
                <div class="card">
                    <form id="insert-form" method="post" autocomplete="off" enctype="multipart/form-data">

                        <div class="card-body">
                            <h3 class="card-title">School Logo</h3>
                            <div class="row align-items-center">
                                <input type='file' id="inSchoolLogo" style="display:none;" />
                                <input type='hidden' id="inSchoolLogo64" name="inSchoolLogo64" style="display:none;"
                                    value="" />
                                <div class="col-auto">
<!--                                    <span class="avatar avatar-xl" id="logo-image"
                                        style="background-image: url('');"></span>-->
                                        <img  class="avatar avatar-xl" id="logo-image" src="data:image/jpeg;base64,<?php echo base64_encode($row["school_logo"]) ?>"/>
                                </div>
                                <div class="col-auto">
                                    <a href="#" class="btn" id="btn-change-image">Change Logo</a>
                                </div>
                            </div>
                            <h3 class="card-title mt-4">Information</h3>
                            <div class="row g-3">
                                <div class="col-md">
                                    <label class="form-label">School type</label>
                                    <select type="text" class="form-select" id="inSchoolTypeId" name="inSchoolTypeId">
                                        <option value="">--Select--</option>
                                        <?php foreach ($schoolTypeArr as $r) { ?>
                                            <?php $chk = ""; ?>
                                            <?php if ($r["school_type_id"] == $row["school_type_id"]) { ?>
                                                <?php $chk = "selected" ?>
                                            <?php } ?>
                                            <option value="<?php echo $r["school_type_id"] ?>" <?php echo $chk ?>>
                                                <?php echo $r["type_name"] ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md">
                                    <?php _label("School Name"); ?>
                                    <?php _input($type = "text", $id = "inSchoolName", $name = "inSchoolName", $value = $row["school_name"]); ?>
                                </div>
                                <div class="col-md">
                                    <div class="form-label">School ID</div>
                                    <input type="text" class="form-control" id="" name="">
                                </div>

                            </div>

                            <h3 class="card-title mt-4">Location</h3>
                            <div class="row g-3">
                                <div class="col-md">
                                    <div class="form-label">Tambol</div>
                                    <input type="text" class="form-control" id="inSchoolTambol" name="inSchoolTambol"
                                        value="<?php echo $row["school_tambol"] ?>">
                                </div>
                                <div class="col-md">
                                    <div class="form-label">Amphur</div>
                                    <input type="text" class="form-control" id="inSchoolAmphur" name="inSchoolAmphur"
                                        value="<?php echo $row["school_amphur"] ?>">
                                </div>
                                <div class="col-md">
                                    <div class="form-label">Province</div>
                                    <input type="text" class="form-control" id="inSchoolProvince"
                                        name="inSchoolProvince" value="<?php echo $row["school_province"] ?>">
                                </div>
                                <div class="col-md">
                                    <div class="form-label">Zipcode</div>
                                    <input type="text" class="form-control" id="inSchoolZipcode" name="inSchoolZipcode"
                                        value="<?php echo $row["school_zipcode"] ?>">
                                </div>
                                <div class="col-md">
                                    <div class="form-label">Phone</div>
                                    <input type="text" class="form-control" id="inSchoolPhone" name="inSchoolPhone"
                                        value="<?php echo $row["school_phone"] ?>">
                                </div>
                            </div>

                        </div>
                        <div class="card-footer bg-transparent mt-auto">
                            <div class="btn-list justify-content-end">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                        <input type="hidden" class="form-control" id="inSchoolId" name="inSchoolId"
                            value="<?php echo $row["school_id"] ?>">


                    </form>

                </div>
                <br />
                <div class="card">
                    <form id="edyear-form" method="post" autocomplete="off" enctype="multipart/form-data">
                        <input type="hidden" id="inMaximumSemester" name="inMaximumSemester"
                            value="<?php echo $row["maximum_semester"]; ?>">
                        <div class="card-body">
                            <h3 class="card-title mt-4">Education years</h3>
                            <div class="row g-3">
                                <div class="col-md">
                                    <label class="form-label">Years</label>
                                    <select class="form-select" id="inSchoolEdyear" name="inSchoolEdyear">
                                        <?php
                                        $min = $edyear - 5;
                                        $max = $edyear + 5;
                                        for ($x = $min; $x <= $max; $x++) { ?>
                                            <?php $chk = ($x == $edyear) ? "selected" : ""; ?>
                                            <option value="<?php echo $x; ?>" <?php echo $chk; ?>>
                                                <?php echo $x ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md">
                                    <?php _label("Start date"); ?>
                                    <input type="date" class="form-control" id="inEdYearStartdate"
                                        name="inEdYearStartdate"
                                        value="<?php echo (!empty($edyearRow["startdate"])) ? todate($edyearRow["startdate"]) : ""; ?>" />
                                </div>
                                <div class="col-md">
                                    <?php _label("End date"); ?>
                                    <input type="date" class="form-control" id="inEdYearEnddate" name="inEdYearEnddate"
                                        value="<?php echo (!empty($edyearRow["enddate"])) ? todate($edyearRow["enddate"]) : ""; ?>" />
                                </div>
                            </div>
                            <h3 class="card-title mt-4">Semesters</h3>
                            <?php for ($x = 1; $x <= $row["maximum_semester"]; $x++) {
                                ?>
                                <?php
                                $chkse = "";
                                foreach ($semester as $se) {
                                    $startdate = 0;
                                    $enddate = 0;
                                    if ($se["semester_number"] == $x) {
                                        $startdate = todate($se["startdate"]);
                                        $enddate = todate($se["enddate"]);
                                        break;
                                    }
                                }
                                ?>
                                <div class="row g-3">
                                    <div class="col-md">
                                        <?php _label("Semester"); ?>
                                        <input type="text" class="form-control" value="<?php echo $x ?>" readonly />
                                    </div>
                                    <div class="col-md">
                                        <?php _label("Start date"); ?>
                                        <input type="date" class="form-control" id="inSemester<?php echo $x ?>Startdate"
                                            name="inSemester<?php echo $x ?>Startdate"
                                            value="<?php echo (!empty($startdate)) ? $startdate : ""; ?>" />
                                    </div>
                                    <div class="col-md">
                                        <?php _label("End date"); ?>
                                        <input type="date" class="form-control" id="inSemester<?php echo $x ?>Enddate"
                                            name="inSemester<?php echo $x ?>Enddate"
                                            value="<?php echo (!empty($enddate)) ? $enddate : ""; ?>" />
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="card-footer bg-transparent mt-auto">
                            <div class="btn-list justify-content-end">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>

            <div class="col-3 d-flex flex-column">
                <div class="card">
                    <form id="clss-form" method="post" autocomplete="off" enctype="multipart/form-data">
                        <div class="card-body">
                            <h3 class="card-title mt-4">Class level</h3>
                            <?php
                            foreach ($clss as $s) { ?>
                                <?php $chk = (!empty($s['clss_id'])) ? "checked" : ""; ?>
                                <label class="form-check">
                                    <input class="form-check-input" type="checkbox"
                                        name="inClssCheckBox<?php echo $s["school_clss_id"] ?>"
                                        style="width:20px;height:20px;" value="<?php echo $s["school_clss_id"] ?>" <?= $chk ?>>
                                    <span class="form-check-label">&nbsp;
                                        <?php echo $s["name"] ?>
                                        <?php echo $s["level"] ?>
                                    </span>
                                </label>
                            <?php } ?>
                        </div>
                        <div class="card-footer bg-transparent mt-auto">
                            <div class="btn-list justify-content-end">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    //script for School
    var img64 = "";
    $("#btn-change-image").click(function () {
        $('#inSchoolLogo').trigger('click');
    });

    $("#inSchoolLogo").change(function () {
        readURL(this);
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $("#inSchoolLogo64").val(e.target.result);
                $('#logo-image').css('background-image', 'url(' + e.target.result + ')');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#insert-form").submit(function (e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "<?php echo site_url("SchoolController/update_school"); ?>",
            data: $(this).serialize(),
        }).done(function (data) {
            location.reload();
        });
    });

    //sctipt for edyear
    $("#inSchoolEdyear").on("change", function () {
        location.href = "<?php echo site_url($this->uri->segment(1)); ?>?edyear=" + this.value;
    });

    $("#edyear-form").submit(function (e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "<?php echo site_url("SchoolController/update_edyear"); ?>",
            data: $(this).serialize(),
        }).done(function (data) {
            console.log(data);
            alert(data);
            location.reload();
        });
    });

    $("#clss-form").submit(function (e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "<?php echo site_url("SchoolController/update_clss"); ?>",
            data: $(this).serialize(),
        }).done(function (data) {
            alert(data);
            location.reload();
        });
    });

</script>