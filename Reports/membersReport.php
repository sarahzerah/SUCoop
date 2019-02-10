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
     <header><h1 style="color:Back"><b><br>Members' Report as of <?php echo date ("F d, Y"); ?></b></h1> </header><br>
            </div>
			</div>
              
      <div class="row">
          <div class="col-lg-12">
           
              <section class="panel">
                  <div class="panel-body">
                    <div class="row">
                              <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="info-box blue-bg">
                    <i class=""></i>
                    <div class="count">
                        <?php 
                          include '../connect.php';
                          $resul = "SELECT * FROM user WHERE role='member' AND status='active'";
                          $sql= mysqli_query($con,$resul);
                          $numMem= mysqli_num_rows($sql);

                          echo $numMem;
                        ?>
                    </div>
                    <div class="title" style="font-size: 20px">Members</div><br>
                   
                </div>
            </div>
      

          <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="info-box blue-bg">
                    <i class=""></i>
                    <div class="count">
                        <?php
                            $qry2="SELECT SUM(investment) FROM member";
                            $sql3= mysqli_query($con,$qry2);
                            $row2 = mysqli_fetch_array($sql3);
                            echo "Php ".formatMoney($row2['SUM(investment)'], true);
                        ?>
                    </div>
                    <div class="title" style="font-size: 20px">Members' Total Share Capital</div><br>
                   
                </div>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="info-box blue-bg">
                    <i class=""></i>
                    <div class="count">
                        <?php
                            $qry3="SELECT SUM(creditBalance) FROM member";
                            $sql4= mysqli_query($con,$qry3);
                            $row3 = mysqli_fetch_array($sql4);
                            echo "Php ".formatMoney($row3['SUM(creditBalance)'], true);
                        ?>
                    </div>
                    <div class="title" style="font-size: 20px">Members' Total Credit</div><br>
                   
                </div>
            </div>

          </div>
          
          <?php include 'creditStatus.php'; ?>
          <br>
          <br>
          <div class="row" style="margin-left: 10px">
            <div class="col-lg-20" style="margin-right: 2%">

                <section class="panel"> 
                  <header class="panel-heading tab-bg-primary ">
                    <ul class="nav nav-tabs" style="background-color: #2F4F4F">
                      <li class="active">
                        <a data-toggle="tab" href="#credit" style="font-size: 20px">Credit List</a>
                      </li>
                      <li class="">
                        <a data-toggle="tab" href="#capital" style="font-size: 20px">Share Capital List</a>
                      </li>
                      <li class="">
                        <a data-toggle="tab" href="#savings" style="font-size: 20px">Savings List</a>
                      </li>
                    </ul>
                </header>
            <!--Start of panel-->
                    <div class="panel-body">
                      <div class="tab-content">
                            <div id="credit" class="tab-pane active"><br> <!-- tab for membersinformation-->
                                       <?php include 'creditsList.php'; ?>
                            </div>
                            <div id="capital" class="tab-pane"><br> <!-- tab for  membersInvestment-->
                                     <?php include 'investmentList.php'; ?>
                            </div>
                            <div id="savings" class="tab-pane"><br> <!-- tab for  Credit-->
                                    <?php include 'savingsList.php'; ?>
                            </div>
                       </div>  <!--4 >> End of Second div tab-content  -->
                    </div> <!--3 >> End of Panel  -->
                </section> <!--2 >> Ebnd of next body of the panel section -->

                  </div>
                </div>
                    
                    
                   
                      <a class="btn btn-primary" href="printmember.php">Print</a>&nbsp; &nbsp; &nbsp;
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