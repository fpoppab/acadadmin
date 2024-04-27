<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <h2 class="page-title">
                    Activity
                </h2>
            </div>
        </div>
    </div>
</div>
<!-- Page body -->
<div class="page-body">
    <div class="container-xl">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="divide-y">
                            <?php foreach ($Logs as $r) { ?>
                                <div>
                                    <div class="row">
                                        <div class="col-auto">
                                            <span class="avatar">LOG</span>
                                        </div>
                                        <div class="col">
                                            <div class="text-truncate">
                                            <?php echo $r["type"]?>
                                                <?php if ($r["status"] === "success") { ?>
                                                    <strong class="text-success">
                                                        <?php echo $r["status"] ?>
                                                    </strong>
                                                <?php } else { ?>
                                                    <strong class="text-danger">
                                                        <?php echo $r["status"] ?>
                                                    </strong>
                                                <?php } ?>
                                                <?php echo $r["detail"] ?>
                                            </div>
                                            <div class="text-muted">
                                                <?php //echo $r["created_at"]?>
                                                <?php echo tothaishortdate($r["created_at"]); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>