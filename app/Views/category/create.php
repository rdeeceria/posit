<?php
echo view('_partials/header');
echo view('_partials/sidebar'); 

$inputs = session()->getFlashdata('inputs');
$errors = session()->getFlashdata('errors');
?>
 
<title><?= esc($title); ?></title>

<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark"><?= esc($title); ?></h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <?php foreach($bread as $segment) { echo $segment; } ?>
          </ol>
        </div>
      </div>
    </div>
  </div>
 
  <div class="content">
    <div class="container-fluid">
      <div class="row">
          <div class="col-md-12">
            <form action="<?= $action; ?>" method="post">
              <div class="card">
                <div class="card-body">
                  <?php csrf_field();
                  if(!empty($errors)) { ?>
                  <div class="alert alert-danger" role="alert">
                    Whoops! Ada kesalahan saat input data, yaitu:
                    <ul>
                    <?php foreach ($errors as $error) : ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach ?>
                    </ul>
                  </div>
                  <?php } ?>
 
                  <div class="form-group">
                      <label for="">Name</label>
                      <input type="text" class="form-control" name="category_name" placeholder="Enter category name" value="<?php echo $inputs['category_name']; ?>" required >
                  </div>
                  <div class="form-group">
                      <label for="">Status</label>
                      <select name="category_status" id="" class="form-control" required>
                          <option value="">Pilih Kategori</option>
                          <option <?php echo $inputs['category_status'] == "Active" ? "selected" : ""; ?> value="Active">Active</option>
                          <option <?php echo $inputs['category_status'] == "Inactive" ? "selected" : ""; ?> value="Inactive">Inactive</option>
                      </select>
                  </div>
                </div>
                <div class="card-footer">
                    <a href="<?php echo base_url('category'); ?>" class="btn btn-outline-info">Back</a>
                    <button type="submit" class="btn btn-primary float-right">Simpan</button>
                </div>
              </div>
            </form>
          </div>
      </div>
    </div>
  </div>
</div>
<?php echo view('_partials/footer'); ?>