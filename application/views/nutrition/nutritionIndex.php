<!-- Page header -->
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <!-- Page pre-title -->
                <h2 class="page-title text-muted">
                Nutrition
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
                    <a href="<?php echo site_url("nutrition-insert-form"); ?>"
                        class="btn btn-primary d-none d-sm-inline-block">
                        <i class='ti ti-plus'></i>Create new Nutrition
                    </a>
                    <a href="<?php echo site_url("nutrition-insert-form"); ?>" class="btn btn-primary d-sm-none btn-icon">
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
        <div class="card">
            <div class="card-body table-responsive">
                <table id="NutritionTable" class="display responsive nowrap" style="width:100%;margin:10 0 10 0;">
                    <!-- text-nowrap -->
                    <thead>
                        <tr>
                            <th class="w-1">No.</th>
                            <th style="width:3%;">ชื่อเมนูอาหาร</th>
                            <th style="width:5%;">ปริมาณแคลอลี่ที่ได้รับ</th>
                            <th style="width:7%;">รูปตัวอย่างเมนูอาหาร</th>
                            <th style="width:5%;">ชื่อโรงเรียนที่เป็นเจ้าของข้อมูล</th>
                            <th style="width:1%;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
                        foreach ($nutrition as $n) { ?>
                            <tr>
                                <td>
                                    <?php echo $i ?>
                                </td>
                                <td>
                                    <?php echo $n["nutrition_name"] ?>
                                </td>
                                <td>
                                    <?php echo $n["nutrition_calories"] ?>
                                </td>
                                <td>

                                    <span class="avatar avatar-sm" id="food-image"
                                        style="background-image: url('<?php echo $n["nutrition_image"] ?>');">
                                    </span>

                                </td>
                                <td>
                                    <?php echo $n["school_name"] ?>
                                </td>
                                <td class='text-center'>
                                    <button class="btn btn-edit d-none d-sm-inline-block" id="<?php echo $n["nutrition_id"] ?>">
                                        <i class='ti ti-edit'></i>Edit
                                    </button>
                                    <buttona class="btn btn-delete d-none d-sm-inline-block" id="<?php echo $n["nutrition_id"] ?>">
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
    $('#NutritionTable').DataTable({
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

    $(".btn-edit").on("click", function () {
        location.href = "<?php echo site_url("nutrition-edit-form/"); ?>" + $(this).attr('id');
    });

    $(".btn-delete").on("click", function () {
        if (confirm("delete ?")) {
            $.ajax({
                type: "POST",
                url: "<?php echo site_url("NutritionController/delete_nutrition") ?>",
                data: {
                    inNutritionId: $(this).attr('id')
                },
            }).done(function (data) {
               
                location.reload();
            });
        } else {

        }
    });
</script>