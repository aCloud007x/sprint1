<?php 
// SET SESSION FOR CART

 $pid = $_GET["pid"];
 sleep(1);
 session_start();

 if(!isset($_SESSION["dataid"])){
	$_SESSION["dataid"] = 0;
	$_SESSION["pid"][0] = $pid;
	$_SESSION["qty"][0] = 1;
	$_SESSION["price"][0] = 0;
	$_SESSION["pname"][0] ="";

	header("Location:cart-show.php"); 	
 }
 else { //ถ้ามี session อยู่แล้ว > เพิ่มอาร์เรย์เข้าไป
 	$max = array_search($pid, $_SESSION["pid"]);
 	if((string)$max != ""){
 		$_SESSION["qty"][$max] = $_SESSION["qty"][$max]+1;
 	}
 	else{
 		$_SESSION["dataid"] = $_SESSION["dataid"]+1;
 		$newMax = $_SESSION["dataid"];
 		$_SESSION["pid"][$newMax] = $pid;
 		$_SESSION["qty"][$newMax] = 1;

 	}
 	header("Location:cart-show.php");
 }

?>