<?php

	include('../connect.php');
	include('../session.php');

	//if investment
if (isset($_POST['submit'])) {
	
    $type= $_POST['transaction'];

    if (!isset($_SESSION['memberID'])) {
		$id = $_POST['member'];
		$_SESSION['memberID']=$id;
	}
	$amount = $_POST['amount'];
	$user=$_SESSION['userID'];
	date_default_timezone_set("Asia/Manila");
	$dateReceived=date("Y-m-d");
	$id=$_SESSION['memberID'];

	$timeReceived=date("h:i:sa");
	$transactionNum=$_SESSION['transactionNum'];
	

	//check if that transactionNum is already in the cash_transaction on that day
    $checkTN ="SELECT * FROM  cash_transaction WHERE  transactionNum ='$transactionNum'";
    $checkTNqry=mysqli_query($con,$checkTN);

    if (mysqli_num_rows($checkTNqry) > 0 ) {

			if ($type =='investment') {

		        $query1="SELECT * FROM member WHERE userID='$id'";
		        $qry1=mysqli_query($con,$query1);
		        $rw1=mysqli_fetch_array($qry1);
		        $memberID=$rw1['memberID'];
		        $investment=$rw1['investment'];

		        $query2="SELECT * FROM transaction WHERE type='investment' AND transactionNum='$transactionNum'";
		        $qry2=mysqli_query($con,$query2);
		        $rw2=mysqli_fetch_array($qry2);
		        $tamount=$rw2['amount'];
		        $trans=$rw2['cTransactionNum'];
		        echo mysqli_num_rows($checkTNqry);

		        if(mysqli_num_rows($checkTNqry) == 0) {
				$qry = "INSERT INTO transaction (type, amount, transactionNum) VALUES ('investment','$amount', '$transactionNum')";
				$inv= mysqli_query($con,$qry);
				

				if ($inv) {
					
					
					$newInv=$investment+$amount;
					$creditLimit =$newInv * 2;

					$sql = "UPDATE member SET creditLimit='$creditLimit', investment='$newInv' WHERE userID='$id'";

			        if ($con->query($sql) === TRUE) {
			            $message="Record updated successfully";
			        } else {
			            $message="Error updating record: " . $con->error;
			        }
					header("location:cashTransaction.php");

					}else{
						echo "Error!";
					}
				}

		        
		        else {
		        	$newInv=$investment+$amount;
		        	$newAmount=$tamount+$amount;
		        	$creditLimit =$newInv * 2;
		        	mysqli_query($con,"UPDATE transaction SET amount='$newAmount' WHERE cTransactionNum='$trans'");

		        	mysqli_query($con,"UPDATE member SET creditLimit='$creditLimit', investment='$newInv' WHERE userID='$id'");
		        	header("location:cashTransaction.php");
		        }

		        
				/////////////////////////

			 }// end of investment

				

				//cpayment 

			if ($type =='cpayment'){
		     /////////////////////////////////
		          $query1="SELECT * FROM member WHERE userID='$id'";
		            $qry1=mysqli_query($con,$query1);
		            $rw1=mysqli_fetch_array($qry1);
		            $memberID=$rw1['memberID'];
		            $cBalance=$rw1['creditBalance'];

		         if ($cBalance==0)
		         	header("location: cashTransaction.php?page=recordCPayment&error=Member has no credit balance yet.");

		        else if ($amount<=$cBalance) {

		        		$query2="SELECT * FROM transaction WHERE type='cpayment' AND transactionNum='$transactionNum'";
				        $qry2=mysqli_query($con,$query2);
				        $rw2=mysqli_fetch_array($qry2);
				        $tamount=$rw2['amount'];
				        $trans=$rw2['cTransactionNum'];

				        if (mysqli_num_rows($checkTNqry) == 0 ) {
						$qry = "INSERT INTO transaction (type, amount, transactionNum) VALUES ('$type','$amount', '$transactionNum')";
						$cp= mysqli_query($con,$qry);
						
						if ($cp) {
							

							
							$newCBal=$cBalance-$amount ;

							$sql = "UPDATE member SET creditBalance='$newCBal' WHERE userID='$id'";
					        if ($con->query($sql) === TRUE) {
					            //$message="Record updated successfully";
					          header("location:cashTransaction.php");
					        } else {
					            $message="Error updating record: " . $con->error;
					        }
							

						}else{
								echo "Error!";
						}
					}

				        else {
				        	$newCBal=$cBalance-$amount ;
				        	$newAmount=$tamount+$amount;
				        	
				        	mysqli_query($con,"UPDATE transaction SET amount='$newAmount' WHERE cTransactionNum='$trans'");

				        	mysqli_query($con,"UPDATE member SET creditBalance='$newCBal' WHERE userID='$id'");
				        	header("location:cashTransaction.php");
				        }
				        
				        
					

				} //close of else if
				else {

					$query2="SELECT * FROM transaction WHERE type='cpayment' AND transactionNum='$transactionNum'";
			        $qry2=mysqli_query($con,$query2);
			        $rw2=mysqli_fetch_array($qry2);
			        $tamount=$rw2['amount'];
			        $trans=$rw2['cTransactionNum'];

			        if (mysqli_num_rows($checkTNqry) == 0 ) {
						$qry = "INSERT INTO transaction (type, amount, transactionNum) VALUES ('$type','$amount', '$transactionNum')";
						$cp= mysqli_query($con,$qry);
						
						if ($cp) {
							$change=$cBalance-$amount;
							$newCBal=0;


							$sql = "UPDATE member SET creditBalance='$newCBal' WHERE userID='$id'";
					        if ($con->query($sql) === TRUE) {
					            //$message="Record updated successfully";
					          header("location:cashTransaction.php");
					        } else {
					            $message="Error updating record: " . $con->error;
					        }

						}else{
								echo "Error!";
						}
				}
			        
			        else {
			        	$newCBal=$cBalance-$amount ;
			        	$newAmount=$tamount+$amount;
			        	
			        	mysqli_query($con,"UPDATE transaction SET amount='$newAmount' WHERE cTransactionNum='$trans'");

			        	mysqli_query($con,"UPDATE member SET creditBalance='$newCBal' WHERE userID='$id'");
			        	header("location:cashTransaction.php");
			        }
			        
			        
			}
		      ////////////////////////////
		      
			}
		      
		// savings....................


			$query1="SELECT * FROM member WHERE userID='$id'";
		    $qry1=mysqli_query($con,$query1);
		    $rw1=mysqli_fetch_array($qry1);
		    $memberID=$rw1['memberID'];
			$savings=$rw1['savings'];

					if($type =='deposit'){
						$query2="SELECT * FROM transaction WHERE type='deposit' AND transactionNum='$transactionNum'";
				        $qry2=mysqli_query($con,$query2);
				        $rw2=mysqli_fetch_array($qry2);
				        $tamount=$rw2['amount'];
				        $trans=$rw2['cTransactionNum'];
		                  //////////////////////////////
						if (mysqli_num_rows($checkTNqry) == 0 ) {
		                   $qry = "INSERT INTO transaction (type, amount, transactionNum) VALUES ('$type','$amount', '$transactionNum')";
							$dep= mysqli_query($con,$qry);

							if ($dep) {
								$newSavings=$savings+$amount;
								$sql = "UPDATE member SET savings='$newSavings' WHERE userID='$id'";

						        if ($con->query($sql) === TRUE) {
						            $message="Record updated successfully";
						        } else {
						            $message="Error updating record: " . $con->error;
						        }
								header("location:cashTransaction.php");

							}else{
									 header("Location:cashTransaction.php?error= Sorry, Try Again.");
							}
						//////////////////////////////////
						}

						else {
				        	$newSavings=$savings+$amount;
				        	$newAmount=$tamount+$amount;
				        	
				        	mysqli_query($con,"UPDATE transaction SET amount='$newAmount' WHERE cTransactionNum='$trans'");

				        	mysqli_query($con,"UPDATE member SET savings='$newSavings' WHERE userID='$id'");
				        	header("location:cashTransaction.php");
			        }
			    }



					if ($type == 'withdrawal') {

						//////////////////////////////
		                if ($savings>=$amount) {

								$qry = "INSERT INTO transaction (type, amount, transactionNum) VALUES ('$type','$amount', '$transactionNum')";
								$with= mysqli_query($con,$qry);

								if ($with) {
									$newSavings=$savings-$amount;
									$sql = "UPDATE member SET savings='$newSavings' WHERE memberID='$memberID'";

							        if ($con->query($sql) === TRUE) {
							            $message="Record updated successfully";
							        } else {
							            $message="Error updating record: " . $con->error;
							        }
							        
									header("location:cashTransaction.php");
								}	

							}else{
									
								    header("Location:cashTransaction.php?page=recordSavings&error=Member doesn't have enough savings. Please try again!");
									
							}
						///////////////////////////////////
						 	
			     }
			
		   

		   else {

		   		$recordOrder = "INSERT INTO cash_transaction (transactionNum, dateReceived, timeReceived, userID, memberID, totalAmount) VALUES ('$transactionNum', '$dateReceived', '$timeReceived', '$user','$id', $amount)";
        		$run = mysqli_query($con,$recordOrder);
    
        		if ($run) {
        			if ($type =='investment') {

		        $query1="SELECT * FROM member WHERE userID='$id'";
		        $qry1=mysqli_query($con,$query1);
		        $rw1=mysqli_fetch_array($qry1);
		        $memberID=$rw1['memberID'];

				$qry = "INSERT INTO transaction (type, amount, transactionNum) VALUES ('$type','$amount', '$transactionNum')";
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
					header("location:cashTransaction.php");

					}else{
						echo "Error!";
					}
				/////////////////////////

			 }// end of investment
}
				

				//cpayment 

			if ($type =='cpayment'){
		     /////////////////////////////////
		          $query1="SELECT * FROM member WHERE userID='$id'";
		            $qry1=mysqli_query($con,$query1);
		            $rw1=mysqli_fetch_array($qry1);
		            $memberID=$rw1['memberID'];
		            $cBalance=$rw1['creditBalance'];

		         if ($cBalance==0)
		         	header("location: cashTransaction.php?page=recordCPayment&error=Member has no credit balance yet.");
		        else if ($amount<=$cBalance) {

					$qry = "INSERT INTO transaction (type, amount, transactionNum) VALUES ('$type','$amount', '$transactionNum')";
					$cp= mysqli_query($con,$qry);
					
					if ($cp) {
						

						
						$newCBal=$cBalance-$amount ;

						$sql = "UPDATE member SET creditBalance='$newCBal' WHERE userID='$id'";
				        if ($con->query($sql) === TRUE) {
				            //$message="Record updated successfully";
				          header("location:cashTransaction.php");
				        } else {
				            $message="Error updating record: " . $con->error;
				        }
						

					}else{
							echo "Error!";
					}

				}
				else {
					$qry = "INSERT INTO transaction (type, amount, transactionNum) VALUES ('$type','$amount', '$transactionNum')";
					$cp= mysqli_query($con,$qry);
					
					if ($cp) {
						$change=$cBalance-$amount;
						$newCBal=0;


						$sql = "UPDATE member SET creditBalance='$newCBal' WHERE userID='$id'";
				        if ($con->query($sql) === TRUE) {
				            //$message="Record updated successfully";
				          header("location:cashTransaction.php");
				        } else {
				            $message="Error updating record: " . $con->error;
				        }

					}else{
							echo "Error!";
					}
				}
		      ////////////////////////////
		      
			}
		      
		// savings....................


			$query1="SELECT * FROM member WHERE userID='$id'";
		    $qry1=mysqli_query($con,$query1);
		    $rw1=mysqli_fetch_array($qry1);
		    $memberID=$rw1['memberID'];
			$savings=$rw1['savings'];

					if($type =='deposit'){
		                  //////////////////////////////
		                   $qry = "INSERT INTO transaction (type, amount, transactionNum) VALUES ('$type','$amount', '$transactionNum')";
							$dep= mysqli_query($con,$qry);

							if ($dep) {
								$newSavings=$savings+$amount;
								$sql = "UPDATE member SET savings='$newSavings' WHERE userID='$id'";

						        if ($con->query($sql) === TRUE) {
						            $message="Record updated successfully";
						        } else {
						            $message="Error updating record: " . $con->error;
						        }
								header("location:cashTransaction.php");

							}else{
									 header("Location:cashTransaction.php?error= Sorry, Try Again.");
							}
						//////////////////////////////////
						}

					if ($type == 'withdrawal') {

						//////////////////////////////
		                if ($savings>=$amount) {

								$qry = "INSERT INTO transaction (type, amount, transactionNum) VALUES ('$type','$amount', '$transactionNum')";
								$with= mysqli_query($con,$qry);

								if ($with) {
									$newSavings=$savings-$amount;
									$sql = "UPDATE member SET savings='$newSavings' WHERE memberID='$memberID'";

							        if ($con->query($sql) === TRUE) {
							            $message="Record updated successfully";
							        } else {
							            $message="Error updating record: " . $con->error;
							        }
							        
									header("location:cashTransaction.php");
								}	

							}else{
									
								    header("Location:cashTransaction.php?page=recordSavings&error=Member doesn't have enough savings. Please try again!");
									
							}
						///////////////////////////////////
						 	
			     }
			 }

		   }
		   
}

?>

