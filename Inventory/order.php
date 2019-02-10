<?php
	include '../connect.php';
    include '../session.php';
	
	$productNum=$_POST['productNum'];
	$quantity=$_POST['quantity'];
    $supplier=$_POST['supplier'];
    $date=date("Y-m-d");
    date_default_timezone_set("Asia/Manila");
    $time=date("h:i:sa");
    $user=$_SESSION['userID'];

    //select the product to be restocked
    $tobeordered = mysqli_query($con,"SELECT * FROM  inventory WHERE  productNum = '$productNum'");              
    $row = mysqli_fetch_array($tobeordered);
    $originalPrice=$row['originalPrice'];
    $totalAmount=$originalPrice*$quantity;
    $item=$row['itemName'];

    //check if that supplier is already in the PO on that day
    $checkPO ="SELECT * FROM  purchase_order WHERE  supplierID ='$supplier' AND dateOrdered='$date'";
    $checkPOqry=mysqli_query($con,$checkPO);

    //if there is existing orders for that supplier
    if (mysqli_num_rows($checkPOqry) > 0 ) {

        $r= mysqli_fetch_array($checkPOqry);
        $PO=$r['PONum'];
        $amount=$r['totalAmount'];
        $newTotal=$amount+$totalAmount;

        $existing="SELECT * FROM ordered_items WHERE productNum='$productNum' AND PONum='$PO'";
        $existingqry=mysqli_query($con,$existing);
        $rowx = mysqli_fetch_array($existingqry);

        if (mysqli_num_rows($existingqry) > 0 ) {
            $orderNum=$rowx['orderNum'];
            $qty=$rowx['quantity'];
            $newQty=$qty+$quantity;

        mysqli_query($con,"UPDATE ordered_items SET quantity='$newQty' WHERE orderNum='$orderNum'");
        
            header("location:inventory.php?success=$item Successfully Ordered.");
        }
        else {


        //add item to ordered_items
        $addOrder = "INSERT INTO ordered_items (quantity, productNum, PONum) VALUES ('$quantity', '$productNum', '$PO')";
        $run2 = mysqli_query($con,$addOrder);

        if ($run2)
            header("location:inventory.php?success=Product Successfully Ordered.");
    }

        //update product status
        mysqli_query($con,"UPDATE inventory SET status='ordered' WHERE productNum='$productNum'");

        //update total in PO
        mysqli_query($con,"UPDATE purchase_order SET totalAmount='$newTotal' WHERE PONum='$PO'");
            
        
        
    }

    //if there are no orders yet in the purchase order for that supplier on that day
    else {
        $recordOrder = "INSERT INTO purchase_order (dateOrdered, timeOrdered, totalAmount, userID, supplierID) VALUES ('$date', '$time', '$totalAmount','$user','$supplier')";
        $run = mysqli_query($con,$recordOrder);
    
        if ($run) {

            //get the last PO number
            $getLastPO="SELECT * FROM purchase_order ORDER BY PONum DESC LIMIT 1";
            $getLastPOqry= mysqli_query($con, $getLastPO);
            $rows5= mysqli_fetch_array($getLastPOqry);
            $PONum=$rows5['PONum'];

            //add item to ordered_items
            $addOrder = "INSERT INTO ordered_items (quantity, productNum, PONum) VALUES ('$quantity', '$productNum', '$PONum')";
            $run1 = mysqli_query($con,$addOrder);

            //update product status
            mysqli_query($con,"UPDATE inventory SET status='ordered' WHERE productNum='$productNum'");
            
            if ($run1)
                header("location: inventory.php?success=$item Successfully Ordered.");
        }
        else 
            header("location: inventory.php?error=Order Unsuccessful.");

    }
	
?>