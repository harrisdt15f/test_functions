<?php
function generateSerialNumber()
{
    $fix_year = 2010;
    $year_code = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J'];
    //############################
    $Y = date('Y'); //2017
    $inty = intval($Y); //2017
    $interval = $inty - $fix_year; //7
    while (!isset($year_code[$interval])) {
        $interval -= 10;
    }
    $Y = $year_code[$interval]; //H
    //############################
    $m = date('m'); //09
    $hexa = dechex($m); //9
    $m_up = strtoupper($hexa);
    //############################
    $d = date('d'); //07
    //############################
    $t = time();
    $t5 = substr($t, -5);
    //############################
    $m_time = microtime();
    $m_time_2_5 = substr($m_time, 2, 5);
    //############################
    $ran_0_99 = rand(0, 99);
    $ran_2d = sprintf('%02d', $ran_0_99);
    //############################
    $order_sn = $Y . $m_up . $d . $t5 . $m_time_2_5 . $ran_2d;
    return $order_sn;
}

function getDepositOrderNum($gateway = '')
{
    $order_prefix = 'qp';
    // return $this->order_prefix . uniqid(mt_rand());
    switch ($gateway) {
        case 'banks':
            $order_no = $order_prefix . 'BK' . RandomString(3) . time();
            break;
        case 'weixin':
            $order_no = $order_prefix . 'WX' . RandomString(3) . time();
            break;
        case 'unionpay':
            $order_no = $order_prefix . 'UN' . RandomString(3) . time();
            break;
        case 'alipay':
            $order_no = $order_prefix . 'AL' . RandomString(3) . time();
            break;
        case 'qq':
            $order_no = $order_prefix . 'QQ' . RandomString(3) . time();
            break;
        case 'baidu':
            $order_no = $order_prefix . 'BD' . RandomString(3) . time();
            break;
        case 'jd':
            $order_no = $order_prefix . 'JD' . RandomString(3) . time();
            break;
        default:
            $order_no = $order_prefix . RandomString() . time();
            break;
    }
    return $order_no;
}

function RandomString($length = 5)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

/**
 * get current subdir in the dir search with like%
 * @return array
 */
function get_sdk_dir()
{
    $dirs = array_filter(glob('*'), 'is_dir');
    $filter = preg_quote('sdk', '~'); // don't forget to quote input string!
    $dirs = preg_grep('~' . $filter . '~', $dirs);
    return array_values(array_filter($dirs));
}

$array1 = ['blue1' => 'trace', 'red' => 'trace', 'green1' => 'trace', 'purple' => 'default'];
$array2 = ['green' => 'trace', 'blue' => 'trace', 'yellow' => 'trace', 'cyan' => 'trace'];

$array3 = ['log' => [
    //主目录名
    'logs' => [
        'default' => 'debugs', //默认存到 debugs 文件夹
        'error_msg' => 'errors', //左边指令，右边存入目录 //'sdk_info' => 'infos',
    ],
]];
//var_dump($array3['log']);die();
$log_gruop_names = [
    'default' => 'debugs', //默认存到 debugs 文件夹
    'error_msg' => 'errors', //左边指令，右边存入目录 //'sdk_info' => 'infos',
];
/*var_dump($array3['log']['logs']);
var_dump($log_gruop_names);die();
var_dump(key(array_intersect_key($array1, $array2)));
echo array_search("default",$array1);*/

//echo generateSerialNumber();
//$data = array('version' =>'1.01');
//$data = http_build_query($data);
//echo $data;
/*$extra = 'version=1.01';
parse_str($extra, $output);
$r = print_var_name($output['version']);

function print_var_name($var) {
foreach($GLOBALS as $var_name => $value) {
if ($value === $var) {
return $var_name;
}
}

return false;
}
var_dump($r);
var_dump($output);*/

//["education"]=> array(3) {
// [0]=> string(1) "1" [1]=> string(1) "2" [2]=> string(1) "3"
// }
//echo getDepositOrderNum('banks');