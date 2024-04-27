<!-- Page header -->
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <!-- Page pre-title -->
                <h2 class="page-title text-muted">
                    Permission
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
                    <a href="<?php echo site_url("user-insert-form"); ?>" class="btn btn-primary d-none d-sm-inline-block">
                        <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                            stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M12 5l0 14" />
                            <path d="M5 12l14 0" />
                        </svg>
                        Create new user
                    </a>
                    <a href="<?php echo site_url("user-insert-form"); ?>" class="btn btn-primary d-sm-none btn-icon">
                        <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                            stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M12 5l0 14" />
                            <path d="M5 12l14 0" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Page body -->
<div class="page-body">
    <div class="container-xl">
        <div class="card ">
            <div class="table-responsive p-3">
                <table id="usertable" class="display responsive nowrap" style="width:100%;margin:10 0 10 0;">
                    <thead>
                        <tr>
                            <th class="w-1">No.</th>
                            <th>Email</th>
                            <th>Username</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($users as $r) { ?>
                            <tr>
                                <td>
                                    <span class="text-muted">
                                        <?= $i ?>
                                    </span>
                                </td>
                                <td>
                                    <a href="#" class="text-reset" tabindex="-1">
                                        <?php echo $r["email"] ?>
                                    </a>
                                </td>
                                <td>
                                    <?php echo $r["username"] ?>
                                </td>
                                <td>
                                    <?php echo tothaishortdate($r["created_at"]); ?>
                                </td>
                                <td>
                                    <?php echo tothaishortdate($r["updated_at"]); ?>
                                </td>

                                <td>
                                    <span class="badge bg-success me-1"></span> Active
                                </td>
                                <td class='text-center'>
                                    <button class="btn btn-edit d-none d-sm-inline-block" id="<?php echo $r["id"] ?>">
                                        <i class='ti ti-edit'></i>Edit
                                    </button>
                                    <buttona class="btn btn-delete d-none d-sm-inline-block" id="<?php echo $r["id"] ?>">
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
    $('#usertable').DataTable({
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
</script>