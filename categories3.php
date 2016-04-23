<!--<?php 
    $page=$_GET["Prate"];
?>

<?php  
	include('connect.php');
		$objConnect = $connect;
		//$objDB = mysql_select_db("sec01_group3");
		$strSQL = "SELECT * FROM product WHERE Prate='".$page."' ";
		$objQuery = mysqli_query($objConnect,$strSQL) or die ("Error Query [".$strSQL."]");
	?>-->

<body  background="bg2.gif"> <!-- Content BODY HERE -->
<?php include('header-menu.php'); ?> 





	<br>

<div class="container" style="padding-top: 45px;background-color: #FAFAFA;">

<h1 align="center"><img src="banknote.png" style="height:35px; width:35px; margin-right:15px;">แบบที่ 3</h1>

<hr>



	<?php  
	include('connect.php');

		$objConnect = $connect;
		//$objDB = mysqli_select_db("sec01_group3");
		$strSQL = "SELECT Pphoto, Pname, Pprice, Pid FROM product, category WHERE product.cNoType=category.cNoType AND product.cNoType='3' ORDER BY `Pdate` DESC";
		$objQuery = mysqli_query($objConnect, $strSQL) or die ("Error Query [".$strSQL."]");
	?>
	



<section class="proSec">

			<div class="container">
			<div class="row marketing">
				<?php
			        $sql="SELECT Pphoto, Pname, Pprice, Pid FROM product, category WHERE product.cNoType=category.cNoType ORDER BY `Pdate` DESC"; // คำสั่ง sql อ่านข้อมูลจากตาราง tbl_name
			        $result=mysqli_query($objConnect, $sql); // คิวรี่คำสั่ง sql
			        $num=mysqli_num_rows($result); // ตรวจสอบจำนวน record ที่คิวรี่ออกมา
			        if($num>0){ // ถ้าจำนวน record มากกว่า 0
			            $count=1; // กำหนดตัวแปร count เพื่อระบุตำแหน่ง record
			            while($objResult = mysqli_fetch_array($objQuery)){ // วน loop ดึงข้อมูลออกมา ทีละ record
			        ?>
			        
			        <div class="col-lg-2">
			        	<center><img src= <?php echo $objResult["Pphoto"];?>></center>
			        	<br>
			            <p class="ppro"><span class="spanp22">Name:</span> <?php echo $objResult["Pname"];?></p>
						<p class="ppro"><span class="spanp22">Price:</span> <?php echo $objResult["Pprice"];?></p>
						<?php echo "<center><a href='detail.php?Pid=".$objResult["Pid"]."'><button type='submit'  class='btn btn-primary'>View detail</button></a></center>" ?>
						<!-- <center><a href="detail.php?Pid=''"><button type="submit"  class="btn btn-primary">View detail</button></a></center> -->
			       	</div>
			        <?php
			            $count+=1; // เพิ่ม count ทีละ 1
			            	}
			            }
			        ?>
			    	</div>
				</div>
			</div>
				
		</section>


</div>

<?php include('footer.php'); ?>


</body>