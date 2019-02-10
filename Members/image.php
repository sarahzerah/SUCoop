<link rel="stylesheet" href="ui/style.css"/>
<div class="user-box">
  <div class="img-relative">
    <div class="overlay uploadProcess" style="display: none;"><!-- Loading image -->
      <div class="overlay-content"><img src="img/loading.gif"/></div>
    </div>
<!-- Hidden upload form -->
    <form method="POST" action="upload.php" enctype="multipart/form-data" id="picUploadForm" target="uploadTarget">
        <input type="hidden" name="id" value="<?php echo $_SESSION['user'];?>" />
        <input type="file" name="picture" id="fileInput"  style="display:none" accept=".jpg, .jpeg, .png" />
    </form>
    <iframe id="uploadTarget" name="uploadTarget" src="#" style="width:0;height:0;border:0px solid #fff;"></iframe>
<!-- Profile image -->
        <img src="images/<?php echo $picture; ?>" id="imagePreview"  alt=""  >
        <a class="editLink" href="javascript:void(0);">
        <b> Update Image</b></a>
    </div>
</div>
<!-- Image update link -->