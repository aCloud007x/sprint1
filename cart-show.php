<?php 	
ob_start();
include('header-menu.php');  //<!-- HEAD -->
include 'connect.php';
		?> 
<head>
<script type="text/javascript">
	function newCalQty(id,newid,newQty){
		//alert('hi function');
		//alert('id:' + id + 'newid:' + newid + 'newQty:' + newQty)
		var aid = id;
		var anewQty = newQty;
		var anewid = newid;
		if(newQty>0){
		$.get('cart-ajax.php',{id:aid,newid:anewid,newQty:anewQty},
			function(data)
			{
				$('#result').html(data);
				 //alert(data);
			}
			);
		}


	}

</script>
<style>
input[type="number"] {
   width:50px;
}
</style>
</head>
<body> <!-- Content BODY HERE -->
<div class="container" style="padding-top: 45px;">
		<?php 
		if(isset($_SESSION['user'])){
			if(!isset($_SESSION["dataid"])){
			// 	echo"<meta http-equiv='refresh' content='3;url=TheKeeper.php'>";
				header("Location:Thekeeper.php");
				exit();
		} 
		?>
	
	<section id="result">
		<table cellspacing="1" class="table table-hover text-center">
			<tr class="info text-center" >
				<th class="text-center">Items</th>
				<th class="text-center">Quantity</th>
				<th class="text-center">Price</th>
				<th class="text-center"></th>
			</tr>
		<?php 
		$total = 0; 
		$grandTotal = 0; 
		$cartTemp = array(); //ทำตัวแปรเป็นตัวเก็บ array

		for($i=0;$i<=(int)$_SESSION["dataid"];$i++) //ลูปเอาทุกตัวในเซสชั่น
		{
			$PID = $_SESSION["pid"][$i];
			$qty = $_SESSION["qty"][$i];
			$pname = "" ;
			if($PID != 0)
			{
				$sql="SELECT * FROM product where Pid=$PID"; //หาข้อมูลของสินค้าจาก pid ที่ส่งมา
				$result = mysqli_query($connect,$sql);
				$row = mysqli_fetch_assoc($result);
				$pname = $row["Pname"];
				$pprice = $row["Pprice"];
				$total =  $qty* $pprice;
				$grandTotal = $grandTotal + $total;
				$_SESSION["price"][$i]=$pprice;
				$_SESSION["pname"][$i]=$pname;
				$cartTemp[$i]=array('ID'=>$i,'PID'=>$PID,'Name' => $pname, 'QTY' => $qty , 'price'=>$pprice);
			}
		}
		// START SORTING
		foreach ($cartTemp as $key => $row) //วนลูปอาเรย์แต่ละตัว เอามา sort
		{
			$volume[$key]  = $row['Name'];
			$edition[$key] = $row['QTY'];
		}
		if(!empty($volume) && !empty($edition))
		{
			array_multisort($edition, SORT_DESC, $volume, SORT_ASC, $cartTemp);
		}
		// END SORINTG

		 //<!-- START ID #RESULT -> LOOP IN CART ARRAY -->
		foreach ($cartTemp as $item)
		{
		?>
			<tr>
				<td><?php printf($item['Name']); ?></td>
				<td><?php printf("<input type='number' onchange='newCalQty(%s,%s,this.value)' min='0' value='%s' >",$item['ID'],$item['PID'],$item['QTY']); ?> &nbsp;&nbsp;	<?php printf("<a href='cart-delete.php?dataline=%s'><img src='bin.png' class='' width='20px'>",$item['ID']);?></td>
				
				<td><?php printf(number_format($item['price'],2)); ?></td>
				<td class="text-left">Baht</td>
			</tr> 
		<?php 
		}
		?>
		<!-- END ID #RESULT -> LOOP IN CART ARRAY -->

		</table><br>

		<!-- START Total HTML -->
		<div class='pull-right text-right'>
			<p><b>Grand Total</b> <?php echo $grandTotal; ?> <b>Baht</b><br><small style="color:red;">*Shipping cost not included</small></p>
			<p></p>
			<a href='#'><button>CHECK OUT</button></a>
		</div>
		<!-- END Total HTML -->

	</section>
	<br>
	<?php mysqli_close($connect); ?>


		<?php 
		}else{ echo '<div class="navbar navbar-danger" align="center" style="font-size:35px;">Please <a href="login.php">Login..</a></div>';}
		?>
</div>
</body> <!-- END BODY -->
<?php include('footer.php'); ?> <!-- FOOT -->