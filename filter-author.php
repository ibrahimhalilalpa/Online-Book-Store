<?php 
session_start();

# If not author ID is set
if (!isset($_GET['id'])) {
	header("Location: index.php");
	exit;
}

# Get author ID from GET request
$id = $_GET['id'];

# Database Connection File
include "db_connection.php";

# Book helper function
include "php/func-book.php";
$books = get_books_by_author($conn, $id);

# author helper function
include "php/func-author.php";
$authors = get_all_author($conn);
$current_author = get_author($conn, $id);


# Category helper function
include "php/func-category.php";
$categories = get_all_categories($conn);

# Language helper function
include "php/func-language.php";
$languages = get_all_languages($conn);


 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?=$current_author['name']?></title>

    <!-- bootstrap 5 CDN-->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    <!-- bootstrap 5 Js bundle CDN-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/according.css">



	<script type="module" src="javascript/according.js"></script>
	<script src="javascript/javascript.js"></script>
</head>
<body>
	<div class="container">
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
		  <div class="container-fluid">
		    <a class="navbar-brand" href="index.php">Online Book Store</a>
		    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		      <span class="navbar-toggler-icon"></span>
		    </button>
		  </div>
		</nav>
		
		<h1 class="display-4 p-3 fs-3"> 
			<a href="index.php"
			   class="nd">
				<img src="img/back-arrow.PNG" 
				     width="35">
			</a>
		   <?=$current_author['name']?>
		</h1>

		<div class="d-flex">
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
						<div class="card my-3 mx-5 justify-content-center ">
							<div class="img-box">
								<img src="uploads/cover/<?= $book['cover'] ?>" class="card-img-top">
							</div>
							<div class="card-body ">
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
								<a href="uploads/files/<?= $book['file'] ?>" class="btn btn-success" target="_blank">Open</a>

								<a id="downloadBook" href="uploads/files/<?= $book['file'] ?>"  class="btn btn-primary"
									download="<?= $book['title'] ?>">Download</a>

							</div>
						</div>
					<?php } ?>
				</div>
			<?php } ?>


		<div class="category"  style="width:250px">
			<!-- List of languages -->
				<div class="list-group" style="width: 250px; text-align: left;">
			<?php if ($languages == 0){
					// do nothing
				}else{ ?>
				<a href="#"
				   class="list-group-item list-group-item-action active">Language</a>
				   <?php foreach ($languages as $language ) {?>
				  
				   <a href="filter-language.php?id=<?=$language['id']?>"
				      class="list-group-item list-group-item-action">
				      <?=$language['name']?></a>
				<?php } } ?>
			</div>

			<!-- List of categories -->
			<div class="list-group mt-5" style="width: 250px; text-align: left;">
			<?php if ($categories == 0){
					// do nothing
				}else{ ?>
				<a href="#"
				   class="list-group-item list-group-item-action active">Category</a>
				   <?php foreach ($categories as $category ) {?>
				  
				   <a href="filter-category.php?id=<?=$category['id']?>"
				      class="list-group-item list-group-item-action">
				      <?=$category['name']?></a>
				<?php } } ?>
			</div>

			<!-- List of authors -->
			<div class="list-group mt-5" style="width: 250px; text-align: left;">
				<?php if ($authors == 0){
					// do nothing
				}else{ ?>
				<a href="#"
				   class="list-group-item list-group-item-action active">Author</a>
				   <?php foreach ($authors as $author ) {?>
				  
				   <a href="filter-author.php?id=<?=$author['id']?>"
				      class="list-group-item list-group-item-action">
				      <?=$author['name']?></a>
				<?php } } ?>
			</div>            
		</div>



		</div>
	</div>
</body>
</html>