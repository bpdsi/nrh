<?php
	include "../function/functionPHP.php";
	$query="
		select		*
		from		lab_share
		order by	labShareID desc
	";
	$result=mysql_query($query);
	$row=mysql_fetch_array($result);
	$labShareID=$row["labShareID"]+1;
	
	$query="
		insert into	lab_share
			(
				labShareID,
				ownerIP,
				PersonalID,
				shareDatetime,
				targetEmail,
				creditAvailable,
				LabTestID
			) values (
				'$labShareID',
				'".$_SERVER[REMOTE_ADDR]."',
				'".$_POST["PersonalID"]."',
				CURRENT_TIMESTAMP,
				'".$_POST["targetEmail"]."',
				'".$_POST["creditAvailable"]."',
				'".$_POST["LabTestID"]."'
			)
	";
	$result=mysql_query($query) or die("fail::");

	if($_POST["shareType"]=="showLink"){
		$shareLink=$mainUrl."/searchLab/sharedLab.php?key=".urlencode(aesEncrypt($labShareID));
		echo "complete::".$shareLink;
	}else if($_POST["shareType"]=="shareViaEmail"){
		echo "complete::".$labShareID;
	}