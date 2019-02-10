<?php

$per_page= 10;

if (isset($_GET['page'])) {
  
  $page = $_GET['page'];

}else{

  $page=1;
}

$start_from = ($page-1)*$per_page;

?>

<h2>Items Running Out and Out of Stock</h2><br>

<table class="table table-striped table-advance table-hover"  id="userTbl" style="font-size: 20px">
                <tbody>
                    <tr>
                        <th><i class="icon_profile"></i>Item Name</th>
                        <th colspan="4">Quantity</th>
                    </tr>
<?php 

	 	$resul = "SELECT * FROM inventory where quantity <= 10  AND unit!='serving'
           ORDER BY quantity   ASC LIMIT $start_from, $per_page";
                $sql= mysqli_query($con,$resul);

              if(mysqli_num_rows($sql) >= 0): 

                while ($row= mysqli_fetch_array($sql)) :

                ?>


                   

                    <tr>
                        <td style="border-color:white">
                             <?php 
                        echo ucwords($row['itemName']);
                    ?>
                        </td>

                         <td style="border-color:white">
                             <?php 
                        echo $row['quantity'];
                    ?>
                        </td>

                    </tr>
                      <?php 
                     endwhile;
                        else:
                       echo '<p style="color:red; font-size: 20px;">No History</p>';
                        endif;
                        ?> 
                </tbody>
            </table>


 <div class="text-center">
        <ul class="pagination">
        <?php
         $sql="SELECT * FROM  inventory WHERE quantity <= 10";

         $run= mysqli_query($con,$sql);

         $count= mysqli_num_rows($run);

         $total_pages = ceil($count/$per_page);
         
  
        echo "<li><a href='report.php?page=1'>".'|<<'."</a> </a>"; 

        for($i=1;$i<=$total_pages;$i++)
             { 
               echo '<li><a href="report.php?page='.$i.'">'.$i.'</a></li>';
            
            }
        echo "<li><a href='report.php?page=$total_pages'>".'>>|'."</a> </li>";
        ?>
      </ul>
    </div>

    <script>    
    if(typeof window.history.pushState == 'function') {
        window.history.pushState({}, "Hide", '<?php echo $_SERVER['PHP_SELF'];?>');
    }
</script>