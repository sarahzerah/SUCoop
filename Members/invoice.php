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
  <!-- container section start -->
<section id="container" class="">
      <!--main content start-->
<?php if($_SESSION['role'] != 'member'){ ?>
  <section id="main-content" style="padding-left: 4%; padding-right: 2%;">
      <section class="wrapper"  >
		    <div class="row" >
				  <div class="col-lg-12">
					 <h1 class="page-header"><br>Invoice</h1>
				</div>
			  </div>
<?php } else {?>
        <div class="row">
          <div class="col-lg-12">
            <section class="panel">
              <h3 class="page-header"><br>Invoice</h3>
<?php } ?>
                <div class="table-responsive">
                    <table class="table" id="dataTable" style="color: black; font-size: 20px;">
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
                         $inv=$_POST['id'];
                         include '../connect.php'; 
                         $query = "SELECT * FROM items WHERE chargeInvoiceNum= '$inv' ORDER BY purchaseNum DESC";
                         $run= mysqli_query($con,$query);

                          while($row =mysqli_fetch_array($run)): 
                                $ORNum = $row['ORNum'];
                                $pNum=$row['productNum'];

                                    $qry3 ="SELECT * FROM inventory WHERE productNum= '$pNum'";
                                    $sql3= mysqli_query($con,$qry3);
                                    $row3=mysqli_fetch_array($sql3);

                                    $qry4 ="SELECT * FROM charge_invoice WHERE chargeInvoiceNum= '$inv'";
                                    $sql4= mysqli_query($con,$qry4);
                                    $row4=mysqli_fetch_array($sql4);
                                    $total=$row4['totalAmount'];
  ?>
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
         <h2 align="center" ><b>TOTAL: </b> <?php echo "Php ".formatMoney($total,true); ?></h2  >
         <br>
         <?php if(isset($_POST['submit_member'])){
                                if( $_SESSION['role'] == 'member'){ ?>
                                       <center>
                                              <form action="membersInvoice.php" method="post">  
                                              <input type="Submit" name="submit" value="Back" class="btn btn-primary">
                                              <input type="hidden" value="<?php echo  $_SESSION['user_id']; ?>" name ="memberid" />
                                            </form>
                                            </center> 
                                 <?php }else { ?>
                                            <center>
                                              <form action="viewMembersProfile.php" method="post">  
                                              <input type="Submit" name="submit" value="Back" class="btn btn-primary">
                                              <input type="hidden" value="<?php echo $_SESSION['user']; ?>" name ="memberid" />
                                            </form>
                                            </center> 
                           <?php } ?>
        <?php }else{ ?>
                           <center><a class="btn btn-primary" href="sales.php">Back</a>&nbsp; &nbsp; &nbsp;</center> 
        <?php }?>

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
