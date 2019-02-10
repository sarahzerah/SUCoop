<table class="table" style="color: black;">
  <thead>
    <tr>
      <td style="width: 30%">
      <div>
      <?php if ($_SESSION['role'] == 'secretary'){
        include 'image.php'; 
      echo "</div>";
      }else{ ?>
        <img src="images/<?php echo $picture; ?>"  style="width:250px; height: 250px;">
      <?php  }  ?> 
    </td>
    <td>
         <strong>Full Name: </strong>&nbsp; &nbsp;<?php echo ucwords($firstName." ".$middleName." ".$lastName); ?><br> 
         <strong>Civil Status: </strong> &nbsp; &nbsp;<?php echo ucwords($civilStatus); ?><br> 
         <strong>Birthdate: </strong> &nbsp; &nbsp;<?php echo formatDate($birthDate); ?> <br>
         <strong>Home Address:  </strong>&nbsp; &nbsp;<?php echo ucwords($homeAddress); ?><br>
         <strong>Current Address:  </strong>&nbsp; &nbsp;<?php echo ucwords($currentAddress); ?><br>  
         <strong>Contact Number <?php if (!empty($contactNum2)): echo "1"; endif; ?> : </strong>&nbsp; &nbsp;<?php echo $contactNum; ?><br>
         <?php if (!empty($contactNum2)){ ?>
         <strong>Contact Number 2: </strong>&nbsp; &nbsp;<?php echo $contactNum2; ?><br>
         <?php } ?>
         <strong>Email Address: </strong>&nbsp; &nbsp;<?php echo $emailAdd; ?><br>
         <strong>Member Since: </strong>&nbsp; &nbsp;<?php echo formatDate($dateCreated); ?><br><br><br>  
         
         <?php if($_SESSION['role'] == 'secretary'):?>
         <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-1">Delete Member</button><?php endif;?>
       </td>
       </td>            
   </tr>
 </thead>
</table>
<br>
<?php if ($_SESSION['role'] =='secretary'){?>
 

<div class="modal fade" id="modal-1">
<div class="modal-dialog modal-lg">
   <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button> <!--button you can click to exit the modal-->
            <h3 class="modal-title">Delete Member </h3>
        </div>
              <div class="modal-body">
            <form class="form-horizontal" id="contact_form" method="POST" action="deleteMember.php"> <!--once save is clicked, it will be redirected to the same page-->
                     <input type="hidden" name="delete"  value="<?php echo $_SESSION['user'];?>" />
                      <label style="text-align: right; font-size: 20px; padding-bottom: 2%">Are you sure you want to delete <?php echo $firstName. " " . $lastName; ?>
                      <div style="padding-right: 30%"> Please enter the reason...  </div> </label>
                    <div class="col-sm-12"">
                        <input id="cp1" type="text"  size="24" name="comment" id="comment" placeholder="enter a reason"  class="form-control"  required="" >
                     
                    </div>
                <div class="modal-footer" style="margin-top: 2%">
                    <input type="submit" class="btn btn-primary" name="save" value="Delete"/> 
                </div>
            </form>
        </div>
    </div>
</div>
</div> 
<?php } ?>  
<?php 
if ($_SESSION['role'] =='secretary'){
      include './footer.php';
      include '../footer.php';
}
 

 include '../footer.php'; ?> 

<script src="js/bootstrapValidator.js"></script>
<script src="js/script.js"></script>