<h1>Edit cuisine</h1>

<?php
$cuisine_name = '';
$description  = '';
$id           = 0;

if(!empty($results)) {
    $cuisine_name = $results->cuisine_name;
    $description  = $results->description;
    $id           = $results->cuisine_id;
}
?>

<?php echo form_open_multipart("articles/edit/$id"); ?>
<div class="form-group">
    <label for="cuisine_name">Cuisine Name</label>
    <input type="text" name="cuisine_name" class="form-control form-width" value="<?php echo set_value('cuisine_name', $cuisine_name); ?>" />
    <?php echo form_error('cuisine_name'); ?>
</div>

<div class="form-group">
    <label for="description">Description</label>
    <textarea name="description" class="form-control form-width textarea-height"><?php echo set_value('description', $description); ?></textarea>
    <?php echo form_error('description'); ?>
</div>

<?php if (!empty($results->image)): ?>
    <div class="form-group">
        <label>Current Image:</label><br>
        <img src="<?= base_url('uploads/thumbnails/' . $results->image); ?>" 
             alt="Current Image" class="img-thumbnail mb-2" style="width:200px;">
    </div>
<?php endif; ?>

<div class="form-group">
    <label for="image">Upload New Image (optional)</label>
    <input type="file" name="image" class="form-control">
</div>

<div class="form-group">
    <input type="submit" value="Submit" class="btn btn-primary my-4" />
</div>
</form>
