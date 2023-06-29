<?php
use PHPMailer\PHPMailer\PHPMailer;

require 'PHPMailer/PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer/SMTP.php';

// Diğer gerekli dosyaları dahil edin ve veritabanı bağlantısını kurun
# Database Connection File
include "db_connection.php";
require_once 'db_connection.php';

if($_POST)
{
    //require_once 'PHPMailer/PHPMailer/PHPMailer.php';
    require 'PHPMailer/PHPMailer/PHPMailer.php';


    $email = trim($_POST['email']);
    if(!$email)
    {
        echo "Boş alan bırakmayın.";
    }
    else
    {
        if(!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            echo "E mail formatı yanlış girildi";
        }
        else
        {
            $varmi = $conn->prepare("SELECT full_name,email from users where email=:e");
            $varmi->execute([':e' => $email]);

            if($varmi->rowCount())
            {
                $row = $varmi->fetch(PDO::FETCH_ASSOC);

                $sifirlamakodu = uniqid("alpa_");
                $sifirlamalinki = "http://localhost/online-book-store/reset-password.php?kod=" . $sifirlamakodu;

                $mail = new PHPMailer();
                // SMTP ayarlarını yapılandırın
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';  // E-posta sunucusu adresi
                $mail->Port = 587;  // E-posta sunucusu portu
                $mail->SMTPSecure = 'tls';  // Güvenli bağlantı için TLS kullanın
                $mail->SMTPAuth = true;  // Kimlik doğrulamayı etkinleştirin
                $mail->Username = 'ibrahimhalilalpa21@gmail.com';  // E-posta hesabının kullanıcı adı
                $mail->Password = 'xxxxxxxx';  // E-posta hesabının şifresi

                // E-posta gönderim ayarlarını yapılandırın
                $mail->setFrom('ibrahimhalilalpa21a@gmail.com', 'İbrahim Halil Alpa');  // Gönderen bilgileri
                $mail->addAddress($email, 'Recipient Name');  // Alıcı bilgileri
                $mail->Subject = 'Şifre Sıfırlama';  // E-posta konusu
                $mail->CharSet = "UTF-8";  // E-posta konusu

                //$mail->Body = 'Şifrenizi sıfırlamak için bağlantı: http://example.com/reset-password';  // E-posta içeriği
                $mailContent = "<div style='font-size:20px'>Sayın:" . $row['full_name'] . "Sıfırlama linkiniz:" . $sifirlamalinki . "</div>";
                $mail->msgHTML("$mailContent");

try {
    // E-posta gönderme işlemi 
    if ($mail->send()) {
      echo "Şifre sıfırlama linkiniz gönderildi.";
    } else {
      echo "Hata oluştu: " . $mail->ErrorInfo;
    }
  } catch (Exception $e) {
    echo "Hata oluştu: " . $e->getMessage();
  }

  
}
else
{
    echo "Girilen e-mail adresi sistemde mevcut değil.";
}
}
}
}

?>



<!-- Şifre sıfırlama formunu oluşturun -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Şifre Sıfırlama</title>
</head>
<body>
  <h1>Şifrenizi Sıfırlayın</h1>
  <form method="POST" action="reset_password.php">
    <label for="email">E-posta Adresiniz:</label>
    <input type="email" id="email" name="email" required>
    <button type="submit">Şifreyi Sıfırla</button>
  </form>
</body>
</html>
