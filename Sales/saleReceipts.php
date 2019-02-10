<?php 
    include '../head.php';
    include '../functions.php';
   

    $salesNum=$_GET['salesNum'];
    if (isset($_GET['cash'])) {
        $cash=$_GET['cash'];
          $type=null;
    }

    include '../connect.php';
    $qry="SELECT * FROM sales WHERE ORNum='$salesNum'";
    $sql= mysqli_query($con,$qry);
    $rows =mysqli_fetch_array($sql);

    $date=$rows['dateBought'];
    $time=$rows['timeBought'];
    $totalAmount=$rows['totalAmount'];


?>
<!DOCTYPE html>
<html lang="en">
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
<div class="printTable">
    <!-- Place here the table for printig -->
    <div class="invoice-box">
    <table cellpadding="0" cellspacing="0" align="center" >
               <tr class="top">
                <td colspan="4">
                  <center>  <img alt="avatar" src="./img/small_logo.png" style=" float:">  </center>    
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
                              <b>Cash Receipt</b>
                            </td>
                                <tr>
                                    <td style="padding-bottom: 10px">OR No: <?php echo $salesNum; ?></td>
                                </tr>
                                <tr> 
                                    <td style="padding-bottom: 10px" >Date: <?php echo formatTime($time); ?></td>
                                </tr>
                    </table>
                </td>
             </tr>
               
            <!-- table label -->
                <tr class="heading">
                    <td>Item</td> 
                    <td>Quantity</td>
                    <td style="text-align: right">Price</td>
                    <td style="text-align: right">Total</td>
                </tr>
            <!-- end of table lebel -->
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
                     </tr>
            <!-- start of computation -->
            <br><br>
</table>
                <table border="0">
                    <tr>
                        <th colspan="3" border="0">Sub-total:</th>

                            <?php 
                                if ($totalAmount!=null)
                                    echo "<b>&nbsp;Php ".formatMoney($totalAmount, true)."</b>";
                                else
                                    echo "Php ".formatMoney($amount,true);
                            ?>
                    </tr>
                   <br>
                    <tr>
                      <th colspan="3">Cash Received: </th>
                         <?php echo "<b>&nbsp;Php ".formatMoney($_GET['cashR'], true)."</b>"; ?>
                   </tr><br>
                    <tr>
                      <th colspan="3">Change:</th><br>
                           <?php  echo "<b>&nbsp;Php ".formatMoney(abs($_GET['change']), true)."</b>";
                            ?>
                    </tr>
                </table>

                <br>
                <br>
                               
            <!-- end of computation -->
    </table>


</div><!-- /.printTable --> 
<script type="text/javascript"> 
if (window.print) {
document.write('<form><input type=button name=print value="Print"onClick="window.print()"></form>');
}
</script>
</body>
</html>


