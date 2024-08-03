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
                            <th>Name</th>
                            <th>Email</th>
                            <th>Username</th>
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
                                    <?php echo $r["fullname"] ?>
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
                                    <?php if (!empty($r["username"])) { ?>
                                        <?= ($r["status"]) ? "<span class='badge bg-success me-1'>Active</span>" : "<span class='badge bg-warning me-1'>Disable</span>"; ?>
                                    <?php } else { ?>
                                        <span class='badge bg-danger me-1'>No user</span>
                                    <?php } ?>
                                </td>
                                <td class='text-center'>
                                    <?php if ($r['status']) { ?>
                                        <button class="btn btn-disable " id="<?php echo $r["user_id"] ?>">
                                            <i class='ti ti-user-off'></i><span class="d-none d-sm-inline-block"> Disable</span>
                                        </button>
                                        <button class="btn btn-menu " id="<?php echo $r["user_id"] ?>">
                                            <i class='ti ti-user-shield'></i><span class="d-none d-sm-inline-block">
                                                Menu</span>
                                        </button>
                                    <?php } else { ?>
                                        <?php if (empty($r["username"])) { ?>
                                            <button class="btn btn-generate " id="<?php echo $r["id"] ?>">
                                                <i class='ti ti-user-plus'></i></i><span class="d-none d-sm-inline-block"> Create
                                                    user</span>
                                            </button>
                                        <?php } else { ?>
                                            <button class="btn btn-enable " id="<?php echo $r["user_id"] ?>">
                                                <i class='ti ti-user-check'></i><span class="d-none d-sm-inline-block">
                                                    Enable</span>
                                            <?php } ?>
                                        </button>
                                    <?php } ?>
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
<script>
    $(".btn-generate").on("click", function () {
        $.ajax({
            type: "POST",
            url: "<?php echo site_url("UserController/generate_user_by_personnel") ?>",
            data: {
                personnel_id: $(this).attr('id')
            },
        }).done(function (data) {
            location.reload();
        });
    });

    $(".btn-disable").on("click", function () {
        if (confirm("คุณต้องการจะปิดการใช้งานผู้ใช้นี้ใช่หรือไม่ ?")) {
            $.ajax({
                type: "POST",
                url: "<?php echo site_url("UserController/disable_user") ?>",
                data: {
                    user_id: $(this).attr('id')
                },
            }).done(function (data) {
                location.reload();
            });
        }
    });

    $(".btn-enable").on("click", function () {
        $.ajax({
            type: "POST",
            url: "<?php echo site_url("UserController/enable_user") ?>",
            data: {
                user_id: $(this).attr('id')
            },
        }).done(function (data) {
            location.reload();
        });
    });
</script>