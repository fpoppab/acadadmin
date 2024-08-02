<!-- Page header -->
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <h2 class="page-title text-muted">
                    <a class='text-blue'
                        href="<?php echo site_url("student") . "?ClssId=" . $this->input->get("ClssId") . "&RoomId=" . $this->input->get("RoomId"); ?>">Student
                        information</a>/
                    <?php echo (!empty($this->uri->segment(2))) ? "Edit student" : "Create new student"; ?>
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
                        <input type="hidden" id="inStdId" name="inStdId"
                            value="<?php echo (!empty($this->uri->segment(2))) ? $this->uri->segment(2) : ""; ?>" />
                        <div class="card-body">
                            <h2 class="mb-4">Student</h2>
                            <h3 class="card-title">User Image</h3>
                            <div class="row align-items-center">
                                <input type='file' id="inStudentLogo" style="display:none;" />
                                <input type='hidden' id="inStudentLogo64" name="inStudentLogo64" style="display:none;"
                                    value="<?php echo (!empty($row["profileimage"])) ? $row["profileimage"] : ""; ?>" />
                                <div class="col-auto">
                                    <span class="avatar avatar-xl" id="logo-image"
                                        style="background-image: url('<?php echo (!empty($row["profileimage"])) ? $row["profileimage"] : ""; ?>');">
                                    </span>
                                </div>
                                <div class="col-auto">
                                    <a href="#" class="btn" id="btn-change-image">Change avatar</a>
                                </div>
                            </div>
                            <h3 class="card-title mt-4">Classroom Information</h3>
                            <div class="row g-3">
                                <div class="col-md">
                                    <?php _label("ระดับชั้น", "required"); ?>
                                    <select class="form-select cr-filter" id="inClssId" name="inClssId">
                                        <option value="">เลือกข้อมูล</option>
                                        <?php foreach ($clss as $c) { ?>
                                            <?php $sel = (!empty($row["clss_id"]) && $row["clss_id"] == $c["clss_id"]) ? "selected" : ""; ?>
                                            <?php $sel .= (!empty($this->input->get("ClssId")) && $this->input->get("ClssId") == $c["clss_id"]) ? "selected" : ""; ?>
                                            <option value="<?= $c["clss_id"]; ?>" <?= $sel; ?>>
                                                <?= $c["clss_name"] ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md">
                                    <?php _label("ห้อง", "required"); ?>
                                    <select class="form-select cr-filter" id="inRoomId" name="inRoomId">
                                        <option value="">แสดงทั้งหมด</option>
                                        <?php foreach ($room as $r) { ?>
                                            <?php $sel = (!empty($this->input->get("RoomId")) && $this->input->get("RoomId") == $r["room_id"]) ? "selected" : ""; ?>
                                            <option value="<?= $r["room_id"]; ?>" <?= $sel; ?>>
                                                <?= $r["room_number"] ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md">
                                    <?php _label("เลขที่"); ?>
                                    <input type="number" class="form-control" id="inNumber" name="inNumber"
                                        value="<?php echo (!empty($row["inNumber"])) ? $row["inNumber"] : ""; ?>" />
                                </div>
                            </div>
                            <h3 class="card-title mt-4">Information</h3>
                            <div class="row g-3">
                                <div class="col-md">
                                    <?php _label("Title Name", "required"); ?>
                                    <select class="form-select tomselected " id="inTitleName" name="inTitleName">
                                        <option value="">เลือกข้อมูล</option>
                                        <?php $title = array("เด็กชาย", "เด็กหญิง", "นาย", "นางสาว"); ?>
                                        <?php foreach ($title as $t) { ?>
                                            <?php $sel = (!empty($row["titlename"]) && $row["titlename"] == $t) ? "selected" : ""; ?>
                                            <option value="<?php echo $t ?>" <?php echo $sel ?>><?php echo $t ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md">
                                    <?php _label("First Name", "required"); ?>
                                    <input type="text" class="form-control " id="inFirstName" name="inFirstName"
                                        value="<?php echo (!empty($row["firstname"])) ? $row["firstname"] : ""; ?>"
                                        required />
                                </div>
                                <div class="col-md">
                                    <?php _label("Last Name", "required"); ?>
                                    <input type="text" class="form-control" id="inLastName" name="inLastName"
                                        value="<?php echo (!empty($row["lastname"])) ? $row["lastname"] : ""; ?>"
                                        required />
                                </div>
                                <div class="col-md">
                                    <?php _label("Nick Name"); ?>
                                    <input type="text" class="form-control" id="inNickName" name="inNickName"
                                        value="<?php echo (!empty($row["nickname"])) ? $row["nickname"] : ""; ?>" />
                                </div>
                                <div class="col-md">
                                    <?php _label("Id Card"); ?>
                                    <input type="text" class="form-control" id="inIdCard" name="inIdCard"
                                        value="<?php echo (!empty($row["idcard"])) ? $row["idcard"] : ""; ?>" />
                                </div>
                            </div>

                            <div class="row g-3">
                                <div class="col-md">
                                    <?php _label("Birth Date"); ?>
                                    <?= _datepickerth("inBirthDate","inBirthDate",(!empty($row["birthdate"])) ? $row["birthdate"] : ""); ?>
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
                                    <select type="text" class="form-select tomselected " id="inBloodType"
                                        name="inBloodType">
                                        <option value="">เลือกข้อมูล</option>
                                        <?php $blood = array("O", "A", "B"); ?>
                                        <?php foreach ($blood as $b) { ?>
                                            <?php $sel = (!empty($row["bloodtype"]) && $row["bloodtype"] == $b) ? "selected" : ""; ?>
                                            <option value="<?php echo $b ?>" <?php echo $sel ?>><?php echo $b ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row g-3">
                                <div class="col-md">
                                    <?php _label("Religion"); ?>
                                    <select type="text" class="form-select tomselected " id="inReligion"
                                        name="inReligion" value="" tabindex="-1">
                                        <option value="">เลือกข้อมูล</option>
                                        <?php $religion = array("พุทธ", "คริสต์", "อิสลาม"); ?>
                                        <?php foreach ($religion as $r) { ?>
                                            <?php $sel = (!empty($row["religion"]) && $row["religion"] == $r) ? "selected" : ""; ?>
                                            <option value="<?php echo $r ?>" <?php echo $sel ?>><?php echo $r ?></option>
                                        <?php } ?>
                                    </select>
                                    <?php //_input($type = "text", $id = "inReligion", $name = "inReligion", $value = "") 
                                    ?>
                                </div>
                                <div class="col-md">
                                    <?php _label("Ethnicity"); ?>
                                    <select type="text" class="form-select tomselected " id="inEthnicity"
                                        name="inEthnicity" value="" tabindex="-1">
                                        <option value="">เลือกข้อมูล</option>
                                        <?php $ethnicity = array("ไทย", "อังกฤษ"); ?>
                                        <?php foreach ($ethnicity as $e) { ?>
                                            <?php $sel = (!empty($row["ethnicity"]) && $row["ethnicity"] == $e) ? "selected" : ""; ?>
                                            <option value="<?php echo $e ?>" <?php echo $sel ?>><?php echo $e ?></option>
                                        <?php } ?>
                                    </select>
                                    <?php //_input($type = "text", $id = "inEthnicity", $name = "inEthnicity", $value = "") 
                                    ?>
                                </div>
                                <div class="col-md">
                                    <?php _label("Nationality"); ?>
                                    <select type="text" class="form-select tomselected " id="inNationality"
                                        name="inNationality" value="" tabindex="-1">
                                        <option value="">เลือกข้อมูล</option>
                                        <?php $nationality = array("ไทย", "อังกฤษ"); ?>
                                        <?php foreach ($nationality as $n) { ?>
                                            <?php $sel = (!empty($row["nationality"]) && $row["nationality"] == $n) ? "selected" : ""; ?>
                                            <option value="<?php echo $n ?>" <?php echo $sel ?>><?php echo $n ?></option>
                                        <?php } ?>
                                    </select>
                                    <?php //_input($type = "text", $id = "inNationality", $name = "inNationality", $value = "") 
                                    ?>
                                </div>
                                <div class="col-md">
                                    <?php _label("Phone Number"); ?>
                                    <input type="text" class="form-control" id="inPhoneNumber" name="inPhoneNumber"
                                        value="<?php echo (!empty($row["phonenumber"])) ? $row["phonenumber"] : ""; ?>" />
                                </div>
                            </div>

                            <!-- Form Address -->
                            <hr>
                            <h3 class="card-title mt-4">Address Information</h3>
                            <h4>*ที่อยู่ตามทะเบียนบ้าน</h4>
                            <div class="row g-3">
                                <div class="col-md">
                                    <?php _label("บ้านเลขที่"); ?>
                                    <input type="text" class="form-control " id="inR_No" name="inR_No"
                                        value="<?php echo (!empty($row["r_address_no"])) ? $row["r_address_no"] : ""; ?>" />
                                </div>
                                <div class="col-md">
                                    <?php _label("หมู่"); ?>
                                    <input type="text" class="form-control " id="inR_Moo" name="inR_Moo"
                                        value="<?php echo (!empty($row["r_address_moo"])) ? $row["r_address_moo"] : ""; ?>" />
                                </div>
                                <div class="col-md">
                                    <?php _label("ตำบล"); ?>
                                    <input type="text" class="form-control" id="inR_Tambol" name="inR_Tambol"
                                        value="<?php echo (!empty($row["r_address_tambol"])) ? $row["r_address_tambol"] : ""; ?>" />
                                </div>
                            </div>
                            <div class="row g-3">
                                <div class="col-md">
                                    <?php _label("อำเภอ"); ?>
                                    <input type="text" class="form-control" id="inR_AmPhur" name="inR_AmPhur"
                                        value="<?php echo (!empty($row["r_address_amphur"])) ? $row["r_address_amphur"] : ""; ?>" />
                                </div>
                                <div class="col-md">
                                    <?php _label("จังหวัด"); ?>
                                    <input type="text" class="form-control" id="inR_Province" name="inR_Province"
                                        value="<?php echo (!empty($row["r_address_province"])) ? $row["r_address_province"] : ""; ?>" />
                                </div>
                                <div class="col-md">
                                    <?php _label("รหัสไปรษณีย์"); ?>
                                    <input type="text" class="form-control" id="inR_ZipCode" name="inR_ZipCode"
                                        value="<?php echo (!empty($row["r_address_zipcode"])) ? $row["r_address_zipcode"] : ""; ?>" />
                                </div>
                            </div>


                            <h4 class="mt-4">*ที่อยู่ปัจจุบัน</h4>
                            <label class="form-check">
                                <input class="form-check-input" id="inAddCheck" type="checkbox">
                                <span class="form-check-label">ที่อยู่ปัจจุบันตรงกับทะเบียนบ้าน</span>
                            </label>
                            <div class="row g-3">

                                <div class="col-md">
                                    <?php _label("บ้านเลขที่"); ?>
                                    <input type="text" class="form-control " id="inC_No" name="inC_No"
                                        value="<?php echo (!empty($row["c_address_no"])) ? $row["c_address_no"] : ""; ?>" />
                                </div>
                                <div class="col-md">
                                    <?php _label("หมู่"); ?>
                                    <input type="text" class="form-control " id="inC_Moo" name="inC_Moo"
                                        value="<?php echo (!empty($row["c_address_moo"])) ? $row["c_address_moo"] : ""; ?>" />
                                </div>
                                <div class="col-md">
                                    <?php _label("ตำบล"); ?>
                                    <input type="text" class="form-control" id="inC_Tambol" name="inC_Tambol"
                                        value="<?php echo (!empty($row["c_address_tambol"])) ? $row["c_address_tambol"] : ""; ?>" />
                                </div>
                            </div>
                            <div class="row g-3">
                                <div class="col-md">
                                    <?php _label("อำเภอ"); ?>
                                    <input type="text" class="form-control" id="inC_AmPhur" name="inC_AmPhur"
                                        value="<?php echo (!empty($row["c_address_amphur"])) ? $row["c_address_amphur"] : ""; ?>" />
                                </div>
                                <div class="col-md">
                                    <?php _label("จังหวัด"); ?>
                                    <input type="text" class="form-control" id="inC_Province" name="inC_Province"
                                        value="<?php echo (!empty($row["c_address_province"])) ? $row["c_address_province"] : ""; ?>" />
                                </div>
                                <div class="col-md">
                                    <?php _label("รหัสไปรษณีย์"); ?>
                                    <input type="text" class="form-control" id="inC_ZipCode" name="inC_ZipCode"
                                        value="<?php echo (!empty($row["c_address_zipcode"])) ? $row["c_address_zipcode"] : ""; ?>" />
                                </div>
                            </div>


                            <!-- Form Paren -->
                            <hr>
                            <h3 class="card-title mt-4">Paren Information</h3>
                            <div class="accordion" id="accordion-example">

                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="heading-1">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapse-1" aria-expanded="true">
                                            <h4>*ข้อมูลบิดา</h4>
                                        </button>
                                    </h2>
                                    <div id="collapse-1" class="accordion-collapse collapse show"
                                        data-bs-parent="#accordion-example" style="">
                                        <div class="accordion-body pt-0">
                                            <h3 class="card-title">Paren Image</h3>
                                            <div class="row g-3">
                                                <div class="row align-items-center">
                                                    <input type='file' id="inParentLogo" style="display:none;" />
                                                    <input type='hidden' id="inParentLogo64" name="inParentLogo64"
                                                        style="display:none;"
                                                        value="<?php echo (!empty($row["f_profile_image"])) ? $row["f_profile_image"] : ""; ?>" />
                                                    <div class="col-auto">
                                                        <span class="avatar avatar-xl" id="logo-image"
                                                            style="background-image: url('<?php echo (!empty($row["f_profile_image"])) ? $row["f_profile_image"] : ""; ?>');">
                                                        </span>
                                                    </div>
                                                    <div class="col-auto">
                                                        <a href="#" class="btn" id="btn-change-image">Change
                                                            avatar</a>
                                                    </div>
                                                </div>
                                                <div class="row g-3">
                                                    <div class="col-md">
                                                        <?php _label("Title Name"); ?>
                                                        <select class="form-select tomselected " id="inF_TitleName"
                                                            name="inF_TitleName">
                                                            <option value="">เลือกข้อมูล</option>
                                                            <?php $title = array("นาย", "นาง", "นางสาว"); ?>
                                                            <?php foreach ($title as $t) { ?>
                                                                <?php $sel = (!empty($row["father"]["titlename"]) && $row["father"]["titlename"] == $t) ? "selected" : ""; ?>
                                                                <option value="<?php echo $t ?>" <?php echo $sel ?>>
                                                                    <?php echo $t ?>
                                                                </option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-md">
                                                        <?php _label("First name"); ?>
                                                        <input type="text" class="form-control " id="inF_FirstName"
                                                            name="inF_FirstName"
                                                            value="<?php echo (!empty($row["father"]["firstname"])) ? $row["father"]["firstname"] : ""; ?>" />
                                                    </div>
                                                    <div class="col-md">
                                                        <?php _label("Last name"); ?>
                                                        <input type="text" class="form-control" id="inF_LastName"
                                                            name="inF_LastName"
                                                            value="<?php echo (!empty($row["father"]["lastname"])) ? $row["father"]["lastname"] : ""; ?>" />
                                                    </div>
                                                    <div class="col-md">
                                                        <?php _label("Phone"); ?>
                                                        <input type="text" class="form-control" id="inF_PhoneNumber"
                                                            name="inF_PhoneNumber"
                                                            value="<?php echo (!empty($row["father"]["phonenumber"])) ? $row["father"]["phonenumber"] : ""; ?>" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="heading-2">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapse-2"
                                            aria-expanded="false">
                                            <h4>*ข้อมูลมารดา</h4>
                                        </button>
                                    </h2>
                                    <div id="collapse-2" class="accordion-collapse collapse"
                                        data-bs-parent="#accordion-example" style="">
                                        <div class="accordion-body pt-0">
                                            <h3 class="card-title">Paren Image</h3>
                                            <div class="row g-3">
                                                <div class="row align-items-center">
                                                    <input type='file' id="inParentLogo" style="display:none;" />
                                                    <input type='hidden' id="inParentLogo64" name="inParentLogo64"
                                                        style="display:none;"
                                                        value="<?php echo (!empty($row["m_profile_image"])) ? $row["m_profile_image"] : ""; ?>" />
                                                    <div class="col-auto">
                                                        <span class="avatar avatar-xl" id="logo-image"
                                                            style="background-image: url('<?php echo (!empty($row["m_profile_image"])) ? $row["m_profile_image"] : ""; ?>');">
                                                        </span>
                                                    </div>
                                                    <div class="col-auto">
                                                        <a href="#" class="btn" id="btn-change-image">Change
                                                            avatar</a>
                                                    </div>
                                                </div>
                                                <div class="row g-3">
                                                    <div class="col-md">
                                                        <?php _label("Title Name"); ?>
                                                        <select class="form-select tomselected " id="inM_TitleName"
                                                            name="inM_TitleName">
                                                            <option value="">เลือกข้อมูล</option>
                                                            <?php $title = array("นาย", "นาง", "นางสาว"); ?>
                                                            <?php foreach ($title as $t) { ?>
                                                                <?php $sel = (!empty($row["mother"]["titlename"]) && $row["mother"]["titlename"] == $t) ? "selected" : ""; ?>
                                                                <option value="<?php echo $t ?>" <?php echo $sel ?>>
                                                                    <?php echo $t ?>
                                                                </option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-md">
                                                        <?php _label("First name"); ?>
                                                        <input type="text" class="form-control " id="inM_FirstName"
                                                            name="inM_FirstName"
                                                            value="<?php echo (!empty($row["mother"]["firstname"])) ? $row["mother"]["firstname"] : ""; ?>" />
                                                    </div>
                                                    <div class="col-md">
                                                        <?php _label("Last name"); ?>
                                                        <input type="text" class="form-control" id="inM_LastName"
                                                            name="inM_LastName"
                                                            value="<?php echo (!empty($row["mother"]["lastname"])) ? $row["mother"]["lastname"] : ""; ?>" />
                                                    </div>
                                                    <div class="col-md">
                                                        <?php _label("Phone"); ?>
                                                        <input type="text" class="form-control" id="inM_PhoneNumber"
                                                            name="inM_PhoneNumber"
                                                            value="<?php echo (!empty($row["mother"]["phonenumber"])) ? $row["mother"]["phonenumber"] : ""; ?>" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="heading-3">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapse-3" aria-expanded="true">
                                            <h4>*ผู้ปกครอง</h4>

                                        </button>
                                    </h2>
                                    <div id="collapse-3" class="accordion-collapse collapse"
                                        data-bs-parent="#accordion-example" style="">
                                        <div class="accordion-body pt-0">
                                            <div class="mb-3">
                                                <div class="form-label">Inline Radios</div>
                                                <div>
                                                    <label class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" id="inFatherCheck"
                                                            name="radios-inline">
                                                        <span class="form-check-label">ผู้ปกครองคือ"บิดา"</span>
                                                    </label>
                                                    <label class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" id="inMotherCheck"
                                                            name="radios-inline">
                                                        <span class="form-check-label">ผู้ปกครองคือ"มารดา"</span>
                                                    </label>
                                                    <label class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" id="inClearCheck"
                                                            name="radios-inline" checked="">
                                                        <span class="form-check-label">เคลียร์ข้อมูล</span>
                                                    </label>
                                                </div>
                                            </div>
                                            <h3 class="card-title">Paren Image</h3>
                                            <div class="row g-3">
                                                <div class="row align-items-center">
                                                    <input type='file' id="inParentLogo" style="display:none;" />
                                                    <input type='hidden' id="inParentLogo64" name="inParentLogo64"
                                                        style="display:none;"
                                                        value="<?php echo (!empty($row["m_profile_image"])) ? $row["m_profile_image"] : ""; ?>" />
                                                    <div class="col-auto">
                                                        <span class="avatar avatar-xl" id="logo-image"
                                                            style="background-image: url('<?php echo (!empty($row["m_profile_image"])) ? $row["m_profile_image"] : ""; ?>');">
                                                        </span>
                                                    </div>
                                                    <div class="col-auto">
                                                        <a href="#" class="btn" id="btn-change-image">Change
                                                            avatar</a>
                                                    </div>
                                                </div>

                                                <div class="row g-3">
                                                    <div class="col-md">
                                                        <?php _label("Title Name"); ?>
                                                        <select class="form-select tomselected " id="inP_TitleName"
                                                            name="inP_TitleName">
                                                            <option value="">เลือกข้อมูล</option>
                                                            <?php $title = array("นาย", "นาง", "นางสาว"); ?>
                                                            <?php foreach ($title as $t) { ?>
                                                                <?php $sel = (!empty($row[""]["titlename"]) && $row[""]["titlename"] == $t) ? "selected" : ""; ?>
                                                                <option value="<?php echo $t ?>" <?php echo $sel ?>>
                                                                    <?php echo $t ?>
                                                                </option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-md">
                                                        <?php _label("First name"); ?>
                                                        <input type="text" class="form-control " id="inP_FirstName"
                                                            name="inP_FirstName"
                                                            value="<?php echo (!empty($row["m_firstname"])) ? $row["m_firstname"] : ""; ?>" />
                                                    </div>
                                                    <div class="col-md">
                                                        <?php _label("Last name"); ?>
                                                        <input type="text" class="form-control" id="inP_LastName"
                                                            name="inP_LastName"
                                                            value="<?php echo (!empty($row["m_lastname"])) ? $row["m_lastname"] : ""; ?>" />
                                                    </div>
                                                    <div class="col-md">
                                                        <?php _label("Phone"); ?>
                                                        <input type="text" class="form-control" id="inP_PhoneNumber"
                                                            name="inP_PhoneNumber"
                                                            value="<?php echo (!empty($row["m_phonenumber"])) ? $row["m_phonenumber"] : ""; ?>" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
    $(".cr-filter").on("change", function () {
        location.href = "<?php echo current_url(); ?>?ClssId=" + $("#inClssId").val() + "&RoomId=" + $("#inRoomId").val();
    });

    $("#inAddCheck").change(function () {
        if (this.checked) {
            $("#inC_No").val($("#inR_No").val());
            $("#inC_Moo").val($("#inR_Moo").val());
            $("#inC_Tambol").val($("#inR_Tambol").val());
            $("#inC_AmPhur").val($("#inR_AmPhur").val());
            $("#inC_Province").val($("#inR_Province").val());
            $("#inC_ZipCode").val($("#inR_ZipCode").val());
        }
    });

    $("#inFatherCheck").change(function () {
        if (this.checked) {
            $("#inP_TitleName").val($("#inF_TitleName").val());
            $("#inP_FirstName").val($("#inF_FirstName").val());
            $("#inP_LastName").val($("#inF_LastName").val());
            $("#inP_PhoneNumber").val($("#inF_PhoneNumber").val());
        }
    });

    $("#inMotherCheck").change(function () {
        if (this.checked) {
            $("#inP_TitleName").val($("#inM_TitleName").val());
            $("#inP_FirstName").val($("#inM_FirstName").val());
            $("#inP_LastName").val($("#inM_LastName").val());
            $("#inP_PhoneNumber").val($("#inM_PhoneNumber").val());
        }
    });

    $("#inClearCheck").change(function () {
        if (this.checked) {
            $("#inP_TitleName").val("");
            $("#inP_FirstName").val("");
            $("#inP_LastName").val("");
            $("#inP_PhoneNumber").val("");
        }
    });


    $("#btn-change-image").click(function () {
        $('#inStudentLogo').trigger('click');
    });

    $("#inStudentLogo").change(function () {
        readURL(this);
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $("#inStudentLogo64").val(e.target.result);
                $('#logo-image').css('background-image', 'url(' + e.target.result + ')');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#insert-form").submit(function (e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: " <?= site_url("StudentController/update_student") ?>",
            data: $(this).serialize(),
        }).done(function (data) {
            //$("#inFirstName").addClass("is-invalid");
            location.reload();
        });
    });
</script>