<?php


class Decryption
{
    public $merchantPublicKey = <<<EOD
-----BEGIN PUBLIC KEY-----
~p~-----END PUBLIC KEY-----
EOD;


    public function verify($data, $sign, $publibKey)
    {
        $publibKey = chunk_split($publibKey, 64, "\n");
        $publibKey = str_replace("~p~", $publibKey, $this->merchantPublicKey);
        $publibKey = openssl_get_publickey($publibKey);
        $sign = base64_decode($sign);
        $result = (bool)openssl_verify($this->getPurifyData($data), $sign, $publibKey);
        if ($result != true) {
            return false;
        }
        return true;
    }

    private function getPurifyData($str)
    {
        $data = explode("\n", $str);
        if (!is_array($data)) {
            return [];
        }
        $arr = [];
        foreach ($data as $k => $value) {
            $iNum = strpos($value, '=');
            if (!$iNum) {
                continue;
            }
            $key = substr($value, 0, $iNum);
            $v = substr($value, $iNum + 1);
            if (!$v) {
                $v = "";
            }
            $arr[$key] = $v;
        }
        array_pop($arr);
        $str = '';
        foreach ($arr as $k => $v) {
            $str .= $v;
        }
        return $str;
    }
}

$str = "r0_Cmd=TransPay\np1_MerId=CHANG1492489630601\nr1_Code=0000\nr7_Desc=\nr2_TrxId=6FFBB9BE9EFFEF\nhmac=RBcz8BV9pgJ+7YswlgL+R3q8HtGdeXe1LrVv6ckER+Ex7QT421+QXIlGrF2GZCRvG43Mj85+9LYaBD2brmJYsApnbWUUDhm1Wzwn81nqIZwyz7lSGpnbnB9Pq5lhtPUk6aBxnWbeBu8Ar7plnWbxqTQSt+VTfvyPJtCZeJ2XgXA=\n";
$hmac = "RBcz8BV9pgJ+7YswlgL+R3q8HtGdeXe1LrVv6ckER+Ex7QT421+QXIlGrF2GZCRvG43Mj85+9LYaBD2brmJYsApnbWUUDhm1Wzwn81nqIZwyz7lSGpnbnB9Pq5lhtPUk6aBxnWbeBu8Ar7plnWbxqTQSt+VTfvyPJtCZeJ2XgXA=";
$decrypter = new Decryption();
///##############
$merchantPublicKey = 'MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQCr8YNPeMh4M/5HCGg8Re121Wuors4kYWaD3glb2GNd8+/0cb3q6Xh9Zl1VMgB/L9xzBRvoRhfCWzcNkcrsUbriIJheQnXD5vl05cTnfzhh7XL3LlqMj0ZHWmRnhLxgk26m0IHnreZQfhW0uZyGl6A8rxcDbkIuknvUbTHlpQlbEwIDAQAB';
$bVerify = $decrypter->verify($str, $hmac, $merchantPublicKey);

if ($bVerify) {
    echo "success";
} else {
    echo "fail";
}