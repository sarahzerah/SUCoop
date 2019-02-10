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
    $userID=$rows1['userID'];

    $qry2="SELECT * FROM user WHERE userID='$userID'";
    $sql2= mysqli_query($con,$qry2);
    $rows2 =mysqli_fetch_array($sql2);
    

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
        <table cellpadding="0" cellspacing="0" align="center" >
            <tr class="top">
                <td colspan="4">
                          <center>  <img alt="avatar" src="./img/small_logo.png" style=" float:">  </center>    
                </td>
            </tr>

            <!-- start of the tittle receipt -->
            <tr class="information">
                <td colspan="4">
                    <table>
                        <tr>
                            <td colspan="2">
                                <center>
                               <div style="font:bold 25px 'Aleo';">Charge Invoice</div>
                                    Silliman University Cooperative <br>
                                    Dumaguete City, Negros Oriental <br> 
                                    Telephone Number: 255-5892 <br><br>
                                </center>
                               
                            </td>
                                <tr>
                                    <td style="padding-bottom: 10px">Charge Invoice No: <?php echo $chargeInvoiceNum1; ?></td>
                                </tr>
                                
                              
                                <tr> 
                                    <td style="padding-bottom: 10px" >Date: <?php echo formatDate($date); ?></td>
                                </tr>

                                <tr> 
                                    <td>Time: <?php echo formatTime($time); ?></td>
                                </tr>

                                 </table><br>
                            </td>
                        </tr>


            <!-- end of the tittle receipt -->
                   
            <tr class="heading">
                <td>Item</td> 
                <td>Quantity</td>
                <td style="text-align: right">Price</td>
                <td style="text-align: right">Total</td>
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
                       mysqli_query($con,"UPDATE charge_invoice SET totalAmount='$totalAmount' WHERE chargeInvoiceNum='$chargeInvoiceNum1'");
                    ?>
                </td>
            </tr>                 
        </table><br><br>

        <center>
            <table>
                <tr><td width="60%">Signed by:</td><td colspan="2"></td></tr>
                 <tr><td width="20%" colspan="2"></td><td><u><?php echo $rows2['firstName']." ".$rows2['middleName'][0]." ".$rows2['lastName']; ?></u><br>Member</td></center>
                </tr>
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
