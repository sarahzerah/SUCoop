
                <h3 class="page-header">Share Capital List</h3>
           

       

            <?php
                include '../connect.php';
                $query = "SELECT * FROM user WHERE role='member' AND status='active' ORDER BY lastName ASC";
                $run= mysqli_query($con,$query);
            ?>
            
            <table class="table table-striped table-advance table-hover"  id="userTbl" width="100%">
                <tbody>
                    <tr>
                        <th style="text-align: left;font-size: 20px"><i class="icon_profile"></i>Full Name</th>
                        <th colspan="4"></th>
                    </tr>

                    <?php 
                     
                    ?>
                    <tr>
                      
                                <?php 
                                     while($row =mysqli_fetch_array($run)): 
                                    $id= $row['userID'];
             
                                    $query1= "SELECT * FROM member WHERE userID='$id' AND investment != 0";
                                    $run1= mysqli_query($con,$query1);
                                    $row1 =mysqli_fetch_array($run1); 
                                    if(mysqli_num_rows($run1) > 0):
                                    ?>
                                   
                                    <td  style="font-size: 20px; border-color: white">
                                     <?php echo ucwords($row['lastName'].", ".$row['firstName']." ".($row['middleName'][0]).".");?>
                                    </td>
                                    <td style="text-align: right; font-size: 20px; border-color: white">
                                    <?php  echo "Php ".formatMoney($row1['investment'], true);
                                    ?>
                        </td>
                    </tr>
                    
                    <?php 
                     
                        endif;
                    endwhile;?>
                </tbody>
            </table>
     
