<? ob_start() ?><?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
 <title>The Keeper</title>
 
<?php include('head.php'); ?>



<style type="text/css">
  header.bg {
    background-image: url('bg.gif');
  }

  #login_bar{
	display: inline-block;
	float: right;
	background-color: white;
	border: 2px #81BEF7;
	border-style: dashed;
	height: auto;
} 
#login_signup > li{
  padding-left: 10px;
  padding-right: 10px;
  display: block;
    float:left;    
    line-height:25px; /* ตั้งตามขนาดของรูปนะ*/
      color:grey;

}

#login_signup > li > a:link {
  color:#5e7cf7;
  font-weight: bold;
  background-color:transparent; text-decoration:none;
}
#login_signup > li > a:visited {
  color:#5e7cf7;
  background-color:transparent; text-decoration:none
}
#login_signup > li > a:hover {
  color:red; background-color:transparent; text-indent: inherit;
}
#login_signup > li > a:active {
  color:yellow; background-color:transparent; text-decoration:underline
}
/*css drop down member name*/
.dropbtn {
    background-color: #fffff;
    color: black;
    padding: 16px;
    font-size: 16px;
    border: none;
    cursor: pointer;
	text-decoration:none;
	
}

.dropbtn:hover, .dropbtn:focus {
    background-color: #fffff;
}

.dropdown {
    position: relative;
    display: inline-block;
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 200px;
    overflow: auto;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);

}

.dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
}

.dropdown a:hover {color: black;
					text-decoration:none;}

.show {display:block;}


a #regis :hover{color:red;}
	


</style>

</head>



<header class="bg">
  
  <!-- CONTAINER CONTENT -->
  <div class="container " style="padding-top: 41px;">

  <!-- Login - Shopping Cart -->
  <div id="login_bar">               
    <ul class="nav" id="login_signup">
        <li><a href="cart-show.php"><img src="shopcart.png" width="25" class="img-responsive"></a></li>
<?php 
if(!isset($_SESSION['user'])) {  
?>
        <li><a href="login.php" id="login_link">Login</a></li>
<?php  
  }
  else {
?>

        <p class="navbar-text">สวัสดี,
		

<div class="dropdown" style="padding-top:3%;">
<a onclick="myFunction()" class="dropbtn"><?php $name=$_SESSION['user']; printf("%s",$name); ?></a>
  <div id="myDropdown" class="dropdown-content">
    <a href="profile.php">Profile</a>
    <a href="#collection">Collection</a>
  </div>
</div>
		
		  
		 <a href="destroy.php">  ออกจากระบบ</a>&nbsp;&nbsp;&nbsp;</p>
<?php
  }
?>
    </ul>
  </div>
  
  <!--Register Float NOT in MENUBAR -->
<?php if(!isset($_SESSION['user'])) {   ?>
 <a id="regis" href="reg.php" style="position:absolute;right:9.75%;top:15%;text-decoration:none;font-weight:bold;">Register</a>
<?php  }  ?>

    <!-- LOGO -->
  <div class="page-header" style="border-width: 0px;">
      <img src="logoVer4.gif" width="300" class="img-responsive">
  </div>
 
 <!-- START NAV BAR -->
<div align="right" style="margin-right: 0%;margin-left: 0%;margin-bottom:0.5%;">
<nav class="navbar navbar-default" style="font-size: 14px;">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
            
    </div>



    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="TheKeeper.php"><b><img src="home.gif" width="14"> Home</b></a></li>

<!-- เริ่มส่วนที่เพิ่มเติม การ์ด 25 -->       

        <li class="dropdown" style="z-index:100;">
          <a onclick="myFunction2()" class="dropbtn"><b>Products</b><span class="caret"></span></a>
          <ul id="myDropdown2" class="dropdown-content" style="list-style-type:none; font-weight:bold;">
            <li><a href="categories1.php">แบบที่ 1</a></li><hr>
            <li><a href="categories2.php">แบบที่ 2</a></li><hr>
            <li><a href="categories3.php">แบบที่ 3</a></li><hr>
            <li><a href="categories4.php">ธนบัตรคลาดเคลื่อน</a></li><hr>
            <li><a href="categories5.php">ธนบัตรที่ระลึก</a></li><hr>
            <li><a href="categories6.php">ธนบัติต่างประเทศ</a></li>
          </ul>
      </li>
      </ul>
<!-- จบส่วนที่เพิ่มเติม การ์ด 25 -->

<!-- เริ่มส่วนที่เพิ่มเติม การ์ด 7 --> 

<?php if(isset($_SESSION['username'])){ if($_SESSION['username']=='testing@admin.com') {   ?>
<!-- PRODUCT  -->
		<ul class="nav navbar-nav">
		<li class=""><a href="manageProduct.php"><span class="glyphicon glyphicon-tag" aria-hidden="true"></span> 
		<b>Manage Products</b></a></li>
  		</ul>
<!-- END PRODUCT -->
<!-- User -->
		<ul class="nav navbar-nav">
		<li class=""><a href="manageUser.php"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> 
		<b>Manage Users</b></a></li>
  		</ul>
 <!-- END User -->
<!-- SELLER -->
		<ul class="nav navbar-nav">
        <li class="dropdown" style="z-index:100;">
	      <a onclick="myFunction3()" class="dropbtn"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
	      <b>Manage Sellers </b><span class="caret"></a>
	      	<ul id="myDropdown3" class="dropdown-content" style="list-style-type:none; font-weight:bold;">
	        <li><a href="manageSeller.php">Sellers</a></li><hr>
	        <li><a href="manageProduct.php">The consignment</a></li>
	      	</ul>
  		</li>
  		</ul>
<!-- END SELLER -->

	<!-- <ul class="nav navbar-nav navbar-right">
	<li class=""><a href="manageSeller.php"><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span> 
	<b>Admin Panel</b></a></li>
	</ul> -->

 <?php }} ?>
<!-- จบส่วนที่เพิ่มเติม การ์ด 7 -->








    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
  </div>
</nav> 
</div>
</div>  <!-- END CONTAINER CONTENT -->

<!-- script make dropdown name member  -->

<script>
/* When the user clicks on the member name, 
toggle between hiding and showing the dropdown content */
function myFunction() {
    document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {

    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
</script>


<!-- เริ่มส่วนที่เพิ่มเติม การ์ด 25 -->  
<script>
function myFunction2() {
    document.getElementById("myDropdown2").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {

    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
</script>
<!-- จบส่วนที่เพิ่มเติม การ์ด 25 -->  

<!-- เริ่มส่วนที่เพิ่มเติม การ์ด 7 -->  
<script>
function myFunction3() {
    document.getElementById("myDropdown3").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {

    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
</script>
<!-- จบส่วนที่เพิ่มเติม การ์ด 7 --> 

</header>


