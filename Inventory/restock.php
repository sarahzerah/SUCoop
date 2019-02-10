<?php
	include('../connect.php');
    include('../functions.php');
	
	$productNum=$_POST['productNum'];
	$quantity=$_POST['quantity'];
    $supplierID=$_POST['supplierID'];
    $orderNum=$_POST['orderNum'];
    
    date_default_timezone_set("Asia/Manila");
    $date=date("Y-m-d");
    $time=date("h:i:sa");
    $userID=$_SESSION['userID'];

    //select the product to be restocked
    $getQty = mysqli_query($con,"SELECT * FROM  ordered_items WHERE  orderNum = '$orderNum'");              
    $rr = mysqli_fetch_array($getQty);
    $qty = $rr['quantity'];
    $on = $rr['orderNum'];
    $qty = $rr['quantity'];
    $lck = $rr['lacking'];
    if ($qty>=$quantity) {
        $newQty=$qty-$quantity;

    //select the product to be restocked
    $toberestocked = mysqli_query($con,"SELECT * FROM  inventory WHERE  productNum = '$productNum'");              
    $row = mysqli_fetch_array($toberestocked);
    $availableQty = $row['quantity'];
    $unit=$row['unit'];
    $newQuantity=$availableQty+$quantity;
    $originalPrice=$row['originalPrice'];
    $totalAmount=$originalPrice*$quantity;

    if ($qty>$quantity) {
        $lacking=$qty-$quantity;
        $d=formatDate($date);
    $comment="Received $quantity on $d. Lacking $lacking more.";
    mysqli_query($con,"UPDATE ordered_items SET comment='$comment' WHERE orderNum='$orderNum'");

    mysqli_query($con,"UPDATE inventory SET status='lacking' WHERE productNum='$productNum'");

    mysqli_query($con,"UPDATE ordered_items SET lacking= '$lacking' WHERE productNum='$productNum'");
}      

 if ($lck==$quantity){
        //update product status
           
            $date=formatDate($date);
            $comment="Orders Completely Received on $d"; 
    mysqli_query($con,"UPDATE ordered_items SET comment='$comment'
       WHERE orderNum='$orderNum'");
     mysqli_query($con,"UPDATE inventory SET status='received' WHERE productNum='$productNum'");

}

    if ($qty==$quantity) 
        //update product status
            mysqli_query($con,"UPDATE inventory SET status='received' WHERE productNum='$productNum'");

    //update product quantity
	mysqli_query($con,"UPDATE inventory SET quantity='$newQuantity' WHERE productNum='$productNum'");
    
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
        if ($qty==$quantity)
        mysqli_query($con,"UPDATE inventory SET status='received' WHERE productNum='$productNum'");
        //update total in PO
        mysqli_query($con,"UPDATE goods_receipt SET totalAmount='$newTotal' WHERE GRNum='$GR'");
            
        if ($run2)
            header("location:viewRestocked.php?success=Product Successfully Restocked.");
        
    }

    //if there are orders in the purchase order for that supplier already on that day
    else {
        $recordRestock = "INSERT INTO goods_receipt (dateRestocked, timeRestocked, totalAmount, userID, supplierID) VALUES ('$date', '$time', '$totalAmount','$userID','$supplierID')";
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

            if (isset($lacking))
                mysqli_query($con,"UPDATE inventory SET status='lacking' WHERE productNum='$productNum'");
            else

            //update product status
            mysqli_query($con,"UPDATE inventory SET status='received' WHERE productNum='$productNum'");
            
            if ($run1)
                header("location:viewRestocked.php?success=Product Successfully Restocked.");
        }
        else 
            header("location:viewRestocked.php?error=Restocking Unsuccessful.");

    }
}
	else {
        $additional=$quantity-$qty;
        $comment="Received $additional more.";
        mysqli_query($con,"UPDATE ordered_items SET comment='$comment' WHERE orderNum='$orderNum'");
        header("location:viewRestocked.php?Success=Product Successfully Restocked.");
    }
?>