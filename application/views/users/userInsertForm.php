<!-- Page header -->
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <!-- Page pre-title -->
                <div class="page-pretitle">
                    <a href="<?php echo site_url("users"); ?>">Users</a>
                </div>
                <h2 class="page-title text-muted">
                    Create new user
                </h2>
            </div>
        </div>
    </div>
</div>
<!-- Page body -->
<div class="page-body">
    <div class="container-xl">
        <div class="card">
            <div class="row g-0">
                <div class="col d-flex flex-column">
                    <form id="insert-form" method="post" autocomplete="off" enctype="multipart/form-data">
                        <input type="hidden" id="inUserId" name="inUserId"
                            value="<?php echo (!empty($this->uri->segment(2))) ? $this->uri->segment(2) : ""; ?>" />
                        <div class="card-body">
                            <h2 class="mb-4">User</h2>
                            <h3 class="card-title">User Image</h3>

                            <div class="row align-items-center">
                                <?= imagelogo(array("inputID" => "inProfileImage")); ?>
                            </div>

                            <div class="row g-3">
                                <div class="col-md">
                                    <?php _label("Type"); ?>
                                    <select class="form-select tomselected " id="inTitleName" name="inTitleName">
                                        <?php $title = array("User", "Admin"); ?>
                                        <?php foreach ($title as $t) { ?>
                                            <?php $sel = (!empty($row["titlename"]) && $row["titlename"] == $t) ? "selected" : ""; ?>
                                            <option value="<?php echo $t ?>" <?php echo $sel ?>>
                                                <?php echo $t ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md">
                                    <?php _label("Username"); ?>
                                    <input type="text" class="form-control " id="inUsername" name="inUsername"
                                        value="<?php echo (!empty($row["firstname"])) ? $row["firstname"] : ""; ?>"
                                        required />
                                </div>
                                <div class="col-md">
                                    <?php _label("Password"); ?>
                                    <input type="text" class="form-control" id="inPassword" name="inPassword"
                                        value="<?php echo (!empty($row["idcard"])) ? $row["idcard"] : ""; ?>"
                                        required />
                                </div>
                                <div class="col-md">
                                    <?php _label("Email"); ?>
                                    <input type="text" class="form-control" id="inEmail" name="inEmail"
                                        value="<?php echo (!empty($row["lastname"])) ? $row["lastname"] : ""; ?>" />
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent mt-auto">
                            <div class="btn-list justify-content-end">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>


    $("#insert-form").submit(function (e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "<?php echo (!empty($this->uri->segment(2))) ? site_url("StudentController/update_student") : site_url("StudentController/insert_student"); ?>",
            data: $(this).serialize(),
        }).done(function (data) {
            //$("#inFirstName").addClass("is-invalid");
            location.reload();
        });
    });
</script>