<?php

	include '../connect.php';
	include '../session.php';
	$orderNum=$_GET['orderNum'];
    $Num=$_GET['PONum'];
    $pNum=$_GET['pNum'];
	$del = "DELETE FROM ordered_items WHERE orderNum='$orderNum'";
	$sql=mysqli_query($con, $del);

    mysqli_query($con,"UPDATE inventory SET status='received' WHERE productNum='$pNum'");
    $qrydep = "SELECT * FROM ordered_items WHERE PONum='$Num'";
    $result = mysqli_query($con, $qrydep);
    
    if(mysqli_num_rows($result) == 0)
    	 $del1 = "DELETE FROM purchase_order WHERE PONum='$Num'";
	$sql1=mysqli_query($con, $del1);

	header("location: viewRestocked.php");
	
?>