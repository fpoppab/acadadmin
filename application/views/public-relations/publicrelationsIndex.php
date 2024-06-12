<!-- Page header -->
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <!-- Page pre-title -->
                <h2 class="page-title text-muted">
                    Public Relations
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
                    <a href="<?php echo site_url("public-relations-insert-form"); ?>"
                        class="btn btn-primary d-none d-sm-inline-block">
                        <i class='ti ti-plus'></i>Create new Public Relations
                    </a>
                    <a href="<?php echo site_url("public-relations-insert-form"); ?>" class="btn btn-primary d-sm-none btn-icon">
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
                <table id="PublicRelationsTable" class="display responsive nowrap" style="width:100%;margin:10 0 10 0;">
                    <!-- text-nowrap -->
                    <thead>
                        <tr>
                            <th class="w-1">No.</th>
                            <th style="width:5%;">Topic</th>
                            <th style="width:5%;">Detail</th>
                            <th style="width:5%;">Type</th>
                            <th style="width:17%;">Start date</th>
                            <th style="width:5%;">Finish date</th>
                            <th style="width:5%;">School Name</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php //print_r($publicrelations); ?>
                        <?php $i = 1;
                        foreach ($publicrelations as $pr) { ?>
                            <tr>
                                <td>
                                    <?php echo $i ?>
                                </td>
                                <td>
                                <?php echo $pr["pr_topic"] ?>
                                </td>
                                <td>
                                    <?php echo $pr["pr_descriptions"] ?>
                                </td>
                                <td>
                                    <?php echo $pr["pr_type"] ?>
                                </td>
                                
                                <td>
                                    <?php echo tothaishortdate($pr["pr_startdate"]) ?>
                                </td>
                                <td>
                                    <?php echo tothaishortdate($pr["pr_enddate"]) ?>
                                </td>
                                <td>
                                    <?php echo $pr["school_name"] ?>
                                </td>
                                <td class='text-center'>
                                    <button class="btn btn-edit" id="<?php echo $pr["pr_id"] ?>">
                                        <i class='ti ti-edit'></i>Edit
                                    </button>
                                    <button class="btn btn-delete" id="<?php echo $pr["pr_id"] ?>">
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
    $('#PublicRelationsTable').DataTable({
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
        location.href = "<?php echo site_url("public-relations-edit-form/"); ?>" + $(this).attr('id');
    });

    $(".btn-delete").on("click", function () {
        if (confirm("delete ?")) {
            $.ajax({
                type: "POST",
                url: "<?php echo site_url("PublicRelationsController/delete_publicrelations") ?>",
                data: {
                    inPr: $(this).attr('id')
                },
            }).done(function (data) {
               
                location.reload();
            });
        } else {

        }
    });
</script>
