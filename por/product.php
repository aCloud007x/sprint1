<div class="secpro">
	<img src="img/new.png" class="picNew"><h1 class="h1pro">NEW ARRIVAL</h1><br>
	<center><img src="img/slide.jpg" class="newPro"></center>
</div>
<br>
<hr>

<img src="img/star.png" class="picPop"><h2>POPULAR</h2><br>
		
	<?php  
		$objConnect = mysqli_connect("10.199.66.227","Sec01_Group3","957fb3","sec01_group3") or die("Error Connect to Database");
		//$objDB = mysqli_select_db("sec01_group3");
		$strSQL = "SELECT Pphoto, Pname, Pprice, Pid FROM product WHERE Pid='P0001' OR Pid='P0002' OR Pid='P0003' OR Pid='P0004' OR Pid='P0005'";
		$objQuery = mysqli_query($objConnect, $strSQL) or die ("Error Query [".$strSQL."]");
	?>
	
		<section class="proSec">
			<div class="container">
			<div class="row marketing">
				<?php
			        $sql="SELECT Pphoto, Pname, Pprice, Pid FROM product"; // คำสั่ง sql อ่านข้อมูลจากตาราง tbl_name
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
		<br><br>
	