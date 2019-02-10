 <div class="modal fade" id="place<?php echo $productNum; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <!--Select the product to be restocked-->
                <?php
                    $restock=mysqli_query($con,"SELECT * FROM inventory WHERE productNum='$productNum'");
                    $restockqry=mysqli_fetch_array($restock);
                ?>

                <center><h4 class="modal-title" id="myModalLabel">Restock <?php echo ucwords($restockqry['itemName']) ; ?></h4></center>
            </div>
            
            <div class="modal-body" ">
                
                <div class="container-fluid">
                    <form method="POST" action="restock.php">
                        <input type="hidden" name="productNum"  value="<?php echo $restockqry['productNum']; ?>" />
                        
                        <!--Quantity-->
                        <div style="height:10px;"></div>
                        <div class="row">
                            <div class="col-lg-2" >
                                <label style="position:relative; top:7px; color: black;">Quantity: </label>
                            </div>

                            <div class="col-lg-10">
                                <input type="number" id="txt3" name="quantity" class=" form-control" value="<?php echo $restockqry['quantity']; ?>" min="1"  />
                            </div>
                        </div>
                        
                        <!--Supplier-->
                        <div style="height:10px;"></div>
                        <div class="row">
                            <div class="col-lg-2" style="font: black;"">
                                <label style="position:relative; top:7px; color: black;">Supplier: </label>
                            </div>

                            <div class="col-lg-10">
       <?php 
      $rcp="SELECT supplierID FROM goods_receipt WHERE productNum='$productNum'";
      $rcpt=mysqli_query($con,$rcp);
      $row4 = mysqli_fetch_array($rcpt);
      $edit2 = $row4['supplierID'];

      $showsuppliers="SELECT * FROM supplier";
      $suppliers=mysqli_query($con,$showsuppliers);
       ?>
     <select name="supplier" class="form-control">
    <?php while($row = mysqli_fetch_array($suppliers)) : ?>
      <?php if($row['supplierID'] == $edit2){
        $selected = 'selected';
      } else {
        $selected = '';
      }
      ?>  
      <option value="<?php echo $row['supplierID']; ?>" <?php echo $selected; ?>><?php echo $row['companyName']; ?></option>
    <?php endwhile; ?>
  </select>
                            </div>
                        </div>
                    </div> 
                </div>

                <div class="modal-footer">
                    <a href="" class="btn btn-primary" data-dismiss="modal">Cancel</a>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
