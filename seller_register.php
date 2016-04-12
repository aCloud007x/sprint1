<?php 
 //ob_start() ; 
 session_start(); 
	include "connect.php";
 	$objConnect = $connect;
	
	////$strSQL = "SELECT Mid FROM member WHERE Mname = '".$_SESSION['user']."'";
	//echo $strSQL;
	//$objQuery = mysqli_query($objConnect,$strSQL) or die ("Error Query [".$strSQL."]");
	//	$objResult = mysqli_fetch_array($objQuery);
		//$objDB = mysql_select_db("sec01_group3");
		$strSQL = "SELECT * FROM member WHERE Mname = '".$_SESSION['user']."'";
		$objQuery = mysqli_query($objConnect,$strSQL) or die ("Error Query [".$strSQL."]");
		$objResult = mysqli_fetch_array($objQuery);

		
	 echo $name=$_POST["name"];
	 $id=$objResult["Mid"];
	 echo $reason=$_POST["reason"];
	 $status="waiting";
	$sql  = "INSERT INTO `seller`(`Mid`, `Sname`, `Sreason`, `Sstatus`) VALUES ('$id','$name','$reason','$status')";
	$r = mysqli_query($connect,$sql)or die(mysqli_error($connect));
	
	if($r)
	{ 
		echo "Success<br/>";
		echo "<a href=TheKeeper.php>go to homepage</a>";
		
	}
	else{ 
		// sleep(2);
		// echo "okay";
			
			echo "Error<br/>";
		
	}
	//	echo $sql;
	
	
 

	


?>