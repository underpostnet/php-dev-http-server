<?php


require("class.phpmailer.php");
require("class.smtp.php");

class mailer {
    function send($toemail, $name, $subject, $msg, $mailerConfig){

        $mail = new PHPMailer();
      
        $mail->IsSMTP();                                      // set mailer to
      
        $mail->Host = $mailerConfig->Host; //"smtp.example.com" specify main and backup server
        $mail->SMTPAuth = true;     // turn on SMTP authentication
        $mail->Username = $mailerConfig->Username; // "email@example.com" SMTP username
        $mail->Password = $mailerConfig->Password; // SMTP password
      
        $mail->From = $mailerConfig->From;
        $mail->FromName = $mailerConfig->FromName;        // remitente
        $mail->AddAddress($toemail, $name);        // destinatario
      
        //$mail->AddReplyTo("tu-correo@tu-nombre-de-dominio.com", "respuesta a");    // responder a
      
        $mail->WordWrap = 50;     // set word wrap to 50 characters
        $mail->IsHTML(true);     // set email
      
        $mail->Subject = $subject;
        $mail->Body    = $msg;
        $mail->AltBody = ""; //no imprime...
      
        if(!$mail->Send()){
          return false;
        }else{
          return true;
        }
      
      }
}

$mailer = new mailer();


?>