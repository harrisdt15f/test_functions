<?php
function generateSerialNumber() {
	$fix_year = 2010;
	$year_code = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J'];
	//############################
	$Y = date('Y'); //2017
	$inty = intval($Y); //2017
	$interval = $inty - $fix_year; //7
	while (!isset($year_code[$interval])) {
		$interval -= 10;
	}
	$Y = $year_code[$interval]; //H
	//############################
	$m = date('m'); //09
	$hexa = dechex($m); //9
	$m_up = strtoupper($hexa);
	//############################
	$d = date('d'); //07
	//############################
	$t = time();
	$t5 = substr($t, -5);
	//############################
	$m_time = microtime();
	$m_time_2_5 = substr($m_time, 2, 5);
	//############################
	$ran_0_99 = rand(0, 99);
	$ran_2d = sprintf('%02d', $ran_0_99);
	//############################
	$order_sn = $Y . $m_up . $d . $t5 . $m_time_2_5 . $ran_2d;
	return $order_sn;
}

echo generateSerialNumber();