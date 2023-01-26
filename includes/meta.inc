<?php date_default_timezone_set('America/Los_Angeles'); ?>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=.75">
<meta name="format-detection" content="telephone=no">
<link rel="stylesheet" href="../css/main.min.css?v=<?php echo filemtime($_SERVER['DOCUMENT_ROOT'].'/css/main.min.css'); ?>" media="print, screen">
<link rel="stylesheet" href="../css/style.css?v=<?php echo filemtime($_SERVER['DOCUMENT_ROOT'].'/css/style.css'); ?>" media="print, screen">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.2.6/css/swiper.min.css" integrity="sha256-/MUsbxMVqlXbxtYsVUN7Scrbq8Hd5Up+BntZl2TuMLQ=" crossorigin="anonymous" />

<?php
    function get_browser_name($user_agent)
    {
        if (strpos($user_agent, 'Opera') || strpos($user_agent, 'OPR/')) {
            return 'Opera';
        } elseif (strpos($user_agent, 'Edge')) {
            return 'Edge';
        } elseif (strpos($user_agent, 'Chrome')) {
            return 'Chrome';
        } elseif (strpos($user_agent, 'Safari')) {
            return 'Safari';
        } elseif (strpos($user_agent, 'Firefox')) {
            return 'Firefox';
        } elseif (strpos($user_agent, 'MSIE') || strpos($user_agent, 'Trident/7')) {
            return 'Internet Explorer';
        }

        return 'Other';
    }

    // Usage:
    if (get_browser_name($_SERVER['HTTP_USER_AGENT']) == 'Internet Explorer') {
        echo "<link rel='stylesheet' href='../css/ie.css' media='all' />";
    } elseif (get_browser_name($_SERVER['HTTP_USER_AGENT']) == 'Edge') {
        echo "<link rel='stylesheet' href='../css/edge.css' media='print, screen' />";
    } elseif (get_browser_name($_SERVER['HTTP_USER_AGENT']) == 'Safari') {
        echo "<link rel='stylesheet' href='../css/safari.css' media='print, screen' />";
    }
?>

<link rel="shortcut icon" href="images/favicons/favicon.ico">
<link rel="apple-touch-icon-precomposed" href="../images/favicons/favicon_152.png">
<meta name="msapplication-TileColor" content="#201338">
<meta name="msapplication-TileImage" content="../images/favicons/favicon_144.png">
<script src="//code.jquery.com/jquery-3.3.0.min.js" integrity="sha256-RTQy8VOmNlT6b2PIRur37p6JEBZUE7o8wPgMvu18MC4=" crossorigin="anonymous"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/gsap/1.20.3/TweenMax.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/livequery/1.1.1/jquery.livequery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.2.6/js/swiper.min.js" integrity="sha256-NCAKIW9CtzSpcjpTZ2RbtRfDHgNrQuK/akgMYogPwSw=" crossorigin="anonymous"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/gsap/1.20.3/plugins/ScrollToPlugin.min.js" async defer></script>
<script src="../js/bundle.min.js?v=<?php echo filemtime($_SERVER['DOCUMENT_ROOT'].'../js/bundle.min.js'); ?>" async defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.js" integrity="sha256-Tb4gdeCN/ACKmhKQ3BSfbuNgIVYQzBlEvbYlwK7juDw=" crossorigin="anonymous" async defer></script>

<!-- google captcha form -->
<script type="text/javascript">
   var onloadCallback = function() {
     grecaptcha.render('html_element', {
       'sitekey' : '6LcFhQMcAAAAAGl4n5b2L7wfQ9FG6V0faQjQ69En'
     });
   };
 </script>
<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit"
        async defer>
</script>
