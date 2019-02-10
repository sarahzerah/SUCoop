<?php include '../head.php'; ?>
<section id="container" class="">
        
<?php 
    include '../header.php';
    include '../sidebar.php'; 
    include '../functions.php';
    include '../connect.php';

    echo $dater= $_GET['dateRd'];
    echo "<br>".$sid=$_GET['id'];

    $qry="SELECT * FROM goods_receipt WHERE dateRestocked='$dater' AND supplierID='$sid'";
    $drun=mysqli_query($con,$qry);
    $drow=mysqli_fetch_array($drun);
    $grnum=$drow['GRNum'];

    $restock="SELECT * FROM restocked_items WHERE GRNum='$grnum'";
    $rrun=mysqli_query($con,$restock);

     //$rows = mysqli_fetch_array($drun);
    
?>

<section id="main-content" style="padding-left: 4%; padding-right: 2%;">
    
    <section class="wrapper">
         <a href=" viewSuppliersProfile.php?id=<?php echo $_SESSION['supplier'];?>" style="">  <!--2 >> navigate to memberList <3 -->
              <img src ="./img/back.png" style="height: 20px; width: 20px; margin-top: 2%;">
              <img src ="./img/back.png" style="height: 20px; width: 20px; margin-top: 2%">
        </a>
		    <div class="row">
				    <div class="col-lg-12">
					      <h1 class="page-header"><br>Goods Receipt on <?php echo formatdate($dater); ?> </h1>
                           <?php 
                           $suID=$_SESSION['supplier'];
                           $sup="SELECT * FROM supplier WHERE supplierID='$suID'";
                           $sql=mysqli_query($con,$sup);
                           $srow=mysqli_fetch_array($sql);
                           echo "<h2>Supplier :".$srow['companyName']."</h2>"; 
                           ?>
				    </div>
			  </div>
      
    </section>

    <div></div>
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <div>
                        <table class="table" id="dataTable" style="font-size: 24px">
                            <thead>
                                <tr>
                                    <th>Item</th>
                                    <th>Category</th>
                                    <th>Unit</th>
                                    <th>Quantity Added</th>
                                    <th>Selling Price</th>
                                    <th>Item Cost</th>
                                </tr>
                            </thead>
                            <tbody>
                            <tr>
                            <?php 

                            $totalGood=0;
                            while($rrow= mysqli_fetch_assoc($rrun)){

                                 $prodno= $rrow['productNum'];
                                 $q=$rrow['quantity'];
                    

                                 $item = "SELECT * FROM inventory WHERE productNum='$prodno'";
                                 $irun=mysqli_query($con,$item);

                                while($row =mysqli_fetch_array($irun)){ ?> 
                                    <td><?php echo ucwords($row['itemName']); ?></td>
                                    <td><?php echo $row['category']; ?></td>
                                    <td><?php echo $row['unit']; ?></td>
                                    <td style="padding-left:5%"><?php echo $q; ?></td>
                                    <td><?php echo "Php ".formatMoney($row['SRP'], true); ?></td>
                                    <td><?php echo "Php ".formatMoney($row['originalPrice'], true); ?></td>
                                    <?php $totalGood=$totalGood+$row['originalPrice']; ?>
                                </tr>
                                <?php }
                            } ?>
                        </tbody>
                    </table>

                    
                </div>
                <div style="text-align:center; font: 36px 'Aleo';">Total : <?php echo "<b>".formatMoney($totalGood)."</b>"; ?></div>

            </section>
        </div>
    </div>
     <div class="btn-group">
      
     </div>
</section>


         
</section>
<?php include '../footer.php'; ?>

