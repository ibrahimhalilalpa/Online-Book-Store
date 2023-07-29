<?php
session_start();

if (isset($_POST['email']) && isset($_POST['password'])) {
    // Validation helper function
    include "func-validation.php";
    // Database connection file
    include "../db_connection.php";

    $email = $_POST['email'];
    $password = $_POST['password'];

    // Simple form validation
    $text = "Email";
    $location = "../login.php";
    $ms = "error";
    is_empty($email, $text, $location, $ms, "");

    $text = "Password";
    $location = "../login.php";
    $ms = "error";
    is_empty($password, $text, $location, $ms, "");

    // Search for the email
    $sql = "SELECT * FROM users WHERE email=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$email]);

    // If the email exists
    if ($stmt->rowCount() === 1) {
        $user = $stmt->fetch();

        $user_id = $user['id'];
        $full_name = $user['full_name'];
        $user_email = $user['email'];
        $user_password = $user['password'];
        $rank = $user['rank'];
        $last_login = new DateTime();

        

        if ($email === $user_email && password_verify($password, $user_password)) {
            // Successful login
            if ($rank == 0) {
                $_SESSION['user_id'] = $user_id;
                $_SESSION['user_email'] = $user_email;
                $_SESSION['full_name'] = $full_name;
                $_SESSION['rank'] = $rank;
                $_SESSION['last_login'] = $last_login;
                $last_login_formatted = $last_login->format('Y-m-d H:i:s');
                mysqli_query($db, "UPDATE users SET last_login='$last_login_formatted' WHERE email='$email'");



                header("Location: ../index.php");
                exit;
            } else {
                $_SESSION['user_id'] = $user_id;
                $_SESSION['user_email'] = $user_email;
                $_SESSION['full_name'] = $full_name;
                $_SESSION['rank'] = $rank;
                $_SESSION['last_login'] = $last_login;
                $last_login_formatted = $last_login->format('Y-m-d H:i:s');
                mysqli_query($db, "UPDATE users SET last_login='$last_login_formatted' WHERE email='$email'");


                header("Location: ../admin.php");
                exit;
            }

        } else {
            // Incorrect username or password
            $em = "Incorrect username or password";
            header("Location: ../login.php?error=$em");
            exit;
        }
    } else {
        // Incorrect username or password
        $em = "Incorrect username or password";
        header("Location: ../login.php?error=$em");
        exit;
    }
} else {
    // Redirect to "../login.php"
    header("Location: ../login.php");
    exit;
}
?>