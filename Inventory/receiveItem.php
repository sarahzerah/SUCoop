
<!--Modal for adding new product-->
<style>

.modal-dialog {
   overflow: visible;
     margin-left: -10%;
}
</style>
<div class="modal fade" id="receive<?php echo $pNum; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <!--Select the product to be restocked-->
                <?php
                    $order=mysqli_query($con,"SELECT * FROM ordered_items WHERE productNum='$pNum'");
                    $orderqry=mysqli_fetch_array($order);
                    $getItem=mysqli_query($con,"SELECT * FROM inventory WHERE productNum='$pNum'");
                    $getItemqry=mysqli_fetch_array($getItem);
                ?>
                <center><h3 class="modal-title" id="myModalLabel">Confirm Received Order</h3></center>
            </div>
            <div class="modal-body">                
                <div class="container-fluid">
                    <form method="POST" action="restock.php">
                        <input type="hidden" name="productNum"  value="<?php echo $orderqry['productNum']; ?>" />
                        <div class="row">
                            <div class="col-lg-3">
                                <label class="control-label" style="position:relative; top:7px;">Item Name: </label>
                            </div>
                            <div class="col-lg-3">
                               <?php echo ucwords($getItemqry['itemName']); ?><br>
                            </div>
                        </div>
                        <!--Quantity-->
                        <div style="height:10px;"></div>
                        <div class="row">
                            <div class="col-lg-3" >
                                <label style="position:relative; top:7px; color: black;">Quantity Received: </label>
                            </div>
                            <div class="col-lg-3">
                                <input type="number" id="txt3" name="quantity" class=" form-control" value="<?php echo $orderqry['quantity']; ?>" min="1"  />
                            </div>
                        </div>
                        <input type="hidden" name="orderNum"  value="<?php echo $orderNum; ?>" />
                        <input type="hidden" name="supplierID"  value="<?php echo $_SESSION['supplierID']; ?>" />
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Confirm</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
