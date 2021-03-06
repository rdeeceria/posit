<?= $this->extend('partials/index') ?>
<?= $this->section('content') ?>
<div class="row">
<div class="col-lg-12">

<div class="card bg-gradient-primary">
  
</div>

<div class="card">
  <div class="card-header">
    <h5 class="card-title"><i class="fas fa-tags"></i> List Transaction</h5>
    <div class="card-tools">
      <button type="button" class="btn btn-success btn-sm" onclick="window.location.href='<?= esc($create) ?>'"><i class="fas fa-file-alt"></i> Tambah
      </button>
      <button type="button" title="Upload" class="btn btn-default btn-sm" onclick="window.location.href='<?= esc($import) ?>'"><i class="fas fa-upload"></i></button>
      <button type="button" title="Download" class="btn btn-default btn-sm" onclick="window.location.href='<?= esc($export) ?>'"><i class="fas fa-download"></i></button>
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
          <th style="width: 20%">Name</th>
          <th style="width: 10%">QTY</th>
          <th style="width: 10%">Date</th>
          <th style="width: 20%">Price</th>
          <th style="width: 10%">Action</th>
        </tr>
      </thead>
      <tbody>
      <?php if(empty($list)) : ?>
      <tr><td colspan="6"><h3>Belum ada data</h3><p>Silahkan menambahkan data terlebih dahulu.</p></td></tr>      
      <?php else : ?>
      <?php foreach($list as $k => $v) : ?>
      <tr>
        <td><?= ++$k ?></td>
        <td><h6><?= $v['product_name'] ?></h6></td>
        <td><h6><?= esc($v['trx_qty']) ?></h6></td>
        <td><?= date('d-m-Y', strtotime($v['trx_date'])) ?></td>
        <td><?= "Rp. ".number_format($v['trx_price']) ?></td>
        <td>
        <div class="btn-group">
          <button type="button" class="btn btn-info btn-sm" title="<?= esc($v['product_name']) ?>" onclick="window.location.href='<?= esc($update . $v['trx_id']) ?>'">
          <i class="fa fa-edit"></i> Edit</button>
          <button type="button" class="btn btn-warning btn-sm" title="<?= esc($v['product_name']) ?>" data-toggle="modal" data-target="#modal_<?= esc($k) ?>">
          <i class="fa fa-trash-alt"></i> Delete</button>
        </div>
        <?php
          $modals = [
            'id' => 'modal_'.$k,
            'size' => 'modal-sm',
            'class' => 'bg-warning',
            'title' => 'Delete Transaction',
            'bodytext' => 'Anda Yakin Ingin Menghapus Transaction '.$v['product_name'],
            'action' => esc($delete . $v['trx_id']),
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
if(! empty(session()->getFlashdata('success'))) {
  $toast = [
  'class' => 'bg-success',
  'autohide' => 'true',
  'delay' => '5000',
  'title' => 'Import Transaction',
  'subtitle' => '',
  'body' => session()->getFlashdata('success'),
  'icon' => 'icon fas fa-file-alt',
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
  'title' => 'Delete Transaction',
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