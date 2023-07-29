<nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="height: 80px; font-size: 18px; 	margin-right: 5%;">
			<div class="container-fluid">
            <a class="navbar-brand" href="admin.php">Admin</a>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse"
					data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
					aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse m-lg-4" id="navbarSupportedContent" >
					<ul class="navbar-nav me-auto mb-2 mb-lg-0">
						<li class="nav-item">
                            <a class="nav-link" aria-current="page" href="index.php">Store</a>
						</li>
                        <li class="nav-item dropdown" style="color:black;">
							<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
								aria-expanded="false">
								Adding
							</a>
							<ul  class="dropdown-menu">
                            <li class="nav-item">
								<a class="nav-link" href="add-book.php">Add Book</a>
							</li>
                            <li class="nav-item">
								<a class="nav-link" href="add-category.php">Add Category</a>
							</li>

							<li class="nav-item">
								<a class="nav-link" href="add-author.php">Add Author</a>
							</li>

                            
							<li class="nav-item">
								<a class="nav-link" href="add-language.php">Add Language</a>
							</li>

							</ul>
						</li>


						<li class="nav-item dropdown" style="color:black;">
							<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
								aria-expanded="false">
								Mode
							</a>
							<ul  class="dropdown-menu">
								<li  id="dark"><a style="color:black;" onclick="myFunctionDark()" class="nav-link" href="#">Dark</a>
								</li>
								<li  id="light"><a style="color:black;" onclick="myFunctionLight()" class="nav-link" href="#">Light</a>
								</li>
							</ul>
						</li>

						<li class="nav-item">
							<?php if (isset($_SESSION['user_id'])) {
								// State when the user is logged in
								if ($_SESSION['rank'] == 0) {
									// Display Logout link if Rank value is 0
									?>
									<a  style="	color: red;" class="nav-link" href="logaut.php">Logout</a>

								<?php } else {
									// Display Admin link if Rank value is different than 0
									?>
									<a  style="	color: blue;" class="nav-link" href="admin.php">Admin Panel</a>
								<?php }
							} else {
								// When the user is not logged in
								?>
							<a  style="	color: yellow;" class="nav-link" href="login.php">Login</a>
							<?php
							} ?>
						</li>
					</ul>
					<h5 style="color:white;">
						<?php

						// Checking that the user is logged in
						if (isset($_SESSION['user_id']) && isset($_SESSION['user_email'])) {
							// Print the user's name
						
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
							// Show login form if user is not logged in
							// ...
							echo "GUEST";

						}
						?>
					</h5>
				</div>
			</div>
		</nav>






        <nav class="navbar navbar-expand-lg navbar-light bg-light">
				<div class="container-fluid">

					<div class="collapse navbar-collapse" id="navbarSupportedContent">
						<ul class="navbar-nav me-auto mb-2 mb-lg-0">
							<li class="nav-item">
							</li>

							

							<li class="nav-item">
								<a class="nav-link" href="logaut.php">Logaut</a>
							</li>
						</ul>
					</div>
				</div>
			</nav>

            





		<button onclick="myFunctionmyDIV()">Click Mee</button>
			<div>
				<button class="accordion">
					<h3>Languages</h3>
				</button>
				<div class="panel">
				<div class="list-group" style="width: 250px; text-align: left;">
					<?php if ($languages == 0) {
					// do nothing
				} else { ?>
						<a href="#" class="list-group-item list-group-item-action active">Language</a>
						<?php foreach ($languages as $language) { ?>

							<a href="filter-language.php?id=<?= $language['id'] ?>"
								class="list-group-item list-group-item-action">
								<?= $language['name'] ?></a>
						<?php }
				} ?>
				</div>

				</div>

				<button class="accordion">
					<h4>Top book downloaders of the week</h4>
				</button>
				<div class="panel">
				<div class="list-group mt-5" style="width: 250px; text-align: left;">
					<?php if ($categories == 0) {
					// do nothing
				} else { ?>
						<a href="#" class="list-group-item list-group-item-action active">Category</a>
						<?php foreach ($categories as $category) { ?>

							<a href="filter-category.php?id=<?= $category['id'] ?>"
								class="list-group-item list-group-item-action">
								<?= $category['name'] ?></a>
						<?php }
				} ?>
				</div>

				</div>

				<button class="accordion">
					<h4>Top book readers of the week</h4>
				</button>
				<div class="panel">
				<div class="list-group mt-5" style="width: 250px; text-align: left;">
					<?php if ($authors == 0) {
					// do nothing
				} else { ?>
						<a href="#" class="list-group-item list-group-item-action active">Author</a>
						<?php foreach ($authors as $author) { ?>

							<a href="filter-author.php?id=<?= $author['id'] ?>" class="list-group-item list-group-item-action">
								<?= $author['name'] ?></a>
						<?php }
				} ?>
				</div>
				</div>
		</div>




