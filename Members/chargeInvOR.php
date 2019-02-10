<?php 
    include '../head.php';
    include '../functions.php';
    include '../connect.php';
    
        
    $trNum=$_GET['Num'];
    $sql2="SELECT * FROM cash_transaction WHERE  transactionNum ='$trNum'";
    $run= mysqli_query($con, $sql2);
    $rows= mysqli_fetch_array($run);
    $amount=$rows['amount']; 
    $dateR=$rows['dateReceived'];
    $timeR=$rows['timeReceived'];
    $memberID=$rows['memberID'];
    $type=$rows['type'];
    $salesNum=$rows['ORNum'];
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
                               <div style="font:bold 25px 'Aleo';">Charge Invoice</div>
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
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
                
                <td>
                    <?php
                        if ($type =='investment') 
                            echo "Share Capital"; 
                        if ($type =='deposit')
                            echo "Deposit";
                        if ($type =='withdrawal')
                            echo "Withdrawal";
                        if ($type=='cpayment')
                            echo "Credit Payment";
                    ?>
                </td>
                <td>
                <td></td>
               
                <td style="text-align: right">
                   <?php
                        echo "Php ".formatMoney($amount, true)
                        
                ?>
                
            </tr>
            <tr class="Total">
                       
    
                <?php 
                    if($type=='investment') :
                        $sql5="SELECT * FROM member WHERE memberID='$memberID'";
                        $run5= mysqli_query($con, $sql5);
                        $row5= mysqli_fetch_array($run5);
                        $totalInv=$row5['investment'];
                    ?>
               <td>Total Share Capital as of <?php echo formatDate($dateR); ?>: <?php echo "Php ".formatMoney($totalInv, true); ?>
                </td>
            <?php 
                endif;
                if (isset($type) && ($type=='deposit' || $type=='withdrawal')) :
                    $sql5="SELECT * FROM member WHERE memberID='$memberID'";
                    $run5= mysqli_query($con, $sql5);
                    $row5= mysqli_fetch_array($run5);
                    $totalSavings=$row5['savings'];
            ?>
                <br><br>Total Savings as of <?php echo formatDate($dateR); ?>: <?php echo "Php ".formatMoney($totalSavings, true); ?>
            <?php endif; 
                    if ($type=='cpayment') :
                    $sql5="SELECT * FROM member WHERE memberID='$memberID'";
                    $run5= mysqli_query($con, $sql5);
                    $row5= mysqli_fetch_array($run5);
                    $cBalance=$row5['creditBalance'];
            ?>

                <br><br>Credit Balance as of <?php echo formatDate($dateR); ?>: <?php echo "Php ".formatMoney($cBalance, true); ?>
            <?php endif; ?>
            </td>
            </tr>
                
        </table>
       <a href="cashTransaction.php" class="btn btn-danger btn-lg">back</a>
        <br>
        <br>
        
    </div>
    <!--Until here-->
</body>
</html>
