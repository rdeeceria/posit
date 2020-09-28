<?= $this->extend('partials/index') ?>
<?= $this->section('content') ?>
<div class="row">
<div class="col-lg-12">

<div class="card">
  <div class="card-header">
    <h5 class="card-title"><i class="fas fa-tags"></i> List Category</h5>
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
          <th style="width: 30%">Name</th>
          <th style="width: 20%">Product</th>
          <th style="width: 20%">Status</th>
          <th style="width: 20%">Action</th>
        </tr>
      </thead>
      <tbody>
      <?php if(empty($list)) : ?>
      <tr><td colspan="5"><h3>Belum ada data</h3><p>Silahkan menambahkan data terlebih dahulu.</p></td></tr>      
      <?php else : ?>
      <?php foreach($list as $k => $v) : ?>
      <?= $v['category_status'] == 'Inactive' ? '<tr style="background-color: #80808020;">' : '<tr>' ?>
        <td><?= ++$k ?></td>
        <td><h6><?= $v['category_name'] ?></h6></td>
        <td><?= $v['product_count'] ?></td>
        <td><?= $v['category_status'] ?></td>
        <td>
        <div class="btn-group">
          <button type="button" class="btn btn-info btn-sm" title="<?= esc($v['category_name']) ?>" onclick="window.location.href='<?= esc($update . $v['category_id']) ?>'">
          <i class="fa fa-edit"></i> Edit</button>
          <button type="button" class="btn btn-warning btn-sm" title="<?= esc($v['category_name']) ?>" data-toggle="modal" data-target="#modal_<?= esc($k) ?>">
          <i class="fa fa-trash-alt"></i> Delete</button>
        </div>
        <?php
          $modals = [
            'id' => 'modal_'.$k,
            'size' => 'modal-sm',
            'class' => 'bg-warning',
            'title' => 'Delete Category',
            'bodytext' => 'Anda Yakin Ingin Menghapus Kategori '.$v['category_name'],
            'action' => esc($delete . $v['category_id']),
            ];
          echo view('events/modals', $modals);
        ?>
        </td>
      </tr>
      <?php endforeach ?>
      <?php endif ?>
      </tbody>
      </table>
    </div>
  </div>
</div>

</div>
</div>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<?php 
if(! empty(session()->getFlashdata('warning'))) {
  $toast = [
  'class' => 'bg-warning',
  'autohide' => 'true',
  'delay' => '10000',
  'title' => 'Delete Category',
  'subtitle' => '',
  'body' => session()->getFlashdata('warning'),
  'icon' => 'icon fas fa-trash-alt',
  'image' => '',
  'imageAlt' => '',
  ];
  echo view('events/toasts', $toast);
}
?>
<?= $this->endSection() ?>