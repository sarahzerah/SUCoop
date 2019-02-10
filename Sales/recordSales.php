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

        $sql2="SELECT * FROM items ORDER BY ORNum DESC LIMIT 1";
                $run2= mysqli_query($con, $sql2);
                $rows= mysqli_fetch_array($run2);
                $c=$rows['ORNum'];
                $salesNum=$c;

        
       if($totalAmount==0){

          header("Location: pos.php?error=No Items selected, Please add item(s).");

            }elseif ( $cashReceived>= $totalAmount) {

         $sql1 = "INSERT INTO cash_sales (ORNum, dateBought, timeBought, totalAmount, userID) VALUES ('$salesNum',
         '$date','$time','$totalAmount','$id')";

                   $run= mysqli_query($con,$sql1);

                    header("Location: OR.php?salesNum=$salesNum&cash=$cashReceived");
            }else{

            header("Location: pos.php?salesNum=$salesNum&error=There is not enough cash. Please try again.");
      }
        

    }




    if(isset($_POST['credit'])) {

        $memberID = $_POST['member'];
        $user=$_SESSION['userID'];
        $total = $_POST['subtotal'];
        $salesNum = $_POST['salesNum'];
        date_default_timezone_set("Asia/Manila");
        $date=date("Y-m-d");
        $time=date("h:i:sa");

        $sql2 = mysqli_query($con,"SELECT * FROM  member WHERE userID = '$memberID'");              
        $row = mysqli_fetch_array($sql2);
        $memberID=$row['memberID'];
        $investment=$row['investment'];
        $cBal= $row['creditBalance'];
        $cLimit=$row['creditLimit'];

        

       if($total==0){

          header("Location:pos.php?error=There are no items selected. Please add items.");

       }
        $invest=$row['investment'];
       if ($invest == 0){
         header("location: pos.php?error=Member do not have credit.");
          }
           
        if($cLimit>$cBal && $cLimit!=$cBal) {


           $newCBal=$cBal+$total;

            if ($cLimit >= $newCBal) {

                $sql = "INSERT INTO charge_invoice (chargeInvoiceNum, dateBought, timeBought, totalAmount, userID, memberID) 
                                             VALUES ('$chargeInvoiceNum','$date','$time', '$total','$user','$memberID')";
 
                $run= mysqli_query($con,$sql);

                $sql2="SELECT * FROM charge_invoice ORDER BY chargeInvoiceNum DESC LIMIT 1";
                $run2= mysqli_query($con, $sql2);
                $rows= mysqli_fetch_array($run2);
                $chargeInvoiceNum=$rows['chargeInvoiceNum'];
              

                    mysqli_query($con,"UPDATE items SET ORNum='0', chargeInvoiceNum='$chargeInvoiceNum' WHERE ORNum='$salesNum'");

                     $update= mysqli_query($con, "UPDATE member SET creditBalance='$newCBal' 
                      
                      WHERE memberID='$memberID'");

                        
              header("location: OR_credit.php?chargeInvoiceNum=$chargeInvoiceNum");

            } 
            else { 
                
                $sql=mysqli_query($con,$del); 
                header("location: pos.php?error=Total amount goes beyond credit limit. Only cash payment allowed.");
            }
       } else {

        if($investment==0){

          header("Location:pos.php?error=Member doesn't have Share Capital yet. Only cash payment allowed.");

       }
       else
        header("location: pos.php?error=Member Already Reached His/Her Credit Limit."); } 

}
?>
          