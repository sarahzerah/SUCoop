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
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice</title>
    
    <style>
    .invoice-box {
        max-width: 800px;
        margin: auto;
        padding: 30px;
        border: 1px solid #eee;
        box-shadow: 0 0 10px rgba(0, 0, 0, .15);
        font-size: 16px;
        line-height: 24px;
        font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color: #555;
    }
    
    .invoice-box table {
        width: 100%;
        line-height: inherit;
        text-align: left;
    }
    
    .invoice-box table td {
        padding: 5px;
        vertical-align: top;
    }
    
    .invoice-box table tr td:nth-child(2) {
        text-align: right;
    }
    
    .invoice-box table tr.top table td {
        padding-bottom: 20px;
    }
    
    .invoice-box table tr.top table td.title {
        font-size: 45px;
        line-height: 45px;
        color: #333;
    }
    
    .invoice-box table tr.information table td {
        padding-bottom: 40px;
    }
    
    .invoice-box table tr.heading td {
        background: #eee;
        border-bottom: 1px solid #ddd;
        font-weight: bold;
    }
    
    .invoice-box table tr.details td {
        padding-bottom: 20px;
    }
    
    .invoice-box table tr.item td{
        border-bottom: 1px solid #eee;
    }
    
    .invoice-box table tr.item.last td {
        border-bottom: none;
    }
    
    .invoice-box table tr.total td:nth-child(2) {
        border-top: 2px solid #eee;
        font-weight: bold;
    }
    
    @media only screen and (max-width: 600px) {
        .invoice-box table tr.top table td {
            width: 100%;
            display: block;
            text-align: center;
        }
        
        .invoice-box table tr.information table td {
            width: 100%;
            display: block;
            text-align: center;
        }
    }
    
    /** RTL **/
    .rtl {
        direction: rtl;
        font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
    }
    
    .rtl table {
        text-align: right;
    }
    
    .rtl table tr td:nth-child(2) {
        text-align: left;
    }
    </style>
</head>

<body>
  <div class="invoice-box">
    <!--Blanche : Changes starts from here-->
     <div id="printTable">
        <table cellpadding="0" cellspacing="0" align="center" class="or">
            <tr class="top">
                <td colspan="4" style="padding-bottom: 2%; padding-top: 5%">
                          <center>  <img alt="avatar" src="./img/sucoop.png" width="100" height="100" style=" float:">  </center>    
                </td>
            </tr>
            <tr class="information">
                <td colspan="4">
                    <table style="width: 100%">
                        <tr>
                            <td colspan="2" style="text-align: center;margin-left: 50%;">
                               <div style="font:bold 25px 'Aleo';">Official Receipt</div>
                                    Silliman University Cooperative <br>
                                    Dumaguete City, Negros Oriental <br> 
                                    Telephone Number: 255-5892 <br><br>
                            </td>
                                <tr>
                                    <td style="padding-bottom: 10px; padding-left: 5%">OR No: <?php echo $salesNum; ?></td>
                                </tr>
                                
                              
                                <tr> 
                                    <td style="padding-bottom: 10px; padding-left: 5%" >Date: <?php echo formatDate($date); ?></td>
                                </tr>

                                <tr> 
                                    <td style=" padding-left: 5%">Time: <?php echo formatTime($time); ?></td>
                                </tr>
                            </td>
                        </tr>
                    </table>
            <tr class="heading">
                <th style="padding-top: 10%; padding-left: 5%">Item</th> 
                <th style="padding-top: 10%; padding-left: 5%">Quantity</th>
                <th style="padding-top: 10%; padding-left: 10%">Price</th>
                <th style="padding-top: 10%; padding-left: 10%">Total</th>
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
                <td style="padding-left: 5%"><?php echo ucwords($row3['itemName']); ?></td>
                <td style="padding-left:5%; text-align: center"><?php echo "".$row2['quantity']; ?></td>
                <td style="padding-left: 8%">
                    <?php
                        $total=$row3['SRP']*$row2['quantity'];
                        echo "Php ".formatMoney($row3['SRP'], true)."<br>";
                    ?>
                </td>
                <td style="padding-left: 10%; margin-left: 20%; padding-right: 5%"><?php echo "Php ".formatMoney($total, true);?></td>
                <?php
                    endwhile;
                ?>  
            </tr>

            <tr class="Total">
            <td></td>
                <td colspan="3" style="padding-right: 1%; padding-top: 10%;text-align: right">Total:&nbsp;&nbsp;
                    <?php 
                      
                 echo "<b>&nbsp;Php ".formatMoney($totalAmount, true)."</b>";
                 mysqli_query($con,"UPDATE cash_sales SET totalAmount='$totalAmount' WHERE ORNum='$salesNum'");
                       
                    ?>
                </td>
            </tr>
                <tr>
                    <td>
                        <td colspan="3" style="text-align: right;  padding-right: 5%">Cash Received:
                            <?php  echo "<b>&nbsp;Php ".formatMoney($cash, true)."</b>"; ?>
                        </td>
                    </td>
                </tr>
                <tr> <td>
                        <td colspan="3" style="text-align: right; padding-bottom: 10%;  padding-right: 5%">Change:&nbsp;&nbsp;&nbsp;<?php 
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
