<?php 
    include '../head.php';
    include '../functions.php';
    include '../connect.php';

    $salesNum=$_GET['salesNum'];
    $cash=$_GET['cash'];


    $qry="SELECT * FROM cash_sales WHERE ORNum='$salesNum'";
    $sql= mysqli_query($con,$qry);
    $rows =mysqli_fetch_array($sql);

    $date=$rows['dateBought'];
    $time=$rows['timeBought'];
    $totalAmount=$rows['totalAmount'];
   
?>
<link rel="stylesheet" href="css/receipt.css" />
  <div class="invoice-box">
    <!--Blanche : Changes starts from here-->
     <div id="printTable">
        <table cellpadding="0" cellspacing="0" align="center" >
            <tr class="top">
                <td colspan="4">
                          <center>  <img alt="avatar" src="./img/sucoop.png" width="100" height="100" style=" float:">  </center>    
                </td>
            </tr>
            <tr class="information">
                <td colspan="4">
                    <table>
                        <tr>
                            <td colspan="2">
                                <center>
                               <div style="font:bold 25px 'Aleo';">Official Receipt</div>
                                    Silliman University Cooperative <br>
                                    Dumaguete City, Negros Oriental <br> 
                                    Telephone Number: 255-5892 <br><br>
                                </center>
                               
                            </td>
                                <tr>
                                    <td style="padding-bottom: 10px">OR No: <?php echo $salesNum; ?></td>
                                </tr>
                                
                              
                                <tr> 
                                    <td style="padding-bottom: 10px" >Date: <?php echo formatDate($date); ?></td>
                                </tr>

                                <tr> 
                                    <td>Time: <?php echo formatTime($time); ?></td>
                                </tr>
                            </td>
                        </tr>
                    </table>
            <tr class="heading">
                <td>Item</td> 
                <td>Quantity</td>
                <td style="text-align: right">Price</td>
                <td style="text-align: right">Total</td>
            </tr>

            <?php         

            $qry2 ="SELECT * FROM items WHERE ORNum= '$salesNum'";
            $sql2= mysqli_query($con,$qry2);
            while($row2=mysqli_fetch_array($sql2)):
                $pNum=$row2['productNum'];

                $qry3 ="SELECT * FROM inventory WHERE productNum= '$pNum'";
                $sql3= mysqli_query($con,$qry3);
                $row3=mysqli_fetch_array($sql3);
            ?>
      
            <tr>
                <td><?php echo ucwords($row3['itemName']); ?></td>
                <td><?php echo $row2['quantity']; ?></td>
                <td style="text-align: right">
                    <?php
                        $total=$row3['SRP']*$row2['quantity'];
                        echo "Php ".formatMoney($row3['SRP'], true)."<br>";
                    ?>
                </td>
                <td style="text-align: right"><?php echo "Php ".formatMoney($total, true);?></td>
                <?php
                    endwhile;
                ?>  
            </tr>
            <tr class="Total">
            <td></td>
                <td colspan="3" style="padding-top: 10%">Sub-total:&nbsp;&nbsp;
                    <?php 
                      
                 echo "<b>&nbsp;Php ".formatMoney($totalAmount, true)."</b>";
                       
                    ?>
                </td>
            </tr>
                <tr>
                    <td>
                        <td colspan="3">Cash Received:
                            <?php  echo "<b>&nbsp;Php ".formatMoney($cash, true)."</b>"; ?>
                        </td>
                    </td>
                </tr>
                <tr> <td>
                        <td colspan="3">Change:&nbsp;&nbsp;&nbsp;<?php 
                                $change=$cash-$totalAmount;
                                echo "<b>&nbsp;Php ".formatMoney($change, true)."</b>";
                            ?>
                        </td>
                    
                    </td>
                </tr>
        </table>
        </div><!-- /#printPage -->
        
        <br>
        <br>
     <div class="row">
         <div class="col-md-6 col-md-offset-5">
           <button onclick="printData()" class="btn btn-danger btn-lg">Print </button>
         <div class="btn-group">

            <?php $newSales=$salesNum+1; 
                  $_SESSION['salesNum']=$newSales; ?>
            <a class="btn btn-primary btn-lg" href="pos.php?salesNum=<?php echo $newSales; ?>">Done</a>
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

<script>    
if(typeof window.history.pushState == 'function') {
window.history.pushState({}, "Hide", '<?php echo $_SERVER['PHP_SELF'];?>');
}
</script>
