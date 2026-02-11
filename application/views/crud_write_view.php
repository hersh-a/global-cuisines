<h1>New cuisine</h1>
<?php echo form_open_multipart('articles/write'); ?>
    <div class="form-group">
    <label for="cuisine_name">Cuisine Name</label>
    <input type="text" name="cuisine_name" class="form-control form-width" value="<?php echo
    set_value('cuisine_name'); ?>" />
    <?php echo form_error('cuisine_name'); ?>
    </div>
    
    <div class="form-group">
    <label for="description">Description</label>
    <textarea name="description" class="form-control form-width textarea-height"><?php echo
    set_value('description'); ?></textarea>
    <?php echo form_error('description'); ?>
    </div>

    <div class="form-group">
        <label for="image">Upload Image</label>
        <input type="file" name="image" class="form-control form-width">
    </div>

    <div class="form-group"><input type="submit" value="Submit" class="btn btn-primary my-4" /></div>
</form>