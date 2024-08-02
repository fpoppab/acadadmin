<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <h2 class="page-title text-muted">
                    Student information
                </h2>
            </div>
            <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                    <a href="<?php echo site_url("student-insert-form")."?ClssId=".$this->input->get("ClssId")."&RoomId=".$this->input->get("RoomId"); ?>"
                        class="btn btn-primary d-none d-sm-inline-block">
                        <i class='ti ti-plus'></i>Create new student
                    </a>
                    <a href="<?php echo site_url("student-insert-form"); ?>" class="btn btn-primary d-sm-none btn-icon">
                        <i class='ti ti-plus'></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="page-body">
    <div class="container-xl">
        <div class="card">
            <div class="card-header ">
                <div class="form-floating" style="margin-right:10px;">
                    <select class="form-select cr-filter" id="inClssId" name="inClssId">
                        <option value="">แสดงทั้งหมด</option>
                        <?php foreach ($clss as $c) { ?>
                            <?php $sel = (!empty($this->input->get("ClssId")) && $this->input->get("ClssId") == $c["clss_id"]) ? "selected" : ""; ?>
                            <option value="<?= $c["clss_id"]; ?>" <?= $sel; ?>>
                                <?= $c["clss_name"] ?>
                            </option>
                        <?php } ?>
                    </select>
                    <label for="floatingSelect">ระดับชั้น</label>
                </div>
                <div class="form-floating" style="margin-right:10px;">
                    <select class="form-select cr-filter" id="inRoomId" name="inRoomId">
                        <option value="">แสดงทั้งหมด</option>
                        <?php foreach ($room as $r) { ?>
                            <?php $sel = (!empty($this->input->get("RoomId")) && $this->input->get("RoomId") == $r["room_id"]) ? "selected" : ""; ?>
                            <option value="<?= $r["room_id"]; ?>" <?= $sel; ?>>
                                <?= $r["room_number"] ?>
                            </option>
                        <?php } ?>
                    </select>
                    <label for="floatingSelect">ห้อง</label>
                </div>
            </div>
            <div class="card-body table-responsive">
                <table id="studentTable" class="display responsive nowrap" style="width:100%;margin:10 0 10 0;">
                    <!-- text-nowrap -->
                    <thead>
                        <tr>
                            <th class="w-1">No.</th>
                            <th style="width:5%;">Image</th>
                            <th style="width:17%;">Fullname</th>
                            <th style="width:5%;">ระดับชั้น</th>
                            <th style="width:5%;">Idcard</th>
                            <th style="width:5%;">Birthdate</th>
                            <th style="width:5%;">Gender</th>
                            <!-- <th style="width:5%;">Bloodtype</th> -->
                            <!-- <th style="width:5%;">Phonenumber</th> -->
                            <th style="width:5%;">Religion</th>
                            <!-- <th style="width:5%;">Ethnicity</th>
                            <th style="width:5%;">Nationality</th> -->
                            <th style="width:5%;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
                        foreach ($student as $s) { ?>
                            <tr>
                                <td>
                                    <?php echo $i ?>
                                </td>
                                <td>

                                    <span class="avatar avatar-sm" id="logo-image"
                                        style="background-image: url('<?php echo $s["profileimage"] ?>');">
                                    </span>

                                </td>
                                <td>
                                    <?php echo $s["fullname"] ?>
                                </td>
                                <td>
                                    <?php echo $s["clss_room_ab"] ?>
                                </td>
                                <td>
                                    <?php echo $s["idcard"] ?>
                                </td>
                                <td>
                                    <?php echo tothaishortdate($s["birthdate"]) ?>
                                </td>
                                <td>
                                    <?php echo $s["gender"] ?>
                                </td>
                                <!-- <td>
                                    <?php echo $s["bloodtype"] ?>
                                </td> -->
                                <!-- <td>
                                    <?php echo $s["phonenumber"] ?>
                                </td> -->
                                <td>
                                    <?php echo $s["religion"] ?>
                                </td>
                                <!-- <td>
                                    <?php echo $s["ethnicity"] ?>
                                </td>
                                <td>
                                    <?php echo $s["nationality"] ?>
                                </td> -->
                                <td class='text-center'>
                                    <button class="btn btn-edit d-none d-sm-inline-block" id="<?php echo $s["std_id"] ?>">
                                        <i class='ti ti-edit'></i>Edit
                                    </button>
                                    <buttona class="btn btn-delete d-none d-sm-inline-block"
                                        id="<?php echo $s["std_id"] ?>">
                                        <i class='ti ti-trash'></i>Delete
                                        </button>
                                </td>
                            </tr>
                            <?php $i++;
                        } ?>
                    </tbody>
                </table>
                <div id="test11">

                </div>
            </div>
        </div>
    </div>
</div>
<?= datatable(array("tablename" => "studentTable")); ?>
<script>
    $(".btn-edit").on("click", function () {
        location.href = "<?php echo site_url("student-edit-form/"); ?>" + $(this).attr('id') + "?ClssId=" + $("#inClssId").val() + "&RoomId=" + $("#inRoomId").val();
    });

    $(".cr-filter").on("change", function () {
        location.href = "<?php echo site_url("student"); ?>?ClssId=" + $("#inClssId").val() + "&RoomId=" + $("#inRoomId").val();
    });

    $(".btn-delete").on("click", function () {
        if (confirm("delete ?")) {
            $.ajax({
                type: "POST",
                url: "<?php echo site_url("StudentController/delete_student") ?>",
                data: {
                    inStdId: $(this).attr('id')
                },
            }).done(function (data) {
                alert(data);
                location.reload();
            });
        }
    });
</script>