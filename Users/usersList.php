
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
                <h1 class="page-header"><br>Users' List </h1>
            </div>
        </div>

        <form class="w3-container" action="">
            <div class="w3-section">

                <label><h4><b>Search User:</b></h4></label>
                <input class="search w3-input w3-border w3-margin-bottom" type="text" id="myInput" list="user" name="user" placeholder="Search User's Name" style="background-color: #fff;color: black; font-size: 20px">
                <datalist id="user"></datalist>
            </div>
        </form>
         <?php if(isset($_GET['error'])) : ?>
          <div class="alert alert-success text-center" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <?php echo htmlentities($_GET['error']); ?>   
          </div>
              <?php 
              else:
              echo '';
              endif; 
            ?>
            <br>
        <div class="row">
            <div class="col-lg-12">
                 <a class="btn btn-success" href="addNewUser.php" style="font-size: 18px"><i class="icon_plus_alt2"></i> Add New User</a><br>
                  <br>
            </div>
        </div>
        <br>
  <?php include "../error.php";?>
        <!--Message once info is updated-->
        <?php 
            if(isset($_SESSION['success'])) : {
                unset($_SESSION['success']);
            }
        ?>

        <div class="alert alert-success" style="margin: 10px; padding-left: 100px;">
            <a href="#" class="close" data-dismiss="success">&times;</a>
            <?php 
                echo "User successfully updated!";
            ?>
        </div>

        <?php 
            else: 
                echo ''; 
            endif; 
        ?>

        <!--List of Users-->
        <section class="panel">
            <?php
                include '../connect.php';
                $query = "SELECT * FROM user WHERE role!='member' AND status='active' ORDER BY lastName ASC";
                $run= mysqli_query($con,$query);
            ?>
            
            <table class="table table-striped table-advance table-hover"  id="userTbl">
                <tbody>
                    <tr>
                        <th style="font-size: 24px"><i class="icon_profile" ></i>Full Name</th>
                        <th colspan="4"></th>
                    </tr>

                    <?php 
                        while($row =mysqli_fetch_array($run)): 
                            $id= $row['userID'];
                    ?>

                    <tr>
                        <td style="font-size: 24px; border-color: white">
                            <?php echo ucwords($row['lastName'].", ".$row['firstName']." ".($row['middleName'][0]).".");?>
                        </td>

                        <td style="border-color:white">
                            <div class="btn-group" >
                                <a class="btn btn-primary" href="viewUsersProfile.php?id=<?php echo $id;?>" style="font-size: 20px">View Profile  </a>
                            </div>
                        </td>
                    </tr>
                    
                    <?php endwhile; ?>
                </tbody>
            </table>
        </section>
      </section>
  </section><!--main content end-->
</section><!-- container section end -->


<?php include '../footer.php';   ?>
<script>    
    if(typeof window.history.pushState == 'function') {
        window.history.pushState({}, "Hide", '<?php echo $_SERVER['PHP_SELF'];?>');
    }
</script>