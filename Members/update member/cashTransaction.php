<?php 
 //error_reporting(0);
include '../head.php';  
include '../functions.php';
?>
<section id="container">

<?php 
include '../header.php';
include '../sidebar.php';

?>
<section id="main-content" style="padding-left: 2%; padding-right: 2%">
<section class="wrapper">
<div class="row">
  <br />
<div class="col-lg-6 col-md-offset-2">
<h1 class="page-header">Cash Transaction</h1>
</div>
</div>

<?php include '../error.php';   ?>
<div class="row">
<div class="col-md-8 col-md-offset-2"> 
<p class=""><img style="height:80;width:80px;" id="project-icon" alt="" /> </p> 
<form action="transactions.php" method="POST">
  <div class="form-group ">
    <div class="col-lg-8">
       <div class="input-group">
          <span class="input-group-addon success" >Search</span>
    <input type='text' class="form-control" 
        id='project' placeholder="Search Member" required="" />
 
      </div>
     </div>
  </div>
<input type='hidden' id='project-id' name="member"  />
<br /><br /><br /><br />
  <div class="form-group">
  <div class="col-sm-8">
  <select id="chz-select" name="transaction" 
data-placeholder="Select Transaction"  class="col-sm-12" required>
<option value=""></option>
     <option value="investment">Share Capital</option>
      <option value="deposit">Deposit</option>
     <option value="widthdrawal">Withdrawals</option>
    <option value="cpayment">Credidit Payments</option>
    </select>
      </div><!-- /.col-md-8 -->
  </div><!-- /.form-group -->

<div class="form-group">
  <br /><br /> <br /> 
  <div class="col-sm-8">
    <div class="input-group">
  <input type="text" name="amount" class="form-control" placeholder="Enter the Amount">
  <div class="input-group-btn">
   <input type="submit" name="submit" value="SAVE" class=" btn   btn-primary" />  
  </div>
</div>
  </div><!-- /.col-md-8 -->
</div><!-- /.form-group -->
</form> 
</div><!-- /.col-md-8 -->
</div><!-- /.row -->
<br />
<div class="row">
<div class="col-md-5 col-md-offset-2">
  <input type="hidden" name="salesNum" value="<?php echo $_GET['salesNum']; ?>" />
<table class="table">
<thead>
  <?php
include '../connect.php'; 
$id=$_SESSION['salesNum'];

$qry ="SELECT * FROM cash_transaction WHERE ORNum='$id'";                                         
$result= mysqli_query($con,$qry);

 $row1=mysqli_fetch_array($result);
 $shr= $row1['investment'];
 $credt=$row1['creditPayment'];
 $w=$row1['withdrawal'];
 $d=$row1['deposit'];
?>
<tr>
<?php if ($shr>0): ?>  
<th>Share Capital</th>
<?php endif?>

<?php if ( $credt>0): ?>  
<th>Credit Payments</th>
<?php endif?>

<?php if ($w>0): ?> 
<th>Withdrawals</th>
<?php endif?>

<?php if ( $d>0): ?>  
<th>Deposit</th>
<?php endif?>

</tr>
</thead>

<tbody>

         <?php
           $run= mysqli_query($con,$qry);
            while($row=mysqli_fetch_array( $run)) :
             $inv= $row['investment'];
             $credit= $row['creditPayment'];
             $with= $row['withdrawal'];
             $dep= $row['deposit'];
            ?>

            <tr>
            <?php if ($inv>0): ?>  
            <td >
              <input readonly="" type="text" value="<?php echo $inv;  ?>" style="border:0;"/>
            </td>
          <?php endif ?>
               <?php if ($credit>0): ?> 
            <td>
               <input readonly="" type="text" value="<?php echo $credit;  ?>"
                style="border:0;" />      
            </td>
             <?php endif ?>
              <?php if ($with>0): ?>
              <td>
               <input readonly="" type="text" value="<?php echo $with; ?>" style="border:0;"/>     
            </td>
              <?php endif ?>
             <?php if ($dep>0): ?>
             <td>
               <input readonly="" type="text" value="<?php echo $dep; ?>" style="border:0;"/>
            </td>
               <?php endif ?>
            <td>
            <!-- <a class="btn btn-danger" href="cancel.php?id=<?php //echo $row['transactionNum']; ?>&salesNum=<?php //echo  $id; ?>">Cancel</a> -->
            </td>   
            </tr>

            <?php 
            endwhile; 
              ?>

</tbody>
</table>
</div><!-- /.col-md-8 -->
</div><!-- /.row -->
</section>
</section>
<?php include'footer.php';   ?> 

