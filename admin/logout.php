<?php
	session_start();
	unset($_SESSION["sess_User"]);
	unset($_SESSION["sess_Password"]);
	unset($_SESSION["sess_Person"]);
	
	unset($_SESSION["sess_vc_User"]);
	unset($_SESSION["sess_vc_Password"]);
	unset($_SESSION["sess_vc_Person"]);
	
	unset($_SESSION["sess_vcPrefix"]);
	
	unset($_SESSION["admin_User"]);
	unset($_SESSION["admin_Password"]);
	unset($_SESSION["admin_Person"]);
	header("location:../admin");