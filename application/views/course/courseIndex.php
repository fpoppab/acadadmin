<!-- Page header -->
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <!-- Page pre-title -->
                <h2 class="page-title text-muted">
                    Course
                </h2>
            </div>
            <!-- Page title actions -->
            <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                    <!-- <span class="d-none d-sm-inline">
                        <a href="#" class="btn" data-bs-toggle="modal" data-bs-target="#modal-report">
                            Modal with form
                        </a>
                    </span> -->
                    <a href="<?php echo site_url("course-insert-form"); ?>"
                        class="btn btn-primary d-none d-sm-inline-block">
                        <i class='ti ti-plus'></i>Create new Course
                    </a>
                    <a href="<?php echo site_url("course-insert-form"); ?>" class="btn btn-primary d-sm-none btn-icon">
                        <i class='ti ti-plus'></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Page body -->
<div class="page-body">
    <div class="container-xl">
        <div class="card">
        <div class="card-header">
        <?php _label("กลุ่มสาระ"); ?>
                                    <select class="form-select tomselected " id="inGroup_Learning_id" name="inGroup_Learning_id" >
                                    <option value="">เลือกข้อมูล</option>
                                        <?php foreach ($group_learning as $g) { ?>
                                            <?php $sel = ($this->input->get("Group_Learning") && $this->input->get("Group_Learning") == $g["group_learning_id"]) ? "selected" : ""; ?>
                                            <option value="<?php echo $g["group_learning_id"] ?>" <?php echo $sel ?>><?php echo $g["group_learning_name"] ?></option>
                                        <?php } ?>
                                    </select>
        <?php _label("ประเภท"); ?>
                                    <select type="text" class="form-select tomselected " id="inType" name="inType" >
                                        <option value="">เลือกข้อมูล</option>
                                        <?php $type_c = array("พื้นฐาน","เพิ่มเติม","กิจกรรม","เลือกเรียน"); ?>
                                        <?php foreach ($type_c as $t) { ?>
                                            <?php $sel = ($this->input->get("Type") && $this->input->get("Type") == $t) ? "selected" : ""; ?>
                                            <option value="<?php echo $t ?>" <?php echo $sel ?>><?php echo $t ?></option>
                                        <?php } ?>
                
                </select>
            </div>
            <div class="card-body table-responsive">
                <table id="CourseTable" class="display responsive nowrap" style="width:100%;margin:10 0 10 0;">
                    <!-- text-nowrap -->
                    <thead>
                        <tr>
                            <th class="w-1">No.</th>
                            <th style="width:7%;">กลุ่มสาระ</th>
                            <th style="width:7%;">ระดับชั้น</th>
                            <th style="width:7%;">รหัสวิชา</th>
                            <th style="width:7%;">ชื่อวิชา</th>
                            <th style="width:7%;">ประเภท</th>
                            <th style="width:7%;">ชั่วโมงเรียนต่อสัปดาห์</th>
                            <th style="width:7%;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
                        foreach ($course as $c) { ?>
                            <tr>
                                <td>
                                    <?php echo $i ?>
                                </td>
                                <td>
                                    <?php echo $c["group_learning_name"] ?>
                                </td>
                                <td>
                                    <?php echo $c["clss_name"] ?>
                                </td>
                                <td>
                                    <?php echo $c["course_code"] ?>
                                </td>
                                <td>
                                    <?php echo $c["course_name"] ?>
                                </td>
                                <td>
                                    <?php echo $c["course_type"] ?>
                                </td>
                                <td>
                                    <?php echo $c["course_hours"] ?>
                                </td>
                                <td class='text-center'>
                                    <button class="btn btn-edit d-none d-sm-inline-block" id="<?php echo $c["course_id"] ?>">
                                        <i class='ti ti-edit'></i>Edit
                                    </button>
                                    <buttona class="btn btn-delete d-none d-sm-inline-block" id="<?php echo $c["course_id"] ?>">
                                        <i class='ti ti-trash'></i>Delete
                                        </button>
                                </td>
                            </tr>
                            <?php $i++;
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    $('#CourseTable').DataTable({
        // responsive: true,
        columnDefs: [
            {
                className: 'dtr-control arrow-right',
                orderable: false,
                target: -1
            }
        ],
        responsive: {
            details: {
                type: 'column',
                target: -1
            }
        },
        language: {
            url: '<?php echo base_url("languages/en_DataTable.json") ?>'
        }
    });

    $(".btn-edit").on("click", function () {
        location.href = "<?php echo site_url("course-edit-form/"); ?>" + $(this).attr('id');
    });
    $("#inGroup_Learning_id").on("change", function () {
        location.href = "<?php echo site_url("course"); ?>?Group_Learning=" + $("#inGroup_Learning_id").val()+"&Type="+$("#inType").val();
    });   
    $("#inType").on("change", function () {
        location.href = "<?php echo site_url("course"); ?>?Group_Learning=" + $("#inGroup_Learning_id").val()+"&Type="+$("#inType").val();
    });

    $(".btn-delete").on("click", function () {
        if (confirm("delete ?")) {
            $.ajax({
                type: "POST",
                url: "<?php echo site_url("CourseController/delete_course") ?>",
                data: {
                    inCourseId: $(this).attr('id')
                },
            }).done(function (data) {
               
                location.reload();
            });
        } else {

        }
    });
</script>