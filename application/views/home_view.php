<div class="container my-5">
  <div class="row align-items-center">
    <!-- Left column: Paragraph -->
    <div class="col-md-6">
      <h2>Welcome!</h2>
      <p>
        Discover the diverse flavors and culinary traditions of the world. 
        From vibrant street foods to time-honored family recipes, each article explores the rich history, signature dishes, 
        and cultural stories behind different cuisines. Whether you're a curious learner or a passionate food lover, 
        you'll find inspiration and insight into the meals that bring people together across every continent. 
        Start exploring and enjoy your journey through the world's most iconic flavors.
      </p>
    </div>

    <!-- Right column: Image -->
    <div class="col-md-6 text-center">
      <img src="<?php echo base_url('img/cuisines/global-cuisine.png'); ?>" 
           alt="Global Cuisine" 
           class="img-fluid rounded"
           style="max-width:100%; height:auto;">
    </div>
  </div>

  <!-- Cards Row -->
  <div class="row mt-4 align-items-start"> 
    <?php if($results) : ?>
      <?php foreach($results as $row): ?>
        <div class="col-md-2 mb-4 d-flex"> 
          <div class="card h-100" style="max-width: 200px; margin:auto;"> 

            <?php if (!empty($row->image)): ?>
                <img src="<?= base_url('uploads/thumbnails/' . $row->image); ?>" 
                     alt="Cuisine Image"
                     class="card-img-top d-block mx-auto"
                     style="width:auto; height:auto; max-width:150px;">
            <?php endif; ?>

            <div class="card-body text-center">
              <h5><?php echo $row->cuisine_name; ?></h5>
              <p>
                  <?php
                      $truncated = substr($row->description, 0, 50);
                      echo htmlspecialchars($truncated) . (strlen($row->description) > 50 ? '...' : '');
                  ?>
              </p>
              <a href="<?php echo base_url('articles/detail/'.$row->cuisine_id); ?>" class="btn btn-success btn-sm">
                  Read More
              </a>
            </div>

          </div>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
        <p>No results</p>
    <?php endif; ?>
  </div>
</div>


