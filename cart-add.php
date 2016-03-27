<?php
sleep(1);
session_start();

if(!isset($_POST['pid'])) {
	exit;
}
include "connect.php";
$pid = $_POST['pid'];
$quantity = intval($_POST['quantity']);

// $sql = "SELECT quantity FROM products WHERE pid = '$pid'";
// $r = mysqli_query($link, $sql);
// $pro = mysqli_fetch_array($r);
// if($pro['quantity'] < $quantity) {
// 	echo "จำนวนสินค้าในสต๊อกมีไม่เพียงพอกับจำนวนที่ท่านระบุ";
// 	mysqli_close($link);
// 	exit;
// }

// $attrs = array();  //คุณลักษณะถูกส่งขึ้นมาแบบอาร์เรย์
// for($i=0; $i < count($_POST['prop_name']); $i++) { //เชื่อมชื่อและค่าคุณลักษณะด้วย ":"
// 	$attrs[$i] = $_POST['prop_name'][$i] . ": " . $_POST['prop_val'][$i];
// }
// $att = implode(", ", $attrs); //เชื่อมแต่ละคุณลักษณะด้วย "," เช่น สี:ฟ้า,ขนาด:M
$sid = session_id();

$sql = "REPLACE INTO cart VALUES(
			'', '$pid', '$quantity', NOW(), '$sid')";
@mysqli_query($connect, $sql);

//ลบรายการที่เพิ่มลงในรถเข็นมาเกิน 1 วัน (คาดว่าคงไม่ซื้อแล้วหละ)
$sql = "DELETE FROM cart WHERE DATEDIFF(NOW(), date_shop) > 1";
@mysqli_query($connect, $sql);

mysqli_close($connect);

?>
<script>location.href = "cart-show.php";</script>