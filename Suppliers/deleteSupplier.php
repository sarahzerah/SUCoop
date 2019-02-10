<?php
    include '../connect.php';

    if (isset($_POST['delete'])) {
        
        $delete= $_POST['delete'];
        $comment= $_POST['commment'];
        $sql = "UPDATE supplier SET status='inactive' WHERE supplierID='$delete'";
        if ($con->query($sql) === TRUE) {
         header("Location:suppliersList.php?success= User deleted successfully ");      
        }
    }
  
?>