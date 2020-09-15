<!DOCTYPE html>
<html lang="en">
<head>
    <?php echo view('_partials/head'); ?>
</head>
<body class="hold-transition sidebar-mini sidebar-collapse">
    <?php echo view('_partials/nav'); ?>
    <?php echo view('_partials/sidebar'); ?>

<div class="wrapper">
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark"><?= esc($title); ?></h1>
                    </div>
                    <div class="col-sm-6">
                        <?php echo view('_partials/breadcrumbs'); ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="m-0">Sales Graph</h5>
                            </div>
                            <div class="card-body">
                                <p>Halaman sales graph</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="m-0">Latest Transaction</h5>
                            </div>
                            <div class="card-body">
                                <p>Halaman latest transaction</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo view('_partials/footer'); ?>
<?php echo view('_partials/script'); ?>
</body>
</html>