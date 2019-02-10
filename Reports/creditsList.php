
  <h3 class="page-header">Credit List</h3>
           
            <?php
                include '../connect.php';
                $query = "SELECT * FROM user WHERE role='member' AND status='active' ORDER BY lastName ASC";
                $run= mysqli_query($con,$query);
            ?>
            
            <table class="table table-striped table-advance table-hover"  id="userTbl" width="100%" style=" font-size: 20px">
                 <?php
             ?>
                <tbody>
                    <tr>
                        <th style="text-align: left"><i class="icon_profile"></i>Full Name</th>
                        <th colspan="4"></th>
                    </tr>
            <?php if (mysqli_num_rows($run) != 0){ ?>
                    <?php 
                        while($row =mysqli_fetch_array($run)): 
                            $id= $row['userID'];
                    ?>
                    <tr>
                         <?php     
                                    $query1= "SELECT * FROM member WHERE userID='$id' AND creditBalance != 0";
                                    $run1= mysqli_query($con,$query1);
                                    $row1 =mysqli_fetch_array($run1); 
                        if(mysqli_num_rows($run1) > 0):
                         ?>

                         <td style="border-color:white">
                            <?php echo ucwords($row['lastName'].", ".$row['firstName']." ".($row['middleName'][0]).".");?>
                        </td>

                        <td style="text-align: right; border-color: white">
                            <?php     echo "Php ".formatMoney($row1['creditBalance'], true);
                                ?>
                        </td>
                    </tr>
                    
                    <?php //endwhile;?>

                      <?php 
                            endif;
                    endwhile;
                } else{
               
                       echo '<p style="color:red; font-size: 20px;">No Records Yet</p>';
                    }   ?>
                </tbody>
            </table>