<?php

require_once APPPATH . '../vendor/autoload.php';

//$mpdf = new \Mpdf\Mpdf();
$defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
$fontDirs = $defaultConfig['fontDir'];

$defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
$fontData = $defaultFontConfig['fontdata'];

$mpdf = new \Mpdf\Mpdf([
    'fontDir' => array_merge($fontDirs, [
        APPPATH . '../assets/font',
    ]),
    'fontdata' => $fontData + [
'th_sarabun' => [
    'R' => 'THSarabun.ttf',
]
    ],
    'default_font' => 'th_sarabun',
    'margin_left' => 5,
    'margin_right' => 5,
    'margin_top' => 5,
    'margin_bottom' => 2,
        ]);
$mpdf->debug = false;
$stylesheet = file_get_contents(base_url("assets/css/mpdf.css"));
$mpdf->SetTitle($title);
$content = "";
if(!empty($myContent)){
        foreach($myContent as $c){
                $content .= $c;
        }
}
$mpdf->WriteHTML($content);
$mpdf->Output();