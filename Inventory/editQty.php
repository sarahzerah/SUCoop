<?php
	include '../connect.php';
    include '../session.php';
	
	$orderNum=$_POST['orderNum'];
	$quantity=$_POST['quantity'];
  
    //update quantity
    mysqli_query($con,"UPDATE ordered_items SET quantity='$quantity' WHERE orderNum='$orderNum'");

    header("location:viewOrders.php?success=Update Successful");

?>