<!--Modal for adding new product-->
<style>

.modal-dialog {
   overflow: visible;
     margin-left: -10%;
}
</style>
<div class="modal fade" id="addnew" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <center><h4 class="modal-title" id="myModalLabel">Add New Product</h4></center>
            </div>
            
            <div class="modal-body">
				<div class="container-fluid">
					<form method="POST" action="newProduct.php" id="contact_form" 
					data-toggle="validator">
						<div style="height:10px;"></div>

						<div class="row">
							<div class="col-lg-3">
								<label class="control-label" style="position:relative; top:7px;">Item Name: </label>
							</div>

							<div class="col-lg-8">
								<input class=" form-control"  name="itemName" type="text"  required="" />
							</div>
						</div> 

						<div style="height:10px;"></div>
						<div class="row">
							<div class="col-lg-3">
								<label class="control-label" style="position:relative; top:7px;">Category: </label>
							</div>&nbsp;&nbsp;&nbsp;
							<div class="col-lg-8">
							 <select name="category" class=" form-control" 
							placeholder="select" oninvalid="this.setCustomValidity('Please Select an item in the List')" required="">
					             <option value="">Select  Category</option> 
					            <option value='biscuit'>biscuit</option>
					            <option value='book'>book</option>
					            <option value='candy'>candy</option>
					            <option value='canned goods'>canned goods</option>
					            <option value='cap'>cap</option>
					            <option value='coffee'>coffee</option>
					            <option value='cosmetic'>cosmetic</option>
					            <option value='drink'>drink</option>
					            <option value='executive bag'>executive bag</option>
					            <option value='ingredient'>ingredient</option>
					            <option value='kitchen supply'>kitchen supply</option>
					            <option value='medicine product'>medicine product</option>
					            <option value='noodles'>noodles</option>
					            <option value='PE shorts'>PE shorts</option>
					            <option value='plain tshirt'>plain tshirt</option>
					            <option value='recycle tshirt'>recycle tshirt</option>
					            <option value='school supply'>school supply</option>
					            <option value='shell decor'>shell decor</option>
					            <option value='snack'>snack</option>
					            <option value='sovenier'>sovenier</option> 
					            <option value='viand'>viand</option> 
					        </select>
					    </div>
						</div>


						<div style="height:10px;"></div>
						<div class="row">
							<div class="col-lg-3">
								<label class="control-label" style="position:relative; top:7px;">Unit: </label>
							</div>
							<div class="col-lg-8">	
							<select name="unit" class=" form-control" required="" >
					             <option value="">Select  Unit</option>  
					             <option value='box'>box</option>
					             <option value='bottle'>bottle</option>
					             <option value='can'>can</option>
					             <option value='catering'>catering</option>
					             <option value='cup'>cup</option>
					             <option value='pack'>pack</option>
					            <option value='piece'>piece</option>
					            <option value='bottle'>sachet</option>					            
					            <option value='serving'>serving</option>
					            
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
								<option value='no'>No</option>
					            <option value="yes">Yes</option>  
					            
					          </select>
					      </div>
					  </div>

						<div style="height:10px;"></div>
						<div class="row">
							<div class="col-lg-3">
								<label class="control-label" style="position:relative; top:7px;">Supplier:</label>
							</div>

							<div class="col-lg-8">	
								<select name="supplier" class=" form-control" required="" >
                              		<option value="">Select Supplier</option>
                              		<?php
                              			include '../connect.php';
                                		$sql= "SELECT * FROM supplier ORDER BY companyName ASC";
                               			$run_sql= mysqli_query($con,$sql);
                               
                               			while ($row= mysqli_fetch_array($run_sql)) {
                          					echo '<option value="'.$row['supplierID'].'">'.ucwords($row['companyName']).'</option>';
                               			}
                               		?>
                               	</select>
							</div>
						</div>

					
					
						<div style="height:10px;"></div>
						<div class="row">
							<div class="col-lg-3">
								<label class="control-label" style="position:relative; top:7px;">Item Cost: </label>
							</div>

							<div class="col-lg-8">
								<input class=" form-control" id="Original" name="originalPrice" type="telephoneNum"  required="" onkeypress="return isNumber(event)" />
							</div>
							<div class="result"></div>
						</div>

						 
						<div style="height:10px;"></div>
						<div class="row">
							<div class="col-lg-3">
								<label class="control-label" style="position:relative; top:7px;">Selling Price:</label>
							</div>
							<div class="col-lg-8">
								<input type="telephoneNum" id="txt1" class=" form-control"  name="SRP" required="" onkeypress="return isNumber(event)" />
							</div>
						</div>
						
						<div style="height:10px;"></div>
						<div class="row">
							<div class="col-lg-3">
								<label class="control-label" style="position:relative; top:7px;">Quantity:</label>
							</div>

							<div class="col-lg-8">
								<input type="number" id="txt3" name="quantity" class=" form-control" value="0" min="0"  required=""/>
							</div>
						</div>
+

                </div> 
			</div>

                <div class="modal-footer">
                		
                    <button type="submit" name="submit" class="btn btn-primary">Save</button>
				</form>
                </div>	
            </div>
        </div>
    </div>
    
    <script>
    	function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}

    </script>