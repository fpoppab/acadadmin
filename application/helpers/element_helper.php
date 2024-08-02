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

function _datepickerth($name, $id, $epoch = 0, $type = "student")
{
    if (!empty($epoch)) {
        $date = date("Y-m-d", $epoch);
    } else {
        $date = date("Y-m-d");
    }
    $pieces = explode("-", $date);

    $day = $pieces[2];
    $dayArr = array(
        "01" => 1,
        "02" => 2,
        "03" => 3,
        "04" => 4,
        "05" => 5,
        "06" => 6,
        "07" => 7,
        "08" => 8,
        "09" => 9,
        "10" => 10,
        "11" => 11,
        "12" => 12,
        "13" => 13,
        "14" => 14,
        "15" => 15,
        "16" => 16,
        "17" => 17,
        "18" => 18,
        "19" => 19,
        "20" => 20,
        "21" => 21,
        "22" => 22,
        "23" => 23,
        "24" => 24,
        "25" => 25,
        "26" => 26,
        "27" => 27,
        "28" => 28,
        "29" => 29,
        "30" => 30,
        "31" => 31,
    );

    $dp = "
        <span style='width:30%;float: left;'>
            <select id='" . $id . "Day' name='" . $id . "Day' class='form-select'>";
    foreach ($dayArr as $keyD => $d) {
        $select = ($keyD == $day) ? "selected" : "";
        $dp .= "<option value='$keyD' $select>$d</option>";
    }
    $dp .= "</select>
        </span>";


    $month = $pieces[1];
    $monthArr = array(
        "01" => "ม.ค.",
        "02" => "ก.พ.",
        "03" => "มี.ค.",
        "04" => "เม.ย.",
        "05" => "พ.ค.",
        "06" => "มิ.ย.",
        "07" => "ก.ค.",
        "08" => "ส.ค.",
        "09" => "ก.ย.",
        "10" => "ต.ค.",
        "11" => "พ.ย.",
        "12" => "ธ.ค.",
    );
    $dp .= "
        <span style='width:35%;float: left;'>
            <select id='" . $id . "Month' name='" . $id . "Month' class='form-select'>";
    foreach ($monthArr as $keyM => $m) {
        $select = ($keyM == $month) ? "selected" : "";
        $dp .= "<option value='$keyM' $select>$m</option>";
    }
    $dp .= "
            </select>
        </span>";

    $year = $pieces[0] + 543;
    $dp .= "
        <span style='width:35%;float: left;'>
            <select id='" . $id . "Year' name='" . $id . "Year' class='form-select'>";
    if ($type == "student") {
        for ($y = 2567; $y >= 2547; $y -= 1) {
            $select = ($y == $year) ? "selected" : "";
            $dp .= "<option value='" . ($y - 543) . "' $select>$y</option>";
        }
    } else {
        for ($y = 2567; $y >= 2497; $y -= 1) {
            $select = ($y == $year) ? "selected" : "";
            $dp .= "<option value='" . ($y - 543) . "' $select>$y</option>";
        }
    }
    $dp .= "</select>
        </span>
    </select>";

    return $dp;
}