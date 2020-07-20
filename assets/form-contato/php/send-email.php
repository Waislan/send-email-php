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

    $mail->Username = 'edslpsslv@gmail.com'; // email remetente
    $mail->Password = 'tkcdnhersryxndee'; //senha do email remetente
    $mail->setFrom('noreply@gmail.com', 'Sistema');

    $mail->addAddress('waislanluis@gmail.com', ''); // Destinatário
    $mail->isHTML(true);
    $mail->Subject = 'Novo Contato do Site';

    if (sizeof($dados) == 4){
        $mail->Body    = 'Novo contato!<br />' .
                         'Nome: '. $dados[0] . '<br />' .
                         'Email: '. $dados[1] .'<br />' .
                         'Mensagem: '. $dados[2] .'<br />' .
                         'Link de origem: '. $dados[3];
                        
        $mail->AltBody = 'Novo contato!<br /><br />' .
                         'Nome: '. $dados[0] . '<br />' .
                         'Email: '. $dados[1] .'<br />' .
                         'Mensagem: '. $dados[2] .'<br />' .
                         'Link de origem: '. $dados[3];
    } else if (sizeof($dados) == 5){
        $mail->Body = 'Novo contato!<br />' .
                      'Nome: '. $dados[0] . '<br />' .
                      'Telefone: '. $dados[1] . '<br />' .
                      'Email: '. $dados[2] .'<br />' .
                      'Mensagem: '. $dados[3] .'<br />' .
                      'Link de origem: '. $dados[4];
                        
        $mail->AltBody = 'Novo contato!<br />' . 
                         'Nome: '. $dados[0] . '<br />' .
                         'Telefone: '. $dados[1] . '<br />' .
                         'Email: '. $dados[2] .'<br />' .
                         'Mensagem: '. $dados[3] .'<br />' .
                         'Link de origem: '. $dados[4];
    } else if (sizeof($dados) == 6){
        $mail->Body = 'Novo contato!<br />' .
                      'Nome: '. $dados[0] . '<br />' .
                      'Telefone: '. $dados[1] . '<br />' .
                      'Email: '. $dados[2] .'<br />' .
                      'Mensagem: '. $dados[3] .'<br />' .
                      'Como conheceu: '. $dados[4] .'<br />' .
                      'Link de origem: '. $dados[5];
                        
        $mail->AltBody = 'Novo contato!<br />' . 
                         'Nome: '. $dados[0] . '<br />' .
                         'Telefone: '. $dados[1] . '<br />' .
                         'Email: '. $dados[2] .'<br />' .
                         'Mensagem: '. $dados[3] .'<br />' .
                         'Como conheceu: '. $dados[4] .'<br />' .
                         'Link de origem: '. $dados[5];
    } else {
        echo 'erro';
    }

    $mail->send();
    
    echo 'true';
} catch (Exception $e) {
    echo "A mensagem não pôde ser enviada. Mailer Error: {$mail->ErrorInfo}";
}
?>