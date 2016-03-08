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
</style>

</head>



<header class="bg">
  
  <!-- CONTAINER CONTENT -->
  <div class="container " style="padding-top: 45px;">

  <!-- LOGO -->
  <div class="page-header"><img src="logoVer4.gif" width="300" class="img-responsive"></div>
  
<div align="right" style="margin-right: 0%;margin-left: 0%;margin-bottom:0.5%;">
<nav class="navbar navbar-default">
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
        <li class="active"><a href="index.php"><b><img src="home.gif" width="14"> Home</b></a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><b>Products </b><span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">p 1</a></li>
            <li><a href="#">p 2</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">p ETC.</a></li>
          </ul>
        </li>
      </ul>

      <ul class="nav navbar-nav navbar-right">
        <li><a href="#"><span class="glyphicon glyphicon-shopping-cart"></span></a></li>
        <li><a href="#"><b>Login</a></b></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
  </div>
</nav>
</div>  <!-- END CONTAINER CONTENT -->
</header>



<!-- 
<div class="container">

  <br>
    <div class="navbar navbar-default" align="center"><br>&copy; 2016, <a href="#">Assemble</a></div>
</div> 
-->



