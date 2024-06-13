<!-- Page header -->
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <!-- Page pre-title -->
                <h2 class="page-title text-muted">
                Learning Resources
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
                    <a href="<?php echo site_url("learning-resources-insert-form"); ?>"
                        class="btn btn-primary d-none d-sm-inline-block">
                        <i class='ti ti-plus'></i>Create new Learning Resources
                    </a>
                    <a href="<?php echo site_url("learning-resources-insert-form"); ?>" class="btn btn-primary d-sm-none btn-icon">
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
            <?php _label("ประเภทแหล่งเรียนรู้"); ?>
                                    <select type="text" class="form-select tomselected " id="inType" name="inType">
                                        <option value="">เลือกข้อมูล</option>
                                        <?php $type = array("ภายนอก","ภายใน"); ?>
                                        <?php foreach ($type as $t) { ?>
                                            <?php $sel = ($this->input->get("Type") && $this->input->get("Type") == $t) ? "selected" : ""; ?>
                                            <option value="<?php echo $t ?>" <?php echo $sel ?>><?php echo $t ?></option>
                                        <?php } ?>
                                    </select>
            </div>
            <div class="card-body table-responsive">
                <table id="LearningResourcesTable" class="display responsive nowrap" style="width:100%;margin:10 0 10 0;">
                    <!-- text-nowrap -->
                    <thead>
                        <tr>
                            <th class="w-1">No.</th>
                            <th style="width:7%;">ชื่อแหล่งการเรียนรู้</th>
                            <th style="width:10%;">รายละเอียดแหล่งเรียนรู้</th>
                            <th style="width:7%;">ประเภทแหล่งเรียนรู้</th>
                            <th style="width:7%;">สถานะของแหล่งเรียนรู้</th>
                            <th style="width:7%;">ปีที่เริ่มใช้งาน</th>
                            <th style="width:7%;">ชื่อโรงเรียนที่เป็นเจ้าของข้อมูล</th>
                            <th style="width:7%;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
                        foreach ($learningresources as $l) { ?>
                            <tr>
                                <td>
                                    <?php echo $i ?>
                                </td>
                                <td>
                                    <?php echo $l["lr_name"] ?>
                                </td>
                                <td>
                                    <?php echo $l["lr_descriptions"] ?>
                                </td>
                                <td>
                                    <?php echo $l["lr_type"] ?>
                                </td>
                                <td>
                                    <?php echo $l["lr_status"] ?>
                                </td>
                                <td>
                                    <?php echo $l["lr_purchase_year"] ?>
                                </td>
                                <td>
                                    <?php echo $l["school_name"] ?>
                                </td>
                                <td class='text-center'>
                                    <button class="btn btn-edit d-none d-sm-inline-block" id="<?php echo $l["lr_id"] ?>">
                                        <i class='ti ti-edit'></i>Edit
                                    </button>
                                    <buttona class="btn btn-delete d-none d-sm-inline-block" id="<?php echo $l["lr_id"] ?>">
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
    $('#LearningResourcesTable').DataTable({
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
        location.href = "<?php echo site_url("learning-resources-edit-form/"); ?>" + $(this).attr('id');
    });

    $("#inType").on("change", function () {
        location.href = "<?php echo site_url("learning-resources"); ?>?Type=" + $("#inType").val();
    });

    $(".btn-delete").on("click", function () {
        if (confirm("delete ?")) {
            $.ajax({
                type: "POST",
                url: "<?php echo site_url("LearningResourcesController/delete_learningresources") ?>",
                data: {
                    inLearningResourcesId: $(this).attr('id')
                },
            }).done(function (data) {
               
                location.reload();
            });
        } else {

        }
    });
</script>