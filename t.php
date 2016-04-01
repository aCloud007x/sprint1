<head>

<!-- <script type="text/javascript" scr="js/jquery-2.2.2.min.js"></script>
<script type="text/javascript" scr="js/jquery-ui.min.js"></script>
<link type="text/css" href="css/jquery-ui.min.css" rel="stylesheet">
 -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
<link type="text/css" href="css/jquery-ui.min.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>




</head>

<body>
<button id="button">GO</button>
<div id="dd" style="display:none;">Hello There</div>

</body>
<script>
$('#button').click(function()
{
		$('#dd').dialog({
  dialogClass: "no-close",
  buttons: [
			{text:'Cancel', click:function(){ $(this).dialog('close');} },
			{text:'OK', click: function() { $('form').submit();} }
		]

	});
});

// $(document).ready(function(){
//     $("#dlg").dialog();
// });

</script>