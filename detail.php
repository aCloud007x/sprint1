<?php include('header-menu.php'); ?> 


<!-- begin zoom function -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<link href="css/jquery.fs.zoomer.css" rel="stylesheet" type="text/css" media="all">
<script src="js/jquery.fs.zoomer.js"></script>
<script src="ie/jquery.fs.zoetrope.min.js"></script>


<script type="text/javascript"></script>
	
<style>
.demo .zoomer_wrapper {
	border: 1px solid #ddd;
	border-radius: 3px;
	height: 500px;
	margin: 10px 0;
	overflow: hidden;
	width: 100%;
}

.demo .zoomer.dark_zoomer {
	background: #333 url(img/zoomer-bg-dark.png) repeat center;
}

.demo .zoomer.dark_zoomer img {
	box-shadow: 0 0 5px rgba(0, 0, 0, 0.5);
}
</style>
	<script>
		$(document).ready(function() {
			$(".demo .zoomer_basic").zoomer();

			$(".demo .zoomer_custom").zoomer({
				controls : {
					zoomIn : ".zoomer_custom_zoom_in",
					zoomOut : ".zoomer_custom_zoom_out"
				},
				customClass : "dark_zoomer",
				increment : 0.03,
				interval : 0.1,
				marginMax : 50
			});

			$(window).on("resize", function(e) {
				$(".demo .zoomer_wrapper").zoomer("resize");
			});

			$(window).one("pronto.load", function() {
				$(".demo .zoomer_basic").zoomer("destroy");
				$(".demo .zoomer_custom").zoomer("destroy");
				$(".demo .zoomer_tiled").zoomer("destroy");
				$(".demo .load_zoomer_tiled").off("click");
			});
		});
	</script>
<!-- end zoom function -->
<!-- HEAD -->
<body> <!-- Content BODY HERE -->
<div class="container" style="padding-top: 50px;background-color: #FAFAFA;"> <!-- 45px from top & BG color = light gray -->

<?php 
    $page=$_GET["Pid"];
?>
<div class="gridlock demo"> <!-- zoom function -->

	<?php  
	include('connect.php');
		$objConnect = $connect;
		//$objDB = mysql_select_db("sec01_group3");
		$strSQL = "SELECT * FROM product WHERE Pid='".$page."'";
		$objQuery = mysqli_query($objConnect,$strSQL) or die ("Error Query [".$strSQL."]");
	?>

	<article>

		<?php while($objResult = mysqli_fetch_array($objQuery)) { ?>
			<div class="container">

	        		<div class="col-lg-6" align="center">
	        			<div class="zoomer_wrapper zoomer_basic"> <!-- zoom function -->
	        				<img src= <?php echo $objResult["Pphoto"];?>  >
	        			</div> <!-- zoom function -->
	        		</div>
	        		<div class="col-lg-6">
	        			<br><br>
						<h2><span><b></b></span> <?php echo $objResult["Pname"];?></h2><hr>
						<h4><span><b>Code:</b></span> <?php echo $objResult["Pid"];?></h4>
						<h4><span><b>Status:</b></span> <?php echo $objResult["Pstatus"];?></h4>
						<h4><span><b>Description:</b></span> <?php echo $objResult["Pdetail"];?></h4>
						<h4><span><b>Size/Dimension:</b></span> <?php echo $objResult["Psize"];?></h4>
						<br>
						<button type="button" class="btn btn-primary btn-sm pull-right"><span class="glyphicon glyphicon-shopping-cart"> </span> Add to Cart </button>
					</div>

			</div>
		<?php } ?>

<br><br>
		
		<?php  
		$objConnect = $connect;
			//$objDB = mysqli_select_db("sec01_group3");
			$strSQL = "SELECT Mname, Pprice, Mlink FROM member, product, sell WHERE sell.Pid = product.Pid AND sell.Mid= member.Mid AND sell.Pid = '".$page."' GROUP BY Mname, Mlink, Pprice";
			$objQuery = mysqli_query($objConnect,$strSQL) or die ("Error Query [".$strSQL."]");
		?>
			
				<table class="table table-hover" align="center">
    				<tr class="info" align="center" style="font-size: large;">
            			<td>Seller</td>
           				<td>Price</td>
            			<td>Link</td>
			        </tr>
					<?php
			            $sql="SELECT Mname, Pprice, Mlink FROM member, product, sell WHERE sell.Pid = product.Pid AND sell.Mid= member.Mid AND sell.Pid = '".$page."' GROUP BY Mname, Mlink, Pprice"; // คำสั่ง sql อ่านข้อมูลจากตาราง tbl_name
			            $result=mysqli_query($objConnect,$sql); // คิวรี่คำสั่ง sql
			            $num=mysqli_num_rows($result); // ตรวจสอบจำนวน record ที่คิวรี่ออกมา
			            if($num>0){ // ถ้าจำนวน record มากกว่า 0
			                $count=1; // กำหนดตัวแปร count เพื่อระบุตำแหน่ง record
			                while($objResult = mysqli_fetch_array($objQuery)){ // วน loop ดึงข้อมูลออกมา ทีละ record
			        ?>
			        <tr align="center">
			            <td ><?php echo $objResult["Mname"];?></td>
						<td><?php echo $objResult["Pprice"];?></td>
						<td><a href="#" ><?php echo $objResult["Mlink"];?></a></td>
			        </tr>
			        <?php
			            $count+=1; // เพิ่ม count ทีละ 1
			            	}
			            }
			        ?>
			    </table>

	</article>



</div>
</body> <!-- END BODY -->
<?php include('footer.php'); ?> <!-- FOOT -->
</div> <!-- zoom function -->