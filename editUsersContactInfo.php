<?php
    include '../connect.php';

    if (isset($_POST['submit'])) {
        $emailAdd=$_POST['emailAdd'];
        $contactNum=$_POST['contactNum'];
        $currentAddress=$_POST['currentAddress'];
        $sql = "UPDATE user SET emailAdd='$emailAdd', contactNum='$contactNum', currentAddress='$currentAddress' WHERE userID='{$_POST['submit']}'";

        if ($con->query($sql) === TRUE) {

             header("Location:viewUsersProfile.php?success= Record was updated successfully ");

        } else {

           header("Location:viewUsersProfile.php?error= Error!!! ");

        }
    }
?>