<?php
session_start();
if (isset($_POST['full_name']) &&
    isset($_POST['email']) &&
    isset($_POST['password']) &&
    isset($_POST['password2'])) {

    include "../db_connection.php";

    // Form verilerini POST isteği ile al
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password2 = $_POST['password2'];

    // Basit form doğrulama
    include "func-validation.php";

    is_empty($full_name, "Full Name", "../register.php", "error", "");
    is_empty($email, "Email", "../register.php", "error", "");
    is_empty($password, "Password", "../register.php", "error", "");
    is_empty($password2, "Confirm Password", "../register.php", "error", "");

    // Password ve Confirm Password'un eşleştiğini kontrol et
    if ($password !== $password2) {
        $em = "Passwords do not match";
        header("Location: ../register.php?error=$em");
        exit;
    }

    // Hashleme işlemi ile parolayı şifrele
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Kullanıcıyı veritabanına kaydet
    $sql = "INSERT INTO users (full_name, email, password, rank) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$full_name, $email, $hashed_password, 0]); // Rank değeri otomatik olarak 0 atanır

    // Başarılı kayıt mesajı
    $em = "Registration successful";
    header("Location: ../login.php?success=$em");
    exit;
} else {
    // Hatalı istek yönlendirme
    header("Location: ../register.php");
    exit;
}
?>
