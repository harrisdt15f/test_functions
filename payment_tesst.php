<?php


class Decryption
{
    public $merchantPrivateKey = 'MIICdgIBADANBgkqhkiG9w0BAQEFAASCAmAwggJcAgEAAoGBAIsCXGS472Nlu39PkU5ZVifRh7h8zt5+Ozc0gl+DSbwLxZof3Y5Mfypu927AT8Ork1lnn3M5S+j84/JmliohlNsTqvxx04afnE/HNaV8PpudK7/g/0ddP9WJHZKx4U8HqtOGz6vc+LKd2Xyy5IsmV7+y9pazPYnjewolk2a0rT5JAgMBAAECgYEAhsttSIZELAB0Rkmjv3PFpar6jp0IBJwnU6rpWTD4CQ7pOED6GIh5L26XJJ/7OORhZ+qhpZvDzlObvmxX5NbXfgBen37BB1JyYB8miHJh4fmWUE61TtYkHFABihRPyd6gMnssmACgwHuka0hv/p1X3PH87/S8VaYFjEU6wVswygECQQDTgFZgRFMAtzKbDlDzx3xXUwVi11D9D/aP6Pri91T+xdyXQRUi0bSVAgDuM1WZjHQEJxeioqAQL7vRO7hzKvZpAkEAqEGHtrHDrPid50yDZRhmEZkbBgA0ZeU1TMs0IcsSFxkWLpZ+5AL5gU8lJ+mqepFsbwjaEvbtQ515fF0h9zfM4QJAfPyFjuQxjOW2MS13p2iG0XANacjGYpYxZgAPa1swTlMNNhFO9UGqDridZibN+iynTuDvNbwXDRm4S0CYku6bqQJADca/y++mK+V3WFblc0OaJ9q3YbhmkelAgfcpX5L2+jktncbowNaVg0btreTt9nctv7Gj2WWqa5zbM5mUjF9fQQJAVS9dRD7Fnu+VPDlJvQ68y2GkQ58aW0B0XZoyajJHPHU3beWiCPbmICvkfgGgbLO8SXJpPgKVkDp7j5OdSW9D8A==';
    public  $merchantPublicKey = 'MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQCr8YNPeMh4M/5HCGg8Re121Wuors4kYWaD3glb2GNd8+/0cb3q6Xh9Zl1VMgB/L9xzBRvoRhfCWzcNkcrsUbriIJheQnXD5vl05cTnfzhh7XL3LlqMj0ZHWmRnhLxgk26m0IHnreZQfhW0uZyGl6A8rxcDbkIuknvUbTHlpQlbEwIDAQAB';


    public function verify($data, $sign, $publibKey)
    {
        $publibKey = openssl_get_publickey($publibKey);
        $sign = base64_decode($sign);
        $result = (bool)openssl_verify($data, $sign, $publibKey);
        if ($result != true) {
            return false;
        }
        return true;
    }
    public function dealReturnData($str){
        $data = explode("\n", $str);
        if(! is_array($data)){
            return [];
        }
        $arr = [];
        foreach($data as $k=>$value){
            $iNum = strpos($value, '=');
            if(! $iNum){
                continue;
            }
            $key = substr($value, 0, $iNum);
            $v = substr($value, $iNum+1);
            if(! $v){
                $v = "";
            }
            $arr[$key] = $v;
        }
        array_pop($arr);
        $str = '';
        foreach ($arr as $k=>$v){
            $str .= $v;
        }
        return $str;
    }
}
$str = "r0_Cmd=TransPay\np1_MerId=CHANG1492489630601\nr1_Code=0000\nr7_Desc=\nr2_TrxId=6FFBB9BE9EFFEF\nhmac=RBcz8BV9pgJ+7YswlgL+R3q8HtGdeXe1LrVv6ckER+Ex7QT421+QXIlGrF2GZCRvG43Mj85+9LYaBD2brmJYsApnbWUUDhm1Wzwn81nqIZwyz7lSGpnbnB9Pq5lhtPUk6aBxnWbeBu8Ar7plnWbxqTQSt+VTfvyPJtCZeJ2XgXA=\n";
$hmac ="RBcz8BV9pgJ+7YswlgL+R3q8HtGdeXe1LrVv6ckER+Ex7QT421+QXIlGrF2GZCRvG43Mj85+9LYaBD2brmJYsApnbWUUDhm1Wzwn81nqIZwyz7lSGpnbnB9Pq5lhtPUk6aBxnWbeBu8Ar7plnWbxqTQSt+VTfvyPJtCZeJ2XgXA=";
$decrypter = new Decryption();
///##############
$merchantPublicKey= chunk_split($decrypter->merchantPublicKey, 64, "\n");
$merchantPublicKey = "-----BEGIN PUBLIC KEY-----\n$merchantPublicKey-----END PUBLIC KEY-----\n";




$str = $decrypter->dealReturnData($str);

$bVerify = $decrypter->verify($str, $hmac, $merchantPublicKey);

if ($bVerify) {
    echo "success";
}
else{
    echo "fail";
}