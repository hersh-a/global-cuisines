<div class="container my-5">
    <div class="row align-items-center">
    
        <h1><?php echo $heading?></h1>
            <?php 
                // get current logged-in user ID
                $current_user_id = $this->ion_auth->user()->row()->id ?? null;
                ?>

                <?php if($cuisine): ?>
                
                <h3><?php echo $cuisine->cuisine_name ?></h3>
            <div class="col-md-5">
                <?php if ($cuisine->image): ?>
                        <div class="article-image">
                            <img src="<?php echo base_url('uploads/' . $cuisine->image); ?>" 
                                alt="<?php echo $cuisine->cuisine_name; ?>" 
                                class="img-fluid">
                        </div>
                <?php endif; ?>
            </div>
            <div class="col-md-5 text-left">
                <p><?php echo $this->typography->nl2br_except_pre($cuisine->description); ?></p>
                <p><strong>Author:</strong> <?php echo $cuisine->username; ?>
                <strong>Created on:</strong> 
                    <?php 
                        echo date('F j, Y, g:i a', strtotime($cuisine->created_at));
                    ?>

            </div>              
        
    </div>
</div>
<?php if ($this->ion_auth->logged_in() && ($cuisine->author_id == $current_user_id || $this->ion_auth->is_admin())): ?>
    <a href="<?php echo base_url() ."articles/edit/" .$cuisine->cuisine_id;?>" class="btn btn-primary btn-sm my-4">
        <i class="material-icons">edit</i>Edit
    </a>

    <a href="<?php echo base_url() ."articles/delete/" .$cuisine->cuisine_id;?>" class="btn btn-danger btn-sm my-4">
        <i class="material-icons">delete</i>Delete
    </a>
<?php endif; ?>

<?php else: ?>
<p>No results</p>
<?php endif; ?>
