<?php include '../head.php'; 
include '../functions.php'; ?>

  <body>
  <!-- container section start -->
  <section id="container" class="">
     
    
        <?php include '../header.php'; ?>
                 
      <!--header end-->

      <!--sidebar start-->
       <?php include '../sidebar.php'; ?>
       
               
              <!-- sidebar menu end-->
          </div>
      </aside>

      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">
		  <div class="row">
				<div class="col-lg-12">
					<h3 class="page-header">Sales</h3>
					
				</div>
			</div>

        <?php
         include '../connect.php';
           $inv=$_GET['id'];
          $query = "SELECT * FROM items WHERE ORNum= '$inv' ORDER BY purchaseNum DESC";

             $run= mysqli_query($con,$query);

         ?>
              <!-- page start-->
            
            <div class="row">
                  <div class="col-lg-12">
                      <section class="panel">
                        
                          <div class="table-responsive">
                            <table class="table" id="dataTable">
                              <thead>
                                <tr>
                                <th>Item</th>
                                  <th>Quantity</th>
                                  <th>Price</th>
                                  <th>Total</th>
                                </tr>
                              </thead>
                              <tbody>

                                 <?php while($row =mysqli_fetch_array($run)): 
                                    $ORNum = $row['ORNum'];
                                    $pNum=$row['productNum'];

                                    $qry3 ="SELECT * FROM inventory WHERE productNum= '$pNum'";
                                    $sql3= mysqli_query($con,$qry3);
                                    $row3=mysqli_fetch_array($sql3);

                                    $qry4 ="SELECT * FROM sales WHERE ORNum= '$ORNum'";
                                    $sql4= mysqli_query($con,$qry4);
                                    $row4=mysqli_fetch_array($sql4);
                                    $total=$row4['totalAmount'];
                                 ?>

                                <tr>

                                  <tr>
                                  <td><?php echo $row3['itemName']; ?></td>
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

              <h3 align="center" ><b>Sub-total: </b><?php echo "Php ".formatMoney($total,true); ?></h3>
              <center><a class="btn btn-primary" href="sales.php">Back</a>&nbsp; &nbsp; &nbsp;</center> 


  <!-- container section end -->
  <!-- javascripts -->
  <?php include '../footer.php'; ?>
