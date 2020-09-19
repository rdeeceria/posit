<!DOCTYPE html>
<html lang="en">
<head>
<?= $this->include('partials/head') ?>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">  
  <?= $this->include('partials/nav') ?>
  <?= $this->include('partials/sidebar') ?>
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><?= esc($subtitle) ?></h1>
          </div>
          <div class="col-sm-6">
            <?= $this->include('partials/breadcrumbs') ?>
          </div>
        </div>
      </div>
    </div>
    <div class="content">
      <div class="container-fluid">
      <?= $this->renderSection('content') ?>
      </div>
    </div>
  </div>
  <?= $this->include('partials/footer') ?>
</div>
<?= $this->include('partials/script') ?>
</body>
</html>