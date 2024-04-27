<!-- Page header -->
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <!-- Page pre-title -->
                <h2 class="page-title text-muted">
                    Personnel
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
                    <a href="<?php echo site_url("personnel-insert-form"); ?>"
                        class="btn btn-primary d-none d-sm-inline-block">
                        <i class='ti ti-plus'></i>Create new Personnel
                    </a>
                    <a href="<?php echo site_url("personnel-insert-form"); ?>" class="btn btn-primary d-sm-none btn-icon">
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
            <div class="card-body table-responsive">
                <table id="PersonelTable" class="display responsive nowrap" style="width:100%;margin:10 0 10 0;">
                    <!-- text-nowrap -->
                    <thead>
                        <tr>
                            <th class="w-1">No.</th>
                            <th style="width:5%;">Image</th>
                            <th style="width:17%;">Fullname</th>
                            <th style="width:5%;">Nickname</th>
                            <th style="width:5%;">Idcard</th>
                            <th style="width:5%;">Birthdate</th>
                            <th style="width:5%;">Gender</th>
                            <th style="width:5%;">Bloodtype</th>
                            <th style="width:5%;">Phonenumber</th>
                            <th style="width:5%;">Religion</th>
                            <th style="width:5%;">Ethnicity</th>
                            <th style="width:5%;">Nationality</th>
                            <th style="width:5%;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
                        foreach ($personnel as $p) { ?>
                            <tr>
                                <td>
                                    <?php echo $i ?>
                                </td>
                                <td>

                                    <span class="avatar avatar-sm" id="logo-image"
                                        style="background-image: url('<?php echo $p["profile_image"] ?>');">
                                    </span>

                                </td>
                                <td>
                                    <?php echo $p["fullname"] ?>
                                </td>
                                <td>
                                    <?php echo $p["nickname"] ?>
                                </td>
                                <td>
                                    <?php echo $p["idcard"] ?>
                                </td>
                                <td>
                                    <?php echo tothaishortdate($p["birthdate"]) ?>
                                </td>
                                <td>
                                    <?php echo $p["gender"] ?>
                                </td>
                                <td>
                                    <?php echo $p["bloodtype"] ?>
                                </td>
                                <td>
                                    <?php echo $p["phonenumber"] ?>
                                </td>
                                <td>
                                    <?php echo $p["religion"] ?>
                                </td>
                                <td>
                                    <?php echo $p["ethnicity"] ?>
                                </td>
                                <td>
                                    <?php echo $p["nationality"] ?>
                                </td>
                                <td class='text-center'>
                                    <button class="btn btn-edit d-none d-sm-inline-block" id="<?php echo $p["personnel_id"] ?>">
                                        <i class='ti ti-edit'></i>Edit
                                    </button>
                                    <buttona class="btn btn-delete d-none d-sm-inline-block" id="<?php echo $p["personnel_id"] ?>">
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
    $('#PersonelTable').DataTable({
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
        location.href = "<?php echo site_url("personnel-edit-form/"); ?>" + $(this).attr('id');
    });

    $(".btn-delete").on("click", function () {
        if (confirm("delete ?")) {
            $.ajax({
                type: "POST",
                url: "<?php echo site_url("PersonnelController/delete_personnel") ?>",
                data: {
                    inPer: $(this).attr('id')
                },
            }).done(function (data) {
               
                location.reload();
            });
        } else {

        }
    });
</script>