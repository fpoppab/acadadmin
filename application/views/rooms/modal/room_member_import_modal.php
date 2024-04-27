<div class='modal fade' id='room-member-import-modal'>
    <div class='modal-dialog modal-md'>
        <div class='modal-content'>
            <form method='post' id='room-member-import-form' enctype='multipart/form-data'>
                <div class='modal-header '>
                    <h4 class='modal-title'>นำเข้ารายชื่อนักเรียน</h4>
                </div>
                <div class='modal-body'>


                    <div class="row">
                        <div class="col-md-12  form-group">
                            <span class="star" style="font-size: 1em !important;">1. รูปแบบไฟล์ &nbsp;<button type="button" onclick="Export(this)" class="btn btn-excel-export"><i class="ti ti-download"></i> ไฟล์ Excel (.xls)</button></span>
                           <hr>
                           2. เลือกไฟล์ <input type="file" name="inImpExcel" id="inImpExcel" class="filestyle" />
                        </div>
                    </div>
                    <input type="hidden" name="inRoomId" id="inRoomId" value="<?php echo $room["room_id"]?>" />
                </div>
                <div class='modal-footer justify-content-end' >
                    <button type="button" class="btn btn-success d-none d-sm-inline-block" onclick="Import(this)" ><i class='ti ti-upload'></i>  Upload</button>
                </div>
        </div>

        </form>
    </div>
</div>
</div>
<!-- /.modal -->
<script>
    function Import(e) {
        let myForm = document.getElementById('room-member-import-form');
        $.ajax({
            url: "<?php echo site_url('student-import'); ?>",
            method: "post",
            data: new FormData(myForm),
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
               alert('อัพโหลดข้อมูลสำเร็จ');
                $("#room-member-import-form")[0].reset();
                $('#room-member-import-modal').modal('hide');
                location.reload();
            }
        });
    }


</script>