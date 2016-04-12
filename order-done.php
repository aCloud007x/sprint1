<?php
session_start(); 
ob_start();
include('connect.php');
if(!$_POST) {
	exit;
}

include('header-menu.php'); ?>
<!-- HEAD -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <style>
  .buttonc {
  display: inline-block;
  border-radius: 4px;
  background-color: #1E90FF;
  border: none;
  color: #FFFFFF;
  text-align: center;
  font-size: 18px;
  padding: 20px;
  width: 200px;
  transition: all 0.5s;
  cursor: pointer;

}

.buttonc span {
  cursor: pointer;
  display: inline-block;
  position: relative;
  transition: 0.5s;
}

.buttonc span:after {
  content: ' >>';
  position: absolute;
  opacity: 0;
  top: 0;
  
  transition: 0.5s;
}

.buttonc:hover span {
  padding-right: 40px;
}

.buttonc:hover span:after {
  opacity: 1;
  right: 0;
}
  </style>
<body>
<!-- Content BODY -->
<div class="container" style="padding-top: 45px;">
  <?php 

$name = $_SESSION['user'];
// echo $name;
$sqlname = "SELECT * FROM member WHERE Mname='$name'";
$objQueryname = mysqli_query($connect,$sqlname);
$res= mysqli_fetch_array($objQueryname);
$Mid = $res['Mid'];

	// $cmd = "SELECT order_id FROM orders ORDER BY order_id DESC LIMIT 1";
	// $objQuery = mysqli_query($connect,$cmd);
	// $row = mysqli_fetch_assoc($objQuery);
	// $last = intval($row["order_id"]);
	// $last =  $last + 1;
	// $orderid = $last;
$paid_by = $_POST["payment"];
if($_POST["card"]){ $card_num = $_POST["card"]; $new_card_num = substr($card_num, -4); }	else{ $card_num = '';$new_card_num=''; }
$paid = 'no';
$deliver = 'no';


$ship_name = $_POST["sname"];
$ship_address = $_POST["saddress"];
$ship_state = $_POST["sstate"];
$ship_city = $_POST["scity"];
$ship_postalcode = $_POST["spostalcode"];

$bill_name = $_POST["bname"];
$bill_address = $_POST["baddress"];
$bill_state = $_POST["bstate"];
$bill_city = $_POST["bcity"];
$bill_postalcode = $_POST["bpostalcode"];


$sql = "INSERT INTO orders(`order_id`, `Mid`, `paid_by`, `card_num`, `paid`, `delivery`, `ship_name`, `ship_address`, `ship_state`, `ship_city`, `ship_postalcode`, `bill_name`, `bill_address`, `bill_state`, `bill_city`, `bill_postal`, `time`) VALUES(0, '$Mid', '$paid_by', '$card_num', '$paid', '$deliver', 
'$ship_name','$ship_address','$ship_state','$ship_city','$ship_postalcode', 
'$bill_name', '$bill_address', '$bill_state', '$bill_city', '$bill_postalcode', NOW())";
$r = mysqli_query($connect, $sql)or die(mysqli_error($connect));
$order_id = mysqli_insert_id($connect);

		?>
		<center>
  <section id="result">
    <table cellspacing="1" border='0' class="table-responsive text-center" width="75%" style="white-space: nowrap;">
      <tr class="info text-center">
      <th class='text-center' colspan="5" style="background-color: #bddbea;"><br>Ordered List<br><br></th>
<!--         <th class="text-center">Items</th>
        <th class="text-center">Quantity</th>
        <th class="text-center">Price</th>
        <th class="text-center"></th> -->
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
				$sql="SELECT * FROM product where Pid='$PID' "; //หาข้อมูลของสินค้าจาก pid ที่ส่งมา
				$result = mysqli_query($connect, $sql)or die(mysqli_error($connect));
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
      $pid = $item['PID'];
      $itemqty = $item['QTY'];
      $sql = "INSERT INTO orders_details(`item_id`, `order_id`, `Pid`, `quantity`) VALUES(0, '$order_id', '$pid', '$itemqty')";
      $r = mysqli_query($connect, $sql)or die(mysqli_error($connect));

		?>
      <tr>
        <td class="text-left" colspan="2"><?php printf($item['Name']); ?>	&nbsp;</td>
        <td class="text-left"><?php printf("x%s",$item['QTY']); ?>	&nbsp;</td>
        <td class="text-center"><?php printf("%s",number_format($item['price'],2)); ?></td>
        <td class="text-right">Baht</td>
      </tr>

      <?php 
		}
		?>
      <!-- END ID #RESULT -> LOOP IN CART ARRAY -->
    <tr>
	    <td colspan="5">    <br>
	    <div id='totalsection' class='pull-right text-right'>
	      	Total <?php echo $grandTotal; ?> Baht<br>
	        <small style="color:red;">shipping cost 150 Baht included</small><br>
	        <p>Grand Total <?php echo $grandTotal+150; ?> Baht</p>
	        	    <br><br>
	    </div>

        </td>
  	</tr>
  	<tr> <!-- HEAD SHiping - Billing -->
  	     <td class='text-center' colspan="2" style="background-color: #bddbea;"><p class="form-control-static">&nbsp;<b>Shipping Address</b></p></td>
  	     <td style="background-color: #bddbea;">	&nbsp;</td>
  	     <td class='text-center' colspan="2"><p class="form-control-static" style="background-color: #bddbea;"><b>Billing Address</b>&nbsp;</p></td>
  	</tr> <!-- END HEAD -->

  	<tr> <!-- name -->
  	     <td class='text-left' colspan="2"><p class="form-control-static">Name: <?php echo $ship_name; ?></p></td>

  	     <td>	&nbsp;</td>
  	     <td class='text-left' colspan="2"><p class="form-control-static">Name: <?php echo $bill_name; ?></p></td>
	     
  	</tr> <!-- END name -->

  	  	<tr> <!-- Address -->
  	     <td class='text-left' colspan="2"><p class="form-control-static">Address: <?php echo $ship_address; ?></p></td>
  	     <td>	&nbsp;</td>
  	     <td class='text-left' colspan="2"><p class="form-control-static">Address: <?php echo $bill_address; ?></p></td>
  	</tr> <!-- END Address -->

  	  	<tr> <!-- State -->
  	     <td class='text-left' colspan="2"><p class="form-control-static">State/province: <?php echo $ship_state; ?></p></td>
  	     <td>	&nbsp;</td>
  	     <td class='text-left' colspan="2"><p class="form-control-static">State/province: <?php echo $bill_state; ?></p></td>
  	</tr> <!-- END State -->

  	  	<tr> <!-- City -->
  	     <td class='text-left' colspan="2"><p class="form-control-static">City: <?php echo $ship_city; ?></p></td>
  	     <td>	&nbsp;</td>
  	     <td class='text-left' colspan="2"><p class="form-control-static">City: <?php echo $bill_city; ?></p></td>
  	</tr> <!-- END City -->

  	  	<tr> <!-- PostalCode -->
  	     <td class='text-left' colspan="2"><p class="form-control-static">Postal Code: <?php echo $ship_postalcode; ?></p></td>
  	     <td>	&nbsp;</td>
  	     <td class='text-left' colspan="2"><p class="form-control-static">Postal Code: <?php echo $bill_postalcode; ?></p></td>
  	</tr> <!-- END PostalCode -->

  	<tr> <!-- LOWEST -->
  	     <td class='text-center' colspan="5" style="background-color: #bddbea;"><p class="form-control-static"><b>Payment Method</b></p></td>
  	</tr> <!-- END LOWEST -->

  	<tr> <!-- LOWEST -->
  	     <td class='text-center' colspan="5" ><p class="form-control-static"><?php echo $paid_by; if($paid_by!='Paypal'){echo ': xxxx-xxxx-xxxx-'.$new_card_num; } ?></p>
  	     <p class="form-control-static"><form method='post' action='order-id.php'>
		        <input type='hidden' name='orderid' value='<?php echo $order_id; ?>'>
		        <button class='buttonc pull-right' id='next' style='vertical-align:middle'><span>Confirm</span></button>
			</form></p>
			</td>


  	</tr> <!-- END LOWEST -->
    </table>
    <br>
    


    

    <!-- END Total HTML --> 
    
  </section>
  </center>
  <br>
  <?php mysqli_close($connect); 

		?>
</div>
</body>
<!-- END BODY -->
<?php include('footer.php'); ?>
<!-- FOOT -->