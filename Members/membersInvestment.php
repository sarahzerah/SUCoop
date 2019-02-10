<?php
if (session_id() == '')
    include '../session.php';
if ($_SESSION['role'] =='member')
    include 'member.php';
?>

<h1><strong style="color: black;font-size: 36px">Total Share Capital:Php  <?php echo formatMoney($investment,true);?></strong></h1><br>
<div class="table-responsive" <?php if ($_SESSION['role']=='member'){ ?> style="width: 50%; height: 300px; overflow: auto;  display:block; width: 150%;" <?php } ?> >
    <table class="table"  style="color: black"  >
        <?php
      
             $id=$_SESSION['user'];
            $qryinvs = "SELECT * FROM cash_transaction WHERE memberID='$id' ORDER BY dateReceived DESC";
            $result = mysqli_query($con, $qryinvs);
        ?>
        <thead>
            <tr>

                <th style="font-size: 20px">Date</th>
                <th style="font-size: 20px">Time</th>
                <th style="font-size: 20px">Amount</th>
                <th style="font-size: 20px">OR#</th>
            </tr>
        </thead>
            <?php 
            if(mysqli_num_rows($result) > 0): 
                while($row =mysqli_fetch_array($result)): 
                    $share= $row['transactionNum'];
                    $sharecapital="SELECT * FROM transaction WHERE transactionNum='$share' AND type='investment' ORDER BY transactionNum DESC";
                    $shareqry = mysqli_query($con, $sharecapital);
                    while ($irow=mysqli_fetch_array($shareqry) ): ?>
                        <tbody>
                        <tr>
                            <td style="font-size: 20px; border-color: white"><?php echo formatDate($row['dateReceived']); ?></td>
                            <td style="font-size: 20px; border-color: white"><?php echo formatTime($row['timeReceived']);?></td>
                            <th style="font-size: 20px;border-color: white"><?php echo "Php ".formatMoney($irow['amount'],true);?></th>
                            <th style="font-size: 20px;border-color: white"><?php echo $row['transactionNum'];?></th>
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
</div>
<?php include '../footer.php'; ?>