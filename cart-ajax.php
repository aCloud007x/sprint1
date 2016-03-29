<?php 
	session_start();
	$sess_ID = $_GET['id'];
	$sess_qty = $_GET['newQty'];
	$sess_name = $_GET['newid'];

	$_SESSION["qty"][$sess_ID] = $sess_qty; //เปลี่ยน quantity ของสินค้านั้นใหม่ ตามที่กดเปลี่ยน

	$arr = array();
	$total=0;
	
	for($i=0;$i<=(int)$_SESSION["dataid"];$i++) // LOOP ทุกสินค้า
	{
		if((int)$sess_name != 0 && !empty($_SESSION["pname"][$i]))
		{
			$arr[$i]=array('ID'=>$i,'PID' => $_SESSION["pid"][$i],'Name' => $_SESSION["pname"][$i],
			 'QTY' => $_SESSION["qty"][$i] , 'price'=>$_SESSION["price"][$i]);
		}
	}

	foreach ($arr as $key => $row) {
   				$volume[$key]  = $row['Name'];
    			$edition[$key] = $row['QTY'];
	}
	 array_multisort($edition, SORT_DESC, $volume, SORT_ASC, $arr);
	    printf("<table cellspacing='1' class='table table-hover text-center'>
			<tr class='info text-center'>
				<th class='text-center'>Items</th>
				<th class='text-center'>Quantity</th>
				<th class='text-center'>Price</th>
				<th class='text-center'></th>
			</tr>");  //อะไรที่อยู่ใต้ result ให้ print ทำออกมาให้หมด

	  foreach ($arr as $item){
		printf("<tr>");
		printf("<td>%s</td>",$item['Name']);
		printf("<td><input type='number' onchange='newCalQty(%s,%s,this.value)' min='0' value='%s' >",$item['ID'],$item['PID'],$item['QTY']);
		printf(" &nbsp;&nbsp; <a href='cart-delete.php?dataline=%s'><img src='bin.png' class='' width='20px'></td>",$item['ID']);
		printf("<td>%s</td>",number_format((float)$item['price'],2));
		printf("<td class='text-left'>Baht</td>");
		printf("</tr> ");
		//printf("<tr>");
		if($sess_qty==0){ $total=0 ;}
		else{
		$total = $total+($item['price']*$item['QTY']);}


	}
		printf("</table><br>");
		printf("<div class='pull-right text-right'>
			<p><b>Grand Total</b> %s <b>Baht</b><br><small style='color:red;'>*Shipping cost not included</small></p>
			<p></p>
			<a href='#'><button>CHECK OUT</button></a>",$total);
?>