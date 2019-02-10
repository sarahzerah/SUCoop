<?php 
    include '../head.php';
    include '../header.php';
    include '../sidebar.php';
    date_default_timezone_set("Asia/Manila");
?>

<section id="main-content" style="padding-left: 5%; padding-right: 2%">
    <section class="wrapper">            
        <div class="row">
            <div class="col-lg-12"><h1 class="page-header"><br>REPORTS as of <?php echo date ("F j, Y"); ?></h1></div>
        </div>
        
        <table  style="width: 100%;">
            <tr>
                <td style="width:30%">     
                          <div class="row" style="padding-left: 1%; width: 100%" >
                              <div style="width:100% ">
                                  <div class="info-box blue-bg" style="width:100%">
                                      <div class="count">
                                          <?php 
                                              include '../connect.php';
                                              $runningOut = "SELECT * FROM inventory WHERE quantity <= 10 AND unit!='serving'";
                                              $runningOutqry= mysqli_query($con,$runningOut);
                                              $runnedOut= mysqli_num_rows($runningOutqry);

                                              echo $runnedOut;
                                          ?>
                                      </div>

                                      <div class="title" style="font-size: 20px">
                                          <?php 
                                              if ($runnedOut<=1) 
                                                  echo "Item ";
                                              else
                                                  echo "Items ";
                                          ?>Running Out
                                      </div><br>
                                         <center><a class="btn btn-primary" href="inventoryReport.php">View Inventory Report</a></center>
                                            </div>
                              </div>
                          </div>
        </td>
    <td rowspan="3" style="width: 70%;"> 
        <h2>&nbsp; &nbsp;Overview</h2><br>
               <section class="panel" style="margin-left: 2%; margin-right: 2%;"> 
                  <header class="panel-heading tab-bg-primary ">
                    <ul class="nav nav-tabs" style="background-color: #2F4F4F">
                      <li class="active">
                        <a data-toggle="tab" href="#inventory">Inventory</a>
                      </li>
                      <li class="">
                        <a data-toggle="tab" href="#sales">Sales</a>
                      </li>
                      <li class="">
                        <a data-toggle="tab" href="#credit">Credit Status</a>
                      </li>
                    </ul>
                </header>
            <!--Start of panel-->
                    <div class="panel-body">
                      <div class="tab-content">
                            <div id="inventory" class="tab-pane active"><br> <!-- tab for membersinformation-->
                                      <?php include 'itemsRunningOut.php'; ?>
                            </div>
                            <div id="sales" class="tab-pane"><br> <!-- tab for  membersInvestment-->
                                     <?php include 'fastMovingItems.php'; ?>
                            </div>
                            <div id="credit" class="tab-pane"><br> <!-- tab for  Credit-->
                                  <?php include 'creditStatus.php'; ?>
                            </div>
                       </div>  <!--4 >> End of Second div tab-content  -->
                    </div> <!--3 >> End of Panel  -->
                </section> <!--2 >> Ebnd of next body of the panel section -->
            </td>    
        </tr>
        <tr>
            <td>
                    <br>  
                       <div class="row" style="padding-left: 1%; width: 100%" >
                              <div style="width:100% ">
                                  <div class="info-box brown-bg" style="width:100%">
                                      <div class="count">
                                           <?php
                                        $qry="SELECT SUM(totalAmount)FROM cash_sales";
                                        $sql2= mysqli_query($con,$qry);
                                        $row = mysqli_fetch_array($sql2);
                                        include '../functions.php';
                                        echo "Php ".formatMoney($row['SUM(totalAmount)'], true);
                                    ?>
                                      </div>

                                      <div class="title" style="font-size: 20px">
                                       Total Sales as of <?php echo date ("F d, Y"); ?>
                                      </div><br>
                                         <center><a class="btn btn-primary" href="salesReport.php">View Sales Report</a></center>
                                            </div>
                              </div>
                          </div>

    </td>
</tr>
<tr>
    <td>
       <br>            
                 <div class="row" style="padding-left: 1%; width: 100%" >
                              <div style="width:100% ">
                                  <div class="info-box dark-bg" style="width:100%">
                                      <div class="count">
                                         <?php
                                    $qry2="SELECT SUM(investment) FROM member";
                                    $sql3= mysqli_query($con,$qry2);
                                    $row2 = mysqli_fetch_array($sql3);
                                    echo "Php ".formatMoney($row2['SUM(investment)'], true);
                                ?>
                                      </div>

                                      <div class="title" style="font-size: 20px">
                                        Members' Total Share Capital
                                      </div><br>
                                         <center><a class="btn btn-primary" href="membersReport.php">View Members' Report</a></center>
                                            </div>
                              </div>
                          </div>
    </td>
</tr>       <!-- project team & activity end -->

          </section>
          <div class="text-right">
         
        </div>
      </section>
      <!--main content end-->
  </section>
  <!-- container section start -->

<?php include '../footer.php'; ?>