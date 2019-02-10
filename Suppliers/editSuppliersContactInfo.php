<?php  

    if (isset($_POST['save'])) {
        include '../connect.php';
        $supplier= $_POST['id'];
        $telephoneNum=$_POST['telephoneNum'];
        $mobileNum=$_POST['mobileNum'];
        $salesRepresentative=$_POST['salesRepresentative'];
        $srContactNum=$_POST['srContactNum'];
        $srEmailAdd=$_POST['srEmailAdd'];
        $bankName=$_POST['bankName'];
        $accountName=$_POST['accountName'];
        $accountNum=$_POST['accountNum'];

        $sql = "UPDATE supplier SET telephoneNum='$telephoneNum', mobileNum='$mobileNum', salesRepresentative='$salesRepresentative', srContactNum='$srContactNum', srEmailAdd='$srEmailAdd', accountName='$accountName', accountNum='$accountNum', bankName='$bankName' WHERE supplierID='$supplier'";

            $run = mysqli_query($con, $sql);
         if($run){

         header("Location:ViewSuppliersProfile.php?success= Record was updated successfully ");
    }else{

    header("Location:ViewSuppliersProfile.php?error= Error! Try again ");

    }

    }
?>