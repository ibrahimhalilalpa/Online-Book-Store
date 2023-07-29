<?php
session_start();
if (isset($_POST['full_name']) &&
    isset($_POST['email']) &&
    isset($_POST['password']) &&
    isset($_POST['password2'])) {
        
        include "../db_connection.php";

    // Get form data via POST request
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password2 = $_POST['password2'];
    $resetCode = rand(10000, 99999);


    // Simple form validation
    include "func-validation.php";

    is_empty($full_name, "Full Name", "../register.php", "error", "");
    is_empty($email, "Email", "../register.php", "error", "");
    is_empty($password, "Password", "../register.php", "error", "");
    is_empty($password2, "Confirm Password", "../register.php", "error", "");

    // Check if the email address exists in the database
    $sql_check_email = "SELECT COUNT(*) as count FROM users WHERE email = ?";
    $stmt_check_email = $conn->prepare($sql_check_email);
    $stmt_check_email->execute([$email]);
    $result_check_email = $stmt_check_email->fetch(PDO::FETCH_ASSOC);

    if ($result_check_email['count'] > 0) {
        // If the email address is already registered, send the corresponding message
        $eem = "Email already exists";
        header("Location: ../register.php?error=$eem");
        exit;
    }

    // Check that Password and Confirm Password match
    if ($password !== $password2) {
        $pem = "Passwords do not match";
        header("Location: ../register.php?error=$pem");
        exit;
    }

    // Encrypt the password with hashing
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Save user to database
    $sql = "INSERT INTO users (full_name, email, password, rank,resetCode) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$full_name, $email, $hashed_password,0,$resetCode]); // Rank value is automatically assigned 0 //resetCode is assigned automatically and randomly.

    // Successful registration message
    $msg = "Registration successful";
    //echo "<script>alert('xxxxx: '+'$resetCode');</script>";
    $rc = "Your password reset code: " . $resetCode.". " ."Please do not share this code with anyone. You can update this code in the 'My Profile' section.";
    include "../register.php"; 
    //header("Location: ../register.php?success=$msg");
    exit;
} else {
    // Hatalı istek yönlendirme
    header("Location: ../register.php");
    exit;
}
?>
