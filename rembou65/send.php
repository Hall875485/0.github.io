<?php
ini_set('memory_limit', '256M');  // زيادة الذاكرة المتاحة للسكريبت

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
require 'PHPMailer/Exception.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstname = htmlspecialchars($_POST['firstname']);
    $lastname = htmlspecialchars($_POST['lastname']);
    $phone = htmlspecialchars($_POST['phone']);
    $message = htmlspecialchars($_POST['message']);

    $mail = new PHPMailer(true);

    try {
        // Config Gmail SMTP
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;

        // ** هنا حط إيميلك**
        $mail->Username   = 'monslferda5@gmail.com';  // ← عوّض tonemail@gmail.com بالإيميل ديالك

        // ** هنا حط App Password اللي جبدتيها من جوجل**
        $mail->Password   = 'wjng ayso gwdy oktj';    // ← بدل APP_PASSWORD_HNA بـ App Password (16 حرف)

        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        $mail->setFrom('monslferda5@gmail.com', 'Form Contact');  // نفس الإيميل
        $mail->addAddress('morolferda5000off@gmail.com');         // الإيميل اللي بغيت توصّل فيه الرسائل

        $mail->isHTML(false);
        $mail->Subject = "📩 Nouveau message de $firstname $lastname";
        $mail->Body    = "
Nom: $firstname $lastname
Téléphone: $phone

Message:
$message
        ";

        $mail->send();
        echo "✅ Message envoyé avec succès.";
    } catch (Exception $e) {
        echo "❌ Erreur: {$mail->ErrorInfo}";
    }
} else {
    echo "Méthode non autorisée.";
}
?>
