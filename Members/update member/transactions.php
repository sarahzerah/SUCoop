<?php

	include('../connect.php');
	include('../session.php');

	//if investment
if (isset($_POST['submit'])) {
	
    $type= $_POST['transaction'];
	$id = $_POST['member'];
	$amount = $_POST['amount'];
	$user=$_SESSION['userID'];
	date_default_timezone_set("Asia/Manila");
	$dateReceived=date("Y-m-d");

	$timeReceived=date("h:i:sa");
	$OR=$_SESSION['salesNum'];


	if ($type =='investment') {


        $query1="SELECT * FROM member WHERE userID='$id'";
        $qry1=mysqli_query($con,$query1);
        $rw1=mysqli_fetch_array($qry1);
        $memberID=$rw1['memberID'];

		$qry = "INSERT INTO cash_transaction (dateReceived, timeReceived, userID, memberID, investment,creditPayment,withdrawal,deposit,ORNum) VALUES ('$dateReceived',
		'$timeReceived', '$user', '$memberID','$amount','0','0','0','$OR')";
		$inv= mysqli_query($con,$qry);
		

		if ($inv) {
			
			$investment=$rw1['investment'];
			$newInv=$investment+$amount;
			$creditLimit =$newInv * 2;

			$sql = "UPDATE member SET creditLimit='$creditLimit', 
			investment='$newInv'  
			         WHERE userID='$id'";

	        if ($con->query($sql) === TRUE) {
	            $message="Record updated successfully";
	        } else {
	            $message="Error updating record: " . $con->error;
	        }
			header("location: cashTransaction.php?salesNum=$OR");

			}else{
				echo "Error!";
			}
	}

		// end of investment

		//cpayment 

	if ($type =='cpayment'){

        $query1="SELECT * FROM member WHERE userID='$id'";
            $qry1=mysqli_query($con,$query1);
            $rw1=mysqli_fetch_array($qry1);
            $memberID=$rw1['memberID'];
            $cBalance=$rw1['creditBalance'];

         if ($cBalance==0)
         	header("location: cashTransaction.php?error=Member has no credit balance yet.");
        else if ($amount<=$cBalance) {

			$qry = "INSERT INTO cash_transaction (dateReceived, timeReceived, userID, memberID,investment,creditPayment,withdrawal,deposit, ORNum) VALUES (
			'$dateReceived','$timeReceived', '$user', '$memberID','0','$amount','0','0', 
			'$OR')";
			$cp= mysqli_query($con,$qry);
			
			if ($cp) {
				

				
				$newCBal=$cBalance-$amount ;

				$sql = "UPDATE member SET creditBalance='$newCBal' WHERE userID='$id'";
		        if ($con->query($sql) === TRUE) {
		            //$message="Record updated successfully";
		            header("location:cashTransaction.php?salesNum=$OR&type=cpayment");
		        } else {
		            $message="Error updating record: " . $con->error;
		        }
				

			}else{
					echo "Error!";
			}

		}
		else {
			$qry = "INSERT INTO cash_transaction (dateReceived, timeReceived, userID, memberID,investment,creditPayment,withdrawal,deposit, ORNum) VALUES (
			'$dateReceived','$timeReceived', '$user', '$memberID','0','$cBalance','0','0', 
			'$OR')";
			$cp= mysqli_query($con,$qry);
			
			if ($cp) {
				$change=$cBalance-$amount;
				$newCBal=0;


				$sql = "UPDATE member SET creditBalance='$newCBal' WHERE userID='$id'";
		        if ($con->query($sql) === TRUE) {
		            //$message="Record updated successfully";
		            header("location:cashTransaction.php?salesNum=$OR");
		        } else {
		            $message="Error updating record: " . $con->error;
		        }

			}else{
					echo "Error!";
			}
		}
	
}

// savings....................


	$query1="SELECT * FROM member WHERE userID='$id'";
    $qry1=mysqli_query($con,$query1);
    $rw1=mysqli_fetch_array($qry1);
    $memberID=$rw1['memberID'];
	$savings=$rw1['savings'];

			if($type =='deposit'){

					$qry = "INSERT INTO cash_transaction (dateReceived, timeReceived, userID, memberID,investment,creditPayment,withdrawal,deposit, ORNum) VALUES ('$dateReceived','$timeReceived', 
						'$user', '$memberID','0','0','0','$amount','$OR')";
					$dep= mysqli_query($con,$qry);

					if ($dep) {
						$newSavings=$savings+$amount;
						$sql = "UPDATE member SET savings='$newSavings' WHERE userID='$id'";

				        if ($con->query($sql) === TRUE) {
				            $message="Record updated successfully";
				        } else {
				            $message="Error updating record: " . $con->error;
				        }
						header("location:cashTransaction.php?salesNum=$OR");

					}else{
							 header("Location:cashTransaction.php?error= Sorry, Try Again.");
					}
				}

			if ($type == 'withdraw') {
				 	
					if ($savings>=$amount) {

						$qry = "INSERT INTO cash_transaction (dateReceived, timeReceived, userID, memberID,investment,creditPayment,withdrawal,deposit, ORNum) VALUES ('$dateReceived','$timeReceived', '$user', '$memberID','0','0','$amount','0',
						  '$OR')";
						$with= mysqli_query($con,$qry);

						if ($with) {
							$newSavings=$savings-$amount;
							$sql = "UPDATE member SET savings='$newSavings' WHERE memberID='$memberID'";

					        if ($con->query($sql) === TRUE) {
					            $message="Record updated successfully";
					        } else {
					            $message="Error updating record: " . $con->error;
					        }
					        
							header("location:cashTransaction.php?salesNum=$OR");
						}	

					}else{
							
						    header("Location:cashTransaction.php?error=Member doesn't have enough savings. Please try again!");
							
		}
	}
	



}

?>

