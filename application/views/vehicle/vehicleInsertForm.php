<!-- Page header -->
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <h2 class="page-title text-muted">
                    <a class='text-blue' href="<?php echo site_url("vehicle"); ?>">Vehicle</a>/
                    <?php echo (!empty($this->uri->segment(2))) ? "Edit Vehicle" : "Create new Vehicle"; ?>
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
                        <input type="hidden" id="inVc" name="inVc" value="<?php echo (!empty($this->uri->segment(2))) ? $this->uri->segment(2) : ""; ?>" />
                        <div class="card-body">
                            <h2 class="mb-4">Vehicle</h2>
                            <div class="row g-3">
                                <div class="col-md">
                                    <h3 class="card-title">Image</h3>
                                    <div class="row align-items-center">
                                        <input type='file' id="inVehicleLogo" style="display:none;" />
                                        <input type='hidden' id="inVehicleLogo64" name="inVehicleLogo64" style="display:none;" value="<?php echo (!empty($row["vehicle_image"])) ? $row["vehicle_image"] : ""; ?>" />
                                    <div class="col-auto">
                                        <span class="avatar avatar-xl" id="vehicle-image" style="background-image: url('<?php echo (!empty($row["vehicle_image"])) ? $row["vehicle_image"] : ""; ?>');"></span>
                                    </div>
                                    <div class="col-auto">
                                        <a href="#" class="btn" id="btn-change-image">Select image</a>
                                    </div>
                                </div>
                                </div>
                            </div>
                            <div class="row g-3">
                                <div class="col-md">
                                    <?php _label("License Plate"); ?>
                                    <input type="text" class="form-control " id="inLicense" name="inLicense" value="<?php echo (!empty($row["vehicle_license_plate"])) ? $row["vehicle_license_plate"] : ""; ?>" required />
                                </div>
                                <div class="col-md">
                                    <?php _label("Code"); ?>
                                    <input type="text" class="form-control " id="inCode" name="inCode" value="<?php echo (!empty($row["vehicle_code"])) ? $row["vehicle_code"] : ""; ?>" />
                                </div>
                            </div>
                            <div class="row g-3">
                                <div class="col-md">
                                    <?php _label("Driver"); ?>
                                    <input type="text" class="form-control " id="inDriver" name="inDriver" value="<?php echo (!empty($row["vehicle_driver_name"])) ? $row["vehicle_driver_name"] : ""; ?>" />
                                </div>
                                <div class="col-md">
                                    <?php _label("Brand"); ?>
                                    <input type="text" class="form-control " id="inBrand" name="inBrand" value="<?php echo (!empty($row["vehicle_brand"])) ? $row["vehicle_brand"] : ""; ?>" />
                                </div>
                                <div class="col-md">
                                    <?php _label("Model"); ?>
                                    <input type="text" class="form-control " id="inModel" name="inModel" value="<?php echo (!empty($row["vehicle_model"])) ? $row["vehicle_model"] : ""; ?>" />
                                </div>
                                <div class="col-md">
                                    <?php _label("Capacity"); ?>
                                    <input type="number" class="form-control" id="inCapacity" name="inCapacity" value="<?php echo (!empty($row['vehicle_capacity'])) ? $row['vehicle_capacity'] : ''; ?>" max="99" required />
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
    $("#btn-change-image").click(function() {
        $('#inVehicleLogo').trigger('click');
    });

    $("#inVehicleLogo").change(function() {
        readURL(this);
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $("#inVehicleLogo64").val(e.target.result);
                $('#vehicle-image').css('background-image', 'url(' + e.target.result + ')');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#insert-form").submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: " <?php echo site_url("VehicleController/update_vehicle") ?>",
            data: $(this).serialize(),
        }).done(function(data) {
            alert ("บันทึกข้อมูลสำเร็จ");
            //$("#inFirstName").addClass("is-invalid");
            location.reload();
        });
    });
</script>