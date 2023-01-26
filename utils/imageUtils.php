<?php
    // Utils
    require_once('../../lib/kus/PHPImage.php');

    const LOGODIR = "../images/templates/logos/";

    function font($weight='Regular')
    {
        return 'fonts/Merriweather-'.$weight.'.ttf';
    }

    function multiline($lines, $params, $margin, $y)
    {
        global $image;

        foreach ($lines as $idx=>$line) {
            $params['y'] = $y + ($params['fontSize'] + $margin)*$idx;
            if (is_array($line)) {
                $text = $line[0];
                foreach ($line[1] as $key=>$param) {
                    $params[$key] = $param;
                }
            } else {
                $text = $line;
            }
            $image->text($text, $params);
        }

        return $image;
    }

    function getColors()
    {
        $colors['lightGray'] = array(67, 67, 67);
        $colors['lightBlue'] = array(247, 251, 252);
        $colors['darkGray'] = array(89, 90, 91);
        $colors['blue'] = array(40,100,175);
        $colors['white'] = array(255, 255, 255);
        $colors['darkBlue'] = array(64, 98, 171);
        $colors['deepBlue'] = array(00, 15, 15);
        $colors['black'] = array(20,20,20);
        $colors['navyBlue'] = array(10,39,87);
        return $colors;
    }

    function getAgentData()
    {
        return unserialize(base64_decode($_REQUEST['agent']));
    }

    function doLogoReplace($company)
    {
        $companies = array("allstate", "independent", "fbfs", "country", "american");
        if (in_array($company, $companies)) {
            return true;
        } else {
            return false;
        }
    }

    function getCompanyLogo($company, $size, $is_postCard=false)
    {
        if (isset($size) && $size == 'sm') {
            return LOGODIR.$company.'_sm.png';
        } elseif (isset($size) && $size == 'not_available') {
            return LOGODIR.$company.'_na.png';
        } else {
            if ($is_postCard) {
                // $company = 'white_logos/'.$company;
                $company;
            }
            return LOGODIR.$company.'.png';
        }
    }

    function getLogoHeight()
    {
        $logoHeight = 100;

        return $logoHeight;
    }


    function cleanup($image)
    {
        imagedestroy($image);
    }

    function getName()
    {
        global $templateNumber;
        $lastNames = ['Black','Rusch','Broome','Reamer','Wheeler','Cannon','Shelton','Lehman','Jackson','White', 'Smith', 'Sanders', 'White'];
        $firstNames = ['Jason','Gerald','David','Catherine','Jessica','Amanda','Judy','Allison','Elizabeth','Julie', 'Jack', 'Craig', 'Sarah'];

        return $firstNames[$templateNumber].' '.$lastNames[$templateNumber];
    }

    function getAddress()
    {
        global $templateNumber;
        $addresses = ['1121 Winifred Way','3590 Wayford Dr.','5600 Bell St.','5394 Princeton St.','3992 Carriage St.','7294 Maud St.','4602 Vesta Dr.','2848 Felosa Dr.','6548 Meadow View Dr.','1640 Richland Ave.', '3661 Formosa Dr.', '757 Orange Ave.', '1142 Spring St.'];

        return $addresses[$templateNumber];
    }

    function getBodyText()
    {
        global $agent;
        $state = $agent['state'];
        $disaster = false;
        $flooding = array("MA","NJ","NY","VA");
        $hurricanes = array("AL","FL","GA","LA","MS","NC","SC","TX");
        $tornadoes = array("IL","IA","KS","MO","NE","OK","SD");
        $wildfires = array("AK","AZ","CA","CO","ID","MT","NV","NM","OR","UT","WA");
        $generic = array("AR","CT","DE","HI","IN","KY","ME","MD","MI","MN","NH","ND","OH","PA","RI","TN","TX","VT","WV","WI","WY");
        if (in_array($state, $flooding)) {
            $disaster = "flooding";
        } elseif (in_array($state, $hurricanes)) {
            $disaster = "hurricanes";
        } elseif (in_array($state, $tornadoes)) {
            $disaster = "tornadoes";
        } elseif (in_array($state, $wildfires)) {
            $disaster = "wildfires";
        } else {
            $disaster = false;
        }

        $txt = "";

        if ($disaster) {
            $txt = "Because of the recent ".$disaster.", insurance companies are already increasing premiums at alarming rates.";
        } else {
            $txt = "Insurance rates change daily, which probably means you’re overpaying.";
        }

        $txt .= " 2018 is the year to shop your home insurance! Don’t wait! Call us now at ".$agent['phone']." and lock in a better rate today!";

        return $txt;
    }

    function justifiedText($text, $options=array())
    {
        global $image;

        // Unset null values so they inherit defaults
        foreach ($options as $k => $v) {
            if ($options[$k] === null) {
                unset($options[$k]);
            }
        }

        $black = imagecolorallocate($image->getResource(), 0, 0, 0);
        $blue = imagecolorallocate($image->getResource(), 54, 98, 170);

        $defaults = array(
            'img'=>$image->getResource(),
            'size'=>9.5,
            'angle' => 0,
            'left' => 0,
            'top' => 0,
            'color' => $black,
            'font' => font('Regular'),
            'width' => 300,
            'minspacing' => 2,
            'linespacing' => 1
        );
        extract(array_merge($defaults, $options), EXTR_OVERWRITE);
        $wordwidth              = array();
        $linewidth              = array();
        $linewordcount          = array();
        $largest_line_height    = 0;
        $lineno                 = 0;
        $words                  = explode(" ", $text);
        $wln                    = 0;
        $linewidth[$lineno]     = 0;
        $linewordcount[$lineno] = 0;
        foreach ($words as $word) {
            $dimensions  = imagettfbbox($size, $angle, $font, $word);
            $line_width  = $dimensions[2] - $dimensions[0];
            $line_height = $dimensions[1] - $dimensions[7];
            if ($line_height > $largest_line_height) {
                $largest_line_height = $line_height;
            }
            if (($linewidth[$lineno] + $line_width + $minspacing) > $width) {
                $lineno++;
                $linewidth[$lineno]     = 0;
                $linewordcount[$lineno] = 0;
                $wln                    = 0;
            }
            $linewidth[$lineno] += $line_width + $minspacing;
            $wordwidth[$lineno][$wln] = $line_width;
            $wordtext[$lineno][$wln]  = $word;
            $linewordcount[$lineno]++;
            $wln++;
        }
        for ($ln = 0; $ln <= $lineno; $ln++) {
            $slack = $width - $linewidth[$ln];
            if (($linewordcount[$ln] > 1) && ($ln != $lineno)) {
                $spacing = ($slack / ($linewordcount[$ln] - 1));
            } else {
                $spacing = $minspacing;
            }
            $x = 0;
            for ($w = 0; $w < $linewordcount[$ln]; $w++) {
                if (preg_match('/^[0-9]*-[0-9]*-[0-9]*$/', $wordtext[$ln][$w])) {
                    $color = $blue;
                    font('Bold');
                } else {
                    $color = $black;
                    font('Regular');
                }
                imagettftext($img, $size, $angle, $left + intval($x), $top + $largest_line_height + ($largest_line_height * $ln * $linespacing), $color, $font, $wordtext[$ln][$w]);
                $x += $wordwidth[$ln][$w] + $spacing + $minspacing;
            }
        }
        return true;
    }
