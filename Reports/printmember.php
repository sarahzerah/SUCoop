<?php 
    include '../head.php';
    include '../functions.php';
    include '../connect.php';
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice</title>
    
    <style>
    .invoice-box {
        max-width: 800px    ;
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
        <table cellpadding="0" cellspacing="0" align="center" class="or" width="90%">
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
                              
                                    Silliman University Cooperative <br>
                                    Dumaguete City, Negros Oriental <br> 
                                    Telephone Number: 255-5892 <br><br>
                            </td>
                                <tr>
                                    <td>
                                    <header>  <h3 class='page-header'><b><br>Members' Report as of <?php echo date ("F d, Y"); ?></b> </h3></header><br>
                                        
                                       <h3 class='page-header'>Total of Members    : 
                                       <?php 
                                          include '../connect.php';
                                          $resul = "SELECT * FROM user WHERE role='member' AND status='active'";
                                          $sql= mysqli_query($con,$resul);
                                          $numMem= mysqli_num_rows($sql);

                                          echo "<b> ".$numMem. "</b>";
                                        ?>
                                    
                                    <br>     
                                Member's Total Share Capital: 
                                      <?php
                                        $qry2="SELECT SUM(investment) FROM member";
                                        $sql3= mysqli_query($con,$qry2);
                                        $row2 = mysqli_fetch_array($sql3);
                                        echo "<b>Php ".formatMoney($row2['SUM(investment)'], true). "</b>";
                                      ?>
                            
                                <br>
                              
                                 Member's Total Credit:
                                     <?php
                                        $qry3="SELECT SUM(creditBalance) FROM member";
                                        $sql4= mysqli_query($con,$qry3);
                                        $row3 = mysqli_fetch_array($sql4);
                                        echo "<b>Php ".formatMoney($row3['SUM(creditBalance)'], true). "</b>";
                                    ?>
                              </h3>
                                    </td>
                                </tr>
                            
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <?php
                                include '../connect.php';
                                $resul = "SELECT * FROM member where creditBalance >= creditLimit-500 AND creditBalance != 0 AND status='active' AND creditLimit!=0";
                                 $sql2= mysqli_query($con,$resul);
                               if (mysqli_num_rows( $sql2) > 0):
                                 include 'creditStatus.php';
                                 endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                               <?php include 'creditsList.php'; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                 <?php include 'investmentList.php'; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <?php include 'savingsList.php'; ?>
                            </td>
                        </tr>
                    </table>
            <tr class="heading">
             
            </tr>

        </table>
        </div><!-- /#printPage -->
        
        <br>
        <br>
     <div class="row">
         <div class="col-md-6 col-md-offset-5">
           <button onclick="printData()" class="btn btn-primary btn-lg">Print </button>
         <div class="btn-group">

          
            <a class="btn btn-primary btn-lg" href="membersReport.php">Back</a>
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
