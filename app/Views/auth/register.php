<!DOCTYPE html>
<html lang="en">
<head>
<?= $this->include('partials/head') ?>
</head>
<body>
<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <a href="/"><b>POSIT</b></a>
    </div>
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">Register to create your account</p>

        <?php echo form_open($action) ?>
        <div class="input-group mb-3">
          <?php
            $username = [
              'type'  => 'text',
              'class' => $validation->hasError('username') ? 'form-control is-invalid' : 'form-control',
              'name'  => 'username',
              'value' => old('username') == null ? '' : old('username'),
              'placeholder' => 'Username'
            ];
            echo form_input($username); 
          ?>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
          <div class="invalid-feedback">
          <?= $validation->getError('username') ?>
          </div>
        </div><?php echo form_open($action) ?>
        <div class="input-group mb-3">
          <?php
            $name = [
              'type'  => 'text',
              'class' => $validation->hasError('name') ? 'form-control is-invalid' : 'form-control',
              'name'  => 'name',
              'value' => old('name') == null ? '' : old('name'),
              'placeholder' => 'Enter Your Name'
            ];
            echo form_input($name); 
          ?>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
          <div class="invalid-feedback">
          <?= $validation->getError('name') ?>
          </div>
        </div>
        <div class="input-group mb-3">
          <?php
          $email = [
            'type'  => 'email',
            'class' => $validation->hasError('email') ? 'form-control is-invalid' : 'form-control',
            'name'  => 'email',
            'value' => old('email') == null ? '' : old('email'),
            'placeholder' => 'Enter Your Email'
          ];
          echo form_input($email); 
          ?>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
          <div class="invalid-feedback">
          <?= $validation->getError('email') ?>
          </div>
        </div>
        <div class="input-group mb-3">
          <?php
          $password = [
            'type'  => 'password',
            'class' => $validation->hasError('password') ? 'form-control is-invalid' : 'form-control',
            'name'  => 'password',
            'value' => '',
            'placeholder' => 'Password'
          ];
          echo form_input($password); 
          ?>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
          <div class="invalid-feedback">
          <?= $validation->getError('password') ?>
          </div>
        </div>
        <div class="input-group mb-3">
          <?php
          $confirm_password = [
            'type'  => 'password',
            'class' => $validation->hasError('confirm_password') ? 'form-control is-invalid' : 'form-control',
            'name'  => 'confirm_password',
            'value' => '',
            'placeholder' => 'Retype Password'
          ];
          echo form_input($confirm_password); 
          ?>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
          <div class="invalid-feedback">
          <?= $validation->getError('confirm_password') ?>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <p class="mb-0">
              <a href="<?= esc($cancel) ?>" class="text-center">Cancel</a>
            </p>
          </div>
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
          </div>
        </div>
        <?php echo form_close() ?>

      </div>
    </div>
  </div>
<?= $this->include('partials/script') ?>
</body>
</html>