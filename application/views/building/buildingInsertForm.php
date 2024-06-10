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
                        <input type="hidden" id="inPer" name="inPer" value="<?php echo (!empty($this->uri->segment(2))) ? $this->uri->segment(2) : ""; ?>" />

                        <div class="card-body">
                            <h2 class="mb-4">Building</h2>
                            <div class="row g-3">
                                <div class="col-md">
                                    <?php _label("Type"); ?>
                                    <select class="form-select tomselected " id="inTitleName" name="inTitleName">
                                        <option value="">เลือกข้อมูล</option>
                                        <?php $title = array( "ห้องเรียน", "ห้องสมุด", "ห้องคอมพิวเตอร์" , "ห้องปฏิบัติการทางภาษา", "ห้องปฐมพยาบาล", "ห้องจริยศึกษา", "ห้องแนะแนว", "ห้องร้านค้าสหกรณ์", "ห้องประชุม"); ?>
                                        <?php foreach ($title as $t) { ?>
                                            <?php $sel = (!empty($row["titlename"]) && $row["titlename"] == $t) ? "selected" : ""; ?>
                                            <option value="<?php echo $t ?>" <?php echo $sel ?>><?php echo $t ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md">
                                    <?php _label("Detail"); ?>
                                    <input type="text" class="form-control " id="inFirstName" name="inFirstName" value="<?php echo (!empty($row["firstname"])) ? $row["firstname"] : ""; ?>" required />
                                </div>
                                <div class="col-md">
                                    <?php _label("maximum student capacity"); ?>
                                    <input type="number" class="form-control" id="innumber" name="innumber" value="<?php echo (!empty($row["number"])) ? $row["number"] : ""; ?>"  min="0" required />
                                </div>
                                <div class="col-md">
                                    <?php _label("room amout"); ?>
                                    <input type="number" class="form-control" id="inamout" name="inamout" value="<?php echo (!empty($row["amout"])) ? $row["amout"] : ""; ?>"  min="0" required />
                                </div>
                                <div class="col-md">
                                    <?php _label("Price"); ?>
                                    <input type="number" class="form-control" id="inPrice" name="inPrice" value="<?php echo (!empty($row["price"])) ? $row["price"] : ""; ?>" />
                                </div>
                            </div>
                            <div class="row g-3">
                                <div class="col-md">
                                    <?php _label("year received"); ?>
                                    <input type="number" class="form-control" id="inreceive" name="inreceive" value="<?php echo (!empty($row["receive"])) ? $row["receive"] : ""; ?>"  min="0" required />
                                </div>

                                <div class="col-md">
                                    <?php _label("State"); ?>
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
                                    <?php _label("image1"); ?>
                                    <input type="file" class="form-control" id="inPhoneNumber" name="inPhoneNumber" value="<?php echo (!empty($row["phonenumber"])) ? $row["phonenumber"] : ""; ?>" />
                                </div>
                            </div>
                            <div class="row g-3">
                                <div class="col-md">
                                    <?php _label("image2"); ?>
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
                                    <?php _label("image3"); ?>
                                    <select type="text" class="form-select tomselected " id="inEthnicity" name="inEthnicity" value="" tabindex="-1">
                                        <option value="">เลือกข้อมูล</option>
                                        <?php $ethnicity = array("ไทย", "อังกฤษ"); ?>
                                        <?php foreach ($ethnicity as $e) { ?>
                                            <?php $sel = (!empty($row["ethnicity"]) && $row["ethnicity"] == $e) ? "selected" : ""; ?>
                                            <option value="<?php echo $e ?>" <?php echo $sel ?>><?php echo $e ?></option>
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