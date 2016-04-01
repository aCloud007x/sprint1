<?php include('header-menu.php'); ?> <!-- HEAD -->
<head>
<!--  สำคัญ ห้ามลบ ห้ามจัดอันดับใหม่ เด็ดขาด!! THIS IMPORTANT FOR UI! -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
<link type="text/css" href="css/jquery-ui.min.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
<script src="js/jquery.blockUI.js"></script>

<style>

#username { 
  padding: 0 20px 0 2px; 
}
.thinking { 
	background: white url('img/checking.gif') no-repeat; 
	background-position: 125px 10px;   
}

.approved { 
	background: white url('img/true.gif') no-repeat; 
	background-position: 125px 10px;   
}

.denied { 
	background: #FF8282 url('img/false.gif') no-repeat; 
	background-position: 125px 10px;   
}

</style>
<script>
	function checkUsername() {
		document.getElementById("username").className = "thinking form-control";
		
		request = new XMLHttpRequest();
		request.onreadystatechange = showUsernameStatus;
		
		var username = document.getElementById("username").value;
		var url = "reg-ajax-check-email.php?username=" + username;
			request.open("GET", url, true);
			request.send(null);
	}

	function showUsernameStatus() {
		if (request.readyState == 4) {
			if (request.status == 200) {

				if (request.responseText == "okay") {
					document.getElementById("username").className = "approved form-control";

				} else {
					document.getElementById("username").className = "denied form-control";
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
<form id='regform'>
<div class="col-sm-2" style="background-color: white;">
 <input type="email" id="username" class="form-control" name="username" placeholder="E-mail" required onblur="checkUsername()">
<button id="button">GO</button>
</div>
</form>
<div id="dd" style="display:none;">บันทึกข้อมูลสำเร็จ !!!!!!</div>
</div>
</body> <!-- END BODY -->
<?php include('footer.php'); ?> <!-- FOOT -->
<script>
function validateForm() {
	// alert('valid');
    var x = document.forms["regform"]["username"].value;
    if (x == null || x == "") {
        return false;
    }
	else{ return true; }
}
$('button').click(function(){
	Reg();
});
function Reg()
{
		$.ajax({ //begin AJAX
			url:'reg-ajax-check-reg.php',
			data:$('form').serializeArray(),
			type:'post',
			datatype:'text',
			cache:false,
			beforeSend:function()
			{
				$.blockUI({message:'<h1>sending...</h1>'});
			},
			success:function(result)
			{
				$.unblockUI();
				//alert(result);
				$('#dd').dialog({ //begin dialog
					title:"SUCCESS",
					dialogClass: "no-close",
					buttons: [
					{text:'Cancel', click:function(){ $(this).dialog('close');} },
					{text:'OK', click: function() { $('form').submit();} }
							]
				});//end dialog
			},
			error:function()
			{
				$.unblockUI();
				$('form')[0].reset();
				//alert(result);
			},
			complete:function() //ส่งajaxสำเร็จหรือไม่ก็ตาม
			{
				$.unblockUI();
			}
		}); //end AJAX

} //end submitREG()
function sendForm()
{ }

</script>