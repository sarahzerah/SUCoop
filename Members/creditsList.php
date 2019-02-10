
<?php  include '../head.php';
       include '../header.php';  
       include '../sidebar.php'; 
       include '../functions.php';
 ?>
<!-- container section start -->
<section id="container" class="">
    <section id="main-content" style="padding-left: 2%; padding-right: 2%" >
        <section class="wrapper">
            <div class="row">
                <div class="col-lg-12">
                <h3 class="page-header">Credit List</h3>
                </div>
            </div>
        <form class="w3-container" action="">
            <div class="w3-section">
                <label><b>Search Member:</b></label>
                <input class="search w3-input w3-border w3-margin-bottom" type="text" id="myInput" list="member" name="member" placeholder="Search Member's Name" style="background-color: #fff;">
                <datalist id="member"></datalist>
            </div>
        </form>
        <!--Message once info is updated-->
        <?php 
            if(isset($_SESSION['success'])) : {
                unset($_SESSION['success']);
            }
        ?>
        <div class="alert alert-success" style="margin: 10px; padding-left: 100px;">
            <a href="#" class="close" data-dismiss="success">&times;</a>
            <?php 
                echo "Record successfully updated!";
            ?>
        </div>
        <?php 
            else: 
                echo ''; 
            endif; 
        ?>
        <!-- list of members-->
        <section class="panel">
            <?php
                include '../connect.php';
                $query = "SELECT * FROM user WHERE role='member' ORDER BY lastName ASC";
                $run= mysqli_query($con,$query);
            ?>
            <table class="table table-striped table-advance table-hover"  id="userTbl">
                <tbody>
                    <tr>
                        <th><i class="icon_profile"></i>Full Name</th>
                        <th colspan="4"></th>
                    </tr>
                    <?php 
                        while($row =mysqli_fetch_array($run)): 
                            $id= $row['userID'];
                    ?>
                    <tr>
                        <td>
                            <?php echo ucwords($row['lastName'].", ".$row['firstName']." ".($row['middleName'][0]).".");?>
                        </td>
                        <td>
                            <?php 
                                    
                                $query1= "SELECT * FROM member WHERE userID='$id'";
                                $run1= mysqli_query($con,$query1);
                                $row1 =mysqli_fetch_array($run1);

                                echo "Php ".formatMoney($row1['creditBalance'], true);
                            ?>
                        </td>
                    </tr>
                    <?php endwhile;?>
                </tbody>
            </table>
        </section>
      </section>
  </section><!--main content end-->
</section><!-- container section end -->
<?php include '../footer.php';   ?>
