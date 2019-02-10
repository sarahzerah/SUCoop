<?php include '../head.php'; ?>
  <?php 
      include '../header.php';
      include '../sidebar.php';
      include '../functions.php'; 

        include '../connect.php';
        if (isset($_POST['submit']))
         $id=$_SESSION['supplier'];
        else {
        if(isset($_GET['id']))
          $id= $_GET['id'];
        else
          $id=$_SESSION['supplier'];
        }
        $_SESSION['supplier']=$id;
                  
        $sqry= "SELECT * FROM supplier WHERE supplierID='$id'";
        $srun= mysqli_query($con, $sqry);
        $rows= mysqli_fetch_array($srun);

        $companyName=$rows['companyName'];
        $address =$rows ['address'];
        $telephoneNum=$rows ['telephoneNum']; 
        $mobileNum=$rows ['mobileNum'];
        $salesRepresentative=$rows ['salesRepresentative'];
        $srContactNum= $rows['srContactNum']; 
        $srEmailAdd =$rows ['srEmailAdd'];
        $bankName = $rows['bankName'];
        $accountName = $rows['accountName'];
        $accountNum =$rows ['accountNum'];

        $gqry= "SELECT * FROM goods_receipt WHERE supplierID = '$id' ORDER BY dateRestocked DESC";
        $grun=mysqli_query($con,$gqry);
        //$grow=mysqli_fetch_array($grun);
        $goodReceipt=$grow['GRNum'];

        $purchase="SELECT * FROM purchase_order WHERE  supplierID = '$id'";
        $prun=mysqli_query($con,$purchase);
                
    ?>
<section id="container" class="">
<link href="css/bootstrapValidator.css" rel="stylesheet">
<style>       
#success_message{ display: none;}
</style>  

<section id="main-content" style="padding-top: 2%; font-size: 20px">
  <section class="wrapper">
    <div class="col-lg-12">
      <div id="profile" class="tab-pane" style="padding-left: 2%; padding-top: 1%; padding-right:2%" > <!--DIV for the whole info-->
        <section class="panel">
          <div class="panel-body bio-graph-info">  
             <?php include '../error.php'; ?>
              <table class="table" style="width: 100%">
                <tr>
                  <td colspan="2" style="font-size: 36px; color: black"><header><b><?php echo " ".$companyName; ?></b></header> </td>
                </tr>
                <tr>
                    <td style="width:45%; ">
                      <div style="padding-left: 1%;">
                        <?php if ($rows['consignor']=='yes'): ?> 
                        <h3><b> &nbsp;Consigner</h3><br>
                        <?php endif; ?>
                        <h3><b> &nbsp;Address</b>: <?php echo ucwords($address);?> </h3>
                        <?php if(!empty($telephoneNum)): ?> 
                        <h3><b> &nbsp;Telephone Number</b>: <?php echo $telephoneNum;?>  </h3>  
                        <?php endif; ?>
                        <?php if (!empty($mobileNum)): ?> 
                        <h3><b> &nbsp;Mobile Number</b>: <?php echo $mobileNum ;?></h3><br>
                        <?php endif; ?>
                        <h3><b> &nbsp;Sales Representative </b>: <?php echo ucwords($salesRepresentative);?></h3> 
                        <?php if (!empty($mobileNum)): ?>     
                        <h3><b> &nbsp;Sales-rep Contact Number</b>: <?php echo $srContactNum;?> </h3>
                        <?php endif; ?>
                        <h3><b>&nbsp;Email Address </b>: <?php echo  $srEmailAdd;?></h3> 
                        <h3><b> &nbsp;Bank Name </b>: <?php echo ucwords($bankName);?> </h3>
                        <h3><b> &nbsp;Account Name </b>: <?php echo $accountName;?> </h3>
                        <h3><b> &nbsp;Account Number</b>: <?php echo $accountNum;?> </h3> <br>
                        <br>

                    <?php if($_SESSION['role'] == 'inventory personnel'):?>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-1">Edit Contact Information</button> &nbsp; &nbsp;  
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-2">Delete Supplier</button>   
                      <?php endif; ?>
                      </div>
                    </td>
                    <td style="height: 300px; width:100%; overflow: auto;  display:block; border-top-color: white">
                      <h3  style="color:Back;"><strong>Goods Receipt</strong></h3>
                        <form  action="viewSuppliersProfile.php" method="POST" class="form-inline">
                                      <?php include 'restockHistory.php'; ?>
                        </form>
                    </td>
                </tr>
                <tr>
                    <td style="border-top-color: white"></td>
                    <td style="height: 300px; width:100%; overflow: auto;  display:block;  border-top-color: white">
                      <h3  style="color:Back;"><strong>Purchase Order</strong></h3>
                        <form  action="viewPurchaseOrder.php" method="POST" class="form-inline">
                            <?php include 'supplierPurchaseOrder.php'; ?>
                        </form>
                    </td>

                </tr>
            </table>
      </div>
    </section>
  </div> <!--End of DIV for the whole info-->
<!-- Start of Deleting Modal -->
<div class="modal-body">
  <div class="modal fade" id="modal-2">
    <div class="modal-dialog modal-lg">
       <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button> <!--button you can click to exit the modal-->
                <h3 class="modal-title">Delete Supplier</h3>
            </div>
                 <form class="form-horizontal "  method="POST" action="deleteSupplier.php">               
                      <div>
                          <label class="control-label col-lg-12" class="control-label col-lg-2" style="
                          font-size:20px; padding-right: 30%" align="left">Are you sure you want to delete <?php echo ucwords($companyName);?>?</label>
                      </div>
                      <br>
                        <div class="modal-footer">
                          <button class="btn btn-primary" data-target="#modal-1" name="delete" type="submit" value="<?php echo $id;?>">Delete</button> 
                      </div>
                </form>
       </div> 
    </div>
  </div>
</div>
<!-- End of Deleting Modal -->
       <!--START OF EDITING MODAL-->
  <div class="modal fade" id="modal-1">
<div class="modal-dialog modal-lg" style="width: 50%">
   <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button> <!--button you can click to exit the modal-->
            <h3 class="modal-title">Edit Contact Information </h3>
        </div>
        <div class="modal-body">
            <form class="form-horizontal" id="contact_form" method="POST" action="editSuppliersContactInfo.php"> <!--once save is clicked, it will be redirected to the same page-->
                 <input type="hidden" name="id"  value="<?php echo $id;?>" />
                <div class="form-group">
                    <label class="control-label col-lg-4" class="control-label col-lg-2">Telephone<span class="required">*</span></label>
                    <div class="col-sm-6">
                        <input id="cp1" type="text"  size="16" name="telephoneNum"  
                        <?php if (!empty($telephoneNum)): ?> value="<?php echo $telephoneNum;?>"
                        <?php else: ?> placeholder="035" <?php endif; ?> onkeypress="return isNumber(event)" class="form-control" maxlength="10">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-lg-4" class="control-label col-lg-2">Mobile Number</label>
                    <div class="col-sm-6">
                        <input type="telephoneNum"  size="16" name="mobileNum"  <?php if(!empty($mobileNum)): ?> value="<?php echo $mobileNum; ?>" <?php else: echo 'placeholder="09"'; endif; ?> onkeypress="return isNumber(event)"
                         class="form-control" maxlength="11"   >
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-lg-4" class="control-label col-lg-2">Sales Representative<span class="required">*</span></label>
                    <div class="col-sm-6">
                        <input id="cp1" type="text"  size="16" name="salesRepresentative"  value="<?php echo $salesRepresentative;?>"  class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-lg-4" class="control-label col-lg-2">Contact Number</label>
                    <div class="col-sm-6">
                        <input type="telephoneNum"  size="16" name="srContactNum"  value="<?php echo $srContactNum; ?>" onkeypress="return isNumber(event)"
                         class="form-control" maxlength="11"    >
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-lg-4" class="control-label col-lg-2">Email Address<span class="required">*</span></label>
                    <div class="col-sm-6">
                        <input id="cp1" type="text"  size="16" name="srEmailAdd"  value="<?php echo $srEmailAdd;?>"  class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-lg-4" class="control-label col-lg-2">Bank Name<span class="required">*</span></label>
                    <div class="col-sm-6">
                        <input id="cp1" type="text"  size="16" name="bankName"  value="<?php echo $bankName;?>"  class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-lg-4" class="control-label col-lg-2">Account Name <span class="required">*</span></label>
                    <div class="col-sm-6">
                        <input id="cp1" type="text"  size="16" name="accountName"  value="<?php echo $accountName;?>"  class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-lg-4" class="control-label col-lg-2">Account Number</label>
                    <div class="col-sm-6">
                        <input type="telephoneNum"  size="16" name="accountNum"  value="<?php echo $accountNum; ?>" onkeypress="return isNumber(event)"
                         class="form-control" maxlength="10"    >
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-primary" name="save" value="Save"> 
                
                </div>
            </form>
        </div>
    </div>
</div>
</div>
<!--END OF MODAL--> 
        </div>  
     </section>
  </section>
</section>
<!-- container section end -->
<?php include '../footer.php'; ?>
<script>    
    if(typeof window.history.pushState == 'function') {
        window.history.pushState({}, "Hide", '<?php echo $_SERVER['PHP_SELF'];?>');
    }
</script>

<script src="js/bootstrapValidator.js"></script>
<script src="js/script.js"></script>