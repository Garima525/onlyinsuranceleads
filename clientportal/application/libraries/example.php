<?php

// load composer autoloader
require 'vendor/autoload.php';
// disable Dompdf autoloader
define('DOMPDF_ENABLE_AUTOLOAD', false);
// require dompdf config file
require_once "vendor/dompdf/dompdf/dompdf_config.inc.php";
//
$pathToPdfs = array();
for ($i = 0; $i < 10; $i++) {
    // create the barcode
    $code = randomstring();
    $pathToBarcode = generate_barcode($code);
    // create html for dompdf
    $barcode_html = "\n\t\t    <img src='" . $pathToBarcode . "' \n\t\t    \t\t\tstyle='position: absolute; \n\t\t    \t\t\ttop: -40px; \n\t\t    \t\t\tleft: -40px; \n\t\t    \t\t\twidth:280px; \n\t\t    \t\t\theight: 70px;' >\n\t\t    <div style='position: absolute; top: 11px; left: 30px; width: 80px; height: 20px; text-align: center; background-color:white; text-transform: uppercase;'>\n\t\t    \t\t" . $code . "\n\t\t    </div>";
    // init dompdf and set paper size
    $dompdf = new DOMPDF();
    $customPaper = array(0, 0, 175, 60);
    $dompdf->set_paper($customPaper);
    // load html to dompdf
    $dompdf->load_html($barcode_html);
    // render the pdf
    $dompdf->render();
    // cleanup barcode png
    if (file_exists($pathToBarcode)) {
        unlink($pathToBarcode);
    }
    // save pdf to temp dir
    $output = $dompdf->output();
    $pdfName = $code . '.pdf';
    file_put_contents('temp/' . $pdfName, $output);
    // keep track of generated pdf's
    $pathToPdfs[] = 'temp/' . $pdfName;
}
// load pdfmerger
include 'pdfmerger/PDFMerger.php';
$pdf = new PDFMerger();
// add each pdf to pdf merger
foreach ($pathToPdfs as $pathToPdf) {
    $pdf->addPDF($pathToPdf, 'all');
}
// save merged pdf
$mergedname = 'hardcopy_barcodes.pdf';
$pdf->merge('download', $mergedname);
// cleanup temp pdf's
foreach ($pathToPdfs as $pathToPdf) {
    if (file_exists($pathToPdf)) {
        unlink($pathToPdf);
    }
}

function randomstring($length = 6) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}

function generate_barcode($text) {
    $size = '23';
    $orientation = 'horizontal';
    $code_string = "";
    // Translate the $text into barcode (code128)
    $chksum = 104;
    // Must not change order of array elements as the checksum depends on the array's key to validate final code
    $code_array = array(" " => "212222", "!" => "222122", "\"" => "222221", "#" => "121223", "\$" => "121322", "%" => "131222", "&" => "122213", "'" => "122312", "(" => "132212", ")" => "221213", "*" => "221312", "+" => "231212", "," => "112232", "-" => "122132", "." => "122231", "/" => "113222", "0" => "123122", "1" => "123221", "2" => "223211", "3" => "221132", "4" => "221231", "5" => "213212", "6" => "223112", "7" => "312131", "8" => "311222", "9" => "321122", ":" => "321221", ";" => "312212", "<" => "322112", "=" => "322211", ">" => "212123", "?" => "212321", "@" => "232121", "A" => "111323", "B" => "131123", "C" => "131321", "D" => "112313", "E" => "132113", "F" => "132311", "G" => "211313", "H" => "231113", "I" => "231311", "J" => "112133", "K" => "112331", "L" => "132131", "M" => "113123", "N" => "113321", "O" => "133121", "P" => "313121", "Q" => "211331", "R" => "231131", "S" => "213113", "T" => "213311", "U" => "213131", "V" => "311123", "W" => "311321", "X" => "331121", "Y" => "312113", "Z" => "312311", "[" => "332111", "\\" => "314111", "]" => "221411", "^" => "431111", "_" => "111224", "\\`" => "111422", "a" => "121124", "b" => "121421", "c" => "141122", "d" => "141221", "e" => "112214", "f" => "112412", "g" => "122114", "h" => "122411", "i" => "142112", "j" => "142211", "k" => "241211", "l" => "221114", "m" => "413111", "n" => "241112", "o" => "134111", "p" => "111242", "q" => "121142", "r" => "121241", "s" => "114212", "t" => "124112", "u" => "124211", "v" => "411212", "w" => "421112", "x" => "421211", "y" => "212141", "z" => "214121", "{" => "412121", "|" => "111143", "}" => "111341", "~" => "131141", "DEL" => "114113", "FNC 3" => "114311", "FNC 2" => "411113", "SHIFT" => "411311", "CODE C" => "113141", "FNC 4" => "114131", "CODE A" => "311141", "FNC 1" => "411131", "Start A" => "211412", "Start B" => "211214", "Start C" => "211232", "Stop" => "2331112");
    $code_keys = array_keys($code_array);
    $code_values = array_flip($code_keys);
    for ($X = 1; $X <= strlen($text); $X++) {
        $activeKey = substr($text, $X - 1, 1);
        $code_string .= $code_array[$activeKey];
        $chksum = $chksum + $code_values[$activeKey] * $X;
    }
    $code_string .= $code_array[$code_keys[$chksum - intval($chksum / 103) * 103]];
    $code_string = "211214" . $code_string . "2331111";
    // Pad the edges of the barcode
    $code_length = 40;
    for ($i = 1; $i <= strlen($code_string); $i++) {
        $code_length = $code_length + (int) substr($code_string, $i - 1, 1);
    }
    if (strtolower($orientation) == "horizontal") {
        $img_width = $code_length;
        $img_height = $size;
    } else {
        $img_width = $size;
        $img_height = $code_length;
    }
    $image = imagecreate($img_width, $img_height);
    $black = imagecolorallocate($image, 0, 0, 0);
    $white = imagecolorallocate($image, 255, 255, 255);
    imagefill($image, 0, 0, $white);
    // $code_string = "2112141133211133211133211133211133211133212311132331111";
    $location = 5;
    for ($position = 1; $position <= strlen($code_string); $position++) {
        $cur_size = $location + substr($code_string, $position - 1, 1);
        if (strtolower($orientation) == "horizontal") {
            imagefilledrectangle($image, $location, 0, $cur_size, $img_height, $position % 2 == 0 ? $white : $black);
        } else {
            imagefilledrectangle($image, 0, $location, $img_width, $cur_size, $position % 2 == 0 ? $white : $black);
        }
        $location = $cur_size;
    }
    // save barcode to path
    $filename = 'temp/barcodes/' . $text . ".png";
    if (!imagepng($image, $filename)) {
        return false;
    }
    return $filename;
}
