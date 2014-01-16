<?php
	include "../function/functionPHP.php";
	$array[user]="thanaphutBenz";
	$array[pass]="1234";
	$temp=serialize($array);
	echo "Before : $temp<br>";
	echo "After : ".aesEncrypt($temp);