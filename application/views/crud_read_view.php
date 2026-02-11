<h1><?php echo $heading; ?></h1>

<?php if($results) : ?>
    <?php foreach($results as $row): ?>
        <div class="well">
            <h3><?php echo $row->cuisine_name; ?></h3>
            <p>
                <a href="<?php echo base_url('articles/detail/'.$row->cuisine_id); ?>" class="btn btn-primary">
                    View Details
                </a>
            </p>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <p>No results</p>
<?php endif; ?>
