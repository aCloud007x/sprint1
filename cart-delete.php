
<?php
	ob_start();
	session_start();

	$dataline = $_GET["dataline"];
	$_SESSION["pid"][$dataline] = 0;
	$_SESSION["qty"][$dataline] = "";
	$_SESSION["pname"][$dataline] = "";
	$_SESSION["price"][$dataline] = "";

	header("location:cart-show.php");
?>