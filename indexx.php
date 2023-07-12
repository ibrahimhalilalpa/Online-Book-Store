<?php
session_start();

# Database Connection File
include "db_connection.php";



# Book helper function
include "php/func-book.php";
$books = get_all_books($conn);

# author helper function
include "php/func-author.php";
$authors = get_all_author($conn);

# Category helper function
include "php/func-category.php";
$categories = get_all_categories($conn);

# Language helper function
include "php/func-language.php";
$languages = get_all_languages($conn);

# user helper function
include "php/func-user.php";
$users = get_all_users($conn);
//print_r($users);

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Book Store</title>

	<!-- bootstrap 5 CDN-->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

	<!-- bootstrap 5 Js bundle CDN-->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ"
		crossorigin="anonymous"></script>

	<link rel="stylesheet" href="./css/style.css">

	<link rel="stylesheet" href="./css/according.css">
	<script type="module" src="javascript/according.js"></script>
	<script src="javascript/javascript.js"></script>


</head>

<body>



	<div class="container1">

		<nav class="navbar navbar-expand-lg bg-body-tertiary">
			<div class="container-fluid">
				<a class="navbar-brand" href="index.php">Online Book Store</a>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse"
					data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
					aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav me-auto mb-2 mb-lg-0">

						<li class="nav-item">
							<a class="nav-link active" aria-current="page" href="index.php">Store</a>
						</li>

						<li class="nav-item">
							<a class="nav-link active" aria-current="page" href="">About</a>
						</li>

						<li class="nav-item">
							<a class="nav-link" href="#">Stars</a>
						</li>



</ul>
					<ul>
					<li>
					<h5 style="color:white;">
						<?php
						// Kullanıcının giriş yaptığı kontrol ediliyor
						if (isset($_SESSION['user_id']) && isset($_SESSION['user_email'])) {
							// Kullanıcının adını yazdırma
						
							$full_name = $_SESSION['full_name'];

							if (isset($_SESSION['rank']) && $_SESSION['rank'] == 0) {
								$messages = [
									"Hello, $full_name! Today is going to be a great day!",
									"Welcome, $full_name! Good to see you here!",
									"Hey, $full_name! Welcome to our site! We wish you a pleasant browsing!",
									"$full_name, welcome! We hope you have a good time on our site!"
								];
								$random_message = $messages[array_rand($messages)];
								echo $random_message;
							} else {
								echo "Admin";

							}

						} else {
							// Kullanıcı giriş yapmamışsa giriş formunu göster
							// ...
							echo "GUEST";

						}
						?>
					</h5>
					</li>
					
					<li class="nav-item">
						<?php if (isset($_SESSION['user_id'])) {
							// Kullanıcının oturum açtığı durum
							if ($_SESSION['rank'] == 0) {
								// Rank değeri 0 ise Logout bağlantısını görüntüle
								?>
								<a class="nav-link" href="logaut.php">Logout</a>

							<?php } else {
								// Rank değeri 0'dan farklı ise Admin bağlantısını görüntüle
								?>
								<a class="nav-link" href="admin.php">Admin Panel</a>
							<?php }
						} else {
							// Kullanıcının oturum açmadığı durum
							?>
						<a class="nav-link" href="login.php">Login</a>
						<?php
						} ?>
					</li>
					</ul>

				</div>
			</div>
		</nav>



		<form action="search.php" method="get" style="width: 100%; max-width: 50rem">

			<div class="input-group my-5">
				<input type="text" class="form-control" name="key" placeholder="Search Book..."
					aria-label="Search Book..." aria-describedby="basic-addon2">

				<button class="input-group-text
						 btn btn-primary" id="basic-addon2">
					<img src="img/search.png" width="20">
				</button>
			</div>
		</form>

		<div>

			<button class="accordion">
				<h3>Star of the Week</h3>
			</button>
			<div class="panel">
				<?php
				$query = mysqli_query($db, "select full_name, SUM(downloading_count) + SUM(reading_count) AS 'Total' from users GROUP BY full_name order by Total desc limit 1;");
				while ($row = mysqli_fetch_array($query)) {
					?>
					<p>
						<?php echo htmlentities($row['full_name']); ?><span> <b>(
								<?php echo htmlentities($row['Total']); ?>)</span></b>
					</p>
				<?php } ?>

			</div>


			<button class="accordion">
				<h4>Top book downloaders of the week</h4>
			</button>
			<div class="panel">
				<?php
				$query = mysqli_query($db, "select full_name,downloading_count from users order by downloading_count desc  limit 3;");
				while ($row = mysqli_fetch_array($query)) {
					?>
					<p>
						<?php echo htmlentities($row['full_name']); ?><span> <b>(
								<?php echo htmlentities($row['downloading_count']); ?>)</span></b>
					</p>
				<?php } ?>

			</div>



			<button class="accordion">
				<h4>Top book readers of the week</h4>
			</button>
			<div class="panel">
				<?php
				$query = mysqli_query($db, "select full_name,reading_count from users order by reading_count desc  limit 3;");
				while ($row = mysqli_fetch_array($query)) {
					?>
					<p>
						<?php echo htmlentities($row['full_name']); ?><span> <b>(
								<?php echo htmlentities($row['reading_count']); ?>)</span></b>
					</p>
				<?php } ?>

			</div>
		</div>


		<div class="d-flex pt-5">
			<?php if ($books == 0) { ?>
				<div class="alert alert-warning 
						text-center p-5" role="alert">
					<img src="img/empty.png" width="100">
					<br>
					There is no book in the database
				</div>
			<?php } else { ?>

				<div class="pdf-list d-flex flex-wrap">
					<?php foreach ($books as $book) { ?>
						<div class="card m-1">
							<div class="img-box">
								<img src="uploads/cover/<?= $book['cover'] ?>" class="card-img-top">
							</div>
							<div class="card-body">
								<div class="book-title">
									<h5 claass="card-title">
										<?= $book['title'] ?>
									</h5>
								</div>

								<p class="card-text">
									<i><b>By:
											<?php foreach ($authors as $author) {
												if ($author['id'] == $book['author_id']) {
													echo $author['name'];
													break;
												}
												?>

											<?php } ?>
											<br>
										</b></i>
									<?= $book['description'] ?>
									<br><i><b>Category:
											<?php foreach ($categories as $category) {
												if ($category['id'] == $book['category_id']) {
													echo $category['name'];
													break;
												}
												?>

											<?php } ?>
											<br>
										</b></i>
									<br><i><b>Language:
											<?php foreach ($languages as $language) {
												if ($language['id'] == $book['language_id']) {
													echo $language['name'];
													break;
												}
												?>

											<?php } ?>
											<br>
										</b></i>
								</p>
								<a href="uploads/files/<?= $book['file'] ?>" class="btn btn-success">Open</a>

								<a id="downloadBook" href="uploads/files/<?= $book['file'] ?>" class="btn btn-primary"
									download="<?= $book['title'] ?>">Download</a>
							</div>
						</div>
					<?php } ?>
				</div>
			<?php } ?>



			<div class="category" style="width:250px">

				<!-- List of languages -->
				<div class="list-group" style="width: 250px; text-align: left;">
					<?php if ($languages == 0) {
					// do nothing
				} else { ?>
						<a href="#" class="list-group-item list-group-item-action active">Language</a>
						<?php foreach ($languages as $language) { ?>

							<a href="language.php?id=<?= $language['id'] ?>" class="list-group-item list-group-item-action">
								<?= $language['name'] ?></a>
						<?php }
				} ?>
				</div>

				<!-- List of categories -->
				<div class="list-group mt-5" style="width: 250px; text-align: left;">
					<?php if ($categories == 0) {
					// do nothing
				} else { ?>
						<a href="#" class="list-group-item list-group-item-action active">Category</a>
						<?php foreach ($categories as $category) { ?>

							<a href="category.php?id=<?= $category['id'] ?>" class="list-group-item list-group-item-action">
								<?= $category['name'] ?></a>
						<?php }
				} ?>
				</div>

				<!-- List of authors -->
				<div class="list-group mt-5" style="width: 250px; text-align: left;">
					<?php if ($authors == 0) {
					// do nothing
				} else { ?>
						<a href="#" class="list-group-item list-group-item-action active">Author</a>
						<?php foreach ($authors as $author) { ?>

							<a href="author.php?id=<?= $author['id'] ?>" class="list-group-item list-group-item-action">
								<?= $author['name'] ?></a>
						<?php }
				} ?>
				</div>

			</div>

		</div>
	</div>






</body>

</html>