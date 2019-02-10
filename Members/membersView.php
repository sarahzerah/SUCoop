<?php 
    include '../head.php';

    include '../header.php'; 
    include '../functions.php';

    if ($_SESSION['role']=='member') {
        include '../connect.php';
        $qry = "SELECT * FROM user WHERE userID='$id'";
        $run = mysqli_query($con, $qry);
        $rows = mysqli_fetch_array($run);
      
        $id=$rows['userID'];
        $firstName=$rows['firstName'];
        $lastName=$rows['lastName'];
        $middleName=$rows['middleName'];
    }
?>

<!--main content start-->
<section id="main-content">
    <section class="wrapper">
    
        <h3 style="color:Black"><b><?php echo ucwords($firstName." ".$middleName." ".$lastName); ?></b></h3> <br>
    
        <!-- page start-->
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading tab-bg-info">
                        <ul class="nav nav-tabs">

                            <li class="active">
                                <a data-toggle="tab" href="#recent-activity"><i class="icon-home"></i>Investment</a>
                            </li>

                            <li>
                                <a data-toggle="tab" href="#profile"><i class="icon-user"></i>Credit</a>
                            </li>
                            
                            <li>
                                <a data-toggle="tab" href="#edit-profile"><i class="icon-envelope"></i>Savings</a>
                            </li>
                        
                            <li>
                                <a data-toggle="tab" href="#personal"><i class="icon-envelope"></i>Personal Information</a>
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
                                                <?php include 'membersInvestment.php'; ?>
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
                                                    <?php include 'membersInvoice.php'; ?>
                                                </section>
                                            </div>
                                        </div>
                                    </div>
                                </section>

                                <!--Payments-->
                                <section class="panel">
                                    <div class="panel-body bio-graph-info">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <section class="panel">
                                                    <?php include 'membersPayments.php'; ?>
                                                </section>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>

                            <!--Savings-->
                            <div id="edit-profile" class="tab-pane">

                                <!--Withdrawals-->
                                <section class="panel">
                                    <div class="panel-body bio-graph-info"> 
                                        <div class="row">
                                            <div class="col-sm-8">
                                                <section class="panel">
                                                    <?php include 'membersWithdrawals.php'; ?>
                                                </section>                            
                                            </div>
                                        </div>
                                    </div>
                                </section>

                                <!--Deposit-->
                                <section class="panel">
                                    <div class="panel-body bio-graph-info">
                                        <div class="row">
                                            <div class="col-sm-8">
                                                <section class="panel">
                                                    <?php include 'membersDeposit.php'; ?>
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
                                                    <?php include 'membersPInformation.php'; ?>
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
        </section>
    </section>
</section>
  
<?php include '../footer.php'; ?>