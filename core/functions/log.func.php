<?php

function fcLog($area, $text, $debug = true)
{
	GLOBAL $confDebug;

	if ($confDebug == true || $debug == true)
	{
		$file = "logs/".date("Y-m-d").".log";
		
		$datei = fopen($file, "a");
		fwrite($datei, date("H:i:s")." ".$area." - ".$text."\r\n");
		fclose($datei);
	}
}

?>
