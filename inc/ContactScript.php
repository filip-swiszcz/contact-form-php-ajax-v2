<?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require '../vendor/autoload.php';

    require 'JSON.php';


    function emptyValidation($name, $email, $title, $message) {
        
        $json = new JSON();
        
        if (empty($name) OR empty($email) OR empty($title) OR empty($message)) {
            
            $output = $json->createJsonInstance('Proszę wypełnić formularz i spróbować ponownie.', 'error');
            $json->endAction($output);
            
        }
        
    }

    function emailValidation($email) {
        
        $json = new JSON();
        
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            
            $output = $json->createJsonInstance('Nieprawidłowy adres email.', 'error');
            $json->endAction($output);
            
        }
        
    }


    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['recaptcha_response'])) {
        
        $mail = new PHPMailer();
        $json = new JSON();
        
        
        $name = $_POST['name'];
        $email = $_POST['email'];
        $title = $_POST['title'];
        $message = $_POST['message'];
        
        
        emptyValidation($name, $email, $title, $message);
        
        
        emailValidation($email);
        
        
        // Build POST request
        $recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
        $recaptcha_secret = 'SECRET_KEY';
        $recaptcha_response = $_POST['recaptcha_response'];
        
        
        // Make and decode POST request
        $recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response);
        $recaptcha = json_decode($recaptcha);
        
        
        // PHPMailer settings
        $mail->SMTPDebug = SMTP::DEBUG_OFF;
        $mail->IsSMTP();
        $mail->Host = 'host';
        $mail->Mailer = 'smtp';
        $mail->SMTPAuth = true;
        $mail->Username = 'username';
        $mail->Password = 'password';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
        
        
        // PHPMailer sender & recipient
        $mail->setFrom('contact@pbcentr.com');
        $mail->addAddress('contact@pbcentr.com');
        $mail->addReplyTo($email, 'Reply to sender');
        
        
        // PHPMailer mail structure
        $mail->isHTML(true);
        $mail->Subject = 'Nowa wiadomosc od: ' . $name;
        $mail->Body = '<b>Imie:</b>  ' . $name . '<br><b>Email:</b> ' . $email . '<br><b>Tytul:</b> ' . $title . '<br><br><b>Wiadomosc:</b><br>' . $message;
        $mail->AltBody = 'Wiadomosc od:  ' . $name . ',  ' . $email . '<br><br>' . $message;
        
        
        if ($recaptcha->score >= 0.5) {
            
            if ($mail->Send()) {
                
                $output = $json->createJsonInstance('Twoja wiadomość została wysłana.', 'message');
                $json->endAction($output);
                
            } else {
                
                $output = $json->createJsonInstance('Coś poszło nie tak i twoja wiadomość nie została wysłana.', 'error');
                $json->endAction($output);
                
            }
            
        } else {
            
            $output = $json->createJsonInstance('Błąd: SPAM.', 'error');
            $json->endAction($output);
            
        }
        
    }

?>