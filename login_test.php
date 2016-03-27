<?php
session_start();
if(!isset($_SERVER['PHP_AUTH_USER'])){
    header('WWW-Authenticate: Basic realm="My Realm"');
    header('HTTP/1.0 401 Unauthorized');
 	exit("Please enter login and password");
}
else {
 	$user = $_SERVER['PHP_AUTH_USER'];
	$pw = $_SERVER['PHP_AUTH_PW'];

	if(($user != "admin") && ($pw != "1234")) {
		exit("Login:admin<br>Password:1234"); 
	}
	else {
		$_SESSION['user'] = "Administrator";
		header("location: TheKeeper.php");
		exit;
	}
}
?> 
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Login</title>
</head>

<body>
</body>
</html>