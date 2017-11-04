<?php

$aa = 'bb';
$bb = compact('aa');
$cc = 'aa';
$dd = array_merge($bb, compact('cc'));
var_dump($bb, $dd);