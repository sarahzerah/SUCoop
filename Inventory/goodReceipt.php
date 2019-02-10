
<?php  include '../head.php';  ?>

<section id="container" class="">   
    <?php 
        include '../header.php';
        include '../sidebar.php';
        include '../functions.php'; 
        include '../session.php'; 

        include '../error.php';
    ?>
        
    
    <section id="main-content" style="padding-left: 5%; padding-right: 2%">
    <section class="wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"><br>GOODS RECEIPT</h1>
            </div>
        </div>

        <form class="w3-container" action="" style="padding-bottom: 2%">
            <div class="w3-section">
                <label  style="font-size: 18px"><b>Search Supplier:</b></label>
                <input class="search w3-input w3-border w3-margin-bottom" type="text" id="myInput" list="supplier" name="supplier" placeholder="Search Supplier's Name" style="background-color: #fff;">
                <datalist id="supplier"></datalist>
            </div>
        </form>
 
      <?php include '../error.php'; ?>


              <!-- list ofsuppliers-->
        <section class="panel">
            <?php
                include '../connect.php';
                $query = "SELECT * FROM purchase_order ORDER BY PONum DESC";
                $run= mysqli_query($con,$query);
            ?>
            
            <table class="table table-striped table-advance table-hover"  id="userTbl" style="font-size: 20px">
                <tbody>
                    <tr>
                        <th>Company Name</th>
                        <th>Date Ordered<th>
                        <th colspan="4"></th>
                    </tr>

                    <?php 
                        while($row1 =mysqli_fetch_array($run)): 
                            $supplier=$row1['supplierID'];
                            $query1 = "SELECT * FROM supplier WHERE supplierID='$supplier'";
                            $run1= mysqli_query($con,$query1);
                            $row =mysqli_fetch_array($run1);
                            $id= $row['supplierID'];
                            $PONum=$row1['PONum'];

                    ?>

                    <tr>
                        <td>
                            <?php echo ucwords($row['companyName']);?>
                        </td>
                        <td>
                            <?php
                                echo formatDate($row1['dateOrdered']); 
                            ?>
                        </td>
                        <td>
                            <div class="btn-group">
                                <a class="btn btn-primary" href="viewRestocked.php?PONum=<?php echo $PONum; ?>" style="font-size: 20px"> See Orders</a>
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

