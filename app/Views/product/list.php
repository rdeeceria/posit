<?php 
if(! empty(session()->getFlashdata('success'))) {
  $toast = [
  'class' => 'bg-success',
  'autohide' => 'true',
  'delay' => '5000',
  'title' => 'Create Product',
  'subtitle' => '',
  'body' => session()->getFlashdata('success'),
  'icon' => 'icon fas fa-file-alt',
  'image' => '',
  'imageAlt' => '',
  ];
  echo view('events/toasts', $toast);
}

if(! empty(session()->getFlashdata('info'))) {
  $toast = [
  'class' => 'bg-info',
  'autohide' => 'true',
  'delay' => '5000',
  'title' => 'Update Product',
  'subtitle' => '',
  'body' => session()->getFlashdata('info'),
  'icon' => 'icon fas fa-edit',
  'image' => '',
  'imageAlt' => '',
  ];
  echo view('events/toasts', $toast);
}

if(! empty(session()->getFlashdata('warning'))) {
  $toast = [
  'class' => 'bg-warning',
  'autohide' => 'true',
  'delay' => '10000',
  'title' => 'Delete Product',
  'subtitle' => '',
  'body' => session()->getFlashdata('warning'),
  'icon' => 'icon fas fa-trash-alt',
  'image' => '',
  'imageAlt' => '',
  ];
  echo view('events/toasts', $toast);
}
?>

<div class="content">
<div class="container-fluid">
<div class="row">
<div class="col-lg-12">

<div class="card">
  <div class="card-header">
    <h5 class="card-title"><i class="fas fa-cart-plus"></i> List Product</h5>
    <div class="card-tools">
      <button type="button" class="btn btn-success btn-sm" onclick="window.location.href='<?= esc($create) ?>'"><i class="fas fa-file-alt"></i> Tambah
      </button>
      <button type="button" class="btn btn-default btn-sm" data-card-widget="collapse"><i class="fas fa-minus"></i>
      </button>
    </div>
  </div>
  <div class="card-body p-0">
    <div class="table-responsive">
      <table class="table projects">
      <thead>
        <tr>
          <th style="width: 10%">No</th>
          <th style="width: 20%">Thumbnail</th>
          <th>SKU</th>
          <th>Name</th>
          <th>Category</th>
          <th>Status</th>
          <th style="width: 10%">Action</th>
        </tr>
      </thead>
      <tbody>
      <?php foreach($list as $k => $v): ?>
      <?= esc($v['product_status'] == 'Inactive') ? '<tr style="background-color: #80808020;">' : '<tr>' ?>
        <td><?= esc(++$k); ?></td>
        <td><img src="<?php echo base_url('uploads/'.$v['product_image']) ?>" class="rounded-circle" width="50" height="50"></td>
        <td><?= esc($v['product_sku']) ?></td>
        <td><?= esc($v['product_name']) ?></td>
        <td><?= esc($v['category_name']) ?></td>
        <td><?= esc($v['product_price']) ?></td>
        <td><?= esc($v['product_status']) ?></td>
        <td>
        <div class="btn-group">
          <button type="button" class="btn btn-primary btn-sm" title="<?= esc($v['product_name']) ?>" onclick="window.location.href='<?= esc($update . $v['product_id']) ?>'">
          <i class="fa fa-eye"></i> View</button>
          <button type="button" class="btn btn-info btn-sm" title="<?= esc($v['product_name']) ?>" onclick="window.location.href='<?= esc($update . $v['product_id']) ?>'">
          <i class="fa fa-edit"></i> Edit</button>
          <button type="button" class="btn btn-warning btn-sm" title="<?= esc($v['product_name']); ?>" data-toggle="modal" data-target="#modal_<?= esc($k) ?>">
          <i class="fa fa-trash-alt"></i> Delete</button>
        </div>
        <?php
          $modals = [
            'id' => 'modal_'.esc($k),
            'size' => 'modal-sm',
            'class' => 'bg-warning',
            'title' => 'Delete Product',
            'bodytext' => 'Anda Yakin Ingin Menghapus Kategori '.$v['product_name'],
            'action' => esc($delete . $v['product_id']),
            ];
          echo view('events/modals', $modals);
        ?>
        </td>
      </tr>
      <?php endforeach; ?>
      </tbody>
      </table>
    </div>
  </div>
</div>

</div>
</div>
</div>
</div>
</div>