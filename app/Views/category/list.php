<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title"><i class="fas fa-tags"></i> List Category</h5>
                        <div class="card-tools">
                            <button type="button" class="btn btn-primary btn-sm" onclick="window.location.href='<?php echo base_url('category/create'); ?>'"><i class="fas fa-file-alt"></i> Tambah
                            </button>
                            <button type="button" class="btn btn-primary btn-sm" data-card-widget="collapse"><i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>

                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table projects">
                                <thead>
                                    <tr>
                                        <th style="width: 10%">No</th>
                                        <th style="width: 50%">Name</th>
                                        <th style="width: 20%">Status</th>
                                        <th style="width: 20%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($categories as $key => $row): ?>
                                    <?php echo $row['category_status'] == 'Inactive' ? '<tr style="background-color: #80808020;">' : '<tr>';?>
                                        <td><?= esc($key) + 1; ?></td>
                                        <td><?= esc($row['category_name']); ?></td>
                                        <td><?= esc($row['category_status']); ?></td>
                                        <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-primary btn-sm" 
                                            title="Edit <?= esc($row['category_name']); ?>" 
                                            onclick="window.location.href='<?php echo base_url('category/update/'.$row['category_id']); ?>'">
                                            <i class="fa fa-edit"></i></button>
                                            <button type="button" class="btn btn-danger btn-sm" 
                                            title="Delete <?= esc($row['category_name']); ?>" 
                                            data-toggle="modal" data-target="#modal_<?= esc($key) ?>">
                                            <i class="fa fa-trash-alt"></i></button>
                                        </div>
                                        <?php
                                        $modals = [
                                            'id' => 'modal_'.esc($key),
                                            'size' => 'modal-sm',
                                            'class' => 'bg-danger',
                                            'title' => 'Delete Category',
                                            'bodytext' => 'Anda Yakin Ingin Menghapus Kategori '.$row['category_name'],
                                            'action' => base_url('/category/delete/'.$row['category_id']),
                                        ];
                                        echo view('events/modals', $modals);
                                        ?>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<?php if(! empty(session()->getFlashdata('create'))): ?>
    <?php 
    $toast = [
        'class' => 'bg-success',
        'autohide' => 'true',
        'delay' => '5000',
        'title' => 'Create Category',
        'subtitle' => '',
        'body' => session()->getFlashdata('create'),
        'icon' => 'icon fas fa-file-alt',
        'image' => '',
        'imageAlt' => '',
    ];
    echo view('events/toasts', $toast);
    ?>
<?php endif; ?>

<?php if(! empty(session()->getFlashdata('update'))): ?>
    <?php 
    $toast = [
        'class' => 'bg-info',
        'autohide' => 'true',
        'delay' => '5000',
        'title' => 'Update Category',
        'subtitle' => '',
        'body' => session()->getFlashdata('update'),
        'icon' => 'icon fas fa-edit',
        'image' => '',
        'imageAlt' => '',
    ];
    echo view('events/toasts', $toast); 
    ?>
<?php endif; ?>

<?php if(! empty(session()->getFlashdata('delete'))): ?>
    <?php 
    $toast = [
        'class' => 'bg-warning',
        'autohide' => 'true',
        'delay' => '10000',
        'title' => 'Delete Category',
        'subtitle' => '',
        'body' => session()->getFlashdata('delete'),
        'icon' => 'icon fas fa-trash-alt',
        'image' => '',
        'imageAlt' => '',
    ];
    echo view('events/toasts', $toast);
    ?>
<?php endif; ?>