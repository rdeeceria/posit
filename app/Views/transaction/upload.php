<?= $this->extend('partials/index') ?>
<?= $this->section('content') ?>
<div class="row">
<div class="col-lg-12">

<div class="card">
<?php echo form_open($action) ?>
  <div class="card-header">
    <h5 class="card-title"><i class="fas fa-upload"></i> <?= $filename ?></h5>
    <div class="card-tools">
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
          <th style="width: 30%">Name</th>
          <th style="width: 10%">QTY</th>
          <th style="width: 20%">Date</th>
          <th style="width: 30%">Price</th>
        </tr>
      </thead>
      <tbody>
      <?php if(empty($list)) : ?>
      <tr><td colspan="5"><h3>Belum ada data</h3><p>Silahkan menambahkan data terlebih dahulu.</p></td></tr>      
      <?php else : ?>
      <?php foreach($list as $k => $v) : ?>
      <tr>
        <td><?= ++$k ?></td>
        <td><h6><?= $v['product_name'] ?></h6></td>
        <td><h6><?= $v['trx_qty'] ?></h6></td>
        <td><?= date('d-m-Y', strtotime($v['trx_date'])) ?></td>
        <td><?= "Rp. ".number_format($v['trx_price']) ?></td>
        <input type="hidden" name="product_id[<?= esc($k) ?>]" value="<?= esc($v['product_id']) ?>" >
        <input type="hidden" name="trx_qty[<?= esc($k) ?>]" value="<?= esc($v['trx_qty']) ?>">
        <input type="hidden" name="trx_date[<?= esc($k) ?>]" value="<?= esc($v['trx_date']) ?>">
        <input type="hidden" name="trx_price[<?= esc($k) ?>]" value="<?= esc($v['trx_price']) ?>">
      </tr>
      <?php endforeach ?>
      <?php endif ?>
      </tbody>
      </table>
    </div>
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