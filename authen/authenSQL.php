<?php
	session_start();
	include "../function/functionPHP.php";
	host("nrh");
	$User=$_POST["User"];
	$Password=$_POST["Password"];
	$query="
		select	*
		from	person
		where	User='$User'
	";
	$result=mysql_query($query);
	$row=mysql_fetch_array($result);
	if(mysql_num_rows($result)==0 || aesDecrypt($row[Password])!=$Password){
		$ownerID=$row[PersonalID];
		if($ownerID==""){
			$query="
				insert into	log_authen_person
					(
						ipAddress,
						ownerID,
						user,
						authenResult,
						datetime
					) values (
						'$_SERVER[REMOTE_ADDR]',
						NULL,
						'$User',
						'fail',
						CURRENT_TIMESTAMP
					)
			";
			$result=mysql_query($query);
		}else{
			$query="
				insert into	log_authen_person
					(
						ipAddress,
						ownerID,
						user,
						authenResult,
						datetime
					) values (
						'$_SERVER[REMOTE_ADDR]',
						'$ownerID',
						'$User',
						'fail',
						CURRENT_TIMESTAMP
					)
			";
			$result=mysql_query($query);
		}
		
		header("location:authenFail.php");
	}else{
		$query="
			insert into	log_authen_person
				(
					ipAddress,
					ownerID,
					user,
					authenResult,
					datetime
				) values (
					'$_SERVER[REMOTE_ADDR]',
					'$row[PersonalID]',
					'$User',
					'pass',
					CURRENT_TIMESTAMP
				)
		";
		$result=mysql_query($query);
		$_SESSION["sess_User"]=$row[User];
		$_SESSION["sess_Password"]=$row[Password];
		$_SESSION["sess_Person"]=$row;
		$_SESSION["sess_vcPrefix"]="vc";
		header("location:../home");
	}