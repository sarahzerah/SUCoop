<?php
    include '../connect.php';

    if (isset($_POST['delete'])) {
        
        $delete= $_POST['delete'];
        $comment= $_POST['comment'];
        date_default_timezone_set("Asia/Manila");
        $date=date("Y-m-d");
        $sql = "UPDATE user SET status='inactive', comment='$comment', dateRemoved='$date' WHERE userID='$delete'";
        if ($con->query($sql) === TRUE) {
         header("Location:usersList.php?success= User deleted successfully ");      
        } 
    }
    if (isset($_POST['cancel'])) {
         header("Location:usersList.php");
    }
?>