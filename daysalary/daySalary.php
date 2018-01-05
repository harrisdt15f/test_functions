<?php

date_default_timezone_set('Asia/Shanghai');
include_once(__DIR__ . DIRECTORY_SEPARATOR . 'Logs.php');

Class Data
{
    public $back_money15, $back_money540, $back_money4080;
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

$maximum_active_user = 130;
$maximum_amount_bet = 1500000;

$fuzhiRule = '[{"id":32,"min_bets":1400000,"max_bets":1500000,"active_user_num":130,"unit":10000,"back_money":120,"is_fuzhi":1,"created_at":null,"updated_at":null,"flag":"140-150"},{"id":31,"min_bets":1300000,"max_bets":1400000,"active_user_num":120,"unit":10000,"back_money":120,"is_fuzhi":1,"created_at":null,"updated_at":null,"flag":"130-140"},{"id":30,"min_bets":1200000,"max_bets":1300000,"active_user_num":110,"unit":10000,"back_money":120,"is_fuzhi":1,"created_at":null,"updated_at":null,"flag":"120-130"},{"id":29,"min_bets":1100000,"max_bets":1200000,"active_user_num":100,"unit":10000,"back_money":120,"is_fuzhi":1,"created_at":null,"updated_at":null,"flag":"110-120"},{"id":28,"min_bets":1000000,"max_bets":1100000,"active_user_num":90,"unit":10000,"back_money":120,"is_fuzhi":1,"created_at":null,"updated_at":null,"flag":"100-110"},{"id":27,"min_bets":900000,"max_bets":1000000,"active_user_num":80,"unit":10000,"back_money":120,"is_fuzhi":1,"created_at":null,"updated_at":null,"flag":"90-100"},{"id":26,"min_bets":800000,"max_bets":900000,"active_user_num":70,"unit":10000,"back_money":120,"is_fuzhi":1,"created_at":null,"updated_at":null,"flag":"80-90"},{"id":25,"min_bets":700000,"max_bets":800000,"active_user_num":60,"unit":10000,"back_money":120,"is_fuzhi":1,"created_at":null,"updated_at":null,"flag":"70-80"},{"id":24,"min_bets":600000,"max_bets":700000,"active_user_num":50,"unit":10000,"back_money":120,"is_fuzhi":1,"created_at":null,"updated_at":null,"flag":"60-70"},{"id":23,"min_bets":500000,"max_bets":600000,"active_user_num":40,"unit":10000,"back_money":120,"is_fuzhi":1,"created_at":null,"updated_at":null,"flag":"50-60"},{"id":22,"min_bets":400000,"max_bets":500000,"active_user_num":30,"unit":10000,"back_money":100,"is_fuzhi":1,"created_at":null,"updated_at":null,"flag":"40-50"},{"id":21,"min_bets":300000,"max_bets":400000,"active_user_num":25,"unit":10000,"back_money":100,"is_fuzhi":1,"created_at":null,"updated_at":null,"flag":"30-40"},{"id":20,"min_bets":200000,"max_bets":300000,"active_user_num":20,"unit":10000,"back_money":100,"is_fuzhi":1,"created_at":null,"updated_at":null,"flag":"20-30"},{"id":19,"min_bets":100000,"max_bets":200000,"active_user_num":15,"unit":10000,"back_money":100,"is_fuzhi":1,"created_at":null,"updated_at":null,"flag":"10-20"},{"id":18,"min_bets":50000,"max_bets":100000,"active_user_num":6,"unit":10000,"back_money":100,"is_fuzhi":1,"created_at":null,"updated_at":null,"flag":"5-10"},{"id":17,"min_bets":10000,"max_bets":50000,"active_user_num":3,"unit":10000,"back_money":100,"is_fuzhi":1,"created_at":null,"updated_at":null,"flag":"1-5"}]';
$aFuzhi = json_decode($fuzhiRule);
$is_limit_active = 1;
$data = new Data();
$data->back_money15 = 0;
$data->back_money540 = 0;
$data->back_money4080 = 0;
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
$iMaxPrize8090 = 9800;
$iMaxPrize90100 = 11000;
$iMaxPrize100110 = 12200;
$iMaxPrize110120 = 13400;
$iMaxPrize120130 = 14600;
$iMaxPrize130140 = 15800;
$iMaxPrize140150 = 17000;
$iCount = count($aFuzhi);
$iMinBets = 1000;
for ($iActiveUserNum = 0; $iActiveUserNum <= $maximum_active_user; $iActiveUserNum++) {
    for ($iTeamBets = 0; $iTeamBets <= $maximum_amount_bet; $iTeamBets++) {
//for ($iActiveUserNum = 0; $iActiveUserNum <= 5; $iActiveUserNum++) {
//    for ($iTeamBets = 13174; $iTeamBets <= 15000; $iTeamBets++) {
        foreach ($aFuzhi as $iFuZhiKey => $oFuZhiRule) {
            if ($iTeamBets < $iMinBets) {
                //first
                $log = [];
                $log['condition'] = '扶植期内　bet less than 1000';
                log_args_write($log);
                break;
            }
            if ($iTeamBets >= $iMinBets && $iTeamBets < 10000 && ((!$oUserAgent->is_limit_active) || ($oUserAgent->is_limit_active && $iActiveUserNum >= 3))) {
//second
                $log = [];
                $log['iUnit'] = $iUnit = floor($iTeamBets / 1000);
                $log['iBackMoney 0~5万段最高返奖1.0%'] = $iBackMoney = $iUnit * 10;
                $data->back_money15 = $iBackMoney;
                $log['condition'] = '扶植期内　second : 1000《=　bet(' . $iTeamBets . ')《 10000';
                $log['iActiveUserNum'] = isset($iActiveUserNum) ? $iActiveUserNum : '';
                log_args_write($log);
                break;
            }
            if ($iTeamBets >= $aFuzhi[$iCount - 1]->min_bets && $iTeamBets <= $aFuzhi[$iCount - 1]->max_bets) {
//third
                $log = [];
                $log['condition'] = '扶植期内　third : ' . $aFuzhi[$iCount - 1]->min_bets . '《=　bet(' . $iTeamBets . ')《 ' . $aFuzhi[$iCount - 1]->max_bets;
                $log['iCount'] = 'iCount is ' . $iCount . ' and fuzhi key is ' . ((int)$iCount - 1);
                if ((!$oUserAgent->is_limit_active) || ($oUserAgent->is_limit_active && $iActiveUserNum >= $aFuzhi[$iCount - 1]->active_user_num)) {
                    $log['需限制活跃人数'] = $oUserAgent->is_limit_active ? '是:' . $iActiveUserNum >= $aFuzhi[$iCount - 1]->active_user_num : '无';
                    $log['iUnitNum　算法'] = $iTeamBets . '/' . $aFuzhi[$iCount - 1]->unit;
                    $log['iUnitNum　结果'] = $iUnitNum = $iTeamBets / $aFuzhi[$iCount - 1]->unit;
                    $log['iUnitNumW floor value'] = $iUnitNumW = floor($iTeamBets / $aFuzhi[$iCount - 1]->unit);
                    $log['iWBackMoney 算法'] = $iUnitNumW . '*' . $aFuzhi[$iCount - 1]->back_money;
                    $log['iWBackMoney 结果'] = $iWBackMoney = $iUnitNumW * $aFuzhi[$iCount - 1]->back_money; //万的
                    $log['iUnitNumQ 算法'] = '( iUnitNum ' . $iUnitNum . '- iUnitNumW ' . $iUnitNumW . ') * 10';
                    $log['iUnitNumQ 结果'] = $iUnitNumQ = floor(($iUnitNum - $iUnitNumW) * 10); //千的
                    $log['iQBackMoney (iUnitNumQ * 10)'] = $iQBackMoney = $iUnitNumQ * 10; //千的
                    $iBackMoney = $iWBackMoney + $iQBackMoney; //总的
                    $log['iBackMoney'] = '(iWBackMoney + $iQBackMoney) 0~5万段最高返奖1.0% = ' . $iBackMoney;
                    log_args_write($log);
                    $data->back_money15 = $iBackMoney;
                    break;
                }
            }
            if ($iTeamBets > $aFuzhi[0]->max_bets && ((!$oUserAgent->is_limit_active) || ($oUserAgent->is_limit_active && $iActiveUserNum >= $aFuzhi[0]->active_user_num))) {
//fourth
                $log = [];
                $log['condition'] = '扶植期内　fourth : 最小扶植:' . $iTeamBets . '>' . $aFuzhi[0]->max_bets;
                $log['需限制活跃人数'] = $oUserAgent->is_limit_active ? '是:' . $iActiveUserNum >= $aFuzhi[$iCount - 1]->active_user_num : '无';
                $log['0~5万段最高返奖1.0%'] = $data->back_money15 = $iMaxPrize15;
                $temporary540 = $iMaxPrize4050 - $iMaxPrize15;
                $log['5~50万段最高返奖1.0%'] = $temporary540 . ' = iMaxPrize4050 ' . $iMaxPrize4050 . ' - iMaxPrize15 ' . $iMaxPrize15;
                $data->back_money540 = $temporary540;
                $temporary4080 = $iMaxPrize140150 - $iMaxPrize4050;
                $log['50~150万段最高返奖1.2%'] = $temporary4080 . ' = iMaxPrize140150 ' . $iMaxPrize140150 . ' - iMaxPrize4050 ' . $iMaxPrize4050;
                log_args_write($log);
                $data->back_money4080 = $temporary4080;
                break;
            }
            if ($iTeamBets > $oFuZhiRule->min_bets && $iTeamBets <= $oFuZhiRule->max_bets) {
                if ((!$oUserAgent->is_limit_active) || ($oUserAgent->is_limit_active && $iActiveUserNum >= $oFuZhiRule->active_user_num)) {
                    $log = [];
                    $log['condition'] = '扶植期内　five :' . $oFuZhiRule->min_bets . '<' . $iTeamBets . '<=' . $oFuZhiRule->max_bets;
//                            $iUnitNumW = floor($iTeamBets / 10000);
                    //                            $iBackMoney = $iUnitNumW * 100; //万的
                    $log['flag'] = $oFuZhiRule->flag;
                    switch ($oFuZhiRule->flag) {
                        case '5-10':
                        case '10-20':
                        case '20-30':
                        case '30-40':
                        case '40-50':
                            $log['iUnitNumW'] = 'floor((' . $iTeamBets . ' - 50000) / 10000)';
                            $iUnitNumW = floor(($iTeamBets - 50000) / 10000);
                            $log['iBackMoney'] = $iUnitNumW . '*' . $oFuZhiRule->back_money;
                            $iBackMoney = $iUnitNumW * $oFuZhiRule->back_money; //万的
                            $log['0~5万段最高返奖1.0%'] = $data->back_money15 = $iMaxPrize15;
                            $log['5~50万段最高返奖1.0%'] = $data->back_money540 = $iBackMoney;
                            log_args_write($log);
                            break 2;
                        case '50-60':
                        case '60-70':
                        case '70-80':
                        case '80-90':
                        case '90-100':
                        case '100-110':
                        case '110-120':
                        case '120-130':
                        case '130-140':
                        case '140-150':
                            $log['0~5万段最高返奖1.0%'] = $data->back_money15 = $iMaxPrize15;
                            $log['5~50万段最高返奖1.0%'] = $data->back_money540 = $iMaxPrize4050 - $iMaxPrize15;
                            $log['iUnitNumW'] = 'floor((' . $iTeamBets . ' - 50000) / 10000)';
                            $iUnitNumW = floor(($iTeamBets - 500000) / 10000);
                            $log['iBackMoney'] = $iUnitNumW . '*' . $oFuZhiRule->back_money;
                            $iBackMoney = $iUnitNumW * $oFuZhiRule->back_money; //万的
                            $log['50~150万段最高返奖1.2%'] = $data->back_money4080 = $iBackMoney;
                            log_args_write($log);
                            break 2;
                    }
                }
            }
            if ($iTeamBets > $oFuZhiRule->min_bets) {
                //six
                if ((!$oUserAgent->is_limit_active) || ($oUserAgent->is_limit_active && $iActiveUserNum >= $oFuZhiRule->active_user_num)) {
                    $log = [];
                    $log['condition'] = '扶植期内　six :' . $iTeamBets . '>' . $oFuZhiRule->min_bets;
                    $log['flag'] = $oFuZhiRule->flag;
                    switch ($oFuZhiRule->flag) {
                        case '1-5':
                            $log['0~5万段最高返奖1.0%'] = $data->back_money15 = $iMaxPrize15;
                            log_args_write($log);
                            break 2;
                        case '5-10':
                            $log['0~5万段最高返奖1.0%'] = $data->back_money15 = $iMaxPrize15;
                            $log['5~50万段最高返奖1.0%'] = $data->back_money540 = $iMaxPrize510 - $iMaxPrize15;
                            log_args_write($log);
                            break 2;
                        case '10-20':
                            $log['0~5万段最高返奖1.0%'] = $data->back_money15 = $iMaxPrize15;
                            $log['5~50万段最高返奖1.0%'] = $data->back_money540 = $iMaxPrize1020 - $iMaxPrize15;
                            log_args_write($log);
                            break 2;
                        case '20-30':
                            $log['0~5万段最高返奖1.0%'] = $data->back_money15 = $iMaxPrize15;
                            $log['5~50万段最高返奖1.0%'] = $data->back_money540 = $iMaxPrize2030 - $iMaxPrize15;
                            log_args_write($log);
                            break 2;
                        case '30-40':
                            $log['0~5万段最高返奖1.0%'] = $data->back_money15 = $iMaxPrize15;
                            $log['5~50万段最高返奖1.0%'] = $data->back_money540 = $iMaxPrize3040 - $iMaxPrize15;
                            log_args_write($log);
                            break 2;
                        case '40-50':
                            $log['0~5万段最高返奖1.0%'] = $data->back_money15 = $iMaxPrize15;
                            $log['5~50万段最高返奖1.0%'] = $data->back_money540 = $iMaxPrize4050 - $iMaxPrize15;
                            log_args_write($log);
                            break 2;
                        case '50-60':
                            $log['0~5万段最高返奖1.0%'] = $data->back_money15 = $iMaxPrize15;
                            $log['5~50万段最高返奖1.0%'] = $data->back_money540 = $iMaxPrize4050 - $iMaxPrize15;
                            $log['50~150万段最高返奖1.2%'] = $data->back_money4080 = $iMaxPrize5060 - $iMaxPrize4050;
                            log_args_write($log);
                            break 2;
                        case '60-70':
                            $log['0~5万段最高返奖1.0%'] = $data->back_money15 = $iMaxPrize15;
                            $log['5~50万段最高返奖1.0%'] = $data->back_money540 = $iMaxPrize4050 - $iMaxPrize15;
                            $log['50~150万段最高返奖1.2%'] = $data->back_money4080 = $iMaxPrize6070 - $iMaxPrize4050;
                            log_args_write($log);
                            break 2;
                        case '70-80':
                            $log['0~5万段最高返奖1.0%'] = $data->back_money15 = $iMaxPrize15;
                            $log['5~50万段最高返奖1.0%'] = $data->back_money540 = $iMaxPrize4050 - $iMaxPrize15;
                            $log['50~150万段最高返奖1.2%'] = $data->back_money4080 = $iMaxPrize7080 - $iMaxPrize4050;
                            log_args_write($log);
                            break 2;
                        case '80-90':
                            $log['0~5万段最高返奖1.0%'] = $data->back_money15 = $iMaxPrize15;
                            $log['5~50万段最高返奖1.0%'] = $data->back_money540 = $iMaxPrize4050 - $iMaxPrize15;
                            $log['50~150万段最高返奖1.2%'] = $data->back_money4080 = $iMaxPrize8090 - $iMaxPrize4050;
                            log_args_write($log);
                            break 2;
                        case '90-100':
                            $log['0~5万段最高返奖1.0%'] = $data->back_money15 = $iMaxPrize15;
                            $log['5~50万段最高返奖1.0%'] = $data->back_money540 = $iMaxPrize4050 - $iMaxPrize15;
                            $log['50~150万段最高返奖1.2%'] = $data->back_money4080 = $iMaxPrize90100 - $iMaxPrize4050;
                            log_args_write($log);
                            break 2;
                        case '100-110':
                            $log['0~5万段最高返奖1.0%'] = $data->back_money15 = $iMaxPrize15;
                            $log['5~50万段最高返奖1.0%'] = $data->back_money540 = $iMaxPrize4050 - $iMaxPrize15;
                            $log['50~150万段最高返奖1.2%'] = $data->back_money4080 = $iMaxPrize100110 - $iMaxPrize4050;
                            log_args_write($log);
                            break 2;
                        case '110-120':
                            $log['0~5万段最高返奖1.0%'] = $data->back_money15 = $iMaxPrize15;
                            $log['5~50万段最高返奖1.0%'] = $data->back_money540 = $iMaxPrize4050 - $iMaxPrize15;
                            $log['50~150万段最高返奖1.2%'] = $data->back_money4080 = $iMaxPrize110120 - $iMaxPrize4050;
                            log_args_write($log);
                            break 2;
                        case '120-130':
                            $log['0~5万段最高返奖1.0%'] = $data->back_money15 = $iMaxPrize15;
                            $log['5~50万段最高返奖1.0%'] = $data->back_money540 = $iMaxPrize4050 - $iMaxPrize15;
                            $log['50~150万段最高返奖1.2%'] = $data->back_money4080 = $iMaxPrize120130 - $iMaxPrize4050;
                            log_args_write($log);
                            break 2;
                        case '130-140':
                            $log['0~5万段最高返奖1.0%'] = $data->back_money15 = $iMaxPrize15;
                            $log['5~50万段最高返奖1.0%'] = $data->back_money540 = $iMaxPrize4050 - $iMaxPrize15;
                            $log['50~150万段最高返奖1.2%'] = $data->back_money4080 = $iMaxPrize130140 - $iMaxPrize4050;
                            log_args_write($log);
                            break 2;
                    }
                }
            }

        }
        dd($data, $oUserAgent, $oFuZhiRule, $iActiveUserNum, $iTeamBets);
        echo '已完成任务。。。》最终有效金额＝' . $iTeamBets . '与人数量＝' . $iActiveUserNum . '|[0~5万段最高返奖1.0%]=>' . $data->back_money15 . '[5~50万段最高返奖1.0%]＝》' . $data->back_money540 . '[50~150万段最高返奖1.2%]＝》' . $data->back_money4080 . "\n";
    }
}
echo 'finished';
function dd(Data $d, $oUserAgent, $oFuZhiRule, $activeUser, $iTeamBets)
{
    $log = '';
    $log .= '|条件　＝》投注量' . $oFuZhiRule->min_bets . '与' . $oFuZhiRule->max_bets . '之间';
    $log .= '|目前活跃人数　＝' . $activeUser;
    $log .= '|需限制活跃人数　＝' . $islimit = empty($oUserAgent->is_limit_active) ? '否' : '是';
    $log .= '|目前金额　＝》' . $iTeamBets . '|[0~5万段最高返奖1.0%]=>' . $d->back_money15 . '[5~50万段最高返奖1.0%]＝》' . $d->back_money540 . '[50~150万段最高返奖1.2%]＝》' . $d->back_money4080;
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
    $log_obj->setLog("\n".$log);
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

