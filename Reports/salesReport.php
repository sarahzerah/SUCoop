<?php include '../head.php'; ?>

<section id="container" class="">
   
<?php 
    include '../header.php';
    include '../sidebar.php';
    include '../functions.php'; 

?>

<section id="main-content" style="padding-left: 4%; padding-right: 2%;">
    <section class="wrapper">
        <div class="row">
          <a href="../Reports/report.php" style="margin-top: 2%">
              <img src ="./img/back.png" style="height: 20px; width: 20px; margin-top: 50px">
              <img src ="./img/back.png" style="height: 20px; width: 20px; margin-top: 50px">
            </a> 
            <div class="col-lg-12"> 
                <header><h1 style="color:Back"><b><br>SALES REPORT 
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

                                        ?> </b></h1> </header><br>

            </div>
      </div>
              <div class="row">
             <form class="form-horizontal "  method="POST" action="salesReport.php">
              <h3>
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;View Sales Report for the: &nbsp;&nbsp;
                          
                          <button class="btn btn-primary" name="day" type="submit" value="day">Day</button> &nbsp;&nbsp;&nbsp;      
                <button class="btn btn-primary" name="month" type="submit" value="month">Month</button> &nbsp;&nbsp;&nbsp;
                <button class="btn btn-primary" name="year" type="submit" value="year">Year  </button> 
              </h3>
              </form>
            </div><br>

              <div class="row">
              <div class="col-lg-12">
                  <section class="panel">
                      <div class="panel-body">
                        <div class="row">
                                  <!--sales-->
                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                  <div class="info-box blue-bg">
                                      <div class="count">
                                          <?php
                                              include '../connect.php';
                                              date_default_timezone_set("Asia/Manila");
                                              $date=date("Y-m-d");
                                              $month=date("m");
                                              $year=date("Y");
                                              if (isset($_POST['day'])){
                                                $qry="SELECT SUM(totalAmount) FROM cash_sales WHERE dateBought='$date'";
                                                $qry2="SELECT SUM(totalAmount) FROM charge_invoice WHERE dateBought='$date'";
                                                  $asof=date ("F d, Y");
                                              }
                                        
                                              else if (isset($_POST['month'])){
                                               $qry="SELECT SUM(totalAmount) FROM cash_sales WHERE EXTRACT(Month from dateBought)='$month'";
                                               $qry2="SELECT SUM(totalAmount) FROM charge_invoice WHERE EXTRACT(Month from dateBought)='$month'";
                                                $asof=date ("F");
                                              }
                                
                                              else if (isset($_POST['year'])){
                                               $qry="SELECT SUM(totalAmount) FROM cash_sales WHERE EXTRACT(Year from dateBought)='$year'";
                                               $qry2="SELECT SUM(totalAmount) FROM charge_invoice WHERE EXTRACT(Year from dateBought)='$year'";
                                                 $asof=date ("Y");
                                              }
                                                
                                              else{
                                              $qry="SELECT SUM(totalAmount) FROM cash_sales WHERE EXTRACT(Month from dateBought)='$month'";
                                               $qry2="SELECT SUM(totalAmount) FROM charge_invoice WHERE EXTRACT(Month from dateBought)='$month'";
                                               $asof=date ("F");
                                              }
                                            
                                              $sql2= mysqli_query($con,$qry);
                                              $sql3= mysqli_query($con,$qry2);
                                              $rowcount=mysqli_num_rows($sql2);
                                              $rowcount2=mysqli_num_rows($sql3);


                                              if ($rowcount != 0 && $rowcount2  != 0):
                                                $row = mysqli_fetch_array($sql2);
                                                $row2 = mysqli_fetch_array($sql3);
                                                $salesTotal=$row['SUM(totalAmount)']+$row2['SUM(totalAmount)'];
                                                echo "Php ".formatMoney($salesTotal, true);
                                                $total=formatMoney($salesTotal, true);
                                              else:
                                                    if ($rowcount!=0 || $rowcount2 !=0 ):
                                                        $row = mysqli_fetch_array($sql2);
                                                      
                                                        echo "Php ".formatMoney($row['SUM(totalAmount)'], true);
                                                        $total=formatMoney($row['SUM(totalAmount)']);

                                                    else:
                                                        echo "No Sales Yet.";

                                                    endif;
                                              endif;
                                            
                                          ?>
                                      </div>
                                      <div class="title" style="font-size: 20px">Total Coop Sales</div><br>  
                                  </div>
                              </div>

                            <!--Consigned items-->
                       <?php 

                              $checkcon="SELECT * FROM inventory WHERE consignment='yes'";
                              $checkok=mysqli_query($con,$checkcon);

                              if (mysqli_num_rows($checkok) > 0):
                      ?>
                               <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                  <div class="info-box blue-bg">
                                      <div class="count">
                                          <?php
                                              include '../connect.php';
                                              date_default_timezone_set("Asia/Manila");
                                              $date=date("Y-m-d");
                                              $month=date("m");
                                              $year=date("Y");
                                              $itemtotal=0;
                                              $consignTotal=0;
                                              $totalConsign=0;
                                              $chargeConsignTotal=0;
                                              $ctotal=0;
                                              if (isset($_POST['day'])){
                                                $cqry="SELECT * FROM cash_sales WHERE dateBought='$date'";
                                                $cqry2="SELECT * FROM charge_invoice WHERE dateBought='$date'";
                                              
                                                  include 'consigned.php';
                                              }
                                              else if (isset($_POST['month'])){
                                                  $cqry="SELECT * FROM cash_sales WHERE EXTRACT(Month from dateBought)='$month'";
                                                  $cqry2="SELECT * FROM charge_invoice WHERE EXTRACT(Month from dateBought)='$month'";
                                                  
                                                   include 'consigned.php';        
                                              }
                                              else if (isset($_POST['year'])){
                                                  $cqry="SELECT * FROM cash_sales WHERE EXTRACT(Year from dateBought)='$year'";
                                                  $cqry2="SELECT * FROM charge_invoice WHERE EXTRACT(Year from dateBought)='$year'";  
                                                
                                                  include 'consigned.php';
                                              }   
                                              else{
                                                   $cqry="SELECT * FROM cash_sales WHERE EXTRACT(Month from dateBought)='$month'";
                                                  $cqry2="SELECT * FROM charge_invoice WHERE EXTRACT(Month from dateBought)='$month'";
                                                   
                                                   include 'consigned.php';     
                                              }
                                          ?>
                                      </div>
                                      <div class="title" style="font-size: 20px">Total Sales of Consigned Items</div><br>  
                                  </div>
                              </div>
                         <?php  endif; ?>
              </div>
            </div>
            <br> 
                   <div style="padding-left: 2%; padding-bottom: 2%">
                          <?php include 'fastMovingItems.php'; ?>
                        <table><tr>
                       
                         <td>
                         <form action="printsales.php" method="post">
                          <input type="submit" name="submit" class="btn btn-primary" value="Print">
                          <input type="hidden" name="date" value="<?php echo $date; ?>" >
                          <input type="hidden" name="day" value="<?php echo $day; ?>" >
                          <input type="hidden" name="total" value="<?php echo $total; ?>" >
                          <input type="hidden" name="asof" value="<?php echo $asof; ?>" >
                          <input type="hidden" name="consigned" value="<?php echo $ctotal; ?>" >
                        </form>
                      </td>
                    </tr>
                  </table>
                    </div>  
                  </section>
              </div>
            </div>
      </section>
  </section>

<?php include '../footer.php'; ?>
<script>    
    if(typeof window.history.pushState == 'function') {
        window.history.pushState({}, "Hide", '<?php echo $_SERVER['PHP_SELF'];?>');
    }
</script>