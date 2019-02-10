<?php include '../session.php'; ?>
<?php  include '../head.php';  ?>
<!-- container section start -->
<section id="container" class="">
    <!--header and sidebar-->
    <?php include '../header.php';  ?>
    <?php include '../sidebar.php'; ?>
    <!--main content start-->
<section id="main-content" style="padding-left: 4%; padding-right: 2%">
    <section class="wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"><br>Members' List </h1>
            </div>
        </div>
            <form class="w3-container" action="" >        
                <div class="w3-section" style="padding-bottom: 2%">
                    <label><h4> <b>Search Member:</b></h4></label>
                    <input class="search w3-input w3-border w3-margin-bottom" type="text" id="myInput" list="member" name="member" placeholder="Search Member's Name" style="background-color: #fff;color: black; font-size: 20px">
                    <datalist id="member"></datalist>
                </div>
            </form>
                 <?php include "../error.php";?>
                    <!--Message once info is updated-->
                    <?php 
                        if(isset($_SESSION['success'])) : {
                            unset($_SESSION['success']);
                        }
                    ?>
                    <div class="alert alert-success" style="margin: 10px; padding-left: 100px;" >
                        <a href="#" class="close" data-dismiss="success">&times;</a>
                        <?php 
                            echo "Member successfully added!";
                        ?>
                    </div>          
                        <?php 
                            else: 
                                echo ''; 
                            endif; 
                        ?>
                    <!-- list of members-->
<br>
<section class="panel" >
    <?php
        include '../connect.php';
        $query = "SELECT * FROM user WHERE role='member' AND status='active' ORDER BY lastName ASC";
        $run= mysqli_query($con,$query);  ?>
            <table class="table table-striped table-advance table-hover"  id="userTbl" style="font-size: 20px">
                <tbody>
                    <tr>
                        <th><i class="icon_profile"></i>Full Name</th>
                        <th colspan="4"></th>
                    </tr>
                        <?php 
                            while($row =mysqli_fetch_array($run)): 
                            $_SESSION['memberID']= $row['userID'];
                        ?>
                    <tr>
                        <td style="border-color:white"><?php echo ucwords($row['lastName'].", ".$row['firstName']." ".($row['middleName'][0]).".");?></td>
                        <td style="border-color:white">
                            <div class="btn-group">
                                <form method="post" action="viewMembersProfile.php">
                                    <input type= "submit" name="submit"  value="View" class="btn btn-primary" style="font-size: 20px">
                                        <input type="hidden" name="memberid" value="<?php echo $_SESSION['memberID']; ?>">
                                </form>
                            </div>
                        </td>
                    </tr>   
                        <?php endwhile;?>
                </tbody>
            </table> <!--end of table-->
        </section> <!--End of section panel-->
    </section><!-- end of section wrapper-->
  </section><!--main content end-->
</section><!-- container section end -->
<script src="js/filter.js"></script>
<?php include '../footer.php'; ?>
<script>    
    if(typeof window.history.pushState == 'function') {
        window.history.pushState({}, "Hide", '<?php echo $_SERVER['PHP_SELF'];?>');
    }
</script>

