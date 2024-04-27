<!-- Page header -->

<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <!-- Page pre-title -->
                <h2 class="page-title text-muted">
                    Student Report
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
                    <a href="<?php echo site_url("student-report-print-all"); ?>"
                        class="btn btn-primary d-none d-sm-inline-block">
                        <i class='ti ti-plus'></i>Print all
                    </a>
                    <a href="<?php echo site_url("student-report-print-all"); ?>" class="btn btn-primary d-sm-none btn-icon">
                        <i class='ti ti-printer'></i>
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
                        if(!empty($student)){
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
                                        <button class="btn btn-pp1 d-none d-sm-inline-block" id="<?php echo $s["std_id"] ?>">
                                            <i class='ti ti-file'></i>ปพ.1
                                        </button>
                                        <buttona class="btn btn-pp2 d-none d-sm-inline-block" id="<?php echo $s["std_id"] ?>">
                                            <i class='ti ti-file'></i>ปพ.2
                                            </button>
                                    </td>
                                </tr>
                                <?php $i++;
                            }
                        }?>
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

    $(".btn-pp1").on("click", function () {
        location.href = "<?php echo site_url("student-report-pp1/"); ?>" + $(this).attr('id');
    });
    
        $(".btn-pp2").on("click", function () {
        location.href = "<?php echo site_url("student-report-pp2/"); ?>" + $(this).attr('id');
    });
</script>