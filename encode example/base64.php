<?php
/**
 * Created by PhpStorm.
 * author: harris
 * Date: 17-11-17
 * Time: 上午10:08
 */


function is_base64($s) {
    echo $s."<br>";echo base64_decode($s);
    return ! (base64_decode($s, true) === false);
}

$string = base64_encode('abcdefg');
$string1= '';
$result = is_base64($string1);