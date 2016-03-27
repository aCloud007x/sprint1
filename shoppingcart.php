<?php 
include "connect.php";

// เพิ่มสินค้าลงตะกร้า
if($_REQUEST['action']=="add" && $_REQUEST['productId']>0){
	$pid = $_REQUEST['productId'];
	addtocart($pid,1); // เพิ่มสินค้าตามรหัสสินค้า จำนวน 1 ชิ้น 

// ลบสินค้าออกจากตะกร้า
} else if($_REQUEST['action']=="delete" && $_REQUEST['pid']>0){
	removefromcart($_REQUEST['pid']);  // ลบตามรหัสสินค้า

// ลบสินค้าทุกอย่างออกจากตะกร้า
} else if($_REQUEST['action']=="clear"){
	unset($_SESSION['cart']);

// ปรับปรุงจำนวนสินค้าแต่ละชิ้นในตะกร้า
} else if($_REQUEST['action']=="update"){
	updatecart();
}
//////////////////////////////////////////////////////////////////
// ฟังก์ชันเพิ่มสินค้าลงตะกร้า
function addtocart($pid,$q){
	// ถ้ามีสินค้าในตะกร้อยแล้ว $_SESSION['cart'] จะเป็น array 
	if(is_array($_SESSION['cart'])){
		if(product_exists($pid)) return;
		$max = count($_SESSION['cart']);  // ดึงเอา index ของ array ช่องสุดท้ายออกมา
		$_SESSION['cart'][$max]['productid'] = $pid; // นำรหัสสินค้าไปเก็บ
		$_SESSION['cart'][$max]['qty'] = $q; // นำจำนวนสินค้าไปเก็บ
		
	// ถ้ายังไม่มีสินค้าใดๆเลยในตะกร้า จะสร้าาง array ใหม่
	} else {
		$_SESSION['cart'] = array();
		$_SESSION['cart'][0]['productid'] = $pid; // นำรหัสสินค้าไปเก็บ
		$_SESSION['cart'][0]['qty'] = $q; // นำจำนวนสินค้าไปเก็บ
	}
} 

// ฟังก์ชันลบสินค้าจากตะกร้า
function removefromcart($pid){
	$pid = intval($pid); // แปลงรหัสสินค้าเป็น integer เพื่อใช้ในการเปรียบเทียบ
	$max = count($_SESSION['cart']);  // ดึงจำนวนสินค้าในตะกร้าออกมา
	for($i=0;$i<$max;$i++){ // วนลูปค้นหาตามรหัสสินค้า
		if($pid==$_SESSION['cart'][$i]['productid']){ // ถ้ารหัสสินค้าตรงกัน
			unset($_SESSION['cart'][$i]); // ลบสินค้านั้นออก
			break;
		}
	}
	$_SESSION['cart']=array_values($_SESSION['cart']); // สร้างเป็น array ใหม่
}

// ฟังก์ชันปรัยปรุงจำนวนสินค้า
function updatecart() {
	$max=count($_SESSION['cart']); // ดึงจำนวนสินค้าในตะกร้าออกมา
	for($i=0;$i<$max;$i++){ // วนลูปอ่านสินค้าแต่ละชิ้นในตะกร้า
		$pid = $_SESSION['cart'][$i]['productid']; // อ่านรหัสสินค้า
		$_SESSION['cart'][$i]['qty'] = $_REQUEST['product'.$pid]; // ดึงจำนวนสินค้าจากฟอร์มมาเก็บลง session ทับค่าเดิม
	}
}

// ฟังก์ชันขอชื่อสินค้า
function get_product_name($pid){
	$result = mysql_query("select p_name from product where p_id = $pid");
	$row = mysql_fetch_array($result);
	return $row['p_name'];
}

// ฟังก์ชันขอราคาสินค้า
function get_price($pid){
	$result=mysql_query("select p_price from product where p_id = $pid");
	$row=mysql_fetch_array($result);
	return $row['p_price'];
}

// ฟังก์ชันคำนวณราคาสินค้าทั้งหมดในตะกร้า
function get_order_total(){
	$max=count($_SESSION['cart']);
	$sum=0;
	for($i=0;$i<$max;$i++){
		$pid=$_SESSION['cart'][$i]['productid'];
		$q=$_SESSION['cart'][$i]['qty'];
		$price=get_price($pid);
		$sum+=$price*$q;
	}
	return $sum;
}

// ฟังก์ชันตรวจสอบว่ามีสินค้านั้นในตะกร้าแล้วหรือยัง ถ้ามีแล้วจะส่งค่าเป็น 1 ถ้ายังไม่มีส่งค่าเป็น 0
function product_exists($pid){
	$pid=intval($pid);
	$max=count($_SESSION['cart']);
	$flag=0;
	for($i=0;$i<$max;$i++){
		if($pid==$_SESSION['cart'][$i]['productid']){
			$flag=1;
			break;
		}
	}
	return $flag;
}
?>


<html>
<head>
<meta charset="utf-8">
<title>Shopping Cart - CS Cosmetic</title>
<link href="stylesheet/main.css" rel="stylesheet" type="text/css">
<script>
function del(pid){
	if(confirm('คุณต้องการลบสินค้าใช่หรือไม่ ?')){
		document.form1.pid.value=pid; // กำหนดรหัสสินค้าที่ต้องการลบ
		document.form1.action.value='delete';  // กำหนดให้ทำการลบสินค้าในตะกร้า
		document.form1.submit(); // สั่งให้เริ่ม submit form
	}
}
function clear_cart(){
	if(confirm('คุณต้องการลบสินค้าทั้งหมดใช่หรือไม่ ?')){
		document.form1.action.value='clear';
		document.form1.submit();
	}
}
function update_cart(){
	document.form1.action.value='update';
	document.form1.submit();
}
</script>
</head>
<!-- body //-->
<body>
<?php include "head.php";?>
<!-- SHOW CART PRODUCT -->
<form name="form1" method="post" action="shoppingcart.php">
<input type="hidden" name="action" value="">
<input type="hidden" name="pid" value="">

<div class="table-responsive">
    	<table class="table table-striped table-hover">
    	<?
			if(is_array($_SESSION['cart'])){  // ถ้ามีการสร้าง array ของตะกร้าสินค้าแล้ว
            	echo '<tr class="danger"><td><strong>ID</td><td><strong>Name</td><td><strong>Price</td><td><strong>Qty</td><td><strong>Amount</td><td><strong>Options</td></strong></tr>';
				$max=count($_SESSION['cart']);
				for($i=0;$i<$max;$i++){  // วนลูปดึงสินค้าแต่ชิ้นออกมาแสดง
					$pid=$_SESSION['cart'][$i]['productid'];
					$q=$_SESSION['cart'][$i]['qty'];
					$pname=get_product_name($pid);
					if($q==0) continue;
			?>
            		<tr><td><?=$i+1?></td><td><?=$pname?></td>
                    <td> <?=get_price($pid)?></td>
                    <td><input type="text" name="product<?=$pid?>" value="<?=$q?>" maxlength="3" size="2"></td>                    
                    <td> <?=get_price($pid)*$q?></td>
                    <td><input type="button"  class="btn-default" value="Remove" onclick="del(<?=$pid?>)"></td></tr>
            <?					
				}
			?>
				<tr><td><b>Total: <?=get_order_total()?> Baht</b></td><td colspan="5" align="right"><div class="btn-group">
				

</div><a href="product.php" class="alert-link"><div class="btn-group"><button type="button" class="btn btn-default">เลือกสินค้าอื่นๆ</button></div></a>

					<input type="button" class="btn-danger" value="Clear Cart" onclick="clear_cart()">
					<input type="button"  class="btn-default" value="Update" onclick="update_cart()">
					<input type="button" class="btn-default" value="สั่งซื้อสินค้า" onclick="window.location='checkOrder.php'">
				</td></tr>
			<?
            }
			else{
				echo "<tr><td><div class=\"alert alert-danger\"><strong>ขออภัย~</strong> ยังไม่มีสินค้าใดๆในตะกร้าสินค้า! <a href=\"product.php\" class=\"alert-link\">เลือกสินค้า</a></div></td>";
			}
		?>
        </table></div>
</form>
<?php include "foot.php";?>
</body>
</html> 