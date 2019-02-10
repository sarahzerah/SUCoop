 <?php

    include('../connect.php');
    include('../session.php');


   
    if (isset($_POST['cash'])) {

        $id=$_SESSION['userID'];
        $salesNum=$_POST['salesNum'];
        date_default_timezone_set("Asia/Manila");
        $date=date("Y-m-d");
        
        $time=date("h:i:sa");
        $totalAmount=$_POST['subtotal'];
        $cashReceived=$_POST['cashReceived'];

         if ($totalAmount==0 ) {

            header("Location:pos.php?error=Could not Complete the Transaction Try again!");
            }else if ( $cashReceived>= $totalAmount) {

         $sql1 = "INSERT INTO sales (ORNum, dateBought, timeBought, modeofPayment, totalAmount, userID) VALUES ('$salesNum','$date','$time','cash','$totalAmount','$id')";

                   $run= mysqli_query($con,$sql1);

                    header("Location:OR.php?salesNum=$salesNum&cash=$cashReceived");
            }else{

             header("Location:pos.php?salesNum=$salesNum&error=Could not Complete the Transaction Try again!");
      }
        

    }


    if(isset($_POST['credit'])) {

        $memberID = $_POST['member'];
        $user=$_SESSION['userID'];
        $total = $_POST['subtotal'];
        $salesNum = $_POST['salesNum'];
         $OR=$_SESSION['salesNum'];
        date_default_timezone_set("Asia/Manila");
        $date=date("Y-m-d");
        
        $time=date("h:i:sa");

        $sql2 = mysqli_query($con,"SELECT * FROM  member WHERE userID = '$memberID'");              
        $row = mysqli_fetch_array($sql2);
        $memberID=$row['memberID'];
        $cBal= $row['creditBalance'];
        $cLimit=$row['creditLimit'];

       if($total==0){

          header("Location:pos.php?error=Could not Complete the Transaction Try again!");

            }elseif($cLimit>=$cBal) {


           $newCBal=$cBal+$total;

            if ($cLimit >= $newCBal) {

                $sql = "INSERT INTO sales (ORNum, dateBought, timeBought, modeofPayment, totalAmount, userID, memberID) 
                                VALUES ('$salesNum','$date','$time','credit','$total','$user','$memberID')";

                $run= mysqli_query($con,$sql);
                
                    $update= mysqli_query($con, "UPDATE member SET creditBalance=$newCBal WHERE userID='$memberID'");
                        $salesNum=$_SESSION['salesNum']+1;
                        $_SESSION['salesNum']=$salesNum;
                                         header("location: pos.php?error=On Credit Payment Successful!&salesNum=$salesNum");

            } 
            else { 
                $del = "DELETE FROM items WHERE ORNum='{$_SESSION['salesNum']}'";
                $sql=mysqli_query($con,$del); 
                header("location: pos.php?error=Sorry, You Don't Have Enough Credit&salesNum=$OR");
            }
       } 

       else {header("location: pos.php?salesNum=salesNum&error=Sorry,YouAlreadyReachedYourCreditLimit&salesNum=$OR"); }

      
}

?>
          