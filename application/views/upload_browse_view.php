<h1>Uploaded Image</h1>
<p><a href="<?php echo base_url() ?>uploadimages/uploadimage" class="btn btn-primary btn-sm me-2">Upload New Image</a></p>
    <?php
    $files1 = scandir("uploads/thumbnails/");
    //print_r($files1);
    foreach ($files1 as $value) {
    $file = base_url(). "uploads/thumbnails/". $value;
    // if(str_contains($value, ".jpg")){ // just a way to make sure that this is an image filename. only jpg's please
    // echo "<img src=\"$file\" style=\"margin:10px\">";
    // }

    $ext = strtolower(pathinfo($value, PATHINFO_EXTENSION));
    if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif'])) {
        echo "<img src=\"$file\" style=\"margin:10px; max-width:150px; max-height:150px;\">";
    }
    }
    ?>

