<?php
$file1 = file_get_contents("file1.json");
$file2 = file_get_contents("file2.json");
$file3 = file_get_contents("file3.json");
$file4 = file_get_contents("file4.json");
$file5 = file_get_contents("file5.json");
$file6 = file_get_contents("file6.json");
$file7 = file_get_contents("file7.json");
$file8 = file_get_contents("file8.json");

/*for($i=0;$i<8;$i++)
{
    if ($i==0)
    {
        $r = json_decode($file1,true);
    }
    else{
        $arr = json_decode(${'file'.($i+1)},true);
        $r = array_merge($r,$arr);
    }
}*/
$all = file_get_contents("bankbranch.json");
$r = json_decode($all,true);
echo "<pre>".print_r($r,true)."</pre>";


