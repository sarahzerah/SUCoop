
<?php 
    include '../head.php';
    include '../functions.php';
    include '../connect.php';
    //include '../session.php';

    $transactionNum=$_SESSION['transactionNum'];
    
    $sql2="SELECT * FROM cash_transaction WHERE  transactionNum ='$transactionNum'";
    $run= mysqli_query($con, $sql2);
    $rows= mysqli_fetch_array($run);
    
    $sql3="SELECT * FROM transaction WHERE  transactionNum ='$transactionNum'";
    $run2= mysqli_query($con, $sql3);
    $rows2= mysqli_fetch_array($run2);
    
    $type=$rows2['type'];
    $amount=$rows['totalAmount']; 
    $dateR=$rows['dateReceived'];
    $timeR=$rows['timeReceived'];
    $memberID=$rows['memberID'];
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
     <div id="printTable" style="padding-left: 20%">
        <table cellpadding="0" cellspacing="0" align="center" class="or"  >
            <tr class="top">
                <td colspan="4" style="padding-bottom: 2%; padding-top: 5%">
                          <center>  <img alt="avatar" src="./img/sucoop.png" width="100" height="100" style=" float:">  </center>    
                </td>
            </tr>
            <tr class="information">
                <td colspan="4">
                    <table  align="center">
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
                                    <td style="padding-bottom: 10px"><?php if ($type=="withdrawal") echo "Withdrawal No: "; else echo "Cash Transaction No: ";?><?php echo $transactionNum; ?></td>
                                </tr>
                                
                                <tr> 
                                    <td style="padding-bottom: 10px" >Date: <?php echo formatDate($dateR); ?></td>
                                </tr>

                                <tr> 
                                    <td>Time: <?php echo formatTime($timeR); ?></td>
                                </tr>
                                
                               
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                    <td><b>Type of transaction</b></td>
                    <td colspan="2"><b>Amount</b></td>
            </tr>
             <?php 
                $qry2 ="SELECT * FROM transaction WHERE transactionNum= '$transactionNum'";
                    $sql2= mysqli_query($con,$qry2);
                    while($row2=mysqli_fetch_array($sql2)):
            ?>
          

            <tr>
                <td><?php if ($type=='cpayment')
                            echo "Credit Payment";
                          else
                            echo ucwords($type); ?></td>
                <td style="text-align: right" colspan="2">
                    <?php
                        echo "Php ".formatMoney($row2['amount'], true)."<br>";
                    ?>
                </td>
                
                <?php
                    endwhile;
                ?>
            </tr>
            <tr>
                <td style="padding-top: 20%"></td>
                <td></td>
                <td style="text-align: right">Total: <?php echo formatMoney($_SESSION['total'], true); ?></td>
            </tr>
                
        </table>
        </div><!-- /#printPage -->
        
        <br>
        <br>
     <div class="row">
         <div class="col-md-6 col-md-offset-5">
           <button onclick="printData()" class="btn btn-danger btn-lg">Print </button>
         <div class="btn-group">
<?php $_SESSION['transactionNum']+=1; 
            mysqli_query($con,"UPDATE cash_transaction SET totalAmount='{$_SESSION['total']}' WHERE transactionNum='$transactionNum'");

            unset($_SESSION['memberID']);
            unset($_SESSION['invest']);
            unset($_SESSION['deposit']);
            unset($_SESSION['withdraw']);
            unset($_SESSION['cpay']);
            unset($_SESSION['total']);?>

       <a href="cashTransaction.php" class="btn btn-primary btn-lg">Done</a>
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
