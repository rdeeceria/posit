<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                  <div class="card-header">
                    <h5 class="card-title">Edit Category</h5>
                  </div>

                  <div class="card-body">
                    <form action="<?= $action; ?>" method="post">
                    <?= csrf_field(); ?>
                      <div class="form-group">
                        <label for="">Name</label>
                        <input type="hidden" name="category_id" value="<?= esc($category_id); ?>">
                        <input type="text" class="form-control <?= ($validation->hasError('category_name')) ? 'is-invalid' : ''; ?>" \
                        name="category_name" placeholder="Enter category name" value="<?= esc($category_name); ?>" required >
                        <div class="invalid-feedback">
                          <?= $validation->getError('category_name'); ?>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="">Status</label>
                        <select name="category_status" id="" class="form-control" required>
                          <option value="">Choose Category</option>
                          <option <?= (esc($category_status) == 'Active') ? 'selected' : ''; ?> value="Active">Active</option>
                          <option <?= (esc($category_status) == 'Inactive') ? 'selected' : ''; ?> value="Inactive">Inactive</option>
                        </select>
                      </div>
                    </div>   
                    <div class="card-footer">
                        <button type="button" class="btn btn-secondary" onclick="window.location.href='<?php echo base_url('/category'); ?>'">Back</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                  </form>
                </div>

            </div>
        </div>
    </div>
</div>