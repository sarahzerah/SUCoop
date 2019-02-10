<?php 
include '../head.php'; 
include '../header.php';
include '../sidebar.php'; 
include '../functions.php';
include '../connect.php';
include '../session.php';
?>
<section id="container" class="">
<?php 

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

$qry="SELECT * FROM ordered_items WHERE PONum='{$_SESSION['PONum']}'";
$drun=mysqli_query($con,$qry);

$qry4 ="SELECT * FROM supplier WHERE supplierID= '$sid'";
$sql4= mysqli_query($con,$qry4);
$row4=mysqli_fetch_array($sql4);



?>

<section id="main-content" style="padding-left: 4%; padding-right: 2%;">
<section class="wrapper">
    <div class="row">
		<div class="col-lg-12">
			<h1 class="page-header" style="margin-left: -2%"><br>Products Ordered on <?php echo formatdate($date);?> </h1>
            <h2>Supplier: <?php echo ucwords($row4['companyName']); ?> </h2>
		</div>
	</div>
</section>

<div></div>
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <div>
                <br />
        <table id="example" class="table" class="display" width="100%" cellspacing="0" style="font-size: 20px">
                <thead>
                    <tr>

                         <th>Item Name</th>
                          <th>Category</th>
                          <th>Unit</th>
                          <th>Quantity Ordered</th>
                          <th>Item Cost</th>
                          <th>Total Amount</th>
                    </tr>
                </thead>
                <tbody>
                     <?php 
                            $query = "SELECT * FROM ordered_items WHERE PONum='{$_SESSION['PONum']}'";
                            $run= mysqli_query($con,$query);
                               while($row =mysqli_fetch_array($drun)): 
                                  $pNum=$row['productNum'];
                                  $orderNum=$row['orderNum'];
                                  $PONum=$row['PONum'];
           
                              $qry3 ="SELECT * FROM inventory WHERE productNum= '$pNum'";
                              $sql3= mysqli_query($con,$qry3);
                              $row3=mysqli_fetch_array($sql3);
                             
                          ?>
                    <tr>
                     
                         <td> <?php echo ucwords($row3['itemName']); ?></td>
                          <td><?php echo ucwords($row3['category']); ?></td>
                          <td><?php echo ucwords($row3['unit']); ?></td>
                          <td><?php echo $row['quantity']; ?></td>
                          <td><?php echo "Php ".formatMoney($row3['originalPrice'], true); ?></td> 
                          <td><?php echo "Php ".formatMoney($row['quantity'] * $row3['originalPrice'], true);?></td>
                    </tr>
                    <?php endwhile; ?>
               </tbody>
            </table>
        </div>
<h3 align="center" ><b>Total: </b> <?php echo "Php ".formatMoney($total,true); ?></h3>
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

