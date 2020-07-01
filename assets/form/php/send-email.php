<?php

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/PHPMailer/src/Exception.php';
require '../vendor/PHPMailer/src/PHPMailer.php';
require '../vendor/PHPMailer/src/SMTP.php';

$dados = $_POST['data'];

$mail = new PHPMailer(true);

$mail->isSMTP();
$mail->Host = "smtp.gmail.com";
$mail->SMTPAuth = true;
$mail->SMTPSecure = "ssl";
$mail->Port = 465;

try {
    $mail->setLanguage('pt_br', 'vendor/PHPMailer/language/');
    $mail->CharSet = 'UTF-8';

    $mail->Username = 'waislanluis@gmail.com'; // email remetente
    $mail->Password = 'ayahuascacura'; //senha do email remetente
    $mail->setFrom('noreply@gmail.com', 'Sistema');

    $mail->addAddress('waislansanches@hotmail.com', ''); // Destinatário
    $mail->isHTML(true);
    $mail->Subject = 'Nova lead';
    $mail->Body    = 'Nova lead capturada!<br />' . 
                        '<a href=""></a><br /><br />' .
                        'Nome: '. $dados[0] . '<br />' .
                        'Email: '. $dados[1] .'<br />' .
                        'Mensagem: '. $dados[2] .'<br />' .
                        'Link de origem: '. $dados[3];
                        
    $mail->AltBody = 'Nova lead capturada!<br /><br />' .
                        'Nome: '. $dados[0] . '<br />' .
                        'Email: '. $dados[1] .'<br />' .
                        'Mensagem: '. $dados[2] .'<br />' .
                        'Link de origem: '. $dados[3];

    $mail->send();
    
    echo 'true';
} catch (Exception $e) {
    echo "A mensagem não pôde ser enviada. Mailer Error: {$mail->ErrorInfo}";
}
?>