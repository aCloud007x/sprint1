<?php
include "connect.php";
if($_POST['txtPostalCode']){

	$cmd = "SELECT Mid FROM member ORDER BY Mid DESC LIMIT 1";
	$objQuery = mysqli_query($connect,$cmd);
	$row = mysqli_fetch_assoc($objQuery);
	$last = intval($row["Mid"]);
	$last =  $last + 1;
	$Mid = $last;

	$Mlink = '';
	$Musername = $_POST['txtUsername'];
	$Mpassword = $_POST["txtPassword"];
	$Mqt = $_POST["txtQuestion"];
	$Mans = $_POST["txtAnswer"];
	$Mname = $_POST["txtFirstname"]." ".$_POST["txtLastname"];
	$Maddr = $_POST["txtAddress"];
	$Mstate = $_POST["txtDistrict"];
	$Mcity = $_POST["txtProvince"];
	$Mpostal = $_POST["txtPostalCode"];
	$Mmobile = $_POST["txtMobileNumber"];


	// $sql="INSERT INTO addtest VALUES ('$username')";


	$sql = "INSERT INTO `member`(Mid,`Musername`, `Mpassword`, `Mname`, `Mtel`, `Mlink`, `Maddress`, `Mstate`, `Mcity`, `Mpostalcode`, `Mquestion`, `Manswer`) VALUES ($Mid,'$Musername','$Mpassword','$Mname','$Mmobile','$Mlink','$Maddr','$Mstate','$Mcity','$Mpostal','$Mqt','$Mans')";



	$r = mysqli_query($connect,$sql)or die(mysqli_error($connect));
	sleep(1);
	if(!$r){ echo "ไม่สามารถบันทึกข้อมูลได้ โปรดตรวจสอบใหม่อีกครั้ง";}
	else{ echo "บันทึกข้อมูลแล้ว";}
}
mysqli_close($connect);

?>
