<?php

require_once APPPATH . '../vendor/autoload.php';

$defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
$fontDirs = $defaultConfig['fontDir'];

//$defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
//$fontData = $defaultFontConfig['fontdata'];
//
//$mpdf = new \Mpdf\Mpdf([
//    'fontDir' => array_merge($fontDirs, [
//        APPPATH . '../assets/fonts',
//    ]),
//    'fontdata' => $fontData + [
//'th_sarabun' => [
//    'R' => 'THSarabun.ttf',
//]
//    ],
//    'default_font' => 'th_sarabun',
//    'margin_left' => 5,
//    'margin_right' => 5,
//    'margin_top' => 5,
//    'margin_bottom' => 2,
//        ]);
//$mpdf->debug = false;
//$stylesheet = file_get_contents(base_url("assets/css/mpdf.css"));
//
//$mpdf->WriteHTML($stylesheet, 1);

//$hdcss = '<style>
//    .row {
//    display: -ms-flexbox;
//    display: flex;
//    -ms-flex-wrap: wrap;
//    flex-wrap: wrap;
//    margin-right: -7.5px;
//    margin-left: -7.5px;
//}
//    .col-md-6{
//    position: relative;
//    width: 100%;
//    padding-right: 7.5px;
//    padding-left: 7.5px;
//    flex: 0 0 50%;
//    max-width: 50%;
//    }
//    .rotate90 {
//        -webkit-transform: rotate(90deg);
//        -moz-transform: rotate(90deg);
//        -o-transform: rotate(90deg);
//        -ms-transform: rotate(90deg);
//        transform: rotate(90deg);
//    }
//    .rotate180 {
//        -webkit-transform: rotate(180deg);
//        -moz-transform: rotate(180deg);
//        -o-transform: rotate(180deg);
//        -ms-transform: rotate(180deg);
//        transform: rotate(180deg);
//    }
//    .rotate270 {
//        -webkit-transform: rotate(270deg);
//        -moz-transform: rotate(270deg);
//        -o-transform: rotate(270deg);
//        -ms-transform: rotate(270deg);
//        transform: rotate(270deg);
//    }
//
//
//    .c-progress-steps {
//        margin: 0;
//        list-style-type: none;
//        font-family: Lato;
//    }
//    .c-progress-steps li {
//        position: relative;
//        font-size: 14px;
//        color: #7f8c8d;
//        padding: 2px 0 2px 23px;
//    }
//    .c-progress-steps li a {
//        color: inherit;
//    }
//    .c-progress-steps li.done {
//        color: #2ecc71;
//    }
//    .c-progress-steps li.done:before {
//        color: #2ecc71;
//        content: "\f058";
//    }
//    .c-progress-steps li.current {
//        color: #3498db;
//        font-weight: bold;
//    }
//    .c-progress-steps li.current:before {
//        color: #3498db;
//        content: "\f192";
//    }
//    .c-progress-steps li:before {
//        position: absolute;
//        left: 0;
//        font: normal normal normal 14px/1 FontAwesome;
//        font-size: 22px;
//        background-color: #fff;
//        content: "\f10c";
//    }
//    @media all and (max-width: 600px) {
//        .c-progress-steps li:before {
//            top: calc(50% - 8px);
//            font-size: 16px;
//        }
//    }
//    @media all and (min-width: 600px) {
//        .c-progress-steps {
//            display: table;
//            list-style-type: none;
//            margin: 20px auto;
//            padding: 0;
//            table-layout: fixed;
//            width: 100%;
//        }
//        .c-progress-steps li {
//            display: table-cell;
//            text-align: center;
//            padding: 0;
//            padding-bottom: 10px;
//            white-space: nowrap;
//            position: relative;
//            border-left-width: 0;
//            border-bottom-width: 4px;
//            border-bottom-style: solid;
//            border-bottom-color: #7f8c8d;
//        }
//        .c-progress-steps li.done {
//            border-bottom-color: #2ecc71;
//        }
//        .c-progress-steps li.current {
//            color: #3498db;
//            font-size: 16px;
//            line-height: 14px;
//            border-bottom-color: #3498db;
//        }
//        .c-progress-steps li.current:before {
//            color: #3498db;
//            content: "\f192";
//        }
//        .c-progress-steps li:before {
//            bottom: -14px;
//            left: 50%;
//            margin-left: -9px;
//        }
//    }
//
//
//</style>';
//$mpdf->WriteHTML($hdcss, 1);
if (!empty($title)) {
    $mpdf->SetTitle($title);
}
$mpdf->SetDisplayMode('fullpage');
//------------------------------------------------------------------------------

if (!empty($header)) {
    $mpdf->SetHTMLHeader($header);
}

if(count($myContent)>0){
        $i=0;
        foreach($myContent as $content){
                $mpdf->WriteHTML($content);
                $i++;
                if($i<count($myBody))
                {
                        $mpdf->AddPage();
                }
        }
}
$mpdf->Output($title.'.pdf','I');