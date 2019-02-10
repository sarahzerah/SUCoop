<?php include '../head.php'; ?>
<link href="css/bootstrapValidator.css" rel="stylesheet">
<!-- container section start -->
<section id="container" class="">
<?php 
include '../header.php'; 
include '../sidebar.php';
?><style>
#success_message{ display: none;}
</style>
<!--main content start-->
<section id="main-content" style="padding-left: 4%; padding-right: 2%; font-size: 20px">
<section class="wrapper">
<div class="row">
<div class="col-lg-12">
<h1 class="page-header"><br>Add New Supplier</h1>
</div>
</div>
<!--Form-->       
<div class="row">
<div class="col-lg-12">
<section class="panel">
<div class="panel-body">
<div class="form">
    <form class="form-validate form-horizontal" method="POST" 
    action="newSupplier.php" id="contact_form"   
    data-toggle="validator">
        <div class="form-group ">
            <label for="fullname" class="control-label col-lg-2">Company Name<span class="">*</span></label>
            <div class="col-lg-6">
                <input class=" form-control" id="companyName" 
                name="companyName" type="text"  required=""  
                 />
            </div>
        </div>

        <div class="form-group ">
            <label for="fullname" class="control-label col-lg-2">Address<span class="">*</span></label>
            <div class="col-lg-6">
                <input class=" form-control" id="address" name="address" type="text" required="" />
            </div>
        </div>

        <div class="form-group ">
            <label for="fullname" class="control-label col-lg-2">Telephone Number</label>
            <div class="col-lg-6">
                <input class=" form-control" id="telephoneNum" 
                name="telephoneNum" type="telephoneNum" 
                onkeypress="return isNumber(event)" placeholder="035" maxlength="10" />
            </div>
        </div>

        <div class="form-group ">
            <label for="address" class="control-label col-lg-2">Mobile Number</label>
            <div class="col-lg-6">
                <input class=" form-control" id="mobileNum" name="mobileNum" type="telephoneNum" 
                onkeypress="return isNumber(event)" maxlength="11"/>
               
            </div>
        </div>

        <div class="form-group ">
            <label for="address" class="control-label col-lg-2">Sales Representative Fullname<span class="">*</span></label>
            <div class="col-lg-6">
                <input class=" form-control" id="salesRepresentative" 
                name="salesRepresentative" type="text" required="" 
                onkeydown="preventNumberInput(event);"
                onkeyup="preventNumberInput(event);" />
            </div>
        </div>

        <div class="form-group ">
            <label for="address" class="control-label col-lg-2">Sales representative Mobile Number</label>
            <div class="col-lg-6">
                <input class=" form-control" id="srContactNum" name="srContactNum" type="telephoneNum"  
                  onkeypress="return isNumber(event)" maxlength="11"/>
            </div>
        </div>

        <div class="form-group ">
            <label for="address" class="control-label col-lg-2">Sales representative Email Address<span class="">*</span></label>
            <div class="col-lg-6">
                <input class=" form-control" id="srEmailAdd" name="srEmailAdd" type="email" required="" />
            </div>
        </div>


            <div class="form-group ">
            <label for="address" class="control-label col-lg-2">Bank Name<span class="">*</span></label>
            <div class="col-lg-6">
                <input class=" form-control" id="bankName" name="bankName" type="text" required="" 
                
                maxlength="10"/>
            </div>
        </div>

        <div class="form-group ">
            <label for="address" class="control-label col-lg-2">Account Name<span class="">*</span></label>
            <div class="col-lg-6">
                <input class=" form-control" id="accountName" name="accountName" type="text" required="" 
                />
            </div>
        </div>

        <div class="form-group ">
            <label for="address" class="control-label col-lg-2">Account Number<span class="">*</span></label>
            <div class="col-lg-6">
                <input class=" form-control" id="accountNum" name="accountNum" type="telephoneNum" required="" />
            </div>
        </div><br>
        <div class="form-group ">
            <label  for="address" class="control-label col-lg-2"">Consigner<span class="">*</span></label>     
                <div class="col-lg-1">  
                   <select name="consignor" class=" form-control" required="" id="consignor" >
                        <option value=""></option> 
                        <option value="yes">Yes</option>  
                        <option value='no'>No</option>
                    </select>
                </div>
        </div>
 <div class="form-group">
<div class="col-lg-offset-6 col-lg-2" align="left">
    <input type="submit" value="&nbsp;Save&nbsp;" name="save" class="btn btn-primary"  style="font-size: 24px"/>
    <a href="suppliersList.php" class="btn btn-default"  style="font-size: 24px">Cancel</a>
</div>
</div>
</form>
</div>
</div>
</section>
</div>
</div>
</section>
</section>
</section>
<?php include '../footer.php'; ?>
<script src="js/jquery.js"></script>
<script src="js/bootstrapValidator.js"></script>
<script src="js/script.js"></script> 
</body>
</html>
