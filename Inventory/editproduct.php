
<style>

.modal-dialog {
   overflow: visible;
     margin-left: -10%;
}
</style>
<div class="modal fade" id="edit<?php echo $productNum; ?>" role="dialog">
      <div class="modal-dialog modal-lg">
        
        <div class="modal-content">
           <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h3 class="modal-title">Edit Product Form</h3>
           </div>
           <div class="modal-body">
           
             
               <div class="modal-body">
        <?php
          $edit=mysqli_query($con,"SELECT * FROM inventory WHERE productNum='$productNum'");
                   $erow=mysqli_fetch_array($edit);
        ?>
        <div class="container-fluid">
        <form method="POST" action="save_product.php?id=<?php echo $erow['productNum']; ?>">
          <input type="hidden" name="productNum"  value="<?php echo $erow['productNum']; ?>" />
           <div style="height:10px;"></div>
          <div class="row">
            <div class="col-lg-2">
              <label style="position:relative; top:7px; color: #000;">ItemName:</label>
            </div>
            <div class="col-lg-10">
              <input type="text" name="item" class="form-control" value="<?php echo $erow['itemName']; ?>">
            </div>
          </div>
          <div style="height:10px;"></div>
            <div class="row">
            <div class="col-lg-2">
              <label style="position:relative; top:7px; color: #000;">Category:</label>
            </div>
            <div class="col-lg-10">
             <select name="category" class=" form-control" required="" >
                       <option value="">Select  Category</option>
                       <?php if ($erow['category']== "biscuit") :?>
                      <option value='biscuit' selected>biscuit</option>
                      <?php else: ?>
                      <option value='biscuit'>biscuit</option>
                      <?php endif; ?>

                       <?php if ($erow['category']== "book") :?>
                      <option value='book' selected>book</option>
                      <?php else: ?>
                      <option value='book'>book</option>
                      <?php endif; ?>

                      <?php if ($erow['category']== "candy") :?>
                      <option value='candy' selected>candy</option>
                      <?php else: ?>
                      <option value='candy'>candy</option>
                      <?php endif; ?>

                      <?php if ($erow['category']== "canned goods") :?>
                      <option value='canned goods' selected>canned goods</option>
                      <?php else: ?>
                      <option value='canned goods'>canned goods</option>
                      <?php endif; ?>
                     
                      <?php if ($erow['category']== "cap") :?>
                      <option value='cap' selected>cap</option>
                      <?php else: ?>
                      <option value='cap'>cap</option>
                      <?php endif; ?>

                      <?php if ($erow['category']== "coffee") :?>
                      <option value='coffee' selected>coffee</option>
                      <?php else: ?>
                      <option value='coffee'>coffee</option>
                      <?php endif; ?>

                      <?php if ($erow['category']== "cosmetic") :?>
                      <option value='cosmetic' selected>cosmetic</option>
                      <?php else: ?>
                      <option value='cosmetic'>cosmetics</option>
                      <?php endif; ?>

                      <?php if ($erow['category']== "drink") :?>
                      <option value='drink' selected>drink</option>
                      <?php else: ?>
                      <option value='drink'>drink</option>
                      <?php endif; ?>

                      <?php if ($erow['category']== "executive bag") :?>
                      <option value='executive bag' selected>executive bag</option>
                      <?php else: ?>
                      <option value='executive bag'>executive bag</option>
                      <?php endif; ?>

                      <?php if ($erow['category']== "ingredient") :?>
                      <option value='ingredient' selected>ingredient</option>
                      <?php else: ?>
                      <option value='ingredient'>ingredient</option>
                      <?php endif; ?>

                      <?php if ($erow['category']== "kitchen supply") :?>
                      <option value='kitchen supply' selected>kitchen supply</option>
                      <?php else: ?>
                      <option value='kitchen supply'>kitchen supply</option>
                      <?php endif; ?>

                      <?php if ($erow['category']== "medicine product") :?>
                      <option value='medicine product' selected>medicine product</option>
                      <?php else: ?>
                      <option value='medicine product'>medicine product</option>
                      <?php endif; ?>

                       <?php if ($erow['category']== "noodles") :?>
                      <option value='noodles' selected>noodles</option>
                      <?php else: ?>
                      <option value='noodles'>noodles</option>
                      <?php endif; ?>

                      <?php if ($erow['category']== "PE shorts") :?>
                      <option value='PE shorts' selected>PE shorts</option>
                      <?php else: ?>
                      <option value='PE shorts'>noodles</option>
                      <?php endif; ?>

                       <?php if ($erow['category']== "plain tshirt") :?>
                      <option value='plain tshirt' selected>plain tshirt</option>
                      <?php else: ?>
                      <option value='plain tshirt'>plain tshirt</option>
                      <?php endif; ?>

                       <?php if ($erow['category']== "recycle tshirt") :?>
                      <option value='recycle tshirt' selected>recycle tshirt</option>
                      <?php else: ?>
                      <option value='recycle tshirt'>recycle tshirt</option>
                      <?php endif; ?>

                      <?php if ($erow['category']== "school supply") :?>
                      <option value='school supply' selected>school supply</option>
                      <?php else: ?>
                      <option value='school supply'>school supply</option>
                      <?php endif; ?>

                      <?php if ($erow['category']== "shells decor") :?>
                      <option value='shells decor' selected>shells decor</option>
                      <?php else: ?>
                      <option value='shells decor'>shells decor</option>
                      <?php endif; ?>

                      <?php if ($erow['category']== "snack") :?>
                      <option value='snack' selected>snack</option>
                      <?php else: ?>
                      <option value='snack'>snack</option>
                      <?php endif; ?>

                      <?php if ($erow['category']== "sovenier") :?>
                      <option value='sovenier' selected>sovenier</option>
                      <?php else: ?>
                      <option value='sovenier'>sovenier</option>
                      <?php endif; ?>

                      <?php if ($erow['category']== "viand") :?>
                      <option value='viand' selected>viand</option>
                      <?php else: ?>
                      <option value='viand'>viand</option>
                      <?php endif; ?>
                  </select>
            </div>
          </div>

            <div style="height:10px;"></div>
            <div class="row">
            <div class="col-lg-2">
              <label style="position:relative; top:7px; color: #000;">Unit:</label>
            </div>
            <div class="col-lg-10">
              <select name="unit" class=" form-control" required="" >
                       <option value="">Select  Unit</option> 

                       <?php if ($erow['unit']== "box") :?>
                      <option value='box' selected>box</option>
                      <?php else: ?>
                      <option value='box'>box</option>
                      <?php endif; ?>

                       <?php if ($erow['unit']== "bottle") :?>
                      <option value='bottle' selected>bottle</option>
                      <?php else: ?>
                      <option value='bottle'>bottle</option>
                      <?php endif; ?>

                       <?php if ($erow['unit']== "can") :?>
                      <option value='can' selected>can</option>
                      <?php else: ?>
                      <option value='can'>can</option>
                      <?php endif; ?>

                       <?php if ($erow['unit']== "catering") :?>
                      <option value='catering' selected>catering</option>
                      <?php else: ?>
                      <option value='catering'>catering</option>
                      <?php endif; ?>

                       <?php if ($erow['unit']== "cup") :?>
                      <option value='cup' selected>cup</option>
                      <?php else: ?>
                      <option value='cup'>cup</option>
                      <?php endif; ?>

                      <?php if ($erow['unit']== "pack") :?>
                      <option value='pack' selected>pack</option>
                      <?php else: ?>
                      <option value='pack'>pack</option>
                      <?php endif; ?>

                      <?php if ($erow['unit']== "piece") :?>
                      <option value='piece' selected>piece</option>
                      <?php else: ?>
                      <option value='piece'>piece</option>
                      <?php endif; ?>

                      <?php if ($erow['unit']== "sachet") :?>
                      <option value='sachet' selected>sachet</option>
                      <?php else: ?>
                      <option value='sachet'>sachet</option>
                      <?php endif; ?>

                      <?php if ($erow['unit']== "serving") :?>
                      <option value='serving' selected>serving</option>
                      <?php else: ?>
                      <option value='serving'>serving</option>
                      <?php endif; ?>
                      
                  </select>
            </div>
          </div>

          <div style="height:10px;"></div>
            <div class="row">
              <div class="col-lg-3">
                <label class="control-label" style="position:relative; top:7px;">Consignment? </label>
              </div>&nbsp;&nbsp;&nbsp;
                <div class="col-lg-8">  
                <select name="consignment" class=" form-control" required="" >

                  <?php if ($erow['consignment']== "no") :?>
                      <option value='no' selected>no</option>
                      <?php else: ?>
                      <option value='no'>no</option>
                      <?php endif; ?>

                      <?php if ($erow['consignment']== "yes") :?>
                      <option value='yes' selected>yes</option>
                      <?php else: ?>
                      <option value='yes'>yes</option>
                      <?php endif; ?>
                      
                    </select>
                </div>
            </div>

            <div style="height:10px;"></div>
          <div class="row">
            <div class="col-lg-2">
              <label style="position:relative; top:7px; color: #000;">Supplier:</label>
            </div>
            <div class="col-lg-10">
       <?php 
      $rcp="SELECT supplierID FROM inventory WHERE productNum='$productNum'";
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


            <div style="height:10px;"></div>
          <div class="row">
            <div class="col-lg-2">
              <label style="position:relative; top:7px; color: #000;">Item Cost</label>
            </div>
            <div class="col-lg-10">
              <input type="text" name="price" 
               class="form-control" value="<?php echo $erow['originalPrice']; ?>" >
            </div>
          </div>

            <div style="height:10px;"></div>
          <div class="row">
            <div class="col-lg-2">
              <label style="position:relative; top:7px; color: #000;">Selling Price:</label>
            </div>
            <div class="col-lg-10">
              <input type="text" name="srp"  
               class="form-control" 
              value="<?php echo $erow['SRP']; ?>">
            </div>
          </div>

           <div style="height:10px;"></div>
          <div class="row">
            <div class="col-lg-2">
              <label style="position:relative; top:7px; color: #000;">Quantity:</label>
            </div>
            <div class="col-lg-10">
              <input type="number" name="quantity" class="form-control" value="<?php echo $erow['quantity']; ?>">
            </div>
          </div>
           
          
          


          

           <div class="modal-footer">
            <button type="submit" class="btn btn-primary"> Save</button>
           </div>
           </form>
        </div>
      </div>
    </div>