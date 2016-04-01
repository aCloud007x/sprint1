<?php session_start();
 include "connect.php";
 
if(isset($_GET['username']))
{
	$mail = $_GET['username'];
	$sql = "SELECT Musername FROM member WHERE Musername='$mail'";
	$objQuery = mysqli_query($connect,$sql);
	sleep(1);
	if(mysqli_num_rows($objQuery))
	{
		echo 'denied';
	}
	else{
		echo 'okay';
	}

	// if (!in_array( $username, $row) {
	// 	echo 'okay';
	// } else {
	// 	echo 'denied';
	// }

exit();
}
?>
