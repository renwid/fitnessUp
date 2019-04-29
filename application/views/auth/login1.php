<canvas class='connecting-dots'></canvas>

<div class="container" id="container">

  <!-- Sign Up -->
	<div class="form-container sign-up-container">

    <!-- Warning -->
		<form action="<?= base_url('auth/registration'); ?>" class="user" method="post">
			<h1>Create Account</h1>
			<div class="social-container">
				<a href="https://www.facebook.com/" class="social"><i class="fab fa-facebook-f"></i></a>
				<a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
				<a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
			</div>
			<span>or register here</span>

      <!-- Full Name -->
      <input type="text" class="form-control form-control-user" id="name" name="name" placeholder="Full name" value="<?= set_value('name'); ?>">
      <?= form_error('name'); ?>

      <!-- Email -->
      <input type="text" class="form-control form-control-user" id="email" name="email" placeholder="Email Address" value="<?= set_value('email'); ?>">
      <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>

      <!-- Password -->
      <input type="password" class="form-control form-control-user" id="password1" name="password1" placeholder="Password">
      <?= form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>

      <!-- Password 1 -->
      <input type="password" class="form-control form-control-user" id="password2" name="password2" placeholder="Repeat Password">



			<button id="registerButton" type="submit" name="register" value="Register">Sign Up</button>
		</form>
	</div>



  <!-- Sign In -->
	<div class="form-container sign-in-container">
    <?= $this->session->flashdata('message'); ?>
    <!-- <div class="alert">Account activation failed! Wrong token.</div> -->
		<form class="user"  action="<?= base_url('auth'); ?>" method="post">
			<h1>Sign in</h1>
			<div class="social-container">
				<a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
				<a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
				<a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
			</div>
			<span>or use your account</span>
      <input type="text" class="form-control form-control-user" id="email" name="email" placeholder="Enter Email Address..." value=<?= set_value('email') ?>>
      <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>

      <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password">
      <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>

			<a href="#">Forgot your password?</a>
			<button type="submit" name="login" value="Login">Sign In</button>
		</form>
	</div>


	<div class="overlay-container">
		<div class="overlay">
			<div class="overlay-panel overlay-left">
				<h1>Welcome Back!</h1>
				<p>To keep connected with us please login with your personal info</p>
				<button class="ghost" id="signIn">Sign In</button>
			</div>
			<div class="overlay-panel overlay-right">
				<h1>Hello, Friend!</h1>
				<p>Enter your personal details and start journey with us</p>
				<button class="ghost" id="signUp">Sign Up</button>
			</div>
		</div>
	</div>
</div>
