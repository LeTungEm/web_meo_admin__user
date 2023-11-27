<?php
require("../../PHPMailer-master/src/PHPMailer.php");
require("../../PHPMailer-master/src/SMTP.php");
require("../../PHPMailer-master/src/Exception.php");
class MailSender extends Db
{
    public function sendMail($headerData, $bodyData)
    {
        $mail = new PHPMailer\PHPMailer\PHPMailer();

        try {
            //Server settings
            $mail->IsSMTP(); 
            $mail->SMTPDebug = 1;
            $mail->Host = 'smtp.gmail.com'; 
            $mail->SMTPAuth = true;
            $mail->Username = 'nangarden2023@gmail.com'; //pass: Nangarden_2023_
            $mail->Password = 'xnlxelxrtvnkxjif'; 
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465; 

            //Recipients
            $mail->setFrom('nangarden2023@gmail.com');
            $mail->addAddress('em.letung2103@gmail.com'); //Name is optional
            
            //Content
            $mail->isHTML(true); //Set email format to HTML
            $mail->Subject = $headerData;
            $mail->Body = $bodyData;
            // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            ob_start();
            $mail->send();
            ob_end_clean();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }



}
?>