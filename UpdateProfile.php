<?php
session_start();
# Database Connection File
include "db_connection.php";
$db = mysqli_connect($sName, $uName, $pass, $db_name) or die("Could not connect database");

# If the user is logged in
if (
	isset($_SESSION['user_id']) &&
	isset($_SESSION['user_email'])
) {
	if (isset($_POST['submit'])) {
		$full_name = $_POST['full_name'];
		$user_email = $_POST['email'];
		$resetCode = $_POST['resetCode'];

		$query = mysqli_query($db, "UPDATE users SET full_name='$full_name', email='$user_email', resetCode='$resetCode' WHERE email='" . $_SESSION['user_email'] . "'");
		if ($query) {
			$smx = "Profile successfully updated!";
		} else {
			$emx = "Profile not updated!";
		}
	}
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

			<?php $query = mysqli_query($db, "SELECT * FROM users WHERE email='" . $_SESSION['user_email'] . "'");
			while ($row = mysqli_fetch_array($query)) { ?>

				<form name="profile" class="p-5 rounded shadow" style="max-width: 30rem; width: 100%" method="post">

					<h1 class="text-center display-4 pb-5">Update Profile</h1>
					<?php if (isset($smx)) { ?>
                                <div class="alert alert-success" role="alert">
                                    <?= htmlspecialchars($smx); ?>
                                </div>
                            <?php } ?>

                            <?php if (isset($emx)) { ?>
                                <div class="alert alert-danger" role="alert">
                                    <?= htmlspecialchars($emx); ?>
                                </div>
                            <?php } ?>
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
						<input type="text" name="full_name" required="required"
							value="<?php echo htmlentities($row['full_name']); ?>" class="form-control">
					</div>

					<div class="mb-3">
						<label for="email" class="form-label">Email address</label>
						<input type="email" name="email" required="required" value="<?php echo htmlentities($row['email']); ?>"
							class="form-control" readonly>

					</div>

					<div class="mb-3">
						<label for="resetCode" class="form-label">Reset Code</label>
						<input type="text" name="resetCode" required="required"
							value="<?php echo htmlentities($row['resetCode']); ?>" class="form-control"><br>
					</div>

					<div class="modal-footer">

						<button type="submit" name="submit" class="btn btn-primary">Update</button>

					</div>

					<div class="modal-footer">
						<a href="index.php">Back</a>
					</div>

				</form>
			<?php } ?>

		</div>
	</body>

	</html>
	<?php
} else {
	header("Location: login.php");
	exit;
}
?>