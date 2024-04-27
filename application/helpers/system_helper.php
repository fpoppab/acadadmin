<?php

function get_client_ip() {
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

function todate($epoch) {
    return date("Y-m-d", $epoch);
}

function tothaidate($epoch) {
    $newEpochTime = strtotime("+543 years", $epoch);
    return date("j/n/", $epoch) . date("Y", $newEpochTime);
}

function tothaishortdate($epoch) {
    $newEpochTime = strtotime("+543 years", $epoch);
    return date("j ") . tothaishortmonth(date("n", $epoch)) . date(" y", $newEpochTime);
}

function tothaifulldate($epoch) {
    $newEpochTime = strtotime("+543 years", $epoch);
    return date("j ") . tothaifullmonth(date("n", $epoch)) . date(" Y", $newEpochTime);
}

function tothaifullmonth($num) {
    if ($num >= 1 && $num <= 12) {
        $thaiMonth = array(
            1 => "มกราคม",
            2 => "กุมภาพันธ์",
            3 => "มีนาคม",
            4 => "เมษายน",
            5 => "พฤษภาคม",
            6 => "มิถุนายน",
            7 => "กรกฎาคม",
            8 => "สิงหาคม",
            9 => "กันยายน",
            10 => "ตุลาคม",
            11 => "พฤศจิกายน",
            12 => "ธันวาคม",
        );
        return $thaiMonth[$num];
    }
}

function tothaishortmonth($num) {
    if ($num >= 1 && $num <= 12) {
        $thaiMonth = array(
            1 => "ม.ค.",
            2 => "ก.พ.",
            3 => "มี.ค.",
            4 => "เม.ย.",
            5 => "พ.ค.",
            6 => "มิ.ย.",
            7 => "ก.ค.",
            8 => "ส.ค.",
            9 => "ก.ย.",
            10 => "ต.ค.",
            11 => "พ.ย.",
            12 => "ธ.ค.",
        );
        return $thaiMonth[$num];
    }
}

function thaimoth_to_month_db($month) {
    $thaimonth = array("ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");
    return str_replace(array('01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'), $thaimonth, $month);
}

function insert_zero_f_position($number, $pos) {

    $cnt = strlen($number);
    $str = $number;
    for ($i = 0; $i < ($pos - $cnt); $i++) {
        $str = "0" . $str;
    }

    return $str;
}
