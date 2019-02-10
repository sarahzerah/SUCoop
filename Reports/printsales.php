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
        <table cellpadding="0" cellspacing="0" align="center" class="or" width="80%">
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
                        </tr>
                        <tr class="heading">
                             <?php $day= $_POST['asof'];?>
                                <td><h3><b><br>SALES REPORT  of
                                                  <?php $datepress=$_POST['asof'];
                                                        echo $datepress;
                                                    ?> </b></h3>
                               </td>
                         </tr>
                         <tr>
                             <td>        
                            <?php 
                        
                                $getotal=$_POST['total'];
                                echo "<h3><b>Total Coop Sales : &nbsp;&nbsp; Php ".$getotal."</b> ";
                                $ctotal=$_POST['consigned'];
                                echo "<br><b> Total Sales of Consigned Items : &nbsp;&nbsp; Php ".$ctotal."</h3><b> ";                 
                            ?>
                            </td>
                        </tr> 
                        <tr>
                            <td>
                             
   <h3><b>Fast Moving Items</b> </h3>
<?php

    $qry5="SELECT DISTINCT(productNum) AS productNum FROM items ORDER BY quantity DESC";
    $sql5= mysqli_query($con,$qry5);
?>

  <table class="table table-striped table-advance table-hover" style="padding-right:15%; color: black" id="userTbl" align="center" width="100%">
    <tbody>


           <tr>
            <th style=" font-style: bold; text-align: left">Item </th>
            <th style=" font-style: bold; text-align: center"> Quantity </th>
            </tr>
            
             <?php

                    date_default_timezone_set("Asia/Manila");
 
                    if (($_POST['date'] == 'day')){  
                          $day=date("Y-m-d");
                          $fast="SELECT * FROM cash_sales WHERE dateBought='$day' ORDER BY ORNum DESC";
                          $fastinv="SELECT * FROM charge_invoice WHERE dateBought='$day' ORDER BY chargeInvoiceNum DESC";
                          include 'movingitem.php';

                    }else if (($_POST['date'] == 'month')){  
                          $day=date("m");
                          $fast="SELECT * FROM cash_sales WHERE EXTRACT(Month from dateBought)='$day'";
                          $fastinv="SELECT * FROM charge_invoice WHERE EXTRACT(Month from dateBought)='$day'";
                          include 'movingitem.php';
                         
                    }else if (($_POST['date'] == 'year')){
                       $day=date("Y");
                       $fast="SELECT * FROM cash_sales WHERE EXTRACT(Year from dateBought)='$day'";
                       $fastinv="SELECT * FROM charge_invoice WHERE EXTRACT(Year from dateBought)='$day'";
                          include 'movingitem.php';
                      
                    }else {
                       $fast="SELECT * FROM cash_sales";
                       $fastinv="SELECT * FROM charge_invoice";
                       include 'movingitem.php';
                   
                    }              
        ?> 
        
     </tbody>
 </table>
</td>
</tr>
</table>   
</td>
</tr>
</table> 

        </div><!-- /#printPage -->
        
        <br>
        <br>
     <div class="row">
         <div class="col-md-6 col-md-offset-5">
           <button onclick="printData()" class="btn btn-primary btn-lg">Print </button>
         <div class="btn-group">

          
            <a class="btn btn-primary btn-lg" href="salesReport.php">Back</a>
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
