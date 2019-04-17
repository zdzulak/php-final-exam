<?php
$page_title = null;
$page_title = 'Login';
require_once('header.php'); ?>

<main class="container">
	<h1>Log In</h1>
	<form method="post" action="validate.php">
		<fieldset class="form-group">
			<label for="email" class="col-sm-2">Email:</label>
			<input name="email" required type="email" />
		</fieldset>
		<fieldset class="form-group">
			<label for="password" class="col-sm-2">Password:</label>
			<input name="password" required type="password" />
		</fieldset>
		<button type="submit" class="col-sm-offset-2 btn btn-success">Log In</button>
	</form>
</main>

<?php require_once('footer.php'); ?>
