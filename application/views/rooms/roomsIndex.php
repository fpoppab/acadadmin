<!-- Page header -->
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <!-- Page pre-title -->
                <div class="page-pretitle">
                    School
                </div>
                <h2 class="page-title">
                    Room and Homeroom
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
                    <a href="<?php echo site_url("room-insert-form"); ?>"
                       class="btn btn-primary d-none d-sm-inline-block">
                        <i class='ti ti-plus'></i>Create new room
                    </a>
                    <a href="<?php echo site_url("room-insert-form"); ?>" class="btn btn-primary d-sm-none btn-icon">
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
        <div class="row ">
            <div class="col-12 d-flex flex-column">
                <div class="card">
                    <div class="card-body table-responsive">
                        <table id="roomTable" class="display responsive nowrap" style="width:100%;margin:10 0 10 0;">
                            <!-- text-nowrap -->
                            <thead>
                                <tr>
                                    <th class="w-1">No.</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!empty($room)) {
                                    $i = 1;

                                    foreach ($room as $r) {
                                        ?>
                                        <tr>
                                            <td> <?php echo $i ?></td>
                                            <td><?php echo $r["clss_room"] ?> </td>
                                            <td class='text-center '>
                                                <button class="btn btn-edit d-none d-sm-inline-block"
                                                        id="<?= $r["room_id"] ?>">
                                                    <i class='ti ti-edit'></i>Edit
                                                </button>
                                                <button class="btn btn-delete d-none d-sm-inline-block"
                                                         id="<?= $r["room_id"] ?>">
                                                    <i class='ti ti-trash'></i>Delete
                                                 </button>
                                                <button class="btn btn-student d-none d-sm-inline-block"
                                                         id="<?= $r["room_id"] ?>">
                                                    <i class='ti ti-users-group'></i>Student
                                                 </button>
                                        </td>
                                        </tr>
                                        <?php
                                        $i++;
                                    }
                                }
                                ?>
                                </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $('#roomTable').DataTable({
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
        location.href = "<?php echo site_url("room-edit-form/"); ?>" + $(this).attr('id');
    });
    
        $(".btn-student").on("click", function () {
        location.href = "<?php echo site_url("room-edit-list/"); ?>" + $(this).attr('id');
    });

    // $(".btn-delete").on("click", function () {
    //     if (confirm("delete ?")) {
    //         $.ajax({
    //             type: "POST",
    //             url: "<?php echo site_url("StudentController/delete_student") ?>",
    //             data: {
    //                 inStdId: $(this).attr('id')
    //             },
    //         }).done(function (data) {
    //             alert(data);
    //             location.reload();
    //         });
    //     } else {

    //     }
    // });
</script>