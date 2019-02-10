<?php

	include '../connect.php';
	include '../session.php';
	$id=$_GET['id'];
	$salesNum=$_SESSION['salesNum'];

	if ($id=="allitems")
	{
		$del = "DELETE FROM items WHERE ORNum='$salesNum'";
		$sql=mysqli_query($con,$del); 
		header("location: pos.php");
	}
	else {
	$sql3="SELECT * FROM items WHERE purchaseNum=$id";
    $qry2=mysqli_query($con,$sql3);
	$row2 = mysqli_fetch_assoc($qry2);
	$iQty=$row2['quantity'];
	$productNum=$row2['productNum'];

	$sql1="SELECT * FROM inventory WHERE productNum=$productNum";
    $qry=mysqli_query($con,$sql1);
	$row = mysqli_fetch_array($qry);
	$pQty=$row['quantity'];

	$sql3="SELECT * FROM items WHERE purchaseNum=$id";
    $qry2=mysqli_query($con,$sql3);
	$row2 = mysqli_fetch_array($qry2);
	$iQty=$row2['quantity'];

	$newQty=$pQty+$iQty;

	$sql2 = "UPDATE inventory SET quantity='$newQty' WHERE productNum='$productNum'";

	if ($con->query($sql2) === TRUE) {
	    $message="Record updated successfully";
	} else {
	    $message="Error updating record: " . $con->error;
	}

	echo $iQty.$pQty;

	$del = "DELETE FROM items WHERE purchaseNum='$id'";
	$sql=mysqli_query($con,$del); 
	header("location: pos.php");
	}
?>