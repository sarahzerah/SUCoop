<?php include '../head.php'; 

include '../header.php';
include '../sidebar.php'; 
include '../functions.php';
date_default_timezone_set("Asia/Manila");
?>
<section id="container" class="">
    <section id="main-content" style="padding-left: 6%; padding-right: 4%" >
        <section class="wrapper">
            <div class="row" style="margin-right: 50%; padding-bottom: 2%">
                    <h1 class="page-header"><br>VIAND Sales for <?php echo date ("F j, Y"); ?></h1>
            </div>
            <div style="margin-top: -19px; margin-bottom: 21px;">
                <?php 
                include('../connect.php');
                $allitems = "SELECT * FROM inventory WHERE category='viand' ORDER BY itemName ASC"; //Select all products in the inventory alphabetically
                $allitemsqry= mysqli_query($con,$allitems);
                $overallitems= mysqli_num_rows($allitemsqry); //number of products in the inventory

                ?> 
            <!--Display Total number of products in the inventory and running out and out of stock products total-->
                <div style="text-align:center;"><h2>Total Number of Viands: <font color="green" style="font:bold 36px 'Aleo';">&nbsp; <?php echo $overallitems;?> </h2></font></div> 
            </div>  
</section>
<style>
    #example_filterWrapper{
     margin-left: 16px;
    }

    #example_filterSelect1{
    position: relative;
    }

</style>
<?php include '../error.php'; ?>

<!--SEARCH BY CATEGORY-->
<div class="row">
    <div style="height:50px;"></div>
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <div class="dataTable">
    <br />
                        <table class="table" id="example" class="display" cellspacing="0" style="font-size: 24px">
                            <thead>
                                <tr>
                                    <th>Item</th>
                                    <th>Unit</th>
                                    <th>Quantity</th>
                                    <th>Selling Price</th>
                                    <th>Item Cost</th>
                                    <!--Show Action only if the user logged in is the inventory personnel-->
                                    <?php if ($_SESSION['role']=='inventory personnel') : ?>
                                    <th>Quantity Sold</th>
                                    <?php endif; ?>
                                </tr>
                            </thead>
                            <tbody>

                                <?php 
                                    
                                $showall = "SELECT * FROM inventory WHERE category='viand' ORDER BY itemName ASC";
                                $filtered= mysqli_query($con,$showall);
                                    
                                    //start of loop for displaying products
                                    while($row = mysqli_fetch_array($filtered)):
                                        $productNum = $row['productNum'];                                            
                                        $quantity=$row['quantity'];
                                        $date=date("Y-m-d");

                                        $qtySold = "SELECT SUM(quantity) FROM items WHERE productNum='$productNum'";
                                        $qtySoldqry= mysqli_query($con,$qtySold);
                                        $row2 = mysqli_fetch_array($qtySoldqry);

                                            echo '<tr>';
                                       
                                ?> 
                                    <td>

                                        <!--if item is consigned, [CONSIGNED] should be displayed before the item name-->
                                        <?php 
                                            if ($row['consignment']=='yes')
                                                echo "[CONSIGNED] ".ucwords($row['itemName']);
                                            else 
                                                echo ucwords($row['itemName']); ?>
                                    </td>

                                    <td><?php echo ucwords($row['unit']);?></td>
                                    <td><?php if ($row['category']!='sud-an' && $row['unit']!='serving') echo $row['quantity'];?></td>
                                    <td><?php echo "Php ".formatMoney($row['SRP'], true); ?></td>
                                    <td style="padding-left:3%"><?php echo "Php ".formatMoney($row['originalPrice'], true);?></td>
                                <?php if ($_SESSION['role'] == 'inventory personnel'):?>
                                        <td style="padding-left: 6%">
                                            <?php echo $row2['SUM(quantity)']; ?>
                                <?php endif; ?>

                              </td>
                                </tr>
                            <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div><!-- /.dataTable -->
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


