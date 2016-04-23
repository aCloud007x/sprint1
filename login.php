<?php
session_start();
ob_start();
	// $_SESSION['user'] = $data['Mname']; เก็บชื่อ
	// $_SESSION['username'] = $data['Musername']; เก็บชื่อusername ที่เป็นอีเมลล์
	// $_SESSION['userID'] = $data['Mid']; //for Rating Star เอาไอดีเก็บด้วย ไว้ใช้ในการลงคะแนนดาวที่หน้ารายละเอียดสินค้า
?>
<?php include('header-menu.php'); ?> <!-- HEAD -->
<!doctype html>
<html>
<head>
	<!-- ///// start collapse link ///// -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

<!-- ///// end collapse link ///// -->
<meta charset="utf-8">
<title>User Authentication</title>
<style>
	*:not(h3) {
		font: 14px tahoma;
	}
	body {
		background: url(bg2.gif);
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
	.thinking { 
	background: white url('img/checking.gif') no-repeat; 
	background-position: 190px 8px;   
}

.approved { 
	background: white url('img/true.gif') no-repeat; 
	background-position: 190px 8px;   
}

.denied { 
	background: #FF8282 url('img/false.gif') no-repeat; 
	background-position: 190px 8px;   
}
</style>
<script>
	function checkUsername() {
		//    document.getElementById("username").className = "thinking form-control";
		
		request = new XMLHttpRequest();
		request.onreadystatechange = showUsernameStatus;
		
		var username = document.getElementById("username").value;
		if(username==null||username==""){
			document.getElementById("username").focus();
			document.getElementById("username").select();
		}
		else{
		var url = "login-seller-ajax-check.php?username=" + username;
			request.open("GET", url, true);
			request.send(null);
		}
	}


	function showUsernameStatus() {
		if (request.readyState == 4) {
			if (request.status == 200) {

				if (request.responseText == "okay") {
					$("#radioshow").show();

						
									// document.getElementById("username").className = "approved form-control";
				} else {
							$("#radioshow").hide();
									// document.getElementById("username").className = "denied form-control";

				}
			}
		}
	}
</script>
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
	
	$err = '';
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
		
		if($_POST['radiocheck']) {
			$_SESSION['seller'] = 'seller';
		}

		// USE FOR STAR CHECK SESSION
		 $_SESSION['user'] = $data['Mname'];
		 $_SESSION['username'] = $data['Musername'];
		 $_SESSION['userID'] = $data['Mid']; //for Rating Star
		 header( "location: TheKeeper.php" );
 		exit(1); 
	}
}
mysqli_close($connect);
?>


 <?php 
	 if(!isset($_SESSION['user'])) {  
?>
   	<div class="container" style="padding-top: 35px; padding-bottom: 35px; background-color: #FAFAFA;">
   	<h3><img src="login.png" width="60">  Log-in</h3><hr width="430"><br><br>
	<form id="login" method="post">
    	 <!-- <a href="new-member.php">สมัครสมาชิก</a> |
         <a href="verify.php">ยืนยันการสมัคร</a><br> -->
		<div align="center">  
		  <div class="form-group row" style="margin-left:370px">
		    <label for="username" class="col-sm-2 form-control-label">Username</label>
		    <div class="col-sm-4">
		      <input type="user" class="form-control" name='user' id="username" onChange="checkUsername()" onBlur="checkUsername()" required> 
		    </div>
		  </div>
		  <div class="form-group row" style="margin-left:370px">
		    <label for="password" class="col-sm-2 form-control-label">Password</label>
		    <div class="col-sm-4">
		      <input type="password" class="form-control" name='pwd' id="password" required>
		    </div>
		  </div>

		  <div id="radioshow" class="panel-collapse collapse">
		    
		        <label>
		          <input type="radio" name="radiocheck" id="radiocheck" value="seller"> Login as seller
		        </label>

			</div>
			
		  <button type="submit" class="btn btn-primary" style="margin-right:540px">Log in</button>
		</div>
    </form>

    </div>
</body>
 <?php include('footer.php'); ?> <!-- FOOT -->
 <?php  
 	} //ถ้าเข้าสู่ระบบไปแล้ว ดูจาก session แล้วแสดงชื่อ user ออกมา     
 	else {
?>
	<fieldset><legend>Log in </legend>
    	<?php echo $_SESSION['user'];echo $_SESSION['seller']; ?><br><br>
    	<a href="destroy.php">Log out</a> or <a href="TheKeeper.php">Home page</a>
	</fieldset>
<?php
	}
?>
