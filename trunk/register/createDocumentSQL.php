<?php
	include "../function/functionPHP.php";
	host("nrh");
	if(!staffAuthenticated()){
		exit();
	}
	
	$Hospital=$_POST["Hospital"];
	$HospitalName=$_POST["HospitalName"];
	
	$query="
		select	*
		from	hospital
		where	HospCode='$Hospital'
	";
	$result=mysql_query($query) or die("<br>hospital<br>".mysql_error()."<br><pre>".$query);
	$numrows=mysql_num_rows($result);
	if($numrows==0){
		$query="
			insert into	hospital
				(
					HospCode,
					HospitalName
				) values (
					'$Hospital',
					'$HospitalName'
				)
		";
		$result=mysql_query($query) or die("<br>hospital<br>".mysql_error()."<br><pre>".$query);
	}
	
	$HospitalNumber=$_POST["HospitalNumber"];
	$CitizenID=$_POST["CitizenID"];
	$Name=$_POST["Name"];
	$Telephone=$_POST["Telephone"];
	$Email=$_POST["Email"];
	$User=$_POST["User"];
	$Password=$_POST["Password"];
	$GivenName=$_POST["GivenName"];
	$MiddleName=$_POST["MiddleName"];
	$FamilyName=$_POST["FamilyName"];
	$Prefix=$_POST["Prefix"];
	
	$BloodGroupABO=$_POST["BloodGroupABO"];
	$BloodTypeRh=$_POST["BloodTypeRh"];
	
	$BirthDate=$_POST["BirthDate"];
	$nameTemp=explode(" ", $Name);
	
	$AllowDate=$_POST["AllowDate"];
	
	$query="
		select	*
		from	person
		where	CitizenID='$CitizenID'
	";
	$result=mysql_query($query);
	if(mysql_num_rows($result)==0){
		$PersonalID=newPersonlID();
		$genPassword=genPassword(6);
		
		$BirthDate=dateConvert($BirthDate);
		
		$query="
			insert into	person
				(
					PersonalID,
					CitizenID,
					Prefix,
					PersonName,
					BirthDate,
					GivenName,
					MiddleName,
					FamilyName,
					BloodGroupABO,
					BloodTypeRh,
					Telephone,
					Email,
					User,
					Password
				) values (
					'$PersonalID',
					'$CitizenID',
					'$Prefix',
					'$Name',
					'$BirthDate',
					'$GivenName',
					'$MiddleName',
					'$FamilyName',
					'$BloodGroupABO',
					'$BloodTypeRh',
					'$Telephone',
					'$Email',
					'LAB".$PersonalID."',
					'".aesEncrypt($genPassword)."'
				)
		";
		$result=mysql_query($query) or die("<br>person<br>".mysql_error()."<br><pre>".$query);
	}else{
		$row=mysql_fetch_array($result);
		$PersonalID=$row[PersonalID];
	}
	
	$query="
		select	*
		from	hospital_patient
		where	HospCode='$Hospital' and
				PersonalID='$PersonalID'
	";
	$result=mysql_query($query);
	if(mysql_num_rows($result)==0){
		$query="
			insert into	hospital_patient
				(
					PersonalID,
					HospCode,
					HospitalNumber,
					CitizenID
				) values (
					'$PersonalID',
					'$Hospital',
					'$HospitalNumber',
					'$CitizenID'
				)
		";
		$result=mysql_query($query) or die("<br>hospital_patient<br>".mysql_error()."<br><pre>".$query);
	}
	
	$AllowID=newAllowID();
	$AllowType=$_POST["AllowType"];
	
	$AllowDate=(dateConvert($AllowDate))." ".date("H:i:s");
	
	$query="
		update	person_allow
		set		AllowStatus='expired'
		where	PersonalID='$PersonalID'
	";
	$result=mysql_query($query);
	
	$query="
		insert into	person_allow
			(
				AllowID,
				PersonalID,
				HospCode,
				AllowType,
				AllowDate,
				AllowStatus
			) values (
				'$AllowID',
				'$PersonalID',
				'$Hospital',
				'$AllowType',
				'$AllowDate',
				'accepted'
			)
	";
	$result=mysql_query($query) or die("<br>person_allow<br>".mysql_error()."<br><pre>".$query);
	
	//header("location:createDocument.php?code=".(aesEncrypt($PersonalID))."&code1=".(aesEncrypt($Hospital))."&code2=".(aesEncrypt($AllowID)));
?>
<script type="text/javascript">
	window.parent.open("createDocument.php?code=<?php echo (aesEncrypt($PersonalID));?>&code1=<?php echo (aesEncrypt($Hospital))?>&code2=<?php echo (aesEncrypt($AllowID))?>");
</script>