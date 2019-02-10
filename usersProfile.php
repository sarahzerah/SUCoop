<?php 
include 'head.php';
include 'functions.php';
 ?>

<section id="container" class="">
<?php
  include 'header.php';
  if ($_SESSION['role']!='member')
  include 'sidebar.php';     
?>

<section id="main-content">
<section class="wrapper">
<div class="row">
<div class="col-lg-12">
<?php
include 'connect.php';    
$userID=$_SESSION['userID']; //get the userID of the user logged in

$qryUserInfo="SELECT * FROM user WHERE userID='$userID'"; //get the personal information of the user       
$run=mysqli_query($con, $qryUserInfo);
$row=mysqli_fetch_array($run);

$id=$row['userID'];
$firstName=$row['firstName'];
$lastName=$row['lastName'];
$middleName=$row['middleName'];
$birthDate=$row['birthDate'];
$homeAddress=$row['homeAddress'];
$civilStatus=$row['civilStatus'];
$emailAdd=$row['emailAdd'];
$currentAddress=$row['currentAddress'];
$contactNum=$row['contactNum'];
?>

<h3 class="page-header">Profile</h3>
</div>
</div>

<?php include 'error.php'; ?>

<div class="row">
<div class="col-lg-12">
<section class="panel">
<div class="panel-body">
<header><h3 style="color:Back"><b><?php echo ucwords($firstName." ".$middleName." ".$lastName); ?></b></h3> </header><br>

<h4><b>Personal Information</b></h4>
<h5><b>Civil Status: </b> <?php echo ucwords($civilStatus); ?> </h5>
<h5><b>Birth Date: </b>  <?php echo formatDate($birthDate); ?> </h5>
<h5><b>Home Address: </b>  <?php echo ucwords($homeAddress); ?> </h5>
<h5><b>Current Address: </b>  <?php echo ucwords($currentAddress); ?> </h5>
<h5><b>Contact Number: </b>  <?php echo $contactNum; ?> </h5>
<h5><b>Email Address: </b>  <?php echo $emailAdd; ?> </h5><br>


<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-1">Edit Contact Information</button>
<!--modal will be displayed once Edit Contact Information is clicked-->
<div class="modal fade" id="modal-1">
<div class="modal-dialog modal-lg">
   <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button> <!--button you can click to exit the modal-->
            <h3 class="modal-title">Edit Contact Information </h3>
        </div>
  
        <div class="modal-body">
            <form class="form-horizontal "  method="POST" 
            action="editUsersContactInfo.php"> <!--once save is clicked, it will be redirected to the same page-->
            <input type="hidden" name="id" 
            value="<?php echo $id;?>" />
                <div class="form-group">
                    <label class="control-label col-lg-4" class="control-label col-lg-2">Email Address<span class="required">*</span></label>
                    <div class="col-sm-6">
                        <input id="cp1" type="text"  size="16" name="emailAdd"  value="<?php echo $emailAdd;?>"  class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-lg-4" class="control-label col-lg-2">Contact Number <span class="required">*</span></label>
                    <div class="col-sm-6">
                        <input id="cp1" type="text"  size="16" name="contactNum"  value="<?php echo $contactNum?>"  class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-lg-4" class="control-label col-lg-2">Current Address <span class="required">*</span></label>
                    <div class="col-sm-6">
                        <input id="cp1" type="text"  size="16" name="currentAddress"  value="<?php echo $currentAddress?>"  class="form-control">
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
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-2">Edit Password</button>
<div class="modal fade" id="modal-2">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title">Edit Password</h3>
            </div>

            <div class="modal-body">
                <form class="form-validate form-horizontal "  method="POST" action="editPassword.php">
                    <div class="form-group">
                        <label class="control-label col-lg-4" class="control-label col-lg-4" style="font-weight: bold;">Current password <span class="required">*</span></label>
                        <div class="col-sm-6">
                            <input id="cp1" type="password"  size="16" name="currentPass" class="form-control" required="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-4" class="control-label col-lg-4" style="font-weight: bold;">New password<span class="required">*</span></label>
                        <div class="col-sm-6">
                            <input id="cp1" type="password"  size="16" name="newPass" class="form-control" required="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-4" class="control-label col-lg-4" style="font-weight: bold;">Confirm password<span class="required">*</span></label>
                        <div class="col-sm-6">
                            <input id="cp1" type="password"  size="16" name="confirmNewPass" class="form-control" required="">
                        </div>
                    </div>
                            
                    <div class="modal-footer">
                        <button class="btn btn-primary" name="submitPass" type="submit" value="<?php echo $id;?>">Save</button>
                    </div>
                </form>  
            </div>  
        </div>
    </div>
</div>
</div>
</section>
</div>
</div>
</section>
</section>
<?php include 'footer.php'; ?>
<script>    
    if(typeof window.history.pushState == 'function') {
        window.history.pushState({}, "Hide", '<?php echo $_SERVER['PHP_SELF'];?>');
    }
</script>