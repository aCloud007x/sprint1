<?php 	

include('header-menu.php');  //<!-- HEAD -->
include 'connect.php';
		if(!isset($_SESSION["dataid"])){
			header("Location:Thekeeper.php");
			exit();
		} ?> 
<script type="text/javascript">
	function newCalQty(id,newid,newQty){
		var id = id;
		var newQty = newQty;
		var newid = newid;
		if(nQty>0){
		$.get('cart-ajax.php',{id:id,newid:newid,newQty:newQty},
			function(data,status)
			{
				$('#result').html(data);
				 alert(data);
			}
			);
		}


	}

</script>
<body> <!-- Content BODY HERE -->
<div class="container" style="padding-top: 45px;">

	<br>
	<section id="result">
		<table cellspacing="1" class="table center">
			<tr class="" >
				<th class="">Items</th>
				<th class="">Quantity</th>
				<th class=""></th>
				<th class="">Price</th>
				<th class=""></th>
			</tr>
		<?php 
		$total = 0; $grandTotal = 0; $cartTemp = array(); //ทำตัวแปรเป็นตัวเก็บ array

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
				<td><?php printf("<input type='number' onchange='newCalQty(%s,%s,this.value)' min='1' value='%s' >",$item['ID'],$item['PID'],$item['QTY']); ?></td>
				<td><?php printf("<a href='deleteCart.php?dataline=%s '><img src='' class=''>",$item['ID']);?> </td>
				<td><?php printf(number_format($item['price'],2)); ?></td>
				<td>Baht</td>
			</tr> 
		<?php 
		}
		?>
		<!-- END ID #RESULT -> LOOP IN CART ARRAY -->

		</table><br>

		<!-- START Total HTML -->
		<div class="pull-right">
			<p>Grand Total <?php printf($grandTotal); ?> Baht</p>
			<p><small>*Shipping not included</small></p>
			<a href="#"><p>CHECK OUT</p></a>
		</div>
		<!-- END Total HTML -->

	</section>
	<br>
	<?php mysqli_close($connect); ?>

</div>
</body> <!-- END BODY -->
<?php include('footer.php'); ?> <!-- FOOT -->