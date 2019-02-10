 <div class="modal fade" id="edit<?php $tr; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                <!--Select the product to be restocked-->
                <?php
                    $trans=mysqli_query($con,"SELECT * FROM transaction WHERE transactionNum='{$_SESSION['transactionNum']}'");
                    $transqry=mysqli_fetch_array($trans);
                ?>

                <center><h3 class="modal-title" id="myModalLabel">Edit Amount</h3></center>
            </div>
            
            <div class="modal-body" ">                
                <div class="container-fluid">
                    <form method="POST" action="editAmount.php">
                        <input type="hidden" name="transactionNum"  value="<?php echo $transqry['transactionNum']; ?>" />
                        
                        <!--Quantity-->
                        <div style="height:10px;"></div>
                        <div class="row">
                            <div class="col-lg-2" >
                                <label style="position:relative; top:7px; color: black;">Amount: </label>
                            </div>

                            <div class="col-lg-10">
                                <input type="number" id="txt3" name="amount" class=" form-control" value="<?php echo $transqry['quantity']; ?>" min="1"  />
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
