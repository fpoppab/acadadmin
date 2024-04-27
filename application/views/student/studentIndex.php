<!-- Page header -->

<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <!-- Page pre-title -->
                <h2 class="page-title text-muted">
                    Student
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
                    <a href="<?php echo site_url("student-insert-form"); ?>"
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
<!-- Page body -->
<div class="page-body">
    <div class="container-xl">
        <div class="card">
            <div class="card-body table-responsive">
                <table id="studentTable" class="display responsive nowrap" style="width:100%;margin:10 0 10 0;">
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
                                    <?php echo $s["nickname"] ?>
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
                                <td>
                                    <?php echo $s["bloodtype"] ?>
                                </td>
                                <td>
                                    <?php echo $s["phonenumber"] ?>
                                </td>
                                <td>
                                    <?php echo $s["religion"] ?>
                                </td>
                                <td>
                                    <?php echo $s["ethnicity"] ?>
                                </td>
                                <td>
                                    <?php echo $s["nationality"] ?>
                                </td>
                                <td class='text-center'>
                                    <button class="btn btn-edit d-none d-sm-inline-block" id="<?php echo $s["std_id"] ?>">
                                        <i class='ti ti-edit'></i>Edit
                                    </button>
                                    <buttona class="btn btn-delete d-none d-sm-inline-block" id="<?php echo $s["std_id"] ?>">
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
    $('#studentTable').DataTable({
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
        location.href = "<?php echo site_url("student-edit-form/"); ?>" + $(this).attr('id');
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
        } else {

        }
    });
</script>