<?php 
 //error_reporting(0);
include '../head.php';  
include '../functions.php';
?>
<section id="container">

<?php 
include '../header.php';
include '../sidebar.php';

?>
<section id="main-content" style="padding-left: 5%; padding-right: 2%">
<section class="wrapper">
<div class="row">
<div class="col-lg-12">
<h1 class="page-header"><br>POS</h1>
</div>
</div>

<?php include '../error.php';   ?>

<table class ="table" style="background-color: white">
<tr>
    <td style="width: 50%">
<!--For searching for the item-->
<br>
<form action="addItem.php" method="POST" class="form-inline">
<input type="hidden" name="salesNum" value="<?php echo $_SESSION['salesNum']; ?>" 
required />
<select id="chz-select" name="product" 
data-placeholder="Select Item" class="col-lg-8" required>
<option value=""></option>
<?php
include '../connect.php'; 
$query="SELECT * FROM inventory WHERE quantity > 0 OR unit='serving' ORDER BY itemName ASC";
$qry=mysqli_query($con,$query);
while($rw=mysqli_fetch_array($qry)){
?>
<option value="<?php echo $rw['productNum'];?>"><?php echo "<b style='font-size: 36px'>".ucwords($rw['itemName'])." ".ucwords($rw['unit'])." Php ".formatMoney($rw['SRP'],true)."</b>"; ?></option>
<?php
}
?>
</select>
 Quantity: <input type="number" name="qty" value="1" min="1" placeholder="Qty" autocomplete="off" class="form-control"  required="">
<input type="submit" class="btn btn-success" name="submit" value="Add Item"></form> <br>
<div class="row">
<div class="col-lg-11">
<section class="panel">
<div id="table">
<form action="recordSales.php" method="POST">
<input type="hidden" name="salesNum" value="<?php echo $_GET['salesNum']; ?>" />
<table class="table" style="font-size: 16px">
<thead>
<tr>
<th>Item Name</th>
<th>Quantity</th>
<th>Price</th>
<th>Total</th>
<th></th>

</tr>
</thead>

<tbody>

<?php
$id=$_SESSION['salesNum'];
$subtotal=0;

$qry ="SELECT * FROM items WHERE ORNum='$id'";                                         
$result= mysqli_query($con,$qry);

            while($row=mysqli_fetch_array($result)) :
            $productNum=$row['productNum'];

            $qry2="SELECT * FROM inventory WHERE productNum='$productNum'";
            $result2= mysqli_query($con,$qry2);
            $row2 =mysqli_fetch_array($result2);
            ?>

            <tr>
            <td hidden=""><input type="text" name="product"  value="<?php echo $row2['productNum']; ?>" /></td>
            <td ><input readonly="" name="item" type="text" value="<?php echo ucwords($row2['itemName']); ?>" style="border:0;"/></td>

             <td><input readonly="" type="text" name="qty" value="<?php echo $row['quantity']; ?>" style="border:0;"/>
            </td> 

            <td><?php $price=$row2['SRP'];?>
            <input readonly="" type="text" name="price" value="<?php echo "Php ".formatMoney($price, true); ?>" style="border:0;"/> 
            </td>
           
            <td><?php $amount=$row2['SRP'] * $row['quantity']; $subtotal+=$amount; ?>
            <input readonly="" type="text" name="amount"  value="<?php echo "Php ".formatMoney($amount, true);?>" style="border:0;" />
            </td>
          
            <td>
            <a class="btn btn-danger" href="cancelItem.php?id=<?php echo $row['purchaseNum']; ?>&salesNum=<?php echo $id; ?>">Cancel</a>
            </td>   
            </tr>

            <?php 
            endwhile; 
?>

</tbody>
</table><br>

</td>
<td>

<!-- <h3 id="txt2" onkeyup="sum();"><b>Sub-total: </b><?php //echo "Php ".formatMoney($subtotal, true); ?></h3> -->
<h3><b style="">TOTAL: Php </b>
    <input readonly="" type="text" name="total" 
    id="txt2" onkeyup="sum();"  value="<?php  echo formatMoney(
      $subtotal, true);?>" style="border:0;" required=""   /></h3>

           <div class="row" style="padding-top: 50px;">
                <div class="col-md-6 col-md-offset-1">
                <ul class="nav nav-tabs">
                <li class="active"><a href="#cash" data-toggle="tab">CASH</a></li>
                <li><a href="#credit" data-toggle="tab">CREDIT</a></li>
                </ul>
                </div>
           </div><br />
                <div class="tab-content">
                <div class="tab-pane fade in active"  id="cash">
                <div class="row" style="padding-bottom: 50px;">
                <div class="col-md-6 col-md-offset-1">
                <div class="form-group">
                <input type="hidden" name="salesNum" value="<?php echo $_GET['salesNum']; ?>" />
                <input type="hidden" name="subtotal" value="<?php echo $subtotal; ?>" />
                <h3><label for="">Cash Received:</label>
                <div class="money">
          <input type="text" class="numberOnly form-control" name="cashReceived" autocomplete="off" maxlength="50"  onkeyup="sum();"   id="txt1" onkeypress="return isNumber(event)"/>
              </div>
                </div></h3>
                <div class="form-group">
                <h3><label for="">Change: </label>
                <input type="text" id="txt3" class="form-control"  readonly="" required=""> 
                </div></h3>

        <div class="form-group">
        <label for=""></label>
        <input  class="btn btn-primary btn-block"  type="submit" name="cash"   value="Continue" ">
        </div>
        </div>
        </div>                                     
        </form>
       </div>

<div class="tab-pane fade"  id="credit">
<div class="row">
<div class="col-md-6 col-md-offset-1">
        <form action="recordSales.php" method="POST">
        <div class="form-group ">     
            <input type='text' class="form-control" id='project' placeholder="Search Member" required=""/>
                 
                 <br />
        <br /><br />
     
        </div>
                <input type='hidden' id='project-id' 
                name="member"/>
                 <input type="hidden" name="subtotal" value="<?php echo $subtotal; ?>" />
                <input type="hidden" name="salesNum" value="<?php echo $_GET['salesNum']; ?>" />
                <input type="hidden" name="total" class="form-control" value="<?php echo  $amount; ?>" required="">

                <div class="form-group">
                     <input type="submit" name="credit" class="btn btn-primary btn-lg"  
                     value="Continue" >  
                </div>
        </form><br /><br />
</div>
</div>
</div>
</div>
</div>                 
</div>
</div>           
</section>
</section>
<script src="ui/jquery-ui.js"></script>            
<script>

 $(document).ready(function() {

  if(window.location.href.indexOf('#modal-1') != -1) {
    $('#modal-1').modal('show');
  }

}); 

function sum() {

            var txtFirstNumberValue = document.getElementById('txt1').value;
            var txtSecondNumberValue = document.getElementById('txt2').value;

             var  txtFirstNumberVal=txtFirstNumberValue.replace(/,/g,'');
            var txtSecondNumberVal=txtSecondNumberValue.replace(/,/g,'');



            
            var result = parseFloat(txtFirstNumberVal) - parseFloat(txtSecondNumberVal);


            if (!isNaN(result)) {
             
                document.getElementById('txt3').value = result;
        
            }


      
       var txtFirstNumberValue = document.getElementById('txt11').value;
            var result = parseFloat(txtFirstNumberValue);


            
            if (!isNaN(result)) {
                document.getElementById('txt22').value = result;        
            }
      
       var txtFirstNumberValue = document.getElementById('txt11').value;
            var txtSecondNumberValue = document.getElementById('txt33').value;
            var result = parseFloat(txtFirstNumberValue) + parseFloat(txtSecondNumberValue);
            if (!isNaN(result)) {
                document.getElementById('txt55').value = result;
        
            }
      
       var txtFirstNumberValue = document.getElementById('txt4').value;
       var result = parseFloat(txtFirstNumberValue);
            if (!isNaN(result)) {
                document.getElementById('txt5').value = result;
        }
      
        }
  // alert timer
            window.setTimeout(function() {
                $(".alert").fadeTo(500, 0).slideUp(500, function(){
                    $(this).remove(); 
                });
            }, 4000);
        
// search table
            $(document).ready(function(){
                $('.search').on('keyup',function(){
                    var searchTerm = $(this).val().toLowerCase();
                    $('#userTbl tbody tr').each(function(){
                        var lineStr = $(this).text().toLowerCase();
                        if(lineStr.indexOf(searchTerm) === -1){
                            $(this).hide();
                        }else{
                            $(this).show();
                        }
                    });
                });
            }); 

//autocomplete
            $( function() {
  
        $( "#project" ).autocomplete({
            source: function( request, response ) {
                
                $.ajax({
                    url: "fetch.php",
                    type: 'post',
                    dataType: "json",
                    data: {
                        search: request.term
                    },
                    success: function( data ) {
                        response( data );
                    }
                });
            },

           select: function( event, ui ) {
                $( "#project" ).val( ui.item.label );
                $( "#project-id" ).val( ui.item.value );
               $( "#project-icon" ).attr( "src", "images/" + ui.item.image);
                return false;
            }
        })
        .data( "ui-autocomplete" )._renderItem = function( ul, item ) {
        var inner_html = '<a><div class="list_item_container"><div class="image"><img style="width:80px;height:80px" src="../Members/images/' + item.image + '"></div><div class="label">' + item.label + '</div></div></a>';
        return $( "<li></li>" )
            .data( "item.autocomplete", item )
            .append(inner_html)
            .appendTo( ul );
    };
          
    });

  </script>
</td>
</tr>
</table>
    </body>
</html>

<script>    
     if(typeof window.history.pushState == 'function') {
         window.history.pushState({}, "Hide", '<?php echo $_SERVER['PHP_SELF'];?>');
    }
</script>

