<?php
	include '../connect.php';
    include '../session.php';
	
	$transactionNum=$_POST['transactionNum'];
	$amount=$_POST['amount'];
  
    //update product status
    mysqli_query($con,"UPDATE transaction SET amount='$amount' WHERE transactionNum='$transactionNum'");

    header("location:cashTransaction.php?success=Edit Successful");

?>