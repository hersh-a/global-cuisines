<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=
    , initial-scale=1.0">
    <title>
      <?php 
        if(APP_NAME){$title = APP_NAME;
          }
          if(isset($heading)){
          $title = $title . " - " . $heading;
          }
          echo $title; 
      ?>
    </title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js" integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous"></script>
    <link href="<?php echo base_url(); ?>css/styles.css" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <script type="text/javascript">
      $(document).ready(function(){
      // fade #message if exists
        if($('#message').length){
        $( "#message" ).delay(3000).fadeOut({}, 3000);
        }
      });
    </script>
</head>
<body>
   <nav class="nav navbar navbar-expand-lg bg-warning">
      <div class="container-fluid">
        <a class="navbar-brand" href="<?php echo base_url()?>"> <i class="material-icons">home</i></a>
        <a class="navbar-brand" href="<?php echo base_url()?>"> <h1 class="me-4">Global Cuisine</h1> </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav">
            <div class="ms-auto d-flex align-items-center gap-2">
             <?php if ($this->ion_auth->logged_in()) : ?>
              <?php
                  $user = $this->ion_auth->user()->row();
                  $username = $user->username;
              ?>

              <div class="dropdown">
                  <button class="btn btn-warning btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                      Logged in as <strong><?php echo $username; ?></strong>
                  </button>

                  <ul class="dropdown-menu dropdown-menu-end">
                      <li><a class="dropdown-item" href="<?php echo base_url('articles/write'); ?>">Write an Article</a></li>
                      <li><a class="dropdown-item" href="<?php echo base_url('auth/change_password'); ?>">Change Password</a></li>
                      <li><a class="dropdown-item text-danger" href="<?php echo base_url('auth/logout'); ?>">Logout</a></li>
                  </ul>
              </div>

              <?php else: ?>

                  <a href="<?php echo base_url('auth/login'); ?>" class="btn btn-primary btn-sm me-2">Login</a>

              <?php endif; ?>

            </div>
          </ul>
        </div>
      </div>
    </nav>
  <div class="container"> 
    <?php $message = $this->session->userdata('message'); ?>
      <?php if(isset($message)): ?>
        <h3 class="alert alert-primary" id="message"> <i class="material-icons">thumb_up</i> <?php echo $message ?></h3>
      <?php endif; ?>
    <?php $this->session->unset_userdata('message'); ?>