<?php
/**
 * Created by PhpStorm.
 * author: harris
 * Date: 17-9-19
 * Time: 下午4:03
 */
function get_client_ip() {
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = '0.0.0.0';
    return $ipaddress;
}

if (isset($_POST['submit'])) {
    echo get_client_ip();
} else {
    $html = <<<html
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<form action="#" method="post"><input type="text" name="ip" value="">
<input type="submit" name="submit">
</form>
</body>
</html>
html;
    echo $html;
    echo $_SERVER['REMOTE_ADDR'];
}


