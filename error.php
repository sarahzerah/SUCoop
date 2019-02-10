<?php
 if (isset($_GET['error'])) {?>
<div class="alert alert-danger alert-dismissable">
<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button><h4><?php echo htmlentities($_GET['error']); ?> </h4>
</div>
<?php }elseif(isset($_GET['success'])) {?>
<div class="alert alert-success alert-dismissable">
<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
<h4><?php echo htmlentities($_GET['success']); ?>   </h4>
</div>
<?php  }?>