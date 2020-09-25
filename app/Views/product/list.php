<?= $this->extend('partials/index') ?>
<?= $this->section('content') ?>
<div class="row">
<div class="col-lg-12">

<div class="card bg-gradient-primary collapsed-card">
  <div class="card-header">
    <h5 class="card-title"><i class="fas fa-search"></i> Filter Product</h5>
    <div class="card-tools" style="width: 50%">
      <div class="input-group input-group-sm">
        <?php echo form_dropdown('category', $categories, $category, ['class' => 'custom-select', 'id' => 'category']) ?>
        <?php
        $form_keyword = [
            'type'  => 'text',
            'class' => 'form-control',
            'name'  => 'keyword',
            'id'    => 'keyword',
            'value' => $keyword,
            'placeholder' => 'Enter keyword ...'
        ];
        echo form_input($form_keyword);
        ?>
        <div class="input-group-append">
          <button class="btn btn btn-secondary" id="filterSubmit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="card">
  <div class="card-header">
    <h5 class="card-title"><i class="fas fa-cart-plus"></i> List Product</h5>
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
          <th style="width: 10%">PIC</th>
          <th style="width: 20%">Product</th>
          <th style="width: 10%">Category</th>
          <th style="width: 20%">Price</th>
          <th style="width: 10%">Status</th>
          <th style="width: 20%">Action</th>
        </tr>
      </thead>
      <tbody>
      <?php if(empty($list)) : ?>
      <tr><td colspan="8"><h3>Belum ada data</h3><p>Silahkan menambahkan data terlebih dahulu.</p></td></tr>      
      <?php else : ?>
      <?php foreach($list as $k => $v) : ?>
      <?= esc($v['product_status'] == 'Inactive') ? '<tr style="background-color: #80808020;">' : '<tr>' ?>
        <td><?= esc(++$k); ?></td>
          <?php 
            $def = site_url('uploads/product/') . 'default.png';
            $val = site_url('uploads/product/') . $v['product_image'];
            $imgscr = $v['product_image'] == 'default.png' ? $def : $val; 
          ?>
        <td><img src="<?= esc($imgscr) ?>" class="rounded" width="50" height="50"></td>
        <td>
          <h6><?= esc($v['product_sku']) ?></h6>
          <small><?= esc($v['product_name']) ?></small>
        </td>
        <td class="">
          <?php $sts = $v['category_status'] == 'Inactive' ? 'badge badge-danger' : 'badge badge-primary' ; ?>
          <span class="<?= esc($sts) ?>"><?= esc($v['category_name']) ?></span>
        </td>
        <td><?= esc($v['product_price']) ?></td>
        <td><?= esc($v['product_status']) ?></td>
        <td>
        <div class="btn-group">
          <button type="button" class="btn btn-primary btn-sm" title="<?= esc($v['product_name']) ?>" onclick="window.location.href='<?= esc($read . $v['product_id']) ?>'">
          <i class="fa fa-eye"></i> View</button>
          <button type="button" class="btn btn-info btn-sm" title="<?= esc($v['product_name']) ?>" onclick="window.location.href='<?= esc($update . $v['product_id']) ?>'">
          <i class="fa fa-edit"></i> Edit</button>
          <button type="button" class="btn btn-warning btn-sm" title="<?= esc($v['product_name']); ?>" data-toggle="modal" data-target="#modal_<?= esc($k) ?>">
          <i class="fa fa-trash-alt"></i> Delete</button>
        </div>
        <?php
          $modals = [
            'id' => 'modal_'.esc($k),
            'size' => 'modal-sm',
            'class' => 'bg-warning',
            'title' => 'Delete Product',
            'bodytext' => 'Anda Yakin Ingin Menghapus Kategori '.$v['product_name'],
            'action' => esc($delete . $v['product_id']),
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
  <div class="card-footer clearfix">
    <div class="pagination pagination-md m-0 float-right">
      <?= $pager->links('product', 'bootstrap-pager') ?>
    </div>
  </div>
</div>

</div>
</div>
<?php 
if(! empty(session()->getFlashdata('warning'))) {
  $toast = [
  'class' => 'bg-warning',
  'autohide' => 'true',
  'delay' => '10000',
  'title' => 'Delete Product',
  'subtitle' => '',
  'body' => session()->getFlashdata('warning'),
  'icon' => 'icon fas fa-trash-alt',
  'image' => '',
  'imageAlt' => '',
  ];
  echo view('events/toasts', $toast);
}
?>
<script>
document.addEventListener('DOMContentLoaded', function() {

  let filter = function() {
    var category = $("#category").val();
    var keyword = $("#keyword").val();
    window.location.replace("/product?category="+ category +"&keyword="+ keyword);
  }

  $("#filterSubmit").click(function() {
    filter();
  });

  $("#category").change(function() {
    filter();
  });

  $("#keyword").keypress(function(event) {
    if(event.keyCode == 13) { // 13 adalah kode enter
      filter();
    }
  });

});
</script>
<?= $this->endSection() ?>