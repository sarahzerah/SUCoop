<?php

	include '../connect.php';
	include '../session.php';

	$cTransactionNum=$_GET['cTransactionNum'];
	$type=$_GET['type'];
	$amount=$_GET['amount'];
	$member=$_SESSION['memberID'];
       
	
	$query1=mysqli_query($con,"SELECT * FROM member WHERE userID='$member'");
	$rw1=mysqli_fetch_array($query1);
	$savings=$rw1['savings'];
	$cBalance=$rw1['creditBalance'];
	$investment=$rw1['investment'];

    if($type =='investment'){

	    $newInv=$investment-$amount;
		$creditLimit =$newInv*2;

		$sql = mysqli_query($con,"UPDATE member SET creditLimit='$creditLimit', investment='$newInv' WHERE userID='$member'");
		unset($_SESSION['invest']);

          }

		  elseif ($type =='deposit') {

			$newSavings=$savings - $amount;
			$sql = mysqli_query($con,"UPDATE member SET 
				savings='$newSavings'WHERE userID='$member'");
			unset($_SESSION['deposit']);

			
			}elseif($type =='withdrawal'){

				$newSavings=$savings+$amount;
				$sql = mysqli_query($con,"UPDATE member SET savings='$newSavings' WHERE memberID='$member'");
				unset($_SESSION['withdraw']);


			}elseif($type =='cpayment'){

				$newCBal=$cBalance+$amount ;

				$sql = mysqli_query($con,"UPDATE member SET creditBalance='$newCBal' WHERE userID='$member'");
				unset($_SESSION['cpay']);


			}

			$del = "DELETE FROM transaction WHERE cTransactionNum='$cTransactionNum'";
	$sql=mysqli_query($con, $del); 
	header("location: cashTransaction.php");

?>