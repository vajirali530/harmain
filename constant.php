<?php

define('BASE_URL', $_SERVER['REQUEST_SCHEME']."://".$_SERVER['SERVER_NAME']."/".explode("/",$_SERVER['PHP_SELF'])[1]."/");
define('IMAGE_URL', BASE_URL.'images');

define('ADMIN_EMAIL', 'azimkhan.baloch@qalbit.com'); 
define('MAIL_USERNAME', 'vajirali.asamdi@qalbit.com');
define('MAIL_USER_PASSWORD', 'qalb@2020');
define('FROM_EMAIL', 'vajirali.asamdi@qalbit.com');
define('FROM_NAME', 'Harmain');

/**
 * Captcha
 */
define('GOOGLE_CAPTCHA_SITE_KEY', '6LcChYUdAAAAAM-0cXd6UtDgZkkSZ_k-LM-8ZKqr');
define('GOOGLE_CAPTCHA_SECRET_KEY', '6LcChYUdAAAAAIm5hTGtw8m-jA8ehsIkTMw3rzLo');
define('GOOGLE_CAPTCHA_SCORE_LIMIT', 0.5);

function pre($data) {
    echo "<pre>";
    print_r($data);
    echo "</pre>";
    exit;
}
function pr($data) {
    echo "<pre>";
    print_r($data);
    echo "</pre>";
}

function sendmail($to = '', $subject = '', $message = '', $attachment = ''){
    include './mail.php';
    return $status;
}

function verifyCaptchaScore($recaptcha_response){
    $recaptcha = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . GOOGLE_CAPTCHA_SECRET_KEY . '&response=' . $recaptcha_response);
    $recaptcha = json_decode($recaptcha);

    if (isset($recaptcha->score) && $recaptcha->score >= GOOGLE_CAPTCHA_SCORE_LIMIT) {
        return true;
    }else{
        return false;
    }
}