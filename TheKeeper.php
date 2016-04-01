<?php include('header-menu.php'); ?> <!-- HEAD -->
<!--Scripts-->
 <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<!-- 			<script>
			if (typeof jQuery != 'undefined') {  
				    // jQuery is loaded => print the version
				    alert(jQuery.fn.jquery);
				}
 			</script> -->

<body background="bg2.gif"> <!-- Content BODY HERE -->
	<div class="container" style="padding-top: 50px;background-color: #FAFAFA;">


			<br>
			<center><img src="highLight.gif" width="350" class="img-responsive"></center>
			<br><br>
			<?php include('slide_show.php'); ?> 

		<br>
	</div>
	<br>
	<div class="container" style="padding-top: 30px;background-color: #FAFAFA;">
		
			<center><img src="popular.gif" width="359" class="img-responsive"></center>
			<br>
			<?php include('product.php'); ?> 
	</div>

	
</body> <!-- END BODY -->
<?php include('footer.php'); ?> <!-- FOOT -->