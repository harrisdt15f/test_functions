<?php
$supported_banks_check = [
    'oAllBanks_transfer' => 'getSupportCardBank', //【银行卡转帐】 $oAllBanks_transfer
    'oAllBanks' => 'getSupportThirdPartBank', //【网银快捷】$oAllBanks
    'oAll' => 'getSupportThirdPartBank',
];
foreach ($supported_banks_check as $key => $value) {
    if (stristr($key, 'Banks') !== FALSE) {
        echo $key . " is matched<br>";
    }
}
