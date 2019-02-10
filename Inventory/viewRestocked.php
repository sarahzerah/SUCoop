<?php include '../head.php'; ?>
<section id="container" class="">
    
<?php 
include '../header.php';
include '../sidebar.php'; 
include '../functions.php';
include '../connect.php';
//include '../session.php';
if (isset($_GET['PONum'])) {
$PONum=$_GET['PONum'];
$_SESSION['PONum']=$PONum;
}
$qryz="SELECT * FROM purchase_order WHERE PONum='{$_SESSION['PONum']}'";
$drunz=mysqli_query($con,$qryz);
$rowz =mysqli_fetch_array($drunz);
$date=$rowz['dateOrdered'];
$sid=$rowz['supplierID'];
$total=$rowz['totalAmount'];

$gr="SELECT * FROM goods_receipt WHERE supplierID='$sid";
$sq=mysqli_query($con,$gr);
$r=mysqli_fetch_array($sq);

$qry="SELECT * FROM ordered_items WHERE PONum='{$_SESSION['PONum']}'";
$drun=mysqli_query($con,$qry);


$qry4 ="SELECT * FROM supplier WHERE supplierID= '$sid'";
$sql4= mysqli_query($con,$qry4);
$row4=mysqli_fetch_array($sql4);

$qry3 ="SELECT * FROM inventory WHERE productNum= '$PONum'";
$sql3= mysqli_query($con,$qry3);
$row3=mysqli_fetch_array($sql3);

?>

<section id="main-content" style="padding-left: 4%; padding-right: 2%;">
<section class="wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header" style="margin-left: -2%"><br>Products Ordered on <?php echo formatdate($date);?> </h1>
                <h3>Supplier: <?php echo ucwords($row4['companyName']); ?> </h3>
            </div>
        </div>
</section>

<div></div>
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <div>
                    <table class="table" id="dataTable" style="font-size: 20px">
                        <thead>
                            <tr>
                                <th>Item Name</th>
                                <th>Category</th>
                                <th>Unit</th>
                                <th>Quantity Ordered</th>
                                
                                <th>Price</th>
                                <th>Total Amount</th>

                                <?php if ($row3['status']=='ordered') : ?>
                                 <th>Status</th>
                                <?php else : ?>
                                 <th>Action</th> 
                                <?php endif; 
                                ?><th>Comment</th>
                                <?php  while($row =mysqli_fetch_array($drun)): 
                                if ($row['comment']!=null) : ?>
                                
                            <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                        <tr>
                         <?php 
                          
                          $query = "SELECT * FROM ordered_items WHERE PONum='{$_SESSION['PONum']}'";
                          $run= mysqli_query($con,$query);

                             
                                $pNum=$row['productNum'];
                                $orderNum=$row['orderNum'];
                                $PONum=$row['PONum'];

                            $qry3 ="SELECT * FROM inventory WHERE productNum= '$pNum'";
                            $sql3= mysqli_query($con,$qry3);
                            $row3=mysqli_fetch_array($sql3);
                            $status= $row3['status'];
                                
                      ?>

                            <tr>
                                <td><?php echo ucwords($row3['itemName']); ?></td>
                                <td><?php echo ucwords($row3['category']); ?></td>
                                <td><?php echo ucwords($row3['unit']); ?></td>
                                <td><?php echo $row['quantity']; ?></td>
                               
                                <td><?php echo "Php ".formatMoney($row3['originalPrice'], true); ?></td> 
                                <td><?php echo "Php ".formatMoney($row['quantity'] * $row3['originalPrice'], true);?></td>
                                <td>    
                                        
                                        <?php if ($status == 'ordered' || $status == 'lacking' ) : ?>
                                        <a href="#receive<?php echo $pNum; ?>" data-toggle="modal" class="btn btn-success"><span></span>Receive</a>&nbsp; &nbsp; &nbsp; &nbsp;
                                        <?php include 'receiveItem.php'; ?>
                                        <a class="btn btn-danger" href="cancelOrder.php?orderNum=<?php echo $orderNum; ?>&PONum=<?php echo  $PONum; ?>&pNum=<?php echo  $pNum; ?>">Cancel</a>
                                        <?php 
                                            else :
                                                
                                                echo "Received";
                                            endif; ?>
                                        
                                    </td>
                                    <td><?php echo $row['comment']; ?></td>
                              <?php endwhile;?> 
                            </tr>
                    </tbody>
                </table>
            </div>
<h2 align="center" ><b>Sub-total: </b> <?php echo "Php ".formatMoney($total,true); ?></h2>
        </section>
    </div>
</div>
 <div class="btn-group">
  
 </div>
</section>
</section>
<?php include '../footer.php'; ?>

<script>    
if(typeof window.history.pushState == 'function') {
window.history.pushState({}, "Hide", '<?php echo $_SERVER['PHP_SELF'];?>');
}
</script>   

