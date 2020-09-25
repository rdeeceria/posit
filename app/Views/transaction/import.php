<?= $this->extend('partials/index') ?>
<?= $this->section('content') ?>
<div class="row">
<div class="col-lg-12">

<div class="card">
<?php echo form_open_multipart($action) ?>
  <div class="card-header">
    <h5 class="card-title"><i class="fas fa-upload"></i> Import</h5>
    <div class="card-tools">
    <button type="button" class="btn btn-default btn-sm" data-card-widget="collapse"><i class="fas fa-minus"></i>
      </button>
    </div>
  </div>
  <div class="card-body">
    <div class="form-group">
      <label for="">Import Transaction File</label>
      <div class="custom-file">
        <?php $custom = $validation->hasError('trx_file') ? 'custom-file-label form-control is-invalid' : 'custom-file-label form-control' ?>
        <label class="<?= esc($custom) ?>" for="trx_file">Choose file</label>
        <?php
        $image = [
          'id' => 'trx_file',
          'class' => 'custom-file-input',
          'name' => 'trx_file',
          'accept' => '.xlx,.xlsx',
        ];
        echo form_upload($image);
        ?>
        <div class="invalid-feedback">
        <?= $validation->getError('trx_file'); ?>
        </div>
      </div>
    </div>
  </div>
  <div class="card-footer">
    <button type="button" class="btn btn-secondary" onclick="window.location.href='<?= esc($back) ?>'">Back</button>
    <button type="submit" class="btn btn-primary">Import</button>
  </div>
  <?php echo form_close() ?>
</div>

</div>
</div>
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
?>
<?= $this->endSection() ?>