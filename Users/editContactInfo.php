<?php 
if (isset($_POST['save'])) {
   include '../connect.php';
    $userID=$_POST['id'];
    $emailAdd=$_POST['emailAdd'];
    $contactNum=$_POST['contactNum'];
    $contactNum2=$_POST['contactNum2'];
    $currentAddress=$_POST['currentAddress'];

    $update = "UPDATE user SET currentAddress='$currentAddress', contactNum='$contactNum', contactNum2='$contactNum2', emailAdd='$emailAdd' WHERE userID='$userID'";
    $run = mysqli_query($con, $update);

    if($run){
         header("Location:usersProfile.php?success= Record was updated successfully ");
    }else{
         header("Location:usersProfile.php?error= Error! Try again ");
    }
  }  
?>