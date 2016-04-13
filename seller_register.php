<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php header('Content-type: text/html; charset=UTF-8');
 //ob_start() ; 
 session_start(); 
	include "connect.php";
	mysqli_query($connect,"SET NAMES UTF8");
 	$objConnect = $connect;
	
	////$strSQL = "SELECT Mid FROM member WHERE Mname = '".$_SESSION['user']."'";
	//echo $strSQL;
	//$objQuery = mysqli_query($objConnect,$strSQL) or die ("Error Query [".$strSQL."]");
	//	$objResult = mysqli_fetch_array($objQuery);
		//$objDB = mysql_select_db("sec01_group3");
		$strSQL = "SELECT * FROM member WHERE Mname = '".$_SESSION['user']."'";
		$objQuery = mysqli_query($objConnect,$strSQL) or die ("Error Query [".$strSQL."]");
		$objResult = mysqli_fetch_array($objQuery);

		
	//$name=$_POST["name"];
	 $id=$objResult["Mid"];
	 $reason=$_POST["reason"];
	 $status="waiting";
	$sql  = "INSERT INTO `seller`(`Sid`,`Mid`, `Sreason`, `Sstatus`) VALUES (0,'$id','$reason','$status')";
	$r = mysqli_query($connect,$sql)or die(mysqli_error($connect));
	
	if($r)
	{ 
		header("refresh: 0; url=TheKeeper.php");
		// echo '<h3 class="green">REQUEST SEND<br> Redirecting to home page in 1 second.. <br> or <a href="TheKeeper.php">Click Here</a></h3>';
		
	}
	else{ 
		// sleep(2);
		// echo "okay";
			
			echo "Error<br/>";
		
	}
	//	echo $sql;
	
	
 

	


?>