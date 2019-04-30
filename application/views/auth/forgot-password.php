<canvas class='connecting-dots'></canvas>

<div class="container" id="container" style="height:40%; width:25%">




  <!-- Forgot Password -->
    <?= $this->session->flashdata('message'); ?>
    <!-- <div class="alert">Account activation failed! Wrong token.</div> -->
		<form class="user"  action="<?= base_url('auth/forgotpassword'); ?>" method="post">

			<h1 style="font-size:20px; margin-top:-40px">Forgot Password</h1>

      <input style=" margin-top:90px" type="text" class="form-control form-control-user" id="email" name="email" placeholder="Enter Email Address..." value=<?= set_value('email') ?>>
      <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>

      <!-- <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password">
      <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?> -->
      
      <button style=" margin-top:70px" type="submit" name="login" value="Login">Reset Password</button>

      <a href="<?= base_url('auth') ?>">&#x2190; Back to Login</a>
		</form>
