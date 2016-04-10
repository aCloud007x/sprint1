<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
<link type="text/css" href="css/jquery-ui.min.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
<script src="js/jquery.blockUI.js"></script>
<script src="js/jquery.validate.min.js"></script>
<script type="text/javascript">
function succ(){
	// document.cookie = "user="+mail; 
	// document.cookie = "pwd="+pwd;
	$('#successdlg').dialog({ //begin dialog
		title:"DETAIL..",
		dialogClass: "no-close",
		maxWidth:600,
        maxHeight: 500,
        width: 600,
        height: 500,
		modal:true,
		buttons: [
		{text:'OK', click:function(){ location.href = 'login.php'; }}
		]
		// {text:'OK', click:function(){ $(this).dialog('close'); }}
	});//end dialog
}

function fail(){
	$('#errordlg').dialog({ //begin dialog
		title:"ERROR !",
		dialogClass: "no-close",
		modal:true,
		maxWidth:600,
        maxHeight: 500,
        width: 600,
        height: 500,
		buttons: [
		{text:'Cancel', click:function(){ location.href = 'reg.php'; }}
				]
	});//end dialog
}
</script>
<style>
body {
	background-color: #34383e;
	font: normal 13px/20px "Helvetica Neue", helvetica, arial, sans-serif;
	padding: 100px;
	color: white;
</style>


</head>

<body>
<div id="successdlg" style="display:none;">บันทึกข้อมูลสำเร็จ !</div>
<div id="errordlg" style="display:none;">ผิดพลาด..<br>โปรดลองใหม่อีกครั้ง</div>

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
	
	if(!$r)
	{ 
		// sleep(2);
		// echo "denied";
		echo "<script> fail(); </script>";
		
	}
	else{ 
		// sleep(2);
		// echo "okay";
			$expire = time() + 30*24*60*60;
			setcookie("user", "$Musername");
			setcookie("pwd", "$Mpassword");
			echo "<script> succ(); </script>";
		
	}
}
mysqli_close($connect);
?>
<script> succ(); </script>
</body>
