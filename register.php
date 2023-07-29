<?php
//session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>REGISTER</title>

	<!-- bootstrap 5 CDN-->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

	<!-- bootstrap 5 Js bundle CDN-->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ"
		crossorigin="anonymous"></script>

</head>

<body>
	<div class="d-flex justify-content-center align-items-center" style="min-height: 100vh;">
		<form class="p-5 rounded shadow" style="max-width: 30rem; width: 100%" method="POST" action="php/add-user.php">

			<h1 class="text-center display-4 pb-5">Register</h1>
			
			<?php if (isset($eem)) { ?>
					<div class="alert alert-danger" role="alert">
					<?= htmlspecialchars($eem); ?>
					</div>
				<?php } ?>

			<?php if (isset($_GET['error'])) { ?>
					<div class="alert alert-danger" role="alert">
						<?= htmlspecialchars($_GET['error']); ?>
					</div>
				<?php } ?>

			<?php if (isset($msg)) { ?>
				<div class="alert alert-success" role="alert">
					<?= htmlspecialchars($msg); ?>
				</div>
			<?php } ?>
			<?php if (isset($rc)) { ?>
				<div class="alert alert-info" role="alert">
					<?= htmlspecialchars($rc); ?>
				</div>
			<?php } ?>

			<div class="mb-3">
				<label for="full_name" class="form-label">Full Name</label>
				<input type="text" class="form-control" name="full_name" id="full_name">
			</div>

			<div class="mb-3">
				<label for="exampleInputEmail1" class="form-label">Email address</label>
				<input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp">
			</div>

			<div class="mb-3">
				<label for="exampleInputPassword1" class="form-label">Password</label>
				<input type="password" class="form-control" name="password" id="password">
			</div>

			<div class="mb-3">
				<label for="password2" class="form-label">Confirm Password</label>
				<input type="password" class="form-control" name="password2" id="password2">
			</div>

			<div class="modal-footer">

				<button type="submit" class="btn btn-primary">
					Register</button>
			</div>

			<div class="modal-footer">
			<p>Already have an account? <a href="login.php">Login</a></p>
			</div>

		</form>
	</div>
</body>

</html>