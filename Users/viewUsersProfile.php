 <?php include '../head.php'; ?>
<?php 
    include '../header.php';
    include '../sidebar.php';
    include '../functions.php'; 
    include '../error.php';

                    include '../connect.php';

                    if (isset($_POST['submit']))
                        $id=$_SESSION['user'];
                    else {
                        if(isset($_GET['id']))
                            $id= $_GET['id'];
                        else
                            $id=$_SESSION['user'];
                    }

                    $_SESSION['user']=$id;

                    $qry= "SELECT * FROM user WHERE userID='$id'";
                    $run= mysqli_query($con, $qry);

                    $rows= mysqli_fetch_array($run);
                            
                    $id=$rows['userID'];
                    $firstName=$rows['firstName'];
                    $lastName=$rows['lastName'];
                    $middleName=$rows['middleName'];
                    $role=$rows['role'];
                    $birthDate=$rows['birthDate'];
                    $homeAddress=$rows['homeAddress'];
                    $civilStatus=$rows['civilStatus'];
                    $emailAdd=$rows['emailAdd'];
                    $currentAddress=$rows['currentAddress'];
                    $contactNum=$rows['contactNum'];
                    $contactNum2=$rows['contactNum2'];
                    $picture=$rows['picture'];

?>

<section id="container" class="">
<link href="css/bootstrapValidator.css" rel="stylesheet">
<style>       
#success_message{ display: none;}
</style>
<section id="main-content" style="padding-left: 4%; padding-top: 2%; padding-right: 2%">
<br>  
   <a href="usersList.php" style="margin-left: 2%;">  <!--2 >> navigate to memberList <3 -->
              <img src ="./img/back.png" style="height: 20px; width: 20px; margin-top: 5%;">
              <img src ="./img/back.png" style="height: 20px; width: 20px; margin-top: 5%">
  </a> 
    <section class="wrapper">
      <div class="row">
          <div class="col-lg-12">
              <section class="panel">
                  <div class="panel-body" style="font-size: 24px">
                      <?php include '../error.php'; ?>
                      <header><h2 style="color:Back"><b><?php echo ucwords($firstName." ".$middleName." ".$lastName); ?></b></h2> </header><br>
                    <table style="width: 100%">
                      <tr>
                        <td style="width:5%; padding-bottom: 6%">
                       <!-- start image -->
                     <?php include 'image.php';  ?>
                     <!-- Image update link -->
                    </td>
                    <td style="padding-left: 2%;">

                       <br>
                      <b>Role: </b><?php echo ucwords($role); ?><br> 
                      <b>Civil Status: </b><?php echo ucwords($civilStatus); ?><br> 
                      <b>Birth Date: </b><?php echo formatDate($birthDate); ?><br>
                      <b>Home Address: </b><?php echo ucwords($homeAddress); ?><br>
                      <b>Current Address: </b><?php echo ucwords($currentAddress); ?><br>  
                      <b>Contact Number <?php if(!empty($contactNum2)): echo "1"; endif; ?> :</b><?php echo $contactNum; ?><br>
                      <?php if(!empty($contactNum2)){?>
                      <b>Contact Number 2: </b><?php echo $contactNum2; ?><br>
                      <?php } ?>
                      <b>Email Address: </b><?php echo $emailAdd; ?><br><br>
                     <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-2">Delete User</button> 

                     <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-1">Edit Contact Information</button>   
                    </td>
                  </tr>
                </table>
                 

<!-- start of Modal -->
<div class="modal fade" id="modal-1">
<div class="modal-dialog modal-lg"  style="width: 50%">
   <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button> <!--button you can click to exit the modal-->
            <h3 class="modal-title">Edit Contact Information </h3>
        </div>
        <div class="modal-body" style="width: 100%">
            <form class="form-horizontal" id="contact_form" method="POST" action="editUsersContactInfo.php"> <!--once save is clicked, it will be redirected to the same page-->
                 <input type="hidden" name="id"  value="<?php echo $id;?>" />
                <div class="form-group">
                    <label class="control-label col-lg-4" class="control-label col-lg-2">Email Address<span class="required">*</span></label>
                    <div class="col-sm-6">
                        <input id="cp1" type="text"  size="16" name="emailAdd"  value="<?php echo $emailAdd;?>"  class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-lg-4" class="control-label col-lg-2">Contact Number 1<span class="required">*</span></label>
                    <div class="col-sm-6">
                        <input type="telephoneNum"  size="16" name="contactNum"  value="<?php echo $contactNum?>" onkeypress="return isNumber(event)"
                         class="form-control" maxlength="11"  required=""  >
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-lg-4" class="control-label col-lg-2">Contact Number 2</label>
                    <div class="col-sm-6">
                        <input    size="16" name="contactNum2" <?php if(!empty($contactNum2)): ?>value="<?php echo $contactNum2?>" <?php else: echo"placeholder='09'"; endif;?> type="telephoneNum"  
                          onkeypress="return isNumber(event)"  class="form-control"  maxlength="11">
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
<!-- End of Modal -->
<!-- Start of Deleting Modal -->


<div class="modal fade" id="modal-2">
<div class="modal-dialog modal-lg">
   <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button> <!--button you can click to exit the modal-->
            <h3 class="modal-title">Delete User</h3>
        </div>
              <div class="modal-body">
            <form class="form-horizontal" id="contact_form" method="POST" action="deleteuser.php"> <!--once save is clicked, it will be redirected to the same page-->
                     <input type="hidden" name="delete"  value="<?php echo $_SESSION['user'];?>" />
                      <label style="text-align: right; font-size: 24px;"> 
                        Are you sure you want to delete <?php echo $firstName. " " . $lastName; ?>
                      <div  style="text-align: right; padding-right: 20% "> If yes, please enter the reason...  </div> </label>
                    <div class="col-sm-12" >
                        <input id="cp1" type="text"  size="100" name="comment" id="comment" placeholder="enter a reason"  class="form-control"  required=""  >
                   
                    </div>
                <div class="modal-footer" style="">
                    <input type="submit" class="btn btn-primary" name="save" value="Delete"/> 
                </div>
            </form>
        </div>
    </div>
</div>
</div> 
<!-- End of Deleting Modal -->
            </div>
        </section>
        </div>
    </div>
  </section>
</section>

<?php include '../Members/footer.php'; ?>
<script>    
    if(typeof window.history.pushState == 'function') {
        window.history.pushState({}, "Hide", '<?php echo $_SERVER['PHP_SELF'];?>');
    }
</script>

<script src="js/bootstrapValidator.js"></script>
<script src="js/script.js"></script>