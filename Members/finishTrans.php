
<style>
.modal-dialog {
  padding-top: -20%
   overflow: visible;
     margin-left: 50%;
}
</style>

<div class="modal fade" id="finish" id="modal-dialog">
<div class="modal-dialog modal-lg">
   <div class="modal-content">
      <div class="modal-header">
          <!-- <button type="button" class="close" data-dismiss="modal">&times;<button> button you can click to exit the modal -->
            <h3 class="modal-title">Complete Transaction</h3>
      </div>
          <div class="modal-body">
             <form class="form-horizontal "  method="POST" action="finish.php">               
                <div>
                  <label class="control-label col-lg-12" class="control-label col-lg-2" style="text-align: left; font-size:24px">Save your changes or discard them?
                  </label>
                </div>
                   <div class="modal-footer">
                      <button class="btn btn-primary" name="discard" type="submit">Discard</button> 
                      <button class="btn btn-primary" name="save" type="submit">Save</button> 
                  </div>
              </form>
        </div>
    </div>
</div>
</div> 