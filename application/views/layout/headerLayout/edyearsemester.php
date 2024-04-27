<?php $headerEdyear = $this->session->userdata("userEdyear"); ?>
<?php $headerSemester = $this->session->userdata("userSemester"); ?>
<div class="nav-item d-none d-md-flex me-3">
    <select class="form-select" id="inHeaderEdyear">
        <?php
        $edyear = date("Y") + 543;
        $min = $edyear - 5;
        $max = $edyear + 5;
        for ($x = $min; $x <= $max; $x++) { ?>
            <?php $chk = ($x == $headerEdyear) ? "selected" : ""; ?>
            <option value="<?= $x; ?>" <?= $chk; ?>>
                ปีการศึกษา
                <?= $x ?>
            </option>
        <?php } ?>
    </select>
</div>
<div class="nav-item d-none d-md-flex me-3">
    <select class="form-select" id="inHeaderSemester">
        <?php
        for ($x = 1; $x <= 2; $x++) { ?>
            <?php $chk = ($x == $headerSemester) ? "selected" : ""; ?>
            <option value="<?= $x; ?>" <?= $chk; ?>>
                ภาคเรียนที่
                <?= $x ?>
            </option>
        <?php } ?>
    </select>
</div>
<script>
    $("#inHeaderEdyear").on("change", function () {
        $.ajax({
            type: "POST",
            url: "<?php echo site_url("Welcome/set_edyear") ?>",
            data: {
                Edyear: $(this).val()
            },
        }).done(function (data) {
            location.reload();
        });
    });

    $("#inHeaderSemester").on("change", function () {
        $.ajax({
            type: "POST",
            url: "<?php echo site_url("Welcome/set_semester") ?>",
            data: {
                Semester: $(this).val()
            },
        }).done(function (data) {
            location.reload();
        });
    });
</script>