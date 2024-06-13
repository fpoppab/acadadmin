<!-- Page header -->
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <!-- Page pre-title -->
                <h2 class="page-title text-muted">
                    Building
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
                    <a href="<?php echo site_url("building-insert-form"); ?>"
                        class="btn btn-primary d-none d-sm-inline-block">
                        <i class='ti ti-plus'></i>Create new Building
                    </a>
                    <a href="<?php echo site_url("building-insert-form"); ?>" class="btn btn-primary d-sm-none btn-icon">
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
                <?php _label("Type"); ?>
                <select class="form-select tomselected " id="inType" name="inType" required>
                    <option value="">เลือกข้อมูล</option>
                    <?php foreach ($building_type as $t) { ?>
                        <?php $sel = (!empty($this->input->get("Type")) && $this->input->get("Type") == $t["building_type_id"]) ? "selected" : ""; ?>
                        <option value="<?php echo $t["building_type_id"] ?>" <?php echo $sel ?>><?php echo $t["building_type_name"] ?></option>
                    <?php } ?>
                </select>
                <?php _label("State"); ?>
                <select type="text" class="form-select tomselected " id="inStatus" name="inStatus">
                    <option value="">เลือกข้อมูล</option>
                    <?php $status = array("ปกติ", "ไม่ได้ใช้งาน"); ?>
                    <?php foreach ($status as $b) { ?>
                        <?php $sel = (!empty($this->input->get("Status")) && $this->input->get("Status") == $b) ? "selected" : ""; ?>
                        <option value="<?php echo $b ?>" <?php echo $sel ?>><?php echo $b ?></option>
                    <?php } ?>
                </select>
                </div>
            <div class="card-body table-responsive">
                <table id="BuildingTable" class="display responsive nowrap" style="width:100%;margin:10 0 10 0;">
                    <!-- text-nowrap -->
                    <thead>
                        <tr>
                            <th class="w-1">No.</th>
                            <th style="width:5%;">Type</th>
                            <th style="width:5%;">Name</th>
                            <th style="width:17%;">Detail</th>
                            <th style="width:5%;">State</th>
                            <th style="width:5%;">Purchase Year</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $i = 1;
                        foreach ($building as $b) { ?>
                            <tr>
                                <td>
                                    <?php echo $i ?>
                                </td>
                                <td>
                                <?php echo $b["building_type_name"] ?>
                                </td>
                                <td>
                                    <?php echo $b["building_name"] ?>
                                </td>
                                <td>
                                    <?php echo $b["building_descriptions"] ?>
                                </td>
                                
                                <td>
                                    <?php echo $b["building_status"] ?>
                                </td>
                                <td>
                                    <?php echo $b["building_purchase_year"] ?>
                                </td>
                                <td class='text-center'>
                                    <button class="btn btn-edit" id="<?php echo $b["building_id"] ?>">
                                        <i class='ti ti-edit'></i>Edit
                                    </button>
                                    <button class="btn btn-delete" id="<?php echo $b["building_id"] ?>">
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
    $('#BuildingTable').DataTable({
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
        location.href = "<?php echo site_url("building-edit-form/"); ?>" + $(this).attr('id');
    });

    $(".btn-delete").on("click", function () {
        if (confirm("delete ?")) {
            $.ajax({
                type: "POST",
                url: "<?php echo site_url("BuildingController/delete_building") ?>",
                data: {
                    inBld: $(this).attr('id')
                },
            }).done(function (data) {
               
                location.reload();
            });
        } else {

        }
    });

    $("#inType").on("change", function () {
        location.href = '<?php echo site_url("building"); ?>?Type='+$("#inType").val()+"&Status="+$("#inStatus").val();
    });
    $("#inStatus").on("change", function () {
        location.href = '<?php echo site_url("building"); ?>?Type='+$("#inType").val()+"&Status="+$("#inStatus").val();
    });

</script>