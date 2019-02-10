<?php
if (session_id() == '')
  include '../session.php';
if ($_SESSION['role']=='member')
  include './member.php';
?>
<?php if ($_SESSION['role']=='member') { ?>
<h2 style="padding-bottom:1.5%"><b >Current Balance: <?php echo "Php ".formatMoney($savings,true); ?></b></h2><br>  
<table class="table" style="width: 100%" style="font-size: 20px"><!--Table for the member;s view-->
  <tr>
    <td style=" width:200%; height: 300px; width:150%;  overflow: auto;  display:block; width:130%;border-top-color: white; font-size: 20px">
<?php }   ?> 
<header class="panel-heading"><b>Deposits</b></header>
<table class="table" style="color: black; width: 100%">  
    <thead>
        <tr><?php
	            if($_SESSION['role'] != 'member')
	                $id=$_SESSION['user'];
	            else
	                $id=$_SESSION['user'];
        	?>
        <tbody>    
            <tr>
                <th>Date</th>
                <th>Time</th>
                <th>OR#</th>
                <th>Amount</th>
            </tr>
            <?php 
             $qrydep = "SELECT * FROM cash_transaction WHERE memberID='$id' ORDER BY dateReceived DESC";
             $result = mysqli_query($con, $qrydep);
             $totald=0; //totald -- total amount of deposit
             
             if(mysqli_num_rows($result) > 0): 
                while($row =mysqli_fetch_array($result)):       
                    $tnum= $row['transactionNum'];
                    $deposit="SELECT * FROM transaction WHERE transactionNum='$tnum' AND type='deposit' ORDER BY transactionNum DESC";
                    $desql= mysqli_query($con, $deposit);
                    while ($drow=mysqli_fetch_array($desql)):?>
                    <tr>
                        <td style="border-color:white"><?php echo formatDate($row['dateReceived']);?></td>
                        <td style="border-color:white"><?php echo formatTime($row['timeReceived']);?></td>
                        <td style="text-align: center; border-color: white"><?php echo $drow['cTransactionNum'];?></td>
                        <th style="border-color:white"><?php echo "Php ".formatMoney($drow['amount'],true)."";?></th>  
                        <?php  $totald=$totald+$drow['amount']; ?>
                    </tr>
             <?php
                endwhile;
             endwhile;
             else:
               echo '<p style="color:red; font-size: 20px;">No Records</p>';
             endif;
            ?> 
        </tbody>
</table>
<?php if ($_SESSION['role']=='member'){ ?>
        <td style="border-top-color: white; width: 2  0%;  "></td>
        <td class="table"  style="padding-left:20%; height: 300%; width:150%;  overflow: auto;  display:block; width: 150%; border-top-color: white; ">
          <?php      include './membersWithdrawals.php';?>
        </td>
      </tr>
      <tr>
        <td style="border-top-color: white">
          <h2>  TOTAL DEPOSIT: <?php echo "<b>PHP ".formatMoney($totald,true)."</b>"; ?> </h2>
        </td>
        <td style="border-top-color: white;width: 10%"></td>
        <td style="border-top-color: white; padding-left:4%" >          
        <h2>  TOTAL WITHDRAWAL: <?php echo "<b>PHP ".formatMoney($totalw,true)."</b>"; ?> </h2>
        </td>
      </tr>
</table><!--End of table for the member's view-->
           </section> <!--End of DiV and sections from the member.php page-->
         </div>
      </div>
    </div>
  </section>
</div>  
<?php include 'footer.php';}
include '../footer.php'; ?>