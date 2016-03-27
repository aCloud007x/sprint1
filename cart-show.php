<?php
include('header-menu.php'); ?> <!-- HEAD -->
<head>
<style>
	@import "global-order.css";
	
	table {
		margin: 10px auto;
		border-collapse: collapse;
	}
	tr:nth-of-type(odd) {
		background: #CFC;
	}
	tr:nth-of-type(even) {
		background: #ddd;
	}
	tr:last-child td {
		border-top: solid 1px white;
		background: powderblue !important;
		padding: 5px;
		font-weight: bold;
		text-align: center;	
	}
	tr:last-child td:first-child {
		
	}
	tr:last-child td:nth-child(2) {
		
	}
	th {
		background: green;
		color: yellow;
		padding: 5px;
	}
	td {
		padding: 3px;
	}
	th:not(:last-child), td:not(:last-child) {
		border-right: solid 1px white;
	}
	
	td:nth-child(1) {
		width: 230px;
	}
	td:nth-child(2) {
		width: 130px;
	}
	td:nth-child(3) {
		width: 70px;
		text-align: center;
	}		
	td:nth-child(4) {
		width: 70px;
		text-align: center;
	}
	td:nth-child(5), td[colspan]+td {
		width: 80px;
		text-align: center;
	}
	td:nth-child(6) {
		width: 120px;
		text-align: center;
	}
	[name=quantity] {
		width: 50px;
		text-align: center;
	}
	form {
		display: none;
	}
	caption {
		text-align: left;
		padding: 3px;
	}
	table+span {
		font-style: italic;
		display: block;
		width: 760px;
		text-align: right;
		color: brown;
		font-size: 12px;
	}
	.out-of-stock {
		color:red;
		text-align:center;
		display: block;
	}
</style>
<script src="js/js/jquery-2.1.1.min.js"> </script>
<script>
$(function() {
	$('button.save-change').click(function() {
		var id = $(this).attr('data-id');
		$('form [name=item_id]').val(id);
		var tr = $(this).parent().parent();  //หาแถวของปุ่มที่ถูกคลิก
		var q = tr.find('input[name=quantity]').val();
		if(!$.isNumeric(q)) {
			alert('จำนวนต้องเป็นเลขจำนวนเต็มเท่านั้น');
			return false;
		}
		$('form [name=action]').val('save-change');
		$('form [name=quantity]').val(q);
		$('form').submit();
	});
	
	$('button.delete').click(function() {
		if(!confirm('ยืนยันการลบรายการนี้ออกจากรถเข็น')) {
			return false;
		}
		var id = $(this).attr('data-id');
		$('form [name=action]').val('delete');
		$('form [name=item_id]').val(id);
		$('form').submit();
	});
	
	$('button#next').click(function() {
		$('form').attr('action', "order-cust.php");
		$('form').submit();
	});

	$('button#index').click(function() {
		location.href = "TheKeeper.php";
	});
	
});
</script>
</head>
<body> <!-- Content BODY HERE -->
<div class="container" style="padding-top: 45px;">

<?php
include "connect.php";
if($_POST) {
	$item_id = $_POST['item_id'];
	if($_POST['action'] == "save-change") {

		$quan = intval($_POST['quantity']);
		$sql = "UPDATE cart SET quantity = '$quan' WHERE item_id = '$item_id'";
		mysqli_query($connect, $sql);
	}
	else if($_POST['action'] == "delete") {
		$sql = "DELETE FROM cart WHERE item_id = '$item_id'";
		mysqli_query($connect, $sql);	
	}
}

$sid = session_id();
$sql = "SELECT cart.*, product.Pname, product.Pprice FROM cart
			LEFT JOIN product
			ON cart.Pid = product.Pid
			WHERE session_id = '$sid'";
$result = mysqli_query($connect, $sql);
$num_items =  mysqli_num_rows($result);
if($num_items == 0) {
	echo '<h2 class="warning">ไม่มีสินค้าในรถเข็น</h2>';
}
else {
?>
	<table border="1">
	<caption>พบสินค้าในรถเข็นทั้งหมด: <?php echo $num_items; ?> รายการ </caption>
	<tr><th>ชื่อสินค้า</th><th>จำนวน</th><th>ราคา</th><th>รวม</th><th>แก้ไข</th></tr>
	<?php
	$grand_total = 0;
	while($cart = mysqli_fetch_array($result)) {
		//แทนที่ ","ด้วย <br> เพื่อแยกแต่ละคุณลักษณะไว้คนละบรรทัด
		//$attr = preg_replace("/,/", "<br>", $cart['attribute']);
		$Pprice = number_format($cart['Pprice']);
		$sub_total = number_format($cart['quantity'] * $cart['Pprice']);
		echo "<tr>";
		echo "<td>{$cart['Pname']}</td>";
		//echo "<td>$attr</td>";
		echo '<td><input type="number" name="quantity" min="0" value="'. $cart['quantity'] . '"></td>';
		echo "<td>$Pprice</td>";
		echo "<td>$sub_total</td>";
		echo '<td>
						<button class="save-change" data-id="' . $cart['item_id'] . '">บันทึก</button>
						<button class="delete" data-id="' . $cart['item_id'] . '">ลบ</button>
				</td>';
		$grand_total += $cart['quantity'] * $cart['Pprice'];
	}

	//เก็บผลรวมไว้ในเซสชั่นเพื่อนำไปแสดงผลในขั้นตอนสุดท้ายที่เพจ order-done.php
	$_SESSION['amount'] = number_format($grand_total);  	
	?>
	<tr><td colspan="3">รวมทั้งหมด</td><td><?php echo number_format($grand_total); ?></td><td>&nbsp;</td></tr>
	</table>
	<span>หากมีการแก้ไขจำนวนสินค้ารายการใด ให้คลิกปุ่ม "บันทึก" ที่รายการนั้นด้วยทุกครั้ง</span> <br>
	<form method="post">
		<input type="hidden" name="action">
		<input type="hidden" name="item_id">
	    <input type="hidden" name="quantity">
	</form>
<?php 
}		//end if (ถ้ามีสินค้าในรถเข็น)
?>
<?php mysqli_close($connect); ?>
</div>
</body> <!-- END BODY -->
<?php include('footer.php'); ?> <!-- FOOT -->