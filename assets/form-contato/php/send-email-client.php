<?php

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/PHPMailer/src/Exception.php';
require '../vendor/PHPMailer/src/PHPMailer.php';
require '../vendor/PHPMailer/src/SMTP.php';

$dados = $_POST['data'];

if ($dados[0] == 'form01'){
    $emailDestinatario = $dados[1];                
}
else {
    $emailDestinatario = $dados[2];    
}

$mail = new PHPMailer(true);

$mail->isSMTP();
$mail->Host = "smtp.gmail.com";
$mail->SMTPAuth = true;
$mail->SMTPSecure = "ssl";
$mail->Port = 465;

try {
    $mail->setLanguage('pt_br', 'vendor/PHPMailer/language/');
    $mail->CharSet = 'UTF-8';

    $mail->Username = ''; // gmail do e-mail que envia
    $mail->Password = ''; // senha de app gmail
    $mail->setFrom('', 'Sistema');

    $mail->addAddress($emailDestinatario, ''); // e-mail de quem recebe as mensagens do site
    $mail->isHTML(true);
    $mail->Subject = 'ÁREA 51 - MENTORIA GOOGLE (você vai aprender na prática)';
    
    
    $mail->Body  = '<p style="font-size:18px; font-family:arial">Eu sou Edson L., analista de anúncio e gerente de conta Google da nossa agência.<p/>' .
                '<p style="font-size:18px; font-family:arial">Estou passando pra dizer que recebemos sua inscrição para nosso treinamento na LIVE.<p/>' .
                '<p style="font-size:18px; font-family:arial">Área 51 é um treinamento onde eu mostro passo a passo e sem enrolação, como fazer anúncios no Google do jeito certo!<p/>' .
                '<p style="font-size:18px; font-family:arial">Se você ainda não fez o pagamento de <b>1 real simbólico</b> para garantir sua participação, <a href="https://sacola.pagseguro.uol.com.br/37dece07-a2f2-4226-966a-fced720d75d2"><b>CLIQUE AQUI para pagar com segurança.</b></a><p/>' .
                '<p style="font-size:18px; font-family:arial">🎁<b>TEM PRESENTE PRA VOCÊ!</b><p/>' .
                '<p style="font-size:18px; font-family:arial">Olha que legal, depois de fazer o pagamento no pagseguro, você poderá nos enviar seu BRIEFING se também desejar contratar nosso serviço de LANDING-PAGE COM desconto de 50% para participantes da LIVE.<p/>' .
                '<p style="font-size:18px; font-family:arial">🔔<b>Ah, só mais uma coisinha MUITO IMPORTANTE:</b><p/>' .
                '<p style="font-size:18px; font-family:arial"><a href="https://mentoriagoogle.com.br/inicio/links.php"><b>Clique aqui para ENTRAR NO GRUPO SECRETO</b></a> onde eu vou enviar o link exclusivo da LIVE, na noite anterior.<p/>' .
                '<p style="font-size:18px; font-family:arial">ps. Agente se vê na LIVE.<p/>' .
                '<div style="font-size:18px; font-family:arial">Edson L.<br/>' .
                '(11) 95420-4046<br/>' .
                'mentoriagoogle.com.br</div>';

    $mail->send();
    
    echo 'true';
} catch (Exception $e) {
    echo "A mensagem não pôde ser enviada. Mailer Error: {$mail->ErrorInfo}";
}
?>