<?php
session_start();
ob_start();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>User Authentication</title>
<style>
	*:not(h3) {
		font: 14px tahoma;
	}
	body {
		background: url(bg.jpg);
	}
	a {
		color: blue;
		text-decoration: none;
	}
	a:hover {
		color: red;
	}
	[type=text], [type=password] {
		width: 230px;
		background: #eee;
		border: solid 1px gray;
		padding: 3px;
		border-radius: 3px;
		margin: 3px 0px;
	}
	form#login > span {
		color: purple;
	}
	button {
		float: right;
		margin-right: 5px;
		margin-top: 10px;
		background: tomato;
		color: white;
		border-radius: 3px;
		border: solid 1px silver;
		padding: 2px 7px;
	}
	button:hover {
		background: yellow;
		color: red;	
	}
	fieldset {
		width: 240px;
		text-align: left;
		margin: auto;
		border-radius: 3px;
	}
	legend {
		font-size: larger;
		color: green;
	}
	a#index {
		display: inline-block;
		margin-top: 15px;
	}
	h3 {
		text-align: center;
	}
	h3.red {
		color: #900;
	}
	h3.green {
		color: #060;
	}
</style>
</head>

<body>
<?php
	include "connect.php";

if(isset($_COOKIE['user']) && isset($_COOKIE['pwd'])) {
	$_POST['user'] = $_COOKIE['user'];
	$_POST['pwd'] = $_COOKIE['pwd'];
}

if($_POST) {

	$user = $_POST['user'];
	$pwd = $_POST['pwd'];
	
	$sql = "SELECT * FROM member  
		 		WHERE  Musername = '$user' AND Mpassword = '$pwd'";
	
	$rs = mysqli_query($connect, $sql);
	$data = mysqli_fetch_array($rs);
	if(mysqli_num_rows($rs) == 0) {
		$err  = '<span class="err">ท่านใส่อีเมล<br>หรือรหัสผ่านไม่ถูกต้อง</span>';
	}	
	else {
		if(!empty($data['verify'])) {
			mysqli_close($connect);
			header("location: verify.php");
			ob_end_flush();
			exit;
		}
		
		//if($_POST['save_account']) {
			$expire = time() + 30*24*60*60;
			setcookie("user", "$user");
			setcookie("pwd", "$pwd");
		//}

		
		 $_SESSION['user'] = $data['Mname'];
	}
}
mysqli_close($connect);
?>


 <?php 
	 if(!isset($_SESSION['user'])) {  
?>
   
   	<fieldset><legend>สมาชิกเข้าสู่ระบบ</legend>
	<form id="login" method="post">
    	 <!-- <a href="new-member.php">สมัครสมาชิก</a> |
         <a href="verify.php">ยืนยันการสมัคร</a><br> -->
  		<input type="text" name="user" placeholder="ชื่อผู้ใช้" required><br>
    	<input type="password" name="pwd" placeholder="รหัสผ่าน" required><br>
        <!--<input type="checkbox" name="save_account">
         <span>เก็บข้อมูลไว้ในเครื่องนี้</span><br> -->
         <a href="#" id="forget">ลืมรหัสผ่าน</a> 
    	<button>เข้าสู่ระบบ</button>  
    </form>
    </fieldset>
 <?php  
 	} //ถ้าเข้าสู่ระบบไปแล้ว ดูจาก session
 	else {
?>
	<fieldset><legend>ท่านเข้าสู่ระบบแล้ว</legend>
    	<?php echo $_SESSION['user']; ?><br><br>
    	<a href="destroy.php">ออกจากระบบ</a> หรือ <a href="TheKeeper.php">ไปหน้าแรก</a>
	</fieldset>
<?php
	}
?>