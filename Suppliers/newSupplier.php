    <?php
    include '../connect.php';
    include '../session.php';

    if (isset($_POST['save'])) {

        $companyName=mysqli_real_escape_string($con, $_POST['companyName']);
        $address =mysqli_real_escape_string($con, $_POST['address']);
        $telephoneNum=mysqli_real_escape_string($con, $_POST['telephoneNum']); 
        $mobileNum = mysqli_real_escape_string($con,$_POST['mobileNum']);
        $salesRepresentative= mysqli_real_escape_string($con,$_POST['salesRepresentative']);
        $srContactNum= mysqli_real_escape_string($con,$_POST['srContactNum']);
        $srEmailAdd= mysqli_real_escape_string($con,$_POST['srEmailAdd']);
        $bankName= mysqli_real_escape_string($con,$_POST['bankName']);
        $accountName= mysqli_real_escape_string($con,$_POST['accountName']); 
        $accountNum = mysqli_real_escape_string($con,$_POST['accountNum']);
        $consignor=$_POST['consignor'];
        $user=$_SESSION['userID'];
        

        $sql = "INSERT INTO supplier (companyName, address, telephoneNum, mobileNum, salesRepresentative, srContactNum, srEmailAdd, bankName, accountName, accountNum,status, userID, consignor)

         VALUES ('$companyName','$address','$telephoneNum','$mobileNum','$salesRepresentative','$srContactNum','$srEmailAdd', 
        '$bankName', '$accountName','$accountNum','active','$user', '$consignor')";

        if ($con->query($sql) === TRUE) {
            echo "New record created successfully";
            $_SESSION['success']="true";
            
                header("Location:suppliersList.php?success=Supplier Added Successfully");
        } 
        else {
            header("Location:suppliersList.php?error=Error Occured Please Try Again");
        }
    }
?>