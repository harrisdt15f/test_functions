<?php
/**
 * Created by PhpStorm.
 * author: harris
 * Date: 17-11-27
 * Time: 上午11:23
 */
$name = '吾仆利亚生.美迪亚';
$name = str_replace('.', ' ', $name);
//echo $name;

$host_name = explode(':','www.dayuf.com:80');
$server_name = $host_name[0];
//echo '<pre>'.print_r($server_name,1).'</pre>';die();

date_default_timezone_set('Asia/Shanghai');
$log['iBackMoney(iWBackMoney + $iQBackMoney)'] = $name;
//echo date('Y-m-d H:i:s', time());
var_dump($log);