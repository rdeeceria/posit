<div class="content">
<div class="container-fluid">
<div class="row">
<div class="col-lg-12">

<div class="card">
  <div class="card-header">
    <h5 class="card-title">Create Product</h5>
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
        'value' => old('product_name'),
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
      $selected = old('category_id') == null ? '' : old('category_id');
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
        'value' => old('product_sku'),
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
        'value' => old('product_price'),
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
      <div class="custom-file">
      <label class="<?= $validation->hasError('product_image') ? 'custom-file-label form-control is-invalid' : 'custom-file-label form-control' ?>" for="customFile">Choose file</label>
        <?php
        $image = [
          'id' => 'customFile',
          'class' => 'custom-file-input',
          'name' => 'product_image',
          'accept' => '.jpg,.jpeg,.png,.gif'
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
        'value' => old('product_description'),
        'required' => ''
      ];
      echo form_textarea($description);
      ?>
    </div>
    <div class="form-group">
      <label for="">Status</label>
      <select name="product_status" class="form-control" required>
        <option value="">Choose Status</option>
        <option <?= old('product_status') == 'Active' ? 'selected' : ''; ?> value="Active">Active</option>
        <option <?= old('product_status') == 'Inactive' ? 'selected' : ''; ?> value="Inactive">Inactive</option>
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
</div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
  $(".custom-file-input").on("change", function() {
    var fileName = $(this).val().split("\\").pop();
    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
  });
});
</script>