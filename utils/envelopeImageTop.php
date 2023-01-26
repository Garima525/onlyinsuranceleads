<?php

    require_once('imageUtils.php');

    $agent = '';
    $image = '';
    $colors = getColors();

    $type = $_GET['type'];

    init($type);

    function init($type)
    {
        global $agent, $image, $colors;
        $agent = getAgentData();
        $image = createImage($type);
    }


    function createImage($type)
    {
        global $agent, $image, $colors;

        $image = new PHPImage();
        $subType = '';
        if ($type == 'printProduction') {
            $subType = $_GET['subType'];
            if ($subType=='postcard') {
                $bg = '../images/printProductionpostcard.jpg';
            } else {
                $bg = '../images/printProductionLetter.jpg';
            }
            $image->setDimensionsFromImage($bg);
            $image->setOutput('jpg', 55);
        } elseif ($type == 'envelope') {
            $bg = '../images/header/printedLetter.png';
            $image->setDimensionsFromImage($bg);
            $image->setOutput('png', 7);
        }

        $image->draw($bg);
        $image->setFont(font('Bold'));

        replaceLogo($type, $subType);
        if ($type == 'printProduction') {
            $image->resize(834, 888);
        }
        $image->show();
    }

    // Replace existing generic company logo
    function replaceLogo($type, $subType)
    {
        global $agent, $image, $colors, $imageDir;

        $company = strtolower($agent['company']);
        if (!doLogoReplace($company)) {
            return false;
        }
        $logoHeight = getLogoHeight();


        if ($type == 'printProduction') {
            $center = $image->getWidth() / 2 - 120;
            if ($subType=='postcard') {
                // $image->rectangle($center-180, 735, 370, 120, $colors['navyBlue'], 1);
                $x = 940;
                $y = 960;
                $textX = 0;
                $textColor = $colors['white'];
                $textWidth = $image->getWidth()-300;
                $textY = $logoHeight + $y;
            } else {
                // $image->rectangle($center, 740, 450, 150, $colors['white'], 1);
                $x = $center+160;
                $y = 780;
                $textX = 150;
                $textColor = $colors['darkGray'];
                $textWidth = $image->getWidth();
                $textY = $logoHeight + $y+14;
            }
            $textY = $logoHeight + $y;
            $fontSize = 13;
            if ($subType=='postcard') {
                $logoUrl = getCompanyLogo($company, 'sm', true);
            } else {
                $logoUrl = getCompanyLogo($company, 'not_available', true);
            }
        } elseif ($type == 'envelope') {
            $center = $image->getWidth() / 2 - 120;
            // $image->rectangle(300, 060, 150, 76, $colors['white'], 1);
            $x = 35;
            $y = 54;
            $textY = $logoHeight + $y - 75;
            $fontSize = 8;
            // $logoUrl = getCompanyLogo($company, 'sm');
        }

        $image->draw($logoUrl, $x, $y);
        if ($subType !='postcard') {
            // $image->text($agent['nobreakname'], array(
                // 'fontSize' => $fontSize, // Desired starting font size
                // 'x' => $textX,
                // 'y' => $textY ,
                // 'fontColor' => $textColor,
                // 'fontFile' => font('Regular'),
                // 'width' => $textWidth,
                // 'height' => 50,
                // 'alignHorizontal' => 'center',
                // 'alignVertical' => 'center'
            // ));
        }
    }
