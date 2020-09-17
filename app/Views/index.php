<!DOCTYPE html>
<html lang="en">
<head>
  <?php echo view('_partials/head'); ?>
</head>
<body class="hold-transition sidebar-mini">

<div class="wrapper">  

  <?php echo view('_partials/nav'); ?>
  <?php echo view('_partials/sidebar'); ?>

  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><?= esc($title); ?></h1>
          </div>
          <div class="col-sm-6">
            <?php echo view('_partials/breadcrumbs'); ?>
          </div>
        </div>
      </div>
    </div>
    <?php echo view($content, $data); ?>
  </div>
  <?php echo view('_partials/footer'); ?>

</div>
<?php echo view('_partials/script'); ?>
</body>
</html>