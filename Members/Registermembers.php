    <?php
    include '../connect.php';
    include '../session.php';

    if (isset($_POST['Save'])) {

        $firstName=mysqli_real_escape_string($con, $_POST['firstName']);
        $middleName =mysqli_real_escape_string($con, $_POST['middleName']);
        $lastName=mysqli_real_escape_string($con, $_POST['lastName']); 
        $civilStatus = mysqli_real_escape_string($con,ucfirst($_POST['civilStatus']));
        $birthDate= $_POST['birthDate'];
        $homeAddress= mysqli_real_escape_string($con,$_POST['homeAddress']);
        $currentAddress= mysqli_real_escape_string($con,$_POST['currentAddress']);
        $contactNum= mysqli_real_escape_string($con,$_POST['contactNum']);
        if ($_POST['contactNum2'] == ""){
        $contactNum2= mysqli_real_escape_string($con,$_POST['contactNum2']); 
        }
        $emailAdd = mysqli_real_escape_string($con,$_POST['emailAdd']);
        $dateCreated=date("Y-m-d");
        //username and password is auto generated when adding new member. 
        $username = $firstName[0].$middleName[0].$lastName;
        $password = md5($birthDate);
        

        $sql = "INSERT INTO user (firstName, middleName, lastName, civilStatus, birthDate, homeAddress, currentAddress, role, contactNum, contactNum2, emailAdd, username, password,picture, status, dateCreated) VALUES ('$firstName','$middleName','$lastName','$civilStatus','$birthDate','$homeAddress','$currentAddress',
        'member',  '$contactNum','$contactNum2','$emailAdd','$username', '$password','default.jpg','active', '$dateCreated')";


        if ($con->query($sql) === TRUE) {
            echo "New record created successfully";
            $_SESSION['success']="true";
            $sql2="SELECT * FROM user ORDER BY userID DESC LIMIT 1";
            $run= mysqli_query($con, $sql2);
            $rows= mysqli_fetch_array($run);
            $userID=$rows['userID'];

            $sql3 = "INSERT INTO member (userID, status) VALUES ('$userID', 'active')";
            if ($con->query($sql3) === TRUE)
                header("Location:membershiplist.php");
              
            else
                echo "success: " . $sql3 . "<br>" . $con->error;
        } 
        else {
            echo "Error: " . $sql . "<br>" . $con->error;
        }
        }
        else
        header("Location:membersiplist.php");
?>