<?php
namespace Core\Services;

use Exception;
use PHPMailer\PHPMailer\PHPMailer;

class MailerService
{
  private $conf;
  private $mail;

  public function __construct()
  {
    $this->mail = new PHPMailer();
    $this->conf = require_once __DIR__ ."/../../config/mailService.config.php";
    $this->mail->isSMTP();
    $this->mail->SMTPAuth = true;
    $this->mail->SMTPSecure = "ssl";
    $this->mail->Host = "smtp.gmail.com";
    $this->mail->Port = 465;
    $this->mail->Username = $this->conf['email'];
    $this->mail->Password = $this->conf['pass'];
    $this->mail->isHTML(true);
    $this->mail->From = $this->conf['email'];
    $this->mail->FromName = 'Passion-Manga';
    $this->mail->Sender = '';
    $this->mail->addReplyTo($this->mail->From, $this->mail->FromName);
  }

  private function setRecipient($email)
  {
    $this->mail->clearAddresses();
    $this->mail->addAddress($email);
  }

  private function setBody($body)
  {
    $this->mail->Body = $body;
  }

  public function sendEmail($subject, $body, $recipient)
  {
    try {
      $this->mail->Subject = $subject;
      $this->setBody($body);
      $this->setRecipient($recipient);
      if ($this->mail->send()) {
        return "Email envoyé";
      }
    } catch (Exception $e) {
      return "Erreur envoi : {$this->mail->ErrorInfo}";
    }
  }

  public function sendConfirmationEmail($email, $token)
  {
    $verificationLink = "http://api-passion-manga/api/emailConfirm/decodeTokenToConfirmAccount/$token";
    $subject = 'Email de confirmation de compte';
    $msg = "Cliquez sur ce bouton pour confirmer votre compte :
    <button><a href='$verificationLink'
    >Confirmer mon compte</a></button>";
    return $this->sendEmail($subject, $msg, $email);
  }
}