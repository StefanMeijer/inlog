<?php
//Check if user is trying to escape GET methode
if (!isset($_GET["page"])) {
    echo 'Use website as expected.';
    exit;
}
?>
<div class="header">
<h2>Login</h2>
</div>
<form method="post" action="">

	<div class="input-group">
		<label>Username</label>
		<input type="text" name="username">
	</div>
	<div class="input-group">
		<label>Password</label>
		<input type="password" name="password">
	</div>
	<div class="input-group">
		<button type="submit" class="btn" name="login_btn">Login</button>
	</div>
	<?php
	//	Display Error
	echo display_error();
	?>
	<p>
		Not yet a member? <a href="index.php?page=register">Sign up</a>
	</p>
</form>