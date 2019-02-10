<?php
// configuration
include('../connect.php');

// new data
$id= $_POST['productNum']; 
$item = $_POST['item'];
$category = $_POST['category'];
$unit = $_POST['unit'];
$quantity = $_POST['quantity'];
$consignment = $_POST['consignment'];
$price = $_POST['price'];
$srp = $_POST['srp'];
$supplier = $_POST['supplier'];



$sql = "UPDATE inventory 
        SET itemName='$item', category='$category', unit='$unit', 
        originalPrice='$price', SRP='$srp',quantity='$quantity', 
        consignment='$consignment' WHERE productNum= '$id'";

      $run=mysqli_query($con,$sql); 

   $qry= "UPDATE goods_receipt 
        SET supplierID=$supplier  WHERE productNum= '$id'";

      $rcpt=mysqli_query($con,$qry); 

  if ($run) {
           header("Location:inventory.php?success=ok");

        }
        else {
        
         header("Location:inventory.php?error=Could not Update the Product Please Try again!");
		}
?>