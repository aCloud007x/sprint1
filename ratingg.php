<?php
session_start ();
include ("connect.php");

$point =($_REQUEST ['point']);
$user = $_REQUEST ['mem'];
$pid = $_REQUEST ['pid'];

$sql = "SELECT * FROM rate  where Pid like '$pid' and Mid like '$user' ";
$objQuery = mysqli_query ( $connect, $sql );
if ($row = mysqli_fetch_array ( $objQuery, MYSQLI_ASSOC )) {
	
	$sql = "update rate set Score=$point where Pid like '$pid' and Mid like '$user' ";
	mysqli_query ( $connect, $sql );
	
	$sql = "SELECT sum(Score),count(Pid) FROM rate  where Pid like '$pid' group by Pid ";
	$objQuery = mysqli_query ( $connect, $sql );
 	if($row = mysqli_fetch_array($objQuery,MYSQLI_ASSOC))
		echo $row["sum(Score)"] / $row["count(Pid)"];
} 
else {
	
		$sql = "INSERT INTO rate VALUES ('$pid','$user',$point)";
		mysqli_query ( $connect, $sql );
		
		$sql = "SELECT sum(Score),count(Pid) FROM rate  where Pid like '$pid' group by Pid ";
		$objQuery = mysqli_query ( $connect, $sql );
 		if($row = mysqli_fetch_array($objQuery,MYSQLI_ASSOC))
		echo $row["sum(Score)"] / $row["count(Pid)"];
}
//echo $pid." ".$point." ".$user;

?>