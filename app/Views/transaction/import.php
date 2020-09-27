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
      <label for="">Tata Cara Import Dari Excel</label>
      <div>
        <img src="/uploads/sampleImport.png" alt="Thumbnail" class="img-fluid">
      </div>
    </div>
    <div class="form-group">
      <label for="">Import Transaction File</label>
      <div class="custom-file">
        <?php $custom = $validation->hasError('trx_file') ? 'custom-file-label form-control is-invalid' : 'custom-file-label form-control' ?>
        <label class="<?= esc($custom) ?>" for="trx_file">Choose file</label>
        <?php
        $import = [
          'id' => 'trx_file',
          'class' => 'custom-file-input',
          'name' => 'trx_file',
          'accept' => '.xlx,.xlsx',
          'onchange' => 'filename()',
        ];
        echo form_upload($import);
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
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
function filename() {

  const file = document.querySelector('#trx_file');
  const fileLabel = document.querySelector('.custom-file-label');

  fileLabel.textContent = file.files[0].name;
}
</script>
<?= $this->endSection() ?>