<?php 
    $page=$_GET["Pid"];
?>
<!DOCTYPE html>
<html>
<head>
    <?php include('head.php'); ?>
</head>
<body class="b">



	<?php include('header.php'); ?>
	<?php include('menu.php'); ?>



	<?php  
		$objConnect = mysqli_connect("10.199.66.227","Sec01_Group3","957fb3","sec01_group3") or die("Error Connect to Database");
		//$objDB = mysql_select_db("sec01_group3");
		$strSQL = "SELECT * FROM product WHERE Pid='".$page."'";
		$objQuery = mysqli_query($objConnect,$strSQL) or die ("Error Query [".$strSQL."]");
	?>
	<br><br>
	<article>
		<br><br>
		<?php while($objResult = mysqli_fetch_array($objQuery)) { ?>
			<div class="container">
		    	<div class="row marketing">
	        		<div class="col-lg-7">
	        			<img src= <?php echo $objResult["Pphoto"];?> >
	        		</div>
	        		<div class="col-lg-5">
	        			<br><br>
						<p class="textOne"><span>Name:</span> <?php echo $objResult["Pname"];?></p><hr>
						<p><span>Code:</span> <?php echo $objResult["Pid"];?></p>
						<p><span>Status:</span> <?php echo $objResult["Pstatus"];?></p>
						<p><span>Description:</span> <?php echo $objResult["Pdetail"];?></p>
						<p><span>Size/Dimension:</span> <?php echo $objResult["Psize"];?></p>
						<br><br>
						<button type="button" class="btn btn-primary">Add to Cart</button>
					</div>
				</div>
			</div>
		<?php } ?>


		
		<?php  
			$objConnect = mysqli_connect("10.199.66.227","Sec01_Group3","957fb3","sec01_group3") or die("Error Connect to Database");
			//$objDB = mysqli_select_db("sec01_group3");
			$strSQL = "SELECT Mname, Pprice, Mlink FROM member, product, sell WHERE sell.Pid = product.Pid AND sell.Mid= member.Mid AND sell.Pid = '".$page."' GROUP BY Mname, Mlink, Pprice";
			$objQuery = mysqli_query($objConnect,$strSQL) or die ("Error Query [".$strSQL."]");
		?>
			<center>
				<table>
    				<tr>
            			<th>Seller</th>
           				<th>Price</th>
            			<th>Link</th>
			        </tr>
					<?php
			            $sql="SELECT Mname, Pprice, Mlink FROM member, product, sell WHERE sell.Pid = product.Pid AND sell.Mid= member.Mid AND sell.Pid = '".$page."' GROUP BY Mname, Mlink, Pprice"; // คำสั่ง sql อ่านข้อมูลจากตาราง tbl_name
			            $result=mysqli_query($objConnect,$sql); // คิวรี่คำสั่ง sql
			            $num=mysqli_num_rows($result); // ตรวจสอบจำนวน record ที่คิวรี่ออกมา
			            if($num>0){ // ถ้าจำนวน record มากกว่า 0
			                $count=1; // กำหนดตัวแปร count เพื่อระบุตำแหน่ง record
			                while($objResult = mysqli_fetch_array($objQuery)){ // วน loop ดึงข้อมูลออกมา ทีละ record
			        ?>
			        <tr>
			            <td><?php echo $objResult["Mname"];?></td>
						<td><?php echo $objResult["Pprice"];?></td>
						<td><a href="#" ><?php echo $objResult["Mlink"];?></a></td>
			        </tr>
			        <?php
			            $count+=1; // เพิ่ม count ทีละ 1
			            	}
			            }
			        ?>
			    </table>
			</center>
		<br><br>
	</article>
	<br><br>



	<?php include('footer.php'); ?>




</body>
</html>