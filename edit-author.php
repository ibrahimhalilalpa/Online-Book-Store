<?php

//echo $_GET['id'];

session_start();
if(isset($_SESSION['user_id']) && isset($_SESSION['user_email']) )
{
    

    #if author id is not set
    if(!isset($_GET['id']))
    {
        #redirect to admin.php page
        header("Location:admin.php");
        exit;
    }
$id = $_GET['id'];

#database connection file
include "db_connection.php";

# author helper function
include "php/func-author.php";
$author = get_author($conn,$id);
//print_r($authors);

#if the id is invalid
if($author==0)
{
        #redirect to admin.php page
        header("Location:admin.php");
        exit;
}




?>
<!DOCTYPE html>
<html>
<head>
	<title>Edit Author</title>
    <!--    bootstrapt 5 CDN-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <!--    bootstrapt 5 Js bundle CDN-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>


</head>
<body>

<div class="container">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="height: 75px; font-size: 17px; 	margin:auto;">
        <div class="container-fluid">
            <a class="navbar-brand" href="admin.php">Admin Panel</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                <a class="nav-link" aria-current="page" href="index.php">Store</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="#">Edit Book</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="#">Edit Category</a>
                </li>
                <li class="nav-item">
                <a class="nav-link active" href="#">Edit Author</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="logaut.php">Logaut</a>
                </li>
            </ul>
            </div>
        </div>
        </nav>
        <form   action="php/edit-author.php" 
                method="post"
                class="shadow p-4 raunded mt-5" 
                style="margin:auto; max-width:50rem;">
            <h1 class="text-center pb-5 display-4 fs-3">Edit Author</h1>
            <?php if(isset($_GET['error'])) { ?>
                <div class="alert alert-danger" role="alert">
                <?=htmlspecialchars($_GET['error']); ?>
                </div>  
            <?php } ?>
            <?php if(isset($_GET['success'])) { ?>
                <div class="alert alert-success" role="alert">
                <?=htmlspecialchars($_GET['success']); ?>
                </div>  
            <?php } ?>

        <div class="mb-3">
        <label class="form-label">Author Name:</label>
        <input type="text" 
            value="<?=$author['id']?>"
            hidden
            name="author_id">
        <input type="text" 
            class="form-control"
            value="<?=$author['name']?>"
            name="author_name">
        </div>
        <button
            type="submit"
            class="btn btn-primary">
            Update
        </button>

        </form>
</div>

</body>
</html>

<?php
}
else
{
    header("Location: login.php");
    exit;   
}
?>