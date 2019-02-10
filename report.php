<?php 
    include '../head.php';
    include '../header.php';
    include '../sidebar.php';
?>

<section id="main-content" style="padding-left: 2%; padding-right: 2%">
    <section class="wrapper">            
    <div class="row">
      <div class="col-lg-12"><h2 class="page-header"><br>REPORTS as of <?php echo date ("F n, Y"); ?></h2></div>
    </div>
        
        <table  style="width: 100%">
            <tr >
                <td style="width:30%">     
                    <div class="row" style="padding-left: 1%; width: 100%" >
                <div style="width:100% ">
                  <div class="info-box blue-bg" style="width:100%">
                    <div class="count">
                                    <?php 
                                        include '../connect.php';
                                        $runningOut = "SELECT * FROM inventory WHERE quantity <= 10 ";
                                        $runningOutqry= mysqli_query($con,$runningOut);
                                        $runnedOut= mysqli_num_rows($runningOutqry);

                                        echo $runnedOut;
                                    ?>
                                </div>

                    <div class="title">
                                    <?php 
                                        if ($outstock<=1) 
                                            echo "Item ";
                                        else
                                            echo "Items ";
                                    ?>
                                  Running Out</div><br>
                                   <center><a class="btn btn-primary" href="inventoryReport.php">View Inventory Report</a></center>
                                      </div>
                                </div>
        </div>
                

        </td>
        <td rowspan="3" style="width: 70%">


        <h3>Overview</h3><br>
                
        <div class="row">
            <div class="col-lg-12"  >
                <section class="panel" style="height: 30%">
                    <header class="panel-heading tab-bg-info">
                        <ul class="nav nav-tabs">

                            <li class="active">
                                <a data-toggle="tab" href="#recent-activity"><i class="icon-home"></i>Inventory </a>
                            </li>

                            <li>
                                <a data-toggle="tab" href="#profile"><i class="icon-user"></i>Sales</a>
                            </li>
                            
                            <li>
                                <a data-toggle="tab" href="#personal"><i class="icon-envelope"></i>Credit Status</a>
                            </li>

                        </ul>
                    </header>
            
                    <div class="panel-body">
                        <div class="tab-content">
                            <div id="recent-activity" class="tab-pane active">
                                <div class="profile-activity"><br>

                                    <!--Investment-->
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <section class="panel">
                                                <?php include 'itemsRunningOut.php'; ?>
                                            </section>
                                        </div>
                                    </div>
                                </div>
                            </div><br>
        
                            <!--Invoice-->  
                            <div id="profile" class="tab-pane"> 
                                <section class="panel">
                                    <div class="panel-body bio-graph-info">  
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <section class="panel">
                                                    <?php include 'fastMovingItems.php'; ?>
                                                </section>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>

                
                            <!--Personal Information-->
                            <div id="personal" class="tab-pane">
                                <section class="panel">
                                    <div class="panel-body bio-graph-info">  
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <section class="panel">
                                                    <?php include 'creditStatus.php'; ?>
                                                </section>
                                            </div>        
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>



                  </div>
                </div>
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
                <div class="info-box brown-bg" style="width:100%">
                    <i class=""></i>
                    <div class="count">
                        <?php
                            $qry="SELECT SUM(totalAmount)FROM sales";
                            $sql2= mysqli_query($con,$qry);
                            $row = mysqli_fetch_array($sql2);
                            include '../functions.php';
                            echo "Php ".formatMoney($row['SUM(totalAmount)'], true);
                        ?>
                    </div>
                    <div class="title">Total Sales as of <?php echo date ("F d, Y"); ?></div><br>
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
                    <i class=""></i>
                    <div class="count">
                        <?php
                            $qry2="SELECT SUM(investment) FROM member";
                            $sql3= mysqli_query($con,$qry2);
                            $row2 = mysqli_fetch_array($sql3);
                            echo "Php ".formatMoney($row2['SUM(investment)'], true);
                        ?>
                    </div>
                    <div class="title">Members' Total Share Capital</div><br>
                    <center><a class="btn btn-primary" href="membersReport.php">View Members' Report</a></center>           
                </div>
            </div>
        </div>
        
    </td>
</tr>

              <!-- project team & activity end -->

          </section>
          <div class="text-right">
         
        </div>
      </section>
      <!--main content end-->
  </section>
  <!-- container section start -->

<?php include '../footer.php'; ?>