<h3><b>Members who Almost or Already Reached their Credit Limit</b></h3><br>

<table class="table table-striped table-advance table-hover" id="userTbl" style=" font-size: 20px">
                <tbody>
                    <tr>
                        <th><i class="icon_profile"></i>Full Name</th>
                        <th colspan="4" style="text-align: center">Credit Limit</th>
                        <th colspan="4" style="text-align: center">Credit Balance</th>
<?php 

        $resul = "SELECT * FROM member where creditBalance >= creditLimit-500 AND creditBalance != 0 AND status='active' AND creditLimit!=0";
                $sql2= mysqli_query($con,$resul);
                if(mysqli_num_rows($sql2) > 0): 
                while ($row= mysqli_fetch_array($sql2)) :
                    $mem=$row['userID'];
                    $id=$row['memberID'];

                    $resul2 = "SELECT * FROM user where userID='$mem'";
                    $sql3= mysqli_query($con,$resul2);
                    $row3= mysqli_fetch_array($sql3);

            
                    ?>
                    </tr>
                        <tr>
                            <td>
                                 <?php 
                            echo ucwords($row3['lastName'].", ".$row3['firstName']." ".($row3['middleName'][0]).".");
                        ?>
                            </td>

                             <td colspan="4" style="text-align: center">
                                 <?php 
                            echo $row['creditLimit'];
                        ?>
                            </td>
                            <td colspan="4" style="text-align: center">
                                 <?php 
                            echo $row['creditBalance'];
                        ?>
                            </td>

                        </tr>
                        
                    <?php 
                     endwhile;
                 else:
                    echo '<p style="color:red; font-size: 20px;">No Records Yet</p>';
                        endif;
                        ?>
                </tbody>
            </table>
     <script>
            $(document).ready(function(){
                $('.search').on('keyup',function(){
                    var searchTerm = $(this).val().toLowerCase();
                    $('#userTbl tbody tr').each(function(){
                        var lineStr = $(this).text().toLowerCase();
                        if(lineStr.indexOf(searchTerm) === -1){
                            $(this).hide();
                        }else{
                            $(this).show();
                        }
                    });
                });
            });
        </script>