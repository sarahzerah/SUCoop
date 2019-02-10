<?php include '../head.php'; ?>

<!-- container section start -->
<section id="container" class="">
<?php 
include '../header.php'; 
include '../sidebar.php';
?>
<link href="css/bootstrapValidator.css" rel="stylesheet">
<style>       
#success_message{ display: none;}
</style>
<!--main content start-->
<section id="main-content" style="padding-left: 4%; padding-top: 2%; padding-right: 2%">
<section class="wrapper">
<div class="row">
<div class="col-lg-12">
<h1 class="page-header">Add New User</h1>
</div>
</div>

<!--Form-->       
<div class="row">
<div class="col-lg-12">
<section class="panel">

<div class="panel-body">
<div class="form">
<form class="form-validate form-horizontal" method="POST" action="newUser.php" id="contact_form" style="font-size: 20px">
    <div class="form-group ">
        <label for="fullname" class="control-label col-lg-2">First Name<span class="">*</span></label>
        <div class="col-lg-6">
            <input class=" form-control" id="firstName" name="firstName" type="text" required="" 
            onkeydown="preventNumberInput(event);"
       onkeyup="preventNumberInput(event);" />
        </div>
    </div>

    <div class="form-group ">
        <label for="fullname" class="control-label col-lg-2">Middle Name<span class="">*</span></label>
        <div class="col-lg-6">
            <input class=" form-control" id="middleName" name="middleName" type="text" required="" 
            onkeydown="preventNumberInput(event);"
       onkeyup="preventNumberInput(event);"/>
        </div>
    </div>

    <div class="form-group ">
        <label for="fullname" class="control-label col-lg-2">Last Name<span class="">*</span></label>
        <div class="col-lg-6">
            <input class=" form-control" id="lastName" name="lastName" type="text"required=""  
            onkeydown="preventNumberInput(event);"
       onkeyup="preventNumberInput(event);"/>
        </div>
    </div>

    <div class="form-group ">
        <label for="address" class="control-label col-lg-2">Role<span class="">*</span></label>
        <div class="col-lg-6">
            <select name="role"  class="form-control" required="">
                <option value=""></option>
                <option value="cashier">Cashier</option>
                <option value="secretary">Secretary</option>
                <option value="manager">Manager</option>
                <option value="inventory personnel">Inventory Personnel</option>
                <option value="accountant">Accountant</option>
            </select>
        </div>
    </div>

    <div class="form-group ">
        <label for="address" class="control-label col-lg-2">Civil Status<span class="">*</span></label>
        <div class="col-lg-6">
            <select name="civilStatus"  class="form-control" required="">
                <option value=""></option>
                <option value="single">Single</option>
                <option value="married">Married</option>
                <option value="widow">Widow</option>
                <option value="annulled">Annulled</option>
                <option value="legally separated">Legally Separated</option>
            </select>
        </div>
    </div>

    <div class="form-group ">
        <label for="address" class="control-label col-lg-2">Birth Date<span class="">*</span></label>
        <div class="col-lg-6">
            <input class=" form-control" id="birthDate" name="birthDate" type="date" required="" />
        </div>
    </div>

    <div class="form-group ">
        <label for="address" class="control-label col-lg-2">Home Address<span class="">*</span></label>
        <div class="col-lg-6">
            <input class=" form-control" id="homeAddress" name="homeAddress" type="text" required="" />
        </div>
    </div>

    <div class="form-group ">
        <label for="address" class="control-label col-lg-2">Current Address<span class="">*</span></label>
        <div class="col-lg-6">
            <input class=" form-control" id="currentAddress" name="currentAddress" type="text" required="" />
        </div>
    </div>

    <div class="form-group ">
        <label for="address" class="control-label col-lg-2">Contact Number 1<span class="">*</span></label>
        <div class="col-lg-6">
            <input class=" form-control" id="contactNum" 
            name="contactNum" type="telephoneNum"  
            onkeypress="return isNumber(event)" required=""/>
        </div>
    </div>

     <div class="form-group ">
        <label for="address" class="control-label col-lg-2">Contact Number 2 (optional)</label>
        <div class="col-lg-6">
            <input class=" form-control" id="contactNum2" 
            name="contactNum2" type="telephoneNum"   
            onkeypress="return isNumber(event)" />
        </div>
    </div>

    <div class="form-group ">
        <label for="address" class="control-label col-lg-2">Email Address<span class="">*</span></label>
        <div class="col-lg-6">
            <input class=" form-control" id="emailAdd" name="emailAdd" type="text" required="" />
        </div><br><br><br>
    
<div class="form-group">
<div class="col-lg-offset-6 col-lg-2">
   <input type="submit" value="Save" name ="save" class="btn btn-primary" /> 
   <a href="usersList.php" class="btn btn-default">Cancel</a>
</div>
</div>
</form>
</div>
</section>
</div>
</div>
</section>
</section>
</section>
<?php include '../footer.php'; ?>
<script src="js/bootstrapValidator.js"></script>
<script src="js/script.js"></script>
</body>
</html>
