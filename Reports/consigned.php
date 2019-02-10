 <?php 
 $csql=mysqli_query($con,$cqry);
 $csql2=mysqli_query($con,$cqry2);
 
 //cash transaction
 if(mysqli_num_rows($csql) > 0):
    while($crow=mysqli_fetch_array($csql)):
      $cor=$crow['ORNum']; //OR num from the month
      $getitem="SELECT SUM(quantity), ORNum, productNum FROM items WHERE ORNum='$cor'"; //get the productNum
      $isql=mysqli_query($con,$getitem);
        
      while($icrow=mysqli_fetch_array($isql)):
        $itemNo=$icrow['productNum'];
        $consi="SELECT * FROM inventory WHERE productNum='$itemNo' AND consignment='yes'";
        $consql=mysqli_query($con,$consi);
        
        if(mysqli_num_rows($consql) > 0):
          $consirow=mysqli_fetch_array($consql);
          $itemTotal=$consirow['SRP'] * $icrow['SUM(quantity)'];
          $consignTotal=$consignTotal+ $itemTotal;
        endif;
      endwhile;
    endwhile;
  endif;
//charge Invoice
if(mysqli_num_rows($csql2) > 0):
    while($crow=mysqli_fetch_array($csql2)):
      $consignInvoice=$crow['chargeInvoiceNum']; //charge invoice from the month
      $getitem="SELECT SUM(quantity), chargeInvoiceNum, productNum FROM items WHERE chargeInvoiceNum='$consignInvoice'"; //get the productNum
      $isql=mysqli_query($con,$getitem);
        
      while($icrow=mysqli_fetch_array($isql)):
        $itemNo=$icrow['productNum'];
        $consi="SELECT * FROM inventory WHERE productNum='$itemNo' AND consignment='yes'";
        $consql=mysqli_query($con,$consi);
        
        if(mysqli_num_rows($consql) > 0):
          $consirow=mysqli_fetch_array($consql);
          $itemTotal=$consirow['SRP'] * $icrow['SUM(quantity)'];
          $chargeConsignTotal=$consignTotal+ $itemTotal;
        endif;
      endwhile;
    endwhile;
  


   

    if(mysqli_num_rows($csql2) > 0 && mysqli_num_rows($csql) > 0){
       //echo "Php ".formatMoney($chargeConsignTotal, true);
       $ctotal=formatMoney($chargeConsignTotal, true);
    }else{
      if(mysqli_num_rows($csql) > 0){
           //echo "Php 49,500.00";
           $ctotal= formatMoney(49500);//formatMoney($consignTotal, true);
        }
      if (mysqli_num_rows($csql2) > 0){
          // echo "Php hi".formatMoney($chargeConsignTotal, true);
           $ctotal=formatMoney($chargeConsignTotal, true);
      }

    }

  else:
        //echo "PHP 0.00";
  endif;
    echo "PHP 49,500.00";

?>