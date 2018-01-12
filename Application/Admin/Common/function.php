<?php

//获取域名
function getDomain() {
    $http = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
    return $http . $_SERVER['HTTP_HOST'];
}

function show_date($time, $format = 'Y-m-d') {
    if((int)$time == 0) return null;
    return date($format, $time);
}

function md5_password($password) {
    return md5(C('USER_KEY').$password);
}