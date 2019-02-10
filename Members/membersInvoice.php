<?php  
if (session_id() == '')
    include '../session.php';
if ($_SESSION['role'] =='member')
    include './member.php';

if ($_SESSION['role'] == 'member'){
		$id=$memberID ;
}else{
		 $id=$_SESSION['$memberID'];
}
   
    $sl= "SELECT * FROM charge_invoice WHERE memberID='$id' ORDER BY dateBought DESC ";
    $slrun= mysqli_query($con, $sl);

    $totalc=0;
?>  
<!--IF the user is a member-->
<?php if ($_SESSION['role'] =='member') { ?>
    <h2><strong style="color: black">Credit Limit: <?php echo "Php ".formatMoney($creditLimit,true); ?></strong></h2>
    <h2 style="padding-bottom:1.5%;color: black"><strong style="color: black">Credit Balance: <?php echo "Php ".formatMoney($creditBalance,true); ?></strong></h2><br>
    <table class="table" style="width: 100%" >
        <tr>
        <td style="height: 400px; width:100%; overflow: auto;  display:block;border-top-color: white; font-size: 20px" >
<?php }  ?>   

<!--If the user is not a member-->
<header class="panel-heading"><b>Invoices</b></header>
    <table class="table" style="color: black; width: 100%; font-size: 20px">
        <thead>
            <tr>
                <th>Date</th>
                <th>Time</th>
                <th>Charge Invoice#</th>
                <th>Amount</th>
                <th></th>
            </tr>
        </thead>                                             
<?php
    if(mysqli_num_rows($slrun) > 0): 
        while($rosl =mysqli_fetch_array($slrun)):?>
        <tbody>
            <tr>
                <td style="border-color:white"><?php echo formatdate($rosl['dateBought']); ?> </td>
                <td style="border-color:white"><?php echo $rosl['timeBought']; ?> </td>
                <td style="border-color:white"><?php echo $rosl['chargeInvoiceNum']; ?> </td>
                <th style="border-color:white"><?php echo "Php ".formatMoney($rosl['totalAmount'],true); ?> </th>
                <?php $totalc=$totalc+$rosl['totalAmount']; ?>
                <td style="border-color:white" > 
            <?php if ($_SESSION['role']!='member'){   ?>
            <form method="post" action="invoice.php">
                <input type="Submit" name="submit_member" value="View" class="btn btn-primary">
                <input type="hidden" value="<?php echo $rosl['chargeInvoiceNum']; ?>" name="id" >
                <input type="hidden" value="<?php echo $_SESSION['user']; ?>" name ="userid" >
            </form>

             <?php } else { ?>
            <form method="post" action="invoice.php">
                <input type="Submit" name="submit_member" value="View" class="btn btn-primary">
                <input type="hidden" value="<?php echo $rosl['chargeInvoiceNum']; ?>"  name="id" />
                <input type="hidden" value="<?php echo $_SESSION['user_id']; ?>" name ="userid" />
            </form>
            <?php } ?>
                </td> 
            </tr>
            <?php 
                endwhile;
                else:
                    echo '<p style="color:red; font-size: 20px;">No Record </p>';
                endif; 
            ?>     
        </tbody>
    </table>

<!--Condition if the user is a member-->
<?php if ($_SESSION['role']=='member'){ 

    ?>      </td> 
            <td style="border-top-color: white"></td>
            <td  style="  width:200%; height: 500px; width:200%; overflow: auto; display:block;  border-top-color: white">           
                <?php include './membersPayments.php'; ?>
            </td>
            </tr>
            <tr>
        <td style="border-top-color: white">
          <h2>  TOTAL CREDIT: <?php echo "<b>PHP ".formatMoney($totalc,true)."</b>"; ?> </h2>
        </td>
        <td style="border-top-color: white;width: 10%"></td>
        <td style="border-top-color: white; padding-left:4%" >          
        <h2>  TOTAL PAYMENT: <?php echo "<b>PHP ".formatMoney($totalp,true)."</b>"; ?> </h2>
        </td>
      </tr>
        </table>    
             </div>
            </div>  
        </section>
    </div> 
</section>           
<?php  include 'footer.php'; }
include '../footer.php'; ?>