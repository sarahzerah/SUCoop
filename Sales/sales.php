
<?php include '../head.php'; ?>
<?php include '../functions.php'; ?>
<?php  include('../connect.php'); ?>
<!-- container section start -->
<section id="container" class="">
  <!--header start-->
 
<?php include '../header.php'; ?>
  <!--header end-->

  <!--sidebar start-->
<?php include '../sidebar.php'; ?>
      </div>
  </aside>
  <!--sidebar end-->
          <!-- sidebar menu end-->
      </div>
  </aside>
  
  <!--main content start-->
  <section id="main-content" style="padding-left: 4%; padding-right: 2%">
      <section class="wrapper">
          <h3 style="color:Black; " >
         <h1 class="page-header"><br>Sales</h1>
  </h3>
  <div class="row">
    <div class="col-lg-12">
      
      
    </div>
  </div>
          <!-- page start-->

<div class="row">
<div class="col-md-6">
<form action="" method="POST">
<strong style="font-size: 18px">Search By Date&nbsp;&nbsp;<input type="date" style="width: 223px; padding:5px;" 
name="date" class="tcal" value="" /> 
<input type="submit" class="btn btn-info" name="search" value=" Search" style="width: 123px; height:35px;" >
</strong>
</form>
</div><!-- /.col-md-6 <-->
<div class="col-md-6">
   <form  action="" method="POST" class="form-inline" style="margin-left: 50%">
    Filter by Mode of Paynment: 
    <select type="search" class="select-table-filter form-control" data-table="order-table" style=" width:40%; height:35px;padding-left:10%; " class="form-control" >
    
         <option value="" align="">List by sales on credit/Cash</option> 
        <option value="cash">Cash</option>  
        <option value="credit">Credit</option> 
    </select>
</form>
</div><!-- /.col-md-6 -->
</-->
</div><!-- /.row -->
        <br>
        <br>
        <div class="row">
              <div class="col-lg-12">
                  <section class="panel">
                     
                      <div class="table-responsive">
                        <table class="table order-table" id="dataTable" style="font-size: 20px">
                          <thead>
                            <tr>
                            <th>OR/Charge Invoice No.</th>
                              <th>Date Purchased</th>
                              <th>Time Purchased</th>
                              <th>Mode of Payment</th>
                              <th>Total Amount</th>
                              <th></th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                      include '../connect.php';

                       if(isset($_POST['search']))
                        {
                      $valueTosearch=$_POST['date'];

                       $result = "SELECT u.chargeInvoiceNum as ORNum, u.dateBought,u.timeBought,
                        'credit'as mode,u.totalAmount FROM charge_invoice AS u
                         UNION ALL
                     SELECT c.ORNum, c.dateBought,c.timeBought,'cash' as mode, c.totalAmount FROM cash_sales AS c
                     
                       WHERE dateBought LIKE  
                       '%$valueTosearch%'  ORDER BY ORNum DESC"; 
                       

                       $run= mysqli_query($con,$result);
                      }
                       else{

            $result = "
            SELECT u.chargeInvoiceNum as ORNum, u.dateBought,u.timeBought,
            'credit'as mode,u.totalAmount FROM charge_invoice AS u
             UNION ALL
             SELECT c.ORNum, c.dateBought,c.timeBought,'cash' as mode, c.totalAmount FROM cash_sales AS c"; }

                       $run= mysqli_query($con,$result);
                         while($row =mysqli_fetch_array($run)):
                         $ORNum= $row['ORNum'];
                           ?>
                            <tr>
                              <td><?php echo $row['ORNum'];?></td>
                              <td> <?php echo formatDate($row['dateBought']);?></td>
                              <td> <?php echo formatTime($row['timeBought']);?></td>
                              <td><?php echo $row['mode'];?></td>
                              <td><?php echo "Php ".formatMoney($row['totalAmount'],true);?></td>
                          
                               <td><a class="btn btn-primary" 
                                href="invoice.php?id=<?php echo $ORNum; ?> " style="font-size: 20px">View</i></a></td>
                            </tr>
                               <?php endwhile;?>                               
                          </tbody>
                        </table>
                        <br />
                         
                      </div>
       
                  </section>
              </div>
          </div>
<!-- container section end -->
<script src="js/filter.js"></script>
<?php include '../footer.php';?>
