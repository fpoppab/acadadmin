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
                        <div class="card-body">
                            <h2 class="mb-4">Personnel</h2>
                            <h3 class="card-title">User Image</h3>
                            <div class="row align-items-center">
                                <input type='file' id="inPersonnelLogo" style="display:none;" />
                                <input type='hidden' id="inPersonnelLogo64" name="inPersonnelLogo64"
                                    style="display:none;" value="" />
                                <div class="col-auto">
                                    <span class="avatar avatar-xl" id="logo-image" style="background-image: url('');">
                                    </span>
                                </div>

                                <div class="col-auto">
                                    <a href="#" class="btn" id="btn-change-image">Change avatar</a>
                                </div>
                            </div>
                            <h3 class="card-title mt-4">Information</h3>
                            <div class="row g-3">
                                <div class="col-md">
                                    <?php _label("Title Name"); ?>
                                    <?php _input($type = "text", $id = "inTitleName", $name = "inTitleName", $value = "") ?>

                                </div>
                                <div class="col-md">
                                    <?php _label("First Name"); ?>
                                    <?php _input($type = "text", $id = "inFirstName", $name = "inFirstName", $value = "") ?>
                                </div>
                                <div class="col-md">
                                    <?php _label("Last Name"); ?>
                                    <?php _input($type = "text", $id = "inLastName", $name = "inLastName", $value = "") ?>
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