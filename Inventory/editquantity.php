<!--Modal for adding new product-->
<style>

.modal-dialog {
   overflow: visible;
     margin-left: -10%;
}
</style>
 <div class="modal fade" id="edit<?php echo $orderNum; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                <!--Select the product to be restocked-->
                <?php
                    $order=mysqli_query($con,"SELECT * FROM ordered_items WHERE orderNum='$orderNum'");
                    $orderqry=mysqli_fetch_array($order);
                ?>

                <center><h3 class="modal-title" id="myModalLabel">Edit Quantity</h3></center>
            </div>
            
            <div class="modal-body" ">                
                <div class="container-fluid">
                    <form method="POST" action="editQty.php">
                        <input type="hidden" name="orderNum"  value="<?php echo $orderqry['orderNum']; ?>" />
                        
                        <!--Quantity-->
                        <div style="height:10px;"></div>
                        <div class="row">
                            <div class="col-lg-2" >
                                <label style="position:relative; top:7px; color: black;">Quantity: </label>
                            </div>

                            <div class="col-lg-10">
                                <input type="number" id="txt3" name="quantity" class=" form-control" value="<?php echo $orderqry['quantity']; ?>" min="1"  />
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
