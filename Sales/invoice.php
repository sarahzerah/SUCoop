<?php

    if (session_id() == '')
                include '../session.php';

    if ($_SESSION['role']=='member')
            include '../Members/member.php';
    else{
          include '../head.php'; 
          include '../header.php'; 
          include '../functions.php'; 
          include '../sidebar.php';
         
       }
    ?>

  <body>
  <!-- container section start -->
  <section id="container" class="">
          </div>
      </aside>

      <!--main content start-->
  <?php if($_SESSION['role'] != 'member'){ ?>
      <section id="main-content" style="padding-left: 4%; padding-right: 2%">
            <section class="wrapper">
		  <div class="row">
				<div class="col-lg-12">
					<h1 class="page-header"><br>Invoice</h1>
				</div>
			</div>

              <!-- page start-->
            
     
          <?php } else {?>
                  <div class="row">
                  <div class="col-lg-12">
                  <section class="panel">
                  <h3 class="page-header"><br>Invoice</h3>
              <?php } ?>
                          <div class="table-responsive">
                            <table class="table" id="dataTable" style="color: black; font-size: 20px">
                              <thead>
                                <tr>
                                <th>Item</th>
                                  <th>Quantity</th>
                                  <th>Price</th>
                                  <th>Total</th>
                                </tr>
                              </thead>
                              <tbody>

                           <?php 
                              $total=0;
                              $inv=$_GET['id'];

                              include '../connect.php'; 
                              $query = "SELECT * FROM items WHERE ORNum= '$inv' ORDER BY purchaseNum DESC";
                              $run= mysqli_query($con,$query);

                                 while($row =mysqli_fetch_array($run)): 
                                    $ORNum = $row['ORNum'];
                                    $pNum=$row['productNum'];

                                    $qry3 ="SELECT * FROM inventory WHERE productNum= '$pNum'";
                                    $sql3= mysqli_query($con,$qry3);
                                    $row3=mysqli_fetch_array($sql3);

                                    $qry4 ="SELECT * FROM cash_sales WHERE ORNum= '$ORNum'";
                                    $sql4= mysqli_query($con,$qry4);
                                    $row4=mysqli_fetch_array($sql4);
                                    $total=$row4['totalAmount'];
                          ?>

                                <tr>

                                  <tr>
                                  <td><?php echo ucwords($row3['itemName']); ?></td>
                                  <td><?php echo $row['quantity']; ?></td>
                                  <td><?php echo formatMoney($row3['SRP'], true); ?></td> 
                                  <td><?php echo formatMoney($row['quantity'] * $row3['SRP'], true);?></td>
                            
                                  <?php endwhile;?> 
                                   </tr>
                              </tbody>
                            </table>
                          </div>
                      </section>
                  </div>
              </div>
                <?php 


                ?>

              <h2 align="center" ><b>TOTAL: </b> <?php echo "Php ".formatMoney($total,true); ?></h2>
              <br>
         <?php if(isset($_GET['member'])){
                                if( $_SESSION['role'] == 'member'){ ?>
                                       <center>
                                              <a class="btn btn-primary" href="../Members/membersInvoice.php?id=<?php echo $_GET['member']; ?>">Back</a>&nbsp; &nbsp; &nbsp;
                                       </center> 
                                 <?php } else { ?>
                                            <center>
                                              <a class="btn btn-primary" href="../Members/viewMembersProfile.php?id=<?php echo $_GET['member']; ?>">Back</a>  &nbsp; &nbsp; &nbsp;
                                            </center> 
                           <?php } ?>
        <?php } else{ ?>
                           <center><a class="btn btn-primary" href="sales.php">Back</a>&nbsp; &nbsp; &nbsp;</center> 
                <?php } ?>

  <!-- container section end -->
  <!-- javascripts -->

  <?php if($_SESSION['role'] == 'member'){ ?>

                                            </section>
                                            </div>   
                                            </div>
                                        </div>
                                    </section>
                                 </div>

 <?php //include './footer.php';
} ?>
  <?php include '../footer.php'; ?>
