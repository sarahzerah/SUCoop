
<h2>Fast Moving items
 <?php if (!isset($_POST['day']) && !isset($_POST['month']) && !isset($_POST['year']) )
         echo "for the Month of ".date ("F");
       else {
         if (isset($_POST['day']))
              echo "for ".date ("F d, Y");
         if (isset($_POST['month']))
              echo "for the Month of ".date ("F");
         if (isset($_POST['year']))
              echo "for Year ".date ("Y");
       }  

?> </b></h2> </header><br>
<?php
    include '../connect.php';
    $qry5="SELECT productNum, SUM(quantity) AS sumQuan FROM items GROUP BY productNum ORDER BY SUM(quantity) DESC";
    $sql5= mysqli_query($con,$qry5);
?>

<div class="table-responsive" style="color: black; padding-right: 2%">
  <table class="table table-striped table-advance table-hover" style="padding-right:15%; font-size: 18px" id="userTbl">
    <tbody>


           <tr>
            <th style=" font-style: bold">Item </th>
            <th style=" font-style: bold; text-align: center">Quantity </th>
            </tr>
            
              <?php

                    date_default_timezone_set("Asia/Manila");
                    $date=date("Y-m-d");
                    $month=date("m");
                    $year=date("Y");
                    $prod=array();
                    $quan=array();

                    if (isset($_POST['day'])){  
                          $fast="SELECT * FROM cash_sales WHERE dateBought='$date' ORDER BY ORNum DESC";
                          $fastinv="SELECT * FROM charge_invoice WHERE dateBought='$date' ORDER BY chargeInvoiceNum DESC";
                          include 'movingitem.php';
                          $day=$date;
                          $date='day';

                    }else if (isset($_POST['month'])){  
                          $fast="SELECT * FROM cash_sales WHERE EXTRACT(Month from dateBought)='$month'";
                          $fastinv="SELECT * FROM charge_invoice WHERE EXTRACT(Month from dateBought)='$month'";
                          include 'movingitem.php';
                          $day=$month;
                          $date='month';
                         
                    }else if (isset($_POST['year'])){
                       $fast="SELECT * FROM cash_sales WHERE EXTRACT(Year from dateBought)='$year'";
                       $fastinv="SELECT * FROM charge_invoice WHERE EXTRACT(Year from dateBought)='$year'";
                          include 'movingitem.php';
                        $day=$year;
                        $date='year';
                      
                    }else {
                       $fast="SELECT * FROM cash_sales WHERE EXTRACT(Month from dateBought)='$month'";
                          $fastinv="SELECT * FROM charge_invoice WHERE EXTRACT(Month from dateBought)='$month'";
                          include 'movingitem.php';
                          $day=$month;
                          $date='month';
                   
                    }              
        ?> 
     
     </tbody>
 </table>
</div>
    <script>    
    if(typeof window.history.pushState == 'function') {
        window.history.pushState({}, "Hide", '<?php echo $_SERVER['PHP_SELF'];?>');
    }
</script>