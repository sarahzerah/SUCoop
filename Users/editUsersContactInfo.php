<?php
    include '../connect.php';

    if (isset($_POST['save'])) {

        $emailAdd=$_POST['emailAdd'];
        $contactNum=$_POST['contactNum'];
        $contactNum2=$_POST['contactNum2'];
        $currentAddress=$_POST['currentAddress'];
        $userid=$_POST['id'];

        $sql = "UPDATE user SET emailAdd='$emailAdd', contactNum='$contactNum', contactNum2='$contactNum2', currentAddress='$currentAddress' WHERE userID='$userid'";

        if ($con->query($sql) === TRUE) {
             header("Location:viewUsersProfile.php?success= Record was updated successfully ");

        } else {
           header("Location:viewUsersProfile.php?error= Error!!! ");

        }
    }
?>