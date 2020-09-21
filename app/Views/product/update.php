<?= $this->extend('partials/index') ?>
<?= $this->section('content') ?>
<div class="row">
<div class="col-lg-12">

<div class="card">
  <div class="card-header">
    <h5 class="card-title">Update Product</h5>
  </div>
  <div class="card-body">
  <?php echo form_open_multipart($action) ?>

    <div class="form-group">
      <label for="">Name</label>
      <?php
      $name = [
        'class' => $validation->hasError('product_name') ? 'form-control is-invalid' : 'form-control',
        'name' => 'product_name',
        'minlength' => '3',
        'placeholder' => 'Enter product name',
        'value' => old('product_name') == null ? esc($v['product_name']) : old('product_name'),
        'required' => ''
      ];
      echo form_input($name);
      ?>
      <div class="invalid-feedback">
      <?= $validation->getError('product_name'); ?>
      </div>
    </div>
    <div class="form-group">
    <label for="">Category</label>
      <?php
      $selected = old('category_id') == null ? esc($v['category_id']) : old('category_id');
      $param =[
        'class' => 'custom-select',
        'required' => '',
      ];
      echo form_dropdown('category_id', $categories, $selected, $param);
      ?>
    </div>
    <div class="form-group">
    <label for="">SKU</label>
      <?php
      $sku = [
        'class' => $validation->hasError('product_sku') ? 'form-control is-invalid' : 'form-control',
        'name' => 'product_sku',
        'minlength' => '3',
        'placeholder' => 'Enter product SKU',
        'value' => old('product_sku') == null ? esc($v['product_sku']) : old('product_sku'),
        'required' => ''
      ];
      echo form_input($sku);
      ?>
      <div class="invalid-feedback">
      <?= $validation->getError('product_sku'); ?>
      </div>
    </div>
    <div class="form-group">
    <label for="">Price</label>
      <?php
      $price = [
        'class' => $validation->hasError('product_price') ? 'form-control is-invalid' : 'form-control',
        'name' => 'product_price',
        'minlength' => '3',
        'placeholder' => 'Enter product price',
        'value' => old('product_price') == null ? esc($v['product_price']) : old('product_price'),
        'required' => ''
      ];
      echo form_input($price);
      ?>
      <div class="invalid-feedback">
      <?= $validation->getError('product_price'); ?>
      </div>
    </div>
    <div class="form-group">
    <label for="">Image</label>
      <?php 
      $scr = $v['product_image'] == 'default.png' ? site_url('uploads/') : site_url('uploads/product/'); 
      $img = $v['product_image'] == 'default.png' ? 'default.png' : $v['product_image'];
      ?>
      <div class="form-group">
        <div class="col-md-2">
          <img src= <?= esc($scr . $img) ?> alt="Thumbnail" class="img-thumbnail">
        </div>
      </div>
      <div class="custom-file">
        <?php
        $label = [
          'class' => $validation->hasError('product_image') ? 'custom-file-label form-control is-invalid' : 'custom-file-label form-control',
        ];
        echo form_label($img, 'product_image', $label);
        ?>
        <?php
        $image = [
          'id' => 'product_image',
          'class' => 'custom-file-input',
          'name' => 'product_image',
          'accept' => '.jpg,.jpeg,.png,.gif',
          'onchange' => 'thumbnail()',
        ];
        echo form_upload($image);
        ?>
        <div class="invalid-feedback">
        <?= $validation->getError('product_image'); ?>
        </div>
      </div>
    </div>
    <div class="form-group">
    <label for="">Description</label>
      <?php
      $description = [
        'class' => 'form-control',
        'name' => 'product_description',
        'minlength' => '1',
        'placeholder' => 'Enter product description',
        'value' => old('product_description') == null ? esc($v['product_description']) : old('product_description'),
        'required' => ''
      ];
      echo form_textarea($description);
      ?>
    </div>
    <div class="form-group">
      <label for="">Status</label>
      <select name="product_status" class="custom-select" required>
        <option value="">Choose Status</option>
        <?php $status = old('product_status') == null ? esc($v['product_status']) : old('product_status'); ?>
        <option <?= esc($status) == 'Active' ? 'selected' : ''; ?> value="Active">Active</option>
        <option <?= esc($status) == 'Inactive' ? 'selected' : ''; ?> value="Inactive">Inactive</option>
      </select>
    </div>
  </div>   
  <div class="card-footer">
    <button type="button" class="btn btn-secondary" onclick="window.location.href='<?= esc($back); ?>'">Back</button>
    <button type="submit" class="btn btn-primary">Simpan</button>
  </div>
  <?php echo form_close() ?>
</div>

</div>
</div>

<script>
function thumbnail() {

  const image = document.querySelector('#product_image');
  const imageLabel = document.querySelector('.custom-file-label');
  const imageThumbnail = document.querySelector('.img-thumbnail');

  imageLabel.textContent = image.files[0].name;

  const imageFile = new FileReader();
  imageFile.readAsDataURL(image.files[0]);

  imageFile.onload = function(e) {
    imageThumbnail.src = e.target.result;
  }
}
</script>
<?= $this->endSection() ?>