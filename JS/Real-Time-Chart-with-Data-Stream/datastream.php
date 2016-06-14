<?php
	header("Access-Control-Allow-Origin: https://orionhub.org/");
	date_default_timezone_set("UTC");
	$now =  date("H:i:s", time());
	//Get random numbers
	$randomValueRetail = floor(rand(15,95));
	$randomValueOnline = floor(rand(20,90));
	//Output
   	echo  "&label=".$now."&value=".$randomValueRetail."|".$randomValueOnline;
?>