<?php include('header-menu.php'); ?> <!-- HEAD -->
<head>
<!--  สำคัญ ห้ามลบ ห้ามจัดอันดับใหม่ เด็ดขาด!! THIS IMPORTANT FOR UI! -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
<link type="text/css" href="css/jquery-ui.min.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
<script src="js/jquery.blockUI.js"></script>
<script src="js/jquery.validate.min.js"></script>

<style>

#username { 
  padding: 0 20px 0 2px; 
}
.thinking { 
	background: white url('img/checking.gif') no-repeat; 
	background-position: 225px 8px;   
}

.approved { 
	background: white url('img/true.gif') no-repeat; 
	background-position: 225px 8px;   
}

.denied { 
	background: #FF8282 url('img/false.gif') no-repeat; 
	background-position: 225px 8px;   
}
body{
    font-family: sans-serif;
    font-style: arial;
  }
  form{
    background-color:#effbfb; 
    border:2px solid #effbfb; 
    border-radius:5px; 
    width:90%;
  }
  h1{
    font-size:50px; 
    margin-top:50px;
    color: black;
  }
  h1 > img{
     width:50px;
     height:50px;
  }
  tr{
    border: 15px solid #effbfb;
  }
  div{
    line-height: 160%;
  }
  div.one{
    font-size: 20px;
    text-align: right;
    vertical-align: top;
    padding-right: 15px;
  }
  div.two > input, div.two > select{
    height: 30px;
    width: 255px;
    border-radius: 6px;
    font-style: arial;
    font-family: sans-serif;
    font-size: 15px;
  }
  div textarea{
    height: 100px;
    width: 255px;
    border-radius: 6px;
  }
</style>
<script>
	function checkUsername() {
		document.getElementById("txtUsername").className = "thinking two";
		
		request = new XMLHttpRequest();
		request.onreadystatechange = showUsernameStatus;
		
		var username = document.getElementById("txtUsername").value;
		if(username==null||username==""){
			document.getElementById("txtUsername").className = "denied two";
			document.getElementById("txtUsername").focus();
			document.getElementById("txtUsername").select();
		}
		else{
		var url = "reg-ajax-check-email.php?username=" + username;
			request.open("GET", url, true);
			request.send(null);
		}
	}



	function showUsernameStatus() {
		if (request.readyState == 4) {
			if (request.status == 200) {

				if (request.responseText == "okay") {
					document.getElementById("txtUsername").className = "approved two";

				} else {
					document.getElementById("txtUsername").className = "denied txtPassword";
					//document.getElementById("username").focus();
					//document.getElementById("username").select();
				}
			}
		}
	}
</script>
</head>
<body> <!-- Content BODY HERE -->
<div class="container" style="padding-top: 30px;">
<!-- BEGIN FORM -->

<center>
    <form id="regform" name="regform" >
      <h1><img src="account.png"> Create your account</h1>
      <hr width="70%"> 
      <table style="margin-top:40px; margin-bottom:40px;">
         <tr>
          <td><div class="one">Username: </div></td>
          <td><div class="two"><input type="email" name="txtUsername" id="txtUsername" onblur="checkUsername()" 
          pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required /></div></td>
        </tr>
       <tr>
          <td><div class="one">Password: </div></td>
          <td><div class="two"><input type="password" name="txtPassword" id="txtPassword1" pattern="(?=^.{8,16}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z])(?!.*\s).*$" maxlength="16" required>
          <br><small style="color:red;">*must at least 8-16 characters, contains <br>a combination of number, upper and lower case letters</small></div></td>
        </tr>
       <tr>
          <td><div class="one">Confirm Password: </div></td>
          <td><div class="two"><input type="password" name="txtConPassword" id="txtConPassword2" pattern="(?=^.{8,16}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z])(?!.*\s).*$" maxlength="16" required>  <div id='message'></div></div></td>
        </tr>
        <tr>
          <td><div class="one">Question: </div></td>
          <td>
            <div class="two">
              
                <select name="txtQuestion" id="txtQuestion"  required>
                  <option value="What your favorite color?">What your favorite color?</option>
                  <option value="What your favorite food?">What your favorite food?</option>
                  <option value="What your favorite song?">What your favorite song?</option>
                  <option value="What your favorite game?">What your favorite game?</option>
                  <option value="What your favorite food?">What your favorite movie?</option>
                </select>
              
            </div>
          </td>
        </tr>
        <tr>
          <td><div class="one">Answer: </div></td>
          <td><div class="two"><input type="messages" name="txtAnswer" id="txtAnswer" pattern="[\d|\w|\S]+"  required></div></td>
      </tr>
      <tr>
          <td><div class="one">Firstname: </div></td>
          <td><div class="two"><input type="messages" name="txtFirstname" id="txtFirstname" pattern="[\d|\w|\S]+"  required></div></td>
      </tr>
      <tr>
          <td><div class="one">Lastname: </div></td>
          <td><div class="two"><input type="messages" name="txtLastname" id="txtLastname" pattern="[\d|\w|\S]+"  required></div></td>
      </tr>
      <tr>
          <td><div class="one">Address: </div></td>
          <td><div class="two"><textarea type="messages" name="txtAddress" id="txtAddress" pattern="[\d|\w|\S]+"  required></textarea></div></td>
      </tr>
      <tr>
          <td><div class="one">Distric: </div></td>
          <td><div class="two"><input type="messages" name="txtDistrict" id="txtDistrict" pattern="[a-zA-Z\s]+"  required></div></td>
      </tr>
      <tr>
          <td><div class="one">Province: </div></td>
          <td><div class="two"><input type="messages" name="txtProvince" id="txtProvince" pattern="[a-zA-Z\s]+"  required></div></td>
      </tr>
      <tr>
          <td><div class="one">Postal Code: </div></td>
          <td><div class="two"><input type="digit" name="txtPostalCode" id="txtPostalCode" pattern="[0-9]{5}" maxlength="5"  required>
          <br><small style="color:red;">*Postal Code must be 5 digit</small></div></td>
      </tr>
      <tr>
          <td><div class="one">Mobile number: </div></td>
          <td><div class="two"><input type="tel" name="txtMobileNumber" id="txtMobileNumber" pattern="[0-9]{10}" maxlength="10"></div></td>
      </tr>
      <tr>
        <td></td>
        <td><div><br><input type="checkbox" onclick="$('#btnRegister').attr('disabled', !$(this).is(':checked'));" required> Allow us send an email reply.</div></td>
      </tr>
      <tr>
        <td></td>
        <td><div><input name="btnRegister" type="submit" id="btnRegister" value="Register" class="btn btn-primary" onclick="Reg()" disabled></div></td>
        <input type="submit" id="btnsub" value="55555" style="display: none;">
      </tr>
    </table>
  </form>
  </center>
<!-- END FORM -->
<div id="successdlg" style="display:none;">บันทึกข้อมูลสำเร็จ !</div>
<div id="errordlg" style="display:none;">ผิดพลาด..<br>โปรดลองใหม่อีกครั้ง</div>
</div>
</body> <!-- END BODY -->
<?php include('footer.php'); ?> <!-- FOOT -->
<script>

$('#regform').submit(function () {
 return false;
 Reg(); 
});

$('#btnsub').click();


$('#txtPassword1, #txtConPassword2').on('keyup', function () {
	if($('#txtPassword1').val() == "" || $('#txtConPassword2').val() == ""){
		$('#message').html('Invalid Password').css('color', 'red');
	}
	else{
	    if ($('#txtPassword1').val() == $('#txtConPassword2').val()) {
	        $('#message').html('Matching').css('color', 'green');

	    } else 
	        $('#message').html('Not Matching').css('color', 'red');
    }
});

function Reg()
{
	var mail = document.getElementById("txtUsername").value;
	var pwd = document.getElementById("txtPassword1").value;
		$.ajax({ //begin AJAX
			url:'reg-ajax-check-reg.php',
			data:$('form').serializeArray(),
			type:'post',
			datatype:'text',
			cache:false,
			beforeSend:function()
			{

				$.blockUI({message:'<h1>Sending...</h1>',timeout:3000});
			},
			success:function(result)
			{
				//
				// set cookie before go to login page //
				//
				document.cookie = "user="+mail; 
				document.cookie = "pwd="+pwd;
				// console.log(result);
				$("#successdlg").html(result);
				$.unblockUI();
				//alert(result);
				$('#successdlg').dialog({ //begin dialog
					title:"DETAIL..",
					dialogClass: "no-close",
					buttons: [
					{text:'OK', click:function(){ location.href = 'login.php'; }}
					// {text:'OK', click:function(){ $(this).dialog('close'); }}
							]
				});//end dialog
			},
			error:function()
			{
				console.log(result);
				$("#errordlg").html(result);
				$.unblockUI();
				$('#errordlg').dialog({ //begin dialog
					title:"ERROR !",
					dialogClass: "no-close",
					buttons: [
					{text:'Cancel', click:function(){ $(this).dialog('close');} }
							]
				});//end dialog
				$('form')[0].reset();
				//alert(result);
			},
			complete:function() //ส่งajaxสำเร็จหรือไม่ก็ตาม
			{
				$.unblockUI();
			}
		}); //end AJAX

} //end submitREG()
</script>