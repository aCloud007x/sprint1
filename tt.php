<?php //begin loop php each item
include "connect.php"; 

$sql="SELECT * FROM product,product_time GROUP BY Product_Id ORDER BY `Product_Id`";
$result = mysqli_query($conn,$sql) or die("MySQL error: " . mysqli_error($conn) . "<hr>\nQuery: $sql");  //useful error handle
while($rowz= mysqli_fetch_assoc($result)) 
{ 
	$pid=$rowz["Product_Id"];
	$pname=$rowz["Product_Name"];
	// $ppro_date=$rowz["Pro_Date"];
	// $ppro_time=$rowz["Pro_Time"];
	$pprice=$rowz["Product_Price"];
	$pstate=$rowz["Product_State"];
	$psize=$rowz["Product_Size"];
	$pdesc=$rowz["Product_Desc"];	
	echo $pid,$pname;

}
	echo"<meta http-equiv='refresh' content='3;url=Edit.php'>"; //redirect in 3 sec
?>