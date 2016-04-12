<!-- ///// start collapse link ///// -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<!-- ///// end collapse link ///// -->


<body background="bg2.gif">

<?php include('header-menu.php'); ?>

<br>
<div class="container" style="padding-top: 45px;background-color: #FAFAFA;">
	<h3 align="center"><img src="mSeller.png" style="height:35px; width:35px; margin-right:15px;"><b>Manage Seller</b></h3>
	<hr>

	<?php  
	include('connect.php');
		$objConnect = $connect;
			//$objDB = mysqli_select_db("sec01_group3");
			$strSQL = "SELECT Musername, Mname, Mtel, Maddress, Mstate, Mcity, Mpostalcode, Manswer FROM member WHERE Musername LIKE '%@%' ORDER BY Musername ASC";
			$objQuery = mysqli_query($objConnect,$strSQL) or die ("Error Query [".$strSQL."]");
		?>
			<center>
				<table class="table table-hover" style="width:50%;">
    				<tr class="info" align="center" style="font-size: large;">
            			<td><b>Username</b></td>
            			<td><b>Approve</b></td>
			        </tr>
					<?php
			            $sql="SELECT Musername, Mname, Mtel, Maddress, Mstate, Mcity, Mpostalcode, Manswer FROM member WHERE Musername LIKE '%@%'  ORDER BY Musername ASC"; // คำสั่ง sql อ่านข้อมูลจากตาราง tbl_name
			            $result=mysqli_query($objConnect,$sql); // คิวรี่คำสั่ง sql
			            $num=mysqli_num_rows($result); // ตรวจสอบจำนวน record ที่คิวรี่ออกมา
			            if($num>0){ // ถ้าจำนวน record มากกว่า 0
			                $count=1; // กำหนดตัวแปร count เพื่อระบุตำแหน่ง record
			                while($objResult = mysqli_fetch_array($objQuery)){ // วน loop ดึงข้อมูลออกมา ทีละ record
			        ?>
			        <tr align="center" class="customTR">
			            <td style="text-align:left; padding-left:50px;">
			            	<div class="panel-heading">
								<h4 class="panel-title">
									<a data-toggle="collapse" href="#Musername"><?php echo $objResult["Musername"];?></a>
								</h4>
							</div>
							<div id="Musername" class="panel-collapse collapse">
								<div class="panel-body">
									<p><b style="margin-left:10px; margin-right:24px;">Name:</b> <?php echo $objResult["Mname"];?></p>
									<p><b style="margin-left:10px; margin-right:43px;">Tel:</b> <?php echo $objResult["Mtel"];?></p>
									<p><b style="margin-left:10px;">Address:</b> <?php echo $objResult["Maddress"];?></p>
									<p><b style="margin-left:10px; margin-right:31px;">State:</b> <?php echo $objResult["Mstate"];?></p>
									<p><b style="margin-left:10px; margin-right:41px;">City:</b> <?php echo $objResult["Mcity"];?></p>
									<p><b style="margin-left:10px;">Postal Code:</b> <?php echo $objResult["Mpostalcode"];?></p>
									<br>
									<p><b style="margin-left:10px;">Reason:</b> <?php echo $objResult["Manswer"];?></p>
									<br>
									<button type='submit'  class='btn btn-primary' style="margin-left:10px;">Approve</button>
									<button type='submit'  class='btn btn-danger'>Decline</button>
								</div>
							</div>			            	
						</td>
			            <td><input type="checkbox"></td>
			        </tr>
			        <?php
			            $count+=1; // เพิ่ม count ทีละ 1
			            	}
			            }
			        ?>
			    </table>
			</center>
			<hr>
</div>

<br><br>

<div class="container" style="padding-top: 45px;background-color: #FAFAFA;">
	<h3 align="center"><img src="seller.png" style="height:35px; width:35px; margin-right:15px;"><b>Seller</b></h3>
	<hr>
	


	<?php  
	include('connect.php');
		$objConnect = $connect;
			//$objDB = mysqli_select_db("sec01_group3");
			$strSQL = "SELECT Musername FROM member WHERE Musername LIKE '%@%'  ORDER BY Musername ASC";
			$objQuery = mysqli_query($objConnect,$strSQL) or die ("Error Query [".$strSQL."]");
		?>
			<center>
				<table class="table table-hover" style="width:50%;">
    				<tr class="info" align="center" style="font-size: large;">
            			<td><b>Username</b></td>
			        </tr>
					<?php
			            $sql="SELECT Musername FROM member ORDER BY Musername ASC"; // คำสั่ง sql อ่านข้อมูลจากตาราง tbl_name
			            $result=mysqli_query($objConnect,$sql); // คิวรี่คำสั่ง sql
			            $num=mysqli_num_rows($result); // ตรวจสอบจำนวน record ที่คิวรี่ออกมา
			            if($num>0){ // ถ้าจำนวน record มากกว่า 0
			                $count=1; // กำหนดตัวแปร count เพื่อระบุตำแหน่ง record
			                while($objResult = mysqli_fetch_array($objQuery)){ // วน loop ดึงข้อมูลออกมา ทีละ record
			        ?>
			        <tr align="center" class="customTR">

			            <td style="text-align:left; padding-left:180px;"><?php echo $objResult["Musername"];?></td>
			        </tr>
			        <?php
			            $count+=1; // เพิ่ม count ทีละ 1
			            	}
			            }
			        ?>
			    </table>
			</center>
			<hr>
</div>


<?php include('footer.php'); ?>

</body>