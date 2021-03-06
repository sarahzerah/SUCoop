
<?php  include '../head.php';  ?>

<section id="container" class="">
    
    <?php 
        include '../header.php';
        include '../sidebar.php'; 
    ?>
        
    
    <section id="main-content" style="padding-left: 4%; padding-right: 2%">
    <section class="wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"><br>Suppliers' List </h1>
            </div>
        </div>

        <form class="w3-container" action="" style="padding-bottom: 2%">
            <div class="w3-section">
                <label><h4><b>Search Supplier:</b></h4></label>
                <input class="search w3-input w3-border w3-margin-bottom" type="text" id="myInput" list="supplier" name="supplier" placeholder="Search Supplier's Name" style="background-color: #fff; color: black; font-size: 20px">
                <datalist id="supplier"></datalist>
            </div>
        </form>

        <?php if ($_SESSION['role']=='inventory personnel') : ?>
        <div class="row">
            <div class="col-lg-12">
                  <a class="btn btn-success" href="addNewSupplier.php" style="font-size: 18px"><i class="icon_plus_alt2"></i> &nbsp;&nbsp;Add New Supplier</a> <br><br>
            </div>
        </div>
        <?php endif; ?>


      <?php include '../error.php'; ?>


              <!-- list ofsuppliers-->
        <section class="panel">
            <?php
                include '../connect.php';
                $query = "SELECT * FROM supplier WHERE status ='active'";
                $run= mysqli_query($con,$query);
            ?>
            
            <table class="table table-striped table-advance table-hover"  id="userTbl">
                <tbody>
                    <tr>
                        <th style="font-size: 24px"><i class="icon_profile"></i>Full Name</th>
                        <th colspan="4"></th>
                    </tr>

                    <?php 
                        while($row =mysqli_fetch_array($run)): 
                            $id= $row['supplierID'];
                    ?>

                    <tr>
                        <td style="font-size: 24px; border-color: white">
                            <?php echo ucwords($row['companyName']);?>
                        </td>
                    <!--Blanche: Added a style aligh-->
                        <td style="border-color:white">
                            <div class="btn-group">
                                <a class="btn btn-primary" href="viewSuppliersProfile.php?id=<?php echo $id;?>" style="font-size: 20px">View Profile</a>
                            </div>
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

<script>    
    if(typeof window.history.pushState == 'function') {
        window.history.pushState({}, "Hide", '<?php echo $_SERVER['PHP_SELF'];?>');
    }
</script>

