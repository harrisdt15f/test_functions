<?php

$aa = 'bb';
$bb = compact('aa');
$cc = 'aa';
$dd = array_merge($bb, compact('cc'));
// var_dump($bb, $dd);

$supported_banks_check = [
	'oAllBanks_transfer' => 'getSupportCardBank', //【银行卡转帐】 $oAllBanks_transfer
	'oAllBanks' => 'getSupportThirdPartBank', //【网银快捷】$oAllBanks
	'oAllQq' => 'getSupportQq',
];
$final_data = [];
foreach ($supported_banks_check as $key => $value) {
	$$key = $value;
	$final_data = array_merge($final_data, compact($key));
}
var_dump($final_data);