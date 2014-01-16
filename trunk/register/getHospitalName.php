<?php
	$Hospital=$_POST["Hospital"];
	include "../function/functionPHP.php";
	echo get_hospitalName($Hospital);