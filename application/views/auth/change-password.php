<canvas class='connecting-dots'></canvas>

<div class="container" id="container" style="height:40%; width:25%">




  <!-- Forgot Password -->
    <?= $this->session->flashdata('message'); ?>
    <!-- <div class="alert">Account activation failed! Wrong token.</div> -->
		<form class="user"  action="<?= base_url('auth/changepassword'); ?>" method="post">

			<h1 style="font-size:20px; margin-top:-40px">Change Your Password for</h1>
      <h5><?= $this->session->userdata('reset_email'); ?></h5>

      <input style=" margin-top:90px" type="password" class="form-control form-control-user" id="password1" name="password1" placeholder="Enter New Password">
      <?= form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>

      <input style="" type="password" class="form-control form-control-user" id="password2" name="password2" placeholder="Re-enter Password">
      <?= form_error('password2', '<small class="text-danger pl-3">', '</small>'); ?>

      <button style=" margin-top:70px" type="submit" name="login" value="Login">Change Password</button>


		</form>
