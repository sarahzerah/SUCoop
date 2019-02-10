<?php include '../head.php'; ?>

<section id="container" class="">
   
<?php 
    include '../header.php';
    include '../sidebar.php';
    include '../functions.php'; 

?>

<section id="main-content" style="padding-left: 4%; padding-right: 2%">
    <section class="wrapper">
		    <div class="row">
            <a href="../Reports/report.php" style="margin-top: 2%">
              <img src ="./img/back.png" style="height: 20px; width: 20px; margin-top: 50px">
              <img src ="./img/back.png" style="height: 20px; width: 20px; margin-top: 50px">
            </a> 
				    <div class="col-lg-12"> 
     <header><h1 style="color:Back"><b><br>INVENTORY REPORT as of <?php echo date ("F d, Y"); ?></b></h1> </header><br>
            </div>
			</div>
              
      <div class="row">
          <div class="col-lg-12">
           
              <section class="panel">
                  <div class="panel-body">
                    <div class="row">
                              <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="info-box blue-bg">
             
                    <div class="count">
                        <?php 
                          include '../connect.php';
                          $resul = "SELECT * FROM inventory WHERE quantity <= 10 AND unit!='serving'";
                          $sql= mysqli_query($con,$resul);
                          $outstock= mysqli_num_rows($sql);

                          echo $outstock;
                        ?>
                    </div>
                    <div class="title" style="font-size: 20px">
                      <?php 
                          if ($outstock<=1) 
                              echo "Item ";
                          else
                              echo "Items ";
                      ?>
                      Running Out</div><br>
                   
                </div>
            </div>
      

                              <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="info-box blue-bg">
              
                    <div class="count">
                        <?php 
                   
                          $resul2 = "SELECT * FROM supplier";
                          $sql2= mysqli_query($con,$resul2);
                          $numSup= mysqli_num_rows($sql2);

                          echo $numSup;
                        ?>
                    </div>
                    <div class="title" style="font-size: 20px">
                      
                      Number of Suppliers</div><br>
                   
                </div>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="info-box blue-bg">
                    <div class="count">
                        <?php 
                  
                          $resul3 = "SELECT DISTINCT(itemName) FROM inventory";
                          $sql3= mysqli_query($con,$resul3);
                          $product= mysqli_num_rows($sql3);

                          echo $product;
                        ?>
                    </div>
                    <div class="title" style="font-size: 20px">
                      
                      Number of Products</div><br>
                   
                </div>
            </div>
          </div>
                     <?php include 'itemsRunningOut.php'; ?>
                   
                 
                      <a class="btn btn-primary" href="printinventory.php">Print</a>&nbsp; &nbsp; &nbsp;
          
</div>  
          </div>
      </section>
  </section>
<?php include '../footer.php'; ?>
<script>    
    if(typeof window.history.pushState == 'function') {
        window.history.pushState({}, "Hide", '<?php echo $_SERVER['PHP_SELF'];?>');
    }
</script>