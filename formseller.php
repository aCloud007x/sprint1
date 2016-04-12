<?php include('header-menu.php'); ?> 


<!-- begin zoom function -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<link href="css/jquery.fs.zoomer.css" rel="stylesheet" type="text/css" media="all">
<script src="js/jquery.fs.zoomer.js"></script>
<script src="ie/jquery.fs.zoetrope.min.js"></script>


<script type="text/javascript"></script>

 <!-- Bootstrap core CSS -->
 <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
 <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
 <link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet">
 <link href="theme.css" rel="stylesheet">
 <link href="css/validator.css" rel="stylesheet">
 <script src="js/jquery-1.9.1.min.js"></script>
 <script src="bootstrap/js/bootstrap.min.js"></script>
 <script src="js/jquery.form.validator.min.js"></script>
 <script src="js/security.js"></script>
 <script src="js/file.js"></script>


	
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
	
  
 
  <?php  
		include('connect.php');
		$objConnect = $connect;
		//$objDB = mysql_select_db("sec01_group3");
		$strSQL = "SELECT * FROM member WHERE Mname = '".$_SESSION['user']."'";
		$objQuery = mysqli_query($objConnect,$strSQL) or die ("Error Query [".$strSQL."]");
		$objResult = mysqli_fetch_array($objQuery)
	 ?>
<body> <!-- Content BODY HERE -->
  	<div class="container" style="padding-top: 45px;background-color: #FAFAFA;">
    <div class="col-sm-offset-2 col-sm-10" ><h3>seller register</h3></div>
    <br />
    <br />
    <br />
    <br />	
    <form class="form-horizontal" action="seller_register.php" method="post">
  	
 		 <div class="form-group">
    		<label for="exampleInputEmail2" class="col-sm-3 control-label">Name</label>
        
         	 <div class="col-sm-5">  
   			 <input type="text" class="form-control "  id="name" name="name" placeholder="Bear Waldorf" data-validation="required"/>
 			 </div>
          </div>
           
           	<div class="form-group">
    			<label class="col-sm-3 control-label">Username</label>
   				 <div class="col-sm-5">
    		 		 <p class="form-control-static" ><?php echo $objResult["Mname"];?></p>
   			 	</div>
 			 </div>
             
            	<div class="form-group"> 
                <label class="col-sm-3 control-label">Reason</label>
   				 <div class="col-sm-5">
            	<textarea class="form-control" row="5" data-validation="required" id="reason" name="reason"></textarea>
                 </div>
                 </div>
 
 
 
 				<div class="form-group">
					 <div class="col-sm-offset-3 col-sm-9">
 						<div class="checkbox">
 							<label>
 								<input type="checkbox" data-validation="required"  data-validation-error-msg="Must accept condition"> Allowed the company to deduct 10 percent of  your income
							 </label>
 						</div>
					</div>
				 </div>
                 <div class="form-group">
					 <div class="col-sm-offset-3 col-sm-9">
 						<div class="checkbox">
 							<label>
 								<input type="checkbox" data-validation="required"  data-validation-error-msg="Must accept condition"> Allowed to deduct tax at source .
							 </label>
 						</div>
					</div>
				 </div>
                 <div class="form-group">
					 <div class="col-sm-offset-3 col-sm-9">
 						<div class="checkbox">
 							<label>
 								<input type="checkbox" data-validation="required"  data-validation-error-msg="Must accept condition">
										Allowed the company to verify your account.
							 </label>
 						</div>
					</div>
				 </div>
                 <div class="form-group">
					 <div class="col-sm-offset-3 col-sm-9">
 						<div class="checkbox">
 							<label>
 								<input type="checkbox" data-validation="required"  data-validation-error-msg="Must accept condition"> 
										Allow the company to revoke the sale.
							 </label>
 						</div>
					</div>
				 </div>
                 
             
            
            <div class="form-group">
			 <div class="col-sm-offset-7 col-sm-5">
 				<button type="submit" class="btn btn-primary">Confirm</button>
			 </div>
		 </div>
         
	</form>
    </div>
    
    
    
    <script>
 $.validate({
 modules: 'security, file',
 onModulesLoaded: function () {
 $('input[name="pass_confirmation"]').displayPasswordStrength();
 }
 });
 </script>
</body>
<!-- zoom function -->
<?php include('footer.php'); ?> <!-- FOOT -->

