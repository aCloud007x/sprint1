	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	<script>
		$(function() {
			$('button.approve').click(function() {
				var id = $(this).attr('data-id');
				window.alert('approve JS! data='+id+' ');
				$('form [name=item_id]').val(id);
				$('form [name=action]').val('approve');
				$('form').submit();
			});
			
			$('button.decline').click(function() {
				// if(!confirm('ยืนยันว่าจะปฏิเสธ ?')) {
				// 	return false;
				// }
				var id = $(this).attr('data-id');
				$('form [name=action]').val('decline');
				$('form [name=item_id]').val(id);
				$('form').submit();
			});
		});

	</script>
	<?php //begin loop php each item
include "connect.php"; 

if($_POST) {
	$item_id = $_POST['item_id'];
	if($_POST['action'] == "approve") {
	echo "HIIIIIIIIIIIIIIIIIII";
	}
	else if($_POST['action'] == "decline") {
	echo "Heeeeeeeeeeeeasdadeeeeeeeeeee";
	}
}

?>

<form method="post" action='tt.php'>
<button type='submit' class='approve' data-id='<?php echo $objResult["Sid"]; ?>' style="margin-left:10px;">Approve</button>
<button type='submit' class='decline' data-id='<?php echo $objResult["Sid"]; ?>'>Decline</button>
<input type="hidden" name="action">
<input type="hidden" name="item_id">
</form>