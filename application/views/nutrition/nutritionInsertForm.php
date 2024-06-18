
<!-- Page header -->
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <h2 class="page-title text-muted">
                    <a class='text-blue' href="<?php echo site_url("nutrition"); ?>">Nutrition</a>/
                    <?php echo (!empty($this->uri->segment(2))) ? "Edit Nutrition" : "Create new Nutrition"; ?>
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
                        <input type="hidden" id="inNutritionId" name="inNutritionId" value="<?php echo (!empty($this->uri->segment(2))) ? $this->uri->segment(2) : ""; ?>" />
                        <div class="card-body">
                            <h2 class="mb-4">Nutrition</h2>
                            <h3 class="card-title mt-4">Information</h3>
                            <div class="row g-3">

                            <div class="col-md">
                                    <?php _label("ชื่อเมนูอาหาร"); ?>
                                    <input type="text" class="form-control" id="inNutritionName" name="inNutritionName" value="<?php echo (!empty($row["nutrition_name"])) ? $row["nutrition_name"] : ""; ?>" required />
                                </div>

                                <div class="col-md">
                                <?php _label("ปริมาณแคลอลี่ที่ได้รับ"); ?>
                                <input type="number" class="form-control" id="inNutritionCalories" name="inNutritionCalories" minlength="1900" maxlength="3000" value="<?php echo (!empty($row["nutrition_calories"])) ? $row["nutrition_calories"] : ""; ?>" required/>
                                </div>
                            </div>
                            <div class="row g-3">
                            <div class="col-md">
                            <h3 class="card-title">Nutrition Image</h3>
                            <div class="row align-items-center">
                                <input type='file' id="inNutritionLogo" style="display:none;" />
                                <input type='hidden' id="inNutritionimage64" name="inNutritionimage64" style="display:none;" value="<?php echo (!empty($row["nutrition_image"])) ? $row["nutrition_image"] : ""; ?>" />
                                <div class="col-auto">
                                    <span class="avatar avatar-xl" id="food-image" style="background-image: url('<?php echo (!empty($row["nutrition_image"])) ? $row["nutrition_image"] : ""; ?>');">
                                    </span>
                                </div>
                                <div class="col-auto">
                                    <a href="#" class="btn" id="btn-change-image">Change images</a>
                                </div>
                            </div>
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
        $('#inNutritionLogo').trigger('click');
    });

    $("#inNutritionLogo").change(function() {
        readURL(this);
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $("#inNutritionimage64").val(e.target.result);
                $('#food-image').css('background-image', 'url(' + e.target.result + ')');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#insert-form").submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: " <?php echo site_url("NutritionController/update_nutrition") ?>",
            data: $(this).serialize(),
        }).done(function(data) {

            alert (data);
            // alert ("บันทึกสำเร็จ !!");
            //$("#inFirstName").addClass("is-invalid");
            location.reload();
        });
    });
</script>