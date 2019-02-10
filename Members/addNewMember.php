<?php
    include '../connect.php';
    include '../head.php';  
    include '../header.php'; 
    include '../sidebar.php';
?>
<link href="css/bootstrapValidator.css" rel="stylesheet">
<style>       
 #success_message{ display: none;}
</style>
<!--start of page-->
 <section id="container" class="">   
   <section id="main-content" style="padding-left: 2%; padding-right: 2%">
    <section class="wrapper">
        <div class="row">
            <div class="col-lg-12">
                 <header><h3 class="page-header"><br>Add New Member</h3> </header>
            </div>
        </div>
        <?php include '../error.php'; ?>
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <div class="panel-body">
                        <form class="form-horizontal"  method="POST" action="newMember.php" id="contact_form" data-toggle="validator">
                            <div class="form-group ">
                                <label for="fullname" class="control-label col-lg-2">First Name<span class="">*</span></label>
                                     <div class="col-lg-6">
                                         <input class="form-control" id="firstName" name="firstName" type="text" required="" 
                                        onkeydown="preventNumberInput(event);"
                                        onkeyup="preventNumberInput(event);" />
                                    </div>
                            </div>
                            <div class="form-group ">
                                <label for="fullname" class="control-label col-lg-2">Middle Name<span class="">*</span></label>
                                    <div class="col-lg-6">
                                        <input class=" form-control" id="middleName" name="middleName" type="text" required=""
                                        onkeydown="preventNumberInput(event);"
                                        onkeyup="preventNumberInput(event);" />
                                    </div>
                            </div>
                            <div class="form-group ">
                                <label for="fullname" class="control-label col-lg-2">Last Name<span class="">*</span></label>
                                    <div class="col-lg-6">
                                        <input class=" form-control" id="lastName" name="lastName" type="text"required=""
                                        onkeydown="preventNumberInput(event);"
                                        onkeyup="preventNumberInput(event);" />
                                    </div>
                            </div>
                            <div class="form-group ">
                                <label for="address" class="control-label col-lg-2">Civil Status<span class="">*</span></label>
                                    <div class="col-lg-6">
                                        <select class="form-control input-sm m-bot15" name="civilStatus" required="">
                                            <option value=""></option>
                                            <option value="single">Single</option>
                                            <option value="married">Married</option>
                                            <option value="widow">Divorse</option>
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
                                        <input class=" form-control" id="homeAddress" name="homeAddress" type="text"  />
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
                                        onkeypress="return isNumber(event)" 
                                        required="" 
                                        oninvalid="this.setCustomValidity('Enter number between 0-9')">
</input>
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
                                        <input class=" form-control" id="emailAdd" name="emailAdd" type="email" required="" />
                                    </div>
                            </div><br>
                            <div class="form-group">
                                <div class="col-lg-offset-6 col-lg-2">
                                        <input type="submit" value="Save" name ="Save" class="btn btn-primary" /> 
                                        <a href="membersList.php"  class="btn btn-default">Cancel</a> 
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
<?php include '../footer.php';?>
<script src="js/bootstrapValidator.js"></script>
<script src="js/script.js"></script>
 