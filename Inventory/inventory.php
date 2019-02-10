<?php 
    include '../head.php'; 
    include '../header.php';
    include '../sidebar.php'; 
    include '../functions.php';
?>

<section id="container" class="">
    <section id="main-content" style="padding-left: 5%; padding-right: 3%" >
        <section class="wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="page-header"><br>Inventory</h2>
                </div>
            </div>

            <div style="margin-top: -19px; margin-bottom: 21px;">
                <?php 
                    include('../connect.php');

                    $allitems = "SELECT * FROM inventory ORDER BY itemName ASC"; //Select all products in the inventory alphabetically
                    $allitemsqry= mysqli_query($con,$allitems);
                    $overallitems= mysqli_num_rows($allitemsqry); //number of products in the inventory

                    $runningoutofstock = "SELECT * FROM inventory where quantity <= 10 && unit!='serving'"; //Select all products with 10pcs and below
                    $runningoutofstockqry= mysqli_query($con,$runningoutofstock);
                    $runningoutitems= mysqli_num_rows($runningoutofstockqry); //number of products in the inventory with 10pcs and below
                ?>



                
            </div>

            <div>

                <!--If the user logged in is the inventory, Add Product should be displayed-->
                <?php if ($_SESSION['role']=='inventory personnel') : ?>
               
                <span><a href="#addnew" data-toggle="modal" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span> &nbsp;Add New Product</a></span>
                <?php 
                    include('addNewProduct.php'); 
                    endif;
                ?>
              
                <!--FILTER BY RUNNING OUT, OUT OF STOCK AND CONSIGNED ITEMS-->
                <div class="col-md-2" style="margin-left: 85%">
                    <form action="inventory.php" method="POST">
                        <div class="input-group">
                            <select name="filter" id="" class="form-control" required="">
                                <!-- <option value=""> </option> -->
                                <option value="0">All</option>
                                <option value="1">Running Out</option>
                                <option value="2">Out of Stock</option>
                                <option value="3">Consigned Items</option>
                            </select>

                            <span class="input-group-btn">
                                <input type="submit" name="submit" value="Filter" class="btn btn-success" />
                            </span>
                        </div>
                    </form>
                </div><!-- /.col-md-2-->

                
            </div>
        </section>

        <?php include '../error.php'; ?>

        <!--ALL ITEMS IN THE INVENTORY-->
        <div style="height:50px;"></div>
            <div class="row">
                <div class="col-lg-12">
                    <section class="panel">
                        <div class="dataTable"><br />
                            <table class="table" id="example" class="display" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th class="col-lg-4">Item</th>
                                        <th>Category</th>
                                        <th>Unit</th>
                                        <th>Quantity</th>
                                        <th>Selling Price</th>
                                        <th>Item Cost</th>
                                        <!--Show Action only if the user logged in is the inventory personnel-->
                                        <?php if ($_SESSION['role']=='inventory personnel') : ?>
                                        <th>Status</th>
                                        <?php endif; ?>

                                        <?php if ($_SESSION['role']=='inventory personnel') : ?>
                                        <th>Action</th>
                                        <?php endif; ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        
                                        //this would display items depending on the filter chosen
                                        if(isset($_POST['submit'])) {
                                            $filter=$_POST['filter'];

                                            //filter running out items (quantity is 1-10 pcs) alphabetically
                                            if ( $filter == 1) {
                                                $filter1 = "SELECT * FROM inventory WHERE quantity < 10 AND quantity != 0  AND unit != 'serving' ORDER BY itemName ASC";
                                                $filtered= mysqli_query($con,$filter1);
                                            } 

                                            //filter out of stock products alphabetically
                                            else if ( $filter == 2) {
                                                $filter2 = "SELECT * FROM inventory WHERE quantity = 0  AND unit != 'serving' ORDER BY itemName ASC";
                                                $filtered= mysqli_query($con, $filter2);
                                            }

                                            //filter consigned products alphabetically
                                            else if ( $filter == 3) {
                                                $filter3 = "SELECT * FROM inventory WHERE consignment = 'yes' ORDER BY itemName ASC";
                                                $filtered= mysqli_query($con, $filter3);
                                            }

                                            //if filter is 0, meaning show all products alphabetically
                                            else {
                                              $filter0 = "SELECT * FROM inventory  ORDER BY itemName ASC";
                                              $filtered= mysqli_query($con, $filter0);
                                            }

                                        }

                                        else {
                                            $showall = "SELECT * FROM inventory  ORDER BY itemName ASC";
                                            $filtered= mysqli_query($con,$showall);
                                        }
                                        
                                        //start of loop for displaying products
                                        while($row = mysqli_fetch_array($filtered)):
                                            $productNum = $row['productNum'];                                            
                                            $quantity=$row['quantity'];

                                            //products less than or equal to 10 should displayed in a red tuple
                                            if ($quantity <= 10 && $row['category']!='sud-an' && $row['unit']!='serving') {
                                                echo '<tr class="record" style="color: #fff; background:rgb(255, 95, 66);">';
                                            }

                                            else{
                                                echo '<tr>';
                                            }
                                    ?> 

                                        <td>

                                            <!--if item is consigned, [CONSIGNED] should be displayed before the item name-->
                                            <?php 
                                                if ($row['consignment']=='yes')
                                                    echo "[CONSIGNED] ".ucwords($row['itemName']);
                                                else 
                                                    echo ucwords($row['itemName']);
                                            ?>
                                        </td>
                                          
                                        <td><?php echo ucwords($row['category']);?></td>
                                        <td><?php echo ucwords($row['unit']);?></td>
                                        <td><?php if ($row['category']!='sud-an' && $row['unit']!='serving') echo $row['quantity'];?></td>
                                        <td><?php echo "Php ".formatMoney($row['SRP'], true); ?></td>
                                        <td><?php echo "Php ".formatMoney($row['originalPrice'], true);?></td>

                                        <!--if user logged in is the inventory personnel, restock button should be displayed-->

                                        <?php if ($_SESSION['role']=='inventory personnel') : ?>
                                        <td>
                                            <?php if ($row['unit']!='serving'):
                                                if ($row['status']=='received') : ?>
                                            <a href="#place<?php echo $productNum; ?>" data-toggle="modal" class="btn btn-primary"><span></span> Place Order</a>&nbsp; &nbsp; &nbsp; &nbsp;
                                            <?php include 'orderItem.php'; ?>

                                            <?php else : ?>
                                            <a href="purchaseOrder.php" data-toggle="modal" class="btn btn-success"><span></span> &nbsp; &nbsp;Ordered &nbsp; &nbsp;</a>
                                            <?php include 'orderItem.php'; ?>

                                            <?php endif; endif;?>

                                           </td>
                                            <td>
                                                 <!-- edit item if the user is the inventory personel-->
                                            <a href="#edit<?php echo $productNum; ?>" style="text-align:right;" data-toggle="modal" class="btn btn-primary"><span></span> &nbsp; &nbsp;Edit Item&nbsp;&nbsp;</a>
                                            <?php 
                                                include 'editproduct.php'; 
                                                endif; 
                                            ?>
                                            
                                            </td>
                                           
                                    </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div><!-- /.dataTable -->
                        
                        <!--Display Total number of products in the inventory and running out and out of stock products total-->
              <div style="text-align:center; font:bold 28px 'Aleo';">The total number of products is <font color="green" style="font:bold 28px 'Aleo';"> <?php echo $overallitems;?>.</font></div>
                <div style="text-align:center;"><font style="color:rgb(255, 95, 66); font:bold 28px 'Aleo';">There <?php if ($runningoutitems==0) echo "are no products "; else if ($runningoutitems==1) echo "is 1 product "; else echo "are ".$runningoutitems." products ";?>with 10 pieces or less.</font></div>
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


