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
        <table cellpadding="0" cellspacing="0" align="center" class="or" width="70%">
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
                                  <h3 style="color: black"><b>Inventory Report as of <?php echo date ("F d, Y"); ?></b>  </h3>
                                        
                                       <h3>  Item/s Running out: 
                                       <?php 
                                          include '../connect.php';
                                          $resul = "SELECT * FROM inventory WHERE quantity <= 10  AND category != 'serving'";
                                          $sql= mysqli_query($con,$resul);
                                          $outstock= mysqli_num_rows($sql);

                                          echo "<b>&nbsp;&nbsp;".$outstock."</b>";
                                        ?>
                                   <br>
                                    Number of supplier : 
                                     <?php 
                                   
                                          $resul2 = "SELECT * FROM supplier";
                                          $sql2= mysqli_query($con,$resul2);
                                          $numSup= mysqli_num_rows($sql2);

                                          echo "<b>&nbsp;&nbsp;".$numSup."</b>";
                                    ?>
                           
                                <br>
                               Number of items: 
                                    <?php 
                              
                                      $resul3 = "SELECT DISTINCT(itemName) FROM inventory";
                                      $sql3= mysqli_query($con,$resul3);
                                      $product= mysqli_num_rows($sql3);

                                      echo "<b>&nbsp;&nbsp;".$product."</b>";
                                    ?>
                               </h3>
                                    </td>
                                </tr>
                            
                            </td>
                            <td>
                            <h3><b>Items Running Out and Out of Stock</b></h3>

<table class="table table-striped table-advance table-hover"  id="userTbl"  width="100%" style="font-size: 20px; color: black">
                <tbody>
                    <tr>
                        <th style="text-align: left"><i class="icon_profile"></i>Item Name</th>
                        <th colspan="4" style="text-align: center">Quantity</th>
                    </tr>
<?php 

        $resul = "SELECT * FROM inventory where quantity <= 10  AND unit!='serving'
           ORDER BY quantity";
                $sql= mysqli_query($con,$resul);

              if(mysqli_num_rows($sql) >= 0): 

                while ($row= mysqli_fetch_array($sql)) :  ?>
                    <tr>
                        <td>
                             <?php 
                        echo ucwords($row['itemName']);
                    ?>
                        </td>

                         <td style="text-align: center">
                             <?php 
                        echo $row['quantity'];
                    ?>
                        </td>

                    </tr>
                      <?php 
                     endwhile;
                        else:
                       echo '<p style="color:red; font-size: 20px;">No History</p>';
                        endif;
                        ?> 
                </tbody>
            </table>
                            </td>
                        </tr>
                    </table>
    
        </table>
        </div><!-- /#printPage -->
        
        <br>
        <br>
     <div class="row">
         <div class="col-md-6 col-md-offset-5">
           <button onclick="printData()" class="btn btn-primary btn-lg">Print </button>
         <div class="btn-group">

          
            <a class="btn btn-primary btn-lg" href="inventoryReport.php">Back</a>
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
