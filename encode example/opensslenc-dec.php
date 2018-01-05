<?php
/**
 * Created by PhpStorm.
 * author: harris
 * Date: 17-12-22
 * Time: 下午3:46
 */
$method = 'AES-256-CBC';
$secret = base64_decode('tvFD4Vl6Pu2CmqdKYOhIkEQ8ZO4XA4D8CLowBpLSCvA=');
$iv = base64_decode('AVoIW0Zs2YY2zFm5fazLfg==');

//$input = 'img=/dir/dir/hi-res-img.jpg&w=700&h=500';
$input = '<form id="third_pay_0beefa372763e3fa1b046a63422bd6ae_submit" name="third_pay_0beefa372763e3fa1b046a63422bd6ae_submit" action="http://pay.ifeepay.com/gateway/pay.jsp" method="post"><input type="hidden" name="version" value="v1"/><input type="hidden" name="merchant_no" value="144712004109"/><input type="hidden" name="order_no" value="201712221520317838020325"/><input type="hidden" name="goods_name" value="ZGlhbnF1YW4="/><input type="hidden" name="order_amount" value="100.00"/><input type="hidden" name="backend_url" value="https://pay.cpdyjbm.com/dev/deposit/notify/201712221520317838020325"/><input type="hidden" name="frontend_url" value="http://www.zhenwin.com/deposit/return/201712221520317838020325"/><input type="hidden" name="reserve" value=""/><input type="hidden" name="card_type" value="0"/><input type="hidden" name="pay_mode" value="12"/><input type="hidden" name="bank_code" value="WECHATWAP"/><input type="hidden" name="sign" value="0beefa372763e3fa1b046a63422bd6ae"/></form><script>document.forms["third_pay_0beefa372763e3fa1b046a63422bd6ae_submit"].submit();</script>';

//var_dump($input);
//$compressed = compress($input);
$compressed = $input;
var_dump(base64_encode($compressed));

$encrypted = openssl_encrypt($compressed, $method, $secret, false, $iv);
var_dump($encrypted);
var_dump(base64_encode($encrypted));
$decrypted = openssl_decrypt($encrypted, $method, $secret, false, $iv);
var_dump($decrypted);

//$decompressed = decompress($compressed);
//var_dump($decompressed);