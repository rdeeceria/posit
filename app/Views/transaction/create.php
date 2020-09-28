<?= $this->extend('partials/index') ?>
<?= $this->section('content') ?>
<div class="row">
<div class="col-lg-12">

<div class="card">
  <div class="card-header">
    <h5 class="card-title">Create Transaction</h5>
  </div>
  <div class="card-body">
    <?php echo form_open($action) ?>
    <div class="form-group">
      <label for="">Product</label>
      <?php
      $selected = old('product_id') == null ? '' : old('product_id');
      echo form_dropdown('product_id', $products, $selected, ['class' => 'custom-select', 'required' => '']);
      ?>
    </div>
    <div class="form-group">
      <label for="">QTY</label>
      <?php
      $qty = [
        'type' => 'number',
        'class' => $validation->hasError('trx_qty') ? 'form-control is-invalid' : 'form-control',
        'name' => 'trx_qty',
        'minlength' => '1',
        'placeholder' => 'Enter Quantity',
        'value' => old('trx_qty'),
        'required' => ''
      ];
      echo form_input($qty);
      ?>
      <div class="invalid-feedback">
      <?= $validation->getError('trx_qty') ?>
      </div>
    </div>
    <input type="hidden" name="trx_date" value="<?php echo date('Y-m-d', time()) ?>">
  </div> 
  <div class="card-footer">
    <button type="button" class="btn btn-secondary" onclick="window.location.href='<?= esc($back) ?>'">Back</button>
    <button type="submit" class="btn btn-primary">Simpan</button>
  </div>
  <?php echo form_close() ?>
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
  'title' => 'Create Category',
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