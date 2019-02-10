<?php

	include '../connect.php';
	include '../session.php';

	if (isset($_POST['submit'])) {

		$itemName=$_POST['itemName'];
		$unit=$_POST['unit'];
		$category=$_POST['category'];
		$supplier=$_POST['supplier'];
	  	$quantity=$_POST['quantity'];
	  	$consignment=$_POST['consignment'];
		$originalPrice=$_POST['originalPrice'];
	   	$SRP=$_POST['SRP'];
	   	$userID=$_SESSION['userID'];
	   	$date=date("Y-m-d");
        date_default_timezone_set("Asia/Manila");
        $time=date("h:i:sa");
        $totalAmount=$originalPrice*$quantity;


       if($unit=='serving'){
            if ($category!='viand' && $category!='snack')
                header("location:inventory.php?error=Please select the correct unit. Serving is only valid for snack or viand category.");
            else {

       if(($category =='viand') && ($unit=='serving')){
              $quantity= 0; 
            }else{
             $quantity=$_POST['quantity'];
             }


        $seeproducts="SELECT * FROM inventory WHERE itemName='$itemName'";
        $seeprod= mysqli_query($con, $seeproducts);
        $rows2= mysqli_fetch_array($seeproducts);

        if (mysqli_num_rows($seeprod) > 0 ) {
            header("location:inventory.php?error=Item Name already exist. Please include any description such as size, color, etc.");
        }

        else {

        //if SRP is greater than original price, directly add in the database
        if ($SRP > $originalPrice) {
            $addProduct = "INSERT INTO inventory (itemName,category,unit,originalPrice,SRP,quantity,consignment,userID, status, supplierID) VALUES ('$itemName','$category','$unit', '$originalPrice','$SRP','$quantity','$consignment','$userID', 'received', '$supplier')";
            $added= mysqli_query($con,$addProduct);
        }

        //select the last value of productNum since this will be the first initial restock/GR for this product
        $getLastProdNum="SELECT * FROM inventory ORDER BY productNum DESC LIMIT 1";
        $getLastProdNumqry= mysqli_query($con, $getLastProdNum);
        $rows= mysqli_fetch_array($getLastProdNumqry);
        $productNum = $rows['productNum'];

         if ($added) {

            //check if product is already restocked on that day
    $checkGR ="SELECT * FROM  goods_receipt WHERE  supplierID ='$supplierID' AND dateRestocked='$date'";
    $checkGRqry=mysqli_query($con,$checkGR);  

    //if orders are received from that supplier
   if (mysqli_num_rows($checkGRqry) > 0 ) {

        $r= mysqli_fetch_array($checkGRqry);
        $GR=$r['GRNum'];
        $amount=$r['totalAmount'];
        $newTotal=$amount+$totalAmount;

        //add item to ordered_items
        $addOrder = "INSERT INTO restocked_items (quantity, productNum, GRNum) VALUES ('$quantity', '$productNum', '$GR')";
        $run2 = mysqli_query($con,$addOrder);

        //update product status
        mysqli_query($con,"UPDATE inventory SET status='received' WHERE productNum='$productNum'");

        //update total in PO
        mysqli_query($con,"UPDATE goods_receipt SET totalAmount='$newTotal' WHERE GRNum='$GR'");
            
        if ($run2)
            header("location:inventory.php?success=Product Successfully Added.");
        
    }
    else {
            $recordRestock = "INSERT INTO goods_receipt (dateRestocked, timeRestocked, totalAmount, userID, supplierID) VALUES ('$date', '$time', '$totalAmount','$userID','$supplier')";
            $run = mysqli_query($con,$recordRestock);
    
            if ($run) {

                //get the last GR number
                $getLastGR="SELECT * FROM goods_receipt ORDER BY GRNum DESC LIMIT 1";
                $getLastGRqry= mysqli_query($con, $getLastGR);
                $rows5= mysqli_fetch_array($getLastGRqry);
                $GRNum=$rows5['GRNum'];

                //add item to ordered_items
                $addRestocked = "INSERT INTO restocked_items (quantity, productNum, GRNum) VALUES ('$quantity', '$productNum', '$GRNum')";
                $run1 = mysqli_query($con,$addRestocked);

                //update product status
                mysqli_query($con,"UPDATE inventory SET status='received' WHERE productNum='$productNum'");
                
                if ($run1)
                    
                    header("location:inventory.php?success=$itemName Successfully Added."); 
        }

        }
    }

else {
            header("Location:inventory.php?error=Selling Price should be greater than the Item Cost. Please try again."); 
        }
}

            }
        }

        else {
       
       if(($category =='viand') && ($unit=='serving')){
              $quantity= 0; 
            }else{
             $quantity=$_POST['quantity'];
             if ($quantity<1)
                 header("location:inventory.php?error=Quantity should be greater than  zero. Please try again.");
             }


        $seeproducts="SELECT * FROM inventory WHERE itemName='$itemName'";
        $seeprod= mysqli_query($con, $seeproducts);
        $rows2= mysqli_fetch_array($seeproducts);

        if (mysqli_num_rows($seeprod) > 0 ) {
            header("location:inventory.php?error=Item Name already exist. Please include any description such as size, color, etc.");
        }

        else {

        //if SRP is greater than original price, directly add in the database
        if ($SRP > $originalPrice) {
            $addProduct = "INSERT INTO inventory (itemName,category,unit,originalPrice,SRP,quantity,consignment,userID, status, supplierID) VALUES ('$itemName','$category','$unit', '$originalPrice','$SRP','$quantity','$consignment','$userID', 'received', '$supplier')";
	        $added= mysqli_query($con,$addProduct);
        }

        //select the last value of productNum since this will be the first initial restock/GR for this product
	    $getLastProdNum="SELECT * FROM inventory ORDER BY productNum DESC LIMIT 1";
       	$getLastProdNumqry= mysqli_query($con, $getLastProdNum);
        $rows= mysqli_fetch_array($getLastProdNumqry);
        $productNum = $rows['productNum'];

         if ($added) {

         	//check if product is already restocked on that day
    $checkGR ="SELECT * FROM  goods_receipt WHERE  supplierID ='$supplierID' AND dateRestocked='$date'";
    $checkGRqry=mysqli_query($con,$checkGR);  

    //if orders are received from that supplier
   if (mysqli_num_rows($checkGRqry) > 0 ) {

        $r= mysqli_fetch_array($checkGRqry);
        $GR=$r['GRNum'];
        $amount=$r['totalAmount'];
        $newTotal=$amount+$totalAmount;

        //add item to ordered_items
        $addOrder = "INSERT INTO restocked_items (quantity, productNum, GRNum) VALUES ('$quantity', '$productNum', '$GR')";
        $run2 = mysqli_query($con,$addOrder);

        //update product status
        mysqli_query($con,"UPDATE inventory SET status='received' WHERE productNum='$productNum'");

        //update total in PO
        mysqli_query($con,"UPDATE goods_receipt SET totalAmount='$newTotal' WHERE GRNum='$GR'");
            
        if ($run2)
            header("location:inventory.php?success=$itemName Successfully Added.");
        
    }
    else {
	    	$recordRestock = "INSERT INTO goods_receipt (dateRestocked, timeRestocked, totalAmount, userID, supplierID) VALUES ('$date', '$time', '$totalAmount','$userID','$supplier')";
        	$run = mysqli_query($con,$recordRestock);
    
	        if ($run) {

	            //get the last GR number
	            $getLastGR="SELECT * FROM goods_receipt ORDER BY GRNum DESC LIMIT 1";
	            $getLastGRqry= mysqli_query($con, $getLastGR);
	            $rows5= mysqli_fetch_array($getLastGRqry);
	            $GRNum=$rows5['GRNum'];

	            //add item to ordered_items
	            $addRestocked = "INSERT INTO restocked_items (quantity, productNum, GRNum) VALUES ('$quantity', '$productNum', '$GRNum')";
	            $run1 = mysqli_query($con,$addRestocked);

	            //update product status
	            mysqli_query($con,"UPDATE inventory SET status='received' WHERE productNum='$productNum'");
	            
	            if ($run1)

	                header("location:inventory.php?success=$itemName Successfully Added."); 
        }

        }
	}

else {
            header("Location:inventory.php?error=Selling Price should be greater than the Item Cost. Please try again."); 
        }
}
}
}
?>