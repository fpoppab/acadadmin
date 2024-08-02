<?php

function get_client_ip()
{
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if (getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if (getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if (getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if (getenv('HTTP_FORWARDED'))
        $ipaddress = getenv('HTTP_FORWARDED');
    else if (getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}

function todate($epoch)
{
    return date("Y-m-d", $epoch);
}

// function tothaidate($epoch)
// {
//     $newEpochTime = strtotime("+543 years", $epoch);
//     return date("j/n/", $epoch) . date("Y", $newEpochTime);
// }

function tothaishortdate($epoch)
{
    if (!empty($epoch)) {
        $date = date("Y-m-d", substr($epoch, 0, 10));
        $pieces = explode("-", $date);
        $day = $pieces[2];
        $month = $pieces[1];
        $year = $pieces[0] + 543;
        return $day . " " . tothaishortmonth($month) . " " . $year;
    } else {
        return "";
    }
}

function tothaifulldate($epoch)
{
    if (!empty($epoch)) {
        $date = date("Y-m-d", substr($epoch, 0, 10));
        $pieces = explode("-", $date);
        $day = $pieces[2];
        $month = $pieces[1];
        $year = $pieces[0] + 543;
        return $day . " " . tothaifullmonth($month) . " " . $year;
    } else {
        return "";
    }
}

function tothaifullmonth($num)
{
    if ($num >= 1 && $num <= 12) {
        $thaiMonth = array(
            "01" => "มกราคม",
            "02" => "กุมภาพันธ์",
            "03" => "มีนาคม",
            "04" => "เมษายน",
            "05" => "พฤษภาคม",
            "06" => "มิถุนายน",
            "07" => "กรกฎาคม",
            "08" => "สิงหาคม",
            "09" => "กันยายน",
            "10" => "ตุลาคม",
            "11" => "พฤศจิกายน",
            "12" => "ธันวาคม",
        );
        return $thaiMonth[$num];
    }
}

function tothaishortmonth($num)
{
    if ($num >= 1 && $num <= 12) {
        $thaiMonth = array(
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
        return $thaiMonth[$num];
    }
}

function thaimoth_to_month_db($month)
{
    $thaimonth = array("ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");
    return str_replace(array('01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'), $thaimonth, $month);
}

function insert_zero_f_position($number, $pos)
{

    $cnt = strlen($number);
    $str = $number;
    for ($i = 0; $i < ($pos - $cnt); $i++) {
        $str = "0" . $str;
    }

    return $str;
}
