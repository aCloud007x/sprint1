<?php session_start();
 include "connect.php";
 
if(isset($_GET['username']))
{
	$mail = $_GET['username'];
	// $sql = "SELECT Musername FROM member WHERE Musername='$mail'";
	$sql = "SELECT Musername FROM member,seller WHERE Musername='$mail' AND member.Mid=seller.Mid";
	$objQuery = mysqli_query($connect,$sql);
	sleep(0);
	if(mysqli_num_rows($objQuery))
	{
		echo 'okay';  //ถ้ามีข้อมูลในนั้นจริง แสดงว่ายูสเซอร์นั้นคือ seller
	}
	else{
		echo 'denied';
	}

	// if (!in_array( $username, $row) {
	// 	echo 'okay';
	// } else {
	// 	echo 'denied';
	// }

exit();
}
?>
