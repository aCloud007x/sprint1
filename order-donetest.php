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
$card_num = $_POST["card"];
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


$sql = "INSERT INTO orders VALUES('', '$Mid', '$paid_by', '$card_num', '$paid', '$deliver', 
'$ship_name','$ship_address','$ship_state','$ship_city','$ship_postalcode', 
'$bill_name', '$bill_address', '$bill_state', '$bill_city', '$bill_postalcode', NOW())";
$r = mysqli_query($connect, $sql)or die(mysqli_error($connect));
$order_id = mysqli_insert_id($connect);

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
		?>
      <tr>
        <td><?php printf($item['Name']); ?></td>
        <td><?php printf("x%s",$item['QTY']); ?>
        <td><?php printf("%s",number_format($item['price'],2)); ?></td>
        <td class="text-left">Baht</td>
      </tr>
      <?php 
		}
		?>
      <!-- END ID #RESULT -> LOOP IN CART ARRAY -->
      
    </table>
    <br>
    
    <!-- START Total HTML -->
    <div id='totalsection' class='pull-right text-right'>
      <p>Total <?php echo $grandTotal; ?> Baht<br>
        <small style="color:red;">+ Shipping cost 150 Baht included</small><br>
        <b>Grand Total</b> <?php echo $grandTotal+150; ?> <b>Baht</b>
        </p>
      <p></p>
      <form method='post' action='order-form.php'>
        <input type='hidden' name='action'>
        </input>
        <button class='buttonc' id='next' style='vertical-align:middle'><span>Check out </span></button>
      </form>
    </div>
    <!-- END Total HTML --> 
    
  </section>
  <br>
  <?php mysqli_close($connect); 

		?>
</div>
</body>
<!-- END BODY -->
<?php include('footer.php'); ?>
<!-- FOOT -->