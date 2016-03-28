<?
session_start();
if(isset($_GET['dataline'])){
$Line = $_GET["dataline"];
$_SESSION["pid"][$Line] = 0;
$_SESSION["qty"][$Line] = "";
$_SESSION["price"][$Line] = "";
$_SESSION["pname"][$Line] = "";
header("Location:cart-show.php");
}else { echo "NOTHING... "}

?>