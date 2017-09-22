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

echo getDepositOrderNum('banks');