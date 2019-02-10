 <?php
    include '../connect.php';

    if (isset($_POST['delete'])) {
        
        $comment =$_POST['comment'];
        $delete= $_POST['delete'];
        $dateRemoved=date("Y-m-d");
        $sql = "UPDATE user SET status='inactive', comment = '$comment', dateRemoved='$dateRemoved' WHERE userID='$delete'";
        if ($con->query($sql) === TRUE) {
            $sql2 = "UPDATE member SET status='inactive' WHERE userID='$delete'";
            if ($con->query($sql2) === TRUE) {
             header("Location:membersList.php?success= Member deleted successfully ");      
            }         
        } 
    }

    if (isset($_POST['cancel'])) {
       
         if (empty($_POST['role'])){
             header("Location:membersList.php");
         }
         else{
             header("Location:membersPInformation.php");
         }
    }
?>