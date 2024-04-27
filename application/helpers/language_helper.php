<?php
function menu_a($text, $url, $lg = "english")
{
    $str = "<a class=\"dropdown-item\" href=\"" . site_url($url) . "\">";
    if ($lg == "english") {
        $str .= $text;
    } 
    $str .= "</a>";
    echo $str;
}