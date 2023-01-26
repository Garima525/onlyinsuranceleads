<?php
    // $templateOrder = array('6','7','2','8','1','5','4','9','3','10','11','12');
    $templateOrder = array(
        // '16',
        // '13',
        // '15',
        // '14',
        // '6',
        // '7',
        // '8',
        // '1',
        'new1',
        'new2',
        'new3'
    );
    // $templateOrder = array(
    // 	'13','14','15','16'
    // );

    $numTemplates = count($templateOrder);
    require_once($_SERVER['DOCUMENT_ROOT'] . '/mailings/prospects.php');

    for ($i=0; $i < $numTemplates; $i++) {
        ?>
		<div class="letterSlide swiper-slide">
			<?php
                $num = $templateOrder[$i];
        $type = "letter";
        $url = "/mailings/mailing.php?id=" . $num . "&type=" . $type;
        if ($agent) {
            $ag = base64_encode(serialize($agent));
            $url = $url . '&agent=' . $ag;
        }

        if ($location) {
            $url = $url.'&location='.$location;
        }
        $prospect = $prospects[$num]; ?>
			<div class="slideMask">
				<a class="letterPreviewToggle mailingItem" data-fancybox="gallery" data-type="iframe" data-animation-effect="fade" data-animation-duration="800" data-fancybox="gallery" data-src="<?php echo $url.'&check=popup'; ?>"></a>
			</div>
			<iframe src="<?php echo $url; ?>" class="letterFrame mailingItem" data-prospect-firstname="<?php echo $prospect['first_name']?>" data-prospect-lastname="<?php echo $prospect['last_name']?>" data-prospect-address="<?php echo $prospect['address']?>" seamless="seamless" frameborder="0"></iframe>
		</div>
<?php
    }
?>
