<h1>Upload Image</h1>
<?php
if(isset($error)){
echo $error;
}
?>
<?php echo form_open_multipart('uploadimages/uploadimage'); ?>
<!-- in this example, we are incorporating another form field (validated) just to show how its done. The title is not
saved anywhere. IIn an actual app, you will save all this info in your DB -->
<div class="form-group">
<label for="title">Title</label>
<input type="text" name="title" class="form-control form-width" value="<?php echo set_value('title');
?>">
<?php echo form_error('title'); ?>
</div>
<div class="form-group">
<label for="picture">Picture</label>
<input type="file" name="userfile" class="form-control form-width" value="<?php echo
set_value('userfile'); ?>">
<?php echo form_error('userfile'); ?>
<!-- in CI3, this file input MUST be called userfile by default. Else, you have to refer to it in your controller
code. -->
</div>
<div class="form-group"><input type="submit" value="Submit" class="btn"></div>
</form>