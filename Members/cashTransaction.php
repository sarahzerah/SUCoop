<?php 
  include '../head.php';  
  include '../functions.php';
?>

<section id="container">

<?php 
  include '../header.php';
  include '../sidebar.php';
  include '../connect.php';
?>
<section id="main-content">
  <section class="wrapper">
    <div class="row"><br />
      <div class="col-lg-6 col-md-offset-3">
        <h1 class="page-header">Cash Transaction</h1>
      </div>
    </div>

    <?php include '../error.php';   ?>
    <div class="row">
      <div class="col-md-8 col-md-offset-3"> 
        <p class=""><img style="height:80;width:80px;" id="project-icon" alt="" /> </p> 
        <form action="transactions.php" method="POST">

          <?php if (!isset($_SESSION['memberID'])) : ?>
          <div class="form-group ">
            <div class="col-lg-8">
              <div class="input-group">
                <span class="input-group-addon success" >Search</span>
                <input type='text' class="form-control" id='project' placeholder="Search Member" required="" />
              </div>
            </div>
          </div>

          <!--Get the member-->
          <input type='hidden' id='project-id' name="member"  required="" /><br /><br /><br /><br />
          <?php else : 
            $qry = "SELECT * FROM user WHERE userID='{$_SESSION['memberID']}'";
            $run = mysqli_query($con, $qry);
            $rows = mysqli_fetch_array($run);
            $memberID= $rows['userID'];
            echo "<h2>".$rows['lastName'].", ".$rows['firstName']." ".$rows['middleName'][0]."."."</h2><br>";
          ?>
          <?php endif; ?>

          <!--to select what kind of cash transaction-->
      <?php if (!isset($_SESSION['withdraw'])) :?>
      
          <div class="form-group">
            <div class="col-sm-8">
              <select name="transaction" id="" class="form-control">
                <option value="">Select Transaction</option>
                <?php if (!isset($_SESSION['invest']) && !isset($_SESSION['withdraw'])) :?>
                <option value="investment">Share Capital</option>
              <?php endif; if (!isset($_SESSION['deposit']) && !isset($_SESSION['withdraw'])) :?>
                <option value="deposit">Deposit</option>
              <?php endif; if (!isset($_SESSION['withdraw']) && !isset($_SESSION['invest']) && !isset($_SESSION['deposit']) && !isset($_SESSION['cpay'])) :?>
                <option value="withdrawal">Withdrawals</option>
              <?php endif; if (!isset($_SESSION['cpay']) && !isset($_SESSION['withdraw'])) :?>
                <option value="cpayment">Credit Payments</option>
              <?php endif;?>
              </select>
            </div><!-- /.col-md-8 -->
          </div><!-- /.form-group -->
      

          <!--for the amount-->
          <div class="form-group"><br /><br /> <br /> 
            <div class="col-sm-8">
              <div class="input-group">
                <input type="text" name="amount" class="form-control" placeholder="Enter the Amount" required=""
                 onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57" required="" 
                >
                <div class="input-group-btn">
                  <input type="submit" name="submit" value="Add" class=" btn   btn-primary" />  
                </div>
              </div>
            </div><!-- /.col-md-8 -->
          </div><!-- /.form-group -->
        </form> 
      </div><!-- /.col-md-8 --><?php  endif; ?>
    </div><!-- /.row --><br />
      <br>
    <div class="row">
      <div class="col-md-8 col-md-offset-2"> 
        <input type="hidden" name="transactionNum" value="<?php echo $_SESSION['transactionNum']; ?>" />
        <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title text-center"><b style="font-size: 20px">Cash Transaction Summary</b> </h3>
        </div>

        <div class="panel-body" style="font-size: 20px">
          <table class="table">
            <thead>
              <th>Type of Transaction</th>
              <th>Amount</th>
              <?php if (isset($_SESSION['memberID'])) : ?>
              <th>Action</th>
              <?php endif; ?>
            </thead>

            <tbody>
              <?php
                include '../connect.php'; 
                $id=$_SESSION['transactionNum'];

                $qry ="SELECT * FROM  transaction WHERE transactionNum='$id'";                          
                $result= mysqli_query($con, $qry);
                while($row=mysqli_fetch_array($result)) :
                  $type=$row['type'];
                  $amount=$row['amount'];
                  $tr=$row['cTransactionNum'];
                ?>

                <tr>
                  <td><?php 
                          if ($type=='cpayment')
                            echo "Credit Payment";
                          else
                            echo ucwords($type);?></td>
                  <td>Php <?php echo formatMoney($amount, true);?></td>
                  <td>
                    <!-- edit item if the user is the inventory personel-->
                  
                    <a class="btn btn-danger" href="cancel_trans.php?cTransactionNum=<?php echo $tr; ?>&type=<?php echo $type; ?>&amount=<?php echo $amount; ?>">Cancel</a>
                   
                  </td>

                  <?php endwhile; ?>
                </tr>
                
                <tr>
                  <?php
                    $resul = "SELECT sum(amount) FROM  transaction WHERE transactionNum='$id'";
                    $run1= mysqli_query($con,$resul);
                    $rowas =mysqli_fetch_array($run1);

                    $total=$rowas['sum(amount)'];
                    $_SESSION['total']=$total;
                  ?>

                  <td><h3><b>Total:</h3></b></td>
                  <td><h3>Php <?php echo formatMoney($total, true);?></h3></td>
                  <td></td>
                </tr>     
              </tbody>
            </table>
            
            <span><a href="cashTOR.php" class="btn btn-primary" style="margin-left: 90%">Continue</a></span>
          </div>
        </div><!-- /.col-md-8 -->
      </div><!-- /.row -->
    </section>
  </section>

<?php include'footer.php';   ?> 

<script>    
    if(typeof window.history.pushState == 'function') {
        window.history.pushState({}, "Hide", '<?php echo $_SERVER['PHP_SELF'];?>');
    }
</script>