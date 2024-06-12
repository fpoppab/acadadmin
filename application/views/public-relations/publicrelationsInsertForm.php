<!-- Page header -->
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <h2 class="page-title text-muted">
                    <a class='text-blue' href="<?php echo site_url("public-relations"); ?>">Public Relations</a>/
                    <?php echo (!empty($this->uri->segment(2))) ? "Edit Public Relations" : "Create new Public Relations"; ?>
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
                        <input type="hidden" id="inPr" name="inPr" value="<?php echo (!empty($this->uri->segment(2))) ? $this->uri->segment(2) : ""; ?>" />
                        <div class="card-body">
                            <h2 class="mb-4">Public Relations</h2>
                            <div class="row g-3">
                                <div class="col-md">
                                    <?php _label("Topic"); ?>
                                    <input type="text" class="form-control " id="inTopic" name="inTopic" value="<?php echo (!empty($row["pr_topic"])) ? $row["pr_topic"] : ""; ?>" required />
                                </div>
                                <div class="col-md">
                                <?php _label("Type"); ?>
                                    <select type="text" class="form-select tomselected " id="inType" name="inType" required>
                                        <option value="">เลือกข้อมูล</option>
                                        <?php $type = array("ภายใน", "ภายนอก"); ?>
                                        <?php foreach ($type as $t) { ?>
                                            <?php $sel = (!empty($row["pr_type"]) && $row["pr_type"] == $t) ? "selected" : ""; ?>
                                            <option value="<?php echo $t ?>" <?php echo $sel ?>><?php echo $t ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row g-3">
                                <div class="col-md">
                                    <?php _label("Detail"); ?>
                                    <textarea class="form-control" id="inDescriptions" name="inDescriptions" rows="4"><?php echo (!empty($row["pr_descriptions"])) ? $row["pr_descriptions"] : ""; ?></textarea>
                                </div>
                            </div>
                            <div class="row g-3">
                                <div class="col-md">
                                    <?php _label("Start date"); ?>
                                    <input type="date" class="form-control" id="inStartDate" name="inStartDate" value="<?php echo (!empty($row["pr_startdate"])) ? todate($row["pr_startdate"]) : ""; ?>" />
                                </div>
                                <div class="col-md">
                                    <?php _label("Finish date"); ?>
                                    <input type="date" class="form-control" id="inEndDate" name="inEndDate" value="<?php echo (!empty($row["pr_enddate"])) ? todate($row["pr_enddate"]) : ""; ?>" />
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
    $("#insert-form").submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: " <?php echo site_url("PublicRelationsController/update_publicRelations") ?>",
            data: $(this).serialize(),
        }).done(function(data) {
            alert ("บันทึกข้อมูลสำเร็จ");
            //$("#inFirstName").addClass("is-invalid");
            location.reload();
        });
    });
</script>