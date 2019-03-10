<?php
date_default_timezone_set('America/Costa_Rica');
//	$date = date('H:i:s');
	//$fecha = '21/03/2019';
	//$fechaNueva = (new datetime($fecha))->format('Y-m-d');

	/*$originalDate = "21-03-2019";
	$newDate = date("Y-m-d", strtotime($originalDate));*/

	$date = '09/03/2019';
	$newDate =  $date->format('Y-m-d');
	echo $newDate;
	//echo $fechaNueva;
?>