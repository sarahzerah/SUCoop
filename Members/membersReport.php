<?php include '../head.php'; ?>
<section id="container" class="">
<?php 
    include '../header.php';
    include '../sidebar.php';
    include '../functions.php'; 
?>
<section id="main-content">
    <section class="wrapper">
		<div class="row">
			<div class="col-lg-12"> 
                <header><h3 style="color:Back"><b>MEMBERS' REPORT as of <?php echo date ("F d, Y"); ?></b></h3> </header><br>
            </div>
		</div>
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <div class="info-box blue-bg">
                            <i class="fa fa-cloud-download"></i>
                        <div class="count">
                        <?php 
                          include '../connect.php';
                          $resul = "SELECT * FROM user WHERE role='member' AND status='active'";
                          $sql= mysqli_query($con,$resul);
                          $numMem= mysqli_num_rows($sql);
                          echo $numMem;
                        ?>
                        </div>
                            <div class="title">Members</div><br>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <div class="info-box blue-bg">
                            <i class="fa fa-cloud-download"></i>
                                <div class="count">
                                <?php
                                    $qry2="SELECT SUM(investment) FROM member";
                                    $sql3= mysqli_query($con,$qry2);
                                    $row2 = mysqli_fetch_array($sql3);
                                    echo "Php ".formatMoney($row2['SUM(investment)'], true);
                                ?>
                                </div>
                                <div class="title">Members' Total Share Capital</div><br>
                   
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <div class="info-box blue-bg">
                            <i class="fa fa-cloud-download"></i>
                                <div class="count">
                                <?php
                                    $qry3="SELECT SUM(creditBalance) FROM member";
                                    $sql4= mysqli_query($con,$qry3);
                                    $row3 = mysqli_fetch_array($sql4);
                                    echo "Php ".formatMoney($row3['SUM(creditBalance)'], true);
                                ?>
                                </div>
                                <div class="title">Members' Total Credit</div><br>  
                        </div>
                    </div>
             </div>
<!--Showing  credit status-->
<?php include 'creditStatus.php'; ?>
<div class="row" style="margin-left: 10px">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading tab-bg-info">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a data-toggle="tab" href="#recent-activity"><i class="icon-home"></i>Credit List </a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#profile"><i class="icon-user"></i>Investment List</a>
                    </li>                           
                    <li>
                        <a data-toggle="tab" href="#personal"><i class="icon-envelope"></i>Savings List</a>
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
                                            <?php include 'creditsList.php'; ?>
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
                                            <div class="col-sm-8">
                                                <section class="panel">
                                                    <?php include 'investmentList.php'; ?>
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
                                                    <?php include 'savingsList.php'; ?>
                                                </section>
                                            </div>        
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
        </section>
    </div>
</div>                    
        <a class="btn btn-primary" href="../Reports/report.php">Back</a>&nbsp; &nbsp; &nbsp;
        <a class="btn btn-primary" href="membersList.php">See Members' Records</a>&nbsp; &nbsp; &nbsp;
        <a class="btn btn-primary" href="">Print</a>&nbsp; &nbsp; &nbsp;
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