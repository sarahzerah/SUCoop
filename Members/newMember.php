    <?php
    include '../connect.php';
    include '../session.php';

    if (isset($_POST['Save'])) {

        
        $Membershipno = mysqli_real_escape_string($con,ucfirst($_POST['Membershipno']));
        $firstName=mysqli_real_escape_string($con, $_POST['firstName']);
        $lastName=mysqli_real_escape_string($con, $_POST['lastName']); 
        $DOB= $_POST['DOB'];
        $Homeaddress= mysqli_real_escape_string($con,$_POST['Homeaddress']);
        $OfficeTellMobileno= mysqli_real_escape_string($con,$_POST['OfficeTellMobileno']);
        $Mobileno= mysqli_real_escape_string($con,$_POST['Mobileno']);
        $Email = mysqli_real_escape_string($con,$_POST['Email']);
        $Estatehouse= mysqli_real_escape_string($con,$_POST['Estatehouse']);
        $Lived= mysqli_real_escape_string($con,$_POST['Lived']);
        $RentOwned= mysqli_real_escape_string($con,$_POST['RentOwned']);
        $Employer = mysqli_real_escape_string($con,$_POST['Employer']);
        $Physicaladress= mysqli_real_escape_string($con,$_POST['Physicaladress']);
        $Postaddress= mysqli_real_escape_string($con,$_POST['Postaddress']);
        $Disignation= mysqli_real_escape_string($con,$_POST['Disignation']);
        $Staffno = mysqli_real_escape_string($con,$_POST['Staffno']);
        $EmpTerms= mysqli_real_escape_string($con,$_POST['EmpTerms']);
        $Accountname= mysqli_real_escape_string($con,$_POST['Accountname']);
        $Accountnumber = mysqli_real_escape_string($con,$_POST['Accountnumber']);
        $Branchename= mysqli_real_escape_string($con,$_POST['Branchename']);
        $Branchecode= mysqli_real_escape_string($con,$_POST['Branchecode']);
        $Loantype= mysqli_real_escape_string($con,$_POST['Loantype']);
        $Amount = mysqli_real_escape_string($con,$_POST['Amount']);
        $Purposeloan = mysqli_real_escape_string($con,$_POST['Purposeloan']);


        $dateCreated=date("Y-m-d");
        //username and password is auto generated when adding new member. 
        $username = $firstName[0].$middleName[0].$lastName;
        $password = md5($birthDate);
        

        $sql = "INSERT INTO user (Membershipno, Firstname, Lastname, IdPassport, DOB, Homeaddress, OfficeTell, Mobileno, Pinno,
                                    Email, Town, Estatehouse, Lived, RentOwned, Employer, Physicaladress, Postaddress, Disignation, Staffno,
                                        EmpTerms, Accountname, Accountnumber, Branchename, Branchecode,Loantype, Amount, Purposeloan)

                 VALUES ('$Membershipno', '$Firstname', '$Lastname', '$IdPassport', '$DOB', '$Homeaddress', '$OfficeTell', '$Mobileno', 
                 '$Pin_No', '$Email', '$Town', '$Estatehouse', '$Lived', '$RentOwned', '$Employer', '$Physicaladress', '$Postaddress', 
                 '$Disignation', '$Staffno', '$EmpTerms', '$Accountname', '$Accountnumber', '$Branchename', '$Branchecode', '$Loantype', '$Amount', '$Purposeloan')";


        if ($con->query($sql) === TRUE) {
            echo "New record created successfully";
            $_SESSION['success']="true";
            $sql2="SELECT * FROM member ORDER BY Membershipno DESC LIMIT 1";
            $run= mysqli_query($con, $sql2);
            $rows= mysqli_fetch_array($run);
            $Membershipno=$rows['Membershipno'];

            $sql3 = "INSERT INTO member (Membershipno, status) VALUES ('$Membershipno', 'active')";
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
        header("Location:membersList.php");
?>