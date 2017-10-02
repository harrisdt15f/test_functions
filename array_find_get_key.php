<?php
/**
 * Created by PhpStorm.
 * author: harris
 * Date: 17-9-26
 * Time: 下午1:06
 */

$versions = [
    '1.0.0' => [
        'dir' => 'sdk-php1',
        'namespace' => 'sdk_php',
    ],
    //订单前缀
    '1.0.1' => [
        'dir' => 'sdk-php',
        'namespace' => 'sdk_php_beta1',
    ],
];

function search_arr_value($match, $needle, $array) {
    foreach ($array as $key => $val) {
        if ($val[$needle] === $match) {
            return $key;
        }
    }
    return null;
}

var_dump(search_arr_value('sdk-php1','dir',$versions));die();