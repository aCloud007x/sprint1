<!-- ///// start collapse link ///// -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

<!-- ///// end collapse link ///// -->

<!-- ///// script for approve and decline button ///// -->
	<script>
		$(function() {
			$('button.approve').click(function() {
				var id = $(this).attr('data-id');
				$('#item_id').val(id);
				$('#action').val('approve');
				// window.alert($('form [name=action]').val());
				$('#myform').submit();
			});
			
			$('button.decline').click(function() {
				var id = $(this).attr('data-id');
				$('#item_id').val(id);
				$('#action').val('decline');
				// window.alert($('form [name=action]').val());
				$('#myform').submit();
			});
		});

	</script>
<!-- ///// END script for approve and decline button ///// -->

<body background="bg2.gif">

<?php include('header-menu.php'); header('Content-type: text/html; charset=UTF-8'); 



?>

<br>
<div class="container" style="padding-top: 45px;background-color: #FAFAFA;">
	<h3 align="center"><img src="mSeller.png" style="height:35px; width:35px; margin-right:15px;"><b>Manage Seller</b></h3>
	<hr>

	<?php  
	include('connect.php');
	///// IF click Button Form will submit here /////

if($_POST) {
	$item_id = $_POST['item_id'];
	if($_POST['action'] == "approve") {
		$sql = "UPDATE `seller` SET `Sstatus`='approve' WHERE `Sid`=$item_id";
		mysqli_query($connect, $sql)or die(mysqli_error($connect));
		// echo "Approve Done";
	}
	else if($_POST['action'] == "decline") {
		$sql = "UPDATE `seller` SET `Sstatus`='decline' WHERE `Sid`=$item_id";
		mysqli_query($connect, $sql)or die(mysqli_error($connect));
		// echo "Decline Done";
	}
	// echo"<meta http-equiv='refresh' content='0;url=manageSeller.php'>";
}

///// End if click Button Form will submit here /////

	mysqli_set_charset($connect, 'utf8');
		$objConnect = $connect;
			//$objDB = mysqli_select_db("sec01_group3");
			$strSQL = "SELECT * FROM member,seller WHERE member.Mid=seller.Mid AND Sstatus='waiting' ORDER BY Musername ASC";
			$objQuery = mysqli_query($objConnect,$strSQL) or die ("Error Query [".$strSQL."]");
		?>
			<center>
				<table class="table table-hover" style="width:50%;">
    				<tr class="info" align="center" style="font-size: large;">
            			<td><b>Username</b></td>
            			<td><b>Approve</b></td>
			        </tr>
					<?php
			            $sql="SELECT * FROM member,seller WHERE member.Mid=seller.Mid AND Sstatus='waiting' ORDER BY Musername ASC"; // คำสั่ง sql อ่านข้อมูลจากตาราง tbl_name
			            $result=mysqli_query($objConnect,$sql); // คิวรี่คำสั่ง sql
			            $num=mysqli_num_rows($result); // ตรวจสอบจำนวน record ที่คิวรี่ออกมา
			            if($num>0){ // ถ้าจำนวน record มากกว่า 0
			                $count=1; // กำหนดตัวแปร count เพื่อระบุตำแหน่ง record
			                while($objResult = mysqli_fetch_array($objQuery)){ // วน loop ดึงข้อมูลออกมา ทีละ record
			        ?>
			        <tr align="center" class="customTR" bgcolor="white">
			            <td style="text-align:left; padding-left:50px;">
			            	<a data-toggle="collapse" href="#Musername<?php echo $count; ?>"
			            	style="text-decoration: none;color:black;">
			            		<div class="panel-heading">
									<h4 class="panel-title">
									<?php echo $objResult["Musername"];?>
									</h4>
								</div>
							</a>
							<div id="Musername<?php echo $count; ?>" class="panel-collapse collapse">
								<div class="panel-body">
									<p><b style="margin-left:10px; margin-right:24px;">Name:</b> <?php echo $objResult["Mname"];?></p>
									<p><b style="margin-left:10px; margin-right:43px;">Tel:</b> <?php echo $objResult["Mtel"];?></p>
									<p><b style="margin-left:10px;">Address:</b> <?php echo $objResult["Maddress"];?></p>
									<p><b style="margin-left:10px; margin-right:31px;">State:</b> <?php echo $objResult["Mstate"];?></p>
									<p><b style="margin-left:10px; margin-right:41px;">City:</b> <?php echo $objResult["Mcity"];?></p>
									<p><b style="margin-left:10px;">Postal Code:</b> <?php echo $objResult["Mpostalcode"];?></p>
									<br>
									<p><b style="margin-left:10px;">Reason:</b> <?php echo $objResult["Sreason"];?></p>
									<br>

									
									<button class='approve btn btn-primary' data-id='<?php echo $objResult["Sid"]; ?>' style="margin-left:10px;">Approve</button>
									<button class='decline btn btn-danger' data-id='<?php echo $objResult["Sid"]; ?>'>Decline</button>
								</div>
							</div>			            	
						</td>
			            <td><button class='approve btn btn-primary' data-id='<?php echo $objResult["Sid"]; ?>' style="margin-left:10px;">Approve</button>

			            </td>

			            <!-- ///// For Post data-id and action ///// -->
			            		<form id="myform" method="post">
					            	<input type="hidden" id='action' name="action">
									<input type="hidden" id='item_id' name="item_id">
								</form>
						<!-- ///// END For Post data-id and action ///// -->
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
	mysqli_set_charset($connect, 'utf8');
		$objConnect = $connect;
			//$objDB = mysqli_select_db("sec01_group3");
			$strSQL = "SELECT * FROM member,seller WHERE member.Mid=seller.Mid AND Sstatus='approve' ORDER BY Musername ASC";
			$objQuery = mysqli_query($objConnect,$strSQL) or die ("Error Query [".$strSQL."]");
		?>
			<center>
				<table class="table table-hover" style="width:50%;">
    				<tr class="info" align="center" style="font-size: large;">
            			<td><b>Username</b></td>
			        </tr>
					<?php
			            $sql="SELECT * FROM member,seller WHERE member.Mid=seller.Mid AND Sstatus='approve' ORDER BY Musername ASC"; // คำสั่ง sql อ่านข้อมูลจากตาราง tbl_name
			            $result=mysqli_query($objConnect,$sql); // คิวรี่คำสั่ง sql
			            $num=mysqli_num_rows($result); // ตรวจสอบจำนวน record ที่คิวรี่ออกมา
			            if($num>0){ // ถ้าจำนวน record มากกว่า 0
			                $count=1; // กำหนดตัวแปร count เพื่อระบุตำแหน่ง record
			                while($objResult = mysqli_fetch_array($objQuery)){ // วน loop ดึงข้อมูลออกมา ทีละ record
			        ?>
			        <tr align="center" class="customTR" bgcolor="white">
			            <td style="text-align:left; padding-left:50px;">
			            	<a data-toggle="collapse" href="#MusernameApp<?php echo $count; ?>"
			            	style="text-decoration: none;color:black;">
			            		<div class="panel-heading">
									<h4 class="panel-title">
									<?php echo $objResult["Musername"];?>
									</h4>
								</div>
							</a>
							<div id="MusernameApp<?php echo $count; ?>" class="panel-collapse collapse">
								<div class="panel-body">
									<p><b style="margin-left:10px; margin-right:24px;">Name:</b> <?php echo $objResult["Mname"];?></p>
									<p><b style="margin-left:10px; margin-right:43px;">Tel:</b> <?php echo $objResult["Mtel"];?></p>
									<p><b style="margin-left:10px;">Address:</b> <?php echo $objResult["Maddress"];?></p>
									<p><b style="margin-left:10px; margin-right:31px;">State:</b> <?php echo $objResult["Mstate"];?></p>
									<p><b style="margin-left:10px; margin-right:41px;">City:</b> <?php echo $objResult["Mcity"];?></p>
									<p><b style="margin-left:10px;">Postal Code:</b> <?php echo $objResult["Mpostalcode"];?></p>
									<br>
									<p><b style="margin-left:10px;">Reason:</b> <?php echo $objResult["Sreason"];?></p>
									<br>

								</div>
							</div>			            	
						</td>
			            <!-- <td><button type=''  class='btn btn-primary' style="margin-left:10px;">Approve</button></td> -->
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