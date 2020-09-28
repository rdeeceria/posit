<?= $this->extend('partials/index') ?>
<?= $this->section('content') ?>
<div class="row">
<div class="col-lg-12">

<div class="card card-primary card-outline">
  <div class="card-body box-profile">
    <div class="text-center">
      <img class="profile-user-img img-fluid img-circle"
            src="<?= site_url('uploads/product/') . $v['product_image'] ?>"
            alt="User profile picture">
    </div>

    <h3 class="profile-username text-center"><?= $v['product_name'] ?></h3>

    <p class="text-muted text-center"><?= $v['product_sku'] ?></p>

    <ul class="list-group list-group-unbordered mb-3">
      <li class="list-group-item">
        <b>Category</b> <a class="float-right"><?= $v['category_name'] ?></a>
      </li>
      <li class="list-group-item">
        <b>Transactions</b> <a class="float-right"><?= $v['transaction_count'] ?></a>
      </li>
      <li class="list-group-item">
        <b>Omzet</b> <a class="float-right"><?= "Rp. ".number_format($v['omzet']) ?></a>
      </li>
    </ul>

    <a href="/product" class="btn btn-primary btn-block"><b>Okay</b></a>
  </div>
  <!-- /.card-body -->
</div>
<!-- /.card -->

</div>
</div>
<?= $this->endSection() ?>