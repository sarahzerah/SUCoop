
<?php 
 if($_SESSION['role'] != 'member'){
          $id=$_SESSION['user'];
      }else{
          $id=$_SESSION['user'];
      }     

?>
<?php  //if ($_SESSION['role'] == 'member'):?>
<header class="panel-heading" style="font-size: 20px" ><b>Withdrawals</b></header>
<?php //endif; ?>
<!--table for the values inside withdrawal-->
  <table class="table" style="width: 100%;" style="font-size: 20px;" >
    <?php
       
          $qrywith = "SELECT * FROM cash_transaction WHERE memberID='$id'";
          $result = mysqli_query($con, $qrywith);
      ?>
      <tbody style="font-size: 20px">        
        <tr>
          <th >Date</th>
          <th>Time</th>
          <th>Amount</th>
          <th style="text-align: center">Petty Cash# or Check#</th>       
        </tr>
          <?php 
            $totalw="0"; //$totalw -- total amount of withdrawal
            if(mysqli_num_rows($result) > 0):
              while($row =mysqli_fetch_array($result)): 
              $id= $row['transactionNum'];
              $withdraw="SELECT * FROM transaction WHERE transactionNum='$id' AND type='withdrawal' ORDER BY transactionNum DESC";
              $wqry=mysqli_query($con,$withdraw);
              while ($wrow=mysqli_fetch_array($wqry)):?>
                <tr>
                  <td style="border-color:white;color:black"><?php echo formatDate($row['dateReceived']); ?></td> 
                  <td style="border-color:white; color: black;"><?php echo formatTime($row['timeReceived']);?></td>
                  <th style="border-color:white"><?php echo "Php ".$withdraw=formatMoney($wrow['amount'],true);?></th>
                  <th style="text-align: center; border-color: white"><?php echo "".$row['transactionNum'];?></th>
                      <?php $totalw = $totalw +$wrow['amount']; ?>
                </tr>
                 <?php        
                endwhile;
              endwhile;
              else:
                 echo '<p style="color:red; font-size: 20px;">No Records</p>';
              endif;
          ?> 
          </tbody>
  </table> <!--End of table for withdrawal-->   
<?php
include '../footer.php'; ?>