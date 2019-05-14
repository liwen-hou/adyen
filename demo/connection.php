<?php
//$con=mysqli_connect("localhost","id2538044_sajalagrawal","******","id2538044_store") or die(mysqli_error($con));
try {
	$con=mysqli_connect("localhost","root","password","orderdb");
} catch (Exception $e) {

	echo "error";
}


?>
