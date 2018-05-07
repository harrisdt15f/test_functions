<?php
/**
 * Created by PhpStorm.
 * author: harris
 * Date: 18-4-11
 * Time: 上午9:45
 */
$var = 'ABCDEFGH:/MNRPQR/';
echo "Original: $var<hr />\n";

/* These two examples replace all of $var with 'bob'. */
echo substr_replace($var, 'bob', 0) . "<br />\n";
echo substr_replace($var, 'bob', 0, strlen($var)) . "<br />\n";

/* Insert 'bob' right at the beginning of $var. */
echo substr_replace($var, 'bob', 0, 0) . "<br />\n";

/* These next two replace 'MNRPQR' in $var with 'bob'. */
echo substr_replace($var, 'bob', 10, -1) . "<br />\n";
echo substr_replace($var, 'bob', -7, -1) . "<br />\n";

/* Delete 'MNRPQR' from $var. */
echo substr_replace($var, '', 10, -1) . "<br />\n";


echo substr_replace('董腾阳', '*', 0, 1) . "<br />\n";

$mystring = 'harrisdt15f@gmail.com';
$mystring = '18612345678';
$pos = strpos($mystring, '@');
if ($pos)
{
    $firstL = explode('@',$mystring);
    $to = strlen($firstL[0])-4;
    $star = '';
    for ($i=0;$i<$to;$i++)
    {
        $star.='*';
    }
    echo substr_replace($mystring, $star, 4, $to) . "<br />\n";
}
else{

    echo substr_replace($mystring, '*****', 3, -4) . "<br />\n";
}
