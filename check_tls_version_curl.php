<?php
/**
 * Created by PhpStorm.
 * author: harris
 * Date: 17-9-22
 * Time: 下午3:58
 */

/**
 * @param null $sslversion
 * @param $info
 * @return string
 */
function get_tls_version($sslversion = null, &$info = '')
{
    $var_explode = explode('/', __FILE__);
    array_pop($var_explode);
    $sdk_path = '';
    foreach ($var_explode as $number) {
        $sdk_path .= $number . '/';
    }
    $c = curl_init();
    curl_setopt($c, CURLOPT_URL, "https://www.howsmyssl.com/a/check"); //https://www.howsmyssl.com/a/check
    curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($c, CURLOPT_HEADER, false);
    curl_setopt($c, CURLOPT_CONNECTTIMEOUT, 0);
    curl_setopt($c, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($c, CURLOPT_SSL_VERIFYPEER, true);
    curl_setopt($c, CURLOPT_SSL_VERIFYHOST, 2);
//    curl_setopt($c, CURLOPT_SSL_CIPHER_LIST, "TLSv1");
    curl_setopt($c, CURLOPT_CERTINFO, TRUE);
    /*curl_setopt($c, CURLOPT_SSLCERT, $sdk_path . 'c-qpyl.pem');
    curl_setopt($c, CURLOPT_CAINFO, $sdk_path . 'ca.crt');*/
    if ($sslversion !== null) {
        curl_setopt($c, CURLOPT_SSLVERSION, $sslversion);
    }
    $rbody = curl_exec($c);
    $info = curl_getinfo($c);
    if ($rbody === false) {
        $errno = curl_errno($c);
        $msg = curl_error($c);
        curl_close($c);
        return "Error! errno = " . $errno . ", msg = " . $msg;
    } else {
        $r = json_decode($rbody);
        curl_close($c);
        return isset($r->tls_version) ? $r->tls_version : 'not supported tls';
    }
}

function show_tls_detail()
{
    $string = "<pre>\n";
    $string .= "OS: " . PHP_OS . "\n";
    $string .= "uname: " . php_uname() . "\n";
    $string .= "PHP version: " . phpversion() . "\n";
    $curl_version = curl_version();
    $string .= "curl version: " . $curl_version["version"] . "\n";
    $string .= "SSL version: " . $curl_version["ssl_version"] . "\n";
    $string .= "SSL version number: " . $curl_version["ssl_version_number"] . "\n";
    $string .= "OPENSSL_VERSION_NUMBER: " . dechex(OPENSSL_VERSION_NUMBER) . "\n";
    $string .= "TLS test (default): " . get_tls_version() . "\n";
    $string .= "TLS test (TLS_v1): " . get_tls_version(1) . "\n";
    $string .= "TLS test (TLS_v1_2): " . get_tls_version(6, $info) . "\n";
    $string .= "version all detail: " . json_encode($curl_version, JSON_PRETTY_PRINT);
    $string .= "result detail: " . json_encode($info, JSON_PRETTY_PRINT);
    $string .= "</pre>\n";
    return $string;
}

//phpinfo();
echo show_tls_detail();