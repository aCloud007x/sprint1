<?php
session_start();
if(!$_POST) {
	exit;
}

$id = $_POST['orderid'];
?>

<?php include('header-menu.php'); ?> <!-- HEAD -->
<body> <!-- Content BODY HERE -->
<div class="container" style="padding-top: 45px;">

<div class="jumbotron">
  <h1>Thank you!</h1>
  <p> for your order. We hope you will enjoy your new item(s). 
  <p>Your Order ID is: 
  	<?php echo $id; 
  	session_start();
	unset($_SESSION["dataid"]);
	unset($_SESSION["dataid"]);
	unset($_SESSION["pid"]);
	unset($_SESSION["qty"]);
	unset($_SESSION["price"]);
	unset($_SESSION["pname"]);

	?></p>
  <p><a class="btn btn-primary btn-lg" href="TheKeeper.php" role="button">Home</a></p>
</div>

</div>
</body> <!-- END BODY -->
<?php include('footer.php'); ?> <!-- FOOT -->