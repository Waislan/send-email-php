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

    $mail->Username = ''; // email remetente
    $mail->Password = ''; // senha do email remetente
    $mail->setFrom('noreply@gmail.com', 'Sistema');

    $mail->addAddress('waislanluis@gmail.com', ''); // Destinatário
    $mail->isHTML(true);
    $mail->Subject = 'Novo Contato do Site';

    
     if (sizeof($dados) == 2){
        $mail->Body  = 'Novo contato!<br />' .
                    'Email: '. $dados[0] .'<br />' .
                    'Link de origem: '. $dados[1];
                        
    } else if (sizeof($dados) == 3){
        $mail->Body = 'Novo contato!<br />' .
                    'Nome: '. $dados[0] . '<br />' .
                    'Email: '. $dados[1] .'<br />' .
                    'Link de origem: '. $dados[3];

    } else if (sizeof($dados) == 4){
        $mail->Body = 'Novo contato!<br />' .
                    'Nome: '. $dados[0] . '<br />' .
                    'Email: '. $dados[1] .'<br />' .
                    'Telefone: '. $dados[2] .'<br />' .
                    'Link de origem: '. $dados[3];

    } else if (sizeof($dados) == 5){
        $mail->Body = 'Novo contato!<br />' .
                    'Nome: '. $dados[0] . '<br />' .
                    'Email: '. $dados[1] .'<br />' .
                    'Telefone: '. $dados[2] . '<br />' .
                    'Mensagem: '. $dados[3] .'<br />' .
                    'Link de origem: '. $dados[4];

    } else if (sizeof($dados) == 6){
        $mail->Body = 'Novo contato!<br />' .
                    'Nome: '. $dados[0] . '<br />' .
                    'Email: '. $dados[1] .'<br />' .
                    'Telefone: '. $dados[2] . '<br />' .
                    'Mensagem: '. $dados[3] .'<br />' .
                    'Como conheceu: '. $dados[4] .'<br />' .
                    'Link de origem: '. $dados[5];

    } else if (sizeof($dados) == 7){
        $mail->Body = 'Novo contato!<br />' .
                    'Nome: '. $dados[0] . '<br />' .
                    'Email: '. $dados[1] .'<br />' .
                    'Telefone: '. $dados[2] . '<br />' .
                    'Data de nascimento: '. $dados[3] . '<br />' .
                    'Mensagem: '. $dados[4] .'<br />' .
                    'Como conheceu: '. $dados[5] .'<br />' .
                    'Link de origem: '. $dados[6];

    } else {
        echo 'erro';
    }

    $mail->send();
    
    echo 'true';
} catch (Exception $e) {
    echo "A mensagem não pôde ser enviada. Mailer Error: {$mail->ErrorInfo}";
}
?>