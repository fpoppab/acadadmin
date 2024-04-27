<?php
function _label($text,$clss="")
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