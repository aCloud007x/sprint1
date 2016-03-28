<?php
$id = $_GET['id'];
echo "\$('[data-id=$id]').parent().parent().remove();";

// function delete($id){
// 	include 'connect.php'
// 	$sql = "DELETE FROM cart WHERE item_id = '$id'";
// 	mysqli_query($connect, $sql);	
//  }
?>