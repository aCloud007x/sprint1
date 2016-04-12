<?php include('header-menu.php'); ?> 


<!-- begin zoom function -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<link href="css/jquery.fs.zoomer.css" rel="stylesheet" type="text/css" media="all">
<script src="js/jquery.fs.zoomer.js"></script>
<script src="ie/jquery.fs.zoetrope.min.js"></script>


<script type="text/javascript"></script>


	
<style>
.demo .container .col-lg-6 .zoomer_wrapper {
	border: 1px solid #ddd;
	border-radius: 3px;
	height: 500px;
	margin: 10px 0;
	overflow: hidden;
	width: 100%;
}

.demo .zoomer.dark_zoomer {
	background: #333 url(bg-snow.jpg) repeat center;
}

.demo .zoomer.dark_zoomer img {
	box-shadow: 0 0 5px rgba(0, 0, 0, 0.5);
}

div .nohover>a:hover{ text-decoration-line: none; }

div.blue {
	background-color: #EFFBFB;
}
body {
	background-image: url('bg2.gif');
}

tr .customTR :hover { 
   background: red; 
}
td a { 
   display: block; 
   
}

</style>
	
  
    
<body> <!-- Content BODY HERE -->

  <?php  
		include('connect.php');
		$objConnect = $connect;
		//$objDB = mysql_select_db("sec01_group3");
		$strSQL = "SELECT * FROM member WHERE Mname = '".$_SESSION['user']."'";
		$objQuery = mysqli_query($objConnect,$strSQL) or die ("Error Query [".$strSQL."]");
		$objResult = mysqli_fetch_array($objQuery)
	 ?>
	<div class="container" style="padding-top: 45px;background-color: #FAFAFA;">
    <div class="col-sm-offset-3 col-sm-9">
	<h3>PROFILE </h3>
    </div>
    <div class="col-sm-offset-3 col-sm-9">
    <p>Name : <?php echo $objResult["Mname"];?></p>
    <p>Tel : <?php echo $objResult["Mtel"];?></p>
    <p>Address : <?php echo $objResult["Maddress"];?></p>
    <p>State : <?php echo $objResult["Mstate"]; ?></p>
    
    <?php  ?>
    <br/>
    <br/>
   
    <a href="formseller.php"><p>register to the seller</p></a>
    </div>


	</div>
</body> <!-- END BODY -->
 <!-- zoom function -->
<?php include('footer.php'); ?> <!-- FOOT -->
