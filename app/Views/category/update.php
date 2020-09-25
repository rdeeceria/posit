<?= $this->extend('partials/index') ?>
<?= $this->section('content') ?>
<div class="row">
<div class="col-lg-12">

<div class="card">
  <div class="card-header">
    <h5 class="card-title">Create Category</h5>
  </div>
  <div class="card-body">
  <?php echo form_open($action) ?>
    <div class="form-group">
      <label for="">Name</label>
      <?php
      $name = [
        'type' => 'text',
        'class' => $validation->hasError('category_name') ? 'form-control is-invalid' : 'form-control',
        'name' => 'category_name',
        'placeholder' => 'Enter category name',
        'minlength' => '3',
        'value' => old('category_name') == null ? $category_name : old('category_name'),
        'required' => 'required',
      ];
      echo form_input($name)
      ?>
      <div class="invalid-feedback">
      <?= $validation->getError('category_name'); ?>
      </div>
    </div>
    <div class="form-group">
      <label for="">Status</label>
      <select name="category_status" id="" class="custom-select" required>
        <option value="">Choose Category</option>
        <?php $status = old('category_status') == null ? esc($category_status) : old('category_status'); ?>
        <option <?= esc($status) == 'Active' ? 'selected' : ''; ?> value="Active">Active</option>
        <option <?= esc($status) == 'Inactive' ? 'selected' : ''; ?> value="Inactive">Inactive</option>
      </select>
    </div>  
  </div>  
  <div class="card-footer">
    <button type="button" class="btn btn-secondary" onclick="window.location.href='<?=esc($back); ?>'">Back</button>
    <button type="submit" class="btn btn-primary">Simpan</button>
  </div>
  <?php echo form_close() ?>
</div>

</div>
</div>
<?php
if(! empty(session()->getFlashdata('info'))) {
  $toast = [
  'class' => 'bg-info',
  'autohide' => 'true',
  'delay' => '5000',
  'title' => 'Update Category',
  'subtitle' => '',
  'body' => session()->getFlashdata('info'),
  'icon' => 'icon fas fa-edit',
  'image' => '',
  'imageAlt' => '',
  ];
  echo view('events/toasts', $toast);
}
?>
<?= $this->endSection() ?>