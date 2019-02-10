
<?php
    include '../head.php'; 
    include '../connect.php';
    
    $userID = $_SESSION['userID'];

    $mem= "SELECT * FROM user WHERE userID='$userID'";
    $run= mysqli_query($con, $mem);
    $row= mysqli_fetch_array($run);

    $password=$row['password'];

    if (isset($_POST['submitPass'])) {
        $currentPass=$_POST['currentPass'];
        $newPass=$_POST['newPass'];
        $confirmNewPass=$_POST['confirmNewPass'];

        $currentPass=md5($currentPass);
        $newPass=md5($newPass);
        $confirmNewPass=md5($confirmNewPass);
    }

    if($currentPass!=$password) {
        header("Location:usersProfile.php?error=Current Password is incorrect");
    } elseif( $newPass!=$confirmNewPass) {
        header("Location:usersProfile.php?error= New Password doesn't match");
    } elseif( $newPass==$password) {
        header("Location:usersProfile.php?error=You are using the same password. Please try again.");
    }else{
        $update= "UPDATE user SET  password='$newPass' WHERE userID='$userID'";
        $run = mysqli_query($con, $update);
  
        if($run){

            header("Location:logout.php?success= Password was updated successfully ");
        }else{
            header("Location:usersProfile.php?error= Could not update password, Try Again!");
        }
    }
?>
 