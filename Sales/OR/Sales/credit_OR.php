<?php 
    include '../head.php';
    include '../functions.php';
   

    $salesNum=$_GET['salesNum'];
    if (isset($_GET['credit'])) {
        $credit=$_GET['credit'];
          $type=null;
    }
    $Num= $salesNum-1;

    include '../connect.php';

    $qry="SELECT * FROM sales WHERE ORNum='$Num'";
    $sql= mysqli_query($con,$qry);
    $rows =mysqli_fetch_array($sql);

    $date=$rows['dateBought'];
    $time=$rows['timeBought'];
    $totalAmount=$rows['totalAmount'];

?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice</title>
    

</head>

<body>
    <div class="invoice-box">
   <!--  printing start here -->
     <div style="width: 100%; height: 190px;"  id="printTable">

        <table cellpadding="0" cellspacing="0" align="center" >
            <tr class="top">
                <td colspan="4">
                          <center>  <img alt="avatar" src="./img/small_logo.png" style=" float:">  </center>    
                </td>
            </tr>
            <!-- start of receipt tittle -->
            <tr class="information">
                <td colspan="4">
                    <table>   

                        <tr>
                            <td colspan="2">
                                <center>
                               <div style="font:bold 25px 'Aleo';">Official Receipt</div>
                                    Siliman University Cooperative <br>
                                    Dumaguete City, Negros Oriental <br> 
                                    Telephone Number: 255-5892 <br><br>
                                </center>
                               
                            </td>
                                <tr>
                                    <td style="padding-bottom: 10px">OR No: <?php echo $salesNum; ?></td>
                                </tr>
                                
                                <?php if ($type==null) : ?>
                                <tr> 
                                    <td style="padding-bottom: 10px" >Date: <?php echo formatDate($date); ?></td>
                                </tr>

                                <tr> 
                                    <td>Time: <?php echo formatTime($time); ?></td>
                                </tr>
                                <?php else : ?>
                                <tr> 
                                    <td style="padding-bottom: 10px">Date: <?php echo formatDate($dateR); ?></td>
                                </tr>

                                <tr> 
                                    <td >Time: <?php echo formatTime($timeR); ?></td>
                                </tr>
                              <?php endif;?>

                            </table>
                            </td>

                        </tr>
                    
    <!-- end of receipt tittle -->
                    <tr class="heading">
                        <td>Item</td> 
                        <td>Quantity</td>
                        <td style="text-align: right">Price</td>
                        <td style="text-align: right">Total</td>
                    </tr>
                    <?php
                          
            if (!isset($_GET['type'])) : 
                            $qry2 ="SELECT * FROM items WHERE ORNum= '$Num'";
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
                            endif;

                            if (isset($_GET['type'])) : 
                        ?>
                        <td>
                        <td></td>
                       
                        <td style="text-align: right">
                           <?php
                                echo "Php ".formatMoney($amount, true);
                                endif;        
                        ?>          
                    </tr>
                    <tr class="Total">
                        <td></td>
                        <td colspan="3" style="padding-top: 10%">Sub-total:&nbsp;&nbsp;
                    <?php 
                   
                    echo "<b>&nbsp;Php ".formatMoney($totalAmount, true)."</b>";
                
                         ?>
                    </tr>
                          
        </table>
    </div><!--end /.print -->
            <button class="btn btn-primar btn-lg"><i class="icon-print"></i> Print</button><!-- printing button -->
  
            <br>
            <br>
            <div class="btn-group">
                <?php $newSales=$salesNum+1; 
                      $_SESSION['salesNum']=$newSales; ?>
                <a class="btn btn-primary" href="credit_OR.php?salesNum=<?php echo $newSales; ?>">Done</a>
            </div>
    </div>
     <script>
        function printData()
                {
                   var divToPrint=document.getElementById("printTable");
                   newWin= window.open("");
                   newWin.document.write(divToPrint.outerHTML);
                   newWin.print();
                   newWin.close();
                }

                $('button').on('click',function(){
                printData();
                })

    

    </script>
</body>
</html>

