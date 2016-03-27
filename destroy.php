<?php
session_start();
unset($_SESSION["user"]);
session_destroy();

//ลบคุกกี้การเข้าสู่ระบบ
$expire = time() - 3600;
setcookie('user', '', $expire);
setcookie('pwd', '', $expire);

//ให้ใช้เฮดเดอร์ refresh เพื่อหน่วงเวลาให้
//PHP สามารถส่งข้อมูลกลับมายังเบราเซอร์ได้
header("refresh: 2; url=TheKeeper.php");
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<style>
	body {
		cursor: wait;
		text-align: center;
	}
	h3.green {
		color: #060;
	}
</style>
</head>

<body>
	<h3 class="green">Destroy Cookie+Session <br> Redirecting to home page in 3 second.. <br> or <a href="TheKeeper.php">Click Here</a> </h3>
</body>
</html>