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
                    <a href="<?php echo site_url("user-insert-form"); ?>"
                        class="btn btn-primary d-none d-sm-inline-block ">
                        <i class='ti ti-plus'></i>Create new user
                    </a>
                    <a href="<?php echo site_url("user-insert-form"); ?>" class="btn btn-primary d-sm-none btn-icon">
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
                                    <button class="btn btn-edit" id="<?php echo $r["id"] ?>">
                                        <i class='ti ti-edit'></i><span class="d-none d-sm-inline-block">Edit</span>
                                    </button>
                                    <button class="btn btn-delete " id="<?php echo $r["id"] ?>">
                                        <i class='ti ti-trash'></i><span class="d-none d-sm-inline-block">Delete</span>
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

<?= datatable(array("tablename" => "usertable")); ?>