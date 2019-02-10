<?php

	include '../connect.php';

	if (isset($_POST['submit'])) {


		 $salesNum = $_POST['salesNum'];
		  $productNum = $_POST['product'];
        $quantity= $_POST['qty'];
          $sql="SELECT * FROM inventory WHERE productNum='$productNum'";
        $qry=mysqli_query($con,$sql);
		$row = mysqli_fetch_array($qry);
         $pQty=$row['quantity'];
         $itemName=ucwords($row['itemName']);
         $unit=ucwords($row['unit']);
   

       if ($quantity <= $pQty || $unit!='serving') {
     	
	    	$newQty=$pQty-$quantity;
	   
	        $i="SELECT * FROM items WHERE ORNum = '$salesNum' AND productNum= '$productNum'";
		    $q=mysqli_query($con,$i);
		    $s=0;
       
       if(mysqli_num_rows($q) == 0){ 
		
			$sql1 = "INSERT INTO items (quantity, productNum, ORNum) VALUES ('$quantity', '$productNum', '$salesNum')";

			if ($con->query($sql1) === TRUE) {

			   header("Location:pos.php?salesNum=$salesNum");

			    $sql2 = "UPDATE inventory SET quantity='$newQty' WHERE productNum='$productNum'";

		        if ($con->query($sql2) === TRUE) {

		            $message="Record updated successfully";
		            
		        } else {
		            $message="Error updating record: " . $con->error;
		        }
		} 
		else {
		    echo "Error: " . $sql1 . "<br>" . $con->error;
		}
	    
	    }else{
	    	
	    	while($grows=mysqli_fetch_array($q))
            	$s=$quantity + $grows['quantity'];
        	mysqli_query($con,"UPDATE items SET  quantity='$s' WHERE ORNum='$salesNum' AND productNum='$productNum'");

        	header("Location:pos.php?salesNum=$salesNum");
	    }

	}else{

	   header("Location:pos.php?error=$pQty pcs $itemName left in stock.");	
	}


	}
?>