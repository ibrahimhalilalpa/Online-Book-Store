<?php
session_start();
include "db_connection.php";

if (isset($_POST['change'])) 
{
  $email = $_POST['email'];
  $resetCode = $_POST['resetCode'];
  $password = ($_POST['password']);
  $confirmpassword = ($_POST['confirmpassword']);


  //hashing password
  $hashed_password = password_hash($password, PASSWORD_DEFAULT);

  // sorguyu çalıştır ve sonucu al
  $result = mysqli_query($db, "SELECT * FROM users WHERE email='$email' and resetCode='$resetCode'");

  $number = mysqli_num_rows($result);

  if ($number > 0) 
  {
    // şifreleri karşılaştır
    if ($password == $confirmpassword and $resetCode == $resetCode) 
    {
      // şifreyi güncelle
      mysqli_query($db, "UPDATE users SET password='$hashed_password' WHERE email='$email' and resetCode='$resetCode' ");
      $msg = "Password Changed Successfully";
    } else {
      // hata mesajı tanımla
      $ermsg = "Password and Confirm Password Field do not match!";
    }
  } 
  else 
  {
    // hata mesajı tanımla
    $errormsg = "Invalid email or reset code";
  }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>LOGIN</title>

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
    <form class="p-5 rounded shadow" style="max-width: 30rem; width: 100%" class="form-login" name="forgot"
      method="post">
      <h1 class="text-center display-4 pb-5">RESET PASSWORD</h1>

      <?php if (isset($msg)) { ?>
        <div class="alert alert-success" role="alert">
          <?= htmlspecialchars($msg); ?>
        </div>
      <?php } ?>

      <?php if (isset($errormsg)) { ?>
        <div class="alert alert-danger" role="alert">
          <?= htmlspecialchars($errormsg); ?>
        </div>
      <?php } ?>

      <?php if (isset($ermsg)) { ?>
        <div class="alert alert-danger" role="alert">
          <?= htmlspecialchars($ermsg); ?>
        </div>
      <?php } ?>

      <div class="mb-1">
        <label for="email" class="form-label">Email address</label>
        <input type="email" name="email" placeholder="Email" autocomplete="off" class="form-control" required><br>
      </div>

      <div class="mb-1">
        <label for="resetCode" class="form-label">Reset Code</label>
        <input type="text" name="resetCode" placeholder="123456" autocomplete="off" class="form-control"
          required><br>
      </div>

      <div class="mb-1">
        <label for="password" class="form-label">New Password</label>
        <input type="password" class="form-control" placeholder="New Password" id="password" name="password"
          required><br>
      </div>

      <div class="mb-1">
        <label for="confirmpassword" class="form-label">Confirm Password</label>
        <input type="password" class="form-control unicase-form-control text-input" placeholder="Confirm Password"
          id="confirmpassword" name="confirmpassword" required>

      </div>

      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" name="change">Reset
          Password</button><br> <br>
      </div>

      <div class="modal-footer">
        <a href="login.php">Login</a>
        <a href="register.php">Register</a>
      </div>

    </form>
  </div>


</body>

</html>