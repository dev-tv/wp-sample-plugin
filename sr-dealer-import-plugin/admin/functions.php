<?php

if (!session_id()) {
    session_start();
}

$extentions = [
    'doc',
    'docx',
    'pdf',
    'pps',
    'pptx',
    'rar',
    'zip'
];

function encrypt($text, $key, $iv, $bit_check) {
    $text_num = str_split($text, $bit_check);
    $text_num = $bit_check - strlen($text_num [count($text_num) - 1]);
    for ($i = 0; $i < $text_num; $i ++) {
        $text = $text . chr($text_num);
    }
    $cipher = mcrypt_module_open(MCRYPT_TRIPLEDES, '', 'cbc', '');
    mcrypt_generic_init($cipher, $key, $iv);
    $decrypted = mcrypt_generic($cipher, $text);
    mcrypt_generic_deinit($cipher);
    return base64_encode($decrypted);
}

function decrypt($encrypted_text, $key, $iv, $bit_check) {
    $cipher = mcrypt_module_open(MCRYPT_TRIPLEDES, '', 'cbc', '');
    mcrypt_generic_init($cipher, $key, $iv);
    $decrypted = mdecrypt_generic($cipher, base64_decode($encrypted_text));
    mcrypt_generic_deinit($cipher);
    $last_char = substr($decrypted, - 1);
    for ($i = 0; $i < $bit_check - 1; $i ++) {
        if (chr($i) == $last_char) {
            $decrypted = substr($decrypted, 0, strlen($decrypted) - $i);
            break;
        }
    }
    return $decrypted;
}

function is_validate_date($date, $formate = "m/d/Y H:i:s", $return_formate = "m/d/Y H:i:s", $current_date_allowed = false) {
    if (!strrpos($formate, " H:i:s")) {
        $formate .= " H:i:s";
        $date .= " 00:00:00";
    }

    $d = DateTime::createFromFormat($formate, $date);
    if ($d && $d->format($formate) === $date)
        return array("timestamp" => $d->getTimestamp(), "date_str" => $d->format($return_formate));
    else if ($current_date_allowed)
        return array("timestamp" => time(), "date_str" => date($return_formate));
    return false;
}
