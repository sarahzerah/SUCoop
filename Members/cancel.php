<?php
	include '../connect.php';
	
	$id=$_GET['id'];

	$del = "DELETE  FROM cash_transaction WHERE transactionNum='$id'";
	$sql=mysqli_query($con,$del); 
	header("location:cashTransaction.php");
	
?>