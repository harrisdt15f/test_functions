<?php
$hasThirdRechargeChannel = false;
if ($hasThirdRechargeChannel) {
	$aTabList = [
//		'netbank' => '网银',
		'quick' => '网银快捷',
		'pay' => '银联快捷',
		'qq' => 'QQ钱包',
//            'caifutong' => '财付通',
		'alipay' => '支付宝',
		'weixin' => '微信',
//            'baidu' => '百度钱包',
		//            'alipay-to-netbank' => '转网银',
	];
} else {
	$aTabList = [
		'netbank' => '网银',
		'quick' => '网银快捷',
		'qq' => 'QQ钱包',
		'weixin' => '微信',
		'alipay' => '支付宝',
		// 'pay' => '银联快捷',
		//                'baidu' => '百度钱包',
		//            'alipay-to-netbank' => '转网银',
	];
}
if ((date('H') < 9 || date('H') > 21)) {
	unset($aTabList['pay']);
}

$gateway_tab_linker = [
	'netbank' => 'netbank', //原有会指向的
	'banks' => 'quick', //原有会指向的
	'unionpay' => 'pay', //原有会指向的
	'unionpay_qr' => 'unionpay_qr', //新加
	'alipay' => 'alipay', //原有会指向的
	'weixin' => 'weixin', //原有会指向的
	'qq' => 'qq', //原有会指向的
	'baidu' => 'baidu', //新加
	'jd' => 'jd', //新加
];

$gateway = ['banks', 'unionpay', 'unionpay_qr', 'alipay', 'weixin', 'qq', 'baidu', 'jd'];

$gateway_new = [];
foreach ($gateway_tab_linker as $key => $value) {
	if (in_array($key, $gateway) && array_key_exists($value, $aTabList)) {
		$gateway_new[] = $key;
	} else {
		if (array_key_exists($value, $aTabList)) {
			unset($aTabList[$value]);
		}

	}
}
$gateway = $gateway_new;
print("<pre>" . print_r($aTabList, true) . "</pre>");
print("<pre>" . print_r($gateway_new, true) . "</pre>");die();