<?php

date_default_timezone_set('Asia/Shanghai');
include_once(__DIR__ . DIRECTORY_SEPARATOR . 'Logs.php');

Class Data
{
    public $back_money01 = 0, $back_money15 = 0, $back_money550 = 0, $back_money50150 = 0, $back_money150250 = 0;
}

Class Agent
{
    public $is_limit_active;

    /**
     * Agent constructor.
     * @param int $is_limit_active
     */
    public function __construct($is_limit_active)
    {
        $this->is_limit_active = $is_limit_active;
    }
}

Class Salary
{

    public $min_bets, $max_bets, $active_user_num, $flag;
    public $back_money;

    /**
     * Bets constructor.
     * @param $min_bets
     * @param $max_bets
     * @param int $active_user_num
     * @param $flag
     * @param $back_money
     */
    public function __construct($min_bets, $max_bets, $active_user_num, $flag, $back_money)
    {
        $this->min_bets = $min_bets;
        $this->max_bets = $max_bets;
        $this->active_user_num = $active_user_num;
        $this->flag = $flag;
        $this->back_money = $back_money;
    }
}

$maximum_active_user = 50;
$maximum_amount_bet = 2500000;

$fuzhiRule = '[{"id":1,"min_bets":10000,"max_bets":50000,"active_user_num":0,"nactive_user_num":0,"unit":1000,"back_money":10,"nback_money":10,"flag":"1-5","decrease_flag":null,"max_price":500,"created_at":null,"updated_at":null},{"id":2,"min_bets":50000,"max_bets":100000,"active_user_num":3,"nactive_user_num":3,"unit":10000,"back_money":100,"nback_money":100,"flag":"5-10","decrease_flag":"1-5","max_price":1000,"created_at":null,"updated_at":null},{"id":3,"min_bets":100000,"max_bets":200000,"active_user_num":6,"nactive_user_num":6,"unit":10000,"back_money":100,"nback_money":100,"flag":"10-20","decrease_flag":"5-10","max_price":2000,"created_at":null,"updated_at":null},{"id":4,"min_bets":200000,"max_bets":300000,"active_user_num":10,"nactive_user_num":10,"unit":10000,"back_money":100,"nback_money":100,"flag":"20-30","decrease_flag":"10-20","max_price":3000,"created_at":null,"updated_at":null},{"id":5,"min_bets":300000,"max_bets":400000,"active_user_num":15,"nactive_user_num":15,"unit":10000,"back_money":100,"nback_money":100,"flag":"30-40","decrease_flag":"20-30","max_price":4000,"created_at":null,"updated_at":null},{"id":6,"min_bets":400000,"max_bets":500000,"active_user_num":20,"nactive_user_num":20,"unit":10000,"back_money":100,"nback_money":100,"flag":"40-50","decrease_flag":"30-40","max_price":5000,"created_at":null,"updated_at":null},{"id":7,"min_bets":500000,"max_bets":600000,"active_user_num":25,"nactive_user_num":25,"unit":10000,"back_money":120,"nback_money":120,"flag":"50-60","decrease_flag":"40-50","max_price":6200,"created_at":null,"updated_at":null},{"id":8,"min_bets":600000,"max_bets":700000,"active_user_num":30,"nactive_user_num":30,"unit":10000,"back_money":120,"nback_money":120,"flag":"60-70","decrease_flag":"50-60","max_price":7400,"created_at":null,"updated_at":null},{"id":9,"min_bets":700000,"max_bets":800000,"active_user_num":35,"nactive_user_num":35,"unit":10000,"back_money":120,"nback_money":120,"flag":"70-80","decrease_flag":"60-70","max_price":8600,"created_at":null,"updated_at":null},{"id":10,"min_bets":800000,"max_bets":1500000,"active_user_num":40,"nactive_user_num":40,"unit":10000,"back_money":120,"nback_money":120,"flag":"80-150","decrease_flag":"70-80","max_price":17000,"created_at":null,"updated_at":null},{"id":11,"min_bets":1500000,"max_bets":2500000,"active_user_num":50,"nactive_user_num":50,"unit":10000,"back_money":130,"nback_money":130,"flag":"150-250","decrease_flag":"80-150","max_price":30000,"created_at":null,"updated_at":null}]';
$aFuzhi_raw = json_decode($fuzhiRule);
$aFuzhi = [];
foreach ($aFuzhi_raw as $key => $value) {
    $aFuzhi[$value->flag] = $value;
}
$is_limit_active = 1;
$data = new Data();
$oUserAgent = new Agent($is_limit_active);

$iMaxPrize15 = 500;
$iMaxPrize510 = 1000;
$iMaxPrize1020 = 2000;
$iMaxPrize2030 = 3000;
$iMaxPrize3040 = 4000;
$iMaxPrize4050 = 5000;
$iMaxPrize5060 = 6200;
$iMaxPrize6070 = 7400;
$iMaxPrize7080 = 8600;
$iMaxPrize80150 = 17000;
$iMaxPrize150250 = 30000;
//$iMaxPrize8090 = 9800;
//$iMaxPrize90100 = 11000;
//$iMaxPrize100110 = 12200;
//$iMaxPrize110120 = 13400;
//$iMaxPrize120130 = 14600;
//$iMaxPrize130140 = 15800;
//$iMaxPrize140150 = 17000;

$iCount = count($aFuzhi);
$iMinBets = 1000;
for ($iActiveUserNum = 0; $iActiveUserNum <= $maximum_active_user; $iActiveUserNum++) {
    for ($iTeamBets = 0; $iTeamBets <= $maximum_amount_bet; $iTeamBets++) {
        $current_min = 0;
        $current_max = 0;
//for ($iActiveUserNum = 50; $iActiveUserNum <= 50; $iActiveUserNum++) {
//    for ($iTeamBets = 2499999; $iTeamBets <= 2500000; $iTeamBets++) {
//        $current_min = 0;
//        $current_max = 0;
        foreach ($aFuzhi as $iFuZhiKey => $oFuZhiRule) {
            $current_min = $oFuZhiRule->min_bets;
            $current_max = $oFuZhiRule->max_bets;
            if ($iTeamBets <= 10000) {
//first
                $log = [];
                $log['iBackMoney 0~1万段最高返奖1.0%'] = $iBackMoney = $iTeamBets * 0.01;
                $data->back_money01 = $iBackMoney;
                $log['condition'] = '扶植期内　first : bet(' . $iTeamBets . ')《 10000';
                log_args_write($log);
                dd($data, $oUserAgent, $current_min, $current_max, $iActiveUserNum, $iTeamBets, '二');
                break;
            }
            if ($iTeamBets > $oFuZhiRule->min_bets && $iTeamBets <= $oFuZhiRule->max_bets) {
                $current_min = $oFuZhiRule->min_bets;
                $current_max = $oFuZhiRule->max_bets;
                $trace_state = '二';
                $log = [];
                $log['condition'] = '扶植期内新 :' . $oFuZhiRule->min_bets . '<' . $iTeamBets . '<=' . $oFuZhiRule->max_bets;
                $log['flag'] = $oFuZhiRule->flag;
                switch ($oFuZhiRule->flag) {
                    case '1-5':
                        $data->back_money15 = floor($iTeamBets / $oFuZhiRule->unit) * $oFuZhiRule->back_money;
                        dd($data, $oUserAgent, $current_min, $current_max, $iActiveUserNum, $iTeamBets, '二');
                        break 2;
                    case '5-10':
                        $previous_max_15 = $aFuzhi[$oFuZhiRule->decrease_flag];
                        $previous_max_15_price = $previous_max_15->max_price;
                        $data->back_money15 = $previous_max_15_price;
                        if ($oUserAgent->is_limit_active && $iActiveUserNum >= $oFuZhiRule->active_user_num) {
                            $data->back_money550 = floor(($iTeamBets - $previous_max_15->max_bets) / $oFuZhiRule->unit) * $oFuZhiRule->back_money;
                        }
                        dd($data, $oUserAgent, $current_min, $current_max, $iActiveUserNum, $iTeamBets, '二');
                        break 2;
                    case '10-20':
                        //5-10万段的数据
                        $previous_max_510_id = $oFuZhiRule->decrease_flag;
                        $previous_max_510 = $aFuzhi[$previous_max_510_id];
                        //1-5万段的数据
                        $previous_max_15_id = $previous_max_510->decrease_flag;
                        $previous_max_15 = $aFuzhi[$previous_max_15_id];
                        //＃＃＃＃＃＃＃＃【结算】＃＃＃＃＃＃＃＃
                        //结算符合　1-5万段的数据
                        $previous_max_15_price = $previous_max_15->max_price;
                        //结算符合　5-10万段的数据
                        $previous_max_510_price = $previous_max_510->max_price - $previous_max_15_price;
                        //结算符合　10-20万段的数据
                        $previous_max_1020_price = 0;
                        if ($oUserAgent->is_limit_active && $iActiveUserNum >= $oFuZhiRule->active_user_num) {
                            $previous_max_1020_price = floor(($iTeamBets - $previous_max_510->max_bets) / $oFuZhiRule->unit) * $oFuZhiRule->back_money;
                        }

                        //＃＃＃＃＃＃＃＃【结算完成】＃＃＃＃＃＃＃＃
                        $data->back_money15 = $previous_max_15_price;
                        $data->back_money550 = $previous_max_510_price + $previous_max_1020_price;
                        dd($data, $oUserAgent, $current_min, $current_max, $iActiveUserNum, $iTeamBets, '二');
                        break 2;
                    case '20-30':
                        //10-20 万段数据
                        $previous_max_1020_id = $oFuZhiRule->decrease_flag;
                        $previous_max_1020 = $aFuzhi[$previous_max_1020_id];
                        //5-10万段的数据
                        $previous_max_510_id = $previous_max_1020->decrease_flag;
                        $previous_max_510 = $aFuzhi[$previous_max_510_id];
                        //1-5万段的数据
                        $previous_max_15_id = $previous_max_510->decrease_flag;
                        $previous_max_15 = $aFuzhi[$previous_max_15_id];
                        //＃＃＃＃＃＃＃＃【结算】＃＃＃＃＃＃＃＃
                        //结算符合　1-5万段的数据
                        $previous_max_15_price = $previous_max_15->max_price;
                        //结算符合　5-10万段的数据
                        $previous_max_510_price = $previous_max_510->max_price - $previous_max_15_price;
                        //结算符合　10-20万段的数据
                        $previous_max_1020_price = $previous_max_1020->max_price - $previous_max_510->max_price;
                        //结算符合　20-30万段的数据
                        $previous_max_2030_price = 0;
                        if ($oUserAgent->is_limit_active && $iActiveUserNum >= $oFuZhiRule->active_user_num) {
                            $previous_max_2030_price = floor(($iTeamBets - $previous_max_1020->max_bets) / $oFuZhiRule->unit) * $oFuZhiRule->back_money;
                        }
                        //＃＃＃＃＃＃＃＃【结算完成】＃＃＃＃＃＃＃＃
                        $data->back_money15 = $previous_max_15_price;
                        $data->back_money550 = $previous_max_510_price + $previous_max_1020_price + $previous_max_2030_price;
                        dd($data, $oUserAgent, $current_min, $current_max, $iActiveUserNum, $iTeamBets, '二');
                        break 2;
                    case '30-40':
                        //20-30 万段数据
                        $previous_max_2030_id = $oFuZhiRule->decrease_flag;
                        $previous_max_2030 = $aFuzhi[$previous_max_2030_id];
                        //10-20 万段数据
                        $previous_max_1020_id = $previous_max_2030->decrease_flag;
                        $previous_max_1020 = $aFuzhi[$previous_max_1020_id];
                        //5-10万段的数据
                        $previous_max_510_id = $previous_max_1020->decrease_flag;
                        $previous_max_510 = $aFuzhi[$previous_max_510_id];
                        //1-5万段的数据
                        $previous_max_15_id = $previous_max_510->decrease_flag;
                        $previous_max_15 = $aFuzhi[$previous_max_15_id];
                        //＃＃＃＃＃＃＃＃【结算】＃＃＃＃＃＃＃＃
                        //结算符合　1-5万段的数据
                        $previous_max_15_price = $previous_max_15->max_price;
                        //结算符合　5-10万段的数据
                        $previous_max_510_price = $previous_max_510->max_price - $previous_max_15_price;
                        //结算符合　10-20万段的数据
                        $previous_max_1020_price = $previous_max_1020->max_price - $previous_max_510->max_price;
                        //结算符合　20-30万段的数据
                        $previous_max_2030_price = $previous_max_2030->max_price - $previous_max_1020->max_price;
                        //结算符合　30-40万段的数据
                        $previous_max_3040_price = 0;
                        if ($oUserAgent->is_limit_active && $iActiveUserNum >= $oFuZhiRule->active_user_num) {
                            $previous_max_3040_price = floor(($iTeamBets - $previous_max_2030->max_bets) / $oFuZhiRule->unit) * $oFuZhiRule->back_money;
                        }

                        //＃＃＃＃＃＃＃＃【结算完成】＃＃＃＃＃＃＃＃
                        $data->back_money15 = $previous_max_15_price;
                        $data->back_money550 = $previous_max_510_price + $previous_max_1020_price + $previous_max_2030_price + $previous_max_3040_price;
                        dd($data, $oUserAgent, $current_min, $current_max, $iActiveUserNum, $iTeamBets, '二');
                        break 2;
                    case '40-50':
                        //30-40 万段数据
                        $previous_max_3040_id = $oFuZhiRule->decrease_flag;
                        $previous_max_3040 = $aFuzhi[$previous_max_3040_id];
                        //20-30 万段数据
                        $previous_max_2030_id = $previous_max_3040->decrease_flag;
                        $previous_max_2030 = $aFuzhi[$previous_max_2030_id];
                        //10-20 万段数据
                        $previous_max_1020_id = $previous_max_2030->decrease_flag;
                        $previous_max_1020 = $aFuzhi[$previous_max_1020_id];
                        //5-10万段的数据
                        $previous_max_510_id = $previous_max_1020->decrease_flag;
                        $previous_max_510 = $aFuzhi[$previous_max_510_id];
                        //1-5万段的数据
                        $previous_max_15_id = $previous_max_510->decrease_flag;
                        $previous_max_15 = $aFuzhi[$previous_max_15_id];
                        //＃＃＃＃＃＃＃＃【结算】＃＃＃＃＃＃＃＃
                        //结算符合　1-5万段的数据
                        $previous_max_15_price = $previous_max_15->max_price;
                        //结算符合　5-10万段的数据
                        $previous_max_510_price = $previous_max_510->max_price - $previous_max_15_price;
                        //结算符合　10-20万段的数据
                        $previous_max_1020_price = $previous_max_1020->max_price - $previous_max_510->max_price;
                        //结算符合　20-30万段的数据
                        $previous_max_2030_price = $previous_max_2030->max_price - $previous_max_1020->max_price;
                        //结算符合　30-40万段的数据
                        $previous_max_3040_price = $previous_max_3040->max_price - $previous_max_2030->max_price;
                        //结算符合　40-50万段的数据
                        $previous_max_4050_price = 0;
                        if ($oUserAgent->is_limit_active && $iActiveUserNum >= $oFuZhiRule->active_user_num) {
                            $previous_max_4050_price = floor(($iTeamBets - $previous_max_3040->max_bets) / $oFuZhiRule->unit) * $oFuZhiRule->back_money;
                        }

                        //＃＃＃＃＃＃＃＃【结算完成】＃＃＃＃＃＃＃＃
                        $data->back_money15 = $previous_max_15_price;
                        $data->back_money550 = $previous_max_510_price + $previous_max_1020_price + $previous_max_2030_price + $previous_max_3040_price + $previous_max_4050_price;
                        dd($data, $oUserAgent, $current_min, $current_max, $iActiveUserNum, $iTeamBets, '二');
                        break 2;
                    case '50-60':
                        //40-50 万段数据
                        $previous_max_4050_id = $oFuZhiRule->decrease_flag;
                        $previous_max_4050 = $aFuzhi[$previous_max_4050_id];
                        //30-40 万段数据
                        $previous_max_3040_id = $previous_max_4050->decrease_flag;
                        $previous_max_3040 = $aFuzhi[$previous_max_3040_id];
                        //20-30 万段数据
                        $previous_max_2030_id = $previous_max_3040->decrease_flag;
                        $previous_max_2030 = $aFuzhi[$previous_max_2030_id];
                        //10-20 万段数据
                        $previous_max_1020_id = $previous_max_2030->decrease_flag;
                        $previous_max_1020 = $aFuzhi[$previous_max_1020_id];
                        //5-10万段的数据
                        $previous_max_510_id = $previous_max_1020->decrease_flag;
                        $previous_max_510 = $aFuzhi[$previous_max_510_id];
                        //1-5万段的数据
                        $previous_max_15_id = $previous_max_510->decrease_flag;
                        $previous_max_15 = $aFuzhi[$previous_max_15_id];
                        //＃＃＃＃＃＃＃＃【结算】＃＃＃＃＃＃＃＃
                        //结算符合　1-5万段的数据
                        $previous_max_15_price = $previous_max_15->max_price;
                        //结算符合　5-10万段的数据
                        $previous_max_510_price = $previous_max_510->max_price - $previous_max_15_price;
                        //结算符合　10-20万段的数据
                        $previous_max_1020_price = $previous_max_1020->max_price - $previous_max_510->max_price;
                        //结算符合　20-30万段的数据
                        $previous_max_2030_price = $previous_max_2030->max_price - $previous_max_1020->max_price;
                        //结算符合　30-40万段的数据
                        $previous_max_3040_price = $previous_max_3040->max_price - $previous_max_2030->max_price;
                        //结算符合　40-50万段的数据
                        $previous_max_4050_price = $previous_max_4050->max_price - $previous_max_3040->max_price;
                        //结算符合　50-60万段的数据
                        $previous_max_5060_price = 0;
                        if ($oUserAgent->is_limit_active && $iActiveUserNum >= $oFuZhiRule->active_user_num) {
                            $previous_max_5060_price = floor(($iTeamBets - $previous_max_4050->max_bets) / $oFuZhiRule->unit) * $oFuZhiRule->back_money;
                        }
                        //＃＃＃＃＃＃＃＃【结算完成】＃＃＃＃＃＃＃＃
                        $data->back_money15 = $previous_max_15_price;
                        $data->back_money550 = $previous_max_510_price + $previous_max_1020_price + $previous_max_2030_price + $previous_max_3040_price + $previous_max_4050_price;
                        $data->back_money50150 = $previous_max_5060_price;
                        dd($data, $oUserAgent, $current_min, $current_max, $iActiveUserNum, $iTeamBets, '二');
                        break 2;
                    case '60-70':
                        //50-60 万段数据
                        $previous_max_5060_id = $oFuZhiRule->decrease_flag;
                        $previous_max_5060 = $aFuzhi[$previous_max_5060_id];
                        //40-50 万段数据
                        $previous_max_4050_id = $previous_max_5060->decrease_flag;
                        $previous_max_4050 = $aFuzhi[$previous_max_4050_id];
                        //30-40 万段数据
                        $previous_max_3040_id = $previous_max_4050->decrease_flag;
                        $previous_max_3040 = $aFuzhi[$previous_max_3040_id];
                        //20-30 万段数据
                        $previous_max_2030_id = $previous_max_3040->decrease_flag;
                        $previous_max_2030 = $aFuzhi[$previous_max_2030_id];
                        //10-20 万段数据
                        $previous_max_1020_id = $previous_max_2030->decrease_flag;
                        $previous_max_1020 = $aFuzhi[$previous_max_1020_id];
                        //5-10万段的数据
                        $previous_max_510_id = $previous_max_1020->decrease_flag;
                        $previous_max_510 = $aFuzhi[$previous_max_510_id];
                        //1-5万段的数据
                        $previous_max_15_id = $previous_max_510->decrease_flag;
                        $previous_max_15 = $aFuzhi[$previous_max_15_id];
                        //＃＃＃＃＃＃＃＃【结算】＃＃＃＃＃＃＃＃
                        //结算符合　1-5万段的数据
                        $previous_max_15_price = $previous_max_15->max_price;
                        //##############################################
                        //结算符合　5-10万段的数据
                        $previous_max_510_price = $previous_max_510->max_price - $previous_max_15_price;
                        //结算符合　10-20万段的数据
                        $previous_max_1020_price = $previous_max_1020->max_price - $previous_max_510->max_price;
                        //结算符合　20-30万段的数据
                        $previous_max_2030_price = $previous_max_2030->max_price - $previous_max_1020->max_price;
                        //结算符合　30-40万段的数据
                        $previous_max_3040_price = $previous_max_3040->max_price - $previous_max_2030->max_price;
                        //结算符合　40-50万段的数据
                        $previous_max_4050_price = $previous_max_4050->max_price - $previous_max_3040->max_price;
                        //##############################################
                        //结算符合　5060 万段的数据
                        $previous_max_5060_price = $previous_max_5060->max_price - $previous_max_4050->max_price;
                        //结算符合　6070 万段的数据
                        $previous_max_6070_price = 0;
                        if ($oUserAgent->is_limit_active && $iActiveUserNum >= $oFuZhiRule->active_user_num) {
                            $previous_max_6070_price = floor(($iTeamBets - $previous_max_5060->max_bets) / $oFuZhiRule->unit) * $oFuZhiRule->back_money;
                        }
                        //＃＃＃＃＃＃＃＃【结算完成】＃＃＃＃＃＃＃＃
                        $data->back_money15 = $previous_max_15_price;
                        $data->back_money550 = $previous_max_510_price + $previous_max_1020_price + $previous_max_2030_price + $previous_max_3040_price + $previous_max_4050_price;
                        $data->back_money50150 = $previous_max_5060_price + $previous_max_6070_price;
                        dd($data, $oUserAgent, $current_min, $current_max, $iActiveUserNum, $iTeamBets, '二');
                        break 2;
                    case '70-80':
                        //6070 万段数据
                        $previous_max_6070_id = $oFuZhiRule->decrease_flag;
                        $previous_max_6070 = $aFuzhi[$previous_max_6070_id];
                        //5060 万段数据
                        $previous_max_5060_id = $previous_max_6070->decrease_flag;
                        $previous_max_5060 = $aFuzhi[$previous_max_5060_id];
                        //40-50 万段数据
                        $previous_max_4050_id = $previous_max_5060->decrease_flag;
                        $previous_max_4050 = $aFuzhi[$previous_max_4050_id];
                        //30-40 万段数据
                        $previous_max_3040_id = $previous_max_4050->decrease_flag;
                        $previous_max_3040 = $aFuzhi[$previous_max_3040_id];
                        //20-30 万段数据
                        $previous_max_2030_id = $previous_max_3040->decrease_flag;
                        $previous_max_2030 = $aFuzhi[$previous_max_2030_id];
                        //10-20 万段数据
                        $previous_max_1020_id = $previous_max_2030->decrease_flag;
                        $previous_max_1020 = $aFuzhi[$previous_max_1020_id];
                        //5-10万段的数据
                        $previous_max_510_id = $previous_max_1020->decrease_flag;
                        $previous_max_510 = $aFuzhi[$previous_max_510_id];
                        //1-5万段的数据
                        $previous_max_15_id = $previous_max_510->decrease_flag;
                        $previous_max_15 = $aFuzhi[$previous_max_15_id];
                        //＃＃＃＃＃＃＃＃【结算】＃＃＃＃＃＃＃＃
                        //结算符合　1-5万段的数据
                        $previous_max_15_price = $previous_max_15->max_price;
                        //##############################################
                        //结算符合　5-10万段的数据
                        $previous_max_510_price = $previous_max_510->max_price - $previous_max_15_price;
                        //结算符合　10-20万段的数据
                        $previous_max_1020_price = $previous_max_1020->max_price - $previous_max_510->max_price;
                        //结算符合　20-30万段的数据
                        $previous_max_2030_price = $previous_max_2030->max_price - $previous_max_1020->max_price;
                        //结算符合　30-40万段的数据
                        $previous_max_3040_price = $previous_max_3040->max_price - $previous_max_2030->max_price;
                        //结算符合　40-50万段的数据
                        $previous_max_4050_price = $previous_max_4050->max_price - $previous_max_3040->max_price;
                        //##############################################
                        //结算符合　5060 万段的数据
                        $previous_max_5060_price = $previous_max_5060->max_price - $previous_max_4050->max_price;
                        //结算符合　6070 万段的数据
                        $previous_max_6070_price = $previous_max_6070->max_price - $previous_max_5060->max_price;
                        //结算符合　70-80 万段的数据
                        $previous_max_7080_price = 0;
                        if ($oUserAgent->is_limit_active && $iActiveUserNum >= $oFuZhiRule->active_user_num) {
                            $previous_max_7080_price = floor(($iTeamBets - $previous_max_6070->max_bets) / $oFuZhiRule->unit) * $oFuZhiRule->back_money;
                        }
                        //＃＃＃＃＃＃＃＃【结算完成】＃＃＃＃＃＃＃＃
                        $data->back_money15 = $previous_max_15_price;
                        $data->back_money550 = $previous_max_510_price + $previous_max_1020_price + $previous_max_2030_price + $previous_max_3040_price + $previous_max_4050_price;
                        $data->back_money50150 = $previous_max_5060_price + $previous_max_6070_price + $previous_max_7080_price;
                        dd($data, $oUserAgent, $current_min, $current_max, $iActiveUserNum, $iTeamBets, '二');
                        break 2;
                    case '80-150':
                        //70-80 万段数据
                        $previous_max_7080_id = $oFuZhiRule->decrease_flag;
                        $previous_max_7080 = $aFuzhi[$previous_max_7080_id];
                        //6070 万段数据
                        $previous_max_6070_id = $previous_max_7080->decrease_flag;
                        $previous_max_6070 = $aFuzhi[$previous_max_6070_id];
                        //5060 万段数据
                        $previous_max_5060_id = $previous_max_6070->decrease_flag;
                        $previous_max_5060 = $aFuzhi[$previous_max_5060_id];
                        //40-50 万段数据
                        $previous_max_4050_id = $previous_max_5060->decrease_flag;
                        $previous_max_4050 = $aFuzhi[$previous_max_4050_id];
                        //30-40 万段数据
                        $previous_max_3040_id = $previous_max_4050->decrease_flag;
                        $previous_max_3040 = $aFuzhi[$previous_max_3040_id];
                        //20-30 万段数据
                        $previous_max_2030_id = $previous_max_3040->decrease_flag;
                        $previous_max_2030 = $aFuzhi[$previous_max_2030_id];
                        //10-20 万段数据
                        $previous_max_1020_id = $previous_max_2030->decrease_flag;
                        $previous_max_1020 = $aFuzhi[$previous_max_1020_id];
                        //5-10万段的数据
                        $previous_max_510_id = $previous_max_1020->decrease_flag;
                        $previous_max_510 = $aFuzhi[$previous_max_510_id];
                        //1-5万段的数据
                        $previous_max_15_id = $previous_max_510->decrease_flag;
                        $previous_max_15 = $aFuzhi[$previous_max_15_id];
                        //＃＃＃＃＃＃＃＃【结算】＃＃＃＃＃＃＃＃
                        //结算符合　1-5万段的数据
                        $previous_max_15_price = $previous_max_15->max_price;
                        //##############################################
                        //结算符合　5-10万段的数据
                        $previous_max_510_price = $previous_max_510->max_price - $previous_max_15_price;
                        //结算符合　10-20万段的数据
                        $previous_max_1020_price = $previous_max_1020->max_price - $previous_max_510->max_price;
                        //结算符合　20-30万段的数据
                        $previous_max_2030_price = $previous_max_2030->max_price - $previous_max_1020->max_price;
                        //结算符合　30-40万段的数据
                        $previous_max_3040_price = $previous_max_3040->max_price - $previous_max_2030->max_price;
                        //结算符合　40-50万段的数据
                        $previous_max_4050_price = $previous_max_4050->max_price - $previous_max_3040->max_price;
                        //##############################################
                        //结算符合　5060 万段的数据
                        $previous_max_5060_price = $previous_max_5060->max_price - $previous_max_4050->max_price;
                        //结算符合　6070 万段的数据
                        $previous_max_6070_price = $previous_max_6070->max_price - $previous_max_5060->max_price;
                        //结算符合　70-80 万段的数据
                        $previous_max_7080_price = $previous_max_7080->max_price - $previous_max_6070->max_price;
                        //结算符合　80-90 万段的数据
                        $previous_max_80150_price = 0;
                        if ($oUserAgent->is_limit_active && $iActiveUserNum >= $oFuZhiRule->active_user_num) {
                            $previous_max_80150_price = floor(($iTeamBets - $previous_max_7080->max_bets) / $oFuZhiRule->unit) * $oFuZhiRule->back_money;
                        }
                        //＃＃＃＃＃＃＃＃【结算完成】＃＃＃＃＃＃＃＃
                        $data->back_money15 = $previous_max_15_price;
                        $data->back_money550 = $previous_max_510_price + $previous_max_1020_price + $previous_max_2030_price + $previous_max_3040_price + $previous_max_4050_price;
                        $data->back_money50150 = $previous_max_5060_price + $previous_max_6070_price + $previous_max_7080_price + $previous_max_80150_price;
                        dd($data, $oUserAgent, $current_min, $current_max, $iActiveUserNum, $iTeamBets, '二');
                        break 2;
                    case '150-250':
                        //80-150 万段的数据
                        $previous_max_80150_id = $oFuZhiRule->decrease_flag;
                        $previous_max_80150 = $aFuzhi[$previous_max_80150_id];
                        //70-80 万段数据
                        $previous_max_7080_id = $previous_max_80150->decrease_flag;
                        $previous_max_7080 = $aFuzhi[$previous_max_7080_id];
                        //6070 万段数据
                        $previous_max_6070_id = $previous_max_7080->decrease_flag;
                        $previous_max_6070 = $aFuzhi[$previous_max_6070_id];
                        //5060 万段数据
                        $previous_max_5060_id = $previous_max_6070->decrease_flag;
                        $previous_max_5060 = $aFuzhi[$previous_max_5060_id];
                        //40-50 万段数据
                        $previous_max_4050_id = $previous_max_5060->decrease_flag;
                        $previous_max_4050 = $aFuzhi[$previous_max_4050_id];
                        //30-40 万段数据
                        $previous_max_3040_id = $previous_max_4050->decrease_flag;
                        $previous_max_3040 = $aFuzhi[$previous_max_3040_id];
                        //20-30 万段数据
                        $previous_max_2030_id = $previous_max_3040->decrease_flag;
                        $previous_max_2030 = $aFuzhi[$previous_max_2030_id];
                        //10-20 万段数据
                        $previous_max_1020_id = $previous_max_2030->decrease_flag;
                        $previous_max_1020 = $aFuzhi[$previous_max_1020_id];
                        //5-10万段的数据
                        $previous_max_510_id = $previous_max_1020->decrease_flag;
                        $previous_max_510 = $aFuzhi[$previous_max_510_id];
                        //1-5万段的数据
                        $previous_max_15_id = $previous_max_510->decrease_flag;
                        $previous_max_15 = $aFuzhi[$previous_max_15_id];
                        //＃＃＃＃＃＃＃＃【结算】＃＃＃＃＃＃＃＃
                        //结算符合　1-5万段的数据
                        $previous_max_15_price = $previous_max_15->max_price;
                        //##############################################
                        //结算符合　5-10万段的数据
                        $previous_max_510_price = $previous_max_510->max_price - $previous_max_15_price;
                        //结算符合　10-20万段的数据
                        $previous_max_1020_price = $previous_max_1020->max_price - $previous_max_510->max_price;
                        //结算符合　20-30万段的数据
                        $previous_max_2030_price = $previous_max_2030->max_price - $previous_max_1020->max_price;
                        //结算符合　30-40万段的数据
                        $previous_max_3040_price = $previous_max_3040->max_price - $previous_max_2030->max_price;
                        //结算符合　40-50万段的数据
                        $previous_max_4050_price = $previous_max_4050->max_price - $previous_max_3040->max_price;
                        //##############################################
                        //结算符合　5060 万段的数据
                        $previous_max_5060_price = $previous_max_5060->max_price - $previous_max_4050->max_price;
                        //结算符合　6070 万段的数据
                        $previous_max_6070_price = $previous_max_6070->max_price - $previous_max_5060->max_price;
                        //结算符合　70-80 万段的数据
                        $previous_max_7080_price = $previous_max_7080->max_price - $previous_max_6070->max_price;
                        //结算符合　80-150 万段的数据
                        $previous_max_80150_price = $previous_max_80150->max_price - $previous_max_7080->max_price;
                        //结算符合　150-250 万段的数据
                        $previous_max_150250_price = 0;
                        if ($oUserAgent->is_limit_active && $iActiveUserNum >= $oFuZhiRule->active_user_num) {
                            $previous_max_150250_price = floor(($iTeamBets - $previous_max_80150->max_bets) / $oFuZhiRule->unit) * $oFuZhiRule->back_money;
                        }
                        //＃＃＃＃＃＃＃＃【结算完成】＃＃＃＃＃＃＃＃
                        $data->back_money15 = $previous_max_15_price;
                        $data->back_money550 = $previous_max_510_price + $previous_max_1020_price + $previous_max_2030_price + $previous_max_3040_price + $previous_max_4050_price;
                        $data->back_money50150 = $previous_max_5060_price + $previous_max_6070_price + $previous_max_7080_price + $previous_max_80150_price;
                        $data->back_money150250 = $previous_max_150250_price;
                        dd($data, $oUserAgent, $current_min, $current_max, $iActiveUserNum, $iTeamBets, '二');
                        break 2;
                }
            }
        }
        echo '已完成任务。。。》最终有效金额＝' . $iTeamBets . '与人数量＝' . $iActiveUserNum . '|[0~１万]=>' . $data->back_money01 . '[1~5万]＝》' . $data->back_money15 . '[5~50万]＝》' . $data->back_money550 . '[50~150]＝》' . $data->back_money50150 . '[150~250]＝》' . $data->back_money150250 . "\n";
    }
}
echo 'finished';
function dd(Data $d, Agent $oUserAgent, $current_min, $current_max, $activeUser, $iTeamBets, $condition)
{
//    var_dump($d);die();
    $log = '';
    $log .= '|目前活跃人数　＝' . $activeUser;
    $log .= '|目前金额　＝》' . $iTeamBets . '|[0~１万]=>' . $d->back_money01 . '|[1~5万]=>' . $d->back_money15 . '[5~50万]＝》' . $d->back_money550 . '[50~150万]＝》' . $d->back_money50150 . '[150~250]＝》' . $d->back_money150250;
    $log .= '|得到工资　＝》' . ((int)$d->back_money01 + (int)$d->back_money15 + (int)$d->back_money550 + (int)$d->back_money50150 + (int)$d->back_money150250);
    $log .= '￥|条件　＝》投注量' . $current_min . '与' . $current_max . '之间';
    $log .= '|需限制活跃人数　＝' . $islimit = empty($oUserAgent->is_limit_active) ? '否' : '是';
    $log .= '|目前进入状态《' . $condition . '》';
    $flc_path = __DIR__ . '/logs';
    $log_obj = new Logs($flc_path, 'dailyWage');
    $log_obj->setLog($log);
}

//#################################################
/**
 * array type should be
 * $a1 = ['label'=>'description'];
 * usage log_args_write(array1,array2,....);
 * Create array to write log and get the arguments dynamically and send them to han_log
 * @return array|bool|string
 * author: harris
 */
function log_args_write()
{
    $flc_all = debug_backtrace();
    $log = [];
    $log_gruop_names = [
        'default' => 'debugs', //默认存到 debugs 文件夹
        'error_msg' => 'errors', //左边指令，右边存入目录 //'sdk_info' => 'infos',
    ];
    $dir_l = DIRECTORY_SEPARATOR;
    $sdk_log_path = __DIR__ . $dir_l . 'logs' . $dir_l . 'payments' . $dir_l;
    $marker = 0;
    $k = '';
    $log_name = '';
    $numArgs = func_num_args();
    $args = func_get_args();
    $derive_dir = '~debugs~' . $dir_l;
    foreach ($args as $index => $arg) {
        if (is_array($arg)) {
            $log_gruop_name = key(array_intersect_key($log_gruop_names, $arg));
            $derive_dir = $log_gruop_name != null ? str_replace('~debugs~', $log_gruop_names[$log_gruop_name], $derive_dir) : str_replace('~debugs~', $log_gruop_names['default'], $derive_dir);
            if (array_key_exists("log_name", $arg)) {
                $log_name = $arg['log_name'];
                unset($arg['log_name']);
                $flc_path = $sdk_log_path . $derive_dir;
                create_directory_path($flc_path);
            } else {
                $flc_str = isset($flc_all[1]['class']) ? $flc_all[1]['class'] . "*" . $flc_all[1]['function'] : 'default';
                $log_name = isset($flc_all[1]['function']) ? $flc_all[1]['function'] : 'default';
            }
            if (!empty($flc_str)) {
                if (strpos($flc_str, '*') !== false) {
                    $flc = explode('*', $flc_str);
                    $class_name_dir = $flc[0];
                    $flc_path = $sdk_log_path . $derive_dir . $class_name_dir;
                } else {
                    $flc_path = $sdk_log_path . $derive_dir . $log_name;
                }
                create_directory_path($flc_path);
            }
            array_push($log, $arg);
            $marker++;
        } else {
            $k = empty($k) ? $index . 'args =' . $arg : $k . "<br>" . $index . 'args =' . $arg;
        }
    }
    if ($marker < $numArgs) {
        return $mess = [
            'errMsg' => $k . ' 不是array值',
        ];
    }
    $status = han_log($log, $log_name, $flc_path); //writ log
    return $status;
}

/**
 * @param $dir_path
 */
function create_directory_path($dir_path)
{
    if (!is_dir($dir_path)) {
        mkdir($dir_path, 0777, true);
    }
}

/**
 * get array from the log_args_write() and write to the log dynamically
 * @param array $arr
 * @param string $name
 * @param string $flc_path
 * @return bool|string
 * author: harris
 */
function han_log($arr = [], $name = '', $flc_path = '')
{
    $name = $name . '_' . date('Y-m-d H:i:s', time());
    if (empty($arr)) {
        return "拼接日志数组为空";
    } else {
        $log = '';
        foreach ($arr as $key => $value) {
            if (is_array($value)) {
                foreach ($value as $key => $value) {
                    $log = empty($log) ? $key . " = " . $v = is_array($value) ? json_en_uni($value) . "\n" : $value . "\n" : $log . $key . " = " . $v = is_array($value) ? json_en_uni($value) . "\n" : $value . "\n";
                }
                customLog($log, $name, $flc_path);
            } else {
                customLog('拼接日志输入string 值请检查参数', $name);
            }
        }
        return true;
    }
}

/**
 * Final function of writing log to the specific folder
 * @param $log
 * @param $name
 * @param string $flc_path
 * @return string
 * author: harris
 */
function customLog($log, $name, $flc_path = '')
{
    if (empty($flc_path)) $flc_path = __DIR__ . '/logs';
    $log_obj = new Logs($flc_path, $name);
    $log_obj->setLog("\n" . $log);
}

/**
 * for unescaping uni
 * @param $data
 * @param bool $pretty
 * @return string
 * author: harris
 */
function json_en_uni($data, $pretty = false)
{
    return $pretty === true ? prettyPrint(json_encode($data, JSON_UNESCAPED_UNICODE)) : json_encode($data, JSON_UNESCAPED_UNICODE);
}

/**
 * prettyPrint
 * @param $json
 * @return string
 * author: harris
 */
function prettyPrint($json)
{
    $result = '';
    $level = 0;
    $in_quotes = false;
    $in_escape = false;
    $ends_line_level = NULL;
    $json_length = strlen($json);
    for ($i = 0; $i < $json_length; $i++) {
        $char = $json[$i];
        $new_line_level = NULL;
        $post = "";
        if ($ends_line_level !== NULL) {
            $new_line_level = $ends_line_level;
            $ends_line_level = NULL;
        }
        if ($in_escape) {
            $in_escape = false;
        } else if ($char === '"') {
            $in_quotes = !$in_quotes;
        } else if (!$in_quotes) {
            switch ($char) {
                case '}':
                case ']':
                    $level--;
                    $ends_line_level = NULL;
                    $new_line_level = $level;
                    break;
                case '{':
                case '[':
                    $level++;
                case ',':
                    $ends_line_level = $level;
                    break;
                case ':':
                    $post = " ";
                    break;
                case " ":
                case "\t":
                case "\n":
                case "\r":
                    $char = "";
                    $ends_line_level = $new_line_level;
                    $new_line_level = NULL;
                    break;
            }
        } else if ($char === '\\') {
            $in_escape = true;
        }
        if ($new_line_level !== NULL) {
            $result .= "\n" . str_repeat("\t", $new_line_level);
        }
        $result .= $char . $post;
    }
    return $result;
}

