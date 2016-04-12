<?php //begin loop php each item
include "connect.php"; 

	///// IF click Button Form will submit here /////
echo $_POST['item_id'];
echo $_POST['action'];

if($_POST) {
	$item_id = $_POST['item_id'];
	if($_POST['action'] == "approve") {
		$sql = "UPDATE `seller` SET `Sstatus`='approve' WHERE `Sid`=$item_id";
		mysqli_query($connect, $sql)or die(mysqli_error($connect));
		echo "Approve Done";
	}
	else if($_POST['action'] == "decline") {
		$sql = "UPDATE `seller` SET `Sstatus`='decline' WHERE `Sid`=$item_id";
		mysqli_query($connect, $sql)or die(mysqli_error($connect));
		echo "Decline Done";
	}
	echo"<meta http-equiv='refresh' content='0;url=manageSeller.php'>";
}
///// End if click Button Form will submit here /////

?>