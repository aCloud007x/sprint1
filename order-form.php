<?php session_start();
  include 'connect.php'; // $connect
  $name = $_SESSION['user'];
  // echo $name;
  $sql = "SELECT * FROM member WHERE Mname='$name'";
  $objQuery = mysqli_query($connect,$sql);
  $res= mysqli_fetch_array($objQuery);
  include('header-menu.php'); ?> <!-- HEAD -->
  <head>
  <title>Shipping Address</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

  <style type="text/css">

    body {
    background-color: #effbfb;
}
  </style>


</head>
<body bgcolor="blue"> <!-- Content BODY HERE -->
<div class="container" style="padding-top: 45px;">

<script>
function myFunction() {

    if(document.getElementById('chkPassport').checked)
    {
    document.getElementById("inputName2").value = document.getElementById("inputName1").value;
    document.getElementById("inputAddress2").value = document.getElementById("inputAddress1").value;
    document.getElementById("inputStateProvince2").value = document.getElementById("inputStateProvince1").value;
    document.getElementById("inputCity2").value = document.getElementById("inputCity1").value;
    document.getElementById("inputPostalCode2").value = document.getElementById("inputPostalCode1").value;
    }
    else{
    document.getElementById("inputName2").value = "";
    document.getElementById("inputAddress2").value = "";
    document.getElementById("inputStateProvince2").value = "";
    document.getElementById("inputCity2").value = "";
    document.getElementById("inputPostalCode2").value = "";
    }
}

function showhide(){
        $("#chkPassport").click(function () {
            if ($(this).is(":checked")) {
                $("#visacol1").show();
            } else {
                $("#visacol1").hide();
            }
        });
}

$('#btn-confirm').click(function(){
alert('COMPLETE');


});
</script>



  <br><br><h2><img src="truck.png" width="40">  Shipping Address</h2><br>
  <form>

  <div class="form-group row">
    <label class="col-sm-2"></label>
    <div class="col-sm-8">
      
        <div class="form-group row">
          <label for="inputName" class="col-sm-2 form-control-label"><b>Name</b></label>
          <div class="col-sm-8">
            <input type="Name" class="form-control" id="inputName1" placeholder="Firstname Lastname" value="<?php echo $res['Mname']; ?>">
          </div>
        </div>
        <div class="form-group row">
          <label for="inputAddress" class="col-sm-2 form-control-label"><b>Address</b></label>
          <div class="col-sm-8">
            <input type="Address" class="form-control" id="inputAddress1" placeholder="Address" value="<?php echo $res['Maddress']; ?>">
          </div>
        </div>
        <div class="form-group row">
          <label for="inputStateProvince" class="col-sm-2 form-control-label"><b>State/Province</b></label>
          <div class="col-sm-8">
            <input type="StateProvince" class="form-control" id="inputStateProvince1" placeholder="State/Province" value="<?php echo $res['Mstate']; ?>">
          </div>
        </div>
        <div class="form-group row">
          <label for="inputCity" class="col-sm-2 form-control-label"><b>City</b></label>
          <div class="col-sm-8">
            <input type="City" class="form-control" id="inputCity1" placeholder="City" value="<?php echo $res['Mcity']; ?>">
          </div>
        </div>
        <div class="form-group row">
          <label for="inputPostalCode" class="col-sm-2 form-control-label"><b>Postal Code</b></label>
          <div class="col-sm-8">
            <input type="PostalCode" class="form-control" id="inputPostalCode1" placeholder="Postal Code" value="<?php echo $res['Mpostalcode']; ?>">
          </div>
        </div>

    </div>
  </div>


  <br><h2><img src="house.png" width="35">  Billing Address</h2><br>

  <div class="form-group row">
    <label class="col-sm-2"></label>
    <div class="col-sm-8">
      <div class="checkbox">
        <label for="chkPassport">
          <input type="checkbox" id="chkPassport" onclick="myFunction()">Same as shipping address
        </label><br><br><br>

        <div class="form-group row">
          <label for="inputName" class="col-sm-2 form-control-label"><b>Name</b></label>
          <div class="col-sm-8">
            <input type="Name" class="form-control" id="inputName2" placeholder="Firstname Lastname">
          </div>
        </div>
        <div class="form-group row">
          <label for="inputAddress" class="col-sm-2 form-control-label"><b>Address</b></label>
          <div class="col-sm-8">
            <input type="Address" class="form-control" id="inputAddress2" placeholder="Address">
          </div>
        </div>
        <div class="form-group row">
          <label for="inputStateProvince" class="col-sm-2 form-control-label"><b>State/Province</b></label>
          <div class="col-sm-8">
            <input type="StateProvince" class="form-control" id="inputStateProvince2" placeholder="State/Province">
          </div>
        </div>
        <div class="form-group row">
          <label for="inputCity" class="col-sm-2 form-control-label"><b>City</b></label>
          <div class="col-sm-8">
            <input type="City" class="form-control" id="inputCity2" placeholder="City">
          </div>
        </div>
        <div class="form-group row">
          <label for="inputPostalCode" class="col-sm-2 form-control-label"><b>Postal Code</b></label>
          <div class="col-sm-8">
            <input type="PostalCode" class="form-control" id="inputPostalCode2" placeholder="Postal Code">
          </div>
        </div>


      </div>
    </div>
  </div>



  <br><h2><img src="coin.png" width="35">  Payment</h2><br>

  <div class="form-group row">
    <label class="col-sm-2"></label>
    <div class="col-sm-8">
      <label class="radio-inline">
        <input type="radio" name="inlineRadioOptions" id="visa" value="option1" data-toggle="collapse" data-target="#collapse1"> VISA
      </label>
      <label class="radio-inline">
        <input type="radio" name="inlineRadioOptions" id="masterCard" value="option2" data-toggle="collapse" data-target="#collapse1"> Master Card
      </label>
      <label class="radio-inline">
       <input type="radio" name="inlineRadioOptions" id="payPal" value="option3" onclick="location.href='https://www.paypal.com'"> PayPal
      </label><br>

      <!-- COLLAPSE 1 --><br>
        <div class="panel-group">
          
     <!--        <div class="panel-heading">
              <h4 class="panel-title">
                <a data-toggle="collapse" href="#collapse1">Collapsible panel</a>
              </h4>
            </div> -->
            <div id="collapse1" class="panel-collapse collapse">
              <div class="panel-body">
                <div class="form-group row">
                  <label for="inputCardholder" class="col-sm-2 form-control-label">Cardholder</label>
                  <div class="col-sm-8">
                    <input type="Cardholder" class="form-control" id="inputCardholder" placeholder="The name on the card">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputCardNumber" class="col-sm-2 form-control-label">Card Number</label>
                  <div class="col-sm-8">
                    <input type="cardNumber" class="form-control" id="inputCardNumber" placeholder="16-digit card number" maxlength="16">
                  </div>
                </div>
              <div class="form-group row">
                <div class="form-inline">
                  <label for="inputDate" class="col-sm-2 form-control-label">Expiration Date</label>
                  <div class="col-sm-4">
                    <input type="text" class="form-control" id="inputDate" placeholder="Month">
                  </div>
                 
                  <div class="col-sm-4">
                    <input type="text" class="form-control" id="inputDate" placeholder="Year">
                  </div>
                </div>
              </div>
                <div class="form-group row">
                  <label for="inputCVV" class="col-sm-2 form-control-label">CVV Number</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="inputCVV" placeholder="3-digit card number" maxlength="3">
                  </div>
                </div>
              </div>
            </div> <!-- end id collapse1-->
          </div>
   
      <!-- END COLLAPSE 1-->

    </div>
  </div>
    
  <br><br>  

  <div class="form-group row pull-right">
      <button type="submit" class="btn btn-primary" id="btn-confirm">Confirm</button>

  </div>
  <br><br><br><br>
  </form>



</div>
<?
  mysqli_close($connect);
?>


</div>
</body> <!-- END BODY -->
<?php include('footer.php'); ?> <!-- FOOT -->