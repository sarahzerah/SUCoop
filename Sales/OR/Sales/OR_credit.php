<?php 
    include '../head.php';
    include '../functions.php';
    include '../connect.php';

    $chargeInvoiceNum1=$_GET['chargeInvoiceNum'];


    $qry="SELECT * FROM charge_invoice WHERE chargeInvoiceNum='$chargeInvoiceNum1'";
    $sql= mysqli_query($con,$qry);
    $rows =mysqli_fetch_array($sql);

    $date=$rows['dateBought'];
    $time=$rows['timeBought'];
    $totalAmount=$rows['totalAmount'];
    $memberID=$rows['memberID'];

    $qry1="SELECT * FROM member WHERE memberID='$memberID'";
    $sql1= mysqli_query($con,$qry1);
    $rows1 =mysqli_fetch_array($sql1);
    $userID=$rows['userID'];

    $qry2="SELECT * FROM user WHERE userID='$userID'";
    $sql2= mysqli_query($con,$qry2);
    $rows2 =mysqli_fetch_array($sql2);
    

?>

<link rel="stylesheet" href="css/receipt.css" />
    <div class="invoice-box">
    <!--Blanche : Changes starts from here-->
    
    <div id="printTable">
        <table cellpadding="0" cellspacing="0" align="center" class="or">
            <tr class="top">
                <td colspan="4" style="padding-bottom: 2%; padding-top: 5%">
                          <center>  <img alt="avatar" src="./img/small_logo.png" style=" float:">  </center>    
                </td>
            </tr>

            <!-- start of the tittle receipt -->
            <tr class="information">
                <td colspan="4">
                    <table  style="width: 100%">
                        <tr>
                            <td colspan="2" style="text-align: center;margin-left: 50%;">
                                <center>
                               <div style="font:bold 25px 'Aleo';">Charge Invoice</div>
                                    Silliman University Cooperative <br>
                                    Dumaguete City, Negros Oriental <br> 
                                    Telephone Number: 255-5892 <br><br>
                                </center>
                               
                            </td>
                                <tr >
                                    <td style="padding-bottom: 10px; padding-left: 5%">Charge Invoice No: <?php echo $chargeInvoiceNum1; ?></td>
                                </tr>
                                
                              
                                <tr> 
                                    <td style="padding-bottom: 10px; padding-left: 5%" >Date: <?php echo formatDate($date); ?></td>
                                </tr>

                                <tr> 
                                    <td style="padding-bottom: 10px; padding-left: 5%">Time: <?php echo formatTime($time); ?></td>
                                </tr>

                                 </table><br>
                            </td>
                        </tr>


            <!-- end of the tittle receipt -->
                   
            <tr class="heading">
                <th style="padding-left: 5%;width: 100%; padding-top: 10%">Item</th> 
                <th style="text-align: center;  padding-top: 10%">Quantity</th>
                <th style="padding-left:10%;text-align:right; padding-right: 10%; padding-top: 10%">Price</th>
                <th style="text-align: right; padding-right: 10%; padding-top: 10%">Total</th>
            </tr>

            <?php         

            $qry2 ="SELECT * FROM items WHERE chargeInvoiceNum= '$chargeInvoiceNum1 '";
            $sql2= mysqli_query($con,$qry2);
            while($row2=mysqli_fetch_array($sql2)):
                $pNum=$row2['productNum'];

                $qry3 ="SELECT * FROM inventory WHERE productNum= '$pNum'";
                $sql3= mysqli_query($con,$qry3);
                $row3=mysqli_fetch_array($sql3);
            ?>
      
            <tr>
                <td style="padding-left: 5%"><?php echo ucwords($row3['itemName']); ?></td>
                <td style="text-align: center;"><?php echo $row2['quantity']; ?></td>
                <td style="text-align: center; ">
                    <?php
                        $total=$row3['SRP']*$row2['quantity'];
                        echo "Php ".formatMoney($row3['SRP'], true)."<br>";
                    ?>
                </td>
                <td style="text-align: left;padding-right: 5%"><?php echo "Php ".formatMoney($total, true);?></td>
                <?php
                    endwhile;
                ?>  
            </tr>
            <tr class="Total">
            <td></td>
                <td colspan="3" style="padding-top: 10%; text-align: right; padding-right: 5%">Sub-total:&nbsp;&nbsp;
                    <?php 
                      
                 echo "<b>&nbsp;Php ".formatMoney($totalAmount, true)."</b>";
                       
                    ?>
                </td>
            </tr>
             <tr>
               
                 <td width="60%" style="text-align: center; padding-top: 10%">Signed by:</td><td colspan="2"></td></tr>
                   <td></td>
                 <tr><td width="20%" style="text-align: right;padding-bottom:10%" colspan="2"><u><?php echo $rows2['firstName']." ".$rows2['middleName'][0]." ".$rows2['lastName']; ?></u><br>Member</td></center>
            </tr>                 
        </table><br><br>

        <center>
            <table>
               
            </table>
    </div><!-- /#printPage -->
        <br>
        <br>
         <div class="row">
         <div class="col-md-6 col-md-offset-5">
           <button onclick="printData()" class="btn btn-danger btn-lg">Print </button>
         <div class="btn-group">

            
            <a class="btn btn-primary btn-lg" href="pos.php">Done</a>
        </div>  
         </div><!-- /.col-md-6 -->  
     </div><!-- /.row -->
    </div> 
    <!--Until here-->
<script>
function printData()
{
   var divToPrint=document.getElementById("printTable");
   newWin= window.open("");
   newWin.document.write(divToPrint.outerHTML);
   newWin.print();
   newWin.close();
}

</script>

</body>
</html>
