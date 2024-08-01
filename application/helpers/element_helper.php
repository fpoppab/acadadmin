<?php
function _label($text, $clss = "")
{
    echo "<div class=\"form-label {$clss}\">" . language($text) . "</div>";
}

function _input($type = "text", $id = "", $name = "", $value = "", $req = "")
{
    echo "<input type=\"{$type}\" class=\"form-control\" id=\"{$id}\" name=\"{$name}\"  {$req} value=\"{$value}\" >";
}


function _display_image($img)
{
    return "data:image/png;base64," . base64_encode($img);
}

function language($text, $language = null)
{
    $json = file_get_contents(base_url("resource/inputLanguage.json"));
    $json_data = json_decode($json, true);
    $result = $text;
    if (!empty($json_data[$language][$text])) {
        $result = $json_data[$language][$text];
    }
    return $result;
}

function datatable($config)
{
    if (!empty($config["tablename"])) {
        $tb = "
        <script>
            $('#" . $config["tablename"] . "').DataTable({
                responsive: true,
                columnDefs: [
                    {
                        className: 'dtr-control arrow-right',
                        orderable: false,  
                    }
                ],
                language: {
                    url: '" . base_url("languages/th_DataTable.json") . "'
                }
            });
        </script>";
        return $tb;
    } else {
        return "";
    }

}

function imagelogo($config)
{
    if (!empty($config["inputID"])) {
        $tb = "
        <input type='file' id='" . $config["inputID"] . "' style='display:none;' />
        <div class='col-auto'>
            <span class='avatar avatar-xl btn' id='" . $config["inputID"] . "-logo-image'
                style='background-image: url(\"" . base_url('resource/no-image.jpg') . "\")'>
            </span>
        </div>
        <script>
            $('#" . $config["inputID"] . "-logo-image').click(function () {
                $('#" . $config["inputID"] . "').trigger('click');
            });
            $('#" . $config["inputID"] . "').change(function () {
                if (this.files && this.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('#" . $config["inputID"] . "-logo-image').css('background-image', 'url(' + e.target.result + ')');
                    }
                    reader.readAsDataURL(this.files[0]);
                }
            });
        </script> ";
        return $tb;
    } else {
        return "";
    }






}