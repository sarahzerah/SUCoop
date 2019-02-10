
<div class="row">
    <div class="col-lg-8">
        <form class="form-validate form-horizontal " method="POST" action="transactions.php">

            <div class="form-group ">
                     <div class="col-lg-8">
                     <div class="input-group">
                        <span class="input-group-addon success" >Search</span>
                  <input type='text' class="form-control" 
                      id='project' placeholder="Search Member"  required=""/>
              
                    </div>
                   </div>
                </div>
            <img style="height:80;width:80px;" id="project-icon" alt="" /> 
            <input type='hidden' id='project-id' name="member"  /><br /><br />
            <section class="panel">
                <header class="panel-heading"><h4><b>Savings</b></h4></header>
                    <div class="panel-body">

                        <div class="form">
                            <?php if(isset($_GET['error'])) : ?>
                            <div class="alert alert-danger" style="margin: 10px; padding-left: 100px; width: 500px; margin: 0 auto;">
                                <a href="#" class="close" data-dismiss="alert">&times;</a>
                                <?php echo htmlentities($_GET['error']); ?>   
                            </div>
                            
                            <?php 
                                else:
                                    echo '';
                                endif;
                            ?><br />

                            
                             
                             <div class="form-group ">
                                  <label for="type" class="control-label col-lg-3">Type:<span class="required">*</span></label>
                                  <div class="col-lg-6">
                                    <select class="form-control m-bot15" name="type">
                                      <option value="deposit">Deposit</option>
                                      <option value="withdraw">Withdraw</option>
                                  </select>
                              </div>
                            </div>

                            <div class="form-group ">
                                <!-- <input type="hidden" name="member" value="<?php //echo $member; ?>  " /> -->
                                <label for="amount" class="control-label col-lg-3">Cash Received: <span class="required">*</span></label>
                                <div class="col-lg-6">
                                    <input class=" form-control" name="amount" type="number" required="" />
                                </div> 
                            </div>
                        </div>
                    </section>
                  </div>
              </div>

               <div class="row">
                  <div class="col-lg-8">
                      <section class="panel">
                          <div class="panel-body">
                              <div class="form-group">
                                  <div class="col-lg-offset-2 col-lg-6">
                                      <input class="btn btn-primary" type="submit" name="savings" value="Save">
                                      <a href="cashTransaction.php" class="btn btn-default" type="button">Cancel</a>
                                  </div>
                              </div>
                          </form>
                      </div>
                  </section>
              </div>
          </div>
