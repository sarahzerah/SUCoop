<table class="table table-striped table-advance table-hover"  id="userTbl" style="color: black">
  <tbody>
    <tr>
      <th>Date</th>
      <th colspan="4"></th>
    </tr>
      <?php
      $d2="";
     if(mysqli_num_rows($prun) > 0){
      while( $prow=mysqli_fetch_array  ($prun)){
      $dateR = $prow['dateOrdered']; 
          
        if (empty($d2)){ ?>
    <tr>
          <td style="border-color:white">
            <?php    echo formatDate($dateR); ?>
          </td>
          <td style="border-color:white">           
            <a class="btn btn-primary" href="purchaseOrder.php?id=<?php echo $id;?>&dateRd=<?php echo $dateR;?>">View </a>
          </td>
    </tr>
        <?php } else {
          if ($dateR != $d2){  ?>
    <tr>
          <td style="border-color:white">
            <?php   echo formatDate($dateR); ?>
          </td>
          <td style="border-color:white">           
            <a class="btn btn-primary" href="purchaseOrder.php?id=<?php echo $id;?>&dateRd=<?php echo $dateR;?>">View </a>
          </td>
    </tr>
          <?php } 
        }
        $d2 = $dateR;
        

      }
    }else{
            echo "<h3 style='color:red;'> No Records </h3>";
    }
?>
  </tbody>
</table>