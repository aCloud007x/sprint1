<?php
include "connect.php";
if($_POST['username']){
	$username = $_POST['username'];
	// $password = $_POST["password"];
	// $memberName = $_POST["memberName"];
	// $address = $_POST["address"];
	// $amphor = $_POST["amphor"];
	// $province = $_POST["province"];
	// $zipcode = $_POST["zipcode"];
	// $mobile = $_POST["mobile"];
	// $email = $_POST["email"];
	// $sql = "INSERT INTO addtest VALUES ('$username', '$password',
	// '$memberName', '$address', '$amphor', '$province', '$zipcode',
	// '$mobile', '$email')";
	$sql="INSERT INTO addtest VALUES ('$username')";
	$r = mysqli_query($connect,$sql);
	if(!$r){ echo "ไม่สามารถบันทึกข้อมูลได้";}
	else{ echo "บันทึกข้อมูลแล้ว";}
}
mysqli_close($connect);

?>
