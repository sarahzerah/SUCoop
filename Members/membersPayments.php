
<?php
    $totalp=0;
?>
<header class="panel-heading" style="font-size: 20px"><b>Payments</b></header>
<table class="table" style="color: black; width: 200%; font-size: 20px" >
    <thead>
        <tr><?php
            if($_SESSION['role'] != 'member')
                    $id=$_SESSION['user'];
            else
                    $id=$_SESSION['user'];
            $qrydep = "SELECT * FROM cash_transaction WHERE memberID='$id' ORDER BY dateReceived DESC";
            $result = mysqli_query($con, $qrydep);
        ?>
                <th>Date</th>
                <th>Time</th>
                <th>OR# </th>
                <th>Amount</th>
            </tr>
    </thead>
            <?php 
             if(mysqli_num_rows($result) > 0): 
                while($row =mysqli_fetch_array($result)): 
                    $id= $row['transactionNum'];
                    $payment="SELECT * FROM transaction WHERE transactionNum='$id' AND type='cpayment' ORDER BY transactionNum DESC ";
                    $pqry=mysqli_query($con,$payment);
                    while($prow=mysqli_fetch_array($pqry)): ?>
            
                        <tbody>
                        <tr>    
                            <td style="border-color:white"><?php echo formatDate($row['dateReceived']); ?></td>
                            <td style="border-color:white"><?php echo formatTime($row['timeReceived']);?></td>
                             <td style="text-align: center; border-color: white"><?php echo $prow['cTransactionNum'];?></td>
                            <th style="border-color:white"><?php echo "Php ".formatMoney($prow['amount'],true);?></th> 
                            <?php $totalp=$totalp+$prow['amount'];   ?>
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

<?php  include '../footer.php'; ?>