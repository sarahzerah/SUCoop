 <div class="modal fade" id="place<?php echo $productNum; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                <!--Select the product to be restocked-->
                <?php
                    $order=mysqli_query($con,"SELECT * FROM inventory WHERE productNum='$productNum'");
                    $orderqry=mysqli_fetch_array($order);
                ?>

                <center><h3 class="modal-title" id="myModalLabel">Order <?php echo ucwords($orderqry['itemName']) ; ?></h3></center>
            </div>
            
            <div class="modal-body">                
                <div class="container-fluid">
                    <form method="POST" action="order.php">
                        <input type="hidden" name="productNum"  value="<?php echo $orderqry['productNum']; ?>" />
                        
                        <!--Quantity-->
                        <div style="height:10px;"></div>
                        <div class="row">
                            <div class="col-lg-2" >
                                <label style="position:relative; top:7px; color: black;">Quantity: </label>
                            </div>

                            <div class="col-lg-3">
                                <input type="number" id="txt3" name="quantity" class=" form-control" value="0" min="1"  required=""/>

                            </div>
                        </div>
                        
                        <!--Supplier-->
                        <div style="height:10px;"></div>
                        <div class="row">
                            <div class="col-lg-2" style="font: black;"">
                             <label style="position:relative; top:7px;"><br>Supplier: </label>
                            </div>
                            <div class="col-lg-10">
                                <?php 
                                    $getSupplier="SELECT supplierID FROM inventory WHERE productNum='$productNum'";
                                    $getSupplierqry=mysqli_query($con, $getSupplier);
                                    $row4 = mysqli_fetch_array($getSupplierqry);
                                    $thesupplier = $row4['supplierID'];
                                ?>
                             <input type="hidden" name="supplier" value="<?php echo $thesupplier; ?>" />
                                <?php

                                    $showsuppliers="SELECT * FROM supplier WHERE supplierID='$thesupplier'";
                                    $suppliers=mysqli_query($con, $showsuppliers);
                                    $row5 = mysqli_fetch_array($suppliers);
                                    echo "<br>".ucwords($row5['companyName']);

                                ?>

                                
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
